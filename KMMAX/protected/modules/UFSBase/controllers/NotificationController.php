<?php

class NotificationController extends AppController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new Notification;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Notification']))
		{
			$model->attributes=$_POST['Notification'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fNotifyID));
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

		if(isset($_POST['Notification']))
		{
			$model->attributes=$_POST['Notification'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fNotifyID));
		}

		$this->render('update',array(
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
	 * Lists all models.
	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Notification');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	 */

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Notification('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Notification']))
			$model->attributes=$_GET['Notification'];

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

        $pages=new CPagination(Notification::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Notification');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fNotifyID'=>array('asc'=>'fNotifyID','desc'=>'fNotifyID desc','label'=>Notification::model()->getAttributeLabel('fNotifyID')),
		'fType'=>array('asc'=>'fType','desc'=>'fType desc','label'=>Notification::model()->getAttributeLabel('fType')),
		'fComparison'=>array('asc'=>'fComparison','desc'=>'fComparison desc','label'=>Notification::model()->getAttributeLabel('fComparison')),
		'fValue'=>array('asc'=>'fValue','desc'=>'fValue desc','label'=>Notification::model()->getAttributeLabel('fValue')),
		'fModelType'=>array('asc'=>'fModelType','desc'=>'fModelType desc','label'=>Notification::model()->getAttributeLabel('fModelType')),
		'fModelID'=>array('asc'=>'fModelID','desc'=>'fModelID desc','label'=>Notification::model()->getAttributeLabel('fModelID')),
		/*
		'fFieldName'=>array('asc'=>'fFieldName','desc'=>'fFieldName desc','label'=>Notification::model()->getAttributeLabel('fFieldName')),
		'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>Notification::model()->getAttributeLabel('fUserName')),
		'fUserID'=>array('asc'=>'fUserID','desc'=>'fUserID desc','label'=>Notification::model()->getAttributeLabel('fUserID')),
		'fCreatedBy'=>array('asc'=>'fCreatedBy','desc'=>'fCreatedBy desc','label'=>Notification::model()->getAttributeLabel('fCreatedBy')),
		'fViewed'=>array('asc'=>'fViewed','desc'=>'fViewed desc','label'=>Notification::model()->getAttributeLabel('fViewed')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Notification::model()->getAttributeLabel('fCreateDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Notification::model()->getAttributeLabel('fCreateUser')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Notification::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Notification::model()->getAttributeLabel('fUpdateDate')),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Notification::model()->getAttributeLabel('fUpdateDate')),
        );
        		 $sort->defaultOrder='fNotifyID';
        $sort->applyOrder($criteria);

        // find all
        $models=Notification::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fNotifyID)),
		 array('content'=>CHtml::encode($model->fType)),
		 array('content'=>CHtml::encode($model->fComparison)),
		 array('content'=>CHtml::encode($model->fValue)),
		 array('content'=>CHtml::encode($model->fModelType)),
		 array('content'=>CHtml::encode($model->fModelID)),
		/*
		 array('content'=>CHtml::encode($model->fFieldName)),
		 array('content'=>CHtml::encode($model->fUserName)),
		 array('content'=>CHtml::encode($model->fUserID)),
		 array('content'=>CHtml::encode($model->fCreatedBy)),
		 array('content'=>CHtml::encode($model->fViewed)),
		 array('content'=>CHtml::encode($model->fCreateDate)),
		 array('content'=>CHtml::encode($model->fCreateUser)),
		 array('content'=>CHtml::encode($model->fUpdateUser)),
		 array('content'=>CHtml::encode($model->fUpdateDate)),
		*/
            );
        }	
		
		$model=new Notification;
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
						'fNotifyID'=>Notification::model()->getAttributeLabel('fNotifyID'),
		'fType'=>Notification::model()->getAttributeLabel('fType'),
		'fComparison'=>Notification::model()->getAttributeLabel('fComparison'),
		'fValue'=>Notification::model()->getAttributeLabel('fValue'),
		'fModelType'=>Notification::model()->getAttributeLabel('fModelType'),
		'fModelID'=>Notification::model()->getAttributeLabel('fModelID'),
		/*
		'fFieldName'=>Notification::model()->getAttributeLabel('fFieldName'),
		'fUserName'=>Notification::model()->getAttributeLabel('fUserName'),
		'fUserID'=>Notification::model()->getAttributeLabel('fUserID'),
		'fCreatedBy'=>Notification::model()->getAttributeLabel('fCreatedBy'),
		'fViewed'=>Notification::model()->getAttributeLabel('fViewed'),
		'fCreateDate'=>Notification::model()->getAttributeLabel('fCreateDate'),
		'fCreateUser'=>Notification::model()->getAttributeLabel('fCreateUser'),
		'fUpdateUser'=>Notification::model()->getAttributeLabel('fUpdateUser'),
		'fUpdateDate'=>Notification::model()->getAttributeLabel('fUpdateDate'),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Notification::model()->getAttributeLabel('fUpdateDate')),
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
        
		$pages=new CPagination(Notification::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Notification');
		
        $sort->attributes=array(
           		'fNotifyID'=>array('asc'=>'fNotifyID','desc'=>'fNotifyID desc','label'=>Notification::model()->getAttributeLabel('fNotifyID')),
		'fType'=>array('asc'=>'fType','desc'=>'fType desc','label'=>Notification::model()->getAttributeLabel('fType')),
		'fComparison'=>array('asc'=>'fComparison','desc'=>'fComparison desc','label'=>Notification::model()->getAttributeLabel('fComparison')),
		'fValue'=>array('asc'=>'fValue','desc'=>'fValue desc','label'=>Notification::model()->getAttributeLabel('fValue')),
		'fModelType'=>array('asc'=>'fModelType','desc'=>'fModelType desc','label'=>Notification::model()->getAttributeLabel('fModelType')),
		'fModelID'=>array('asc'=>'fModelID','desc'=>'fModelID desc','label'=>Notification::model()->getAttributeLabel('fModelID')),
		/*
		'fFieldName'=>array('asc'=>'fFieldName','desc'=>'fFieldName desc','label'=>Notification::model()->getAttributeLabel('fFieldName')),
		'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>Notification::model()->getAttributeLabel('fUserName')),
		'fUserID'=>array('asc'=>'fUserID','desc'=>'fUserID desc','label'=>Notification::model()->getAttributeLabel('fUserID')),
		'fCreatedBy'=>array('asc'=>'fCreatedBy','desc'=>'fCreatedBy desc','label'=>Notification::model()->getAttributeLabel('fCreatedBy')),
		'fViewed'=>array('asc'=>'fViewed','desc'=>'fViewed desc','label'=>Notification::model()->getAttributeLabel('fViewed')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Notification::model()->getAttributeLabel('fCreateDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Notification::model()->getAttributeLabel('fCreateUser')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Notification::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Notification::model()->getAttributeLabel('fUpdateDate')),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Notification::model()->getAttributeLabel('fUpdateDate')),
        );
        		 $sort->defaultOrder='fNotifyID';
        $sort->applyOrder($criteria);

        // find all
        $models=Notification::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fNotifyID'=>$model->fNotifyID,'cell'=>array(CHtml::encode($model->fNotifyID).CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fNotifyID),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'show'
                )).CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fNotifyID),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'edit'
                )),		 CHtml::encode($model->fType),
		 CHtml::encode($model->fComparison),
		 CHtml::encode($model->fValue),
		 CHtml::encode($model->fModelType),
		 CHtml::encode($model->fModelID),
		 CHtml::encode($model->fFieldName),
		 CHtml::encode($model->fUserName),
		 CHtml::encode($model->fUserID),
		 CHtml::encode($model->fCreatedBy),
		 CHtml::encode($model->fViewed),
		 CHtml::encode($model->fCreateDate),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode($model->fUpdateUser),
		 CHtml::encode($model->fUpdateDate),
            ));
        }
        $this->printJson($data);
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Notification::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='notification-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
