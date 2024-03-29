<?php
Yii::app()->clientScript->registerScript('inlineEmailEditor',"
function setupEmailEditor() {
	if($('#email-message').data('editorSetup') != true) {
		new TINY.editor.edit('teditor',{
			id:'email-message',
			// width:560,
			height:200,
			cssclass:'tinyeditor',
			controlclass:'tecontrol',
			rowclass:'teheader',
			dividerclass:'tedivider',
			controls:['bold','italic','underline','strikethrough','|','subscript','superscript','|',
					'orderedlist','unorderedlist','|','outdent','indent','|','leftalign',
					'centeralign','rightalign','blockjustify','|','undo','redo','n',
					'font','size','unformat','|','image','hr','link','unlink','|','print'],
			footer:true,
			fonts:['Verdana','Arial','Georgia','Trebuchet MS'],
			xhtml:false,
			cssfile:'".Yii::app()->theme->getBaseUrl().'/css/tinyeditor.css'."',
			// bodyid:'editor',
			footerclass:'tefooter',
			toggle:{text:'source',activetext:'wysiwyg',cssclass:'tetoggle'},
			resize:{cssclass:'teresize'}
		});
		
		$('#email-message').data('editorSetup',true);
		
		// give send-email module focus when tinyedit clicked		
		$('#email-message-box').find('iframe').contents().find('body').click(function() {
		    if(!$('#inline-email-form').find('.wide.form').hasClass('focus-mini-module')) {
		    	$('.focus-mini-module').removeClass('focus-mini-module');
		    	$('#inline-email-form').find('.wide.form').addClass('focus-mini-module');
		    }
		});
		
		$('#inline-email-form').find('iframe').attr('tabindex', 5);
	}
}
",CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('inlineEmailEditorSetup',"

if(window.hideInlineEmail)
	$('#inline-email-form').show();
else
	setupEmailEditor();
",CClientScript::POS_READY);
?>
<div id="inline-email-top"></div>
<div id="inline-email-form">
<?php
/* if(isset($preview) && !empty($preview)) { ?>
<div class="form">
	<?php echo $preview; ?>
</div>
<?php
} */


echo CHtml::image(Yii::app()->theme->getBaseUrl().'/images/loading.gif',Yii::t('app','Loading'),array('id'=>'email-sending-icon'));
$emailSent = false;

if(!empty($model->status)) {
	$index = array_search('200',$model->status);
	if($index !== false) {
		unset($model->status[$index]);
		$model->message = '';
		$signature = Yii::app()->params->profile->getSignature(true);
		$model->message = '<font face="Arial" size="2">'.(empty($signature)? '' : '<br><br>' . $signature).'</font>';
		$model->subject = '';
		$attachments = array();
		$emailSent = true;
	}
	echo '<div class="form email-status">';
	foreach($model->status as &$status_msg) echo $status_msg." \n";
	echo '</div>';
}
?>
<div id="email-mini-module" class="wide form<?php if($emailSent) echo ' hidden'; ?>">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'enableAjaxValidation'=>false,
		'method'=>'post',
		'htmlOptions'=>array('class'=>'horizontal-form'),
	));
	echo $form->hiddenField($model,'modelId');
	echo $form->hiddenField($model,'modelName');
	?>
	<div class="row">
		<?php echo $form->errorSummary($model, Yii::t('app', "Please fix the following errors:"), null, array('style'=>'margin-bottom: 5px;')); ?>
	</div>
	<div class="input-group">
		<?php echo $form->label($model,'to', array('class'=>'x2-email-label')); ?>
		<div class="inputs">
			<?php echo $form->textField($model,'to',array('id'=>'email-to', 'tabindex'=>'1'));?> 
		</div>	
		<a href="javascript:void(0)" id="cc-toggle"<?php if(!empty($model->cc)) echo ' style="display:none;"'; ?>>[cc]</a> 
		<a href="javascript:void(0)" id="bcc-toggle"<?php if(!empty($model->bcc)) echo ' style="display:none;"'; ?>>[bcc]</a>
		
	</div>
	<div class="input-group" id="cc-row"<?php if(empty($model->cc)) echo ' style="display:none;"'; ?>>
		<?php //echo $form->error($model,'to'); ?>
		<?php echo $form->label($model,'cc', array('class'=>'x2-email-label')); ?>
		<div class="inputs">
			<?php echo $form->textField($model,'cc',array('id'=>'email-cc', 'tabindex'=>'2')); ?>
		</div>
	</div>
	<div class="input-group" id="bcc-row"<?php if(empty($model->bcc)) echo ' style="display:none;"'; ?>>
		<?php //echo $form->error($model,'to'); ?>
		<?php echo $form->label($model,'bcc', array('class'=>'x2-email-label')); ?>
		<div class="inputs">
		<?php echo $form->textField($model,'bcc',array('id'=>'email-bcc', 'tabindex'=>'3')); ?>
		</div>
	</div>
	<div class="input-group">
		<?php echo $form->label($model,'subject', array('class'=>'x2-email-label')); ?>
		<div class="inputs">
		<?php echo $form->textField($model,'subject', array('style'=>'width: 265px;', 'tabindex'=>'4')); ?>
		</div>
		<?php $templateList = DocChild::getEmailTemplates(); ?>
		<?php $templateList = array('0'=>Yii::t('docs','Custom Message')) + $templateList; ?>
		<?php echo $form->label($model,'template', array('class'=>'x2-email-label', 'style'=>'float: none; margin-left: 10px; vertical-align: text-top;')); ?>
		<?php echo $form->dropDownList($model,'template',$templateList,array('id'=>'email-template')); ?>
	</div>
	<div class="input-group" id="email-message-box">
		<?php echo $form->textArea($model,'message',array('id'=>'email-message','style'=>'margin:0;padding:0;')); ?>
	</div>
	
	<div class="input-group" id="email-attachments">
		<div class="form" style="text-align:left; background-color: inherit">
			<b><?php echo Yii::t('app','Attach a File'); ?></b><br />
			<?php if(isset($attachments)) { // is this a refreshed form with previous attachments? ?>
				<?php foreach($attachments as $attachment) { ?>
					<div>
						<span class="filename"><?php echo $attachment['filename']; ?></span>
						<span class="remove"><a href="#">[x]</a></span>
						<span class="error"></span>
						<input type="hidden" name="AttachmentFiles[temp][]" value="<?php echo ($attachment['temp']? "true" : "false"); ?>">
						<input type="hidden" name="AttachmentFiles[id][]" class="AttachmentFiles" value="<?php echo $attachment['id']; ?>">
					</div>
				<?php } ?>
			<?php } ?>
			<div class="next-attachment">
				<?php //echo CHtml::fileField('upload','',array('onchange'=>'checkName(this, "#submitAttach"); if($("#submitAttach").attr("disabled") != "disabled") {fileUpload(this.form, $(this), "'. Yii::app()->createUrl('site/tmpUpload') .'", "'. Yii::app()->createUrl('site/removeTmpUpload') .'"); }')); ?>
				<span class="upload-wrapper">
					<span class="x2-file-wrapper">
					    <input type="file" class="x2-file-input" name="upload" onChange="checkName(this, '#submitAttach'); if($('#submitAttach').attr('disabled') != 'disabled') {fileUpload(this.form, $(this), '<?php echo Yii::app()->createUrl('site/tmpUpload'); ?>', '<?php echo Yii::app()->createUrl('site/removeTmpUpload'); ?>'); }">
					    <input type="button" class="x2-button" value="Choose File">
					    <?php echo CHtml::image(Yii::app()->theme->getBaseUrl().'/images/loading.gif',Yii::t('app','Loading'),array('id'=>'choose-file-saving-icon', 'style'=>'position: absolute; width: 14px; height: 14px; filter: alpha(opacity=0); -moz-opacity: 0.00; opacity: 0.00;')); ?>
					</span>
					<span style="vertical-align: middle">
					    <?php //echo Yii::t('media', 'Max') .' '. Media::getServerMaxUploadSize(); ?> MB
					</span>
				</span>
				<span class="filename"></span>
				<span class="remove"></span>
				<span class="error"></span>
			</div>
		</div>
	</div>
	
	<div class="row buttons">
	<?php
	echo CHtml::ajaxSubmitButton(
		Yii::t('app','Send'),
		array('inlineEmail','ajax'=>1),
		array(
			'beforeSend'=>"function(a,b) { teditor.post(); $('#email-sending-icon').show(); }",
			'replace'=>'#inline-email-form',
			'complete'=>"function(response) { $('#email-sending-icon').hide(); setupEmailEditor(); updateHistory(); initX2EmailForm(); }",
		),
		array(
			'id'=>'send-email-button',
			'class'=>'x2-button highlight',
			'style'=>'margin-left:-20px;',
			'name'=>'InlineEmail[submit]',
			'onclick'=>'teditor.post();',
		)
	);
	echo CHtml::ajaxSubmitButton(
		Yii::t('app','Preview'),
		array('inlineEmail','ajax'=>1,'preview'=>1),
		array(
			'beforeSend'=>"function(a,b) { teditor.post(); $('#email-sending-icon').show(); }",
			'replace'=>'#inline-email-form',
			'complete'=>"function(response) { $('#email-sending-icon').hide(); setupEmailEditor(); initX2EmailForm(); }",
		),
		array(
			'id'=>'preview-email-button',
			'class'=>'x2-button',
			'name'=>'InlineEmail[submit]',
			'onclick'=>'teditor.post();',
		)
	);
	echo CHtml::resetButton(Yii::t('app','Cancel'),array('class'=>'x2-button','onclick'=>"toggleEmailForm();return false;"));
	// echo CHtml::htmlButton(Yii::t('app','Send'),array('type'=>'submit','class'=>'x2-button','id'=>'send-button','style'=>'margin-left:90px;')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>
</div>
