<?php

class ResultdocumentController extends ItemCommon
{
	/**
	 * 同步项目尽职调查表
	 * $catalogueno:分类编号
	 * $itemno: 分类编号
	 * $method: add,delete
	 */
	public function CatalogueSynchronization($catalogueno,$itemno,$method,$model=null){
		$itemcatalogue=Itemcatalogue::model()->findByAttributes(array('fCatalogueNo'=>$catalogueno,'fItemNo'=>$itemno));
		if($itemcatalogue!=null){
			if($itemcatalogue->fFatherCatalogueNo!='0' || $itemcatalogue->fFatherCatalogueNo=='') $this->CatalogueSynchronization($itemcatalogue->fFatherCatalogueNo,$itemno,$method,$model);
			if($model=='result'){
				if($method=='add'){
					$itemcatalogue->fResultNum=$itemcatalogue->fResultNum+1;
				}else
					$itemcatalogue->fResultNum=$itemcatalogue->fResultNum-1;
				$itemcatalogue->save();
			}else{
				if($method=='add'){
					$itemcatalogue->fDocumentNum=$itemcatalogue->fDocumentNum+1;
				}else {
					$itemcatalogue->fDocumentNum=$itemcatalogue->fDocumentNum-1;
				}
				$itemcatalogue->save();
			}
		}
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$resdocument=Resultdocument::model()->with('itemCatalogue')->with('CatalogueName')->with('attach')->findByPk($id);
		$resdocument->fCatalogueNo=empty($resdocument->CatalogueName->fCatalogueName)?'':$resdocument->CatalogueName->fCatalogueName;
		$resdocument->fResultSubmitDate=empty($resdocument->fResultSubmitDate)?'':date('Y-m-d',$resdocument->fResultSubmitDate);
		$resdocument->fResultConfirmDate=empty($resdocument->fResultConfirmDate)?'':date('Y-m-d',$resdocument->fResultConfirmDate);
		$resdocument->fArchiveDate=empty($resdocument->fArchiveDate)?'':date('Y-m-d',$resdocument->fArchiveDate);
		$resdocument->fApplyArchiveDate=empty($resdocument->fApplyArchiveDate)?'':date('Y-m-d',$resdocument->fApplyArchiveDate);
		$resdocument->fCreateDate=empty($resdocument->fCreateDate)?'':date('Y-m-d',$resdocument->fCreateDate);
		$resdocument->fUpdateDate=empty($resdocument->fUpdateDate)?'':date('Y-m-d',$resdocument->fUpdateDate);
		$resdocument->fDocumentStatus=array_key_exists($resdocument->fDocumentStatus,ItemSettings::$DocumentStatus)?ItemSettings::$DocumentStatus[$resdocument->fDocumentStatus]:'';
		$this->render('view',array(
			'model'=>$resdocument,
			'keyid'=>$id,'fItemNo'=>$resdocument->fItemNo,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Resultdocument;
		$model->fItemNo=$_GET['id'];
		if(isset($_POST['Resultdocument']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try {
			$model->attributes=$_POST['Resultdocument'];
			$model->fResultNo=GuidUtil::getUuid();
			$model->fDocumentNo=GuidUtil::getUuid();
			$model->fStatus='Result_Add';
			$model->fIsDocument=0;
			$model->fIsItemResult=0;
			$model->fResultSubmitUser=Yii::app()->params->loginuser->fUserName;
			$model->fResultSubmitDate=time();
			$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$model->fCreateDate=time();
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			$model->fDocumentStatus='';
			//上传附件
			$attch=new Attachment();
			$attch=$this->SaveuploadFile($model);
			if(empty($attch->fAttachmentId)) $this->redirect(array('index','id'=>$model->fItemNo));
			$model->fAttachmentNo=$attch->fAttachmentId;
			$model->save();
			//事务提交
			$transaction->commit();
			$this->redirect(array('index','id'=>$model->fItemNo));
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}

		$this->render('create',array(
			'model'=>$model,'itemno'=>$_GET['id'],
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Resultdocument']))
		{
			$model->attributes=$_POST['Resultdocument'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fResultNo));
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

		if(isset($_POST['Resultdocument']))
		{
			$createmodel=new Resultdocument;
			$createmodel->attributes=$_POST['Resultdocument'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fResultNo));
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
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Resultdocument('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Resultdocument']))
			$model->attributes=$_GET['Resultdocument'];

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
		$model=new Resultdocument();
		if(isset($_GET['id'])) {
			$model->fItemNo=$_GET['id'];
			$item=Item::model()->findByPk($model->fItemNo);
			if($item->fStatus==0){
				$this->redirect($this->createUrl('item/update/id/'.$item->fItemNo));
				return;
			}else{
				$model->fTaskNo =isset($_GET['fTaskNo'])?trim($_GET['fTaskNo']):'';
				$model->fAttachmentNo =isset($_GET['fAttachmentNo'])?$_GET['fAttachmentNo']:'';
				$model->fResultSubmitUser =isset($_GET['fResultSubmitUser'])?trim($_GET['fResultSubmitUser']):'';
				$model->fResultSubmitDate =isset($_GET['fResultSubmitDate'])?trim($_GET['fResultSubmitDate']):'';
				$model->fResultConfirmUser =isset($_GET['fResultConfirmUser'])?trim($_GET['fResultConfirmUser']):'';
				$model->fResultConfirmDate =isset($_GET['fResultConfirmDate'])?$_GET['fResultConfirmDate']:'';
				$model->fCreateUser =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
				$model->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
				$model->fStatus =isset($_GET['fStatus'])?$_GET['fStatus']:'';
			}
		}	
		$criteria=$model->AdvancedSearch();
        $pages=new CPagination(Resultdocument::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);		
        $sort=new CSort('Resultdocument');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Resultdocument::model()->getAttributeLabel('fTaskNo')),
		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Resultdocument::model()->getAttributeLabel('fItemNo')),
		'fResultNo'=>array('asc'=>'fResultNo','desc'=>'fResultNo desc','label'=>Resultdocument::model()->getAttributeLabel('fResultNo')),
		'fDocumentNo'=>array('asc'=>'fDocumentNo','desc'=>'fDocumentNo desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentNo')),
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Resultdocument::model()->getAttributeLabel('fCatalogueNo')),
		
		'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
        );
        $sort->defaultOrder='fResultNo';
        $sort->applyOrder($criteria);
        $gridRows=array();
        $this->render('index',array(
            'models'=>'',
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,'dataNode'=> $this->GetItemCatalogue($model->fItemNo,'result'),'keyid'=>$model->fItemNo
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
        $jqGrid=$this->processJqGridRequest();
        $criteria=new CDbCriteria;
        $mod=new Resultdocument();       
        $mod->fItemNo=isset($_GET['id'])?$_GET['id']:'';
        $mod->fTaskNo =isset($_GET['fTaskNo'])?trim($_GET['fTaskNo']):'';
        $mod->fAttachmentNo =isset($_GET['fAttachmentNo'])?$_GET['fAttachmentNo']:'';
        $mod->fResultSubmitUser =isset($_GET['fResultSubmitUser'])?trim($_GET['fResultSubmitUser']):'';
        $mod->fResultSubmitDate =isset($_GET['fResultSubmitDate'])?trim($_GET['fResultSubmitDate']):'';
        $mod->fResultConfirmUser =isset($_GET['fResultConfirmUser'])?trim($_GET['fResultConfirmUser']):'';
        $mod->fResultConfirmDate =isset($_GET['fResultConfirmDate'])?$_GET['fResultConfirmDate']:'';
        $mod->fCreateUser =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
        $mod->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
        $mod->fStatus =isset($_GET['fStatus'])?$_GET['fStatus']:'';        
        $item=Item::model()->findByPk($mod->fItemNo);
        $criteria=$mod->AdvancedSearch();        
        $criteria->addCondition("t.fItemNo = :fItemNo");
        $criteria->params[':fItemNo']=$mod->fItemNo;
        if(isset($_GET['cno']) && !(empty($_GET['cno']))){
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
		$pages=new CPagination(Resultdocument::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Resultdocument');		
        $sort->attributes=array(
        		'fTaskNo'=>array('asc'=>'t.fTaskNo','desc'=>'t.fTaskNo desc','label'=>Resultdocument::model()->getAttributeLabel('fTaskNo')),
        		'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')), 
        );
        //$sort->defaultOrder='fResultNo';
        $sort->applyOrder($criteria);
        $models=Resultdocument::model()->with('task')->with('itemCatalogue')->with('CatalogueName')->with('attach')->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {
            $middleLink='';
            $confirm=CHtml::link('<span class="ui-icon ui-icon-pencil"></span>',
            		array('applydocument','id'=>$model->fResultNo),
            		array('class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-confirm',
            				'align'=>'right','title'=>Yii::t('label','Confirm'),
            				'rel'=>$model->fResultNo,
            				));
            $viewattach=(($model->fStatus==0)&&Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
            		'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-attach',
            		'align'=>'right',
            		'rel'=>$model->fAttachmentNo,
            		'title'=>Yii::t('label','ViewAttach'),
            )):'');
            $delete=(($model->fStatus==0)&&Yii::app()->user->checkAccess('Item.resultdocument.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fResultNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right',
            		'rel'=>$model->fResultNo,
                    'title'=>Yii::t('label','Delete')
                )):'');
			switch ($model->fStatus){
				case 'Result_Add':
					if($item->fResponsibleCreate==Yii::app()->params->loginuser->fUserName || (!empty($model->task->fSponsor) && $model->task->fSponsor==Yii::app()->params->loginuser->fUserName)){
					    $middleLink=$confirm.$delete;
					}
					break;
				case 'Result_Refuse':
					$middleLink=$delete;
					break;
			}
			if($model->fDocumentStatus=='Document_Refuse'){
				$middleLink=$middleLink.$delete;
			}
			$data['rows'][]=array('fTaskNo'=>$model->fResultNo,'cell'=>array(
					CHtml::encode(empty($model->task->fTheme)?'':$model->task->fTheme).$middleLink,
					CHtml::encode(empty($model->CatalogueName)?'':$model->CatalogueName->fCatalogueName),
					CHtml::encode(empty($model->attach->fAttachmentName)?'':$model->attach->fAttachmentName).$viewattach,
					CHtml::encode($model->fResultSubmitUser),
					CHtml::encode(empty($model->fResultSubmitDate)?'':date('Y-m-d',$model->fResultSubmitDate)),
					CHtml::encode($model->fResultConfirmUser),
					CHtml::encode(empty($model->fResultConfirmDate)?'':date('Y-m-d',$model->fResultConfirmDate)),
					CHtml::encode($model->fCreateUser),
					CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
					CHtml::encode(array_key_exists($model->fStatus,ItemSettings::$ResultStatus)?ItemSettings::$ResultStatus[$model->fStatus]:''),
					CHtml::encode(array_key_exists($model->fDocumentStatus,ItemSettings::$DocumentStatus)?ItemSettings::$DocumentStatus[$model->fDocumentStatus]:'')
			));
        }
        UFSBaseUtil::printJson($data);
    }
    /**
     * Grid of all models.
     */
    public function actionAllindex()
    {
    	$criteria=new CDbCriteria;
    	$model=new Resultdocument();
    	$model->fTaskNo =isset($_GET['fTaskNo'])?trim($_GET['fTaskNo']):'';
    			$model->fAttachmentNo =isset($_GET['fAttachmentNo'])?$_GET['fAttachmentNo']:'';
    			$model->fResultSubmitUser =isset($_GET['fResultSubmitUser'])?trim($_GET['fResultSubmitUser']):'';
    			$model->fResultSubmitDate =isset($_GET['fResultSubmitDate'])?trim($_GET['fResultSubmitDate']):'';
    			$model->fResultConfirmUser =isset($_GET['fResultConfirmUser'])?trim($_GET['fResultConfirmUser']):'';
    			$model->fResultConfirmDate =isset($_GET['fResultConfirmDate'])?$_GET['fResultConfirmDate']:'';
    			$model->fCreateUser =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
    			$model->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
    			$model->fStatus =isset($_GET['fStatus'])?$_GET['fStatus']:'';
    	$criteria=$model->AdvancedSearch();
    	$pages=new CPagination(Resultdocument::model()->count($criteria));//记录总数
    	$pages->pageSize=5;//设置每页的记录显示条数
    	$pages->applyLimit($criteria);
    
    	$sort=new CSort('Resultdocument');//排序，参考YII文档CSort
    	$sort->attributes=array(
    			'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Resultdocument::model()->getAttributeLabel('fItemNo')),
    			'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Resultdocument::model()->getAttributeLabel('fTaskNo')),
    			'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Resultdocument::model()->getAttributeLabel('fItemNo')),
    			'fResultNo'=>array('asc'=>'fResultNo','desc'=>'fResultNo desc','label'=>Resultdocument::model()->getAttributeLabel('fResultNo')),
    			'fDocumentNo'=>array('asc'=>'fDocumentNo','desc'=>'fDocumentNo desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentNo')),
    			'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Resultdocument::model()->getAttributeLabel('fCatalogueNo')),
    			'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fStatus')),
    			'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
    	);
    	$sort->defaultOrder='fResultNo';
    	$sort->applyOrder($criteria);
    	$models=Resultdocument::model()->findAll($criteria);
    	$gridRows=array();
    	$this->render('allindex',array(
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
    public function actionAllGridData()
    {
    	if(!Yii::app()->request->isPostRequest)
    	{
    		throw new CHttpException(400,Yii::t('http','Invalid request. Please do not repeat this request again.'));
    		exit;
    	}
    	// specify request details
    	$jqGrid=$this->processJqGridRequest();
    	$criteria=new CDbCriteria;
    	$mod=new Resultdocument();
    	$mod->fTaskNo =isset($_GET['fTaskNo'])?trim($_GET['fTaskNo']):'';
    	$mod->fAttachmentNo =isset($_GET['fAttachmentNo'])?$_GET['fAttachmentNo']:'';
    	$mod->fResultSubmitUser =isset($_GET['fResultSubmitUser'])?trim($_GET['fResultSubmitUser']):'';
    	$mod->fResultSubmitDate =isset($_GET['fResultSubmitDate'])?trim($_GET['fResultSubmitDate']):'';
    	$mod->fResultConfirmUser =isset($_GET['fResultConfirmUser'])?trim($_GET['fResultConfirmUser']):'';
    	$mod->fResultConfirmDate =isset($_GET['fResultConfirmDate'])?$_GET['fResultConfirmDate']:'';
    	$mod->fCreateUser =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
    	$mod->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
    	$mod->fStatus =isset($_GET['fStatus'])?$_GET['fStatus']:'';
    	$criteria=$mod->AdvancedSearch();
    	$criteria->addCondition('t.fItemNo != \'\' or t.fItemNo is not NULL');
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
    	$pages=new CPagination(Resultdocument::model()->count($criteria));
    	$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
    	$pages->applyLimit($criteria);
    	// sort
    	$sort=new CSort('Resultdocument');    
    	$sort->attributes=array(
    			'fTaskNo'=>array('asc'=>'t.fTaskNo','desc'=>'t.fTaskNo desc','label'=>Resultdocument::model()->getAttributeLabel('fTaskNo')),
    			'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
    	);
    	//$sort->defaultOrder='fResultNo';
    	$sort->applyOrder($criteria);
    	$models=Resultdocument::model()->with('task')->with('itemCatalogue')->with('CatalogueName')->with('attach')->with('item')->findAll($criteria);
    	$data=array(
    			'page'=>$pages->getCurrentPage()+1,
    			'total'=>$pages->getPageCount(),
    			'records'=>$pages->getItemCount(),
    			'rows'=>array()
    	);
    	foreach($models as $model)
    	{
    		$middleLink='';
    		$confirm=CHtml::link('<span class="ui-icon ui-icon-pencil"></span>',
    				array('applydocument','id'=>$model->fResultNo),
    				array('class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-confirm',
    						'align'=>'right','title'=>Yii::t('label','Confirm'),
    						'rel'=>$model->fResultNo,
    				));
    		$viewattach=(($model->fStatus==0)&&Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
    				'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-attach',
    				'align'=>'right',
    				'rel'=>$model->fAttachmentNo,
    				'title'=>Yii::t('label','ViewAttach'),
    		)):'');
    		$delete=(($model->fStatus==0)&&Yii::app()->user->checkAccess('Item.resultdocument.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fResultNo),array(
    				'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
    				'align'=>'right',
    				'rel'=>$model->fResultNo,
    				'title'=>Yii::t('label','Delete')
    		)):'');
    		switch ($model->fStatus){
    			case 'Result_Add':
    				if($model->item->fResponsibleCreate==Yii::app()->params->loginuser->fUserName || (!empty($model->task->fSponsor) && $model->task->fSponsor==Yii::app()->params->loginuser->fUserName)){
    					$middleLink=$confirm.$delete;
    				}
    				break;
    			case 'Result_Refuse':
    				$middleLink=$delete;
    				break;
    		}
    		if($model->fDocumentStatus=='Document_Refuse'){
    			$middleLink=$middleLink.$delete;
    		}
    		$data['rows'][]=array('fTaskNo'=>$model->fResultNo,'cell'=>array(
    				CHtml::encode(empty($model->item->fItemName)?'':$model->item->fItemName).$middleLink,
    				CHtml::encode(empty($model->task->fTheme)?'':$model->task->fTheme),
    				CHtml::encode(empty($model->CatalogueName)?'':$model->CatalogueName->fCatalogueName),
    				CHtml::encode(empty($model->attach->fAttachmentName)?'':$model->attach->fAttachmentName).$viewattach,
    				CHtml::encode($model->fResultSubmitUser),
    				CHtml::encode(empty($model->fResultSubmitDate)?'':date('Y-m-d',$model->fResultSubmitDate)),
    				CHtml::encode($model->fResultConfirmUser),
    				CHtml::encode(empty($model->fResultConfirmDate)?'':date('Y-m-d',$model->fResultConfirmDate)),
    				CHtml::encode($model->fCreateUser),
    				CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
    				CHtml::encode(array_key_exists($model->fStatus,ItemSettings::$ResultStatus)?ItemSettings::$ResultStatus[$model->fStatus]:''),
    				CHtml::encode(array_key_exists($model->fDocumentStatus,ItemSettings::$DocumentStatus)?ItemSettings::$DocumentStatus[$model->fDocumentStatus]:'')
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
		$model=Resultdocument::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='resultdocument-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Grid of all models.
	 */
	public function actionDocGrid()
	{
		$criteria=new CDbCriteria;
		$model=new Resultdocument();
		if(isset($_GET['id'])) {
			$model->fItemNo=$_GET['id'];
			$item=Item::model()->findByPk($model->fItemNo);
			if($item->fStatus==0){
				$this->redirect($this->createUrl('item/update/id/'.$item->fItemNo));
				return;
			}else{
				 $model->fAttachmentNo =isset($_GET['fAttachmentNo'])?$_GET['fAttachmentNo']:'';
		        $model->fApplyArchiveUser =isset($_GET['fApplyArchiveUser'])?trim($_GET['fApplyArchiveUser']):'';
		        $model->fApplyArchiveDate =isset($_GET['fApplyArchiveDate'])?trim($_GET['fApplyArchiveDate']):'';
		        $model->fArchiveUser =isset($_GET['fArchiveUser'])?trim($_GET['fArchiveUser']):'';
		        $model->fArchiveDate =isset($_GET['fArchiveDate'])?$_GET['fArchiveDate']:'';
		        $model->fCreateUser =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
		        $model->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
		        $model->fDocumentStatus =isset($_GET['fDocumentStatus'])?$_GET['fDocumentStatus']:'';   
			}
		}
		$criteria=$model->AdvancedDocSearch();		
		if(isset($_GET['cno'])){
			$criteria->addCondition("t.fCatalogueNo = :fCatalogueNo");
			$criteria->params[':fCatalogueNo']=$_GET['cno'];
		}
		$pages=new CPagination(Resultdocument::model()->count($criteria));
		$pages->pageSize=Yii::app()->params['pagesize'];
		$pages->applyLimit($criteria);
		$sort=new CSort('Resultdocument');
		$sort->attributes=array(
				'fCatalogueNo'=>array('asc'=>"fCatalogueNo",'desc'=>"fCatalogueNo desc",'label'=>Resultdocument::model()->getAttributeLabel('fCatalogueNo')),
				'fAttachmentNo'=>array('asc'=>"fAttachmentNo",'desc'=>"fAttachmentNo desc",'label'=>Resultdocument::model()->getAttributeLabel('fAttachmentNo')),
				'fResultSubmitUser'=>array('asc'=>"fResultSubmitUser",'desc'=>"fResultSubmitUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitUser')),
				'fResultSubmitDate'=>array('asc'=>"fResultSubmitDate",'desc'=>"fResultSubmitDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitDate')),
				'fResultConfirmUser'=>array('asc'=>"fResultConfirmUser",'desc'=>"fResultConfirmUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmUser')),
				'fResultConfirmDate'=>array('asc'=>"fResultConfirmDate",'desc'=>"fResultConfirmDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmDate')),
				'fApplyArchiveUser'=>array('asc'=>"fApplyArchiveUser",'desc'=>"fApplyArchiveUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveUser')),
				'fApplyArchiveDate'=>array('asc'=>"fApplyArchiveDate",'desc'=>"fApplyArchiveDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveDate')),
				'fArchiveUser'=>array('asc'=>"fArchiveUser",'desc'=>"fArchiveUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fArchiveUser')),
				'fArchiveDate'=>array('asc'=>"fArchiveDate",'desc'=>"fArchiveDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fArchiveDate')),
				'fDocumentStatus'=>array('asc'=>"fDocumentStatus",'desc'=>"fDocumentStatus desc",'label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
		);
		//$sort->defaultOrder="fResultNo";
		$sort->applyOrder($criteria);
		$gridRows=array();
		$this->render('docgrid',array(
				'pages'=>$pages,
				'sort'=>$sort,
				'itemno'=>$model->fItemNo,
				'dataNode'=>$this->GetItemCatalogue($model->fItemNo,'document'),
				'gridRows'=>$gridRows,'model'=>$model,
		));
	}
	
	/**
	 * Print out array of models for the jqGrid rows.
	 */
	public function actionDocGridData()
	{		
		$jqGrid=$this->processJqGridRequest();
		$criteria=new CDbCriteria;
        $mod=new Resultdocument();       
        $mod->fItemNo=isset($_GET['id'])?$_GET['id']:'';
        $mod->fAttachmentNo =isset($_GET['fAttachmentNo'])?$_GET['fAttachmentNo']:'';
        $mod->fApplyArchiveUser =isset($_GET['fApplyArchiveUser'])?trim($_GET['fApplyArchiveUser']):'';
        $mod->fApplyArchiveDate =isset($_GET['fApplyArchiveDate'])?trim($_GET['fApplyArchiveDate']):'';
        $mod->fArchiveUser =isset($_GET['fArchiveUser'])?trim($_GET['fArchiveUser']):'';
        $mod->fArchiveDate =isset($_GET['fArchiveDate'])?$_GET['fArchiveDate']:'';
        $mod->fCreateUser =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
        $mod->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
        $mod->fDocumentStatus =isset($_GET['fDocumentStatus'])?$_GET['fDocumentStatus']:'';        
        $item=Item::model()->findByPk($mod->fItemNo);
        $criteria=$mod->AdvancedDocSearch();              
		$criteria->addCondition("t.fItemNo = :fItemNo");
		$criteria->params[':fItemNo']= $mod->fItemNo;		
		if(isset($_GET['cno']) && (!empty($_GET['cno']))){
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
		$pages=new CPagination(Resultdocument::model()->count($criteria));
		$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
		$pages->applyLimit($criteria);
		$sort=new CSort('Resultdocument');
		$sort->attributes=array(
				'fCatalogueNo'=>array('asc'=>"fCatalogueNo",'desc'=>"fCatalogueNo desc",'label'=>Resultdocument::model()->getAttributeLabel('fCatalogueNo')),
				'fAttachmentNo'=>array('asc'=>"fAttachmentNo",'desc'=>"fAttachmentNo desc",'label'=>Resultdocument::model()->getAttributeLabel('fAttachmentNo')),
				'fResultSubmitUser'=>array('asc'=>"fResultSubmitUser",'desc'=>"fResultSubmitUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitUser')),
				'fResultSubmitDate'=>array('asc'=>"fResultSubmitDate",'desc'=>"fResultSubmitDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitDate')),
				'fResultConfirmUser'=>array('asc'=>"fResultConfirmUser",'desc'=>"fResultConfirmUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmUser')),
				'fResultConfirmDate'=>array('asc'=>"fResultConfirmDate",'desc'=>"fResultConfirmDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmDate')),
				'fApplyArchiveUser'=>array('asc'=>"fApplyArchiveUser",'desc'=>"fApplyArchiveUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveUser')),
				'fApplyArchiveDate'=>array('asc'=>"fApplyArchiveDate",'desc'=>"fApplyArchiveDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveDate')),
				'fArchiveUser'=>array('asc'=>"fArchiveUser",'desc'=>"fArchiveUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fArchiveUser')),
				'fArchiveDate'=>array('asc'=>"fArchiveDate",'desc'=>"fArchiveDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fArchiveDate')),
				'fDocumentStatus'=>array('asc'=>"fDocumentStatus",'desc'=>"fDocumentStatus desc",'label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
		);
		//$sort->defaultOrder="fResultNo";
		$sort->applyOrder($criteria);
		$models=Resultdocument::model()->with('itemCatalogue')->with('CatalogueName')->with('attach')->findAll($criteria);
		$data=array(
				'page'=>$pages->getCurrentPage()+1,
				'total'=>$pages->getPageCount(),
				'records'=>$pages->getItemCount(),
				'rows'=>array()
		);
		foreach($models as $model)
		{
			$middleLink='';
			$applyknowledge=CHtml::link('<span class="ui-icon ui-icon-pencil"></span>',
					array('applyknowledge','id'=>$model->fResultNo),
					array('class'=>'UFSGrid-edit UFSGrid-row-button applyknowledge',
							'align'=>'right','title'=>'入知识库申请','rel'=>$model->fResultNo
							));
			$agreeres=CHtml::link('<span class="ui-icon ui-icon-pencil"></span>',
					array('agreeres','id'=>$model->fResultNo),
					array('class'=>'UFSGrid-show UFSGrid-row-button UFSGrid-row-agree','align'=>'right','rel'=>$model->fResultNo,'title'=>'同意归档',));

			$refuseres=CHtml::link('<span class="ui-icon ui-icon-pencil"></span>',
					array('refuseres','id'=>$model->fResultNo),
					array('class'=>'UFSGrid-show UFSGrid-row-button UFSGrid-row-refuse','align'=>'right','rel'=>$model->fResultNo,'title'=>'拒绝归档'));
			$view=(Yii::app()->user->checkAccess('Item.resultdocument.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fResultNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'');
			$delete=(Yii::app()->user->checkAccess('Item.resultdocument.Delete')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fResultNo),array(
					'class'=>'UFSGrid-show UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right','rel'=>$model->fResultNo,
					'title'=>Yii::t('label','Delete')
			)):'');
			 $viewattach=(Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
            		'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-attach',
            		'align'=>'right',
            		'rel'=>$model->fAttachmentNo,
            		'title'=>Yii::t('label','ViewAttach'),
            )):'');
			switch ($model->fDocumentStatus){
				case 'Document_Add':
					$middleLink=$agreeres.$refuseres;
					break;
				case 'Document_Refuse':
					$middleLink=$agreeres;
					break;
				case 'Document_WaitAgree':
					break;
				case 'Document_Confirm':
					$middleLink=$applyknowledge.$delete;
						break;
			}
			$middleLink=$middleLink.$view;
			$data['rows'][]=array('fTaskNo'=>$model->fResultNo,'cell'=>array(
					CHtml::encode(empty($model->attach)?'':$model->attach->fAttachmentName).$middleLink.$viewattach,
					CHtml::encode($model->CatalogueName->fCatalogueName),
					CHtml::encode($model->fResultSubmitUser),
					CHtml::encode(empty($model->fResultSubmitDate)?'':date('Y-m-d',$model->fResultSubmitDate)),
					CHtml::encode($model->fResultConfirmUser),
					CHtml::encode(empty($model->fResultConfirmDate)?'':date('Y-m-d',$model->fResultConfirmDate)),
					CHtml::encode($model->fApplyArchiveUser),
					CHtml::encode(empty($model->fApplyArchiveDate)?'':date('Y-m-d',$model->fApplyArchiveDate)),
					CHtml::encode($model->fArchiveUser),
					CHtml::encode(empty($model->fArchiveDate)?'':date('Y-m-d',$model->fArchiveDate)),
					CHtml::encode(array_key_exists($model->fDocumentStatus,ItemSettings::$DocumentStatus)?ItemSettings::$DocumentStatus[$model->fDocumentStatus]:'')
			));
		}
		UFSBaseUtil::printJson($data);
	}
	/**
	/**
	 * Grid of all models.
	 */
	public function actionAlldoc()
	{
	    $criteria=new CDbCriteria;
		$model=new Resultdocument();
		$model->fAttachmentNo =isset($_GET['fAttachmentNo'])?$_GET['fAttachmentNo']:'';
        $model->fApplyArchiveUser =isset($_GET['fApplyArchiveUser'])?trim($_GET['fApplyArchiveUser']):'';
        $model->fApplyArchiveDate =isset($_GET['fApplyArchiveDate'])?trim($_GET['fApplyArchiveDate']):'';
        $model->fArchiveUser =isset($_GET['fArchiveUser'])?trim($_GET['fArchiveUser']):'';
        $model->fArchiveDate =isset($_GET['fArchiveDate'])?$_GET['fArchiveDate']:'';
        $model->fCreateUser =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
        $model->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
        $model->fDocumentStatus =isset($_GET['fDocumentStatus'])?$_GET['fDocumentStatus']:'';  
		$criteria=$model->AdvancedDocSearch();		
		if(isset($_GET['cno'])){
			$criteria->addCondition("t.fCatalogueNo = :fCatalogueNo");
			$criteria->params[':fCatalogueNo']=$_GET['cno'];
		}
		$pages=new CPagination(Resultdocument::model()->count($criteria));
		$pages->pageSize=Yii::app()->params['pagesize'];
		$pages->applyLimit($criteria);
		$sort=new CSort('Resultdocument');
		$sort->attributes=array(
				'fCatalogueNo'=>array('asc'=>"fCatalogueNo",'desc'=>"fCatalogueNo desc",'label'=>Resultdocument::model()->getAttributeLabel('fCatalogueNo')),
				'fAttachmentNo'=>array('asc'=>"fAttachmentNo",'desc'=>"fAttachmentNo desc",'label'=>Resultdocument::model()->getAttributeLabel('fAttachmentNo')),
				'fResultSubmitUser'=>array('asc'=>"fResultSubmitUser",'desc'=>"fResultSubmitUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitUser')),
				'fResultSubmitDate'=>array('asc'=>"fResultSubmitDate",'desc'=>"fResultSubmitDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitDate')),
				'fResultConfirmUser'=>array('asc'=>"fResultConfirmUser",'desc'=>"fResultConfirmUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmUser')),
				'fResultConfirmDate'=>array('asc'=>"fResultConfirmDate",'desc'=>"fResultConfirmDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmDate')),
				'fApplyArchiveUser'=>array('asc'=>"fApplyArchiveUser",'desc'=>"fApplyArchiveUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveUser')),
				'fApplyArchiveDate'=>array('asc'=>"fApplyArchiveDate",'desc'=>"fApplyArchiveDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveDate')),
				'fArchiveUser'=>array('asc'=>"fArchiveUser",'desc'=>"fArchiveUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fArchiveUser')),
				'fArchiveDate'=>array('asc'=>"fArchiveDate",'desc'=>"fArchiveDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fArchiveDate')),
				'fDocumentStatus'=>array('asc'=>"fDocumentStatus",'desc'=>"fDocumentStatus desc",'label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
		);
		$sort->defaultOrder="fDocumentStatus";
		$sort->applyOrder($criteria);
		$gridRows=array();
		$this->render('alldoc',array(
				'pages'=>$pages,
				'sort'=>$sort,
				'gridRows'=>$gridRows,'model'=>$model,
		));
	}
	
	/**
	 * Print out array of models for the jqGrid rows.
	 */
	public function actionAllDocGridData()
	{
	 	/* if(!Yii::app()->request->isPostRequest)
		{
			throw new CHttpException(400,Yii::t('http','Invalid request. Please do not repeat this request again.'));
			exit;
		}  */
		$jqGrid=$this->processJqGridRequest();
	     $criteria=new CDbCriteria;
        $mod=new Resultdocument();       
        $mod->fAttachmentNo =isset($_GET['fAttachmentNo'])?$_GET['fAttachmentNo']:'';
        $mod->fApplyArchiveUser =isset($_GET['fApplyArchiveUser'])?trim($_GET['fApplyArchiveUser']):'';
        $mod->fApplyArchiveDate =isset($_GET['fApplyArchiveDate'])?trim($_GET['fApplyArchiveDate']):'';
        $mod->fArchiveUser =isset($_GET['fArchiveUser'])?trim($_GET['fArchiveUser']):'';
        $mod->fArchiveDate =isset($_GET['fArchiveDate'])?$_GET['fArchiveDate']:'';
        $mod->fCreateUser =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
        $mod->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
        $mod->fDocumentStatus =isset($_GET['fDocumentStatus'])?$_GET['fDocumentStatus']:'';        
        $criteria=$mod->AdvancedDocSearch();              	
		if(isset($_GET['cno']) && (!empty($_GET['cno']))){
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
		$pages=new CPagination(Resultdocument::model()->count($criteria));
		$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
		$pages->applyLimit($criteria);
		$sort=new CSort('Resultdocument');
		$sort->attributes=array(
				'fCatalogueNo'=>array('asc'=>"fCatalogueNo",'desc'=>"fCatalogueNo desc",'label'=>Resultdocument::model()->getAttributeLabel('fCatalogueNo')),
				'fAttachmentNo'=>array('asc'=>"fAttachmentNo",'desc'=>"fAttachmentNo desc",'label'=>Resultdocument::model()->getAttributeLabel('fAttachmentNo')),
				'fResultSubmitUser'=>array('asc'=>"fResultSubmitUser",'desc'=>"fResultSubmitUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitUser')),
				'fResultSubmitDate'=>array('asc'=>"fResultSubmitDate",'desc'=>"fResultSubmitDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitDate')),
				'fResultConfirmUser'=>array('asc'=>"fResultConfirmUser",'desc'=>"fResultConfirmUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmUser')),
				'fResultConfirmDate'=>array('asc'=>"fResultConfirmDate",'desc'=>"fResultConfirmDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmDate')),
				'fApplyArchiveUser'=>array('asc'=>"fApplyArchiveUser",'desc'=>"fApplyArchiveUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveUser')),
				'fApplyArchiveDate'=>array('asc'=>"fApplyArchiveDate",'desc'=>"fApplyArchiveDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveDate')),
				'fArchiveUser'=>array('asc'=>"fArchiveUser",'desc'=>"fArchiveUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fArchiveUser')),
				'fArchiveDate'=>array('asc'=>"fArchiveDate",'desc'=>"fArchiveDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fArchiveDate')),
				'fDocumentStatus'=>array('asc'=>"fDocumentStatus",'desc'=>"fDocumentStatus desc",'label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
		);
		$sort->defaultOrder="fDocumentStatus,t.fItemNo";
		$sort->applyOrder($criteria);
		$models=Resultdocument::model()->with('itemCatalogue')->with('CatalogueName')->with('attach')->with('item')->findAll($criteria);
		$data=array(
				'page'=>$pages->getCurrentPage()+1,
				'total'=>$pages->getPageCount(),
				'records'=>$pages->getItemCount(),
				'rows'=>array()
		);

		foreach($models as $model)
		{
			$middleLink='';
			$applyknowledge=CHtml::link('<span class="ui-icon ui-icon-pencil"></span>',
					array('applyknowledge','id'=>$model->fResultNo),
					array('class'=>'UFSGrid-edit UFSGrid-row-button applyknowledge',
							'align'=>'right','title'=>'入知识库申请','rel'=>$model->fResultNo
					));
			$agreeres=CHtml::link('<span class="ui-icon ui-icon-pencil"></span>',
					array('agreeres','id'=>$model->fResultNo),
					array('class'=>'UFSGrid-show UFSGrid-row-button UFSGrid-row-agree','align'=>'right','rel'=>$model->fResultNo,'title'=>'同意归档',));
	
			$refuseres=CHtml::link('<span class="ui-icon ui-icon-pencil"></span>',
					array('refuseres','id'=>$model->fResultNo),
					array('class'=>'UFSGrid-show UFSGrid-row-button UFSGrid-row-refuse','align'=>'right','rel'=>$model->fResultNo,'title'=>'拒绝归档'));
			$view=(Yii::app()->user->checkAccess('Item.resultdocument.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fResultNo),array(
					'class'=>'UFSGrid-show UFSGrid-row-button',
					'align'=>'right',
					'title'=>Yii::t('label','View')
			)):'');
			$delete=(Yii::app()->user->checkAccess('Item.resultdocument.Delete')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fResultNo),array(
					'class'=>'UFSGrid-show UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right','rel'=>$model->fResultNo,
					'title'=>Yii::t('label','Delete')
			)):'');
			$viewattach=(Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
					'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-attach',
					'align'=>'right',
					'rel'=>$model->fAttachmentNo,
					'title'=>Yii::t('label','ViewAttach'),
			)):'');
			switch ($model->fDocumentStatus){
				case 'Document_Add':
					$middleLink=$agreeres.$refuseres;
					break;
				case 'Document_Refuse':
					$middleLink=$agreeres;
					break;
				case 'Document_WaitAgree':
					break;
				case 'Document_Confirm':
					$middleLink=$applyknowledge.$delete;
					break;
			} 
			$data['rows'][]=array('fTaskNo'=>$model->fResultNo,'cell'=>array(
					CHtml::encode(empty($model->item->fItemName)?'':$model->item->fItemName).$middleLink,
					CHtml::encode(empty($model->attach->fAttachmentName)?'':$model->attach->fAttachmentName),
					CHtml::encode(empty($model->CatalogueName->fCatalogueName)?'':$model->CatalogueName->fCatalogueName),
					CHtml::encode($model->fResultSubmitUser),
					CHtml::encode(empty($model->fResultSubmitDate)?'':date('Y-m-d',$model->fResultSubmitDate)),
					CHtml::encode($model->fResultConfirmUser),
					CHtml::encode(empty($model->fResultConfirmDate)?'':date('Y-m-d',$model->fResultConfirmDate)),
					CHtml::encode($model->fApplyArchiveUser),
					CHtml::encode(empty($model->fApplyArchiveDate)?'':date('Y-m-d',$model->fApplyArchiveDate)),
					CHtml::encode($model->fArchiveUser),
					CHtml::encode(empty($model->fArchiveDate)?'':date('Y-m-d',$model->fArchiveDate)),
					CHtml::encode(array_key_exists($model->fDocumentStatus,ItemSettings::$DocumentStatus)?ItemSettings::$DocumentStatus[$model->fDocumentStatus]:'')
			));
		} 

		UFSBaseUtil::printJson($data);
	}
	/**
	 * 成果确认
	 */
	public function actionConfirm($id){
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$res=Resultdocument::model()->findByAttributes(array('fResultNo'=>$id));
			$model=Task::model()->findByPk($res->fTaskNo);
			$res->fResultConfirmUser=Yii::app()->params->loginuser->fUserName;
			$res->fResultConfirmDate=time();
			$res->fStatus='Result_Confirm';
			$res->fIsItemResult=1;
			$res->fIsDocument=0;
			$res->fApplyArchiveUser=Yii::app()->params->loginuser->fUserName;
			$res->fApplyArchiveDate=time();
			$res->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$res->fApplyArchiveDate=time();
			$res->fDocumentStatus='Document_Add';
			$res->fMemo1=Yii::app()->params['res']['confirm']['memo'];
			$res->save();
			if($model!=null){
				//消息发送
				$user=new User();
				$user=User::model()->findByAttributes(array('fUserName'=>$model->fExecutor));
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
					$msg->fSendFromTheme=Yii::app()->params['res']['confirm']['theme'];
					$msg->fSendFromContent=sprintf(Yii::app()->params['res']['confirm']['content'],$model->fTheme);
					$msg->fSendToAllUserNo=$user->fUserID;
					$msg->fSendToAllAccount=$user->fEmail;
					$msg->fSendToAllName=$user->fUserName;
					$msg->fRemark1=Yii::app()->params['res']['confirm']['memo'];
					$msg->fRemark2='';
					$msg->fRemark3='';
					$msg->save();
				}
				//消息发送
				$user=User::model()->findByAttributes(array('fUserName'=>$model->fSponsor));
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
					$msg->fSendFromTheme=Yii::app()->params['res']['confirm']['theme'];
					$msg->fSendFromContent=sprintf(Yii::app()->params['res']['confirm']['content'],$model->fTheme);
					$msg->fSendToAllUserNo=$user->fUserID;
					$msg->fSendToAllAccount=$user->fEmail;
					$msg->fSendToAllName=$user->fUserName;
					$msg->fRemark1=Yii::app()->params['res']['confirm']['memo'];
					$msg->fRemark2='';
					$msg->fRemark3='';
					$msg->save();
				}				
			}
			//同步尽职调查
			$this->CatalogueSynchronization($res->fCatalogueNo,$res->fItemNo,'add','result');
			//发送消息
		$transaction->commit();
		//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	/**
	 * 同意进入文档库
	 */
	public function actionAgree(){
		//发送内部消息，或者邮件
		//更新状态
		$hrefno='';//成果编号
		if(isset($_GET['id'])){
			$hrefno=$_GET['id'];
		}
		$model=Resultdocument::model()->findByPk($hrefno);
        if($model!=null){
        	$transaction = Yii::app()->db->beginTransaction();
        	try {
	        	$model->fArchiveUser=Yii::app()->params->loginuser->fUserName;
	        	$model->fArchiveDate=time();
	        	$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
	        	$model->fUpdateDate=time();
	        	$model->fIsDocument=1;
	        	$model->fDocumentStatus='Document_Confirm';
	        	$model->save();
	        	//同步分类
	        	$this->CatalogueSynchronization($model->fCatalogueNo,$model->fItemNo,'add','document');
	        	//消息发送
	        	$task=Task::model()->findByPk($model->fTaskNo);
	        	if($task!=null ){
	        		$user=User::model()->findByAttributes(array('fUserName'=>$task->fExecutor));
	        	iF($user!=null){
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
	        		$msg->fSendFromTheme=Yii::app()->params['doc']['agree']['theme'];
	        		$msg->fSendFromContent=sprintf(Yii::app()->params['doc']['agree']['content'],$task->fTheme);
	        		$msg->fSendToAllUserNo=$user->fUserID;
	        		$msg->fSendToAllAccount=$user->fEmail;
	        		$msg->fSendToAllName=$user->fUserName;
	        		$msg->fRemark1='';
	        		$msg->fRemark2='';
	        		$msg->fRemark3='';
	        		$msg->save();
	        	}
	        	}
	        	$transaction->commit();
        	//提交事务会真正的执行数据库操作
        	} catch (Exception $e) {
        		$transaction->rollback(); //如果操作失败, 数据回滚
        	}
        }
	}
	/**
	 * 拒绝进入文档库
	 */
	public function actionRefuse(){
	//发送内部消息，或者邮件
		//更新状态
		$hrefno='';//成果编号
		if(isset($_GET['id'])){
			$hrefno=$_GET['id'];
		}
		$model=Resultdocument::model()->findByPk($hrefno);
        if($model!=null){
        	$transaction = Yii::app()->db->beginTransaction();
        	try {
	        	$model->fArchiveUser=Yii::app()->params->loginuser->fUserName;
	        	$model->fArchiveDate=time();
	        	$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
	        	$model->fUpdateDate=time();
	        	$model->fIsDocument=0;
	        	$model->fMemo1=isset($_POST['memo'])?'':$_POST['memo'];
	        	$model->fDocumentStatus='Document_Refuse';
	        	$model->save();
	        	//消息发送
	        	$task=Task::model()->findByPk($model->fTaskNo);
	        	iF($task!=null){
	        		$user=new User();
	        		$msg=new Msgto();
	        		$user=User::model()->findByAttributes(array('fUserName'=>$task->fExecutor));
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
	        		$msg->fSendFromTheme=Yii::app()->params['doc']['refuse']['theme'];
	        		$msg->fSendFromContent=sprintf(Yii::app()->params['doc']['refuse']['content'],$task->fTheme);
	        		$msg->fSendToAllUserNo=$user->fUserID;
	        		$msg->fSendToAllAccount=$user->fEmail;
	        		$msg->fSendToAllName=$user->fUserName;
	        		$msg->fRemark1=$model->fMemo1;
	        		$msg->fRemark2=Yii::app()->params['doc']['refuse']['memo'];
	        		$msg->fRemark3='';
	        		$msg->save();
	        	}
	        	//发送消息通知
	        	$transaction->commit();
        	//提交事务会真正的执行数据库操作
        	} catch (Exception $e) {
        		$transaction->rollback(); //如果操作失败, 数据回滚
        	}
        }
	}
	
	/**
	 * 成果申请进入稳定哭
	 */
	public function actionApplyknowledge(){
		//发送内部消息，或者邮件
		//更新状态
		//uid/'+userno+'/ino/'+itemno+'/hid/'
		$userno='';//用户编号
		$itemno='';//项目编号
		$hrefno='';//成果编号
		$memo='';
		if(isset($_GET['uid'])){
			$userno=$_GET['uid'];
		}
		if(isset($_GET['ino'])){
			$itemno=$_GET['ino'];
		}
		if(isset($_GET['hid'])){
			$hrefno=$_GET['hid'];
		}
		if(isset($_GET['memo'])){
			$memo=$_GET['memo'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Resultdocument::model()->with('attach')->findByAttributes(array('fResultNo'=>$hrefno));
			if(empty($model->fDocumentNo)) $model->fDocumentNo=GuidUtil::getUuid();
			$model->fApplyArchiveUser=Yii::app()->params->loginuser->fUserName;
			$model->fApplyArchiveDate=time();
			$model->fDocumentStatus="Document_WaitAgree";
			$model->save();
	
			$know=new Knowledge();
			$know->fKnowledgeNo=GuidUtil::getUuid();
			$know->fTaskNo=$model->fTaskNo;
			$know->fItemNo=$model->fItemNo;
			$know->fResultNo=$model->fResultNo;
			$know->fCatalogueNo=$model->fCatalogueNo;
			$know->fAttachmentNo=$model->fAttachmentNo;
			$know->fAttachmentName=$model->attach->fAttachmentName;
			$know->fAttachmentFalseName=$model->attach->fAttachmentFalseName;
			$know->fStatus='Knowledge_Apply';
			$know->fSubmitDate=time();
			$know->fSubmitUser='项目负责人';
			$know->fCreate='项目负责人';
			$know->fCreateDate=time();
			$know->save();
	
			$knowledge=Knowledgecatalogue::model()->findByPk($model->fCatalogueNo);
			if(empty($knowledge)){
				$this->InsertKnowledgeCatalogue($model->fCatalogueNo);
			}
			print_r('申请已经发出，请等待。。。');
			$transaction->commit();
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	
	}
	
	/**
	 * 目录结构新增
	 */
	public function InsertKnowledgeCatalogue($CatalogueNo){
		$tempCatalogue=Templatecatalogue::model()->findByAttributes(array('fCatalogueNo'=>$CatalogueNo));
		$knowledgeCatalogue=Knowledgecatalogue::model()->findByPk($CatalogueNo);
		if(empty($knowledgeCatalogue)){
			$this->InsertKnowledgeCatalogue($tempCatalogue->fFatherCatalogueNo);
			$insertCatalogue=new Knowledgecatalogue();
			$insertCatalogue->fCatalogueNo=$tempCatalogue->fCatalogueNo;
			$insertCatalogue->fCatalogueName=$tempCatalogue->fCatalogueName;
			$insertCatalogue->fFatherCatalogueNo=$tempCatalogue->fFatherCatalogueNo;
			$insertCatalogue->fStatus='Knowledge_Temp';
			$insertCatalogue->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$insertCatalogue->fCreateDate=time();
			$insertCatalogue->save();
		}
	}
	/**
	 * 批量下载
	 */
	public function actionBatchdownload(){
		$itemno=isset($_GET['id'])?$_GET['id']:'';
		$criteria=new CDbCriteria;
		$criteria->addCondition("t.fItemNo = :fItemNo");
		$criteria->params[':fItemNo']=$itemno;
		$criteria->addCondition("t.fIsDocument = :fIsDocument");
		$criteria->params[':fIsDocument']=1;
        $pages=new CPagination(Resultdocument::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
        $sort=new CSort('Resultdocument');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Resultdocument::model()->getAttributeLabel('fTaskNo')),
		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Resultdocument::model()->getAttributeLabel('fItemNo')),
		'fResultNo'=>array('asc'=>'fResultNo','desc'=>'fResultNo desc','label'=>Resultdocument::model()->getAttributeLabel('fResultNo')),
		'fDocumentNo'=>array('asc'=>'fDocumentNo','desc'=>'fDocumentNo desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentNo')),
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Resultdocument::model()->getAttributeLabel('fCatalogueNo')),
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fStatus')),
		'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
        );
        $sort->defaultOrder='fResultNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Resultdocument::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
 
		$model=new Resultdocument;
		$model->unsetAttributes();  // clear any default values
        // render the view file
        $this->render('batch',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,'dataNode'=>$this->GetItemCatalogue($itemno,'document'),'keyid'=>$itemno
        ));
	}/**
	 * Print out array of models for the jqGrid rows.
	 */
	public function actionBatchGridData()
	{
		$jqGrid=$this->processJqGridRequest();
		$itemno='';
		if(isset($_GET['id'])) $itemno=$_GET['id'];
		$criteria=new CDbCriteria;
		$criteria->addCondition("t.fItemNo = :fItemNo");
		$criteria->params[':fItemNo']=$itemno;
		$criteria->addCondition("t.fIsDocument = :fIsDocument");
		$criteria->params[':fIsDocument']=1;
		$criteria->addCondition("t.fCatalogueNo = :fCatalogueNo");
		$criteria->params[':fCatalogueNo']=$_GET['cno'];
		if(isset($_GET['cno']) && (!empty($_GET['cno']))){
			$criteria->addCondition("t.fCatalogueNo = :fCatalogueNo");
			$criteria->params[':fCatalogueNo']=$_GET['cno'];
		}
		$pages=new CPagination(Resultdocument::model()->count($criteria));
		$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
		$pages->applyLimit($criteria);
		$sort=new CSort('Resultdocument');
		$sort->attributes=array(
				'fAttachmentNo'=>array('asc'=>"fAttachmentNo",'desc'=>"fAttachmentNo desc",'label'=>Resultdocument::model()->getAttributeLabel('fAttachmentNo')),				
				'fCatalogueNo'=>array('asc'=>"fCatalogueNo",'desc'=>"fCatalogueNo desc",'label'=>Resultdocument::model()->getAttributeLabel('fCatalogueNo')),
				'fResultSubmitUser'=>array('asc'=>"fResultSubmitUser",'desc'=>"fResultSubmitUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitUser')),
				'fResultSubmitDate'=>array('asc'=>"fResultSubmitDate",'desc'=>"fResultSubmitDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitDate')),
				'fResultConfirmUser'=>array('asc'=>"fResultConfirmUser",'desc'=>"fResultConfirmUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmUser')),
				'fResultConfirmDate'=>array('asc'=>"fResultConfirmDate",'desc'=>"fResultConfirmDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmDate')),
				'fApplyArchiveUser'=>array('asc'=>"fApplyArchiveUser",'desc'=>"fApplyArchiveUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveUser')),
				'fApplyArchiveDate'=>array('asc'=>"fApplyArchiveDate",'desc'=>"fApplyArchiveDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveDate')),
				'fArchiveUser'=>array('asc'=>"fArchiveUser",'desc'=>"fArchiveUser desc",'label'=>Resultdocument::model()->getAttributeLabel('fArchiveUser')),
				'fArchiveDate'=>array('asc'=>"fArchiveDate",'desc'=>"fArchiveDate desc",'label'=>Resultdocument::model()->getAttributeLabel('fArchiveDate')),
				'fDocumentStatus'=>array('asc'=>"fDocumentStatus",'desc'=>"fDocumentStatus desc",'label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
		);
		//$sort->defaultOrder="fResultNo";
		$sort->applyOrder($criteria);
		$models=Resultdocument::model()->with('itemCatalogue')->with('CatalogueName')->with('attach')->findAll($criteria);
		$data=array(
				'page'=>$pages->getCurrentPage()+1,
				'total'=>$pages->getPageCount(),
				'records'=>$pages->getItemCount(),
				'rows'=>array()
		);
		foreach($models as $model)
		{
			 $viewattach=(Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
            		'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-attach',
            		'align'=>'right',
            		'rel'=>$model->fAttachmentNo,
            		'title'=>Yii::t('label','ViewAttach'),
            )):'');
			
			$data['rows'][]=array('fTaskNo'=>$model->fResultNo,'cell'=>array(
					CHtml::encode($model->fAttachmentNo),
					CHtml::encode(empty($model->attach)?'':$model->attach->fAttachmentName).$viewattach,
					CHtml::encode($model->CatalogueName->fCatalogueName),
					CHtml::encode($model->fResultSubmitUser),
					CHtml::encode(empty($model->fResultSubmitDate)?'':date('Y-m-d',$model->fResultSubmitDate)),
					CHtml::encode($model->fResultConfirmUser),
					CHtml::encode(empty($model->fResultConfirmDate)?'':date('Y-m-d',$model->fResultConfirmDate)),
					CHtml::encode($model->fApplyArchiveUser),
					CHtml::encode(empty($model->fApplyArchiveDate)?'':date('Y-m-d',$model->fApplyArchiveDate)),
					CHtml::encode($model->fArchiveUser),
					CHtml::encode(empty($model->fArchiveDate)?'':date('Y-m-d',$model->fArchiveDate)),
					CHtml::encode(array_key_exists($model->fDocumentStatus,ItemSettings::$DocumentStatus)?ItemSettings::$DocumentStatus[$model->fDocumentStatus]:'')
			));
		}
		UFSBaseUtil::printJson($data);
	}
	public function actionBatchload(){
		$fileno=isset($_GET['id'])?$_GET['id']:'';
		$transaction = Yii::app()->db->beginTransaction();
		try {
		foreach(explode(",",$fileno) as $attchno){
		
		  $this->Download($attchno);
		}
		//事务提交
		$transaction->commit();
		//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
}
