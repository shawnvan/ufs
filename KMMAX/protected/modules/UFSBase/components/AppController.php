<?php

/**
 * Class of parent Controller for Backend of GXC CMS, extends from RController
 * 
 * 
 * @author Kernel <598049390@qq.com>
 * @version 1.0
 * @package app.components
 */

class AppController extends RController
{
                
    public $layout='//layouts/column1';
    public $breadcrumbs = array();
	public $menu = array();
	public $actionMenu = array();
	
	public $data = array();
	
    public function __construct($id,$module=null)
	{
	      parent::__construct($id,$module);
	}
       
     /**
     * Filter by using Modules Rights
     * 
     * @return type 
     */
    public function filters()
    {
           return array(
               'rights',
           );
    }
       
    /**
     * List of allowd default Actions for the user
     * @return type 
     */
    public function allowedActions()
    {           
    // print_r(Yii::app()->user->getId());exit;

        return 'login,logout';
    }
    /**
     * Returns jqGrid searching keyword formula array.
     * @return array
     */
    public function getJqGridKeywordFormulaArray()
    {
        return array(
            'eq'=>'keyword',
            'ne'=>'keyword',
            'lt'=>'keyword',
            'le'=>'keyword',
            'gt'=>'keyword',
            'ge'=>'keyword',
            'bw'=>'keyword%',
            'bn'=>'keyword%',
            'in'=>'%keyword%', //'keyword'
            'ni'=>'%keyword%', //'keyword'
            'ew'=>'%keyword',
            'en'=>'%keyword',
            'cn'=>'%keyword%',
            'nc'=>'%keyword%',
        );
    }

    /**
     * Returns jqGrid searching operation array.
     * @return array
     */
    public function getJqGridOperationArray()
    {
        return array(
            'eq'=>'=',
            'ne'=>'!=',
            'lt'=>'<',
            'le'=>'<=',
            'gt'=>'>',
            'ge'=>'>=',
            'bw'=>'LIKE',
            'bn'=>'NOT LIKE',
            'in'=>'LIKE', //'IS IN'
            'ni'=>'NOT LIKE', //'IS NOT IN'
            'ew'=>'LIKE',
            'en'=>'NOT LIKE',
            'cn'=>'LIKE',
            'nc'=>'NOT LIKE',
        );
    }

    /**
     * Process jqGrid request. jqGrid is specifying query details using the POST request.
     * page - page number
     * rows - page size
     * sidx - field to sort by
     * sord - sorting direction (asc or desc)
     * searchField - field to search by (optional)
     * searchString - string to search for (optional)
     * searchOper - search operation (optional)
     * @return array
     */
    public function processJqGridRequest()
    {
        // create a bridge between jqGrid and Yii
        
        $jqGrid['page']=(isset($_POST['page']) && ctype_digit($_POST['page']) && $_POST['page']>=1) ? $_POST['page'] : null;

        $jqGrid['pageSize']=(isset($_POST['rows']) && ctype_digit($_POST['rows']) && $_POST['rows']>=1 && $_POST['rows']<=500) ? $_POST['rows'] : null;
        $jqGrid['sort']=isset($_POST['sidx']) ? $_POST['sidx'] : null;
        if($jqGrid['sort']!==null && isset($_POST['sord']) && $_POST['sord']==='desc')
            $jqGrid['sort'].='.desc';
        $jqGrid['filters']=isset($_POST['filters']) ? $_POST['filters'] : null;
        $jqGrid['searchField']=isset($_POST['searchField']) ? $_POST['searchField'] : null;
        $jqGrid['searchString']=isset($_POST['searchString']) ? $_POST['searchString'] : null;
        $jqGrid['searchOper']=isset($_POST['searchOper']) ? $_POST['searchOper'] : null;
        // port the jqGrid request parameters to the regular Yii variables
        if($jqGrid['page']!==null)
            $_GET['page']=$jqGrid['page'];
        if($jqGrid['sort']!==null)
            $_GET['sort']=$jqGrid['sort'];
        return $jqGrid;
    }

    /**
     * Print out the data in the json format and exit.
     * @param array of data
     */
    public function printJsonExit($data)
    {
        $this->printJson($data);
        exit;
    }
    /**
     * 操作JqGrid查询.
     * @param array of data
     */
    public function JqGridSearach($filters)
    {
    	$where='';
    	if(!empty($filters->groupOp) && (!empty($filters->rules))){
    		$operation=$this->getJqGridOperationArray();
    		$keywordFormula=$this->getJqGridKeywordFormulaArray();
    		foreach($filters->rules as $temp){
    			$condition='';
    	
    			if(empty($where)){
    				$where=$temp->field.$operation[$temp->op].str_replace('keyword',$temp->data,$keywordFormula[$temp->op]);
    			}else
    			$where=$where.' '.$filters->groupOp.' '.$temp->field.$operation[$temp->op].str_replace('keyword',$temp->data,$keywordFormula[$temp->op]);
    			
    		}
    	}
    	print_r($where);
    	return $where;
    }	
}