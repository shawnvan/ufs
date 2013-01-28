<?php

class StandardtaskController extends KnowledgeCommon
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=Standardtask::model()->with('knowledgecatalogue')->with('task')->with('item')->findByPk($id);
		$model->fSubmitDate=empty($model->fSubmitDate)?'':date('Y-m-d',$model->fSubmitDate);
		$model->fConfirmDate=empty($model->fConfirmDate)?'':date('Y-m-d',$model->fConfirmDate);
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
		$model->fCatalogueNo=empty($model->knowledgecatalogue->fCatalogueName)?'':$model->knowledgecatalogue->fCatalogueName;
		$model->fItemNo=empty($model->item->fItemName)?'':$model->item->fItemName;
		$model->fOldTaskNo=empty($model->task->fTheme)?'':$model->task->fTheme;
		$this->render('view',array(
			'model'=>$model,
			'keyid'=>$id,'fTaskType'=>ItemSettings::$TaskType
				,'fStatus'=>adminSettings::$StandardTaskStatus,
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
		if(isset($_POST['Standardtask']))
		{
			$model->attributes=$_POST['Standardtask'];
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->fTaskNo));
		}

		$this->render('update',array(
			'model'=>$model,
			'keyid'=>$id,'fTaskType'=>ItemSettings::$TaskType
				,'fStatus'=>adminSettings::$StandardTaskStatus,
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

		if(isset($_POST['Standardtask']))
		{
			$createmodel=new Standardtask;
			$createmodel->attributes=$_POST['Standardtask'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fTaskNo));
		}

		$this->render('copy',array(
			'model'=>$model,
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeletetask()
	{
	  //验证模板是否已经有项目使用
		$criteria=new CDbCriteria;
		$criteria->addCondition("fTaskNo = :fTaskNo");
		$criteria->params[':fTaskNo']=$_GET['id'];
		if(Templetstandardtask::model()->count($criteria)>0) 
		{
			print_r('有项目在使用，不可删除,您可以设置为不可用。');
		}
		else{
			Standardtask::model()->deleteAll($criteria);
			print_r('删除成功');
		}//记录总数
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Standardtask('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Standardtask']))
			$model->attributes=$_GET['Standardtask'];
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
		$model=new Standardtask();
		$model->fAttachName=isset($_GET['fAttachName'])?trim($_GET['fAttachName']):'';
		$model->fTheme=isset($_GET['fTheme'])?trim($_GET['fTheme']):'';
		$model->fSubmitUser=isset($_GET['fSubmitUser'])?trim($_GET['fSubmitUser']):'';
		$model->fConfirmUser=isset($_GET['fConfirmUser'])?trim($_GET['fConfirmUser']):'';
		$model->fCreateUser=isset($_GET['fCreateUser'])?trim($_GET['fCreateUser']):'';
		$criteria=$model->AdvancedSearch();	
        $pages=new CPagination(Standardtask::model()->count($criteria));//记录总数
        $pages->pageSize=Yii::app()->params['pagesize'];//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Standardtask');//排序，参考YII文档CSort
        $sort->attributes=array(
        		'fTheme'=>array('asc'=>'fTheme','desc'=>'fTheme desc','label'=>Standardtask::model()->getAttributeLabel('fTheme')),
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Standardtask::model()->getAttributeLabel('fCatalogueNo')),
		
		'fAttachName'=>array('asc'=>'fAttachName','desc'=>'fAttachName desc','label'=>Standardtask::model()->getAttributeLabel('fAttachName')),
		'fTaskType'=>array('asc'=>'fTaskType','desc'=>'fTaskType desc','label'=>Standardtask::model()->getAttributeLabel('fTaskType')),
		'fSubmitUser'=>array('asc'=>'fSubmitUser','desc'=>'fSubmitUser desc','label'=>Standardtask::model()->getAttributeLabel('fSubmitUser')),
		'fSubmitDate'=>array('asc'=>'fSubmitDate','desc'=>'fSubmitDate desc','label'=>Standardtask::model()->getAttributeLabel('fSubmitDate')),
		'fConfirmUser'=>array('asc'=>'fConfirmUser','desc'=>'fConfirmUser desc','label'=>Standardtask::model()->getAttributeLabel('fConfirmUser')),
		'fConfirmDate'=>array('asc'=>'fConfirmDate','desc'=>'fConfirmDate desc','label'=>Standardtask::model()->getAttributeLabel('fConfirmDate')),		
				
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Standardtask::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Standardtask::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Standardtask::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Standardtask::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='fTaskNo';
        $sort->applyOrder($criteria);
        $gridRows=array();
		$itemCommon=new ItemCommonController();// 获得知识库分类
		$dataNode = $itemCommon->GetKnowledgeCatalogue();
        $this->render('index',array(
            'models'=>'',
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,'dataNode'=>$dataNode,
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
        if(isset($_GET['cno'])){
        	$criteria->addCondition("t.fCatalogueNo = :fCatalogueNo");
        	$criteria->params[':fCatalogueNo']=$_GET['cno'];
        }
        $model=new Standardtask();
		$model->fAttachName=isset($_GET['fAttachName'])?trim($_GET['fAttachName']):'';
		$model->fTheme=isset($_GET['fTheme'])?trim($_GET['fTheme']):'';
		$model->fSubmitUser=isset($_GET['fSubmitUser'])?trim($_GET['fSubmitUser']):'';
		$model->fConfirmUser=isset($_GET['fConfirmUser'])?trim($_GET['fConfirmUser']):'';
		$model->fCreateUser=isset($_GET['fCreateUser'])?trim($_GET['fCreateUser']):'';
		$criteria=$model->AdvancedSearch();	
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
		$pages=new CPagination(Standardtask::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Standardtask');
		
        $sort->attributes=array(
        		'fTheme'=>array('asc'=>'fTheme','desc'=>'fTheme desc','label'=>Standardtask::model()->getAttributeLabel('fTheme')),
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Standardtask::model()->getAttributeLabel('fCatalogueNo')),
		'fAttachName'=>array('asc'=>'fAttachName','desc'=>'fAttachName desc','label'=>Standardtask::model()->getAttributeLabel('fAttachName')),
		'fTaskType'=>array('asc'=>'fTaskType','desc'=>'fTaskType desc','label'=>Standardtask::model()->getAttributeLabel('fTaskType')),
		'fSubmitUser'=>array('asc'=>'fSubmitUser','desc'=>'fSubmitUser desc','label'=>Standardtask::model()->getAttributeLabel('fSubmitUser')),
		'fSubmitDate'=>array('asc'=>'fSubmitDate','desc'=>'fSubmitDate desc','label'=>Standardtask::model()->getAttributeLabel('fSubmitDate')),
		'fConfirmUser'=>array('asc'=>'fConfirmUser','desc'=>'fConfirmUser desc','label'=>Standardtask::model()->getAttributeLabel('fConfirmUser')),
		'fConfirmDate'=>array('asc'=>'fConfirmDate','desc'=>'fConfirmDate desc','label'=>Standardtask::model()->getAttributeLabel('fConfirmDate')),
		
        'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Standardtask::model()->getAttributeLabel('fCreateUser')),
        'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Standardtask::model()->getAttributeLabel('fCreateDate')),
        'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Standardtask::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Standardtask::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='t.fCreateUser';
        $sort->applyOrder($criteria);
        $models=Standardtask::model()->with('knowledgecatalogue')->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {
        	$middleLink='';
        	$viewattach=(Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button UFSGrid-row-attach',
                    'align'=>'right','rel'=>$model->fAttachNo,
					'title'=>Yii::t('label','ViewAttach')
                )):'');
        	$agree=(Yii::app()->user->checkAccess('admin.standardtask.Agree')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('agree','id'=>$model->fTaskNo),array(
        			'class'=>'UFSGrid-show UFSGrid-row-button UFSGrid-row-agree',
        			'align'=>'right','rel'=>$model->fTaskNo,
        			'title'=>Yii::t('label','Agree')
        	)):'');
        	$refuse=(Yii::app()->user->checkAccess('admin.standardtask.Refuse')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('refuse','id'=>$model->fTaskNo),array(
        			'class'=>'UFSGrid-show UFSGrid-row-button UFSGrid-row-refuse',
        			'align'=>'right','rel'=>$model->fTaskNo,
        			'title'=>Yii::t('label','Refuse')
        	)):'');
        	$update=(Yii::app()->user->checkAccess('admin.standardtask.Update')?CHtml::link("<span class='ui-row ui-row-edit'></span>",array('update','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Update')
                )):'');
        	$view=(Yii::app()->user->checkAccess('admin.standardtask.View')?CHtml::link("<span class='ui-row ui-row-view'></span>",array('view','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'');
        	$delete=(Yii::app()->user->checkAccess('admin.standardtask.Delete')?CHtml::link("<span class='ui-row ui-row-delete'></span>",array('delete','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right',
                	'rel'=>$model->fTaskNo,
                    'title'=>Yii::t('label','Delete')
                )):'');
        	if($model->fStatus=='Standard_Apply') $middleLink=$agree.$refuse.$view;
        	else $middleLink=$update.$view.$delete;
            $data['rows'][]=array(
                		 'fTaskNo'=>$model->fTaskNo,
						'cell'=>array(CHtml::encode($model->fTheme).$middleLink,		
				 CHtml::encode(empty($model->knowledgecatalogue->fCatalogueName)?'':$model->knowledgecatalogue->fCatalogueName),
				 CHtml::encode($model->fAttachName).$viewattach,
				 CHtml::encode(array_key_exists($model->fTaskType,ItemSettings::$TaskType)?ItemSettings::$TaskType[$model->fTaskType]:''),
				 CHtml::encode($model->fSubmitUser),
				 CHtml::encode(empty($model->fSubmitDate)?'':date('Y-m-d',$model->fSubmitDate)),
				 CHtml::encode($model->fConfirmUser),
				 CHtml::encode(empty($model->fConfirmDate)?'':date('Y-m-d',$model->fConfirmDate)),
				 CHtml::encode(array_key_exists($model->fStatus,adminSettings::$StandardTaskStatus)?adminSettings::$StandardTaskStatus[$model->fStatus]:''),
		         CHtml::encode($model->fCreateUser),
		         CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
		         CHtml::encode($model->fUpdateUser),
		         CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fUpdateDate)),
            		));
        }
        UFSBaseUtil::printJson($data);
    }
    /**
     * Grid of all models.
     */
    public function actionPopgrid()
    {
    	$keyid='';
    	$treeid='';
    	if(isset($_GET['id'])) $keyid=$_GET['id'];
    	if(isset($_GET['cNo'])) $treeid=$_GET['cNo'];
    	$criteria=new CDbCriteria;
    	$pages=new CPagination(Standardtask::model()->count($criteria));//记录总数
    	$pages->pageSize=5;//设置每页的记录显示条数
    	$pages->applyLimit($criteria);
    
    	$sort=new CSort('Standardtask');//排序，参考YII文档CSort
    	$sort->attributes=array(
    			'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Standardtask::model()->getAttributeLabel('fTaskNo')),
    			'fTheme'=>array('asc'=>'fTheme','desc'=>'fTheme desc','label'=>Standardtask::model()->getAttributeLabel('fTheme')),
    			'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Standardtask::model()->getAttributeLabel('fCatalogueNo')),
    		
    			'fAttachName'=>array('asc'=>'fAttachName','desc'=>'fAttachName desc','label'=>Standardtask::model()->getAttributeLabel('fAttachName')),
    			
    	
    	'fContent'=>array('asc'=>'fContent','desc'=>'fContent desc','label'=>Standardtask::model()->getAttributeLabel('fContent')),

    	'fTaskType'=>array('asc'=>'fTaskType','desc'=>'fTaskType desc','label'=>Standardtask::model()->getAttributeLabel('fTaskType')),
    	'fSubmitUser'=>array('asc'=>'fSubmitUser','desc'=>'fSubmitUser desc','label'=>Standardtask::model()->getAttributeLabel('fSubmitUser')),
    	'fSubmitDate'=>array('asc'=>'fSubmitDate','desc'=>'fSubmitDate desc','label'=>Standardtask::model()->getAttributeLabel('fSubmitDate')),
    	'fConfirmUser'=>array('asc'=>'fConfirmUser','desc'=>'fConfirmUser desc','label'=>Standardtask::model()->getAttributeLabel('fConfirmUser')),
    	'fConfirmDate'=>array('asc'=>'fConfirmDate','desc'=>'fConfirmDate desc','label'=>Standardtask::model()->getAttributeLabel('fConfirmDate')),
    	'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Standardtask::model()->getAttributeLabel('fCreateUser')),
    	'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Standardtask::model()->getAttributeLabel('fCreateDate')),
    	'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Standardtask::model()->getAttributeLabel('fStatus')),
    	'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Standardtask::model()->getAttributeLabel('fUpdateUser')),
    	'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Standardtask::model()->getAttributeLabel('fUpdateDate')),
    	);
    	$sort->defaultOrder='fTaskNo';
    	$sort->applyOrder($criteria);
    	$models=Standardtask::model()->findAll($criteria);
    	$gridRows=array();   
    	$model=new Standardtask;
    	$model->unsetAttributes();  // clear any default values
    	$this->render('popgrid',array(
    			'models'=>$models,
    			'pages'=>$pages,
    			'sort'=>$sort,
    			'gridRows'=>$gridRows,
    			'model'=>$model,'keyid'=>$keyid,'treeid'=>$treeid,
    	));
    }
    
    
    /**
     * Print out array of models for the jqGrid rows.
     */
    public function actionPopGridData()
    {
    	
    	 if(!Yii::app()->request->isPostRequest)
    	{
    		throw new CHttpException(400,Yii::t('http','Invalid request. Please do not repeat this request again.'));
    		exit;
    	} 
    	$jqGrid=$this->processJqGridRequest();
    	$criteria=new CDbCriteria;
    	$criteria->addCondition("t.fStatus = :fStatus");
    	$criteria->params[':fStatus']='Standard_Agree';
    	if(isset($_GET['cNo'])&& !emptY($_GET['cNo'])){
    		$criteria->addCondition("t.fCatalogueNo = :fCatalogueNo");
    		$criteria->params[':fCatalogueNo']=$_GET['cNo'];
    	}
    	if(isset($_GET['id'])&& !emptY($_GET['id'])){
    		$temptask=Templetstandardtask::model()->findAllByAttributes(array('fTemplateNo'=>$_GET['id']));
    		$notintask=array();
    		foreach ($temptask as $temp)  array_push($notintask,$temp['fTaskNo']);
    		$criteria->addNotInCondition('t.fTaskNo',$notintask);
    	}
    	
    

    	$pages=new CPagination(Standardtask::model()->count($criteria));
    	$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
    	$pages->applyLimit($criteria);
    	// sort
    	$sort=new CSort('Standardtask');
    
    	$sort->attributes=array(
    			'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Standardtask::model()->getAttributeLabel('fTaskNo')),
    			'fTheme'=>array('asc'=>'fTheme','desc'=>'fTheme desc','label'=>Standardtask::model()->getAttributeLabel('fTheme')),
    			'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Standardtask::model()->getAttributeLabel('fCatalogueNo')),
    			
    			'fAttachName'=>array('asc'=>'fAttachName','desc'=>'fAttachName desc','label'=>Standardtask::model()->getAttributeLabel('fAttachName')),
    			
    			
    	
    	'fContent'=>array('asc'=>'fContent','desc'=>'fContent desc','label'=>Standardtask::model()->getAttributeLabel('fContent')),
    	
    	'fTaskType'=>array('asc'=>'fTaskType','desc'=>'fTaskType desc','label'=>Standardtask::model()->getAttributeLabel('fTaskType')),
    	'fSubmitUser'=>array('asc'=>'fSubmitUser','desc'=>'fSubmitUser desc','label'=>Standardtask::model()->getAttributeLabel('fSubmitUser')),
    	'fSubmitDate'=>array('asc'=>'fSubmitDate','desc'=>'fSubmitDate desc','label'=>Standardtask::model()->getAttributeLabel('fSubmitDate')),
    	'fConfirmUser'=>array('asc'=>'fConfirmUser','desc'=>'fConfirmUser desc','label'=>Standardtask::model()->getAttributeLabel('fConfirmUser')),
    	'fConfirmDate'=>array('asc'=>'fConfirmDate','desc'=>'fConfirmDate desc','label'=>Standardtask::model()->getAttributeLabel('fConfirmDate')),
    	'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Standardtask::model()->getAttributeLabel('fCreateUser')),
    	'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Standardtask::model()->getAttributeLabel('fCreateDate')),
    	'fPriority'=>array('asc'=>'fPriority','desc'=>'fPriority desc','label'=>Standardtask::model()->getAttributeLabel('fPriority')),
    	'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Standardtask::model()->getAttributeLabel('fStatus')),
    	'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Standardtask::model()->getAttributeLabel('fUpdateUser')),
    	'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Standardtask::model()->getAttributeLabel('fUpdateDate')),
    	);
    	$sort->defaultOrder='fTaskNo';
    	$sort->applyOrder($criteria);
    	$models=Standardtask::model()->with('knowledgecatalogue')->findAll($criteria);
    	$data=array(
    			'page'=>$pages->getCurrentPage()+1,
    			'total'=>$pages->getPageCount(),
    			'records'=>$pages->getItemCount(),
    			'rows'=>array()
    	);
    	foreach($models as $model)
    	{
    		$data['rows'][]=array(
    				'fTaskNo'=>$model->fTaskNo,
    				'cell'=>array(CHtml::encode($model->fTaskNo),
    						CHtml::encode($model->fTheme),
    						CHtml::encode(empty($model->knowledgecatalogue->fCatalogueName)?'':$model->knowledgecatalogue->fCatalogueName),
    						CHtml::encode($model->fAttachName),
    						CHtml::encode($model->fContent),
    						CHtml::encode($model->fTaskType),
    						CHtml::encode($model->fSubmitUser),
    						CHtml::encode(empty($model->fSubmitDate)?'':date('Y-m-d',$model->fSubmitDate)),
    						CHtml::encode($model->fConfirmUser),
    						CHtml::encode(empty($model->fConfirmDate)?'':date('Y-m-d',$model->fConfirmDate)),
    						CHtml::encode($model->fCreateUser),
    						CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
    						 CHtml::encode(array_key_exists($model->fStatus,adminSettings::$StandardTaskStatus)?adminSettings::$StandardTaskStatus[$model->fStatus]:''),
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
		$model=Standardtask::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='standardtask-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * 拒绝申请
	 */
	public function actionRefuse()
	{
		$taskno='';
		if(isset($_POST['id'])){
			$taskno=$_POST['id'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Standardtask::model()->findByPk($taskno);
			$task=Task::model()->findByAttributes(array('fTaskNo'=>$model->fOldTaskNo));
			$task->fStandardStatus='Standard_Refuse';
			$task->save();
			//消息发送
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$model->fSubmitUser));
			if($user!=null){
				$msg=new Msgto();
				$msg->fSendToNo=GuidUtil::getUuid();
				$msg->fSendFromNo=Yii::app()->params->loginuser->fUserName;
				$msg->fSendToUserNo=$user->fUserID;
				$msg->fSendToAccount=$user->fEmail;
				$msg->fSendToName=$user->fUserName;
				$msg->fSendMsgStatus='Msg_NoRead';
				$msg->fSendUserNo=Yii::app()->params->loginuser->fUserID;
				$msg->fSendFromName=$user->fUserName;
				$msg->fSendFromDate=time();
				$msg->fSendFromModule='Msg_Item';
				$msg->fSendFromType='Msg_Inner';
				$msg->fSendFromTheme=Yii::app()->params['standtask']['refuse']['theme'];
				$msg->fSendFromContent=sprintf(Yii::app()->params['standtask']['refuse']['content'],$model->fTheme);
				$msg->fSendToAllUserNo=$user->fUserID;
				$msg->fSendToAllAccount=$user->fEmail;
				$msg->fSendToAllName=$user->fUserName;
				$msg->fRemark1=sprintf(Yii::app()->params['standtask']['refuse']['memo'],$_POST['memo']);
				$msg->fRemark2='';
				$msg->fRemark3='';
				$msg->save();
			}
			$this->DeleteKnowledgeCatalogue($model->fCatalogueNo);
			$model->deleteByPk($taskno);
			
			$transaction->commit();
			 UFSBaseUtil::printJson(array(			   
		    'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Update Success'),Yii::app()->params['notytype']['success']),
		    ));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	
	/**
	 * 同意申请
	 */
	public function actionAgree()
	{
		$taskno=isset($_GET['id'])?$_GET['id']:'';
		$transaction = Yii::app()->db->beginTransaction();
		try {			
			$model=Standardtask::model()->findByPk($taskno);
			$model->fStatus='Standard_Agree';
			$model->fConfirmUser=Yii::app()->params->loginuser->fUserName;
			$model->fConfirmDate=time();
			$model->save();			
			$this->UpdateKnowledgeCatalogue($model->fCatalogueNo);		  
			$task=Task::model()->findByAttributes(array('fTaskNo'=>$model->fOldTaskNo));
			$task->fStandardStatus='Standard_Agree';
			$task->save();
			//消息发送
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$model->fSubmitUser));
			if($user!=null){
				$msg=new Msgto();
				$msg->fSendToNo=GuidUtil::getUuid();
				$msg->fSendFromNo=Yii::app()->params->loginuser->fUserName;
				$msg->fSendToUserNo=$user->fUserID;
				$msg->fSendToAccount=$user->fEmail;
				$msg->fSendToName=$user->fUserName;
				$msg->fSendMsgStatus='Msg_NoRead';
				$msg->fSendUserNo=Yii::app()->params->loginuser->fUserID;
				$msg->fSendFromName=$user->fUserName;
				$msg->fSendFromDate=time();
				$msg->fSendFromModule='Msg_Item';
				$msg->fSendFromType='Msg_Inner';
				$msg->fSendFromTheme=Yii::app()->params['standtask']['agree']['theme'];
				$msg->fSendFromContent=sprintf(Yii::app()->params['standtask']['agree']['content'],$model->fTheme);
				$msg->fSendToAllUserNo=$user->fUserID;
				$msg->fSendToAllAccount=$user->fEmail;
				$msg->fSendToAllName=$user->fUserName;
				$msg->fRemark1='';
				$msg->fRemark2='';
				$msg->fRemark3='';
				$msg->save();
			}
			$transaction->commit();
		  UFSBaseUtil::printJson(array(			   
		    'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Update Success'),Yii::app()->params['notytype']['success']),
		    ));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
}
