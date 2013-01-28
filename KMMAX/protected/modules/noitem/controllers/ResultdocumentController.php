<?php

class ResultdocumentController extends ItemCommon
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
		$model=new Resultdocument;
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
				if(empty($attch->fAttachmentId)) $this->redirect(array('index'));
				$model->fAttachmentNo=$attch->fAttachmentId;
				$model->save();
				//事务提交
				$transaction->commit();
				$this->redirect(array('view','id'=>$model->fResultNo));
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
		$model=new Resultdocument;
		$model->fStatus=isset($_GET['fStatus'])?trim($_GET['fStatus']):'';
		$model->fAttachmentNo =isset($_GET['fAttachmentNo'])?$_GET['fAttachmentNo']:'';
		$model->fResultSubmitUser =isset($_GET['fResultSubmitUser'])?$_GET['fResultSubmitUser']:'';
		$model->fResultSubmitDate =isset($_GET['fResultSubmitDate'])?trim($_GET['fResultSubmitDate']):'';
		$model->fResultConfirmUser =isset($_GET['fResultConfirmUser'])?trim($_GET['fResultConfirmUser']):'';
		$model->fResultConfirmDate =isset($_GET['fResultConfirmDate'])?$_GET['fResultConfirmDate']:'';
		$model->fArchiveUser =isset($_GET['fArchiveUser'])?$_GET['fArchiveUser']:'';
		$model->fArchiveDate =isset($_GET['fArchiveDate'])?$_GET['fArchiveDate']:'';
		$model->fApplyArchiveUser =isset($_GET['fApplyArchiveUser'])?$_GET['fApplyArchiveUser']:'';
		$model->fApplyArchiveDate =isset($_GET['fApplyArchiveDate'])?$_GET['fApplyArchiveDate']:'';
		$model->fCreateUser =isset($_GET['fCreateUser'])?$_GET['fCreateUser']:'';
		$model->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
		$criteria=$model->NoItemAdvancedSearch();
        $pages=new CPagination(Resultdocument::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);		
        $sort=new CSort('Resultdocument');//排序，参考YII文档CSort
        $sort->attributes=array(
        'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Resultdocument::model()->getAttributeLabel('fTaskNo')),
		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Resultdocument::model()->getAttributeLabel('fItemNo')),
		'fResultNo'=>array('asc'=>'fResultNo','desc'=>'fResultNo desc','label'=>Resultdocument::model()->getAttributeLabel('fResultNo')),
		'fDocumentNo'=>array('asc'=>'fDocumentNo','desc'=>'fDocumentNo desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentNo')),			
		/*
		'fAttachmentNo'=>array('asc'=>'fAttachmentNo','desc'=>'fAttachmentNo desc','label'=>Resultdocument::model()->getAttributeLabel('fAttachmentNo')),
		'fIsDocument'=>array('asc'=>'fIsDocument','desc'=>'fIsDocument desc','label'=>Resultdocument::model()->getAttributeLabel('fIsDocument')),
		'fIsItemResult'=>array('asc'=>'fIsItemResult','desc'=>'fIsItemResult desc','label'=>Resultdocument::model()->getAttributeLabel('fIsItemResult')),
		'fResultSubmitUser'=>array('asc'=>'fResultSubmitUser','desc'=>'fResultSubmitUser desc','label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitUser')),
		'fResultSubmitDate'=>array('asc'=>'fResultSubmitDate','desc'=>'fResultSubmitDate desc','label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitDate')),
		'fResultConfirmUser'=>array('asc'=>'fResultConfirmUser','desc'=>'fResultConfirmUser desc','label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmUser')),
		'fResultConfirmDate'=>array('asc'=>'fResultConfirmDate','desc'=>'fResultConfirmDate desc','label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmDate')),
		'fArchiveUser'=>array('asc'=>'fArchiveUser','desc'=>'fArchiveUser desc','label'=>Resultdocument::model()->getAttributeLabel('fArchiveUser')),
		'fArchiveDate'=>array('asc'=>'fArchiveDate','desc'=>'fArchiveDate desc','label'=>Resultdocument::model()->getAttributeLabel('fArchiveDate')),
		'fApplyArchiveUser'=>array('asc'=>'fApplyArchiveUser','desc'=>'fApplyArchiveUser desc','label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveUser')),
		'fApplyArchiveDate'=>array('asc'=>'fApplyArchiveDate','desc'=>'fApplyArchiveDate desc','label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Resultdocument::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Resultdocument::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Resultdocument::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Resultdocument::model()->getAttributeLabel('fUpdateDate')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Resultdocument::model()->getAttributeLabel('fUserGroup')),
		'fMemo1'=>array('asc'=>'fMemo1','desc'=>'fMemo1 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo1')),
		'fMemo2'=>array('asc'=>'fMemo2','desc'=>'fMemo2 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo2')),
		'fMemo3'=>array('asc'=>'fMemo3','desc'=>'fMemo3 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo3')),
		'fMemo4'=>array('asc'=>'fMemo4','desc'=>'fMemo4 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo4')),
		'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
		*/
        );
        $sort->defaultOrder='fResultNo';
        $sort->applyOrder($criteria);
        // find all
        $models=Resultdocument::model()->findAll($criteria);
        // rows for the static grid
        $gridRows=array(); 	
		$itemCommon=new ItemCommonController();
		$dataNode = $itemCommon->GetKnowledgeCatalogue();
        // render the view file
        $this->render('index',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,'dataNode'=>$dataNode,
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
        $model=new Resultdocument;
        $model->fStatus =isset($_GET['fStatus'])?trim($_GET['fStatus']):'';
        $model->fAttachmentNo =isset($_GET['fAttachmentNo'])?$_GET['fAttachmentNo']:'';
        $model->fResultSubmitUser =isset($_GET['fResultSubmitUser'])?$_GET['fResultSubmitUser']:'';
        $model->fResultSubmitDate =isset($_GET['fResultSubmitDate'])?trim($_GET['fResultSubmitDate']):'';
        $model->fResultConfirmUser =isset($_GET['fResultConfirmUser'])?trim($_GET['fResultConfirmUser']):'';
        $model->fResultConfirmDate =isset($_GET['fResultConfirmDate'])?$_GET['fResultConfirmDate']:'';
        $model->fArchiveUser =isset($_GET['fArchiveUser'])?$_GET['fArchiveUser']:'';
        $model->fArchiveDate =isset($_GET['fArchiveDate'])?$_GET['fArchiveDate']:'';
        $model->fApplyArchiveUser =isset($_GET['fApplyArchiveUser'])?$_GET['fApplyArchiveUser']:'';
        $model->fApplyArchiveDate =isset($_GET['fApplyArchiveDate'])?$_GET['fApplyArchiveDate']:'';
        $model->fCreateUser =isset($_GET['fCreateUser'])?$_GET['fCreateUser']:'';
        $model->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
        $criteria=$model->NoItemAdvancedSearch();
        if(isset($_GET['cno'])){
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
         'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Resultdocument::model()->getAttributeLabel('fTaskNo')),
		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Resultdocument::model()->getAttributeLabel('fItemNo')),
		'fResultNo'=>array('asc'=>'fResultNo','desc'=>'fResultNo desc','label'=>Resultdocument::model()->getAttributeLabel('fResultNo')),
		'fDocumentNo'=>array('asc'=>'fDocumentNo','desc'=>'fDocumentNo desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentNo')),		
		/*
		'fAttachmentNo'=>array('asc'=>'fAttachmentNo','desc'=>'fAttachmentNo desc','label'=>Resultdocument::model()->getAttributeLabel('fAttachmentNo')),
		'fIsDocument'=>array('asc'=>'fIsDocument','desc'=>'fIsDocument desc','label'=>Resultdocument::model()->getAttributeLabel('fIsDocument')),
		'fIsItemResult'=>array('asc'=>'fIsItemResult','desc'=>'fIsItemResult desc','label'=>Resultdocument::model()->getAttributeLabel('fIsItemResult')),
		'fResultSubmitUser'=>array('asc'=>'fResultSubmitUser','desc'=>'fResultSubmitUser desc','label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitUser')),
		'fResultSubmitDate'=>array('asc'=>'fResultSubmitDate','desc'=>'fResultSubmitDate desc','label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitDate')),
		'fResultConfirmUser'=>array('asc'=>'fResultConfirmUser','desc'=>'fResultConfirmUser desc','label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmUser')),
		'fResultConfirmDate'=>array('asc'=>'fResultConfirmDate','desc'=>'fResultConfirmDate desc','label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmDate')),
		'fArchiveUser'=>array('asc'=>'fArchiveUser','desc'=>'fArchiveUser desc','label'=>Resultdocument::model()->getAttributeLabel('fArchiveUser')),
		'fArchiveDate'=>array('asc'=>'fArchiveDate','desc'=>'fArchiveDate desc','label'=>Resultdocument::model()->getAttributeLabel('fArchiveDate')),
		'fApplyArchiveUser'=>array('asc'=>'fApplyArchiveUser','desc'=>'fApplyArchiveUser desc','label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveUser')),
		'fApplyArchiveDate'=>array('asc'=>'fApplyArchiveDate','desc'=>'fApplyArchiveDate desc','label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Resultdocument::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Resultdocument::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Resultdocument::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Resultdocument::model()->getAttributeLabel('fUpdateDate')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Resultdocument::model()->getAttributeLabel('fUserGroup')),
		'fMemo1'=>array('asc'=>'fMemo1','desc'=>'fMemo1 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo1')),
		'fMemo2'=>array('asc'=>'fMemo2','desc'=>'fMemo2 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo2')),
		'fMemo3'=>array('asc'=>'fMemo3','desc'=>'fMemo3 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo3')),
		'fMemo4'=>array('asc'=>'fMemo4','desc'=>'fMemo4 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo4')),
		'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
		*/'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
        );
        //$sort->defaultOrder='fResultNo';
        $sort->applyOrder($criteria);
        $criteria->addCondition("task.fIsItem = :fIsItem");
        $criteria->params[':fIsItem']='ItemUse_No'; 
        $criteria->addCondition("t.fResultSubmitUser = :fResultSubmitUser");
        $criteria->params[':fResultSubmitUser']=Yii::app()->params->loginuser->fUserName;
        // find all
        $models=Resultdocument::model()->with('task')->with('knowcatalogue')->with('attach')->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );        
        foreach($models as $model)
        {
            $middleLink='';
            
			$applydocument=(Yii::app()->user->checkAccess('noitem.resultdocument.applyknowledge')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('applyknowledge','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button  UFSGrid-row-applyknowledge',
                    'align'=>'right', 'rel'=>$model->fResultNo,
					'title'=>Yii::t('label',Yii::t('label','ApplyKnowledge'))
                )):'');
		    if($model->fDocumentStatus=='Document_Add') $middleLink=$applydocument;
		    $delete= (Yii::app()->user->checkAccess('noitem.resultdocument.Delete')?CHtml::link("<span class='ui-row ui-row-delete'></span>",array('delete','id'=>$model->fResultNo),array(
		    		'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
		    		'align'=>'right',
		    		'rel'=>$model->fResultNo,
		    		'title'=>Yii::t('label','Delete')
		    )):'');
		    $viewattach=(Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
		    		'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-attach',
		    		'align'=>'right',
		    		'rel'=>$model->attach->fAttachmentId,
		    		'title'=>Yii::t('label','ViewAttach'),
		    )):'');
			$data['rows'][]=array('fTaskNo'=>$model->fResultNo,'cell'=>array(
					CHtml::encode(empty($model->task)?'':$model->task->fTheme).$middleLink.$delete,
					CHtml::encode(empty($model->knowcatalogue)?'':$model->knowcatalogue->fCatalogueName),
					CHtml::encode(empty($model->attach)?'':$model->attach->fAttachmentName).$viewattach,
					CHtml::encode($model->fResultSubmitUser),
					CHtml::encode($model->fResultSubmitDate==''?'':date('Y-m-d',$model->fResultSubmitDate)),
					CHtml::encode($model->fResultConfirmUser),
					CHtml::encode($model->fResultConfirmDate==''?'':date('Y-m-d',$model->fResultConfirmDate)),
					CHtml::encode($model->fApplyArchiveUser),
					CHtml::encode(date('Y-m-d',$model->fApplyArchiveDate)),
					CHtml::encode($model->fArchiveUser),
					CHtml::encode(date('Y-m-d',$model->fArchiveDate)),
					CHtml::encode(array_key_exists($model->fDocumentStatus,ItemSettings::$DocumentStatus)?ItemSettings::$DocumentStatus[$model->fDocumentStatus]:Yii::t('label','NotApply')),						
					CHtml::encode($model->fCreateUser),
					CHtml::encode(date('Y-m-d',$model->fCreateDate)),
			));
        }
        UFSBaseUtil::printJson($data);
    }
    /**
     * Grid of all models.
     */
    public function actionAlldoc()
    {
    	$criteria=new CDbCriteria;
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
    			
    			/*
    			 'fAttachmentNo'=>array('asc'=>'fAttachmentNo','desc'=>'fAttachmentNo desc','label'=>Resultdocument::model()->getAttributeLabel('fAttachmentNo')),
    	'fIsDocument'=>array('asc'=>'fIsDocument','desc'=>'fIsDocument desc','label'=>Resultdocument::model()->getAttributeLabel('fIsDocument')),
    	'fIsItemResult'=>array('asc'=>'fIsItemResult','desc'=>'fIsItemResult desc','label'=>Resultdocument::model()->getAttributeLabel('fIsItemResult')),
    	'fResultSubmitUser'=>array('asc'=>'fResultSubmitUser','desc'=>'fResultSubmitUser desc','label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitUser')),
    	'fResultSubmitDate'=>array('asc'=>'fResultSubmitDate','desc'=>'fResultSubmitDate desc','label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitDate')),
    	'fResultConfirmUser'=>array('asc'=>'fResultConfirmUser','desc'=>'fResultConfirmUser desc','label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmUser')),
    	'fResultConfirmDate'=>array('asc'=>'fResultConfirmDate','desc'=>'fResultConfirmDate desc','label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmDate')),
    	'fArchiveUser'=>array('asc'=>'fArchiveUser','desc'=>'fArchiveUser desc','label'=>Resultdocument::model()->getAttributeLabel('fArchiveUser')),
    	'fArchiveDate'=>array('asc'=>'fArchiveDate','desc'=>'fArchiveDate desc','label'=>Resultdocument::model()->getAttributeLabel('fArchiveDate')),
    	'fApplyArchiveUser'=>array('asc'=>'fApplyArchiveUser','desc'=>'fApplyArchiveUser desc','label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveUser')),
    	'fApplyArchiveDate'=>array('asc'=>'fApplyArchiveDate','desc'=>'fApplyArchiveDate desc','label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveDate')),
    	'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Resultdocument::model()->getAttributeLabel('fCreateUser')),
    	'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Resultdocument::model()->getAttributeLabel('fCreateDate')),
    	'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Resultdocument::model()->getAttributeLabel('fUpdateUser')),
    	'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Resultdocument::model()->getAttributeLabel('fUpdateDate')),
    	'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Resultdocument::model()->getAttributeLabel('fUserGroup')),
    	'fMemo1'=>array('asc'=>'fMemo1','desc'=>'fMemo1 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo1')),
    	'fMemo2'=>array('asc'=>'fMemo2','desc'=>'fMemo2 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo2')),
    	'fMemo3'=>array('asc'=>'fMemo3','desc'=>'fMemo3 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo3')),
    	'fMemo4'=>array('asc'=>'fMemo4','desc'=>'fMemo4 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo4')),
    	'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
    	*/'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
    	);
    	$sort->defaultOrder='fResultNo';
    	$sort->applyOrder($criteria);
    
    	// find all
    	$models=Resultdocument::model()->findAll($criteria);
    
    	// rows for the static grid
    	$gridRows=array();
    
    	$model=new Resultdocument;
    	$model->unsetAttributes();  // clear any default values
    	$itemCommon=new ItemCommonController();
    	$dataNode = $itemCommon->GetKnowledgeCatalogue();
    	// render the view file
    	$this->render('alldoc',array(
    			'models'=>$models,
    			'pages'=>$pages,
    			'sort'=>$sort,
    			'gridRows'=>$gridRows,
    			'model'=>$model,'dataNode'=>$dataNode,
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
    	if(isset($_GET['cno'])){
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
    			'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Resultdocument::model()->getAttributeLabel('fTaskNo')),
    			'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Resultdocument::model()->getAttributeLabel('fItemNo')),
    			'fResultNo'=>array('asc'=>'fResultNo','desc'=>'fResultNo desc','label'=>Resultdocument::model()->getAttributeLabel('fResultNo')),
    			'fDocumentNo'=>array('asc'=>'fDocumentNo','desc'=>'fDocumentNo desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentNo')),
    			'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Resultdocument::model()->getAttributeLabel('fCatalogueNo')),
    			
    			/*
    			 'fAttachmentNo'=>array('asc'=>'fAttachmentNo','desc'=>'fAttachmentNo desc','label'=>Resultdocument::model()->getAttributeLabel('fAttachmentNo')),
    	'fIsDocument'=>array('asc'=>'fIsDocument','desc'=>'fIsDocument desc','label'=>Resultdocument::model()->getAttributeLabel('fIsDocument')),
    	'fIsItemResult'=>array('asc'=>'fIsItemResult','desc'=>'fIsItemResult desc','label'=>Resultdocument::model()->getAttributeLabel('fIsItemResult')),
    	'fResultSubmitUser'=>array('asc'=>'fResultSubmitUser','desc'=>'fResultSubmitUser desc','label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitUser')),
    	'fResultSubmitDate'=>array('asc'=>'fResultSubmitDate','desc'=>'fResultSubmitDate desc','label'=>Resultdocument::model()->getAttributeLabel('fResultSubmitDate')),
    	'fResultConfirmUser'=>array('asc'=>'fResultConfirmUser','desc'=>'fResultConfirmUser desc','label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmUser')),
    	'fResultConfirmDate'=>array('asc'=>'fResultConfirmDate','desc'=>'fResultConfirmDate desc','label'=>Resultdocument::model()->getAttributeLabel('fResultConfirmDate')),
    	'fArchiveUser'=>array('asc'=>'fArchiveUser','desc'=>'fArchiveUser desc','label'=>Resultdocument::model()->getAttributeLabel('fArchiveUser')),
    	'fArchiveDate'=>array('asc'=>'fArchiveDate','desc'=>'fArchiveDate desc','label'=>Resultdocument::model()->getAttributeLabel('fArchiveDate')),
    	'fApplyArchiveUser'=>array('asc'=>'fApplyArchiveUser','desc'=>'fApplyArchiveUser desc','label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveUser')),
    	'fApplyArchiveDate'=>array('asc'=>'fApplyArchiveDate','desc'=>'fApplyArchiveDate desc','label'=>Resultdocument::model()->getAttributeLabel('fApplyArchiveDate')),
    	'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Resultdocument::model()->getAttributeLabel('fCreateUser')),
    	'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Resultdocument::model()->getAttributeLabel('fCreateDate')),
    	'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Resultdocument::model()->getAttributeLabel('fUpdateUser')),
    	'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Resultdocument::model()->getAttributeLabel('fUpdateDate')),
    	'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Resultdocument::model()->getAttributeLabel('fUserGroup')),
    	'fMemo1'=>array('asc'=>'fMemo1','desc'=>'fMemo1 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo1')),
    	'fMemo2'=>array('asc'=>'fMemo2','desc'=>'fMemo2 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo2')),
    	'fMemo3'=>array('asc'=>'fMemo3','desc'=>'fMemo3 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo3')),
    	'fMemo4'=>array('asc'=>'fMemo4','desc'=>'fMemo4 desc','label'=>Resultdocument::model()->getAttributeLabel('fMemo4')),
    	'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
    	*/'fDocumentStatus'=>array('asc'=>'fDocumentStatus','desc'=>'fDocumentStatus desc','label'=>Resultdocument::model()->getAttributeLabel('fDocumentStatus')),
    	);
    	$sort->defaultOrder='fDocumentStatus,t.fCreateUser';
    	$sort->applyOrder($criteria);
    	$criteria->addCondition("task.fIsItem = 'ItemUse_No'");

    	$models=Resultdocument::model()->with('task')->with('knowcatalogue')->with('attach')->findAll($criteria);
    	$data=array(
    			'page'=>$pages->getCurrentPage()+1,
    			'total'=>$pages->getPageCount(),
    			'records'=>$pages->getItemCount(),
    			'rows'=>array()
    	);
    
    	foreach($models as $model)
    	{
    		$middleLink='';
    		$applydocument=(Yii::app()->user->checkAccess('noitem.resultdocument.applyknowledge')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('applyknowledge','id'=>$model->fTaskNo),array(
    				'class'=>'UFSGrid-show UFSGrid-row-button  UFSGrid-row-applyknowledge',
    				'align'=>'right', 'rel'=>$model->fResultNo,
    				'title'=>Yii::t('label',Yii::t('label','ApplyKnowledge'))
    		)):'');
    		if($model->fDocumentStatus=='Document_Add') $middleLink=$applydocument;
    		$delete= (Yii::app()->user->checkAccess('noitem.resultdocument.Delete')?CHtml::link("<span class='ui-row ui-row-delete'></span>",array('delete','id'=>$model->fResultNo),array(
    				'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
    				'align'=>'right',
    				'rel'=>$model->fResultNo,
    				'title'=>Yii::t('label','Delete')
    		)):'');
    		$viewattach=(Yii::app()->user->checkAccess('Item.attachment.View')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('view','id'=>$model->fAttachmentNo),array(
    				'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-attach',
    				'align'=>'right',
    				'rel'=>empty($model->attach->fAttachmentId)?'':$model->attach->fAttachmentId,
    				'title'=>Yii::t('label','ViewAttach'),
    		)):'');
    		$data['rows'][]=array('fTaskNo'=>$model->fResultNo,'cell'=>array(
    				CHtml::encode(empty($model->task)?'':$model->task->fTheme).$middleLink.$delete,
    				CHtml::encode(empty($model->knowcatalogue)?'':$model->knowcatalogue->fCatalogueName),
    				CHtml::encode(empty($model->attach)?'':$model->attach->fAttachmentName).$viewattach,
    				CHtml::encode($model->fResultSubmitUser),
    				CHtml::encode($model->fResultSubmitDate==''?'':date('Y-m-d',$model->fResultSubmitDate)),
    				CHtml::encode($model->fResultConfirmUser),
    				CHtml::encode($model->fResultConfirmDate==''?'':date('Y-m-d',$model->fResultConfirmDate)),
    				CHtml::encode($model->fApplyArchiveUser),
    				CHtml::encode(date('Y-m-d',$model->fApplyArchiveDate)),
    				CHtml::encode($model->fArchiveUser),
    				CHtml::encode(date('Y-m-d',$model->fArchiveDate)),
    				CHtml::encode(array_key_exists($model->fDocumentStatus,ItemSettings::$DocumentStatus)?ItemSettings::$DocumentStatus[$model->fDocumentStatus]:Yii::t('label','NotApply')),
    				CHtml::encode($model->fCreateUser),
    				CHtml::encode(date('Y-m-d',$model->fCreateDate)),
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
			$model->fApplyArchiveUser='测试用户';
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
			$insertCatalogue->fCreateUser='测试用户';
			$insertCatalogue->fCreateDate=time();
			$insertCatalogue->save();
		}
	}
}
