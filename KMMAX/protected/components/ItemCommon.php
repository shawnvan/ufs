<?php

class ItemCommon extends KmMax
{
	/**
	 * 获得项目编号
	 */
	public function GetItemNo(){
		return isset($_GET['id'])?$_GET['id']:'';
	}
	/**
	 * 获得项目
	 */
	public function GetItem(){
		return Item::model()->findByPk($this->GetItemNo());
	}
	/**
	 * 获得对应项目的尽职调查目录结构,包括禁止使用的目录
	 * @param varchar $id the id of item
	 */
	public function GetItemCatalogue($id,$method=null){
		if(empty($id)) return;
		$catalogue=Itemcatalogue::model()->with('itemcatalogue')->findAllByAttributes(array('fItemNo'=>$id));
		$dataNode = array();
		if($method=='task'){
			foreach ($catalogue as $key=>$model){
				$dataNode[]=array(
						'id'=>CHtml::encode($model->fCatalogueNo),
						'name'=>CHtml::encode(empty($model->fCatalogueName)?$model->itemcatalogue->fCatalogueName.'('.$model->fWaitFinishingNum.'-'.$model->fFinishedNum.')':$model->fCatalogueName),
						'pId'=>CHtml::encode($model->fFatherCatalogueNo));
			};
		}else if($method=='result'){
			foreach ($catalogue as $key=>$model){
				$dataNode[]=array(
						'id'=>CHtml::encode($model->fCatalogueNo),
						'name'=>CHtml::encode(empty($model->fCatalogueName)?$model->itemcatalogue->fCatalogueName.'('.$model->fResultNum.')':$model->fCatalogueName),
						'pId'=>CHtml::encode($model->fFatherCatalogueNo));
			};
		}else if($method=='document'){
			foreach ($catalogue as $key=>$model){
				$dataNode[]=array(
						'id'=>CHtml::encode($model->fCatalogueNo),
						'name'=>CHtml::encode(empty($model->fCatalogueName)?$model->itemcatalogue->fCatalogueName.'('.$model->fDocumentNum.')':$model->fCatalogueName),
						'pId'=>CHtml::encode($model->fFatherCatalogueNo));
			};
		}else if($method=='sub'){
			foreach ($catalogue as $key=>$model){
				if($model->fIsActive!='IsActive') continue;
				$executoruser=empty($model->fExecutorUser)?'无负责人':$model->fExecutorUser;
				$dataNode[]=array(
						'id'=>CHtml::encode($model->fCatalogueNo),
						'name'=>CHtml::encode(empty($model->fCatalogueName)?$model->itemcatalogue->fCatalogueName.'('.$executoruser.')':$model->fCatalogueName),
						'pId'=>CHtml::encode($model->fFatherCatalogueNo));
			};
		}
		else{
			foreach ($catalogue as $key=>$model){
				$dataNode[]=array(
						'id'=>CHtml::encode($model->fCatalogueNo),
						'name'=>CHtml::encode(empty($model->fCatalogueName)?$model->itemcatalogue->fCatalogueName.'('.$model->fTaskNum.'-'.$model->fResultNum.'-'.$model->fDocumentNum.')':$model->fCatalogueName),
						'pId'=>CHtml::encode($model->fFatherCatalogueNo));
			};
		}
		return $dataNode;
	}
	/**
	 * 获得对应项目的尽职调查目录结构,不包括禁止使用的目录
	 * @param varchar $id the id of item
	 */
	public function GetSubItemCatalogue($id){
		$catalogue=Itemcatalogue::model()->with('itemcatalogue')->findAllByAttributes(array('fItemNo'=>$id,'fIsActive'=>'IsActive'));
	
		$dataNode = array();
		foreach ($catalogue as $key=>$model){
			$dataNode[]=array(
					'id'=>CHtml::encode($model->fCatalogueNo),
					'name'=>CHtml::encode($model->itemcatalogue->fCatalogueName),
					'pId'=>CHtml::encode($model->fFatherCatalogueNo));
		};
	
		return $dataNode;
	}
	/**
	 * 发送内部消息
	 * @param varchar $id the id of item
	 */
	public function SendInnerMsg($user,$newmsg){
		$msg=new Msgto();
		$msg->fSendToNo=GuidUtil::getUuid();
		$msg->fSendFromNo=Yii::app()->params->loginuser->fUserName;
		$msg->fSendToUserNo=$user->fUserID;
		$msg->fSendToAccount=$user->fEmail;
		$msg->fSendToName=$user->fUserName;
		$msg->fSendMsgStatus='Msg_NoRead';
		$msg->fSendUserNo=Yii::app()->params->loginuser->fUserID;
		$msg->fSendFromName=$user->fUserName;
		$msg->fSendFromDate=time();
		$msg->fSendFromModule='Msg_Item';
		$msg->fSendFromType='Msg_Inner';
		$msg->fSendFromTheme=Yii::app()->params['item']['init']['theme'];
		$msg->fSendFromContent=sprintf(Yii::app()->params['item']['init']['content'],$model->fItemName);
		$msg->fSendToAllUserNo=$user->fUserID;
		$msg->fSendToAllAccount=$user->fEmail;
		$msg->fSendToAllName=$user->fUserName;
		$msg->fRemark1='';
		$msg->fRemark2='';
		$msg->fRemark3='';
		$msg->save();
	}
	
}
