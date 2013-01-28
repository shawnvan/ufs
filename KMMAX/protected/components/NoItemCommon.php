<?php

class ItemCommon extends KmMax
{
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
}
