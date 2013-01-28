<?php

class KmMax extends AppController
{
	/**
	 * 上传文件
	 */
	public function SaveuploadFile($model){
		$attach=new Attachment();
		$upload= new UploadFile();
		$upload->thumbMaxWidth = '100';
		$upload->thumbMaxHeight= '100';
		$upload->autoSub    = true;
		$upload->subType    = '';
		$upload->dateFormat = 'Y/d/';
		$upload->saveRule   = time() + rand(1000,9999);
		$upload->allowExts  = array('jpg','gif','doc','txt','png','doc','txt','xls','docx','ppt','pdf','xlsx');
		$upload->savePath=Yii::app()->params['upload_path_all'];
		if(!$upload->upload($upload->savePath)) { // 上传错误 提示错误信息
			print_r($upload->error($upload->getErrorMsg()));return $attach;
		}else{ // 上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo();
		}
		$attach->fAttachmentId=GuidUtil::getUuid();
		$attach->fTaskNo=$model->fTaskNo;
		$attach->fCatalogueNo=$model->fCatalogueNo;
		$attach->fCreateUser=Yii::app()->params->loginuser->fUserName;
		$attach->fCreateDate=time();
		if(is_array($info)) {
			$keys = array_keys($info);
			$count	= count($keys);
			for ($i=0; $i<$count; $i++) {
				$attach->fAttachmentName=$info[$i]['name'];
				$attach->fAttachmentFalseName=$info[$i]['savename'];
				$attach->save();
			}
		}
		return $attach;
	}
	/**
	 * 下载附件
	 */
	public function Download($id){
		$model=Attachment::model()->findByPk($id);
		if($model==null) return;
			$model->fDownloadNum=$model->fDownloadNum+1;
			$model->save();
			$download=new Downloadattach();
			$download->fDownNo=GuidUtil::getUuid();
			$download->fAttachmentNo=$id;
			$download->fDownUser=Yii::app()->params->loginuser->fUserName;
			$download->fDownDate=time();
			$download->save();
			$testfilename=$model->fAttachmentFalseName;
			$myfile = Yii::app()->cfile->set(Yii::app()->params['uploadPath'].$testfilename, true);
			//$myfile->permissions=777;
			if ($testfilename!='' && $myfile->exists){
				$myfile->download($model->fAttachmentName, true);
			}else print_r('file isnot exists');
	}
	/**
	 * 下载附件
	 */
	public function FrameInfo($layout,$text,$type){
		return '<script type="text/javascript">generate(\''.$layout.'\',\''.$text.'\',\''.$type.'\');</script>';
	}
}
