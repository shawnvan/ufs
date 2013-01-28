<?php

class MsgfromController extends AppController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$model->fSendFromModule=array_key_exists($model->fSendFromModule,msgSettings::$MsgModule)?msgSettings::$MsgModule[$model->fSendFromModule]:'';
		$model->fSendFromType=array_key_exists($model->fSendFromType,msgSettings::$MsgType)?msgSettings::$MsgType[$model->fSendFromType]:'';
		$model->fSendFromDate=empty($model->fSendFromDate)?'':date('Y-m-d h:i:s',$model->fSendFromDate);
		$model->fSendFromStatus=array_key_exists($model->fSendFromStatus,msgSettings::$MsgStatus)?msgSettings::$MsgStatus[$model->fSendFromStatus]:'';
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
		$model=new Msgfrom;
		if(isset($_POST['Msgfrom']))
		{
			/* 项目初始化 */
			$transaction = Yii::app()->db->beginTransaction();
			try {
			$msgfrom = new Msgfrom();
			$msgfrom->attributes=$_POST['Msgfrom'];
			$msgfrom->fSendFromNo=GuidUtil::getUuid();
			$msgfrom->fSendFromUserNo=Yii::app()->params->loginuser->fUserID;
			$msgfrom->fSendFromName=Yii::app()->params->loginuser->fUserName;
			$msgfrom->fSendFromDate=time();
			$msgfrom->fSendFromStatus='Msg_Sended';
			$msgfrom->save();
			
			$strUserName=explode(',', $msgfrom->fSendToName);
			$strUserMail=explode(',', $msgfrom->fSendToAccount);
			
			for($i=0;$i<count($strUserName);$i++){
				$msgto=new Msgto();
				$msgto->fSendToNo=GuidUtil::getUuid();
				$msgto->fSendToAccount=$strUserMail[$i];
				$msgto->fSendToName=$strUserName[$i];
				$msgto->fSendMsgStatus='Msg_NoRead';
				$msgto->fRemark1='';
				$msgto->fRemark2='';
				$msgto->fSendFromNo=$msgfrom->fSendFromNo;
				$msgto->fSendUserNo=$msgfrom->fSendFromUserNo;
				$msgto->fSendFromName=$msgfrom->fSendFromName;
				$msgto->fSendFromTheme=$msgfrom->fSendFromTheme;
				$msgto->fSendFromContent=$msgfrom->fSendFromContent;
				$msgto->fSendFromModule=$msgfrom->fSendFromModule;
				$msgto->fSendFromDate=$msgfrom->fSendFromDate;
				$msgto->fSendFromType=$msgfrom->fSendFromType;
				$msgto->fSendToAllUserNo=$msgfrom->fSendToUserNo;
				$msgto->fSendToAllAccount=$msgfrom->fSendToAccount;
				$msgto->fSendToAllName=$msgfrom->fSendToName;
				if($msgfrom->fSendFromType=='Msg_Mail') {
					MailController::actionSend($msgto);
					$msgto->fSendMsgStatus='Msg_Readed';
				}
			    $msgto->save();
			}
			$transaction->commit();
			$this->redirect(array('view','id'=>$msgfrom->fSendFromNo));
			//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}
		$this->render('create',array(
			'model'=>$model,'MsgType'=>msgSettings::$MsgType,'MsgModule'=>msgSettings::$MsgModule
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
			$this->loadModel($id)->delete();
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionDeletemsg()
	{
		if($this->loadModel($_GET['id'])->delete()){
			print_r('success');
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Msgfrom('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Msgfrom']))
			$model->attributes=$_GET['Msgfrom'];

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
        $pages=new CPagination(Msgfrom::model()->count($criteria));//记录总数
        $pages->pageSize=Yii::app()->params['pagesize'];//设置每页的记录显示条数
        $pages->applyLimit($criteria);
        $sort=new CSort('Msgfrom');//排序，参考YII文档CSort
        $sort->attributes=array(
		'fSendFromModule'=>array('asc'=>'fSendFromModule','desc'=>'fSendFromModule desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromModule')),
        'fSendFromTheme'=>array('asc'=>'fSendFromTheme','desc'=>'fSendFromTheme desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromTheme')),
        'fSendFromName'=>array('asc'=>'fSendFromName','desc'=>'fSendFromName desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromName')),
		'fSendFromType'=>array('asc'=>'fSendFromType','desc'=>'fSendFromType desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromType')),
		'fSendFromDate'=>array('asc'=>'fSendFromDate','desc'=>'fSendFromDate desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromDate')),
		'fSendFromStatus'=>array('asc'=>'fSendFromStatus','desc'=>'fSendFromStatus desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromStatus')),
		'fSendToAccount'=>array('asc'=>'fSendToAccount','desc'=>'fSendToAccount desc','label'=>Msgfrom::model()->getAttributeLabel('fSendToAccount')),
		'fSendToName'=>array('asc'=>'fSendToName','desc'=>'fSendToName desc','label'=>Msgfrom::model()->getAttributeLabel('fSendToName')),
	    );
        $sort->defaultOrder='fSendFromNo';
        $sort->applyOrder($criteria);
        $models=Msgfrom::model()->findAll($criteria);
        $gridRows=array();
		$model=new Msgfrom;
		$model->unsetAttributes();  // clear any default values
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
        $criteria->addCondition("fSendFromUserNo = :fSendFromUserNo");
        $criteria->params[':fSendFromUserNo']=Yii::app()->params->loginuser->fUserID;
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
		$pages=new CPagination(Msgfrom::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Msgfrom');
        $sort->attributes=array(
		'fSendFromModule'=>array('asc'=>'fSendFromModule','desc'=>'fSendFromModule desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromModule')),
        		'fSendFromTheme'=>array('asc'=>'fSendFromTheme','desc'=>'fSendFromTheme desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromTheme')),
        		'fSendFromName'=>array('asc'=>'fSendFromName','desc'=>'fSendFromName desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromName')),
        		'fSendFromType'=>array('asc'=>'fSendFromType','desc'=>'fSendFromType desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromType')),
		'fSendFromDate'=>array('asc'=>'fSendFromDate','desc'=>'fSendFromDate desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromDate')),
		
		'fSendFromStatus'=>array('asc'=>'fSendFromStatus','desc'=>'fSendFromStatus desc','label'=>Msgfrom::model()->getAttributeLabel('fSendFromStatus')),

		'fSendToAccount'=>array('asc'=>'fSendToAccount','desc'=>'fSendToAccount desc','label'=>Msgfrom::model()->getAttributeLabel('fSendToAccount')),
		'fSendToName'=>array('asc'=>'fSendToName','desc'=>'fSendToName desc','label'=>Msgfrom::model()->getAttributeLabel('fSendToName')),
    );
        $sort->defaultOrder='fSendFromNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Msgfrom::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fSendFromNo'=>$model->fSendFromNo,
						'cell'=>array(CHtml::encode(array_key_exists($model->fSendFromModule,msgSettings::$MsgModule)?msgSettings::$MsgModule[$model->fSendFromModule]:'')
							.(Yii::app()->user->checkAccess('msg.msgfrom.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fSendFromNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'').(Yii::app()->user->checkAccess('msg.msgfrom.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fSendFromNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right',
                	'rel'=>$model->fSendFromNo,
                    'title'=>Yii::t('label','Delete')
                )):''),
		 CHtml::encode($model->fSendFromTheme),
								CHtml::encode($model->fSendFromName),
		 CHtml::encode(array_key_exists($model->fSendFromType,msgSettings::$MsgType)?msgSettings::$MsgType[$model->fSendFromType]:''),
		 CHtml::encode(empty($model->fSendFromDate)?'':date('Y-m-d h:i:s',$model->fSendFromDate)),
		 CHtml::encode(array_key_exists($model->fSendFromStatus,msgSettings::$MsgStatus)?msgSettings::$MsgStatus[$model->fSendFromStatus]:''),
		 CHtml::encode($model->fSendToAccount),
		 CHtml::encode($model->fSendToName),
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
		$model=Msgfrom::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='msgfrom-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
