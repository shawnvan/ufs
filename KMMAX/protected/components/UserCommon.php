<?php

class UserCommon extends KmMax
{	
   /**
	 * 获得对应项目的尽职调查目录结构,包括禁止使用的目录
	 * @param varchar $id the id of item
	 */
	public function GetOrg(){
		$moldes=Companyorganisation::model()->findAll();
		$dataNode = array();
		foreach ($moldes as $key=>$model){
			$dataNode[]=array(
					'id'=>CHtml::encode($model->fOrgNo),
					'name'=>CHtml::encode($model->fOrgName),
					'pId'=>CHtml::encode($model->fUpOrgNo));
		};
		return $dataNode;
	}
}
