<?php

class WorkplanController extends AppController
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

		$model=new Workplan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Workplan']))
		{
			$model->attributes=$_POST['Workplan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fPlanNo));
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

		if(isset($_POST['Workplan']))
		{
			$model->attributes=$_POST['Workplan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fPlanNo));
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

		if(isset($_POST['Workplan']))
		{
			$createmodel=new Workplan;
			$createmodel->attributes=$_POST['Workplan'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fPlanNo));
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
		$model=new Workplan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Workplan']))
			$model->attributes=$_GET['Workplan'];

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

        $pages=new CPagination(Workplan::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Workplan');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fPlanNo'=>array('asc'=>'fPlanNo','desc'=>'fPlanNo desc','label'=>Workplan::model()->getAttributeLabel('fPlanNo')),
		'fTitle'=>array('asc'=>'fTitle','desc'=>'fTitle desc','label'=>Workplan::model()->getAttributeLabel('fTitle')),
		'fMonth'=>array('asc'=>'fMonth','desc'=>'fMonth desc','label'=>Workplan::model()->getAttributeLabel('fMonth')),
		'fUpPlan'=>array('asc'=>'fUpPlan','desc'=>'fUpPlan desc','label'=>Workplan::model()->getAttributeLabel('fUpPlan')),
		'fNowPlan'=>array('asc'=>'fNowPlan','desc'=>'fNowPlan desc','label'=>Workplan::model()->getAttributeLabel('fNowPlan')),
		'fMemo'=>array('asc'=>'fMemo','desc'=>'fMemo desc','label'=>Workplan::model()->getAttributeLabel('fMemo')),
		/*
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Workplan::model()->getAttributeLabel('fCreateDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Workplan::model()->getAttributeLabel('fCreateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Workplan::model()->getAttributeLabel('fUpdateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Workplan::model()->getAttributeLabel('fUpdateUser')),
		*/'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Workplan::model()->getAttributeLabel('fUpdateUser')),
        );
        $sort->defaultOrder='fPlanNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Workplan::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fPlanNo)),
		 array('content'=>CHtml::encode($model->fTitle)),
		 array('content'=>CHtml::encode($model->fMonth)),
		 array('content'=>CHtml::encode($model->fUpPlan)),
		 array('content'=>CHtml::encode($model->fNowPlan)),
		 array('content'=>CHtml::encode($model->fMemo)),
		/*
		 array('content'=>CHtml::encode($model->fCreateDate)),
		 array('content'=>CHtml::encode($model->fCreateUser)),
		 array('content'=>CHtml::encode($model->fUpdateDate)),
		 array('content'=>CHtml::encode($model->fUpdateUser)),
		*/
            );
        }	
		
		$model=new Workplan;
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
						'fPlanNo'=>Workplan::model()->getAttributeLabel('fPlanNo'),
		'fTitle'=>Workplan::model()->getAttributeLabel('fTitle'),
		'fMonth'=>Workplan::model()->getAttributeLabel('fMonth'),
		'fUpPlan'=>Workplan::model()->getAttributeLabel('fUpPlan'),
		'fNowPlan'=>Workplan::model()->getAttributeLabel('fNowPlan'),
		'fMemo'=>Workplan::model()->getAttributeLabel('fMemo'),
		/*
		'fCreateDate'=>Workplan::model()->getAttributeLabel('fCreateDate'),
		'fCreateUser'=>Workplan::model()->getAttributeLabel('fCreateUser'),
		'fUpdateDate'=>Workplan::model()->getAttributeLabel('fUpdateDate'),
		'fUpdateUser'=>Workplan::model()->getAttributeLabel('fUpdateUser'),
		*/'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Workplan::model()->getAttributeLabel('fUpdateUser')),
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
        
		$pages=new CPagination(Workplan::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Workplan');
		
        $sort->attributes=array(
           		'fPlanNo'=>array('asc'=>'fPlanNo','desc'=>'fPlanNo desc','label'=>Workplan::model()->getAttributeLabel('fPlanNo')),
		'fTitle'=>array('asc'=>'fTitle','desc'=>'fTitle desc','label'=>Workplan::model()->getAttributeLabel('fTitle')),
		'fMonth'=>array('asc'=>'fMonth','desc'=>'fMonth desc','label'=>Workplan::model()->getAttributeLabel('fMonth')),
		'fUpPlan'=>array('asc'=>'fUpPlan','desc'=>'fUpPlan desc','label'=>Workplan::model()->getAttributeLabel('fUpPlan')),
		'fNowPlan'=>array('asc'=>'fNowPlan','desc'=>'fNowPlan desc','label'=>Workplan::model()->getAttributeLabel('fNowPlan')),
		'fMemo'=>array('asc'=>'fMemo','desc'=>'fMemo desc','label'=>Workplan::model()->getAttributeLabel('fMemo')),
		/*
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Workplan::model()->getAttributeLabel('fCreateDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Workplan::model()->getAttributeLabel('fCreateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Workplan::model()->getAttributeLabel('fUpdateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Workplan::model()->getAttributeLabel('fUpdateUser')),
		*/'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Workplan::model()->getAttributeLabel('fUpdateUser')),
        );
        $sort->defaultOrder='fPlanNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Workplan::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fPlanNo'=>$model->fPlanNo,
						'cell'=>array(CHtml::encode($model->fPlanNo).(Yii::app()->user->checkAccess('admin.workplan.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fPlanNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('admin.workplan.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fPlanNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('admin.workplan.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fPlanNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fTitle),
		 CHtml::encode($model->fMonth),
		 CHtml::encode($model->fUpPlan),
		 CHtml::encode($model->fNowPlan),
		 CHtml::encode($model->fMemo),
		 CHtml::encode($model->fCreateDate),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode($model->fUpdateDate),
		 CHtml::encode($model->fUpdateUser),
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
		$model=Workplan::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='workplan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
