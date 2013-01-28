<?php

class ModulesController extends AppController
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

		$model=new Modules;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Modules']))
		{
			$model->attributes=$_POST['Modules'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fModuleID));
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

		if(isset($_POST['Modules']))
		{
			$model->attributes=$_POST['Modules'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fModuleID));
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
		$dataProvider=new CActiveDataProvider('Modules');
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
		$model=new Modules('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Modules']))
			$model->attributes=$_GET['Modules'];

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

        $pages=new CPagination(Modules::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Modules');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fModuleID'=>array('asc'=>'fModuleID','desc'=>'fModuleID desc','label'=>Modules::model()->getAttributeLabel('fModuleID')),
		'fModuleName'=>array('asc'=>'fModuleName','desc'=>'fModuleName desc','label'=>Modules::model()->getAttributeLabel('fModuleName')),
		'fModuleTitle'=>array('asc'=>'fModuleTitle','desc'=>'fModuleTitle desc','label'=>Modules::model()->getAttributeLabel('fModuleTitle')),
		'fIsVisible'=>array('asc'=>'fIsVisible','desc'=>'fIsVisible desc','label'=>Modules::model()->getAttributeLabel('fIsVisible')),
		'fSearchable'=>array('asc'=>'fSearchable','desc'=>'fSearchable desc','label'=>Modules::model()->getAttributeLabel('fSearchable')),
		'FCustom'=>array('asc'=>'FCustom','desc'=>'FCustom desc','label'=>Modules::model()->getAttributeLabel('FCustom')),
		/*
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Modules::model()->getAttributeLabel('fCreateDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Modules::model()->getAttributeLabel('fCreateUser')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Modules::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Modules::model()->getAttributeLabel('fUpdateDate')),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Modules::model()->getAttributeLabel('fUpdateDate')),
        );
        		 $sort->defaultOrder='fModuleID';
        $sort->applyOrder($criteria);

        // find all
        $models=Modules::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fModuleID)),
		 array('content'=>CHtml::encode($model->fModuleName)),
		 array('content'=>CHtml::encode($model->fModuleTitle)),
		 array('content'=>CHtml::encode($model->fIsVisible)),
		 array('content'=>CHtml::encode($model->fSearchable)),
		 array('content'=>CHtml::encode($model->FCustom)),
		/*
		 array('content'=>CHtml::encode($model->fCreateDate)),
		 array('content'=>CHtml::encode($model->fCreateUser)),
		 array('content'=>CHtml::encode($model->fUpdateUser)),
		 array('content'=>CHtml::encode($model->fUpdateDate)),
		*/
            );
        }	
		
		$model=new Modules;
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
						'fModuleID'=>Modules::model()->getAttributeLabel('fModuleID'),
		'fModuleName'=>Modules::model()->getAttributeLabel('fModuleName'),
		'fModuleTitle'=>Modules::model()->getAttributeLabel('fModuleTitle'),
		'fIsVisible'=>Modules::model()->getAttributeLabel('fIsVisible'),
		'fSearchable'=>Modules::model()->getAttributeLabel('fSearchable'),
		'FCustom'=>Modules::model()->getAttributeLabel('FCustom'),
		/*
		'fCreateDate'=>Modules::model()->getAttributeLabel('fCreateDate'),
		'fCreateUser'=>Modules::model()->getAttributeLabel('fCreateUser'),
		'fUpdateUser'=>Modules::model()->getAttributeLabel('fUpdateUser'),
		'fUpdateDate'=>Modules::model()->getAttributeLabel('fUpdateDate'),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Modules::model()->getAttributeLabel('fUpdateDate')),
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
        
		$pages=new CPagination(Modules::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Modules');
		
        $sort->attributes=array(
           		'fModuleID'=>array('asc'=>'fModuleID','desc'=>'fModuleID desc','label'=>Modules::model()->getAttributeLabel('fModuleID')),
		'fModuleName'=>array('asc'=>'fModuleName','desc'=>'fModuleName desc','label'=>Modules::model()->getAttributeLabel('fModuleName')),
		'fModuleTitle'=>array('asc'=>'fModuleTitle','desc'=>'fModuleTitle desc','label'=>Modules::model()->getAttributeLabel('fModuleTitle')),
		'fIsVisible'=>array('asc'=>'fIsVisible','desc'=>'fIsVisible desc','label'=>Modules::model()->getAttributeLabel('fIsVisible')),
		'fSearchable'=>array('asc'=>'fSearchable','desc'=>'fSearchable desc','label'=>Modules::model()->getAttributeLabel('fSearchable')),
		'FCustom'=>array('asc'=>'FCustom','desc'=>'FCustom desc','label'=>Modules::model()->getAttributeLabel('FCustom')),
		/*
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Modules::model()->getAttributeLabel('fCreateDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Modules::model()->getAttributeLabel('fCreateUser')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Modules::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Modules::model()->getAttributeLabel('fUpdateDate')),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Modules::model()->getAttributeLabel('fUpdateDate')),
        );
        		 $sort->defaultOrder='fModuleID';
        $sort->applyOrder($criteria);

        // find all
        $models=Modules::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fModuleID'=>$model->fModuleID,'cell'=>array(CHtml::encode($model->fModuleID).CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fModuleID),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'show'
                )).CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fModuleID),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'edit'
                )),		 CHtml::encode($model->fModuleName),
		 CHtml::encode($model->fModuleTitle),
		 CHtml::encode($model->fIsVisible),
		 CHtml::encode($model->fSearchable),
		 CHtml::encode($model->FCustom),
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
		$model=Modules::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='modules-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
