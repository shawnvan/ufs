<?php

class catalogueImp implements icatalogue
{
	public function findcataloguename($id){
		
		$itemcatalogue=Templatecatalogue::model()->findByPk($id);
		return $itemcatalogue->fCatalogueName;
	}
}