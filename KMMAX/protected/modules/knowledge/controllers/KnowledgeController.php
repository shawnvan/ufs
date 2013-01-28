<?php

class KnowledgeController extends KnowledgeCommon
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=Knowledge::model()->with('knowledgecatalogue')->with('task')->findByPk($id);
		$model->fCatalogueNo=empty($model->knowledgecatalogue->fCatalogueName)?'':$model->knowledgecatalogue->fCatalogueName;
		$model->fTaskNo=empty($model->task->fTheme)?'':$model->task->fTheme;
		$model->fSubmitDate=empty($model->fSubmitDate)?'':date('Y-m-d',$model->fSubmitDate);
		$model->fConfirmDate=empty($model->fConfirmDate)?'':date('Y-m-d',$model->fConfirmDate);
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
		$this->render('view',array(
			'model'=>$model,
			'keyid'=>$id,'fStatus'=>knowledgeSettings::$KnowledgeStatus,'fIsOpen'=>knowledgeSettings::$KnowledgeOpen
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Knowledge;
		if(isset($_POST['Knowledge']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try {
			$model->attributes=$_POST['Knowledge'];
			$model->fKnowledgeNo=GuidUtil::getUuid();
			$model->fTaskNo='';
			$model->fTaskNo='';
			$model->fIsOpen='NoOpen';
			$model->fStatus='Knowledge_IsActive';
			$model->fSubmitUser=Yii::app()->params->loginuser->fUserName;
			$model->fSubmitDate=time();
			$model->fConfirmUser=Yii::app()->params->loginuser->fUserName;
			$model->fConfirmDate=time();
			$model->fCreate=Yii::app()->params->loginuser->fUserName;
			$model->fCreateDate=time();
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			//上传附件
			$attch=new Attachment();
			$attch=$this->SaveuploadFile($model);
			$model->fAttachmentNo=$attch->fAttachmentId;
			$model->fAttachmentFalseName=$attch->fAttachmentFalseName;
			$model->fAttachmentName=$attch->fAttachmentName;
			$model->save();
			//事务提交
			$transaction->commit();
		    $this->redirect(array('view','id'=>$model->fKnowledgeNo));
			//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=Knowledge::model()->with('knowledgecatalogue')->with('task')->findByPk($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);		
		if(isset($_POST['Knowledge']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try {
				$model->attributes=$_POST['Knowledge'];
				$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
				$model->fUpdateDate=time();
				//上传附件
				$attch=new Attachment();
				$attch=$this->SaveuploadFile($model);
				if($attch!=null){
					Attachment::model()->deleteByPk($model->fAttachmentNo);
					$myfile = Yii::app()->cfile->set(Yii::app()->params['uploadPath'].$model->fAttachmentFalseName, true);
					$myfile->permissions=777;
					if ($model->fAttachmentFalseName!='' && $myfile->exists) $myfile->delete();
					$model->fAttachmentNo=$attch->fAttachmentId;
					$model->fAttachmentFalseName=$attch->fAttachmentFalseName;
					$model->fAttachmentName=$attch->fAttachmentName;
				}
				$model->save();
				//事务提交
				$transaction->commit();
				$this->redirect(array('view','id'=>$model->fKnowledgeNo));
				//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'keyid'=>$id,'fStatus'=>knowledgeSettings::$KnowledgeStatus,'fIsOpen'=>knowledgeSettings::$KnowledgeOpen
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

		if(isset($_POST['Knowledge']))
		{
			$createmodel=new Knowledge;
			$createmodel->attributes=$_POST['Knowledge'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fKnowledgeNo));
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
	public function actionDeleteknow($id)
	{
          if(isset($_GET['id'])){
			$this->loadModel($_GET['id'])->delete();
	        print_r('删除成功');
          }
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Knowledge('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Knowledge']))
			$model->attributes=$_GET['Knowledge'];
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
		$model=new Knowledge();
		$model->fKnowledgeName=isset($_GET['fKnowledgeName'])?trim($_GET['fKnowledgeName']):'';
		$model->fAttachmentName=isset($_GET['fAttachmentName'])?trim($_GET['fAttachmentName']):'';
		$model->fCreate=isset($_GET['fCreate'])?trim($_GET['fCreate']):'';
		$model->fSubmitUser=isset($_GET['fSubmitUser'])?trim($_GET['fSubmitUser']):'';
		$model->fConfirmUser=isset($_GET['fConfirmUser'])?trim($_GET['fConfirmUser']):'';
		$criteria=$model->AdvancedSearch();
        $pages=new CPagination(Knowledge::model()->count($criteria));//记录总数
        $pages->pageSize=Yii::app()->params['pagesize'];//设置每页的记录显示条数
        $pages->applyLimit($criteria);		
        $sort=new CSort('Knowledge');//排序，参考YII文档CSort
        $sort->attributes=array(
		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Knowledge::model()->getAttributeLabel('fItemNo')),
		'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Knowledge::model()->getAttributeLabel('fTaskNo')),
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Knowledge::model()->getAttributeLabel('fCatalogueNo')),
		'fKnowledgeName'=>array('asc'=>'fKnowledgeName','desc'=>'fKnowledgeName desc','label'=>Knowledge::model()->getAttributeLabel('fKnowledgeName')),
		'fAttachmentName'=>array('asc'=>'fAttachmentName','desc'=>'fAttachmentName desc','label'=>Knowledge::model()->getAttributeLabel('fAttachmentName')),
		'fIsOpen'=>array('asc'=>'fIsOpen','desc'=>'fIsOpen desc','label'=>Knowledge::model()->getAttributeLabel('fIsOpen')),
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Knowledge::model()->getAttributeLabel('fStatus')),
		'fSubmitDate'=>array('asc'=>'fSubmitDate','desc'=>'fSubmitDate desc','label'=>Knowledge::model()->getAttributeLabel('fSubmitDate')),
		'fSubmitUser'=>array('asc'=>'fSubmitUser','desc'=>'fSubmitUser desc','label'=>Knowledge::model()->getAttributeLabel('fSubmitUser')),
		'fConfirmUser'=>array('asc'=>'fConfirmUser','desc'=>'fConfirmUser desc','label'=>Knowledge::model()->getAttributeLabel('fConfirmUser')),
		'fConfirmDate'=>array('asc'=>'fConfirmDate','desc'=>'fConfirmDate desc','label'=>Knowledge::model()->getAttributeLabel('fConfirmDate')),
		'fCreate'=>array('asc'=>'fCreate','desc'=>'fCreate desc','label'=>Knowledge::model()->getAttributeLabel('fCreate')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Knowledge::model()->getAttributeLabel('fCreateDate')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Knowledge::model()->getAttributeLabel('fUpdateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Knowledge::model()->getAttributeLabel('fUpdateUser')),
        );
        $sort->defaultOrder='fKnowledgeNo';
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
        /* if(!Yii::app()->request->isPostRequest)
        {
            throw new CHttpException(400,Yii::t('http','Invalid request. Please do not repeat this request again.'));
            exit;
        }  */
        // specify request details
        $jqGrid=$this->processJqGridRequest();
        $criteria=new CDbCriteria;
        $model=new Knowledge();
        $model->fKnowledgeName =isset($_GET['fKnowledgeName'])?trim($_GET['fKnowledgeName']):'';
        $model->fAttachmentName=isset($_GET['fAttachmentName'])?trim($_GET['fAttachmentName']):'';
        $model->fCreate=isset($_GET['fCreate'])?trim($_GET['fCreate']):'';
        $model->fSubmitUser=isset($_GET['fSubmitUser'])?trim($_GET['fSubmitUser']):'';
        $model->fConfirmUser=isset($_GET['fConfirmUser'])?trim($_GET['fConfirmUser']):'';
        $criteria=$model->AdvancedSearch();
        if(isset($_GET['cno'])&& !(empty($_GET['cno']))){
        	$criteria->addCondition("t.fCatalogueNo = :fCatalogueNo");
        	$criteria->params[':fCatalogueNo']=$_GET['cno'];
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
		$pages=new CPagination(Knowledge::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Knowledge');		
        $sort->attributes=array(
		'fConfirmUser'=>array('asc'=>'fConfirmUser','desc'=>'fConfirmUser desc','label'=>Knowledge::model()->getAttributeLabel('fConfirmUser')),
		'fConfirmDate'=>array('asc'=>'fConfirmDate','desc'=>'fConfirmDate desc','label'=>Knowledge::model()->getAttributeLabel('fConfirmDate')),
		'fCreate'=>array('asc'=>'fCreate','desc'=>'fCreate desc','label'=>Knowledge::model()->getAttributeLabel('fCreate')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Knowledge::model()->getAttributeLabel('fCreateDate')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Knowledge::model()->getAttributeLabel('fUpdateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Knowledge::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Knowledge::model()->getAttributeLabel('fUpdateUser')),
        );
        $sort->defaultOrder='fKnowledgeNo';
        $sort->applyOrder($criteria);
        $models=Knowledge::model()->with('knowledgecatalogue')->with('task')->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {
          $middleLink='';
		   $agreeres=(Yii::app()->user->checkAccess('knowledge.knowledge.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fKnowledgeNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-button-agree',
					'align'=>'right',
                    'title'=>Yii::t('label','Agree'),
		   		    'rel'=>$model->fKnowledgeNo
                )):'');
			
		  $refuse=(Yii::app()->user->checkAccess('knowledge.knowledge.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fKnowledgeNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-button-refuse',
					'align'=>'right',
                    'title'=>Yii::t('label','Refuse'),
		   		    'rel'=>$model->fKnowledgeNo
                )):'');
		  $update=(Yii::app()->user->checkAccess('knowledge.knowledge.Update')?CHtml::link("<span class='ui-row ui-row-edit'></span>",array('update','id'=>$model->fKnowledgeNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label',Yii::t('label','Update'))
                )):'');
		  $view=(Yii::app()->user->checkAccess('knowledge.knowledge.View')?CHtml::link("<span class='ui-row ui-row-view'></span>",array('view','id'=>$model->fKnowledgeNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label',Yii::t('label','View'))
                )):'');
		  $delete=(Yii::app()->user->checkAccess('knowledge.knowledge.Delete')?CHtml::link("<span class='ui-row ui-row-delete'></span>",array('delete','id'=>$model->fKnowledgeNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right',
                	'rel'=>$model->fKnowledgeNo,
                    'title'=>Yii::t('label',Yii::t('label','Delete'))
                )):'');
		  $viewattach=(($model->fStatus==0)&&Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
		  		'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-attach',
		  		'align'=>'right',
		  		'rel'=>$model->fAttachmentNo,
		  		'title'=>Yii::t('label','ViewAttach'),
		  )):'');
		  $download=(($model->fStatus==0)&&Yii::app()->user->checkAccess('knowledge.knowledge.download')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
		  		'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-download',
		  		'align'=>'right',
		  		'rel'=>$model->fAttachmentNo,
		  		'title'=>Yii::t('label','DownLoad'),
		  )):'');
		 if($model->fStatus=='Knowledge_Apply') $middleLink=$agreeres.$refuse;
		 else{
			 if(!empty($model->knowledgecatalogue->fIsDownLoad) && $model->knowledgecatalogue->fIsDownLoad=='Y'){
			 	$viewattach=$viewattach.$download;
			 }
		    else $middleLink=$delete.$view.$update;
		  }
            $data['rows'][]=array(
                		 'fKnowledgeNo'=>$model->fKnowledgeNo,
						'cell'=>array(	
		   CHtml::encode($model->fItemNo==''?Yii::t('label','Users'):Yii::t('label','Items')).$middleLink,
		  CHtml::encode(empty($model->task->fTheme)?'':$model->task->fTheme),
		  CHtml::encode(empty($model->knowledgecatalogue->fCatalogueName)?'':$model->knowledgecatalogue->fCatalogueName),
		 CHtml::encode($model->fKnowledgeName),
		 CHtml::encode($model->fAttachmentName).$viewattach,
		 CHtml::encode(array_key_exists($model->fIsOpen,knowledgeSettings::$KnowledgeOpen)?knowledgeSettings::$KnowledgeOpen[$model->fIsOpen]:''),
		 CHtml::encode(array_key_exists($model->fStatus,knowledgeSettings::$KnowledgeStatus)?knowledgeSettings::$KnowledgeStatus[$model->fStatus]:''),
		 CHtml::encode($model->fSubmitUser),
		 CHtml::encode(empty($model->fSubmitDate)?'':date('Y-m-d',$model->fSubmitDate)),								
		 CHtml::encode($model->fConfirmUser),
		 CHtml::encode($model->fConfirmUser),
		 CHtml::encode(empty($model->fConfirmDate)?'':date('Y-m-d',$model->fConfirmDate)),
		 CHtml::encode($model->fCreate),
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
    public function actionShow()
    {
    	$criteria=new CDbCriteria;
    	$model=new Knowledge;
    	$pages=new CPagination(Knowledge::model()->count($criteria));//记录总数
    	$pages->pageSize=Yii::app()->params['pagesize'];//设置每页的记录显示条数
    	$pages->applyLimit($criteria);    
    	$sort=new CSort('Knowledge');//排序，参考YII文档CSort
    	$sort->attributes=array(
    			'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Knowledge::model()->getAttributeLabel('fItemNo')),
    			'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Knowledge::model()->getAttributeLabel('fTaskNo')),
    			'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Knowledge::model()->getAttributeLabel('fCatalogueNo')),
    			'fKnowledgeName'=>array('asc'=>'fKnowledgeName','desc'=>'fKnowledgeName desc','label'=>Knowledge::model()->getAttributeLabel('fKnowledgeName')),
    			'fAttachmentName'=>array('asc'=>'fAttachmentName','desc'=>'fAttachmentName desc','label'=>Knowledge::model()->getAttributeLabel('fAttachmentName')),
    			'fIsOpen'=>array('asc'=>'fIsOpen','desc'=>'fIsOpen desc','label'=>Knowledge::model()->getAttributeLabel('fIsOpen')),
    			'fSubmitDate'=>array('asc'=>'fSubmitDate','desc'=>'fSubmitDate desc','label'=>Knowledge::model()->getAttributeLabel('fSubmitDate')),
    			'fSubmitUser'=>array('asc'=>'fSubmitUser','desc'=>'fSubmitUser desc','label'=>Knowledge::model()->getAttributeLabel('fSubmitUser')),
    			'fConfirmUser'=>array('asc'=>'fConfirmUser','desc'=>'fConfirmUser desc','label'=>Knowledge::model()->getAttributeLabel('fConfirmUser')),
    			'fConfirmDate'=>array('asc'=>'fConfirmDate','desc'=>'fConfirmDate desc','label'=>Knowledge::model()->getAttributeLabel('fConfirmDate')),
    			'fCreate'=>array('asc'=>'fCreate','desc'=>'fCreate desc','label'=>Knowledge::model()->getAttributeLabel('fCreate')),
    			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Knowledge::model()->getAttributeLabel('fCreateDate')),
    			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Knowledge::model()->getAttributeLabel('fUpdateDate')),
    			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Knowledge::model()->getAttributeLabel('fUpdateUser')),
    	);
    	$sort->defaultOrder='fKnowledgeNo';
    	$sort->applyOrder($criteria);
    	$models=Knowledge::model()->findAll($criteria);
    	$gridRows=array();
    	$itemCommon=new ItemCommonController();// 获得知识库分类
    	$dataNode = $itemCommon->GetKnowledgeCatalogue();
    	// render the view file
    	$this->render('show',array(
    			'models'=>$models,
    			'pages'=>$pages,
    			'sort'=>$sort,
    			'gridRows'=>$gridRows,'dataNode'=>$dataNode,
    			'model'=>$model,
    	));
    }
    
    
    /**
     * Print out array of models for the jqGrid rows.
     */
    public function actionShowgridData()
    {
    	if(!Yii::app()->request->isPostRequest)
    	{
    		throw new CHttpException(400,Yii::t('http','Invalid request. Please do not repeat this request again.'));
    		exit;
    	}
    	// specify request details
    	$jqGrid=$this->processJqGridRequest();
    	$criteria=new CDbCriteria;
    	if(isset($_GET['cno'])&& !(empty($_GET['cno']))){
    		$criteria->addCondition("t.fCatalogueNo = :fCatalogueNo");
    		$criteria->params[':fCatalogueNo']=$_GET['cno'];
    	}
    	$criteria->addCondition("t.fStatus = :fStatus");
    	$criteria->params[':fStatus']='Knowledge_IsActive';
    	$criteria->addCondition("t.fIsOpen = :fIsOpen");
    	$criteria->params[':fIsOpen']='IsOpen';  
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
    
    	$pages=new CPagination(Knowledge::model()->count($criteria));
    	$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
    	$pages->applyLimit($criteria);
    	// sort
    	$sort=new CSort('Knowledge');
    
    	$sort->attributes=array(
    			'fConfirmUser'=>array('asc'=>'fConfirmUser','desc'=>'fConfirmUser desc','label'=>Knowledge::model()->getAttributeLabel('fConfirmUser')),
    			'fConfirmDate'=>array('asc'=>'fConfirmDate','desc'=>'fConfirmDate desc','label'=>Knowledge::model()->getAttributeLabel('fConfirmDate')),
    			'fCreate'=>array('asc'=>'fCreate','desc'=>'fCreate desc','label'=>Knowledge::model()->getAttributeLabel('fCreate')),
    			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Knowledge::model()->getAttributeLabel('fCreateDate')),
    			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Knowledge::model()->getAttributeLabel('fUpdateDate')),
    			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Knowledge::model()->getAttributeLabel('fUpdateUser')),
    			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Knowledge::model()->getAttributeLabel('fUpdateUser')),
    	);
    	$sort->defaultOrder='fKnowledgeNo';
    	$sort->applyOrder($criteria);
    	// find all
    	$models=Knowledge::model()->with('knowledgecatalogue')->with('task')->findAll($criteria);
    	$data=array(
    			'page'=>$pages->getCurrentPage()+1,
    			'total'=>$pages->getPageCount(),
    			'records'=>$pages->getItemCount(),
    			'rows'=>array()
    	);
    	foreach($models as $model)
    	{
    
    		$middleLink='';
    		$view=(Yii::app()->user->checkAccess('knowledge.knowledge.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fKnowledgeNo),array(
    				'class'=>'UFSGrid-show UFSGrid-row-button',
    				'align'=>'right',
    				'title'=>Yii::t('label',Yii::t('label','View'))
    		)):'');
    		$viewattach=(($model->fStatus==0)&&Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
    				'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-attach',
    				'align'=>'right',
    				'rel'=>$model->fAttachmentNo,
    				'title'=>Yii::t('label','ViewAttach'),
    		)):'');
    		$download=(($model->fStatus==0)&&Yii::app()->user->checkAccess('knowledge.knowledge.download')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
    				'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-download',
    				'align'=>'right',
    				'rel'=>$model->fAttachmentNo,
    				'title'=>Yii::t('label','DownLoad'),
    		)):'');
    		if(!empty($model->knowledgecatalogue->fIsDownLoad) && $model->knowledgecatalogue->fIsDownLoad=='Y'){
    			$viewattach=$viewattach.$download;
    		};
    		$data['rows'][]=array(
    				'fKnowledgeNo'=>$model->fKnowledgeNo,
    				'cell'=>array(
    						CHtml::encode($model->fItemNo==''?Yii::t('label','Users'):Yii::t('label','Items')).$view,
    						CHtml::encode(empty($model->task->fTheme)?'':$model->task->fTheme),
    						CHtml::encode(empty($model->knowledgecatalogue->fCatalogueName)?'':$model->knowledgecatalogue->fCatalogueName),
    						CHtml::encode($model->fKnowledgeName),
    						CHtml::encode($model->fAttachmentName).$viewattach,
    						CHtml::encode(array_key_exists($model->fIsOpen,knowledgeSettings::$KnowledgeOpen)?knowledgeSettings::$KnowledgeOpen[$model->fIsOpen]:''),
    						CHtml::encode($model->fSubmitUser),
    						CHtml::encode(empty($model->fSubmitDate)?'':date('Y-m-d',$model->fSubmitDate)),
    						CHtml::encode($model->fConfirmUser),
    						CHtml::encode(empty($model->fConfirmDate)?'':date('Y-m-d',$model->fConfirmDate)),
    						CHtml::encode($model->fCreate),
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
		$model=Knowledge::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='knowledge-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionApplyknowledge(){
		$model=new Knowledge;
		$id='';
		if(isset($_GET['id']))$id=$_GET['id'];
		;
		$result=Resultdocument::model()->with('attach')->findByAttributes(array('fResultNo'=>$id));
		if(isset($_POST['Knowledge']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try {
			$model->attributes=$_POST['Knowledge'];
			if(empty($result->fDocumentNo)) $result->fDocumentNo=GuidUtil::getUuid();
			$result->fDocumentStatus="Knowledge_WaitAgree";
			$result->save();
			$model->fKnowledgeNo=GuidUtil::getUuid();
			$model->fTaskNo=$result->fTaskNo;
			$model->fItemNo=$result->fItemNo;
			$model->fResultNo=$result->fResultNo;
			$model->fCatalogueNo=$result->fCatalogueNo;
			$model->fAttachmentNo=$result->fAttachmentNo;
			$model->fAttachmentName=$result->attach->fAttachmentName;
			$model->fAttachmentFalseName=$result->attach->fAttachmentFalseName;
			$model->fStatus='Knowledge_Apply';
			$model->fSubmitDate=time();
			$model->fSubmitUser=Yii::app()->params->loginuser->fUserName;
			$model->fCreate=Yii::app()->params->loginuser->fUserName;
			$model->fCreateDate=time();
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			$model->save();
			//追加新的知识分类
			/* $knowledge=Knowledgecatalogue::model()->findByPk($model->fCatalogueNo);
			if(empty($knowledge)){
				$this->InsertKnowledgeCatalogue($model->fCatalogueNo);
			} */
			$transaction->commit();
			echo '<script>parent.$(\'.UFSGrid-row-applyknowledge\').colorbox.close(\'申请已经发出\');</script>';
			//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}
		$model->fAttachmentName=$result->attach->fAttachmentName;
		$this->render('applyknowledge',array(
				'model'=>$model,
		));
	}
	
	/**
	 * 同意申请
	 */
	public function actionAgree(){
		//发送内部消息，或者邮件
		//更新状态
		$knowledgeNo='';//成果编号
		$name='';//成果编号
		if(isset($_POST['id'])){
			$knowledgeNo=$_POST['id'];
		}else return;
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Knowledge::model()->findByPk($knowledgeNo);
			$model->fStatus='Knowledge_IsActive';
			$model->fIsOpen='IsOpen';
			$model->fConfirmUser=Yii::app()->params->loginuser->fUserName;
			$model->fConfirmDate=time();
			$model->fUpdateDate=time();
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->save();
			if(!empty($model->fCatalogueNo))
				$this->UpdateKnowledgeCatalogue($model->fCatalogueNo);
			$resdocument=Resultdocument::model()->findByAttributes(array('fResultNo'=>$model->fResultNo));
			$resdocument->fArchiveUser=Yii::app()->params->loginuser->fUserName;
			$resdocument->fArchiveDate=time();
			$resdocument->fIsDocument=1;
			$resdocument->fDocumentStatus='Document_Agree';
			$resdocument->save();
			//消息发送
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$resdocument->fApplyArchiveUser));
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
				$msg->fSendFromTheme=Yii::app()->params['knw']['agree']['theme'];
				$msg->fSendFromContent=sprintf(Yii::app()->params['knw']['agree']['content'],$model->fAttachmentName);
				$msg->fSendToAllUserNo=$user->fUserID;
				$msg->fSendToAllAccount=$user->fEmail;
				$msg->fSendToAllName=$user->fUserName;
				$msg->fRemark1='';
				$msg->fRemark2='';
				$msg->fRemark3='';
				$msg->save();
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	/**
	 * 拒绝申请
	 */
	public function actionRefuse(){
		//发送内部消息，或者邮件
		//更新状态
		$knowledgeNo='';//成果编号
		$content='';//成果编号
		if(isset($_POST['id'])){
			$knowledgeNo=$_POST['id'];
		}else return;
		if(isset($_POST['memo'])){
			$content=$_POST['memo'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$know=Knowledge::model()->findByPk($knowledgeNo);
			$catalogueno=$know->fCatalogueNo;
			$resuno=$know->fResultNo;
			$resdocument=Resultdocument::model()->findByAttributes(array('fResultNo'=>$resuno));
			$resdocument->fArchiveUser=Yii::app()->params->loginuser->fUserName;
			$resdocument->fArchiveDate=time();
			$resdocument->fIsDocument=1;
			$resdocument->fDocumentStatus='Document_Refuse';
			$resdocument->save();
		   //消息发送
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$resdocument->fApplyArchiveUser));
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
				$msg->fSendFromTheme=Yii::app()->params['knw']['refuse']['theme'];
				$msg->fSendFromContent=sprintf(Yii::app()->params['knw']['refuse']['content'],$know->fAttachmentName);
				$msg->fSendToAllUserNo=$user->fUserID;
				$msg->fSendToAllAccount=$user->fEmail;
				$msg->fSendToAllName=$user->fUserName;
				$msg->fRemark1=$content;
				$msg->fRemark2='';
				$msg->fRemark3='';
				$msg->save();
			}
			Knowledge::model()->deleteByPk($knowledgeNo);
			$this->DeleteKnowledgeCatalogue($catalogueno);
			Knowledgecatalogue::model()->deleteAllByAttributes(array('fStatus'=>'Knowledge_Temp','fCatalogueNo'=>$knowledgeNo));
			$transaction->commit();
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	public function actionDownload(){
		$id=isset($_GET['id'])?$_GET['id']:'';
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$this->Download($id);
			print_r('下载成功');
			//事务提交
			$transaction->commit();
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
}
