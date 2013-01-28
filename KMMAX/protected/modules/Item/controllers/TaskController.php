<?php

class TaskController extends FatherTask
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=Task::model()->with('itemCatalogue')->with('tempCatalogue')->findByPk($id);
		$model->fStartDate=empty($model->fStartDate)?'':date('Y-m-d',$model->fStartDate);
		$model->fEndDate=empty($model->fEndDate)?'':date('Y-m-d',$model->fEndDate);
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
		$model->fStandardStatus=array_key_exists($model->fStandardStatus,adminSettings::$StandardTaskStatus)?adminSettings::$StandardTaskStatus[$model->fStandardStatus]:'';
		$model->fStatus=array_key_exists($model->fStatus,ItemSettings::$TaskStatus)?ItemSettings::$TaskStatus[$model->fStatus]:'';
		$criteria = new CDbCriteria;
		$criteria->order = ' fCreateDate  desc';          //按什么字段来排序
		$criteria->addCondition("fTaskNo='".$model->fTaskNo.'\'');
		$criteria->limit =1;
		$attch=Attachment::model()->find($criteria);
		if(empty($attch)){
			$attch=new Attachment();
			$attch->fAttachmentName='无';
		}else $model->fLatestAffixId=$attch->fAttachmentName;
		$this->render('view',array(
			'model'=>$model,
			'keyid'=>$id,'fTaskType'=>ItemSettings::$TaskType,
				'fPriority'=>ItemSettings::$Priority,
				'fWarnFrequency'=>ItemSettings::$WarnCycle,
				'viewattach'=>Yii::app()->user->checkAccess('Item.attachment.View')?$attch->fAttachmentId:'',
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Task;
		$itemno=$this->GetItemNo();
		if(isset($_POST['Task']))
		{
		$transaction = Yii::app()->db->beginTransaction();
			try {
				$model->attributes=$_POST['Task'];
				$model->fTaskNo=GuidUtil::getUuid();
				$model->fStartDate=strtotime($model->fStartDate);
				$model->fEndDate=strtotime($model->fEndDate);
				$model->fItemNo=$itemno;
				$model->fIsItem='ItemUse_Yes';
				$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
				$model->fCreateDate=time();
				$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
				$model->fUpdateDate=$model->fCreateDate;
				$model->fSchedule='0';
				$model->fStatus='Task_Add';//新提交状态
				if(!($model->save())) return;
				//上传附件
				$attch=new Attachment();
				$attch=$this->SaveuploadFile($model);
				//交互历史
				$taskHistory=new Taskhistory();
				$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
				$taskHistory->fTaskNo=$model->fTaskNo;
				$taskHistory->fAction==Yii::app()->params['task']['create']['theme'];
				$taskHistory->fActionDate=time();
				$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
				$taskHistory->fContent=Yii::app()->params['task']['create']['theme'];
				$taskHistory->fMemo='无';
				$taskHistory->fFinishPercent=0;
				$taskHistory->fAttchFalseName=$attch->fAttachmentFalseName;
				$taskHistory->fAttchName=$attch->fAttachmentName;
				$taskHistory->save();
				//同步分类
				$this->CatalogueSynchronization($model->fCatalogueNo,$model->fItemNo,'add');
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
					$msg->fSendFromTheme=Yii::app()->params['task']['new']['theme'];
					$msg->fSendFromContent=sprintf(Yii::app()->params['task']['new']['content'],$model->fTheme);
					$msg->fSendToAllUserNo=$user->fUserID;
					$msg->fSendToAllAccount=$user->fEmail;
					$msg->fSendToAllName=$user->fUserName;
					$msg->fRemark1='';
					$msg->fRemark2='';
					$msg->fRemark3='';
					$msg->save();
				}
				//事务提交
				$transaction->commit();
				$this->redirect(array('view','id'=>$model->fTaskNo));
				//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}
		$model->fSponsor=Yii::app()->params->loginuser->fUserName;
		
		$this->render('create',array(
			'model'=>$model,'fTaskType'=>ItemSettings::$TaskType,
				'fPriority'=>ItemSettings::$Priority,'keyid'=>$itemno,
				'fWarnFrequency'=>ItemSettings::$WarnCycle,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=Task::model()->with('itemCatalogue')->with('tempCatalogue')->findByPk($id);
		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
			$model->fStartDate=strtotime($model->fStartDate);
			$model->fEndDate=strtotime($model->fEndDate);
			if($model->save())
				$this->redirect(array('view','id'=>$model->fTaskNo));
		}
		$model->fStartDate=empty($model->fStartDate)?'':date('Y-m-d',$model->fStartDate);
		$model->fEndDate=empty($model->fEndDate)?'':date('Y-m-d',$model->fEndDate);
		$this->render('update',array(
			'model'=>$model,
			'keyid'=>$id,'fTaskType'=>ItemSettings::$TaskType,
				'fPriority'=>ItemSettings::$Priority,
				'fWarnFrequency'=>ItemSettings::$WarnCycle,
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
		$model=Task::model()->with('itemCatalogue')->with('tempCatalogue')->findByPk($id);
		if(isset($_POST['Task']))
		{
		$transaction = Yii::app()->db->beginTransaction();
			try {
				$task=new Task();
				
				$task->attributes=$_POST['Task'];
				$task->fTaskNo=GuidUtil::getUuid();
				$task->fSponsor=$model->fSponsor;
				$task->fStartDate=strtotime($task->fStartDate);
				$task->fEndDate=strtotime($task->fEndDate);
				$task->fIsItem='ItemUse_Yes';
				$task->fCreateUser=Yii::app()->params->loginuser->fUserName;
				$task->fCreateDate=time();
				$task->fUpdateUser=Yii::app()->params->loginuser->fUserName;
				$task->fUpdateDate=$task->fCreateDate;
				$task->fSchedule='0';
				$task->fStatus='Task_Add';//新提交状态
				$task->fStandardStatus='';//新提交状态
				$task->save();
				//上传附件
				$attch=new Attachment();
				
				if(!empty($_FILES) && !empty($_FILES['Task']['name'])){
				   $attch=$this->SaveuploadFile($task);
				}
				
				//同步任务分类
				$this->CatalogueSynchronization($task->fCatalogueNo,$task->fItemNo,'add');
				
				//交互历史
				$taskHistory=new Taskhistory();
				$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
				$taskHistory->fTaskNo=$task->fTaskNo;
				$taskHistory->fAction='新建';
				$taskHistory->fActionDate=time();
				$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
				$taskHistory->fContent='新建任务';
				$taskHistory->fMemo='无';
				$taskHistory->fFinishPercent=0;
				$taskHistory->fAttchFalseName=$attch->fAttachmentFalseName;
				$taskHistory->fAttchName=$attch->fAttachmentName;
				//事务提交
				$taskHistory->save();
			
				$user=User::model()->findByAttributes(array('fUserName'=>$task->fExecutor));
				if(!empty($user)){
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
				$msg->fSendFromTheme=Yii::app()->params['task']['new']['theme'];
				$msg->fSendFromContent=sprintf(Yii::app()->params['task']['new']['content'],$task->fTheme);
				$msg->fSendToAllUserNo=$user->fUserID;
				$msg->fSendToAllAccount=$user->fEmail;
				$msg->fSendToAllName=$user->fUserName;
				$msg->fRemark1='';
				$msg->fRemark2='';
				$msg->fRemark3='';
				$msg->save();
				}
			
				$transaction->commit();
				$this->redirect(array('view','id'=>$task->fTaskNo));
				//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}
		$model->fStartDate=empty($model->fStartDate)?'':date('Y-m-d',$model->fStartDate);
		$model->fEndDate=empty($model->fEndDate)?'':date('Y-m-d',$model->fEndDate);
		$model->fSponsor=Yii::app()->params->loginuser->fUserName;
		$this->render('copy',array(
				'model'=>$model,
				'keyid'=>$model->fItemNo,'fTaskType'=>ItemSettings::$TaskType,
				'fPriority'=>ItemSettings::$Priority,
				'fWarnFrequency'=>ItemSettings::$WarnCycle,
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
			$transaction = Yii::app()->db->beginTransaction();
			try {
			$model=$this->loadModel($id);
			$this->CatalogueSynchronization($model->fCatalogueNo,$model->fItemNo,'delete');
			$model->delete();
			$transaction->commit();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
			
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Task('search');
		$keyid='';
		if(isset($_GET['id'])) $keyid=$_GET['id'];
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Task']))
			$model->attributes=$_GET['Task'];

		$this->render('admin',array(
			'model'=>$model,'keyid'=>$keyid,
		));
	}

	/**
     * Grid of all models.
     */
    public function actionIndex()
    {
		$criteria=new CDbCriteria;
		$model=new Task;
		if(isset($_GET['id'])) {
			$model->fItemNo=$_GET['id'];
			$item=Item::model()->findByPk($model->fItemNo);
			if($item->fStatus==0){
				$this->redirect($this->createUrl('item/update/id/'.$item->fItemNo));
				return;
			}else{
				$model->fTheme =isset($_GET['fTheme'])?trim($_GET['fTheme']):'';
				$model->fStartDate =isset($_GET['fStartDate'])?$_GET['fStartDate']:'';
				$model->fEndDate =isset($_GET['fEndDate'])?$_GET['fEndDate']:'';
				$model->fSponsor =isset($_GET['fSponsor'])?trim($_GET['fSponsor']):'';
				$model->fExecutor =isset($_GET['fExecutor'])?trim($_GET['fExecutor']):'';
				$model->fCreateUser =isset($_GET['fCreateUser'])?$_GET['fCreateUser']:'';
				$model->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
				$model->fStatus =isset($_GET['fStatus'])?$_GET['fStatus']:'';
				$model->fStandardStatus =isset($_GET['fStandardStatus'])?$_GET['fStandardStatus']:'';
			}
		}	
		$criteria=$model->AdvancedSearch();
        $pages=new CPagination(Task::model()->count($criteria));//记录总数
        $pages->pageSize=Yii::app()->params['pagesize'];//设置每页的记录显示条数
        $pages->applyLimit($criteria);		
        $sort=new CSort('Task');//排序，参考YII文档CSort
        $sort->attributes=array(
        	'fTheme'=>array('asc'=>'fTheme','desc'=>'fTheme desc','label'=>Task::model()->getAttributeLabel('fTheme')),		
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Task::model()->getAttributeLabel('fCatalogueNo')),
		'fStartDate'=>array('asc'=>'fStartDate','desc'=>'fStartDate desc','label'=>Task::model()->getAttributeLabel('fStartDate')),
		'fEndDate'=>array('asc'=>'fEndDate','desc'=>'fEndDate desc','label'=>Task::model()->getAttributeLabel('fEndDate')),
		'fSponsor'=>array('asc'=>'fSponsor','desc'=>'fSponsor desc','label'=>Task::model()->getAttributeLabel('fSponsor')),
		'fExecutor'=>array('asc'=>'fExecutor','desc'=>'fExecutor desc','label'=>Task::model()->getAttributeLabel('fExecutor')),
		'fSchedule'=>array('asc'=>'fSchedule','desc'=>'fSchedule desc','label'=>Task::model()->getAttributeLabel('fSchedule')),
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Task::model()->getAttributeLabel('fStatus')),
		'fPriority'=>array('asc'=>'fPriority','desc'=>'fPriority desc','label'=>Task::model()->getAttributeLabel('fPriority')),
		'fWarnFrequency'=>array('asc'=>'fWarnFrequency','desc'=>'fWarnFrequency desc','label'=>Task::model()->getAttributeLabel('fWarnFrequency')),
		'fTaskType'=>array('asc'=>'fTaskType','desc'=>'fTaskType desc','label'=>Task::model()->getAttributeLabel('fTaskType')),
		'fLatestAffixId'=>array('asc'=>'fLatestAffixId','desc'=>'fLatestAffixId desc','label'=>Task::model()->getAttributeLabel('fLatestAffixId')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Task::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Task::model()->getAttributeLabel('fCreateDate')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Task::model()->getAttributeLabel('fUserGroup')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Task::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Task::model()->getAttributeLabel('fUpdateDate')),		
		'fStandardStatus'=>array('asc'=>'fStandardStatus','desc'=>'fStandardStatus desc','label'=>Task::model()->getAttributeLabel('fStandardStatus')),		
        );
        $sort->defaultOrder='fTaskNo';
        $sort->applyOrder($criteria);
        $gridRows=array();     
        $this->render('index',array(
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,'keyid'=>$model->fItemNo,'dataNode'=> $this->GetItemCatalogue($model->fItemNo,'task'),
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
        $itemno='';
        $model=new Task;
        if(isset($_GET['id'])) {
        	$itemno=$_GET['id'];   
        	$model->fItemNo=$_GET['id'];
            $model->fTheme =isset($_GET['fTheme'])?trim($_GET['fTheme']):'';
			$model->fStartDate =isset($_GET['fStartDate'])?$_GET['fStartDate']:'';
			$model->fEndDate =isset($_GET['fEndDate'])?$_GET['fEndDate']:'';
			$model->fSponsor =isset($_GET['fSponsor'])?trim($_GET['fSponsor']):'';
			$model->fExecutor =isset($_GET['fExecutor'])?trim($_GET['fExecutor']):'';
			$model->fCreateUser =isset($_GET['fCreateUser'])?$_GET['fCreateUser']:'';
			$model->fCreateDate =isset($_GET['fCreateDate'])?$_GET['fCreateDate']:'';
			$model->fStatus =isset($_GET['fStatus'])?$_GET['fStatus']:'';
			$model->fStandardStatus =isset($_GET['fStandardStatus'])?$_GET['fStandardStatus']:'';
        }           
        $criteria=$model->AdvancedSearch();                
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
		$pages=new CPagination(Task::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
        $pages->applyLimit($criteria);
        $sort=new CSort('Task');
        $sort->attributes=array(
           'fTheme'=>array('asc'=>'fTheme','desc'=>'fTheme desc','label'=>Task::model()->getAttributeLabel('fTheme')),
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Task::model()->getAttributeLabel('fCatalogueNo')),
		'fStartDate'=>array('asc'=>'fStartDate','desc'=>'fStartDate desc','label'=>Task::model()->getAttributeLabel('fStartDate')),
		'fEndDate'=>array('asc'=>'fEndDate','desc'=>'fEndDate desc','label'=>Task::model()->getAttributeLabel('fEndDate')),
		'fSponsor'=>array('asc'=>'fSponsor','desc'=>'fSponsor desc','label'=>Task::model()->getAttributeLabel('fSponsor')),
		'fExecutor'=>array('asc'=>'fExecutor','desc'=>'fExecutor desc','label'=>Task::model()->getAttributeLabel('fExecutor')),
		'fSchedule'=>array('asc'=>'fSchedule','desc'=>'fSchedule desc','label'=>Task::model()->getAttributeLabel('fSchedule')),
		
		'fPriority'=>array('asc'=>'fPriority','desc'=>'fPriority desc','label'=>Task::model()->getAttributeLabel('fPriority')),
		'fWarnFrequency'=>array('asc'=>'fWarnFrequency','desc'=>'fWarnFrequency desc','label'=>Task::model()->getAttributeLabel('fWarnFrequency')),
		'fTaskType'=>array('asc'=>'fTaskType','desc'=>'fTaskType desc','label'=>Task::model()->getAttributeLabel('fTaskType')),
        		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Task::model()->getAttributeLabel('fCreateUser')),
        		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Task::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Task::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Task::model()->getAttributeLabel('fUpdateDate')),
		'fStandardStatus'=>array('asc'=>'fStandardStatus','desc'=>'fStandardStatus desc','label'=>Task::model()->getAttributeLabel('fStandardStatus')),
        );
        $sort->defaultOrder='fTaskNo';
        $sort->applyOrder($criteria);
        // find all
       // print_r($criteria);exit;
        $models=Task::model()->with('itemCatalogue')->with('tempCatalogue')->findAll($criteria);
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
						'cell'=>array(CHtml::encode($model->fTheme).(Yii::app()->user->checkAccess('Item.task.Update')?CHtml::link("<span class='ui-row ui-row-edit'></span>",array('update','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Update')
                )):'').(Yii::app()->user->checkAccess('Item.task.View')?CHtml::link("<span class='ui-row ui-row-view'></span>",array('view','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'').(Yii::app()->user->checkAccess('Item.task.Delete')?CHtml::link("<span class='ui-row ui-row-delete'></span>",array('delete','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right',
                	'rel'=>$model->fTaskNo,
                    'title'=>Yii::t('label','Delete')
                )):'')
				.(Yii::app()->user->checkAccess('Item.task.Taskhistory')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('Taskhistory','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','ViewTaskHistory')
                )):''),	
				 CHtml::encode(empty($model->tempCatalogue)?'':$model->tempCatalogue->fCatalogueName),
				 CHtml::encode(empty($model->fStartDate)?'':date('Y-m-d',$model->fStartDate)),
				 CHtml::encode(empty($model->fEndDate)?'':date('Y-m-d',$model->fEndDate)),
				 CHtml::encode($model->fSponsor),
				 CHtml::encode($model->fExecutor),
				 CHtml::encode($model->fSchedule),
				 CHtml::encode(array_key_exists($model->fStatus,ItemSettings::$TaskStatus)?ItemSettings::$TaskStatus[$model->fStatus]:''),								
				 CHtml::encode(array_key_exists($model->fPriority,ItemSettings::$Priority)?ItemSettings::$Priority[$model->fPriority]:''),
				 CHtml::encode(array_key_exists($model->fWarnFrequency,ItemSettings::$WarnCycle)?ItemSettings::$WarnCycle[$model->fWarnFrequency]:''),
				 CHtml::encode($model->fCreateUser),
				 CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
				 CHtml::encode($model->fUpdateUser),
				 CHtml::encode(empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate)),
				 CHtml::encode(array_key_exists($model->fStandardStatus,adminSettings::$StandardTaskStatus)?adminSettings::$StandardTaskStatus[$model->fStandardStatus]:''),								
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
		$model=Task::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Performs the AJAX validation.
	 * 任务交互的历史
	 */
	public function actionTaskhistory(){
		$model=new Task;
		if(isset($_GET['id'])){
			$model=Task::model()->with('itemCatalogue')->with('fCatalogueName')->findByPk($_GET['id']);
			$dataProvider=new CActiveDataProvider('Taskhistory', array(
					'criteria'=>array(
							'condition'=>'fTaskNo=\''.$_GET['id'].'\'',
							'order'=>'fActionDate desc',
					),	
			));
		}
		$handle=$this->GetTaskHandle($model);
		$downHandle=$this->GetDownTaskHandle($model->fTaskNo,$model->fStatus);
		$criteria = new CDbCriteria;
		$criteria->order = ' fCreateDate  desc';          //按什么字段来排序
		$criteria->addCondition("fTaskNo='".$model->fTaskNo.'\'');
		$criteria->limit =1;
		$attch=Attachment::model()->find($criteria);
		if(empty($attch)){
			$attch=new Attachment();
			$attch->fAttachmentName='无';
		}else $model->fLatestAffixId=$attch->fAttachmentName;
		$model->fStatus=array_key_exists($model->fStatus,ItemSettings::$TaskStatus)?ItemSettings::$TaskStatus[$model->fStatus]:'';
		$model->fStartDate=empty($model->fStartDate)?'':date('Y-m-d',$model->fStartDate);
		$model->fEndDate=empty($model->fEndDate)?'':date('Y-m-d',$model->fEndDate);
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
		$model->fStandardStatus=array_key_exists($model->fStandardStatus,adminSettings::$StandardTaskStatus)?adminSettings::$StandardTaskStatus[$model->fStandardStatus]:'';
		$history=new Taskhistory();
		$history->fActionUser=Yii::app()->params->loginuser->fUserName;
		$this->render('taskhistory',array(
				'model'=>$model,'dataProvider'=>$dataProvider,'attch'=>$attch,
				'handle'=>$handle,
				'downHandle'=>$downHandle,
				'fTaskType'=>ItemSettings::$TaskType,
				'fPriority'=>ItemSettings::$Priority,
				'fWarnFrequency'=>ItemSettings::$WarnCycle,'history'=>$history,'keyid'=>$model->fItemNo,
				'viewattach'=>Yii::app()->user->checkAccess('Item.attachment.View')?$attch->fAttachmentId:'',
		));
	}
	
	/**
	 * 返回任务操作
	* */
	public function GetTaskHandle($model){
		$taskstop=CHtml::submitButton('终 止',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskstop/id/'.$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskgoon=CHtml::submitButton('重新开放',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskgoon/id/'.$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskagree=CHtml::submitButton('终 止',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskstop/id/'.$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskfinish=CHtml::submitButton('完成',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskfinish/id/'.$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskfinishandstandard=CHtml::submitButton('完成并推荐到标准库',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskfinish/id/'.$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskfinishandstandard=CHtml::submitButton('完成并推荐到标准库',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskfinish/id/'.$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskstandard=CHtml::submitButton('推荐到标准库',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/standard/id/'.$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskrefusefinish=CHtml::submitButton('拒绝完成申请',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskrefusefinish/id/'.$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskfinishnew=CHtml::submitButton('完成并新建',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskfinishnew/id/'.$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit'));
		$res='';
		switch ($model->fStatus){
			case 'Task_Add':
				$res=$taskagree;
				break;
			case 'Task_Progress':
				$res=$taskstop;
				break;
			case 'Task_Stop':
				$res=$taskgoon;
				break;
			case 'Task_Finished_Apply':
				$res=$taskrefusefinish.'   '.$taskfinish.'   '.$taskfinishandstandard.'   '.$taskfinishnew;
				break;
			case 'Task_Finished':
				if($model->fStandardStatus=='Standard_Apply' || $model->fStandardStatus=='Standard_Agree') $res='';
				else $res=$taskstandard;
				break;
		}
		return $res;
	}
	
	/**
	 * 返回任务操作
	* */
	public function GetDownTaskHandle($taskno,$status){
	
		$confirm=CHtml::submitButton('确认',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskconfirm/id/'.$taskno,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskfeedback=CHtml::submitButton('任务交互',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskfeedback/id/'.$taskno,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskagree=CHtml::submitButton('同意',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskagree/id/'.$taskno,'align'=>'right','title'=>'edit','class'=>'submit'));
		$taskrefuse=CHtml::submitButton('拒绝',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskrefuse/id/'.$taskno,'align'=>'right','title'=>'edit','class'=>'submit'));
		$middlefinished=CHtml::submitButton('任务完成提交',
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/middlefinished/id/'.$taskno,'align'=>'right','title'=>'edit','class'=>'submit'));
	
		$res='';
		switch ($status){
			case 'Task_Add':
				$res=$confirm.'   '.$taskfeedback;
				break;
			case 'Task_Progress':
				$res=$taskfeedback.'   '.$middlefinished;
				break;
			case 'Task_Stop':
				break;
		}
		return $res;
	}
}
