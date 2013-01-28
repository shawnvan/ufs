<?php
/**
 * Provides an action for sending email from a view page with an inline form.
 * 
 * @package X2CRM.components 
 */
class InlineEmailAction extends CAction {

	public $model;
	
	public function run() {

		$preview = false;
		$emailBody = '';
		$signature = '';
		$template = null;
			
		if(!isset($this->model))
			$this->model = new InlineEmail;

		if(isset($_POST['InlineEmail'])) {

			if(isset($_GET['preview']) || (isset($_POST['InlineEmail']['submit']) && $_POST['InlineEmail']['submit'] == Yii::t('app','Preview')))
				$preview = true;

			$this->model->attributes = $_POST['InlineEmail'];

			// if the user specified a template, look it up and use it for the message
			if($this->model->template != 0) {
				$matches = array();
				if(preg_match('/<!--BeginSig-->(.*)<!--EndSig-->/u',$this->model->message,$matches) && count($matches) > 1)	// extract signature
					$signature = $matches[1];
					
				$this->model->message = preg_replace('/<!--BeginSig-->(.*)<!--EndSig-->/u','',$this->model->message);	// remove signatures
					
				$matches = array();
				if(preg_match('/<!--BeginMsg-->(.*)<!--EndMsg-->/u',$this->model->message,$matches) && count($matches) > 1)
					$this->model->message = $matches[1];
			
				if(empty($signature))
					$signature = Yii::app()->params->profile->getSignature(true);	// load default signature if empty
			
				$template = CActiveRecord::model('Docs')->findByPk($this->model->template);
				if(isset($template)) {
					$this->model->message = str_replace('\\\\', '\\\\\\', $this->model->message);
					$this->model->message = str_replace('$', '\\$', $this->model->message);
					$emailBody = preg_replace('/{content}/u','<!--BeginMsg-->'.$this->model->message.'<!--EndMsg-->',$template->text);
					$emailBody = preg_replace('/{signature}/u','<!--BeginSig-->'.$signature.'<!--EndSig-->',$emailBody);
					
					// check if subject is empty, or is from another template
					if(empty($this->model->subject) || CActiveRecord::model('Docs')->countByAttributes(array('type'=>'email','subject'=>$this->model->subject)))
						$this->model->subject = $template->subject;
					
					// if there is a model name/id available, look it up and use its attributes
					if(isset($this->model->modelName, $this->model->modelId)) {
						$targetModel = CActiveRecord::model($this->model->modelName)->findByPk($this->model->modelId);
						if(isset($targetModel)) {
						
							$matches = array();
							preg_match_all('/{\w+}/',$emailBody,$matches);	// find all the things
							
							if(isset($matches[0])) {					// loop through the things
								foreach($matches[0] as $match) {
									$match = substr($match,1,-1);	// remove { and }
									
									if($targetModel->hasAttribute($match)) {
										$value = $targetModel->renderAttribute($match,false,true);	// get the correctly formatted attribute
										$emailBody = preg_replace('/{'.$match.'}/',$value,$emailBody);
									}
								}
							}
						}
					}
					$this->model->template = 0;				// set to custom so the person can edit the whole message
					$this->model->message = $emailBody;
				}
			} elseif(!empty($this->model->message)) {	// if no template, use the user's custom message, and include a signature
				$emailBody = $this->model->message;
			// } elseif(!empty($this->model->message)) {	// if no template, use the user's custom message, and include a signature
				// $emailBody = $this->model->message.'<br><br>'.Yii::app()->params->profile->getSignature(true);
			}
			

			
			if($this->model->template == 0)
				$this->model->setScenario('custom');
				
			if($this->model->validate() && !$preview) {
				
				$mediaLibraryUsed = false; // is there an attachment from the media library?
				if(isset($_POST['AttachmentFiles']) && isset($_POST['AttachmentFiles']['id']) && isset($_POST['AttachmentFiles']['temp']))  {
					$ids = $_POST['AttachmentFiles']['id'];
					$temps = $_POST['AttachmentFiles']['temp'];
					$attachments = array();
					for($i = 0; $i < count($ids); $i++) {
						$temp = json_decode($temps[$i]);
						if($temp) { // attachment is a temp file
							$tempFile = TempFile::model()->findByPk($ids[$i]);
							$attachments[] = array('filename' => $tempFile->name, 'folder' => $tempFile->folder, 'temp' => json_decode($temps[$i]), 'id' => $tempFile->id);
						} else { // attachment is from media library
							$mediaLibraryUsed = true;
							$media = Media::model()->findByPk($ids[$i]);
							$attachments[] = array('filename' => $media->fileName, 'folder' => $media->uploadedBy, 'temp' => json_decode($temps[$i]), 'id' => $media->id);
						}
					}
				}
				
				if(isset($attachments))
					$this->model->status = UFSBaseUtil::sendUserEmail($this->model->mailingList,$this->model->subject,$emailBody, $attachments);
				else
					$this->model->status = UFSBaseUtil::sendUserEmail($this->model->mailingList,$this->model->subject,$emailBody);
				
				if(in_array('200',$this->model->status)) {
					
					foreach($this->model->mailingList['to'] as &$target) {
						$contact = CActiveRecord::model('Contacts')->findByPk($this->model->modelId);
						if(isset($contact)) {

							$action = new Actions;
							$action->associationType = 'contacts';
							$action->associationId = $contact->id;
							$action->associationName = $contact->name;
							$action->visibility = $contact->visibility;
							$action->complete = 'Yes';
							$action->type = 'email';
							$action->completedBy = Yii::app()->user->getName();
							$action->assignedTo = $contact->assignedTo;
							$action->createDate = time();
							$action->dueDate = time();
							$action->completeDate = time();
							if($template == null) {
								$action->actionDescription = '<b>'.$this->model->subject."</b>\n\n".$this->model->message;
								if(isset($attachments)) {
									$action->actionDescription .= "\n\n";
									$action->actionDescription .= '<b>'. Yii::t('media', 'Attachments:') . "</b>\n";
									foreach($attachments as $attachment) {
										$action->actionDescription .= '<span class="email-attachment-text">'. $attachment['filename'] . "</span>\n";
									}
								}
							} else
								$action->actionDescription = CHtml::link($template->title,array('/docs/'.$template->id));
							
							if($action->save()){
                                                            
                                                        }
							// $message="2";
							// $email=$toEmail;
							// $id=$contact['id'];
							// $note.="\n\nSent to Contact";
						}
					}
					
				}
				
			}
		}
		
		$attachments = array();
		if(isset($_POST['AttachmentFiles']) && isset($_POST['AttachmentFiles']['id']) && isset($_POST['AttachmentFiles']['temp']))  {
		    $ids = $_POST['AttachmentFiles']['id'];
		    $temps = $_POST['AttachmentFiles']['temp'];
		    for($i = 0; $i < count($ids); $i++) {
		    	$temp = json_decode($temps[$i]);
		    	if($temp) { // attachment is a temp file
		    		$tempFile = TempFile::model()->findByPk($ids[$i]);
		    		if(isset($tempFile))
		    			$attachments[] = array('filename' => $tempFile->name, 'temp' => json_decode($temps[$i]), 'id' => $tempFile->id);
		    	} else { // attachment is from media library
		    		$mediaLibraryUsed = true;
		    		$media = Media::model()->findByPk($ids[$i]);
		    		if(isset($media))
		    			$attachments[] = array('filename' => $media->fileName, 'temp' => json_decode($temps[$i]), 'id' => $media->id);
		    	}
		    }
		}
		
		echo $this->controller->renderPartial('application.modules.UFSBase.widgets.views.inlineEmailForm',array(
			'model'=>$this->model,
			'preview'=>$preview? $emailBody : null,
			'attachments'=>$attachments,
		));
		
		// }
	}
}
?>