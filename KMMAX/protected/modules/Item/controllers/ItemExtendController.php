<?php
interface I_ItemCommonMethod
{
	/**
	 * 获得对应项目的尽职调查目录结构
	 * @param varchar $id the id of item
	 */
	public function GetItemCatalogue($id);
	
}