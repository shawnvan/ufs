<?php

class SettingsController extends AppController
{
    public function actionIndex(){
        $criteria = new CDbCriteria();
		$criteria->addCondition('fModule=:fModule');
		$criteria->addCondition('fVisible=:fVisible');
		//为搜索字段赋值
		$criteria->params =array(
						':fVisible'=>'1',
						':fModule'=>'',//Support
						);
        $criteria->order = 'fGroupName, fSequence';
        $this->data['params'] = Settings::model()->findAll($criteria);
        $this->data['module'] = '';
		//print_r($this->data);    
        $this->render('Settings', $this->data);    
    }
    public function actionSave(){
        $module = $this->post('fModule', '');
        if ($this->IsPostBack){
            $this->message = 'Your new configuration is updated successfully.';
            foreach($_POST as $key => $value){
                $param = Settings::model()->find('Name = :Param AND fModule = :fModule',array(':Param' => $key, ':fModule' => $module));
                if (is_null($param)) continue;
                $param->Value = $value;
                if (!$param->validate()){
                    ErrorHandler::logError($param->getError('Value'));
                    $this->message = '';
                }else
                    $param->save();
            }                              
            foreach($_FILES as $key => $file){
                if ($file['error'] == UPLOAD_ERR_NO_FILE) continue;
                $param = Settings::model()->find('Name = :Param',array(':Param' => $key));
                if (is_null($param)) continue; 
                $param->Value = $file;
                if (!$param->validate()){
                    ErrorHandler::logError($param->getError('Value'));
                    $this->message = '';
                }else
                    $param->save();
            }
            Cms::service('Cms/Settings/db2php', array('fModule' => $module));
        }
        $params = array();
        if ($module)
            $params = array('module' => $module);
        $this->redirect($this->createUrl("admin/settings", $params));    
    }
    public function __construct($id, $module = null){
        parent::__construct($id, $module);
        Yii::app()->layout = 'module';        
    }
    public function actionList()
    {
   	   
        if (isset($_POST['module']))
        {
            $module = $_POST['module'];
        }else{
        	 $module = '';	        
        }
        if ($module == 'System' || $module == 'gii')
        {
            $module = '';
        }
        
        $criteria = new CDbCriteria();
        $criteria->condition .= " fModule = :fModule";
        $criteria->order = 'fGroupName, fSequence';
        $criteria->params = array(':fModule' => $module);
        $params = Settings::model()->findAll($criteria);

        if ($module == '')
        {
            $module = 'System';
        }
        $tmp = array();
        foreach($params as $p)
        {
            $key = 'Ungroupped';
            if (! empty($p->fGroupName)) $key = $p->fGroupName;
            $tmp[$key][] = $p;
        }
        $params = $tmp;
        $sql = "
                SELECT DISTINCT fModule 
                FROM tbl_settings 
                ORDER BY fModule
                ";
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql);
        $modules = $command->queryAll();

