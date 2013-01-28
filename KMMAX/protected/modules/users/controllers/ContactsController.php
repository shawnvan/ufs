<?php

class ContactsController extends AppController
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

		$model=new Contacts;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contacts']))
		{
			$model->attributes=$_POST['Contacts'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fContactID));
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

		if(isset($_POST['Contacts']))
		{
			$model->attributes=$_POST['Contacts'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fContactID));
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
		$dataProvider=new CActiveDataProvider('Contacts');
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
		$model=new Contacts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contacts']))
			$model->attributes=$_GET['Contacts'];

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

        $pages=new CPagination(Contacts::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Contacts');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fContactID'=>array('asc'=>'fContactID','desc'=>'fContactID desc','label'=>Contacts::model()->getAttributeLabel('fContactID')),
		'fContactName'=>array('asc'=>'fContactName','desc'=>'fContactName desc','label'=>Contacts::model()->getAttributeLabel('fContactName')),
		'fFristName'=>array('asc'=>'fFristName','desc'=>'fFristName desc','label'=>Contacts::model()->getAttributeLabel('fFristName')),
		'fLastName'=>array('asc'=>'fLastName','desc'=>'fLastName desc','label'=>Contacts::model()->getAttributeLabel('fLastName')),
		'fContactTitle'=>array('asc'=>'fContactTitle','desc'=>'fContactTitle desc','label'=>Contacts::model()->getAttributeLabel('fContactTitle')),
		'fCompany'=>array('asc'=>'fCompany','desc'=>'fCompany desc','label'=>Contacts::model()->getAttributeLabel('fCompany')),
		/*
		'fPhone'=>array('asc'=>'fPhone','desc'=>'fPhone desc','label'=>Contacts::model()->getAttributeLabel('fPhone')),
		'fPhone2'=>array('asc'=>'fPhone2','desc'=>'fPhone2 desc','label'=>Contacts::model()->getAttributeLabel('fPhone2')),
		'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>Contacts::model()->getAttributeLabel('fEmail')),
		'fWebsite'=>array('asc'=>'fWebsite','desc'=>'fWebsite desc','label'=>Contacts::model()->getAttributeLabel('fWebsite')),
		'fAddress'=>array('asc'=>'fAddress','desc'=>'fAddress desc','label'=>Contacts::model()->getAttributeLabel('fAddress')),
		'fAddress2'=>array('asc'=>'fAddress2','desc'=>'fAddress2 desc','label'=>Contacts::model()->getAttributeLabel('fAddress2')),
		'fCity'=>array('asc'=>'fCity','desc'=>'fCity desc','label'=>Contacts::model()->getAttributeLabel('fCity')),
		'fState'=>array('asc'=>'fState','desc'=>'fState desc','label'=>Contacts::model()->getAttributeLabel('fState')),
		'fZipCode'=>array('asc'=>'fZipCode','desc'=>'fZipCode desc','label'=>Contacts::model()->getAttributeLabel('fZipCode')),
		'fCountry'=>array('asc'=>'fCountry','desc'=>'fCountry desc','label'=>Contacts::model()->getAttributeLabel('fCountry')),
		'fVisibility'=>array('asc'=>'fVisibility','desc'=>'fVisibility desc','label'=>Contacts::model()->getAttributeLabel('fVisibility')),
		'fAssignedTo'=>array('asc'=>'fAssignedTo','desc'=>'fAssignedTo desc','label'=>Contacts::model()->getAttributeLabel('fAssignedTo')),
		'fBackGroundInfo'=>array('asc'=>'fBackGroundInfo','desc'=>'fBackGroundInfo desc','label'=>Contacts::model()->getAttributeLabel('fBackGroundInfo')),
		'fQQ'=>array('asc'=>'fQQ','desc'=>'fQQ desc','label'=>Contacts::model()->getAttributeLabel('fQQ')),
		'fLinkedIn'=>array('asc'=>'fLinkedIn','desc'=>'fLinkedIn desc','label'=>Contacts::model()->getAttributeLabel('fLinkedIn')),
		'fMSN'=>array('asc'=>'fMSN','desc'=>'fMSN desc','label'=>Contacts::model()->getAttributeLabel('fMSN')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Contacts::model()->getAttributeLabel('fCreateDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Contacts::model()->getAttributeLabel('fCreateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Contacts::model()->getAttributeLabel('fUpdateDate')),
		'fUpadateUser'=>array('asc'=>'fUpadateUser','desc'=>'fUpadateUser desc','label'=>Contacts::model()->getAttributeLabel('fUpadateUser')),
		*/'fUpadateUser'=>array('asc'=>'fUpadateUser','desc'=>'fUpadateUser desc','label'=>Contacts::model()->getAttributeLabel('fUpadateUser')),
        );
        		 $sort->defaultOrder='fContactID';
        $sort->applyOrder($criteria);

        // find all
        $models=Contacts::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fContactID)),
		 array('content'=>CHtml::encode($model->fContactName)),
		 array('content'=>CHtml::encode($model->fFristName)),
		 array('content'=>CHtml::encode($model->fLastName)),
		 array('content'=>CHtml::encode($model->fContactTitle)),
		 array('content'=>CHtml::encode($model->fCompany)),
		/*
		 array('content'=>CHtml::encode($model->fPhone)),
		 array('content'=>CHtml::encode($model->fPhone2)),
		 array('content'=>CHtml::encode($model->fEmail)),
		 array('content'=>CHtml::encode($model->fWebsite)),
		 array('content'=>CHtml::encode($model->fAddress)),
		 array('content'=>CHtml::encode($model->fAddress2)),
		 array('content'=>CHtml::encode($model->fCity)),
		 array('content'=>CHtml::encode($model->fState)),
		 array('content'=>CHtml::encode($model->fZipCode)),
		 array('content'=>CHtml::encode($model->fCountry)),
		 array('content'=>CHtml::encode($model->fVisibility)),
		 array('content'=>CHtml::encode($model->fAssignedTo)),
		 array('content'=>CHtml::encode($model->fBackGroundInfo)),
		 array('content'=>CHtml::encode($model->fQQ)),
		 array('content'=>CHtml::encode($model->fLinkedIn)),
		 array('content'=>CHtml::encode($model->fMSN)),
		 array('content'=>CHtml::encode($model->fCreateDate)),
		 array('content'=>CHtml::encode($model->fCreateUser)),
		 array('content'=>CHtml::encode($model->fUpdateDate)),
		 array('content'=>CHtml::encode($model->fUpadateUser)),
		*/
            );
        }	
		
		$model=new Contacts;
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
						'fContactID'=>Contacts::model()->getAttributeLabel('fContactID'),
		'fContactName'=>Contacts::model()->getAttributeLabel('fContactName'),
		'fFristName'=>Contacts::model()->getAttributeLabel('fFristName'),
		'fLastName'=>Contacts::model()->getAttributeLabel('fLastName'),
		'fContactTitle'=>Contacts::model()->getAttributeLabel('fContactTitle'),
		'fCompany'=>Contacts::model()->getAttributeLabel('fCompany'),
		/*
		'fPhone'=>Contacts::model()->getAttributeLabel('fPhone'),
		'fPhone2'=>Contacts::model()->getAttributeLabel('fPhone2'),
		'fEmail'=>Contacts::model()->getAttributeLabel('fEmail'),
		'fWebsite'=>Contacts::model()->getAttributeLabel('fWebsite'),
		'fAddress'=>Contacts::model()->getAttributeLabel('fAddress'),
		'fAddress2'=>Contacts::model()->getAttributeLabel('fAddress2'),
		'fCity'=>Contacts::model()->getAttributeLabel('fCity'),
		'fState'=>Contacts::model()->getAttributeLabel('fState'),
		'fZipCode'=>Contacts::model()->getAttributeLabel('fZipCode'),
		'fCountry'=>Contacts::model()->getAttributeLabel('fCountry'),
		'fVisibility'=>Contacts::model()->getAttributeLabel('fVisibility'),
		'fAssignedTo'=>Contacts::model()->getAttributeLabel('fAssignedTo'),
		'fBackGroundInfo'=>Contacts::model()->getAttributeLabel('fBackGroundInfo'),
		'fQQ'=>Contacts::model()->getAttributeLabel('fQQ'),
		'fLinkedIn'=>Contacts::model()->getAttributeLabel('fLinkedIn'),
		'fMSN'=>Contacts::model()->getAttributeLabel('fMSN'),
		'fCreateDate'=>Contacts::model()->getAttributeLabel('fCreateDate'),
		'fCreateUser'=>Contacts::model()->getAttributeLabel('fCreateUser'),
		'fUpdateDate'=>Contacts::model()->getAttributeLabel('fUpdateDate'),
		'fUpadateUser'=>Contacts::model()->getAttributeLabel('fUpadateUser'),
		*/'fUpadateUser'=>array('asc'=>'fUpadateUser','desc'=>'fUpadateUser desc','label'=>Contacts::model()->getAttributeLabel('fUpadateUser')),
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
        
		$pages=new CPagination(Contacts::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Contacts');
		
        $sort->attributes=array(
           		'fContactID'=>array('asc'=>'fContactID','desc'=>'fContactID desc','label'=>Contacts::model()->getAttributeLabel('fContactID')),
		'fContactName'=>array('asc'=>'fContactName','desc'=>'fContactName desc','label'=>Contacts::model()->getAttributeLabel('fContactName')),
		'fFristName'=>array('asc'=>'fFristName','desc'=>'fFristName desc','label'=>Contacts::model()->getAttributeLabel('fFristName')),
		'fLastName'=>array('asc'=>'fLastName','desc'=>'fLastName desc','label'=>Contacts::model()->getAttributeLabel('fLastName')),
		'fContactTitle'=>array('asc'=>'fContactTitle','desc'=>'fContactTitle desc','label'=>Contacts::model()->getAttributeLabel('fContactTitle')),
		'fCompany'=>array('asc'=>'fCompany','desc'=>'fCompany desc','label'=>Contacts::model()->getAttributeLabel('fCompany')),
		/*
		'fPhone'=>array('asc'=>'fPhone','desc'=>'fPhone desc','label'=>Contacts::model()->getAttributeLabel('fPhone')),
		'fPhone2'=>array('asc'=>'fPhone2','desc'=>'fPhone2 desc','label'=>Contacts::model()->getAttributeLabel('fPhone2')),
		'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>Contacts::model()->getAttributeLabel('fEmail')),
		'fWebsite'=>array('asc'=>'fWebsite','desc'=>'fWebsite desc','label'=>Contacts::model()->getAttributeLabel('fWebsite')),
		'fAddress'=>array('asc'=>'fAddress','desc'=>'fAddress desc','label'=>Contacts::model()->getAttributeLabel('fAddress')),
		'fAddress2'=>array('asc'=>'fAddress2','desc'=>'fAddress2 desc','label'=>Contacts::model()->getAttributeLabel('fAddress2')),
		'fCity'=>array('asc'=>'fCity','desc'=>'fCity desc','label'=>Contacts::model()->getAttributeLabel('fCity')),
		'fState'=>array('asc'=>'fState','desc'=>'fState desc','label'=>Contacts::model()->getAttributeLabel('fState')),
		'fZipCode'=>array('asc'=>'fZipCode','desc'=>'fZipCode desc','label'=>Contacts::model()->getAttributeLabel('fZipCode')),
		'fCountry'=>array('asc'=>'fCountry','desc'=>'fCountry desc','label'=>Contacts::model()->getAttributeLabel('fCountry')),
		'fVisibility'=>array('asc'=>'fVisibility','desc'=>'fVisibility desc','label'=>Contacts::model()->getAttributeLabel('fVisibility')),
		'fAssignedTo'=>array('asc'=>'fAssignedTo','desc'=>'fAssignedTo desc','label'=>Contacts::model()->getAttributeLabel('fAssignedTo')),
		'fBackGroundInfo'=>array('asc'=>'fBackGroundInfo','desc'=>'fBackGroundInfo desc','label'=>Contacts::model()->getAttributeLabel('fBackGroundInfo')),
		'fQQ'=>array('asc'=>'fQQ','desc'=>'fQQ desc','label'=>Contacts::model()->getAttributeLabel('fQQ')),
		'fLinkedIn'=>array('asc'=>'fLinkedIn','desc'=>'fLinkedIn desc','label'=>Contacts::model()->getAttributeLabel('fLinkedIn')),
		'fMSN'=>array('asc'=>'fMSN','desc'=>'fMSN desc','label'=>Contacts::model()->getAttributeLabel('fMSN')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Contacts::model()->getAttributeLabel('fCreateDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Contacts::model()->getAttributeLabel('fCreateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Contacts::model()->getAttributeLabel('fUpdateDate')),
		'fUpadateUser'=>array('asc'=>'fUpadateUser','desc'=>'fUpadateUser desc','label'=>Contacts::model()->getAttributeLabel('fUpadateUser')),
		*/'fUpadateUser'=>array('asc'=>'fUpadateUser','desc'=>'fUpadateUser desc','label'=>Contacts::model()->getAttributeLabel('fUpadateUser')),
        );
        		 $sort->defaultOrder='fContactID';
        $sort->applyOrder($criteria);

        // find all
        $models=Contacts::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fContactID'=>$model->fContactID,'cell'=>array(CHtml::encode($model->fContactID).CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fContactID),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'show'
                )).CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fContactID),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'edit'
                )),		 CHtml::encode($model->fContactName),
		 CHtml::encode($model->fFristName),
		 CHtml::encode($model->fLastName),
		 CHtml::encode($model->fContactTitle),
		 CHtml::encode($model->fCompany),
		 CHtml::encode($model->fPhone),
		 CHtml::encode($model->fPhone2),
		 CHtml::encode($model->fEmail),
		 CHtml::encode($model->fWebsite),
		 CHtml::encode($model->fAddress),
		 CHtml::encode($model->fAddress2),
		 CHtml::encode($model->fCity),
		 CHtml::encode($model->fState),
		 CHtml::encode($model->fZipCode),
		 CHtml::encode($model->fCountry),
		 CHtml::encode($model->fVisibility),
		 CHtml::encode($model->fAssignedTo),
		 CHtml::encode($model->fBackGroundInfo),
		 CHtml::encode($model->fQQ),
		 CHtml::encode($model->fLinkedIn),
		 CHtml::encode($model->fMSN),
		 CHtml::encode($model->fCreateDate),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode($model->fUpdateDate),
		 CHtml::encode($model->fUpadateUser),
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
		$model=Contacts::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contacts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
