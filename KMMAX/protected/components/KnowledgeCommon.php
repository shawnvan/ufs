<?php

class KnowledgeCommon extends KmMax
{
	/**
	 * 目录结构新增
	 */
	public function InsertKnowledgeCatalogue($CatalogueNo){
		$tempCatalogue=Templatecatalogue::model()->findByAttributes(array('fCatalogueNo'=>$CatalogueNo));
		$knowledgeCatalogue=Knowledgecatalogue::model()->findByPk($CatalogueNo);
		if(empty($knowledgeCatalogue)){
			$this->InsertKnowledgeCatalogue($tempCatalogue->fFatherCatalogueNo);
			$insertCatalogue=new Knowledgecatalogue();
			$insertCatalogue->fCatalogueNo=$tempCatalogue->fCatalogueNo;
			$insertCatalogue->fCatalogueName=$tempCatalogue->fCatalogueName;
			$insertCatalogue->fFatherCatalogueNo=$tempCatalogue->fFatherCatalogueNo;
			$insertCatalogue->fStatus='Knowledge_Temp';
			$insertCatalogue->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$insertCatalogue->fCreateDate=time();
			$insertCatalogue->save();
		}
	}
	/**
	 * 同意申请的时候，同步更新节点
	 */
	public function UpdateKnowledgeCatalogue($CatalogueNo){
		$knowledgeCatalogue=Knowledgecatalogue::model()->findByAttributes(array('fCatalogueNo'=>$CatalogueNo));
		if(empty($knowledgeCatalogue)) return;
		if($knowledgeCatalogue->fCatalogueNo!='999' && $knowledgeCatalogue->fStatus=='Knowledge_Temp'){
			$knowledgeCatalogue->fStatus='IsActive';
			$knowledgeCatalogue->save();
			$this->UpdateKnowledgeCatalogue($knowledgeCatalogue->fFatherCatalogueNo);
		}
	}
	/**
	 * 拒绝申请的时候，同步删除临时节点
	 */
	public function DeleteKnowledgeCatalogue($CatalogueNo){
		$knowledgeCatalogue=Knowledgecatalogue::model()->findByAttributes(array('fCatalogueNo'=>$CatalogueNo));
		$fatherCatalogueNo=$knowledgeCatalogue->fFatherCatalogueNo;
		if($knowledgeCatalogue->fCatalogueNo!='999' && $knowledgeCatalogue->fStatus=='Knowledge_Temp'){
			Knowledgecatalogue::model()->deleteAllByAttributes(array('fStatus'=>'Knowledge_Temp','fCatalogueNo'=>$CatalogueNo));
			$this->DeleteKnowledgeCatalogue($fatherCatalogueNo);
		}
	}
}