        $this->render('List', array(
                                'params' => $params,
                                'module' => $module,
                                'modules' => $modules,
                                ));
    }
    public function actionCreate()
    {
    	
        $param = new Settings();
      
        $modules = array();
      
        $tmp = array_keys(Yii::app()->modules);

        sort($tmp);
    	foreach($tmp as $k=>$m)
        {
            $modules[$m] = $m;
        }
        $removekey = array_search('gii',$modules);
        unset($modules[$removekey]);//删除数组中指定的值
       
        $modules['System'] = 'System';
        $this->render('Edit', array(
                                'param' => $param,
                                'modules' => $modules
                                ));
    }
    public function actionEdit()
    {
        $module = $name = '';
        if ($this->get('fModule', '') != '')
        {
            $module = $this->get('fModule');
        }
        if ($this->get('fName', '') != '')
        {
            $name = $this->get('fName');
        }
        $param = Settings::model()->findByPk(array('fModule' => $module, 'fName' => $name));
        if (empty($param))
        {
            throw new CHttpException(404, 'Parameter no found');
        }
        if ($param->fModule == '') $param->fModule = 'System';
        $modules = array();
        $tmp = array_keys(Yii::app()->modules);
        sort($tmp);
        foreach($tmp as $m)
        {
            $modules[]['Name'] = $m;
        }
       
        $modules['System']['Name'] = 'System';
        $this->render('Edit', array(
                                'param' => $param,
                                'modules' => $modules,
                                'action' => 'updateParam',
                                ));
    }
    public function actionUpdateParam()
    {
        if ($this->IsPostBack)
        {
            $result = Cms::service('Cms/Settings/update', $_POST);
            if ($result->ReturnCode == ServiceResult::RETURN_SUCCESS)
            {
                $this->message = Yii::t('Parameter', 'PARAMETER_UPDATE_SUCCESSFUL');
            }
            Cms::service('settings/settings/rebuildCache',array());
            $this->redirect($this->createUrl('/BackOffice/admin/settings/list'));
        }
    }
    public function actionSaveNewParam()
    {
		$result = Cms::service('settings/settings/Create', $_POST);
		Cms::service('settings/settings/RebuildCache',array());
		$this->redirect($this->createUrl('/settings/settings/list'));
    }
    public function actionRebuildCache()
    {
        $result = Cms::service('settings/settings/rebuildCache',array());
        //$this->message = 'Cache is updated for pages, categories, system and all modules settings.';
        $this->redirect($this->createUrl('/home/defaule/dashboard', array('module' => 'home')));
    }

	/**
     * Grid of all models.
     */
    public function actionGrid()
    {
 		$criteria=new CDbCriteria;
        //$criteria->condition .= " fModule = :fModule";
        //$criteria->order = 'fGroupName, fSequence';
        //$criteria->params = array(':fModule' => $module);

        $pages=new CPagination(Settings::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Settings');//排序，参考YII文档CSort
        $sort->attributes=array(
            'fName'=>array('asc'=>"fName",'desc'=>"fName desc",'label'=>Settings::model()->getAttributeLabel('fName')),
            'fLabel'=>array('asc'=>"fLabel",'desc'=>"fLabel desc",'label'=>Settings::model()->getAttributeLabel('fLabel')),
            'fValue'=>array('asc'=>"fValue",'desc'=>"fValue desc",'label'=>Settings::model()->getAttributeLabel('fValue')),
            'fGroupName'=>array('asc'=>"fGroupName",'desc'=>"fGroupName desc",'label'=>Settings::model()->getAttributeLabel('fGroupName')),
        );
        $sort->defaultOrder="fName";
        $sort->applyOrder($criteria);
        // find all
		
        $models=Settings::model()->findAll($criteria);
		
        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
                array(
                    'content'=>CHtml::encode($model->fName),
                ),
                array(
                    'content'=>CHtml::encode($model->fLabel),
                ),
                array(
                    'content'=>CHtml::encode($model->fValue),
                ),
                array(
                    'content'=>CHtml::encode($model->fGroupName),
                ),
            );
        }	
		$model=new Settings;
		//$model->unsetAttributes();  // clear any default values
        // render the view file
        $this->render('grid',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,
        ));
    }


    /**
     * Print out array of models for the jqGrid rows.
     */
    public function actionGridData()
    {  	
        // specify request details
        $jqGrid=$this->processJqGridRequest();
        $criteria=new CDbCriteria;

        if($jqGrid['searchField']!==null && $jqGrid['searchString']!==null && $jqGrid['searchOper']!==null)
        {
            $field=array(
				'fName'=>Settings::model()->getAttributeLabel('fName'),
				'fGroupName'=>Settings::model()->getAttributeLabel('fGroupName'),
				'fLabel'=>Settings::model()->getAttributeLabel('fLabel'),
				'fValue'=>Settings::model()->getAttributeLabel('fValue'),
            );
			
            $operation=$this->getJqGridOperationArray();
			
            $keywordFormula=$this->getJqGridKeywordFormulaArray();
			
            if(isset($field[$jqGrid['searchField']]) && isset($operation[$jqGrid['searchOper']]))
            {
                $criteria->condition='('.$field[$jqGrid['searchField']].' '.$operation[$jqGrid['searchOper']].' :keyword)';
                $criteria->params=array(':keyword'=>str_replace('keyword',$jqGrid['searchString'],$keywordFormula[$jqGrid['searchOper']]));
                // search by special field types
                if($jqGrid['searchField']==='createTime' && ($keyword=strtotime($jqGrid['searchString']))!==false)
                {
                    $criteria->params=array(':keyword'=>str_replace('keyword',$keyword,$keywordFormula[$jqGrid['searchOper']]));
                    if(date('H:i:s',$keyword)==='00:00:00')
                        // visitor is looking for a precision by day, not by second
                        $criteria->condition='(TO_DAYS(FROM_UNIXTIME('.$field[$jqGrid['searchField']].',"%Y-%m-%d")) '.$operation[$jqGrid['searchOper']].' TO_DAYS(FROM_UNIXTIME(:keyword,"%Y-%m-%d")))';
                }
            }
        }

		// pagination
        
		$pages=new CPagination(Settings::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Settings');
		
        $sort->attributes=array(
            'fName'=>array('asc'=>"fName",'desc'=>"fName desc",'label'=>Settings::model()->getAttributeLabel('fName')),
            'fLabel'=>array('asc'=>"fLabel",'desc'=>"fLabel desc",'label'=>Settings::model()->getAttributeLabel('fLabel')),
            'fValue'=>array('asc'=>"fValue",'desc'=>"fValue desc",'label'=>Settings::model()->getAttributeLabel('fValue')),
            'fGroupName'=>array('asc'=>"fGroupName",'desc'=>"fGroupName desc",'label'=>Settings::model()->getAttributeLabel('fGroupName')),
        );
        $sort->defaultOrder="fName";
        $sort->applyOrder($criteria);
        // find all
        $models=Settings::model()->findAll($criteria);
        // create resulting data array
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
			
        foreach($models as $model)
        {
            $data['rows'][]=array('fName'=>$model->fName,'cell'=>array(
				CHtml::encode($model->fName).CHtml::link('<span class="ui-icon ui-icon-zoomin"></span>',array('view','id'=>$model->fName),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'show'
                )).
                CHtml::link('<span class="ui-icon ui-icon-pencil"></span>',array('update','id'=>$model->fLabel),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'edit'
                )),
				CHtml::encode($model->fLabel),
                CHtml::encode($model->fValue),
				CHtml::encode($model->fGroupName),
            ));
        }
        UFSBaseUtil::printJson($data);
    }

	
}

?>
