<?php

class MsgtoController extends AppController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=new Msgto();
		if(isset($_GET['id'])){
			$model=$this->loadModel($_GET['id']);
			$model->fSendMsgStatus='Msg_Readed';
			$model->fSendToLookDate=time();
			$model->save();
		}
		$model->fSendMsgStatus=array_key_exists($model->fSendMsgStatus,msgSettings::$MsgStatus)?msgSettings::$MsgStatus[$model->fSendMsgStatus]:'';
		$model->fSendToLookDate=empty($model->fSendToLookDate)?'':date('Y-m-d h:i:s',$model->fSendToLookDate);
		$model->fSendFromDate=empty($model->fSendFromDate)?'':date('Y-m-d h:i:s',$model->fSendFromDate);
		$this->render('view',array(
			'model'=>$model,
			'keyid'=>$id,'MsgType'=>msgSettings::$MsgType,'MsgModule'=>msgSettings::$MsgModule
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new Msgto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Msgto']))
		{
			$model->attributes=$_POST['Msgto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fSendToNo));
		}

		$this->render('create',array(
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
		$model=new Msgto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Msgto']))
			$model->attributes=$_GET['Msgto'];

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

        $pages=new CPagination(Msgto::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Msgto');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fSendToNo'=>array('asc'=>'fSendToNo','desc'=>'fSendToNo desc','label'=>Msgto::model()->getAttributeLabel('fSendToNo')),
		'fSendFromNo'=>array('asc'=>'fSendFromNo','desc'=>'fSendFromNo desc','label'=>Msgto::model()->getAttributeLabel('fSendFromNo')),
		'fSendToUserNo'=>array('asc'=>'fSendToUserNo','desc'=>'fSendToUserNo desc','label'=>Msgto::model()->getAttributeLabel('fSendToUserNo')),
		'fSendToAccount'=>array('asc'=>'fSendToAccount','desc'=>'fSendToAccount desc','label'=>Msgto::model()->getAttributeLabel('fSendToAccount')),
		'fSendToName'=>array('asc'=>'fSendToName','desc'=>'fSendToName desc','label'=>Msgto::model()->getAttributeLabel('fSendToName')),
		'fSendMsgStatus'=>array('asc'=>'fSendMsgStatus','desc'=>'fSendMsgStatus desc','label'=>Msgto::model()->getAttributeLabel('fSendMsgStatus')),
		/*
		'fSendToLookDate'=>array('asc'=>'fSendToLookDate','desc'=>'fSendToLookDate desc','label'=>Msgto::model()->getAttributeLabel('fSendToLookDate')),
		'fSendUserNo'=>array('asc'=>'fSendUserNo','desc'=>'fSendUserNo desc','label'=>Msgto::model()->getAttributeLabel('fSendUserNo')),
		'fSendFromName'=>array('asc'=>'fSendFromName','desc'=>'fSendFromName desc','label'=>Msgto::model()->getAttributeLabel('fSendFromName')),
		'fSendFromDate'=>array('asc'=>'fSendFromDate','desc'=>'fSendFromDate desc','label'=>Msgto::model()->getAttributeLabel('fSendFromDate')),
		'fSendFromModule'=>array('asc'=>'fSendFromModule','desc'=>'fSendFromModule desc','label'=>Msgto::model()->getAttributeLabel('fSendFromModule')),
		'fSendFromType'=>array('asc'=>'fSendFromType','desc'=>'fSendFromType desc','label'=>Msgto::model()->getAttributeLabel('fSendFromType')),
		'fSendFromTheme'=>array('asc'=>'fSendFromTheme','desc'=>'fSendFromTheme desc','label'=>Msgto::model()->getAttributeLabel('fSendFromTheme')),
		'fSendFromContent'=>array('asc'=>'fSendFromContent','desc'=>'fSendFromContent desc','label'=>Msgto::model()->getAttributeLabel('fSendFromContent')),
		'fSendToAllUserNo'=>array('asc'=>'fSendToAllUserNo','desc'=>'fSendToAllUserNo desc','label'=>Msgto::model()->getAttributeLabel('fSendToAllUserNo')),
		'fSendToAllAccount'=>array('asc'=>'fSendToAllAccount','desc'=>'fSendToAllAccount desc','label'=>Msgto::model()->getAttributeLabel('fSendToAllAccount')),
		'fSendToAllName'=>array('asc'=>'fSendToAllName','desc'=>'fSendToAllName desc','label'=>Msgto::model()->getAttributeLabel('fSendToAllName')),
		'fRemark1'=>array('asc'=>'fRemark1','desc'=>'fRemark1 desc','label'=>Msgto::model()->getAttributeLabel('fRemark1')),
		'fRemark2'=>array('asc'=>'fRemark2','desc'=>'fRemark2 desc','label'=>Msgto::model()->getAttributeLabel('fRemark2')),
		'fRemark3'=>array('asc'=>'fRemark3','desc'=>'fRemark3 desc','label'=>Msgto::model()->getAttributeLabel('fRemark3')),
		*/
        );
        $sort->defaultOrder='fSendToNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Msgto::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fSendToNo)),
		 array('content'=>CHtml::encode($model->fSendFromNo)),
		 array('content'=>CHtml::encode($model->fSendToUserNo)),
		 array('content'=>CHtml::encode($model->fSendToAccount)),
		 array('content'=>CHtml::encode($model->fSendToName)),
		 array('content'=>CHtml::encode($model->fSendMsgStatus)),
		/*
		 array('content'=>CHtml::encode($model->fSendToLookDate)),
		 array('content'=>CHtml::encode($model->fSendUserNo)),
		 array('content'=>CHtml::encode($model->fSendFromName)),
		 array('content'=>CHtml::encode($model->fSendFromDate)),
		 array('content'=>CHtml::encode($model->fSendFromModule)),
		 array('content'=>CHtml::encode($model->fSendFromType)),
		 array('content'=>CHtml::encode($model->fSendFromTheme)),
		 array('content'=>CHtml::encode($model->fSendFromContent)),
		 array('content'=>CHtml::encode($model->fSendToAllUserNo)),
		 array('content'=>CHtml::encode($model->fSendToAllAccount)),
		 array('content'=>CHtml::encode($model->fSendToAllName)),
		 array('content'=>CHtml::encode($model->fRemark1)),
		 array('content'=>CHtml::encode($model->fRemark2)),
		 array('content'=>CHtml::encode($model->fRemark3)),
		*/
            );
        }	
		
		$model=new Msgto;
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
        $criteria->addCondition("fSendToName = :fSendToName");
        $criteria->params[':fSendToName']=Yii::app()->params->loginuser->fUserName;
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
        
		$pages=new CPagination(Msgto::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Msgto');
		
        $sort->attributes=array(
           		'fSendToNo'=>array('asc'=>'fSendToNo','desc'=>'fSendToNo desc','label'=>Msgto::model()->getAttributeLabel('fSendToNo')),
		'fSendFromNo'=>array('asc'=>'fSendFromNo','desc'=>'fSendFromNo desc','label'=>Msgto::model()->getAttributeLabel('fSendFromNo')),
		'fSendToUserNo'=>array('asc'=>'fSendToUserNo','desc'=>'fSendToUserNo desc','label'=>Msgto::model()->getAttributeLabel('fSendToUserNo')),
		'fSendToAccount'=>array('asc'=>'fSendToAccount','desc'=>'fSendToAccount desc','label'=>Msgto::model()->getAttributeLabel('fSendToAccount')),
		'fSendToName'=>array('asc'=>'fSendToName','desc'=>'fSendToName desc','label'=>Msgto::model()->getAttributeLabel('fSendToName')),
		'fSendMsgStatus'=>array('asc'=>'fSendMsgStatus','desc'=>'fSendMsgStatus desc','label'=>Msgto::model()->getAttributeLabel('fSendMsgStatus')),
		/*
		'fSendToLookDate'=>array('asc'=>'fSendToLookDate','desc'=>'fSendToLookDate desc','label'=>Msgto::model()->getAttributeLabel('fSendToLookDate')),
		'fSendUserNo'=>array('asc'=>'fSendUserNo','desc'=>'fSendUserNo desc','label'=>Msgto::model()->getAttributeLabel('fSendUserNo')),
		'fSendFromName'=>array('asc'=>'fSendFromName','desc'=>'fSendFromName desc','label'=>Msgto::model()->getAttributeLabel('fSendFromName')),
		'fSendFromDate'=>array('asc'=>'fSendFromDate','desc'=>'fSendFromDate desc','label'=>Msgto::model()->getAttributeLabel('fSendFromDate')),
		'fSendFromModule'=>array('asc'=>'fSendFromModule','desc'=>'fSendFromModule desc','label'=>Msgto::model()->getAttributeLabel('fSendFromModule')),
		'fSendFromType'=>array('asc'=>'fSendFromType','desc'=>'fSendFromType desc','label'=>Msgto::model()->getAttributeLabel('fSendFromType')),
		'fSendFromTheme'=>array('asc'=>'fSendFromTheme','desc'=>'fSendFromTheme desc','label'=>Msgto::model()->getAttributeLabel('fSendFromTheme')),
		'fSendFromContent'=>array('asc'=>'fSendFromContent','desc'=>'fSendFromContent desc','label'=>Msgto::model()->getAttributeLabel('fSendFromContent')),
		'fSendToAllUserNo'=>array('asc'=>'fSendToAllUserNo','desc'=>'fSendToAllUserNo desc','label'=>Msgto::model()->getAttributeLabel('fSendToAllUserNo')),
		'fSendToAllAccount'=>array('asc'=>'fSendToAllAccount','desc'=>'fSendToAllAccount desc','label'=>Msgto::model()->getAttributeLabel('fSendToAllAccount')),
		'fSendToAllName'=>array('asc'=>'fSendToAllName','desc'=>'fSendToAllName desc','label'=>Msgto::model()->getAttributeLabel('fSendToAllName')),
		'fRemark1'=>array('asc'=>'fRemark1','desc'=>'fRemark1 desc','label'=>Msgto::model()->getAttributeLabel('fRemark1')),
		'fRemark2'=>array('asc'=>'fRemark2','desc'=>'fRemark2 desc','label'=>Msgto::model()->getAttributeLabel('fRemark2')),
		'fRemark3'=>array('asc'=>'fRemark3','desc'=>'fRemark3 desc','label'=>Msgto::model()->getAttributeLabel('fRemark3')),
		*/'fRemark3'=>array('asc'=>'fRemark3','desc'=>'fRemark3 desc','label'=>Msgto::model()->getAttributeLabel('fRemark3')),
        );
        $sort->defaultOrder='fSendToNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Msgto::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fSendToNo'=>$model->fSendToNo,
						'cell'=>array(
					CHtml::encode(array_key_exists($model->fSendMsgStatus,msgSettings::$MsgStatus)?msgSettings::$MsgStatus[$model->fSendMsgStatus]:'')
					.(Yii::app()->user->checkAccess('msg.msgto.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fSendToNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'').(Yii::app()->user->checkAccess('msg.msgto.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fSendToNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right','rel'=>$model->fSendToNo,
                    'title'=>Yii::t('label','Delete')
                )):''),		
		 
		 CHtml::encode(empty($model->fSendToLookDate)?'':date('Y-m-d h:i:s',$model->fSendToLookDate)),
		 CHtml::encode($model->fSendFromName),
		 CHtml::encode(empty($model->fSendFromDate)?'':date('Y-m-d h:i:s',$model->fSendFromDate)),								
		 CHtml::encode(array_key_exists($model->fSendFromModule,msgSettings::$MsgModule)?msgSettings::$MsgModule[$model->fSendFromModule]:''),
		 CHtml::encode(array_key_exists($model->fSendFromType,msgSettings::$MsgType)?msgSettings::$MsgType[$model->fSendFromType]:''),
		 CHtml::encode($model->fSendFromTheme),
		 CHtml::encode($model->fSendToAllAccount),
		 CHtml::encode($model->fSendToAllName),
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
		$model=Msgto::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='msgto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionNoread(){
		print_r('asdf');
	}
}
