<?php

class ItemController extends ItemCommon
{	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionNavigation($id)
	{
		$model=$this->loadModel($id);
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
		$task = new Task();
		$result=new Resultdocument();
		$this->render('navigation',array(
				'keyid'=>$id,'taskGraphs'=> $task->GetTaskGrap($id),'resultGraphs'=> $result->GetResultGrap($id),'docGraphs'=> $result->GetDocGrap($id),'model'=>$model,'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Handle Success'),Yii::app()->params['notytype']['success'])
		));
	}		
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$history=History::model()->findByAttributes(array('fItemNo'=>$id));
		$stockStructure=new StockStructure();
		$latestStockStructure=new LatestStockStructure();
		if($history==null)
			$history=new History();
		else{
			$stockStructure=StockStructure::model()->findByAttributes(array('fHistoryNo'=>$history->fHistoryNo,'fItemNo'=>$id));
			if($stockStructure==null)
				$stockStructure=new StockStructure();			
			$latestStockStructure=LatestStockStructure::model()->findByAttributes(array('fHistoryNo'=>$history->fHistoryNo,'fItemNo'=>$id));
			if($latestStockStructure==null)
				$latestStockStructure=new LatestStockStructure();
		}
		$financeAccounting=FinanceAccounting::model()->findByAttributes(array('fItemNo'=>$id));
		if($financeAccounting==null)
			$financeAccounting=new FinanceAccounting();
		$itemplan=new ItemPlan();
		$model=Item::model()->with('template')->findByPk($id);
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
		$model->fTemplateNo=empty($model->template->fTemplateName)?'':$model->template->fTemplateName;
		$model->fStatus=array_key_exists($model->fStatus,Yii::app()->params['itemStatus'])?Yii::app()->params['itemStatus'][$model->fStatus]:'';
		$this->render('view',array(
			'model'=>$model,
			'keyid'=>$id,'history'=>$history,'stockStructure'=>$stockStructure,
				'financeAccounting'=>$financeAccounting,'itemplan'=>$itemplan,'fItemType'=>ItemSettings::$ItemType,'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Handle Success'),Yii::app()->params['notytype']['success'])
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionInit()
	{
		$model=new Item;
		if(isset($_POST['Item']))
		{
			/* 项目初始化 */
			$transaction = Yii::app()->db->beginTransaction();
			try {
				$model->attributes=$_POST['Item'];
				$model->fItemNo=GuidUtil::getUuid();
				$model->fStatus=0;
				$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
				$model->fCreateDate=time();
				$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
				$model->fUpdateDate=time();
					
				//同步模板任务
				$temptasks=Templetstandardtask::model()->with('task')->findAllByAttributes(array('fTemplateNo'=>$model->fTemplateNo));
				foreach ($temptasks as $temptask){
					$task=new Task();
					$task->fTaskNo=GuidUtil::getUuid();
					$task->fItemNo=$model->fItemNo;
					$task->fTheme=$temptask->task->fTheme;
					$task->fSponsor='管理员';
					$task->fCatalogueNo=$temptask->task->fCatalogueNo;
					$task->fContent=$temptask->task->fContent;
					$task->fRemarks=$temptask->task->fRemarks;
					$task->fWarnFrequency=$temptask->task->fWarnFrequency;
					$task->fTaskType=$temptask->task->fTaskType;
					$task->fPriority=$temptask->task->fPriority;
					$task->fIsItem='ItemUse_Yes';
					$task->fCreateDate=time();
					$task->fUpdateDate=$task->fCreateDate;
					$task->fSchedule='0';
					$task->fStatus=ItemSettings::$TaskStatus['Task_Add'];//新提交状态
					$task->save();
					$attach=new Attachment();
					$attach->fAttachmentId=GuidUtil::getUuid();
					$attach->fTaskNo=$task->fTaskNo;
					$attach->fCatalogueNo=$temptask->task->fCatalogueNo;
					$attach->fCreateUser=Yii::app()->params->loginuser->fUserName;
					$attach->fCreateDate=time();
					$attach->fAttachmentName=$temptask->task->fAttachName;
					$attach->fAttachmentFalseName=$temptask->task->fAttachFalseName;
					$attach->save();
				}
		
				//同步分类
				$sql="insert into tbl_itemcatalogue(fCatalogueNo,fItemNo,fTemplateNo,fIsActive,fSort,fStatus,fWarnRate,fWarnStart,fWarnEnd,fFatherCatalogueNo,FuserGroup,fWaitFinishingNum,fFinishedNum,fResultNum,fDocumentNum,fCreateUser, fCreateDate, fUpdateUser, fUpdateDate)
                  select fCatalogueNo,'".$model->fItemNo."',fTemplateNo,fIsActive,fSort,0,fWarnRate,fWarnStart,fWarnEnd,fFatherCatalogueNo,fUserGroup,0,0,0,0,fCreateUser, fCreateDate, fUpdateUser, fUpdateDate
                  from tbl_templatecatalogue where fTemplateNo='".$model->fTemplateNo."' or fTemplateNo='';";
				Yii::app()->db->createCommand($sql)->query();
					
				$model->save();

				$user=User::model()->findByAttributes(array('fUserName'=>$model->fResponsibleCreate));
				//消息发送
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
				$msg->fSendFromTheme=Yii::app()->params['item']['init']['theme'];
				$msg->fSendFromContent=sprintf(Yii::app()->params['item']['init']['content'],$model->fItemName);
				$msg->fSendToAllUserNo=$user->fUserID;
				$msg->fSendToAllAccount=$user->fEmail;
				$msg->fSendToAllName=$user->fUserName;
				$msg->fRemark1='';
				$msg->fRemark2='';
				$msg->fRemark3='';
				$msg->save();
				/*项目保存*/
				$transaction->commit();
				$this->redirect(array('view','id'=>$model->fItemNo));
				//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}
		$criteria=new CDbCriteria;
		$criteria->addCondition("fStatus=1");
		$criteria->limit =1;
		$criteria->order = 'fUpdateDate DESC' ;
		$Templatemodels=Template::model()->find($criteria);
		$model->fTemplateNo=$Templatemodels->fTemplateNo;
		$this->render('init',array(
				'model'=>$model,'fTemplateName'=>$Templatemodels->fTemplateName,'fItemType'=>ItemSettings::$ItemType
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionInitupdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Item']))
		{
			/* 项目初始化 */
			$transaction = Yii::app()->db->beginTransaction();
			try {
				$model->attributes=$_POST['Item'];
				$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
				$model->fUpdateDate=time();
				$model->save();
				$user=User::model()->findByAttributes(array('fUserName'=>$model->fResponsibleCreate));
				//消息发送
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
				$msg->fSendFromTheme=Yii::app()->params['item']['init']['theme'];
				$msg->fSendFromContent=sprintf(Yii::app()->params['item']['init']['content'],$model->fItemName);
				$msg->fSendToAllUserNo=$user->fUserID;
				$msg->fSendToAllAccount=$user->fEmail;
				$msg->fSendToAllName=$user->fUserName;
				$msg->fRemark1='';
				$msg->fRemark2='';
				$msg->fRemark3='';
				$msg->save();
				/*项目保存*/
				$transaction->commit();
				$this->redirect(array('view','id'=>$model->fItemNo));
				//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}
		$Templatemodels=Template::model()->findByPk($model->fTemplateNo);
		$this->render('initupdate',array(
				'model'=>$model,'fTemplateName'=>empty($Templatemodels->fTemplateName)?'':$Templatemodels->fTemplateName
				,'fItemType'=>ItemSettings::$ItemType,'fStatus'=>Yii::app()->params['itemStatus'],
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Item;
		if(isset($_POST['Item']))
		{
			$model->attributes=$_POST['Item'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fItemNo));
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
		if(isset($_POST['Item']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try {
			$model->attributes=$_POST['Item'];
			$model->fStatus=1;
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			$model->save();
			$transaction->commit();
			$this->redirect(array('view','id'=>$model->fItemNo));
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}
		
		if(isset($_GET['id'])){
			$model=Item::model()->with('template')->findByPk($_GET['id']);
		
			$history=History::model()->findByAttributes(array('fItemNo'=>$model->fItemNo));
			if($history==''){
				$history=new History();
				$history->fHistoryNo=GuidUtil::getUuid();
				$history->fItemNo=$model->fItemNo;
			}
			$stockStructure=StockStructure::model()->findByAttributes(array('fHistoryNo'=>$history->fHistoryNo,'fItemNo'=>$model->fItemNo));
			if($stockStructure==''){
				$stockStructure=new StockStructure();
				$stockStructure->fSSNo=GuidUtil::getUuid();
				$stockStructure->fHistoryNo=$history->fHistoryNo;
				$stockStructure->fItemNo=$model->fItemNo;
			}
			$latestStockStructure=StockStructure::model()->findByAttributes(array('fHistoryNo'=>$history->fHistoryNo,'fItemNo'=>$model->fItemNo));
			if($latestStockStructure==''){
				$latestStockStructure=new LatestStockStructure();
				$latestStockStructure->fHistoryNo=$history->fHistoryNo;
				$latestStockStructure->fItemNo=$model->fItemNo;
			}
			$financeAccounting=FinanceAccounting::model()->findByAttributes(array('fItemNo'=>$model->fItemNo));
			if($financeAccounting==''){
				$financeAccounting=new FinanceAccounting();
				$financeAccounting->fItemNo=$model->fItemNo;
			}else
				$financeAccounting->fItemNo=$model->fItemNo;
			if($model->fStatus==0){
				$itemplan=new ItemPlan();
				$model->fStatus= Yii::t('label','Init');
			}
			$this->render('update',array(
				'model'=>$model,'keyid'=>$id,'history'=>$history,'stockStructure'=>$stockStructure,
					'financeAccounting'=>$financeAccounting,'fItemType'=>ItemSettings::$ItemType,
			));
		}
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
		if(isset($_POST['Item']))
		{
			$createmodel=new Item;
			$createmodel->attributes=$_POST['Item'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fItemNo));
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
		$model=new Item('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Item']))
			$model->attributes=$_GET['Item'];

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
		$model=new Item();
		$model->fItemNum =isset($_GET['fItemNum'])?trim($_GET['fItemNum']):'';
		$model->fItemName=isset($_GET['fItemName'])?trim($_GET['fItemName']):'';
		$model->fCreateUser=isset($_GET['fCreateUser'])?trim($_GET['fCreateUser']):'';
		$model->fResponsibleCreate=isset($_GET['fResponsibleCreate'])?trim($_GET['fResponsibleCreate']):'';
		$model->fTemplateNo=isset($_GET['fTemplateNo'])?trim($_GET['fTemplateNo']):'';
		$criteria=$model->AdvancedSearch();
        $pages=new CPagination(Item::model()->count($criteria));//记录总数
        $pages->pageSize=Yii::app()->params['pagesize'];//设置每页的记录显示条数
        $pages->applyLimit($criteria);		
        $sort=new CSort('Item');//排序，参考YII文档CSort
        $sort->attributes=array(
		'fItemNum'=>array('asc'=>'fItemNum','desc'=>'fItemNum desc','label'=>Item::model()->getAttributeLabel('fItemNum')),
		'fItemName'=>array('asc'=>'fItemName','desc'=>'fItemName desc','label'=>Item::model()->getAttributeLabel('fItemName')),
		'fItemType'=>array('asc'=>'fItemType','desc'=>'fItemType desc','label'=>Item::model()->getAttributeLabel('fItemType')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Item::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Item::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Item::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Item::model()->getAttributeLabel('fUpdateDate')),
		'fTemplateNo'=>array('asc'=>'fTemplateNo','desc'=>'fTemplateNo desc','label'=>Item::model()->getAttributeLabel('fTemplateNo')),		
        );
        $sort->defaultOrder='fItemNo';
        $sort->applyOrder($criteria);
        // find all
        $models=Item::model()->findAll($criteria);
        // rows for the static grid
        $gridRows=array();
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
        $model=new Item();
        $model->fItemNum =isset($_GET['fItemNum'])?trim($_GET['fItemNum']):'';
        $model->fItemName=isset($_GET['fItemName'])?trim($_GET['fItemName']):'';
        $model->fCreateUser=isset($_GET['fCreateUser'])?trim($_GET['fCreateUser']):'';
        $model->fResponsibleCreate=isset($_GET['fResponsibleCreate'])?trim($_GET['fResponsibleCreate']):'';
        $model->fTemplateNo=isset($_GET['fTemplateNo'])?trim($_GET['fTemplateNo']):'';
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
        
		$pages=new CPagination(Item::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Item');		
        $sort->attributes=array(
		'fItemNum'=>array('asc'=>'fItemNum','desc'=>'fItemNum desc','label'=>Item::model()->getAttributeLabel('fItemNum')),
		'fItemName'=>array('asc'=>'fItemName','desc'=>'fItemName desc','label'=>Item::model()->getAttributeLabel('fItemName')),
		'fItemType'=>array('asc'=>'fItemType','desc'=>'fItemType desc','label'=>Item::model()->getAttributeLabel('fItemType')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Item::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Item::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Item::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Item::model()->getAttributeLabel('fUpdateDate')),
		'fTemplateNo'=>array('asc'=>'fTemplateNo','desc'=>'fTemplateNo desc','label'=>Item::model()->getAttributeLabel('fTemplateNo')),		
        );
        $sort->defaultOrder='fItemNo';
        $sort->applyOrder($criteria);
        // find all
        $models=Item::model()->with('template')->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {
            $data['rows'][]=array(
                		 'fItemNo'=>$model->fItemNo,
						'cell'=>array(CHtml::encode($model->fItemNum).(Yii::app()->user->checkAccess('Item.item.Update')?CHtml::link("<span class='ui-row ui-row-edit'></span>",array('update','id'=>$model->fItemNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Update')
                )):'').(Yii::app()->user->checkAccess('Item.item.View')?CHtml::link("<span class='ui-row ui-row-view'></span>",array('view','id'=>$model->fItemNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'').(($model->fStatus==0)&&Yii::app()->user->checkAccess('Item.item.Delete')?CHtml::link("<span class='ui-row ui-row-delete'></span>",array('delete','id'=>$model->fItemNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Delete')
                )):'')
				.(Yii::app()->user->checkAccess('Item.item.Initupdate')?CHtml::link("<span class='ui-row ui-row-edit'></span>",array('initupdate','id'=>$model->fItemNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Initupdate')
                )):''),		 
		 CHtml::encode($model->fItemName),
		 CHtml::encode(array_key_exists($model->fItemType,ItemSettings::$ItemType)?ItemSettings::$ItemType[$model->fItemType]:''),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode(date('Y-m-d',$model->fCreateDate)),
		 CHtml::encode($model->fUpdateUser),
		 CHtml::encode(date('Y-m-d',$model->fUpdateDate)),
		 CHtml::encode(array_key_exists($model->fStatus,Yii::app()->params['itemStatus'])?Yii::app()->params['itemStatus'][$model->fStatus]:''),
		 CHtml::encode(empty($model->template)?'':$model->template->fTemplateName),
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
		$model=Item::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * 项目日历.
	 */
	public function actionCalender(){
		$id=isset($_GET['id'])?$_GET['id']:'';
		$item=Item::model()->findByPk($id);
		if($item->fStatus==0){
			$this->redirect($this->createUrl('item/update/id/'.$item->fItemNo));
			return;
		}
		$formate_str='{id:\'%s\',title: \'%s\',start: new Date(y, m, d-3),end: new Date(y, m, d-2)},';
	    
		$calender_str='['.sprintf($formate_str,'123','123').'{id:\'sdfsadf\',title: \'当天所有任务\',start: new Date(y, m, 1)},
	        {title: \'项目审批\',start: new Date(y, m, d-5),end: new Date(y, m, d-2)},'.']';
		
		$model=$this->loadModel($id);
		$calender=new Calendar();
		$this->render('calender',array(
				'model'=>$model,'calender'=>$calender,'calender_str'=>$calender_str,
		));
	}
}
