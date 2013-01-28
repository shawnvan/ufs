<?php
class TempletCommon extends AdminCommon {
	/**
	 * 获得对应项目的尽职调查目录结构,包括禁止使用的目录
	 * @param varchar $id the id of item
	 */
	public function GetTempletCatalogue($id,$method=null){
		$models=Templatecatalogue::model()->findAll('fTemplateNo=:fTemplateNo or fTemplateNo=\'\'',array(':fTemplateNo'=>$id));
		$dataNode = array();
		 switch ($method){
			case 'standtask' :
				foreach ($models as $key=>$model){
				if($model->fCatalogueNo=='999')	$dataNode[]=array(
						'id'=>CHtml::encode($model->fCatalogueNo),
						'name'=>CHtml::encode($model->fCatalogueName),
						'pId'=>CHtml::encode($model->fFatherCatalogueNo));
					else 
				$dataNode[]=array(
						'id'=>CHtml::encode($model->fCatalogueNo),
						'name'=>CHtml::encode($model->fCatalogueName.'('.$model->fStandardtaskNum.')'),
						'pId'=>CHtml::encode($model->fFatherCatalogueNo));
			   };
				break;
			default:
				foreach ($models as $key=>$model){
				$dataNode[]=array(
						'id'=>CHtml::encode($model->fCatalogueNo),
						'name'=>CHtml::encode($model->fCatalogueName),
						'pId'=>CHtml::encode($model->fFatherCatalogueNo));
			   };
				break;
		} 
		
		return $dataNode;
	}
}

?>