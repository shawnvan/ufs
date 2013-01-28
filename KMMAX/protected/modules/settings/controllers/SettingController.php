<?php

class SettingController extends AppController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'keyid'=>$id
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model = new Settings();
      
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
        
        if(isset($_POST['Settings']))
        {
        	
        	$model->attributes=$_POST['Settings'];
        	
        	if($model->save()){
        		$result = Cms::service('settings/setting/Create', $_POST);
        		Cms::service('settings/setting/RebuildCache',array());
        		$this->redirect(array('view','id'=>$model->fName));
        	}
        }
        
        $this->render('create', array(
                                'model' => $model,
                                'modules' => $modules
                                ));
	}

	public function actionRebuildCache()
	{
		$result = Cms::service('settings/setting/rebuildCache',array());
		//$this->message = 'Cache is updated for pages, categories, system and all modules settings.';
		$this->redirect($this->createUrl('/home/defaule/dashboard', array('module' => 'home')));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Settings']))
		{
			
			$model->attributes=$_POST['Settings'];
			
			if($model->save()){
				
				$result = Cms::service('settings/setting/Create', $_POST);
				Cms::service('settings/setting/RebuildCache',array());
				$this->redirect(array('view','id'=>$model->fName));
		
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'keyid'=>$id
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionCopy()
	{


		$id=$_GET['id'];
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Settings']))
		{
			$createmodel=new Settings;
			$createmodel->attributes=$_POST['Settings'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fName));
		}

		$this->render('copy',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Settings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Settings']))
			$model->attributes=$_GET['Settings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
     * Grid of all models.
     */
    public function actionIndex()
    {
		$criteria=new CDbCriteria;

        $pages=new CPagination(Settings::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Settings');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fName'=>array('asc'=>'fName','desc'=>'fName desc','label'=>Settings::model()->getAttributeLabel('fName')),
		'fLabel'=>array('asc'=>'fLabel','desc'=>'fLabel desc','label'=>Settings::model()->getAttributeLabel('fLabel')),
		'fValue'=>array('asc'=>'fValue','desc'=>'fValue desc','label'=>Settings::model()->getAttributeLabel('fValue')),
		'fDescription'=>array('asc'=>'fDescription','desc'=>'fDescription desc','label'=>Settings::model()->getAttributeLabel('fDescription')),
		'fGroupName'=>array('asc'=>'fGroupName','desc'=>'fGroupName desc','label'=>Settings::model()->getAttributeLabel('fGroupName')),
		'fSequence'=>array('asc'=>'fSequence','desc'=>'fSequence desc','label'=>Settings::model()->getAttributeLabel('fSequence')),
		/*
		'fIsActive'=>array('asc'=>'fIsActive','desc'=>'fIsActive desc','label'=>Settings::model()->getAttributeLabel('fIsActive')),
		'fModule'=>array('asc'=>'fModule','desc'=>'fModule desc','label'=>Settings::model()->getAttributeLabel('fModule')),
		*/'fModule'=>array('asc'=>'fModule','desc'=>'fModule desc','label'=>Settings::model()->getAttributeLabel('fModule')),
        );
        $sort->defaultOrder='fName';
        $sort->applyOrder($criteria);

        // find all
        $models=Settings::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fName)),
		 array('content'=>CHtml::encode($model->fLabel)),
		 array('content'=>CHtml::encode($model->fValue)),
		 array('content'=>CHtml::encode($model->fDescription)),
		 array('content'=>CHtml::encode($model->fGroupName)),
		 array('content'=>CHtml::encode($model->fSequence)),
		/*
		 array('content'=>CHtml::encode($model->fIsActive)),
		 array('content'=>CHtml::encode($model->fModule)),
		*/
            );
        }	
		
		$model=new Settings;
		$model->unsetAttributes();  // clear any default values

        // render the view file
        $this->render('index',array(
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
        if(!Yii::app()->request->isPostRequest)
        {
            throw new CHttpException(400,Yii::t('http','Invalid request. Please do not repeat this request again.'));
            exit;
        }
        // specify request details
        $jqGrid=$this->processJqGridRequest();
        $criteria=new CDbCriteria;

		if(isset($_GET['type'])){
			//用户所有未作输入的字段（类型checkbox不处理）设置为NULL
			if(trim($_GET['fUser'])==''){$_GET['fUser'] =NULL;}
			if(trim($_GET['fUserName'])==''){$_GET['fUserName'] =NULL;}
			//添加搜索条件
			$criteria->addCondition('(fUser=:fUser OR :fUser IS NULL)');
			$criteria->addCondition('(fUserName=:fUserName OR :fUserName IS NULL)');
			$criteria->addCondition('fIsActive=:fIsActive');
			//为搜索字段赋值
			$criteria->params =array(
							':fUser'=>$_GET['fUser'],
							':fUserName'=>$_GET['fUserName'],
							':fIsActive'=>$_GET['fIsActive'],
							);
							
		}

        if($jqGrid['searchField']!==null && $jqGrid['searchString']!==null && $jqGrid['searchOper']!==null)
        {
            $field=array(
						'fName'=>Settings::model()->getAttributeLabel('fName'),
		'fLabel'=>Settings::model()->getAttributeLabel('fLabel'),
		'fValue'=>Settings::model()->getAttributeLabel('fValue'),
		'fDescription'=>Settings::model()->getAttributeLabel('fDescription'),
		'fGroupName'=>Settings::model()->getAttributeLabel('fGroupName'),
		'fSequence'=>Settings::model()->getAttributeLabel('fSequence'),
		/*
		'fIsActive'=>Settings::model()->getAttributeLabel('fIsActive'),
		'fModule'=>Settings::model()->getAttributeLabel('fModule'),
		*/'fModule'=>array('asc'=>'fModule','desc'=>'fModule desc','label'=>Settings::model()->getAttributeLabel('fModule')),
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
           		'fName'=>array('asc'=>'fName','desc'=>'fName desc','label'=>Settings::model()->getAttributeLabel('fName')),
		'fLabel'=>array('asc'=>'fLabel','desc'=>'fLabel desc','label'=>Settings::model()->getAttributeLabel('fLabel')),
		'fValue'=>array('asc'=>'fValue','desc'=>'fValue desc','label'=>Settings::model()->getAttributeLabel('fValue')),
		'fDescription'=>array('asc'=>'fDescription','desc'=>'fDescription desc','label'=>Settings::model()->getAttributeLabel('fDescription')),
		'fGroupName'=>array('asc'=>'fGroupName','desc'=>'fGroupName desc','label'=>Settings::model()->getAttributeLabel('fGroupName')),
		'fSequence'=>array('asc'=>'fSequence','desc'=>'fSequence desc','label'=>Settings::model()->getAttributeLabel('fSequence')),
		/*
		'fIsActive'=>array('asc'=>'fIsActive','desc'=>'fIsActive desc','label'=>Settings::model()->getAttributeLabel('fIsActive')),
		'fModule'=>array('asc'=>'fModule','desc'=>'fModule desc','label'=>Settings::model()->getAttributeLabel('fModule')),
		*/'fModule'=>array('asc'=>'fModule','desc'=>'fModule desc','label'=>Settings::model()->getAttributeLabel('fModule')),
        );
        $sort->defaultOrder='fName';
        $sort->applyOrder($criteria);

        // find all
        $models=Settings::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fName'=>$model->fName,
						'cell'=>array(CHtml::encode($model->fName).(Yii::app()->user->checkAccess('settings.setting.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fName),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('settings.setting.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fName),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):''),		 CHtml::encode($model->fLabel),
		 CHtml::encode($model->fValue),
		 CHtml::encode($model->fDescription),
		 CHtml::encode($model->fGroupName),
		 CHtml::encode($model->fSequence),
		 CHtml::encode($model->fIsActive),
		 CHtml::encode($model->fModule),
            ));
        }
        UFSBaseUtil::printJson($data);
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Settings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='settings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
