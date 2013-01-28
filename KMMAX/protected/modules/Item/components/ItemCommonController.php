<?php

class ItemCommonController implements I_ItemCommonMethod
{
	/**
	 * 获得对应项目的尽职调查目录结构
	 * @param varchar $id the id of item
	 */
	public function AdminGetItemCatalogue($id){
		$catalogue=Itemcatalogue::model()->with('itemcatalogue')->findAllByAttributes(array('fItemNo'=>$id));
	
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
	 * 获得对应项目的尽职调查目录结构
	 * @param varchar $id the id of item
	 */
	public function GetItemCatalogue($id){
		$catalogue=Itemcatalogue::model()->with('itemcatalogue')->findAllByAttributes(array('fItemNo'=>$id));
	
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
	 * 获得对应项目的尽职调查目录结构
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
	 * 获得对应项目的尽职调查目录结构
	 * @param varchar $id the id of item
	 */
	public function GetKnowledgeCatalogue($action=null){
		$criteria=new CDbCriteria;
		if($action!='admin'){
			$criteria->addCondition("fStatus = :fStatus");
		    $criteria->params[':fStatus']='IsActive';
		}
		$catalogue=Knowledgecatalogue::model()->findAll($criteria);
		$dataNode = array();
		foreach ($catalogue as $key=>$model){
			$dataNode[]=array(
					'id'=>CHtml::encode($model->fCatalogueNo),
					'name'=>CHtml::encode($model->fCatalogueName),
					'pId'=>CHtml::encode($model->fFatherCatalogueNo));
				
		};
		return $dataNode;
	}
}