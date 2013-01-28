<?php

class FatherTask extends ItemCommon
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
			if($model=='taskfinish'){
				if($method=='add'){
					$itemcatalogue->fFinishedNum=$itemcatalogue->fFinishedNum+1;
					$itemcatalogue->fWaitFinishingNum=$itemcatalogue->fWaitFinishingNum-1;
				}
				$itemcatalogue->save();
			 }else{
				if($method=='add'){
				$itemcatalogue->fTaskNum=$itemcatalogue->fTaskNum+1;
				$itemcatalogue->fWaitFinishingNum=$itemcatalogue->fWaitFinishingNum+1;
				}else {
					$itemcatalogue->fTaskNum=$itemcatalogue->fTaskNum-1;
					$itemcatalogue->fWaitFinishingNum=$itemcatalogue->fWaitFinishingNum-1;
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
		$model=Task::model()->with('itemCatalogue')->with('tempCatalogue')->findByPk($id);
		$model->fStartDate=empty($model->fStartDate)?'':date('y-m-d',$model->fStartDate);
		$model->fEndDate=empty($model->fEndDate)?'':date('y-m-d',$model->fEndDate);
		$model->fCreateDate=empty($model->fCreateDate)?'':date('y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('y-m-d',$model->fUpdateDate);
		$model->fStandardStatus=array_key_exists($model->fStandardStatus,adminSettings::$StandardTaskStatus)?adminSettings::$StandardTaskStatus[$model->fStandardStatus]:'';
		$model->fStatus=array_key_exists($model->fStatus,ItemSettings::$TaskStatus)?ItemSettings::$TaskStatus[$model->fStatus]:'';
		$this->render('view',array(
			'model'=>$model,
			'keyid'=>$id,'fTaskType'=>ItemSettings::$TaskType,
				'fPriority'=>ItemSettings::$Priority,
				'fWarnFrequency'=>ItemSettings::$WarnCycle,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new Task;
		$itemno='';
		if(isset($_GET['id'])){
			$itemno=$_GET['id'];
		}
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
				$model->save();
			
				//上传附件
				$attch=new Attachment();
				$attch=$this->SaveuploadFile($model);
				//交互历史
				$taskHistory=new Taskhistory();
				$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
				$taskHistory->fTaskNo=$model->fTaskNo;
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
			
				$user=new User();
				$user=User::model()->findByAttributes(array('fUserName'=>$model->fExecutor));
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
					$msg->fSendFromContent=sprintf(Yii::app()->params['task']['new']['content'],$model->fTheme);
					$msg->fSendToAllUserNo=$user->fUserID;
					$msg->fSendToAllAccount=$user->fEmail;
					$msg->fSendToAllName=$user->fUserName;
					$msg->fRemark1='';
					$msg->fRemark2='';
					$msg->fRemark3='';
					$msg->save();
				}						
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
		$model->fStartDate=empty($model->fStartDate)?'':date('y-m-d',$model->fStartDate);
		$model->fEndDate=empty($model->fEndDate)?'':date('y-m-d',$model->fEndDate);
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
				$model->attributes=$_POST['Task'];
				$model->fTaskNo=GuidUtil::getUuid();
				$model->fStartDate=strtotime($model->fStartDate);
				$model->fEndDate=strtotime($model->fEndDate);
				$model->fIsItem='ItemUse_Yes';
				$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
				$model->fCreateDate=time();
				$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
				$model->fUpdateDate=$model->fCreateDate;
				$model->fSchedule='0';
				$model->fStatus='Task_Add';//新提交状态
				$model->fStandardStatus='';//新提交状态
				$model->save();
				//上传附件
				$attch=new Attachment();
				
				if(!empty($_FILES) && !empty($_FILES['Task']['name'])){
				   $attch=$this->SaveuploadFile($model);
				}
				
				//交互历史
				$taskHistory=new Taskhistory();
				$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
				$taskHistory->fTaskNo=$model->fTaskNo;
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
			
				$user=User::model()->findByAttributes(array('fUserName'=>$model->fExecutor));
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
				$msg->fSendFromContent=sprintf(Yii::app()->params['task']['new']['content'],$model->fTheme);
				$msg->fSendToAllUserNo=$user->fUserID;
				$msg->fSendToAllAccount=$user->fEmail;
				$msg->fSendToAllName=$user->fUserName;
				$msg->fRemark1='';
				$msg->fRemark2='';
				$msg->fRemark3='';
				$msg->save();
				}
			
				$transaction->commit();
				$this->redirect(array('view','id'=>$model->fTaskNo));
				//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}
		$model->fStartDate=empty($model->fStartDate)?'':date('y-m-d',$model->fStartDate);
		$model->fEndDate=empty($model->fEndDate)?'':date('y-m-d',$model->fEndDate);
		$this->render('update',array(
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
		$keyid='';
		if(isset($_GET['id'])) $keyid=$_GET['id'];
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

        // find all
        $models=Task::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
       
		$model=new Task;
		$model->unsetAttributes();  // clear any default values
		$itemCommon=new ItemCommonController();
		
		$dataNode = $itemCommon->GetItemCatalogue($_GET['id']);
        // render the view file
        $this->render('index',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,'keyid'=>$keyid,'dataNode'=>$dataNode,
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
        $itemno=$_GET['id'];
        // criteria
        $criteria=new CDbCriteria;
        $criteria->addCondition("t.fItemNo = :fItemNo");
        $criteria->params[':fItemNo']=$itemno;
        $criteria->addCondition("t.fIsItem = :fIsItem");
        $criteria->params[':fIsItem']='ItemUse_Yes';
        if(isset($_GET['cno'])){
        	$criteria->addCondition("t.fCatalogueNo = :fCatalogueNo");
        	$criteria->params[':fCatalogueNo']=$_GET['cno'];
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
						'fTheme'=>Task::model()->getAttributeLabel('fTheme'),
		'fCatalogueNo'=>Task::model()->getAttributeLabel('fCatalogueNo'),
		
		
		'fStartDate'=>Task::model()->getAttributeLabel('fStartDate'),
		'fEndDate'=>Task::model()->getAttributeLabel('fEndDate'),
		'fSponsor'=>Task::model()->getAttributeLabel('fSponsor'),
		'fExecutor'=>Task::model()->getAttributeLabel('fExecutor'),
		
		'fSchedule'=>Task::model()->getAttributeLabel('fSchedule'),
		'fStatus'=>Task::model()->getAttributeLabel('fStatus'),
		'fPriority'=>Task::model()->getAttributeLabel('fPriority'),
		'fWarnFrequency'=>Task::model()->getAttributeLabel('fWarnFrequency'),
		'fTaskType'=>Task::model()->getAttributeLabel('fTaskType'),
		'fLatestAffixId'=>Task::model()->getAttributeLabel('fLatestAffixId'),
	
            		'fCreateUser'=>Task::model()->getAttributeLabel('fCreateUser'),
            		'fCreateDate'=>Task::model()->getAttributeLabel('fCreateDate'),
		'fUpdateUser'=>Task::model()->getAttributeLabel('fUpdateUser'),
		'fUpdateDate'=>Task::model()->getAttributeLabel('fUpdateDate'),

		'fStandardStatus'=>Task::model()->getAttributeLabel('fStandardStatus'),
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
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Task::model()->getAttributeLabel('fStatus')),
		'fPriority'=>array('asc'=>'fPriority','desc'=>'fPriority desc','label'=>Task::model()->getAttributeLabel('fPriority')),
		'fWarnFrequency'=>array('asc'=>'fWarnFrequency','desc'=>'fWarnFrequency desc','label'=>Task::model()->getAttributeLabel('fWarnFrequency')),
		'fTaskType'=>array('asc'=>'fTaskType','desc'=>'fTaskType desc','label'=>Task::model()->getAttributeLabel('fTaskType')),
		'fLatestAffixId'=>array('asc'=>'fLatestAffixId','desc'=>'fLatestAffixId desc','label'=>Task::model()->getAttributeLabel('fLatestAffixId')),
		
        		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Task::model()->getAttributeLabel('fCreateUser')),
        		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Task::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Task::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Task::model()->getAttributeLabel('fUpdateDate')),
		
		'fStandardStatus'=>array('asc'=>'fStandardStatus','desc'=>'fStandardStatus desc','label'=>Task::model()->getAttributeLabel('fStandardStatus')),
        );
        $sort->defaultOrder='fTaskNo';
        $sort->applyOrder($criteria);

        // find all
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
						'cell'=>array(CHtml::encode($model->fTheme).(Yii::app()->user->checkAccess('Item.task.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Update')
                )):'').(Yii::app()->user->checkAccess('Item.task.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'').(Yii::app()->user->checkAccess('Item.task.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fTaskNo),array(
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
		 CHtml::encode(array_key_exists($model->fTaskType,ItemSettings::$TaskType)?ItemSettings::$TaskType[$model->fTaskType]:''),
		 CHtml::encode($model->fLatestAffixId),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode(empty($model->fCreateDate)?'':date('y-m-d',$model->fCreateDate)),
		 CHtml::encode($model->fUpdateUser),
		 CHtml::encode(empty($model->fUpdateDate)?'':date('y-m-d',$model->fUpdateDate)),
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
		$model->fStartDate=empty($model->fStartDate)?'':date('y-m-d',$model->fStartDate);
		$model->fEndDate=empty($model->fEndDate)?'':date('y-m-d',$model->fEndDate);
		$model->fCreateDate=empty($model->fCreateDate)?'':date('y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('y-m-d',$model->fUpdateDate);
		$model->fStandardStatus=array_key_exists($model->fStandardStatus,adminSettings::$StandardTaskStatus)?adminSettings::$StandardTaskStatus[$model->fStandardStatus]:'';
		$history=new Taskhistory();
		$history->fActionUser=Yii::app()->params->loginuser->fUserName;
		$this->render('taskhistory',array(
				'model'=>$model,'dataProvider'=>$dataProvider,'attch'=>$attch,
				'handle'=>$handle,'downHandle'=>$downHandle
				,'fTaskType'=>ItemSettings::$TaskType,
				'fPriority'=>ItemSettings::$Priority,
				'fWarnFrequency'=>ItemSettings::$WarnCycle,'history'=>$history,'keyid'=>$model->fItemNo,
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
				array('rel'=>'/UFS/KMMAX/index.php/Item/task/taskagree/id/'.$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit'));
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

	/**
	 * 任务确认
	* */
	public function actionTaskconfirm(){
		$taskNo='';
		if(isset($_GET['id'])){
			$taskNo=$_GET['id'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Task::model()->findByPk($taskNo);
			$model->fStatus='Task_Progress';
			$model->save();
			$taskHistory=new Taskhistory();
			$taskHistory->attributes=$_POST['Taskhistory'];
			$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
			$taskHistory->fTaskNo=$taskNo;
			$taskHistory->fAction=Yii::app()->params->const['confirm'];
			$taskHistory->fActionDate=time();
			$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
			$taskHistory->fMemo='无';
			$taskHistory->save();
			
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$model->fSponsor));
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
			$msg->fSendFromTheme=Yii::app()->params['task']['confirm']['theme'];
			$msg->fSendFromContent=sprintf(Yii::app()->params['task']['confirm']['content'],$model->fTheme);
			$msg->fSendToAllUserNo=$user->fUserID;
			$msg->fSendToAllAccount=$user->fEmail;
			$msg->fSendToAllName=$user->fUserName;
			$msg->fRemark1='';
			$msg->fRemark2='';
			$msg->fRemark3='';
			$msg->save();
			$transaction->commit();
			$this->redirect(array('taskhistory','id'=>$taskNo));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	
	/**
	 * 任务反馈
	* */
	public function actionTaskfeedback(){
		$taskNo='';
		if(isset($_GET['id'])){
			$taskNo=$_GET['id'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Task::model()->findByPk($taskNo);
			$attch=new Attachment();
			$attch=$this->SaveuploadFile($model);
			//任务交互历史
			$taskHistory=new Taskhistory();
			$taskHistory->attributes=$_POST['Taskhistory'];
			$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
			$taskHistory->fTaskNo=$taskNo;
			$taskHistory->fAction=Yii::app()->params->const['feedback'];
			$taskHistory->fActionDate=time();
			$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
			$taskHistory->fMemo='无';
			$taskHistory->fAttchFalseName=$attch->fAttachmentFalseName;
			$taskHistory->fAttchName=$attch->fAttachmentName;
			$taskHistory->save();
			$model->fSchedule=$taskHistory->fFinishPercent;
			$model->save();
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$model->fSponsor));
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
			$msg->fSendFromTheme=Yii::app()->params['task']['feedback']['theme'];
			$msg->fSendFromContent=sprintf(Yii::app()->params['task']['feedback']['content'],$model->fTheme);
			$msg->fSendToAllUserNo=$user->fUserID;
			$msg->fSendToAllAccount=$user->fEmail;
			$msg->fSendToAllName=$user->fUserName;
			$msg->fRemark1='';
			$msg->fRemark2='';
			$msg->fRemark3='';
			$msg->save();
			$transaction->commit();
			$this->redirect(array('taskhistory','id'=>$taskNo));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	
	/**
	 * 任务完成申请
	* */
	public function actionMiddlefinished(){
		$taskNo='';
		if(isset($_GET['id'])){
			$taskNo=$_GET['id'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Task::model()->findByPk($taskNo);
			$attch=new Attachment();
			$attch=$this->SaveuploadFile($model);
			$taskHistory=new Taskhistory();
			$taskHistory->attributes=$_POST['Taskhistory'];
			$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
			$taskHistory->fTaskNo=$taskNo;
			$taskHistory->fAction=Yii::app()->params->const['middlefinished'];
			$taskHistory->fActionDate=time();
			$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
			$taskHistory->fMemo='无';
			$taskHistory->fAttchFalseName=$attch->fAttachmentFalseName;
			$taskHistory->fAttchName=$attch->fAttachmentName;
			$taskHistory->save();
			$model->fStatus='Task_Finished_Apply';
			$model->fSchedule=$taskHistory->fFinishPercent;
			$model->save();
			//消息发送
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$model->fSponsor));
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
			$msg->fSendFromTheme=Yii::app()->params['task']['Middlefinished']['theme'];
			$msg->fSendFromContent=sprintf(Yii::app()->params['task']['Middlefinished']['content'],$model->fTheme);
			$msg->fSendToAllUserNo=$user->fUserID;
			$msg->fSendToAllAccount=$user->fEmail;
			$msg->fSendToAllName=$user->fUserName;
			$msg->fRemark1='';
			$msg->fRemark2='';
			$msg->fRemark3='';
			$msg->save();
			$transaction->commit();
			$this->redirect(array('taskhistory','id'=>$taskNo));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	
	/**
	 * 任务完成申请--拒绝
	* */
	public function actionTaskrefusefinish(){
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$taskNo='';
			if(isset($_GET['id'])){
				$taskNo=$_GET['id'];
			}
			$model=Task::model()->findByPk($taskNo);
			$taskHistory=new Taskhistory();
			$taskHistory->attributes=$_POST['Taskhistory'];
			$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
			$taskHistory->fTaskNo=$taskNo;
			$taskHistory->fAction=Yii::app()->params->const['refusefinish'];
			$taskHistory->fActionDate=time();
			$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
			$taskHistory->fMemo='无';
			$model->fStatus='Task_Progress';$model->save();
			$taskHistory->save();
			//消息发送
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$model->fExecutor));
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
			$msg->fSendFromTheme=Yii::app()->params['task']['finish']['theme'];
			$msg->fSendFromContent=sprintf(Yii::app()->params['task']['finish']['content'],$model->fTheme);
			$msg->fSendToAllUserNo=$user->fUserID;
			$msg->fSendToAllAccount=$user->fEmail;
			$msg->fSendToAllName=$user->fUserName;
			$msg->fRemark1=$taskHistory->fContent;
			$msg->fRemark2='';
			$msg->fRemark3='';
			$msg->save();
			$transaction->commit();
			$this->redirect(array('taskhistory','id'=>$taskNo));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	
	/**
	 * 任务完成申请--完成并新建
	* */
	public function actionTaskfinishnew(){
		$taskNo='';
		if(isset($_GET['id'])){
			$taskNo=$_GET['id'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Task::model()->findByPk($taskNo);
			$model->fStatus='Task_Finished';
			$model->save();
			//交互历史
			$taskHistory=new Taskhistory();
			$taskHistory->attributes=$_POST['Taskhistory'];
			$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
			$taskHistory->fTaskNo=$taskNo;
			$taskHistory->fAction='完成';
			$taskHistory->fActionDate=time();
			$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
			$taskHistory->fMemo='无';
			//事务提交
			$taskHistory->save();
			//消息发送
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$model->fExecutor));
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
			$msg->fSendFromTheme=Yii::app()->params['task']['finish']['theme'];
			$msg->fSendFromContent=sprintf(Yii::app()->params['task']['finish']['content'],$model->fTheme);
			$msg->fSendToAllUserNo=$user->fUserID;
			$msg->fSendToAllAccount=$user->fEmail;
			$msg->fSendToAllName=$user->fUserName;
			$msg->fRemark1=$taskHistory->fContent;
			$msg->fRemark2='';
			$msg->fRemark3='';
			$msg->save();
			$this->SaveInDocument($model);
			$transaction->commit();
			if(empty($model->fItemNo))
			$this->redirect(array('create'));
			else $this->redirect(array('create','id'=>$model->fItemNo));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	
	/**
	 * 任务完成
	* */
	public function actionTaskfinish(){
		$taskNo='';
		if(isset($_GET['id'])){
			$taskNo=$_GET['id'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Task::model()->findByPk($taskNo);
			$model->fStatus='Task_Finished';
			$model->save();
			//附件上传
			$attch=new Attachment();

			if(!(isset($_FILES['Taskhistory']['name']['fAttchName']))){
			          $attch=$this->SaveuploadFile($model);
			}
			//交互历史
			$taskHistory=new Taskhistory();
			$taskHistory->attributes=$_POST['Taskhistory'];
			$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
			$taskHistory->fTaskNo=$taskNo;
			$taskHistory->fAction=Yii::app()->params->const['finish'];;
			$taskHistory->fActionDate=time();
			$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
			$taskHistory->fMemo='无';
			$taskHistory->fFinishPercent='100';
			$taskHistory->fAttchFalseName=empty($attch->fAttachmentFalseName)?'':$attch->fAttachmentFalseName;
			$taskHistory->fAttchName=empty($attch->fAttachmentName)?'':$attch->fAttachmentName;
			$taskHistory->save();
			//消息发送
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$model->fExecutor));
			if(!empty($user)){
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
				$msg->fSendFromTheme=Yii::app()->params['task']['finish']['theme'];
				$msg->fSendFromContent=sprintf(Yii::app()->params['task']['finish']['content'],$model->fTheme);
				$msg->fSendToAllUserNo=$user->fUserID;
				$msg->fSendToAllAccount=$user->fEmail;
				$msg->fSendToAllName=$user->fUserName;
				$msg->fRemark1=$taskHistory->fContent;
				$msg->fRemark2='';
				$msg->fRemark3='';
				$msg->save();
			}
			
			$this->SaveInDocument($model);
			//同步分类
			$this->CatalogueSynchronization($model->fCatalogueNo,$model->fItemNo,'add','taskfinish');
			$transaction->commit();
			$this->redirect(array('taskhistory','id'=>$taskNo));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	/**
	 * 领导审批--同意
	* */
	public function actionTaskagree(){
		/*任务历史*/
		$taskNo='';
		if(isset($_GET['id'])){
			$taskNo=$_GET['id'];
		}
		$model=Task::model()->findByPk($taskNo);
	
		$taskHistory=new Taskhistory();
		$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
		$taskHistory->fTaskNo=$taskNo;
		$taskHistory->fAction='领导同意';
		$taskHistory->fActionDate=time();
		$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
		$taskHistory->fContent='无';
		$taskHistory->fMemo='无';
		$taskHistory->fFinishPercent=0;
	
		if($taskHistory->save())
			$this->redirect(array('taskhistory/id'+$taskNo));
	}
	
	/**
	 * 任务终止
	* */
	public function actionTaskstop(){
		$taskNo='';
		if(isset($_GET['id'])){
			$taskNo=$_GET['id'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Task::model()->findByPk($taskNo);
			$taskHistory=new Taskhistory();
			$taskHistory->attributes=$_POST['Taskhistory'];
			$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
			$taskHistory->fTaskNo=$taskNo;
			$taskHistory->fAction=Yii::app()->params->const['stop'];
			$taskHistory->fActionDate=time();
			$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
			$taskHistory->fMemo='无';
			$model->fStatus='Task_Stop';
			$model->save();
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
				$msg->fSendFromTheme=Yii::app()->params['task']['finish']['theme'];
				$msg->fSendFromContent=sprintf(Yii::app()->params['task']['finish']['content'],$model->fTheme);
				$msg->fSendToAllUserNo=$user->fUserID;
				$msg->fSendToAllAccount=$user->fEmail;
				$msg->fSendToAllName=$user->fUserName;
				$msg->fRemark1=$taskHistory->fContent;
				$msg->fRemark2='';
				$msg->fRemark3='';
				$msg->save();
			}
			$taskHistory->save();
			$transaction->commit();
			$this->redirect(array('taskhistory','id'=>$taskNo));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	
	/**
	 * 任务重新开始
	* */
	public function actionTaskgoon(){
		$taskNo='';
		if(isset($_GET['id'])){
			$taskNo=$_GET['id'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Task::model()->findByPk($taskNo);
			$taskHistory=new Taskhistory();
			$taskHistory->attributes=$_POST['Taskhistory'];
			$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
			$taskHistory->fTaskNo=$taskNo;
			$taskHistory->fAction=Yii::app()->params->const['goon'];
			$taskHistory->fActionDate=time();
			$taskHistory->fActionUser=Yii::app()->params->loginuser->fUserName;
			$taskHistory->fMemo='无';
			$model->fStatus='Task_Progress';
			$model->save();
			$taskHistory->save();
			//消息发送
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$model->fExecutor));
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
			$msg->fSendFromTheme=Yii::app()->params['task']['finish']['theme'];
			$msg->fSendFromContent=sprintf(Yii::app()->params['task']['finish']['content'],$model->fTheme);
			$msg->fSendToAllUserNo=$user->fUserID;
			$msg->fSendToAllAccount=$user->fEmail;
			$msg->fSendToAllName=$user->fUserName;
			$msg->fRemark1=$taskHistory->fContent;
			$msg->fRemark2='';
			$msg->fRemark3='';
			$msg->save();
			$transaction->commit();
			$this->redirect(array('taskhistory','id'=>$taskNo));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}

	/**
	 * 领导审批--不批
	* */
	public function actionTaskrefuse(){
		/*任务历史*/
		if(isset($_GET['id'])){
			$taskNo=$_GET['id'];
		}
		$taskHistory=new Taskhistory();
		$taskHistory->fTaskHistoryNo=GuidUtil::getUuid();
		$taskHistory->fTaskNo=$taskNo;
		$taskHistory->fAction='领导不同意';
		$taskHistory->fActionDate=time();
		$taskHistory->fActionUser='金亚';
		$taskHistory->fContent='无';
		$taskHistory->fMemo='无';
		$taskHistory->fFinishPercent=0;
	
		if($taskHistory->save())
			$this->redirect(array('taskhistory/id'+$taskNo));
	}
	
	/**
	 * 推荐到标准库
	 */
	public function actionStandard(){
		$taskNo='';
		if(isset($_GET['id'])){
			$taskNo=$_GET['id'];
		}
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$model=Task::model()->findByPk($taskNo);
			//消息发送
			$user=new User();
			$user=User::model()->findByAttributes(array('fUserName'=>$model->fExecutor));
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
			$msg->fSendFromTheme=Yii::app()->params['task']['standard']['theme'];
			$msg->fSendFromContent=sprintf(Yii::app()->params['task']['standard']['content'],$model->fTheme);
			$msg->fSendToAllUserNo=$user->fUserID;
			$msg->fSendToAllAccount=$user->fEmail;
			$msg->fSendToAllName=$user->fUserName;
			$msg->fRemark1='';
			$msg->fRemark2='';
			$msg->fRemark3='';
			$msg->save();
			$this->StandardTask($model);
			$transaction->commit();
			$this->redirect(array('taskhistory','id'=>$taskNo));
		//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	
	/**
	 * 标准化任务
	 */
	public function StandardTask($model){	
		$criteria=new CDbCriteria;
		$criteria->addCondition("fTaskNo='".$model->fTaskNo.'\'');
		$criteria->limit =1;
		$criteria->order = 'fCreateDate DESC ' ;
		$attach=Attachment::model()->find($criteria);
		$this->checkKnowledgeCatalogue($model);
	
		$standaretask=new Standardtask();
		$standaretask->fTaskNo=GuidUtil::getUuid();
		$standaretask->fItemNo=$model->fItemNo;
		$standaretask->fOldTaskNo=$model->fTaskNo;
		$standaretask->fAttachNo=$attach->fAttachmentId;
		$standaretask->fAttachName=$attach->fAttachmentName;
		$standaretask->fAttachFalseName=$attach->fAttachmentFalseName;
		$standaretask->fSubmitUser=Yii::app()->params->loginuser->fUserName;
		$standaretask->fSubmitDate=time();
		$standaretask->fStatus='Standard_Apply';
		$standaretask->fTheme=$model->fTheme;
		$standaretask->fContent=$model->fContent;
		$standaretask->fRemarks=$model->fRemarks;
		$standaretask->fTaskType=$model->fTaskType;
		$standaretask->fCatalogueNo=$model->fCatalogueNo;
		$standaretask->fCreateUser=Yii::app()->params->loginuser->fUserName;
		$standaretask->fCreateDate=time();
		$standaretask->save();
	
		$model->fStandardStatus='Standard_Apply';
		$model->save();
	}
	
	/**
	 * 同步文档库
	 * */
	public function SaveInDocument($model){
		$criteria=new CDbCriteria;
		$criteria->addCondition("fTaskNo='".$model->fTaskNo.'\'');
		$criteria->limit =1;
		$criteria->order = 'fCreateDate DESC ' ;
		$attach=Attachment::model()->find($criteria);
		$document = new Resultdocument();
		$document->fTaskNo=$model->fTaskNo;
		$document->fItemNo=$model->fItemNo;
		$document->fCatalogueNo=$model->fCatalogueNo;
		$document->fCreateUser=Yii::app()->params->loginuser->fUserName;
		$document->fCreateDate=time();
		$document->fUpdateUser=Yii::app()->params->loginuser->fUserName;
		$document->fUpdateDate=time();
		$document->fResultNo=GuidUtil::getUuid();
		$document->fDocumentNo=GuidUtil::getUuid();
		$document->fStatus='Result_Add';
		$document->fResultSubmitUser=empty($attach->fCreateUser)?'':$attach->fCreateUser;
		$document->fResultSubmitDate=empty($attach->fCreateDate)?'':$attach->fCreateDate;
		$document->fAttachmentNo=empty($attach->fAttachmentId)?'':$attach->fAttachmentId;
		$document->save();
	}
	/**
	 * 检查知识库目录结构
	 */
	public function checkKnowledgeCatalogue($model){
		$knowledge=Knowledgecatalogue::model()->findByPk($model->fCatalogueNo);
		if(empty($knowledge)){
			$this->InsertKnowledgeCatalogue($model->fCatalogueNo);
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
}
