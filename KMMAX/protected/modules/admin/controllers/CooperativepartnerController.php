<?php

class CooperativepartnerController extends AppController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=Cooperativepartner::model()->with('company')->findByPk($id);
		$model->fCooperativeCompanyID=empty($model->company->fCooperativeCompanyID)?'':$model->company->fCooperativeCompanyName;
		$model->fEducationalLevel=array_key_exists($model->fEducationalLevel,adminSettings::$EducationLevel)?adminSettings::$EducationLevel[$model->fEducationalLevel]:'';
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
		$this->render('view',array(
			'model'=>$model,
			'keyid'=>$id
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Cooperativepartner;
		if(isset($_POST['Cooperativepartner']))
		{
			$model->attributes=$_POST['Cooperativepartner'];
			$model->fCooperativePartnerID=GuidUtil::getUuid();
			$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$model->fCreateDate=time();
			$model->fCooperativeCompanyID=$_POST['fCooperativeCompanyID'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fCooperativePartnerID));
		}

		$this->render('create',array(
			'model'=>$model,'EducationLevel'=>adminSettings::$EducationLevel,'Sex'=>adminSettings::$Sex
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=Cooperativepartner::model()->with('company')->findByPk($id);
		if(isset($_POST['Cooperativepartner']))
		{
			$model->attributes=$_POST['Cooperativepartner'];
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			if(!empty($_POST['fCooperativeCompanyID'])) 
				$model->fCooperativeCompanyID= $_POST['fCooperativeCompanyID'];
			else $model->fCooperativeCompanyID=$this->loadModel($id)->fCooperativeCompanyID;
			$model->fEducationalLevel= $_POST['EducationalLevel'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fCooperativePartnerID));
		}
		$model->fCooperativeCompanyID=empty($model->company->fCooperativeCompanyID)?'':$model->company->fCooperativeCompanyName;
		$model->fEducationalLevel=array_key_exists($model->fEducationalLevel,adminSettings::$EducationLevel)?adminSettings::$EducationLevel[$model->fEducationalLevel]:'';
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
		$this->render('update',array(
			'model'=>$model,
			'keyid'=>$id,'EducationLevel'=>adminSettings::$EducationLevel,'Sex'=>adminSettings::$Sex
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
		$model=Cooperativepartner::model()->with('company')->findByPk($id);
		if(isset($_POST['Cooperativepartner']))
		{
			$newpartner=new Cooperativepartner();
			$newpartner->attributes=$_POST['Cooperativepartner'];
			$newpartner->fCooperativePartnerID=GuidUtil::getUuid();
			if(!empty($_POST['fCooperativeCompanyID'])) 
				$newpartner->fCooperativeCompanyID= $_POST['fCooperativeCompanyID'];
			else $newpartner->fCooperativeCompanyID=$this->loadModel($id)->fCooperativeCompanyID;
			$newpartner->fEducationalLevel= $_POST['EducationalLevel'];
			$newpartner->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$newpartner->fCreateDate=time();
			if($newpartner->save())
				$this->redirect(array('view','id'=>$newpartner->fCooperativePartnerID));
		}
		$model->fCooperativeCompanyID=empty($model->company->fCooperativeCompanyID)?'':$model->company->fCooperativeCompanyName;
		$model->fEducationalLevel=array_key_exists($model->fEducationalLevel,adminSettings::$EducationLevel)?adminSettings::$EducationLevel[$model->fEducationalLevel]:'';
		$this->render('copy',array(
			'model'=>$model,'EducationLevel'=>adminSettings::$EducationLevel,'Sex'=>adminSettings::$Sex
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cooperativepartner('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cooperativepartner']))
			$model->attributes=$_GET['Cooperativepartner'];

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

        $pages=new CPagination(Cooperativepartner::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Cooperativepartner');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fCooperativePartnerID'=>array('asc'=>'fCooperativePartnerID','desc'=>'fCooperativePartnerID desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCooperativePartnerID')),
		
		'fPartnerName'=>array('asc'=>'fPartnerName','desc'=>'fPartnerName desc','label'=>Cooperativepartner::model()->getAttributeLabel('fPartnerName')),
		'fRole'=>array('asc'=>'fRole','desc'=>'fRole desc','label'=>Cooperativepartner::model()->getAttributeLabel('fRole')),
		'fBirthday'=>array('asc'=>'fBirthday','desc'=>'fBirthday desc','label'=>Cooperativepartner::model()->getAttributeLabel('fBirthday')),
		'fPosition'=>array('asc'=>'fPosition','desc'=>'fPosition desc','label'=>Cooperativepartner::model()->getAttributeLabel('fPosition')),
		'fSex'=>array('asc'=>'fSex','desc'=>'fSex desc','label'=>Cooperativepartner::model()->getAttributeLabel('fSex')),
		'fCellphone'=>array('asc'=>'fCellphone','desc'=>'fCellphone desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCellphone')),
		'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>Cooperativepartner::model()->getAttributeLabel('fEmail')),
		'fEducationalLevel'=>array('asc'=>'fEducationalLevel','desc'=>'fEducationalLevel desc','label'=>Cooperativepartner::model()->getAttributeLabel('fEducationalLevel')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Cooperativepartner::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Cooperativepartner::model()->getAttributeLabel('fUpdateDate')),
		
        );
        $sort->defaultOrder='fCooperativePartnerID';
        $sort->applyOrder($criteria);

        // find all
        $models=Cooperativepartner::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
		$model=new Cooperativepartner;
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
        
		$pages=new CPagination(Cooperativepartner::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Cooperativepartner');
		
        $sort->attributes=array(
           		'fCooperativePartnerID'=>array('asc'=>'fCooperativePartnerID','desc'=>'fCooperativePartnerID desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCooperativePartnerID')),
		'fPartnerName'=>array('asc'=>'fPartnerName','desc'=>'fPartnerName desc','label'=>Cooperativepartner::model()->getAttributeLabel('fPartnerName')),
		'fRole'=>array('asc'=>'fRole','desc'=>'fRole desc','label'=>Cooperativepartner::model()->getAttributeLabel('fRole')),
		'fBirthday'=>array('asc'=>'fBirthday','desc'=>'fBirthday desc','label'=>Cooperativepartner::model()->getAttributeLabel('fBirthday')),
		'fPosition'=>array('asc'=>'fPosition','desc'=>'fPosition desc','label'=>Cooperativepartner::model()->getAttributeLabel('fPosition')),
		'fSex'=>array('asc'=>'fSex','desc'=>'fSex desc','label'=>Cooperativepartner::model()->getAttributeLabel('fSex')),
		'fCellphone'=>array('asc'=>'fCellphone','desc'=>'fCellphone desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCellphone')),
		'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>Cooperativepartner::model()->getAttributeLabel('fEmail')),
		'fEducationalLevel'=>array('asc'=>'fEducationalLevel','desc'=>'fEducationalLevel desc','label'=>Cooperativepartner::model()->getAttributeLabel('fEducationalLevel')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Cooperativepartner::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Cooperativepartner::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='fCooperativePartnerID';
        $sort->applyOrder($criteria);

        // find all
        $models=Cooperativepartner::model()->with('company')->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {
            $data['rows'][]=array(
                		 'fCooperativePartnerID'=>$model->fCooperativePartnerID,
						'cell'=>array(	 
		    CHtml::encode($model->fPartnerName).(Yii::app()->user->checkAccess('admin.cooperativepartner.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fCooperativePartnerID),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Update')
                )):'').(Yii::app()->user->checkAccess('admin.cooperativepartner.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fCooperativePartnerID),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'').(Yii::app()->user->checkAccess('admin.cooperativepartner.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fCooperativePartnerID),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right',
                	'rel'=>$model->fCooperativePartnerID,
                    'title'=>Yii::t('label','Delete')
                )):''),
		 CHtml::encode(empty($model->company->fCooperativeCompanyID)?'':$model->company->fCooperativeCompanyName),
		 CHtml::encode($model->fRole),
		 CHtml::encode($model->fBirthday),
		 CHtml::encode($model->fPosition),
		 CHtml::encode($model->fSex),
		 CHtml::encode($model->fCellphone),
		 CHtml::encode($model->fEmail),
		 CHtml::encode(array_key_exists($model->fEducationalLevel,adminSettings::$EducationLevel)?adminSettings::$EducationLevel[$model->fEducationalLevel]:''),
		 CHtml::encode($model->fQq),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
		 CHtml::encode($model->fUpdateUser),
		 CHtml::encode(empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate)),
            ));
        }
        UFSBaseUtil::printJson($data);
    }

    /**
     * Grid of all models.
     */
    public function actionMultigrid()
    {
    	$criteria=new CDbCriteria;
    	$keyid='';
    	if(isset($_GET['id'])) $keyid=$_GET['id'];
    	$pages=new CPagination(Cooperativepartner::model()->count($criteria));//记录总数
    	$pages->pageSize=5;//设置每页的记录显示条数
    	$pages->applyLimit($criteria);
    
    	$sort=new CSort('Cooperativepartner');//排序，参考YII文档CSort
    	$sort->attributes=array(
    			'fCooperativePartnerID'=>array('asc'=>'fCooperativePartnerID','desc'=>'fCooperativePartnerID desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCooperativePartnerID')),
    
    			'fPartnerName'=>array('asc'=>'fPartnerName','desc'=>'fPartnerName desc','label'=>Cooperativepartner::model()->getAttributeLabel('fPartnerName')),
    			'fRole'=>array('asc'=>'fRole','desc'=>'fRole desc','label'=>Cooperativepartner::model()->getAttributeLabel('fRole')),
    			'fBirthday'=>array('asc'=>'fBirthday','desc'=>'fBirthday desc','label'=>Cooperativepartner::model()->getAttributeLabel('fBirthday')),
    			'fPosition'=>array('asc'=>'fPosition','desc'=>'fPosition desc','label'=>Cooperativepartner::model()->getAttributeLabel('fPosition')),
    			'fSex'=>array('asc'=>'fSex','desc'=>'fSex desc','label'=>Cooperativepartner::model()->getAttributeLabel('fSex')),
    			'fCellphone'=>array('asc'=>'fCellphone','desc'=>'fCellphone desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCellphone')),
    			'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>Cooperativepartner::model()->getAttributeLabel('fEmail')),
    			'fEducationalLevel'=>array('asc'=>'fEducationalLevel','desc'=>'fEducationalLevel desc','label'=>Cooperativepartner::model()->getAttributeLabel('fEducationalLevel')),
    			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCreateUser')),
    			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCreateDate')),
    			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Cooperativepartner::model()->getAttributeLabel('fUpdateUser')),
    			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Cooperativepartner::model()->getAttributeLabel('fUpdateDate')),
    
    	);
    	$sort->defaultOrder='fCooperativePartnerID';
    	$sort->applyOrder($criteria);
    
    	// find all
    	$models=Cooperativepartner::model()->findAll($criteria);
    
    	// rows for the static grid
    	$gridRows=array();
    	$model=new Cooperativepartner;
    	$model->unsetAttributes();  // clear any default values
    
    	// render the view file
    	$this->render('multigrid',array(
    			'models'=>$models,
    			'pages'=>$pages,
    			'sort'=>$sort,
    			'gridRows'=>$gridRows,
    			'model'=>$model,'keyid'=>$keyid
    	));
    }
    
    
    /**
     * Print out array of models for the jqGrid rows.
     */
    public function actionMultiGridData()
    {
    	if(!Yii::app()->request->isPostRequest)
    	{
    		throw new CHttpException(400,Yii::t('http','Invalid request. Please do not repeat this request again.'));
    		exit;
    	}
    	// specify request details
    	$jqGrid=$this->processJqGridRequest();
    	$criteria=new CDbCriteria;
    	if(isset($_GET['id'])&& !emptY($_GET['id'])){
    		$temp=Itemuser::model()->findAllByAttributes(array('fItemNo'=>$_GET['id']));
    		$notinuser=array();
    		foreach ($temp as $tem)  array_push($notinuser,$tem['fEmployeeName']);
    		$criteria->addNotInCondition('fPartnerName',$notinuser);
    	}
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
    				'fCooperativePartnerID'=>Cooperativepartner::model()->getAttributeLabel('fCooperativePartnerID'),
    				'fPartnerName'=>Cooperativepartner::model()->getAttributeLabel('fPartnerName'),
    				'fRole'=>Cooperativepartner::model()->getAttributeLabel('fRole'),
    				'fBirthday'=>Cooperativepartner::model()->getAttributeLabel('fBirthday'),
    				'fPosition'=>Cooperativepartner::model()->getAttributeLabel('fPosition'),
    				'fSex'=>Cooperativepartner::model()->getAttributeLabel('fSex'),
    				'fCellphone'=>Cooperativepartner::model()->getAttributeLabel('fCellphone'),
    				'fEmail'=>Cooperativepartner::model()->getAttributeLabel('fEmail'),
    				'fEducationalLevel'=>Cooperativepartner::model()->getAttributeLabel('fEducationalLevel'),
    				'fCreateUser'=>Cooperativepartner::model()->getAttributeLabel('fCreateUser'),
    				'fCreateDate'=>Cooperativepartner::model()->getAttributeLabel('fCreateDate'),
    				'fUpdateUser'=>Cooperativepartner::model()->getAttributeLabel('fUpdateUser'),
    				'fUpdateDate'=>Cooperativepartner::model()->getAttributeLabel('fUpdateDate'),
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
    
    	$pages=new CPagination(Cooperativepartner::model()->count($criteria));
    	$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
    	$pages->applyLimit($criteria);
    	// sort
    	$sort=new CSort('Cooperativepartner');
    
    	$sort->attributes=array(
    			'fCooperativePartnerID'=>array('asc'=>'fCooperativePartnerID','desc'=>'fCooperativePartnerID desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCooperativePartnerID')),
    			'fPartnerName'=>array('asc'=>'fPartnerName','desc'=>'fPartnerName desc','label'=>Cooperativepartner::model()->getAttributeLabel('fPartnerName')),
    			'fRole'=>array('asc'=>'fRole','desc'=>'fRole desc','label'=>Cooperativepartner::model()->getAttributeLabel('fRole')),
    			'fBirthday'=>array('asc'=>'fBirthday','desc'=>'fBirthday desc','label'=>Cooperativepartner::model()->getAttributeLabel('fBirthday')),
    			'fPosition'=>array('asc'=>'fPosition','desc'=>'fPosition desc','label'=>Cooperativepartner::model()->getAttributeLabel('fPosition')),
    			'fSex'=>array('asc'=>'fSex','desc'=>'fSex desc','label'=>Cooperativepartner::model()->getAttributeLabel('fSex')),
    			'fCellphone'=>array('asc'=>'fCellphone','desc'=>'fCellphone desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCellphone')),
    			'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>Cooperativepartner::model()->getAttributeLabel('fEmail')),
    			'fEducationalLevel'=>array('asc'=>'fEducationalLevel','desc'=>'fEducationalLevel desc','label'=>Cooperativepartner::model()->getAttributeLabel('fEducationalLevel')),
    			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCreateUser')),
    			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Cooperativepartner::model()->getAttributeLabel('fCreateDate')),
    			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Cooperativepartner::model()->getAttributeLabel('fUpdateUser')),
    			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Cooperativepartner::model()->getAttributeLabel('fUpdateDate')),
    	);
    	$sort->defaultOrder='fCooperativePartnerID';
    	$sort->applyOrder($criteria);
    
    	// find all
    	$models=Cooperativepartner::model()->with('company')->findAll($criteria);
    	$data=array(
    			'page'=>$pages->getCurrentPage()+1,
    			'total'=>$pages->getPageCount(),
    			'records'=>$pages->getItemCount(),
    			'rows'=>array()
    	);
    	foreach($models as $model)
    	{
    		$data['rows'][]=array(
    				'fCooperativePartnerID'=>$model->fCooperativePartnerID,
    				'cell'=>array(CHtml::encode($model->fCooperativePartnerID),
    						CHtml::encode($model->fPartnerName),
    						CHtml::encode(empty($model->company->fCooperativeCompanyID)?'':$model->company->fCooperativeCompanyName),
    						CHtml::encode($model->fRole),
    						CHtml::encode($model->fBirthday),
    						CHtml::encode($model->fPosition),
    						CHtml::encode($model->fSex),
    						CHtml::encode($model->fCellphone),
    						CHtml::encode($model->fEmail),
    						CHtml::encode(array_key_exists($model->fEducationalLevel,adminSettings::$EducationLevel)?adminSettings::$EducationLevel[$model->fEducationalLevel]:''),
    						CHtml::encode($model->fQq),
    						CHtml::encode($model->fCreateUser),
    						CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
    						CHtml::encode($model->fUpdateUser),
    						CHtml::encode(empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate)),
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
		$model=Cooperativepartner::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cooperativepartner-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
