<?php

class CooperativecompanyController extends KmMax
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$model->fStarLevel=array_key_exists($model->fStarLevel,adminSettings::$CompanyStar)?adminSettings::$CompanyStar[$model->fStarLevel]:'';
		$model->fType=array_key_exists($model->fType,adminSettings::$CompanyType)?adminSettings::$CompanyType[$model->fType]:'';
		$model->fIndustry=array_key_exists($model->fIndustry,adminSettings::$CompanyIndustry)?adminSettings::$CompanyIndustry[$model->fIndustry]:'';
		$model->fDownIndustry=array_key_exists($model->fDownIndustry,adminSettings::$CompanyIndustry)?adminSettings::$CompanyIndustry[$model->fDownIndustry]:'';
		$model->fOnIndustry=array_key_exists($model->fOnIndustry,adminSettings::$CompanyIndustry)?adminSettings::$CompanyIndustry[$model->fOnIndustry]:'';
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
		$this->render('view',array(
			'model'=>$model,'keyid'=>$id,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Cooperativecompany;
		if(isset($_POST['Cooperativecompany']))
		{
			
			$model->attributes=$_POST['Cooperativecompany'];
			$model->fCooperativeCompanyID=GuidUtil::getUuid();
			$model->fStarLevel=$_POST['fStarLevel'];
			$model->fType=$_POST['fType'];
			$model->fCity=$_POST['fCity'];
			$model->fIndustry=$_POST['fIndustry'];
			$model->fDownIndustry=$_POST['fDownIndustry'];
			$model->fOnIndustry=$_POST['fOnIndustry'];
			$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$model->fCreateDate=time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->fCooperativeCompanyID,'EducationLevel'=>adminSettings::$EducationLevel));
		}

		$this->render('create',array(
			'model'=>$model,'StarLevel'=>adminSettings::$CompanyStar
				,'CompanyType'=>adminSettings::$CompanyType,
				'City'=>adminSettings::$City,
				'CompanyIndustry'=>adminSettings::$CompanyIndustry,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Cooperativecompany']))
		{
			$model->attributes=$_POST['Cooperativecompany'];
			$model->fStarLevel=$_POST['fStarLevel'];
			$model->fType=$_POST['fType'];
			$model->fCity=$_POST['fCity'];
			$model->fIndustry=$_POST['fIndustry'];
			$model->fDownIndustry=$_POST['fDownIndustry'];
			$model->fOnIndustry=$_POST['fOnIndustry'];
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->fCooperativeCompanyID));
		}

		$this->render('update',array(
				'model'=>$model,'StarLevel'=>adminSettings::$CompanyStar
				,'CompanyType'=>adminSettings::$CompanyType,
				'City'=>adminSettings::$City,
				'CompanyIndustry'=>adminSettings::$CompanyIndustry,
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
		if(isset($_POST['Cooperativecompany']))
		{
			$createmodel=new Cooperativecompany();
			$createmodel->fCooperativeCompanyID=GuidUtil::getUuid();
			$createmodel->attributes=$_POST['Cooperativecompany'];
			$createmodel->fStarLevel=$_POST['fStarLevel'];
			$createmodel->fType=$_POST['fType'];
			$createmodel->fCity=$_POST['fCity'];
			$createmodel->fIndustry=$_POST['fIndustry'];
			$createmodel->fDownIndustry=$_POST['fDownIndustry'];
			$createmodel->fOnIndustry=$_POST['fOnIndustry'];
			$createmodel->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$createmodel->fCreateDate=time();
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fCooperativeCompanyID));
		}
		$this->render('copy',array(
				'model'=>$model,'StarLevel'=>adminSettings::$CompanyStar
				,'CompanyType'=>adminSettings::$CompanyType,
				'City'=>adminSettings::$City,
				'CompanyIndustry'=>adminSettings::$CompanyIndustry,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(isset($_GET['id'])){
		   $companyCount=Cooperativepartner::model()->countByAttributes(array('fCooperativeCompanyID'=>$_GET['id']));
		   if($companyCount>0) 
		   	   print_r(Yii::app()->params->delete['IsActive']);
		   else 
		   {
		       $this->loadModel($_GET['id'])->delete();
		      print_r(Yii::app()->params->delete['success']);
		   }
		}else print_r(Yii::app()->params->delete['failure']);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cooperativecompany('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cooperativecompany']))
			$model->attributes=$_GET['Cooperativecompany'];
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

        $pages=new CPagination(Cooperativecompany::model()->count($criteria));//记录总数
        $pages->pageSize=Yii::app()->params['pagesize'];//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Cooperativecompany');//排序，参考YII文档CSort
        $sort->attributes=array(
        'fCooperativeCompanyID'=>array('asc'=>'fCooperativeCompanyID','desc'=>'fCooperativeCompanyID desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyID')),
		'fCooperativeCompanyName'=>array('asc'=>'fCooperativeCompanyName','desc'=>'fCooperativeCompanyName desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyName')),
		'fCooperativeCompanyShortName'=>array('asc'=>'fCooperativeCompanyShortName','desc'=>'fCooperativeCompanyShortName desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyShortName')),
		'fStarLevel'=>array('asc'=>'fStarLevel','desc'=>'fStarLevel desc','label'=>Cooperativecompany::model()->getAttributeLabel('fStarLevel')),
		'fType'=>array('asc'=>'fType','desc'=>'fType desc','label'=>Cooperativecompany::model()->getAttributeLabel('fType')),
		'fKeyContacts'=>array('asc'=>'fKeyContacts','desc'=>'fKeyContacts desc','label'=>Cooperativecompany::model()->getAttributeLabel('fKeyContacts')),
		/*
		'fCity'=>array('asc'=>'fCity','desc'=>'fCity desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCity')),
		'fIndustry'=>array('asc'=>'fIndustry','desc'=>'fIndustry desc','label'=>Cooperativecompany::model()->getAttributeLabel('fIndustry')),
		'fDownIndustry'=>array('asc'=>'fDownIndustry','desc'=>'fDownIndustry desc','label'=>Cooperativecompany::model()->getAttributeLabel('fDownIndustry')),
		'fOnIndustry'=>array('asc'=>'fOnIndustry','desc'=>'fOnIndustry desc','label'=>Cooperativecompany::model()->getAttributeLabel('fOnIndustry')),
		'fMainProduct'=>array('asc'=>'fMainProduct','desc'=>'fMainProduct desc','label'=>Cooperativecompany::model()->getAttributeLabel('fMainProduct')),
		'fWebSite'=>array('asc'=>'fWebSite','desc'=>'fWebSite desc','label'=>Cooperativecompany::model()->getAttributeLabel('fWebSite')),
		'fZipCode'=>array('asc'=>'fZipCode','desc'=>'fZipCode desc','label'=>Cooperativecompany::model()->getAttributeLabel('fZipCode')),
		'fMaintenanceEmployee'=>array('asc'=>'fMaintenanceEmployee','desc'=>'fMaintenanceEmployee desc','label'=>Cooperativecompany::model()->getAttributeLabel('fMaintenanceEmployee')),
		'fMemo'=>array('asc'=>'fMemo','desc'=>'fMemo desc','label'=>Cooperativecompany::model()->getAttributeLabel('fMemo')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Cooperativecompany::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Cooperativecompany::model()->getAttributeLabel('fUpdateDate')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Cooperativecompany::model()->getAttributeLabel('fUserGroup')),
		*/'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Cooperativecompany::model()->getAttributeLabel('fUserGroup')),
        );
        $sort->defaultOrder='fCooperativeCompanyID';
        $sort->applyOrder($criteria);
        $models=Cooperativecompany::model()->findAll($criteria);
        $gridRows=array();
		$model=new Cooperativecompany;
		$model->unsetAttributes();
        $this->render('index',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,
        	'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Index Success'),Yii::app()->params['notytype']['success'])
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

       if($jqGrid['filters']!=null){
			$filters=json_decode($jqGrid['filters']);
			if(!empty($filters->groupOp) && (!empty($filters->rules))){
				$operation=$this->getJqGridOperationArray();
				$keywordFormula=$this->getJqGridKeywordFormulaArray();
				$condition='';
				$param=array();
				foreach($filters->rules as $temp){
					if(empty($condition))
						$condition=' t.'.$temp->field.' '.$operation[$temp->op].' :'.$temp->field;
					else
						$condition=$condition.' '.$filters->groupOp.' t.'.$temp->field.' '.$operation[$temp->op].' :'.$temp->field;
					$param[':'.$temp->field]=str_replace('keyword',$temp->data,$keywordFormula[$temp->op]);
				}
				$criteria->condition=$condition;
				$criteria->params=$param;
			}
		}

		// pagination
        
		$pages=new CPagination(Cooperativecompany::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Cooperativecompany');
		
        $sort->attributes=array(
           		'fCooperativeCompanyID'=>array('asc'=>'fCooperativeCompanyID','desc'=>'fCooperativeCompanyID desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyID')),
		'fCooperativeCompanyName'=>array('asc'=>'fCooperativeCompanyName','desc'=>'fCooperativeCompanyName desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyName')),
		'fCooperativeCompanyShortName'=>array('asc'=>'fCooperativeCompanyShortName','desc'=>'fCooperativeCompanyShortName desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyShortName')),
		'fStarLevel'=>array('asc'=>'fStarLevel','desc'=>'fStarLevel desc','label'=>Cooperativecompany::model()->getAttributeLabel('fStarLevel')),
		'fType'=>array('asc'=>'fType','desc'=>'fType desc','label'=>Cooperativecompany::model()->getAttributeLabel('fType')),
		'fKeyContacts'=>array('asc'=>'fKeyContacts','desc'=>'fKeyContacts desc','label'=>Cooperativecompany::model()->getAttributeLabel('fKeyContacts')),
		/*
		'fCity'=>array('asc'=>'fCity','desc'=>'fCity desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCity')),
		'fIndustry'=>array('asc'=>'fIndustry','desc'=>'fIndustry desc','label'=>Cooperativecompany::model()->getAttributeLabel('fIndustry')),
		'fDownIndustry'=>array('asc'=>'fDownIndustry','desc'=>'fDownIndustry desc','label'=>Cooperativecompany::model()->getAttributeLabel('fDownIndustry')),
		'fOnIndustry'=>array('asc'=>'fOnIndustry','desc'=>'fOnIndustry desc','label'=>Cooperativecompany::model()->getAttributeLabel('fOnIndustry')),
		'fMainProduct'=>array('asc'=>'fMainProduct','desc'=>'fMainProduct desc','label'=>Cooperativecompany::model()->getAttributeLabel('fMainProduct')),
		'fWebSite'=>array('asc'=>'fWebSite','desc'=>'fWebSite desc','label'=>Cooperativecompany::model()->getAttributeLabel('fWebSite')),
		'fZipCode'=>array('asc'=>'fZipCode','desc'=>'fZipCode desc','label'=>Cooperativecompany::model()->getAttributeLabel('fZipCode')),
		'fMaintenanceEmployee'=>array('asc'=>'fMaintenanceEmployee','desc'=>'fMaintenanceEmployee desc','label'=>Cooperativecompany::model()->getAttributeLabel('fMaintenanceEmployee')),
		'fMemo'=>array('asc'=>'fMemo','desc'=>'fMemo desc','label'=>Cooperativecompany::model()->getAttributeLabel('fMemo')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Cooperativecompany::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Cooperativecompany::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Cooperativecompany::model()->getAttributeLabel('fUpdateDate')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Cooperativecompany::model()->getAttributeLabel('fUserGroup')),
		*/'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Cooperativecompany::model()->getAttributeLabel('fUserGroup')),
        );
        $sort->defaultOrder='fCooperativeCompanyID';
        $sort->applyOrder($criteria);

        // find all
        $models=Cooperativecompany::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {
            $test=(Yii::app()->user->checkAccess('admin.Cooperativecompany.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fCooperativeCompanyID),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'');
           
            $data['rows'][]=array(
                		 'fCooperativeCompanyID'=>$model->fCooperativeCompanyID,
						'cell'=>array(CHtml::encode($model->fCooperativeCompanyID),		
								 CHtml::encode($model->fCooperativeCompanyName).(Yii::app()->user->checkAccess('admin.Cooperativecompany.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fCooperativeCompanyID),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Update')
                )):'')
						.(Yii::app()->user->checkAccess('admin.Cooperativecompany.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fCooperativeCompanyID),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'').(Yii::app()->user->checkAccess('admin.Cooperativecompany.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fCooperativeCompanyID),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right',
                	'rel'=>$model->fCooperativeCompanyID,
                    'title'=>Yii::t('label','Delete')
                )):''),
		 CHtml::encode($model->fCooperativeCompanyShortName),
		CHtml::encode(array_key_exists($model->fStarLevel,adminSettings::$CompanyStar)?adminSettings::$CompanyStar[$model->fStarLevel]:''),
		 CHtml::encode(array_key_exists($model->fType,adminSettings::$CompanyType)?adminSettings::$CompanyType[$model->fType]:''),
		 CHtml::encode($model->fKeyContacts),
		 CHtml::encode($model->fCity),
		 CHtml::encode(array_key_exists($model->fIndustry,adminSettings::$CompanyIndustry)?adminSettings::$CompanyIndustry[$model->fIndustry]:''),
		 CHtml::encode($model->fDownIndustry),
		 CHtml::encode($model->fOnIndustry),
		 CHtml::encode($model->fMainProduct),
		 CHtml::encode($model->fWebSite),
		 CHtml::encode($model->fZipCode),
		 CHtml::encode($model->fMaintenanceEmployee),
		 CHtml::encode($model->fMemo),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode($model->fCreateDate),
		 CHtml::encode($model->fUpdateUser),
		 CHtml::encode($model->fUpdateDate),
		 CHtml::encode($model->fUserGroup),
            ));
        }
        UFSBaseUtil::printJson($data);
    }

    /**
     * Grid of all models.
     */
    public function actionPopgrid()
    {
    	$criteria=new CDbCriteria;
    	$pages=new CPagination(Cooperativecompany::model()->count($criteria));
    	$pages->pageSize=Yii::app()->params['pagesize'];
    	$pages->applyLimit($criteria);
    	$sort=new CSort('Cooperativecompany');
    	$sort->attributes=array(
    			'fCooperativeCompanyID'=>array('asc'=>"fCooperativeCompanyID",'desc'=>"fCooperativeCompanyID desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyID')),
    			'fCooperativeCompanyName'=>array('asc'=>"fCooperativeCompanyName",'desc'=>"fCooperativeCompanyName desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyName')),
    			'fCooperativeCompanyShortName'=>array('asc'=>"fCooperativeCompanyShortName",'desc'=>"fCooperativeCompanyShortName desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyShortName')),
    			'fStarLevel'=>array('asc'=>"fStarLevel",'desc'=>"fStarLevel desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fStarLevel')),
    			'fType'=>array('asc'=>"fType",'desc'=>"fType desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fType')),
    			'fKeyContacts'=>array('asc'=>"fKeyContacts",'desc'=>"fKeyContacts desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fKeyContacts')),
    			'fIndustry'=>array('asc'=>"fIndustry",'desc'=>"fIndustry desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fIndustry')),
    			'fMainProduct'=>array('asc'=>"fMainProduct",'desc'=>"fMainProduct desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fMainProduct')),
    	);
    	$sort->defaultOrder="fCooperativeCompanyName";
    	$sort->applyOrder($criteria);
    	$gridRows=array();
    	$this->render('popgrid',array('pages'=>$pages,'sort'=>$sort,'gridRows'=>$gridRows));
    }
    /**
     * Print out array of models for the jqGrid rows.
     */
    public function actionPopgridData()
    {
    	$jqGrid=$this->processJqGridRequest();
    	$criteria=new CDbCriteria;
    	$pages=new CPagination(Cooperativecompany::model()->count($criteria));
    	$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
    	$pages->applyLimit($criteria);
    	$sort=new CSort('Item');
    	$sort->attributes=array(
    			'fCooperativeCompanyName'=>array('asc'=>"fCooperativeCompanyID",'desc'=>"fCooperativeCompanyID desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyID')),
    			'fCooperativeCompanyName'=>array('asc'=>"fCooperativeCompanyName",'desc'=>"fCooperativeCompanyName desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyName')),
    			'fCooperativeCompanyShortName'=>array('asc'=>"fCooperativeCompanyShortName",'desc'=>"fCooperativeCompanyShortName desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fCooperativeCompanyShortName')),
    			'fStarLevel'=>array('asc'=>"fStarLevel",'desc'=>"fStarLevel desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fStarLevel')),
    			'fType'=>array('asc'=>"fType",'desc'=>"fType desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fType')),
    			'fKeyContacts'=>array('asc'=>"fKeyContacts",'desc'=>"fKeyContacts desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fKeyContacts')),
    			'fIndustry'=>array('asc'=>"fIndustry",'desc'=>"fIndustry desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fIndustry')),
    			'fMainProduct'=>array('asc'=>"fMainProduct",'desc'=>"fMainProduct desc",'label'=>Cooperativecompany::model()->getAttributeLabel('fMainProduct')),
    	);
    	$sort->defaultOrder="fCooperativeCompanyName";
    	$sort->applyOrder($criteria);
    	$models=Cooperativecompany::model()->findAll($criteria);
    	$data=array(
    			'page'=>$pages->getCurrentPage()+1,
    			'total'=>$pages->getPageCount(),
    			'records'=>$pages->getItemCount(),
    			'rows'=>array()
    	);
    	foreach($models as $model)
    	{
    		$data['rows'][]=array('fCooperativeCompanyID'=>$model->fCooperativeCompanyID,'cell'=>array(
    				CHtml::encode($model->fCooperativeCompanyID),
    				CHtml::encode($model->fCooperativeCompanyName),
    				CHtml::encode($model->fCooperativeCompanyShortName),
    				CHtml::encode(array_key_exists($model->fStarLevel,adminSettings::$CompanyStar)?adminSettings::$CompanyStar[$model->fStarLevel]:''),
    				CHtml::encode(array_key_exists($model->fType,adminSettings::$CompanyType)?adminSettings::$CompanyType[$model->fType]:''),
    				CHtml::encode($model->fKeyContacts),
    				CHtml::encode(array_key_exists($model->fIndustry,adminSettings::$CompanyIndustry)?adminSettings::$CompanyIndustry[$model->fIndustry]:''),
    				CHtml::encode($model->fMainProduct),
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
		$model=Cooperativecompany::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cooperativecompany-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
