<?php

class KnowledgecatalogueController extends KnowledgeCommon
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
	 * 查看
	 */
	public function actionAjaxview($id){
		$knowledge=Knowledgecatalogue::model()->with('fatherknowledgecatalogue')->findByPk($id);
		$this->renderPartial('update',array(
				'data'=>UFSBaseUtil::printJson(array(
						'fCatalogueNo'=>CHtml::encode($knowledge->fCatalogueNo),
						'fCatalogueName'=>CHtml::encode($knowledge->fCatalogueName),
						'fStatus'=>CHtml::encode($knowledge->fStatus),
						'fIsDownLoad'=>CHtml::encode($knowledge->fIsDownLoad),
						'fFatherCatalogueName'=>CHtml::encode(empty($knowledge->fatherknowledgecatalogue->fCatalogueName)?'':$knowledge->fatherknowledgecatalogue->fCatalogueName),
						'fCreateDate'=>CHtml::encode(empty($knowledge->fCreateDate)?'':date('Y-m-d',$knowledge->fCreateDate)),
						'fCreateUser'=>CHtml::encode($knowledge->fCreateUser),
						'fUpdateDate'=>CHtml::encode(empty($knowledge->fUpdateDate)?'':date('Y-m-d',$knowledge->fUpdateDate)),
						'fUpdateUser'=>CHtml::encode($knowledge->fUpdateUser),
				))
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new Knowledgecatalogue;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Knowledgecatalogue']))
		{
			$model->attributes=$_POST['Knowledgecatalogue'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fCatalogueNo));
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
		
		if(isset($_POST['name']))
		{
			$model->fCatalogueName=$_POST['name'];
			$model->fStatus=$_POST['statu'];
			$model->fIsDownLoad=$_POST['down'];
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			if($model->save())
			{
				$this->renderPartial('update',array(
						'data'=>UFSBaseUtil::printJson(array(
								'fCatalogueName'=>CHtml::encode($model->fCatalogueName),
								'fIsDownLoad'=>CHtml::encode($model->fIsDownLoad),
								'fStatus'=>CHtml::encode($model->fStatus),
								'fUpdateDate'=>CHtml::encode(empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate)),
								'fUpdateUser'=>CHtml::encode($model->fUpdateUser),
								'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Update Success'),Yii::app()->params['notytype']['success']),
						))
				));
			}
		}
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionInsert()
	{
		$model=new Knowledgecatalogue();
		$model->fCatalogueNo=GuidUtil::getUuid();
		$model->fFatherCatalogueNo=$_POST['no'];
		$model->fCatalogueName=$_POST['name'];
		$model->fStatus=$_POST['statu'];
		$model->fIsDownLoad=$_POST['down'];
		$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
		$model->fCreateDate=time();
		$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
		$model->fUpdateDate=time();
		if($model->save())
		{
			$this->renderPartial('update',array(
					'data'=>UFSBaseUtil::printJson(array(
							'fCatalogueNo'=>CHtml::encode($model->fCatalogueNo),
							'fIsDownLoad'=>CHtml::encode($model->fIsDownLoad),
							'fCatalogueName'=>CHtml::encode($model->fCatalogueName),
							'fFatherNo'=>$model->fFatherCatalogueNo,
							'fStatus'=>CHtml::encode($model->fStatus),
							'fCreateDate'=>CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
							'fCreateUser'=>CHtml::encode($model->fCreateUser),
							'fUpdateDate'=>CHtml::encode(empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate)),
							'fUpdateUser'=>CHtml::encode($model->fUpdateUser),
							'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Add Success'),Yii::app()->params['notytype']['success']),
					))
			));
		}
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

		if(isset($_POST['Knowledgecatalogue']))
		{
			$createmodel=new Knowledgecatalogue;
			$createmodel->attributes=$_POST['Knowledgecatalogue'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fCatalogueNo));
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
	public function actionDeletecatalogue($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			$this->renderPartial('update',array(
					'data'=>UFSBaseUtil::printJson(array(
							'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Delete Success'),Yii::app()->params['notytype']['success']),
					))
			));

		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
		$model=new Knowledgecatalogue('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Knowledgecatalogue']))
			$model->attributes=$_GET['Knowledgecatalogue'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
     * Grid of all models.
     */
    public function actionIndex()
    {
    	$model=new Knowledgecatalogue();
		$itemCommon=new ItemCommonController();// 获得知识库分类
		$dataNode = $itemCommon->GetKnowledgeCatalogue('admin');
        $this->render('index',array(
            'dataNode'=>$dataNode,'model'=>$model,'fStatus'=>knowledgeSettings::$CatalogueStatus,'fIsDownLoad'=>Yii::app()->params['IsDownLoad']
        ));
    }
    /**
     * 弹出框
     */
    public function actionPopgrid()
    {
    	$itemCommon=new ItemCommonController();
		$dataNode = $itemCommon->GetKnowledgeCatalogue();
    	$this->render('popgrid',array('dataNode'=>$dataNode,
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
						'fCatalogueNo'=>Knowledgecatalogue::model()->getAttributeLabel('fCatalogueNo'),
		'fCatalogueName'=>Knowledgecatalogue::model()->getAttributeLabel('fCatalogueName'),
		'fFatherCatalogueNo'=>Knowledgecatalogue::model()->getAttributeLabel('fFatherCatalogueNo'),
		'fStatus'=>Knowledgecatalogue::model()->getAttributeLabel('fStatus'),
		'fCreateUser'=>Knowledgecatalogue::model()->getAttributeLabel('fCreateUser'),
		'fCreateDate'=>Knowledgecatalogue::model()->getAttributeLabel('fCreateDate'),
		/*
		'fUpdateUser'=>Knowledgecatalogue::model()->getAttributeLabel('fUpdateUser'),
		'fUpdateDate'=>Knowledgecatalogue::model()->getAttributeLabel('fUpdateDate'),
		'fUserGroup'=>Knowledgecatalogue::model()->getAttributeLabel('fUserGroup'),
		'fMemo1'=>Knowledgecatalogue::model()->getAttributeLabel('fMemo1'),
		'fMemo2'=>Knowledgecatalogue::model()->getAttributeLabel('fMemo2'),
		*/'fMemo2'=>array('asc'=>'fMemo2','desc'=>'fMemo2 desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fMemo2')),
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
        
		$pages=new CPagination(Knowledgecatalogue::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Knowledgecatalogue');
		
        $sort->attributes=array(
           		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fCatalogueNo')),
		'fCatalogueName'=>array('asc'=>'fCatalogueName','desc'=>'fCatalogueName desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fCatalogueName')),
		'fFatherCatalogueNo'=>array('asc'=>'fFatherCatalogueNo','desc'=>'fFatherCatalogueNo desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fFatherCatalogueNo')),
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fStatus')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fCreateDate')),
		/*
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fUpdateDate')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fUserGroup')),
		'fMemo1'=>array('asc'=>'fMemo1','desc'=>'fMemo1 desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fMemo1')),
		'fMemo2'=>array('asc'=>'fMemo2','desc'=>'fMemo2 desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fMemo2')),
		*/'fMemo2'=>array('asc'=>'fMemo2','desc'=>'fMemo2 desc','label'=>Knowledgecatalogue::model()->getAttributeLabel('fMemo2')),
        );
        $sort->defaultOrder='fCatalogueNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Knowledgecatalogue::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fCatalogueNo'=>$model->fCatalogueNo,
						'cell'=>array(CHtml::encode($model->fCatalogueNo).(Yii::app()->user->checkAccess('knowledge.knowledgecatalogue.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fCatalogueNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('knowledge.knowledgecatalogue.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fCatalogueNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'').(Yii::app()->user->checkAccess('knowledge.knowledgecatalogue.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fCatalogueNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Delete')
                )):''),		 CHtml::encode($model->fCatalogueName),
		 CHtml::encode($model->fFatherCatalogueNo),
		 CHtml::encode($model->fStatus),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode($model->fCreateDate),
		 CHtml::encode($model->fUpdateUser),
		 CHtml::encode($model->fUpdateDate),
		 CHtml::encode($model->fUserGroup),
		 CHtml::encode($model->fMemo1),
		 CHtml::encode($model->fMemo2),
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
		$model=Knowledgecatalogue::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='knowledgecatalogue-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
