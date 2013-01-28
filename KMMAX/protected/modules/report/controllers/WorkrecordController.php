<?php

class WorkrecordController extends AppController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$model->fRecordDate=empty($model->fRecordDate)?'':date('Y-m-d',$model->fRecordDate);
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
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

		$model=new Workrecord;
		
		if(isset($_POST['Workrecord']))
		{
			$model->attributes=$_POST['Workrecord'];
			$model->fRecordNo=GuidUtil::getUuid();
			$model->fRecordUser=Yii::app()->params->loginuser->fUserName;
			$model->fRecordDate=strtotime($model->fRecordDate);
			$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$model->fCreateDate=time();
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->fRecordNo));
		}
		$model->fRecordDate=date('Y-m-d',time());
		$this->render('create',array(
			'model'=>$model,
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionInsert()
	{
		$model=new Workrecord;
		$model->fRecordNo=GuidUtil::getUuid();
		$model->fRecordUser=Yii::app()->params->loginuser->fUserName;
		$model->fRecordDate=strtotime($_POST['date']);
		$model->fPlan=isset($_POST['plan'])?$_POST['plan']:'';
		$model->fResult=isset($_POST['result'])?$_POST['result']:'';
		$model->fSummary=isset($_POST['summary'])?$_POST['summary']:'';
		$model->fEvaluate=isset($_POST['evaluate'])?$_POST['evaluate']:'';
		$model->fMemo=isset($_POST['memo'])?$_POST['memo']:'';
		$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
		$model->fCreateDate=time();
		$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
		$model->fUpdateDate=time();
		if($model->save()) print_r('success');else print_r('faiure');
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

		if(isset($_POST['Workrecord']))
		{
			$model->attributes=$_POST['Workrecord'];
			$model->fRecordDate=strtotime($model->fRecordDate);
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->fRecordNo));
		}
		$model->fRecordDate=empty($model->fRecordDate)?'':date('Y-m-d',$model->fRecordDate);
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
		if(isset($_POST['Workrecord']))
		{
			$createmodel=new Workrecord;
			$createmodel->attributes=$_POST['Workrecord'];
			$createmodel->fRecordNo=GuidUtil::getUuid();
			$createmodel->fRecordUser=Yii::app()->params->loginuser->fUserName;
			$createmodel->fRecordDate=strtotime($createmodel->fRecordDate);
			$createmodel->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$createmodel->fCreateDate=time();
			$createmodel->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$createmodel->fUpdateDate=time();
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fRecordNo));
		}
		$id=$_GET['id'];
		$model=$this->loadModel($id);
		$model->fRecordDate=empty($model->fRecordDate)?'':date('Y-m-d',$model->fRecordDate);
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
		$model=new Workrecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Workrecord']))
			$model->attributes=$_GET['Workrecord'];

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

        $pages=new CPagination(Workrecord::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Workrecord');//排序，参考YII文档CSort
        $sort->attributes=array(
		'fRecordUser'=>array('asc'=>'fRecordUser','desc'=>'fRecordUser desc','label'=>Workrecord::model()->getAttributeLabel('fRecordUser')),
		'fRecordDate'=>array('asc'=>'fRecordDate','desc'=>'fRecordDate desc','label'=>Workrecord::model()->getAttributeLabel('fRecordDate')),
		'fPlan'=>array('asc'=>'fPlan','desc'=>'fPlan desc','label'=>Workrecord::model()->getAttributeLabel('fPlan')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Workrecord::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Workrecord::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Workrecord::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Workrecord::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='fRecordNo';
        $sort->applyOrder($criteria);
        $gridRows=array();
		$model=new Workrecord;
		$model->unsetAttributes();  // clear any default values
		
		$workplan=new Workplan();
		
		$workrecords=Workrecord::model()->findAllByAttributes(array('fRecordUser'=>Yii::app()->params->loginuser->fUserName));
        $formate_str='{id:\'%s\',title: \'%s\',start: \'%s\',end: \'%s\',plan: \'%s\',result: \'%s\',summary: \'%s\',evaluate: \'%s\',memo: \'%s\',allDay: true},';
        $tempStr='';
        foreach($workrecords as $workrecord)
       {
        	$tempStr=$tempStr.sprintf($formate_str,$workrecord->fRecordNo,$workrecord->fPlan,$workrecord->fRecordDate,$workrecord->fRecordDate
        			,$workrecord->fPlan,$workrecord->fResult,$workrecord->fSummary,$workrecord->fEvaluate,$workrecord->fMemo);
       }
        $calender_str='['.$tempStr.']';
        $this->render('index',array(
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,'workplan'=>$workplan,'calender_str'=>$calender_str,
        ));
    }
    /**
     * Grid of all models.
     */
    public function actionList()
    {
    	$criteria=new CDbCriteria;
    
    	$pages=new CPagination(Workrecord::model()->count($criteria));//记录总数
    	$pages->pageSize=5;//设置每页的记录显示条数
    	$pages->applyLimit($criteria);
    
    	$sort=new CSort('Workrecord');//排序，参考YII文档CSort
    	$sort->attributes=array(
    			'fRecordUser'=>array('asc'=>'fRecordUser','desc'=>'fRecordUser desc','label'=>Workrecord::model()->getAttributeLabel('fRecordUser')),
    			'fRecordDate'=>array('asc'=>'fRecordDate','desc'=>'fRecordDate desc','label'=>Workrecord::model()->getAttributeLabel('fRecordDate')),
    			'fPlan'=>array('asc'=>'fPlan','desc'=>'fPlan desc','label'=>Workrecord::model()->getAttributeLabel('fPlan')),
    			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Workrecord::model()->getAttributeLabel('fCreateUser')),
    			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Workrecord::model()->getAttributeLabel('fCreateDate')),
    			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Workrecord::model()->getAttributeLabel('fUpdateUser')),
    			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Workrecord::model()->getAttributeLabel('fUpdateDate')),
    	);
    	$sort->defaultOrder='fRecordNo';
    	$sort->applyOrder($criteria);
    	$gridRows=array();
    	$model=new Workrecord;
    	$model->unsetAttributes();  // clear any default values    
    	$workplan=new Workplan();
    	$workrecords=Workrecord::model()->findAllByAttributes(array('fRecordUser'=>Yii::app()->params->loginuser->fUserName));
    	$this->render('list',array(
    			'pages'=>$pages,
    			'sort'=>$sort,
    			'gridRows'=>$gridRows,
    			'model'=>$model,'workplan'=>$workplan,
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
		'fRecordUser'=>Workrecord::model()->getAttributeLabel('fRecordUser'),
		'fRecordDate'=>Workrecord::model()->getAttributeLabel('fRecordDate'),
		'fPlan'=>Workrecord::model()->getAttributeLabel('fPlan'),
		'fCreateUser'=>Workrecord::model()->getAttributeLabel('fCreateUser'),
		'fCreateDate'=>Workrecord::model()->getAttributeLabel('fCreateDate'),
		'fUpdateUser'=>Workrecord::model()->getAttributeLabel('fUpdateUser'),
		'fUpdateDate'=>Workrecord::model()->getAttributeLabel('fUpdateDate'),
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
        
		$pages=new CPagination(Workrecord::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Workrecord');
		
        $sort->attributes=array(
		'fRecordUser'=>array('asc'=>'fRecordUser','desc'=>'fRecordUser desc','label'=>Workrecord::model()->getAttributeLabel('fRecordUser')),
		'fRecordDate'=>array('asc'=>'fRecordDate','desc'=>'fRecordDate desc','label'=>Workrecord::model()->getAttributeLabel('fRecordDate')),
		'fPlan'=>array('asc'=>'fPlan','desc'=>'fPlan desc','label'=>Workrecord::model()->getAttributeLabel('fPlan')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Workrecord::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Workrecord::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Workrecord::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Workrecord::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='fRecordNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Workrecord::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {
            $data['rows'][]=array(
                		 'fRecordNo'=>$model->fRecordNo,
						'cell'=>array(CHtml::encode($model->fRecordUser).(Yii::app()->user->checkAccess('report.workrecord.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fRecordNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Update')
                )):'').(Yii::app()->user->checkAccess('report.workrecord.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fRecordNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'').(Yii::app()->user->checkAccess('report.workrecord.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fRecordNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Delete')
                )):''),	
		 CHtml::encode(empty($model->fRecordDate)?'':date('Y-m-d',$model->fRecordDate)),
		 CHtml::encode($model->fPlan),
		 CHtml::encode($model->fCreateUser),
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
		$model=Workrecord::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='workrecord-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
