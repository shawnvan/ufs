<?php

class TagController extends AppController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$model->fCreateDate=empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate);
		$model->fUpdateDate=empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate);
		$this->render('view',array(
			'model'=>$model,
			'keyid'=>$id,'fIsActive'=>knowledgeSettings::$CatalogueStatus
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Tag;
		if(isset($_POST['Tag']))
		{
			$model->attributes=$_POST['Tag'];
			$model->fTagNo=GuidUtil::getUuid();
			$model->fStatus='IsActive';
			$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$model->fCreateDate=time();
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->fTagNo));
		}
		$this->render('create',array(
			'model'=>$model,'fIsActive'=>knowledgeSettings::$CatalogueStatus
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
		if(isset($_POST['Tag']))
		{
			$model->attributes=$_POST['Tag'];
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->fTagNo));
		}

		$this->render('update',array(
			'model'=>$model,
			'keyid'=>$id,'fIsActive'=>knowledgeSettings::$CatalogueStatus
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

		if(isset($_POST['Tag']))
		{
			$createmodel=new Tag;
			$createmodel->attributes=$_POST['Tag'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fTagNo));
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
		$model=new Tag('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tag']))
			$model->attributes=$_GET['Tag'];

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
		$model=new Tag();
		$model->fName=isset($_GET['fName'])?trim($_GET['fName']):'';
		$model->fCreateUser=isset($_GET['fCreateUser'])?trim($_GET['fCreateUser']):'';
		$criteria=$model->AdvancedSearch();
        $pages=new CPagination(Tag::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);		
        $sort=new CSort('Tag');//排序，参考YII文档CSort
        $sort->attributes=array(
		'fName'=>array('asc'=>'fName','desc'=>'fName desc','label'=>Tag::model()->getAttributeLabel('fName')),
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Tag::model()->getAttributeLabel('fStatus')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Tag::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Tag::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Tag::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Tag::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='fTagNo';
        $sort->applyOrder($criteria);
        $gridRows=array();
        $this->render('index',array(
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,
        ));
    }
    /**
     * Grid of all models.
     */
    public function actionMultigrid()
    {
    	$criteria=new CDbCriteria;
    
    	$pages=new CPagination(Tag::model()->count($criteria));//记录总数
    	$pages->pageSize=5;//设置每页的记录显示条数
    	$pages->applyLimit($criteria);
    
    	$sort=new CSort('Tag');//排序，参考YII文档CSort
    	$sort->attributes=array(
    			'fTagNo'=>array('asc'=>'fTagNo','desc'=>'fTagNo desc','label'=>Tag::model()->getAttributeLabel('fTagNo')),
    			'fName'=>array('asc'=>'fName','desc'=>'fName desc','label'=>Tag::model()->getAttributeLabel('fName')),
    			'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Tag::model()->getAttributeLabel('fStatus')),
    			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Tag::model()->getAttributeLabel('fCreateUser')),
    			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Tag::model()->getAttributeLabel('fCreateDate')),
    			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Tag::model()->getAttributeLabel('fUpdateUser')),
    			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Tag::model()->getAttributeLabel('fUpdateDate')),
    	);
    	$sort->defaultOrder='fName';
    	$sort->applyOrder($criteria);
    	$gridRows=array();
    	$model=new Tag;
    	$model->unsetAttributes();  // clear any default values
    	$this->render('multigrid',array(
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
        if(isset($_GET['multi'])) $criteria->addCondition('fStatus=\'IsActive\'');
        $model=new Tag();
        $model->fName=isset($_GET['fName'])?trim($_GET['fName']):'';
        $model->fCreateUser=isset($_GET['fCreateUser'])?trim($_GET['fCreateUser']):'';
        $criteria=$model->AdvancedSearch();
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
		$pages=new CPagination(Tag::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Tag');		
        $sort->attributes=array(
        		'fTagNo'=>array('asc'=>'fTagNo','desc'=>'fTagNo desc','label'=>Tag::model()->getAttributeLabel('fTagNo')),
		'fName'=>array('asc'=>'fName','desc'=>'fName desc','label'=>Tag::model()->getAttributeLabel('fName')),
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Tag::model()->getAttributeLabel('fStatus')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Tag::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Tag::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Tag::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Tag::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='fTagNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Tag::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {
        	if(isset($_GET['multi'])){
        		$data['rows'][]=array(
        				'fTagNo'=>$model->fTagNo,
        				'cell'=>array(CHtml::encode($model->fTagNo),CHtml::encode($model->fName),
        						CHtml::encode(array_key_exists($model->fStatus,knowledgeSettings::$CatalogueStatus)?knowledgeSettings::$CatalogueStatus[$model->fStatus]:''),
        						CHtml::encode($model->fCreateUser),
        						CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
        						CHtml::encode($model->fUpdateUser),
        						CHtml::encode(empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate)),
        				));
        	} else 
            $data['rows'][]=array(
                		 'fTagNo'=>$model->fTagNo,
						'cell'=>array(CHtml::encode($model->fName).(Yii::app()->user->checkAccess('admin.tag.Update')?CHtml::link("<span class='ui-row ui-row-edit'></span>",array('update','id'=>$model->fTagNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=> Yii::t('label','Update')
                )):'').(Yii::app()->user->checkAccess('admin.tag.View')?CHtml::link("<span class='ui-row ui-row-view'></span>",array('view','id'=>$model->fTagNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=> Yii::t('label','View')
                )):'').(Yii::app()->user->checkAccess('admin.tag.Delete')?CHtml::link("<span class='ui-row ui-row-delete'></span>",array('delete','id'=>$model->fTagNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=> Yii::t('label','Delete')
                )):''),
		 CHtml::encode(array_key_exists($model->fStatus,knowledgeSettings::$CatalogueStatus)?knowledgeSettings::$CatalogueStatus[$model->fStatus]:''),
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
		$model=Tag::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tag-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
