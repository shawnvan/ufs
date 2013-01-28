<?php

class ItemcatalogueController extends ItemCommon
{
	public function actionPopgrid()
	{
		$this->render('popgrid',array('dataNode'=>$this->GetItemCatalogue($_GET['id'],'sub'),'keyid'=>$_GET['id'],
		));
	}
	/**
	 * 查看
	 */
	public function actionAjaxview(){
		if(Yii::app()->request->isPostRequest)
		{
			$catalogue=Itemcatalogue::model()->with('fathercatalogue')->findByAttributes(array('fItemNo'=>$_POST['id'],'fCatalogueNo'=>$_POST['tid']));
		   $this->renderPartial('update',array(
				'data'=>UFSBaseUtil::printJson(array(
						'fCatalogueNo'=>CHtml::encode($catalogue->fCatalogueNo),
						'fFatherCatalogueName'=>CHtml::encode(empty($catalogue->fathercatalogue->fCatalogueName)?'':$catalogue->fathercatalogue->fCatalogueName),
						'fCreateDate'=>CHtml::encode(empty($catalogue->fCreateDate)?'':date('y-m-d',$catalogue->fCreateDate)),
						'fCreateUser'=>CHtml::encode($catalogue->fCreateUser),
						'fUpdateUser'=>CHtml::encode($catalogue->fUpdateUser),
						'fUpdateDate'=>CHtml::encode(empty($catalogue->fUpdateDate)?'':date('y-m-d',$catalogue->fUpdateDate)),
						'fIsActive'=>CHtml::encode($catalogue->fIsActive),
						'fWarnRate'=>CHtml::encode($catalogue->fWarnRate),
						'fWarnStart'=>CHtml::encode(empty($catalogue->fWarnStart)?'':date('y-m-d',$catalogue->fWarnStart)),
						'fWarnEnd'=>CHtml::encode(empty($catalogue->fWarnEnd)?'':date('y-m-d',$catalogue->fWarnEnd)),
						'fWaitFinishingNum'=>CHtml::encode($catalogue->fWaitFinishingNum),
						'fFinishedNum'=>CHtml::encode($catalogue->fFinishedNum),
						'fResultNum'=>CHtml::encode($catalogue->fResultNum),
						'fDocumentNum'=>CHtml::encode($catalogue->fDocumentNum),
						'fTaskNum'=>CHtml::encode($catalogue->fTaskNum),
						'fKnowledgeNum'=>CHtml::encode($catalogue->fKnowledgeNum),
						'fExecutorUser'=>CHtml::encode($catalogue->fExecutorUser),
				))
		));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
	}
	
	public function actionUpdatetemplate($id){
		/* 项目初始化 */
		$transaction = Yii::app()->db->beginTransaction();
		try {
			//同步分类
			$model=Item::model()->findByPk($id);
			$sql="insert into tbl_itemcatalogue(fCatalogueNo,fItemNo,fTemplateNo,fIsActive,fSort,fStatus,fWarnRate,fWarnStart,fWarnEnd,fFatherCatalogueNo,FuserGroup,fWaitFinishingNum,fFinishedNum,fResultNum,fDocumentNum,fCreateUser, fCreateDate, fUpdateUser, fUpdateDate)
                  select fCatalogueNo,'".$model->fItemNo."',fTemplateNo,fIsActive,fSort,0,fWarnRate,fWarnStart,fWarnEnd,fFatherCatalogueNo,fUserGroup,0,0,0,0,fCreateUser, fCreateDate, fUpdateUser, fUpdateDate
                  from tbl_templatecatalogue where (fTemplateNo='".$model->fTemplateNo."' or fTemplateNo='') and fCatalogueNo not in (select fCatalogueNo from tbl_itemcatalogue where fItemNo='".$model->fItemNo."');";

			Yii::app()->db->createCommand($sql)->query();
            
			$transaction->commit();
			UFSBaseUtil::printJson(array(
			'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Handle Success'),Yii::app()->params['notytype']['success']),
			));
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	/**
     * Grid of all models.
     */
    public function actionIndex()
    {
    	$model=new Itemcatalogue();
		$id=isset($_GET['id'])?$_GET['id']:'';
		$item=Item::model()->findByPk($id);
		if($item->fStatus==0){
			$this->redirect($this->createUrl('item/update/id/'.$item->fItemNo));
			return;
		}
		$this->render('index',array(
				'dataNode'=>$this->GetItemCatalogue($id),'id'=>$id,'model'=>$model,'fWarnRate'=>adminSettings::$NodeWarnCycle,'fIsActive'=>knowledgeSettings::$CatalogueStatus
		));
    }
    /**
     * 插入
     */
    public function actionInsert()
    {
    	$fCatalogueNo=isset($_POST['cno'])?$_POST['cno']:'';
    	$fItemNo=isset($_POST['id'])?$_POST['id']:'';
    	$model=Itemcatalogue::model()->findByAttributes(array('fCatalogueNo'=>$fCatalogueNo,'fItemNo'=>$fItemNo));
    	$catalogue=new Itemcatalogue();
    	$catalogue->fCatalogueNo=GuidUtil::getUuid();
    	$catalogue->fItemNo=$fItemNo;
    	$catalogue->fTemplateNo=$model->fTemplateNo;
    	$catalogue->fCatalogueName=isset($_POST['name'])?$_POST['name']:'';
    	$catalogue->fWarnRate=$_POST['warn'];
    	$catalogue->fWarnRate=$_POST['warn'];
    	$catalogue->fWarnStart=empty($_POST['start'])?'':strtotime($_POST['start']);
    	$catalogue->fWarnEnd=empty($_POST['end'])?'':strtotime($_POST['end']);
    	$catalogue->fIsActive=$_POST['active']; 	
    	$catalogue->fWaitFinishingNum=0;
    	$catalogue->fFinishedNum=0;
    	$catalogue->fResultNum=0;
    	$catalogue->fDocumentNum=0;
    	$catalogue->fTaskNum=0;
    	$catalogue->fKnowledgeNum=0;
    	$catalogue->fFatherCatalogueNo=$fCatalogueNo;
    	$catalogue->fCreateUser=Yii::app()->params->loginuser->fUserName;
    	$catalogue->fCreateDate=time();
    	$catalogue->fUpdateUser=Yii::app()->params->loginuser->fUserName;
    	$catalogue->fUpdateDate=time();
    	if($catalogue->save())
    	{
    		  UFSBaseUtil::printJson(array(
    		  'fCatalogueName'=>CHtml::encode($catalogue->fCatalogueName),
    		  'fCatalogueNo'=>CHtml::encode($catalogue->fCatalogueNo),
    		  'fFatherNo'=>CHtml::encode($catalogue->fFatherCatalogueNo),
    		  'fCreateUser'=>CHtml::encode($catalogue->fCreateUser),
    		  'fCreateDate'=>CHtml::encode($catalogue->fCreateDate),
			    'fUpdateUser'=>CHtml::encode($catalogue->fUpdateUser),
			    'fUpdateDate'=>CHtml::encode(empty($catalogue->fUpdateDate)?'':date('y-m-d',$catalogue->fUpdateDate)),
			    'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Update Success'),Yii::app()->params['notytype']['success']),
			    ));
    	}
    }
	public function actionUpdate()
	{
		$fCatalogueNo=$_GET['cno'];
		$itemno=$_GET['ino'];
		if($fCatalogueNo=='999') $fCatalogueNo='';
        $model=Itemcatalogue::model()->with('catalogue')->with('fathercatalogue')->findByAttributes(array('fCatalogueNo'=>$fCatalogueNo,'fItemNo'=>$itemno));
        $data=$model->catalogue->fCatalogueName;
        UFSBaseUtil::printJson(array(
        		'fCatalogueNo'=>CHtml::encode($model->fCatalogueNo),
        		'fCatalogueName'=>CHtml::encode($model->catalogue->fCatalogueName),
        		'fWaitFinishingNum'=>CHtml::encode($model->fWaitFinishingNum),
        		'fFinishedNum'=>CHtml::encode($model->fFinishedNum),
        		'fTaskNum'=>CHtml::encode($model->fTaskNum),
        		'fResultNum'=>CHtml::encode($model->fResultNum),
        		'fDocumentNum'=>CHtml::encode($model->fDocumentNum),
        		'fKnowledgeNum'=>CHtml::encode($model->fKnowledgeNum),
        		'fWarnStart'=>CHtml::encode($model->fWarnStart),
        		'fWarnEnd'=>CHtml::encode($model->fWarnStart),
        		'fIsActive'=>CHtml::encode($model->fIsActive),
        		'fExecutorUser'=>CHtml::encode($model->fExecutorUser),
        		'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Update Success'),Yii::app()->params['notytype']['success']),
        ));
	}

	public function actionUpdateTree(){
	    //存数值
	    if(isset($_POST['cno']) && isset($_POST['id'])){
	    	$itemcatalogue=Itemcatalogue::model()->findByAttributes(array('fCatalogueNo'=>$_POST['cno'],'fItemNo'=>$_POST['id']));
	    	if($itemcatalogue!=null){
	    		$itemcatalogue->fWarnRate=$_POST['warn'];
	    		$itemcatalogue->fWarnStart=empty($_POST['start'])?'':strtotime($_POST['start']);
	    		$itemcatalogue->fWarnEnd=empty($_POST['end'])?'':strtotime($_POST['end']);
	    		$itemcatalogue->fIsActive=$_POST['active'];
	    		$itemcatalogue->fExecutorUser=$_POST['user'];
	    		$itemcatalogue->fUpdateUser=Yii::app()->params->loginuser->fUserName;
	    		$itemcatalogue->fUpdateDate=time();
	    		$itemcatalogue->save();
	    	}
	    }
	    UFSBaseUtil::printJson(array(
	    'fUpdateUser'=>CHtml::encode($itemcatalogue->fUpdateUser),
	    'fUpdateDate'=>CHtml::encode(empty($itemcatalogue->fUpdateDate)?'':date('y-m-d',$itemcatalogue->fUpdateDate)),
	    'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Update Success'),Yii::app()->params['notytype']['success']),
	    ));
	}
	/**
	 * 获得执行人
	 */
    public function actionSelectname(){
    	//存数值
    	if(isset($_POST['cno']) && isset($_POST['id'])){
    		$itemcatalogue=Itemcatalogue::model()->findByAttributes(array('fCatalogueNo'=>$_POST['cno'],'fItemNo'=>$_POST['id']));
    		if($itemcatalogue!=null){
    			UFSBaseUtil::printJson(array(
    			'fExecutorUser'=>CHtml::encode($itemcatalogue->fExecutorUser),
    			/* 'fCatalogueName'=>CHtml::encode(empty($itemcatalogue->itemcatalogue->fCatalogueName)?'':$itemcatalogue->itemcatalogue->fCatalogueName), */
    			));
    		}
    	}
    }
}