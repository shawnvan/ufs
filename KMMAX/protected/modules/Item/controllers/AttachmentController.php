<?php

class AttachmentController extends Kmmax
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$transaction = Yii::app()->db->beginTransaction();
		
		    $model=Attachment::model()->findByPk($id);
		    try {
				$model->fViewNum=$model->fViewNum+1;
				$viewmodel=new Viewattach();
				$viewmodel->fViewNo=GuidUtil::getUuid();
				$viewmodel->fAttachmentNo=$model->fAttachmentId;
				$viewmodel->fViewer=Yii::app()->params->loginuser->fUserName;
				$viewmodel->fViewDate=time();
				$viewmodel->save();
				$name='';
				$name=explode('.',$model->fAttachmentFalseName);
				$filename=$name[0];
				$path=Yii::app()->params['upload_path_all'];
				$path_pdf=Yii::app()->params['upload_path_pdf'];
				$path_swf=Yii::app()->params['upload_path_swf'];
				//验证源文件是否存在
				if(file_exists($path.$model->fAttachmentFalseName))
				{
					if(!(file_exists($path_pdf.$filename.'.pdf'))){
						set_time_limit(0);
						$output_dir = $path_pdf;
						$doc_file = $path.$model->fAttachmentFalseName;
						$pdf_file = $filename.".pdf";
						$output_file = $output_dir.$pdf_file;
						$doc_file = "file:///" . $doc_file;
						$output_file = "file:///" . $output_file;	
						$this->word2pdf($doc_file,$output_file);
					}
					if(file_exists($path_pdf.$filename.'.pdf')){
						if(!(file_exists($path_swf.$filename.'.swf'))){
							@unlink($path_swf."\\".$filename.".swf" );
							$command= "c:/SWFTools/pdf2swf.exe  -t \"".$path_pdf."\\".$filename.".pdf\" -o  \"".$path_swf."\\".$filename.".swf\" -s flashversion=9 ";
							$WshShell = new COM("WScript.Shell");
							$oExec = $WshShell->Run("cmd /C ". $command, 0, true);
						}
					}
				}else print("这个文件存在");  //文件存在 
				if(isset($_POST['number']) && !empty($_POST['number'])){
					$id=isset($_GET['id'])?$_GET['id']:'';
					if($_POST['number']=='123456'){
							$this->Download($id);
							$model->fViewNum=$model->fViewNum-1;
					}
					else
						print_r('请输入:123456');
				}
				$model->save();
				$transaction->commit();
			//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
			$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
			$this->render('view',array(
				'model'=>$model,
				'keyid'=>$id,'filename'=>$name[0],
			));
		
	}
	 public function MakePropertyValue($name,$value,$osm){
		$oStruct = $osm->Bridge_GetStruct("com.sun.star.beans.PropertyValue");
		$oStruct->Name = $name;
		$oStruct->Value = $value;
		return $oStruct;
	}
	public function word2pdf($doc_url, $output_url){
		$osm = new COM("com.sun.star.ServiceManager") or die ("Please be sure that OpenOffice.org is installed.\n");
		$args = array($this->MakePropertyValue("Hidden",true,$osm));
		$oDesktop = $osm->createInstance("com.sun.star.frame.Desktop");
		$oWriterDoc = $oDesktop->loadComponentFromURL($doc_url,"_blank", 0, $args);
		$export_args = array($this->MakePropertyValue("FilterName","writer_pdf_Export",$osm));
		$oWriterDoc->storeToURL($output_url,$export_args); 
		$oWriterDoc->close(true);
	} 
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Attachment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Attachment']))
			$model->attributes=$_GET['Attachment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
     * Grid of all models.
     */
    public function actionIndex()
    {
		$criteria=new CDbCriteria;

        $pages=new CPagination(Attachment::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Attachment');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fAttachmentId'=>array('asc'=>'fAttachmentId','desc'=>'fAttachmentId desc','label'=>Attachment::model()->getAttributeLabel('fAttachmentId')),
		'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Attachment::model()->getAttributeLabel('fTaskNo')),
		'fResultNo'=>array('asc'=>'fResultNo','desc'=>'fResultNo desc','label'=>Attachment::model()->getAttributeLabel('fResultNo')),
		'fDocumentNo'=>array('asc'=>'fDocumentNo','desc'=>'fDocumentNo desc','label'=>Attachment::model()->getAttributeLabel('fDocumentNo')),
		'fKnowledgeNo'=>array('asc'=>'fKnowledgeNo','desc'=>'fKnowledgeNo desc','label'=>Attachment::model()->getAttributeLabel('fKnowledgeNo')),
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Attachment::model()->getAttributeLabel('fCatalogueNo')),
		/*
		'fAttachmentName'=>array('asc'=>'fAttachmentName','desc'=>'fAttachmentName desc','label'=>Attachment::model()->getAttributeLabel('fAttachmentName')),
		'fAttachmentFalseName'=>array('asc'=>'fAttachmentFalseName','desc'=>'fAttachmentFalseName desc','label'=>Attachment::model()->getAttributeLabel('fAttachmentFalseName')),
		'fDownloadNum'=>array('asc'=>'fDownloadNum','desc'=>'fDownloadNum desc','label'=>Attachment::model()->getAttributeLabel('fDownloadNum')),
		'fViewNum'=>array('asc'=>'fViewNum','desc'=>'fViewNum desc','label'=>Attachment::model()->getAttributeLabel('fViewNum')),
		'fVersion'=>array('asc'=>'fVersion','desc'=>'fVersion desc','label'=>Attachment::model()->getAttributeLabel('fVersion')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Attachment::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Attachment::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Attachment::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Attachment::model()->getAttributeLabel('fUpdateDate')),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Attachment::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='fAttachmentId';
        $sort->applyOrder($criteria);

        // find all
        $models=Attachment::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fAttachmentId)),
		 array('content'=>CHtml::encode($model->fTaskNo)),
		 array('content'=>CHtml::encode($model->fResultNo)),
		 array('content'=>CHtml::encode($model->fDocumentNo)),
		 array('content'=>CHtml::encode($model->fKnowledgeNo)),
		 array('content'=>CHtml::encode($model->fCatalogueNo)),
		/*
		 array('content'=>CHtml::encode($model->fAttachmentName)),
		 array('content'=>CHtml::encode($model->fAttachmentFalseName)),
		 array('content'=>CHtml::encode($model->fDownloadNum)),
		 array('content'=>CHtml::encode($model->fViewNum)),
		 array('content'=>CHtml::encode($model->fVersion)),
		 array('content'=>CHtml::encode($model->fCreateUser)),
		 array('content'=>CHtml::encode($model->fCreateDate)),
		 array('content'=>CHtml::encode($model->fUpdateUser)),
		 array('content'=>CHtml::encode($model->fUpdateDate)),
		*/
            );
        }	
		
		$model=new Attachment;
		$model->unsetAttributes();  // clear any default values

        // render the view file
        $this->render('index',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,
        ));
    }


    /**
     * Print out array of models for the jqGrid rows.
     */
    public function actionGridData()
    {  	
        if(!Yii::app()->request->isPostRequest)
        {
            throw new CHttpException(400,Yii::t('http','Invalid request. Please do not repeat this request again.'));
            exit;
        }
        // specify request details
        $jqGrid=$this->processJqGridRequest();
        $criteria=new CDbCriteria;

        if($jqGrid['filters']!=null){
        	$filters=json_decode($jqGrid['filters']);
        	if(!empty($filters->groupOp) && (!empty($filters->rules))){
        		$operation=$this->getJqGridOperationArray();
        		$keywordFormula=$this->getJqGridKeywordFormulaArray();
        		$condition='';
        		$param=array();
        		foreach($filters->rules as $temp){
        			if(empty($condition))
        				$condition=' t.'.$temp->field.' '.$operation[$temp->op].' :'.$temp->field;
        			else
        				$condition=$condition.' '.$filters->groupOp.' t.'.$temp->field.' '.$operation[$temp->op].' :'.$temp->field;
        			$param[':'.$temp->field]=str_replace('keyword',$temp->data,$keywordFormula[$temp->op]);
        		}
        		$criteria->condition=$condition;
        		$criteria->params=$param;
        	}
        }
		// pagination
        
		$pages=new CPagination(Attachment::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Attachment');
		
        $sort->attributes=array(
           		'fAttachmentId'=>array('asc'=>'fAttachmentId','desc'=>'fAttachmentId desc','label'=>Attachment::model()->getAttributeLabel('fAttachmentId')),
		'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Attachment::model()->getAttributeLabel('fTaskNo')),
		'fResultNo'=>array('asc'=>'fResultNo','desc'=>'fResultNo desc','label'=>Attachment::model()->getAttributeLabel('fResultNo')),
		'fDocumentNo'=>array('asc'=>'fDocumentNo','desc'=>'fDocumentNo desc','label'=>Attachment::model()->getAttributeLabel('fDocumentNo')),
		'fKnowledgeNo'=>array('asc'=>'fKnowledgeNo','desc'=>'fKnowledgeNo desc','label'=>Attachment::model()->getAttributeLabel('fKnowledgeNo')),
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Attachment::model()->getAttributeLabel('fCatalogueNo')),
		/*
		'fAttachmentName'=>array('asc'=>'fAttachmentName','desc'=>'fAttachmentName desc','label'=>Attachment::model()->getAttributeLabel('fAttachmentName')),
		'fAttachmentFalseName'=>array('asc'=>'fAttachmentFalseName','desc'=>'fAttachmentFalseName desc','label'=>Attachment::model()->getAttributeLabel('fAttachmentFalseName')),
		'fDownloadNum'=>array('asc'=>'fDownloadNum','desc'=>'fDownloadNum desc','label'=>Attachment::model()->getAttributeLabel('fDownloadNum')),
		'fViewNum'=>array('asc'=>'fViewNum','desc'=>'fViewNum desc','label'=>Attachment::model()->getAttributeLabel('fViewNum')),
		'fVersion'=>array('asc'=>'fVersion','desc'=>'fVersion desc','label'=>Attachment::model()->getAttributeLabel('fVersion')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Attachment::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Attachment::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Attachment::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Attachment::model()->getAttributeLabel('fUpdateDate')),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Attachment::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='fAttachmentId';
        $sort->applyOrder($criteria);

        // find all
        $models=Attachment::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fAttachmentId'=>$model->fAttachmentId,
						'cell'=>array(CHtml::encode($model->fAttachmentId).(Yii::app()->user->checkAccess('Item.attachment.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fAttachmentId),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fAttachmentId),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('Item.attachment.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fAttachmentId),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fTaskNo),
		 CHtml::encode($model->fResultNo),
		 CHtml::encode($model->fDocumentNo),
		 CHtml::encode($model->fKnowledgeNo),
		 CHtml::encode($model->fCatalogueNo),
		 CHtml::encode($model->fAttachmentName),
		 CHtml::encode($model->fAttachmentFalseName),
		 CHtml::encode($model->fDownloadNum),
		 CHtml::encode($model->fViewNum),
		 CHtml::encode($model->fVersion),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode($model->fCreateDate),
		 CHtml::encode($model->fUpdateUser),
		 CHtml::encode($model->fUpdateDate),
            ));
        }
        UFSBaseUtil::printJson($data);
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Attachment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='attachment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * 下载附件
	 */
    public function actionDownload(){
    	$id=isset($_POST['id'])?$_POST['id']:'';
    	$transaction = Yii::app()->db->beginTransaction();
    	try {
    		$this->Download($id);
    		//事务提交
    		$transaction->commit();
    		echo '';
    		//提交事务会真正的执行数据库操作
    	} catch (Exception $e) {
    		$transaction->rollback(); //如果操作失败, 数据回滚
    	}
    }
    public function actionDown(){
    	$model=new Attachment();
    	if(isset($_POST['number'])){
    		$id=isset($_GET['id'])?$_GET['id']:'';
    		if($_POST['number']=='123456'){
    			$transaction = Yii::app()->db->beginTransaction();
    			try {
    				echo '<script>parent.$(\'.UFSGrid-row-download\').colorbox.close(\'保存成功\');</script>';
    				$this->Download($id);
    				//事务提交
    				$transaction->commit();
    				//提交事务会真正的执行数据库操作
    			} catch (Exception $e) {
    				$transaction->rollback(); //如果操作失败, 数据回滚
    			}
    		}
    		else 
    			print_r('请输入:123456');
    	}
    	$msg=new Msgto();
    	$msg->fSendToNo=GuidUtil::getUuid();
    	$msg->fSendFromNo=Yii::app()->params->loginuser->fUserName;
    	$msg->fSendToUserNo=Yii::app()->params->loginuser->fUserID;
    	$msg->fSendToAccount=Yii::app()->params->loginuser->fEmail;
    	$msg->fSendToName=Yii::app()->params->loginuser->fUserName;
    	$msg->fSendMsgStatus='Msg_NoRead';
    	$msg->fSendUserNo=Yii::app()->params->loginuser->fUserID;
    	$msg->fSendFromName=Yii::app()->params->loginuser->fUserName;
    	$msg->fSendFromDate=time();
    	$msg->fSendFromModule='Msg_Item';
    	$msg->fSendFromType='Msg_Inner';
    	$msg->fSendFromTheme=Yii::app()->params['msg']['phone']['theme'];
    	$msg->fSendFromContent=sprintf(Yii::app()->params['msg']['phone']['content'],time());
    	$msg->fSendToAllUserNo=Yii::app()->params->loginuser->fUserID;
    	$msg->fSendToAllAccount=Yii::app()->params->loginuser->fEmail;
    	$msg->fSendToAllName=Yii::app()->params->loginuser->fUserName;
    	$msg->save();
    	$this->render('down',array(
    	'model'=>$model,
    			'keyid'=>isset($_POST['id'])?$_POST['id']:'',
    	));
    }
}
