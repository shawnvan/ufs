<?php

class ItemcatalogueCopyController extends AppController
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

		$model=new ItemcatalogueCopy;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemcatalogueCopy']))
		{
			$model->attributes=$_POST['ItemcatalogueCopy'];
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemcatalogueCopy']))
		{
			$model->attributes=$_POST['ItemcatalogueCopy'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fCatalogueNo));
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

		if(isset($_POST['ItemcatalogueCopy']))
		{
			$createmodel=new ItemcatalogueCopy;
			$createmodel->attributes=$_POST['ItemcatalogueCopy'];
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
		$model=new ItemcatalogueCopy('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ItemcatalogueCopy']))
			$model->attributes=$_GET['ItemcatalogueCopy'];

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

        $pages=new CPagination(ItemcatalogueCopy::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('ItemcatalogueCopy');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fCatalogueNo')),
		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fItemNo')),
		'fTemplateNo'=>array('asc'=>'fTemplateNo','desc'=>'fTemplateNo desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fTemplateNo')),
		'fIsActive'=>array('asc'=>'fIsActive','desc'=>'fIsActive desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fIsActive')),
		'fSort'=>array('asc'=>'fSort','desc'=>'fSort desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fSort')),
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fStatus')),
		/*
		'fWarnStart'=>array('asc'=>'fWarnStart','desc'=>'fWarnStart desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fWarnStart')),
		'fWarnEnd'=>array('asc'=>'fWarnEnd','desc'=>'fWarnEnd desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fWarnEnd')),
		'fFatherCatalogueNo'=>array('asc'=>'fFatherCatalogueNo','desc'=>'fFatherCatalogueNo desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fFatherCatalogueNo')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fUserGroup')),
		'fWaitFinishingNum'=>array('asc'=>'fWaitFinishingNum','desc'=>'fWaitFinishingNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fWaitFinishingNum')),
		'fFinishedNum'=>array('asc'=>'fFinishedNum','desc'=>'fFinishedNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fFinishedNum')),
		'fResultNum'=>array('asc'=>'fResultNum','desc'=>'fResultNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fResultNum')),
		'fDocumentNum'=>array('asc'=>'fDocumentNum','desc'=>'fDocumentNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fDocumentNum')),
		'fTaskNum'=>array('asc'=>'fTaskNum','desc'=>'fTaskNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fTaskNum')),
		'fKnowledgeNum'=>array('asc'=>'fKnowledgeNum','desc'=>'fKnowledgeNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fKnowledgeNum')),
		*/'fKnowledgeNum'=>array('asc'=>'fKnowledgeNum','desc'=>'fKnowledgeNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fKnowledgeNum')),
        );
        $sort->defaultOrder='fCatalogueNo';
        $sort->applyOrder($criteria);

        // find all
        $models=ItemcatalogueCopy::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fCatalogueNo)),
		 array('content'=>CHtml::encode($model->fItemNo)),
		 array('content'=>CHtml::encode($model->fTemplateNo)),
		 array('content'=>CHtml::encode($model->fIsActive)),
		 array('content'=>CHtml::encode($model->fSort)),
		 array('content'=>CHtml::encode($model->fStatus)),
		/*
		 array('content'=>CHtml::encode($model->fWarnStart)),
		 array('content'=>CHtml::encode($model->fWarnEnd)),
		 array('content'=>CHtml::encode($model->fFatherCatalogueNo)),
		 array('content'=>CHtml::encode($model->fUserGroup)),
		 array('content'=>CHtml::encode($model->fWaitFinishingNum)),
		 array('content'=>CHtml::encode($model->fFinishedNum)),
		 array('content'=>CHtml::encode($model->fResultNum)),
		 array('content'=>CHtml::encode($model->fDocumentNum)),
		 array('content'=>CHtml::encode($model->fTaskNum)),
		 array('content'=>CHtml::encode($model->fKnowledgeNum)),
		*/
            );
        }	
		
		$model=new ItemcatalogueCopy;
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
						'fCatalogueNo'=>ItemcatalogueCopy::model()->getAttributeLabel('fCatalogueNo'),
		'fItemNo'=>ItemcatalogueCopy::model()->getAttributeLabel('fItemNo'),
		'fTemplateNo'=>ItemcatalogueCopy::model()->getAttributeLabel('fTemplateNo'),
		'fIsActive'=>ItemcatalogueCopy::model()->getAttributeLabel('fIsActive'),
		'fSort'=>ItemcatalogueCopy::model()->getAttributeLabel('fSort'),
		'fStatus'=>ItemcatalogueCopy::model()->getAttributeLabel('fStatus'),
		/*
		'fWarnStart'=>ItemcatalogueCopy::model()->getAttributeLabel('fWarnStart'),
		'fWarnEnd'=>ItemcatalogueCopy::model()->getAttributeLabel('fWarnEnd'),
		'fFatherCatalogueNo'=>ItemcatalogueCopy::model()->getAttributeLabel('fFatherCatalogueNo'),
		'fUserGroup'=>ItemcatalogueCopy::model()->getAttributeLabel('fUserGroup'),
		'fWaitFinishingNum'=>ItemcatalogueCopy::model()->getAttributeLabel('fWaitFinishingNum'),
		'fFinishedNum'=>ItemcatalogueCopy::model()->getAttributeLabel('fFinishedNum'),
		'fResultNum'=>ItemcatalogueCopy::model()->getAttributeLabel('fResultNum'),
		'fDocumentNum'=>ItemcatalogueCopy::model()->getAttributeLabel('fDocumentNum'),
		'fTaskNum'=>ItemcatalogueCopy::model()->getAttributeLabel('fTaskNum'),
		'fKnowledgeNum'=>ItemcatalogueCopy::model()->getAttributeLabel('fKnowledgeNum'),
		*/'fKnowledgeNum'=>array('asc'=>'fKnowledgeNum','desc'=>'fKnowledgeNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fKnowledgeNum')),
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
        
		$pages=new CPagination(ItemcatalogueCopy::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('ItemcatalogueCopy');
		
        $sort->attributes=array(
           		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fCatalogueNo')),
		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fItemNo')),
		'fTemplateNo'=>array('asc'=>'fTemplateNo','desc'=>'fTemplateNo desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fTemplateNo')),
		'fIsActive'=>array('asc'=>'fIsActive','desc'=>'fIsActive desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fIsActive')),
		'fSort'=>array('asc'=>'fSort','desc'=>'fSort desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fSort')),
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fStatus')),
		/*
		'fWarnStart'=>array('asc'=>'fWarnStart','desc'=>'fWarnStart desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fWarnStart')),
		'fWarnEnd'=>array('asc'=>'fWarnEnd','desc'=>'fWarnEnd desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fWarnEnd')),
		'fFatherCatalogueNo'=>array('asc'=>'fFatherCatalogueNo','desc'=>'fFatherCatalogueNo desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fFatherCatalogueNo')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fUserGroup')),
		'fWaitFinishingNum'=>array('asc'=>'fWaitFinishingNum','desc'=>'fWaitFinishingNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fWaitFinishingNum')),
		'fFinishedNum'=>array('asc'=>'fFinishedNum','desc'=>'fFinishedNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fFinishedNum')),
		'fResultNum'=>array('asc'=>'fResultNum','desc'=>'fResultNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fResultNum')),
		'fDocumentNum'=>array('asc'=>'fDocumentNum','desc'=>'fDocumentNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fDocumentNum')),
		'fTaskNum'=>array('asc'=>'fTaskNum','desc'=>'fTaskNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fTaskNum')),
		'fKnowledgeNum'=>array('asc'=>'fKnowledgeNum','desc'=>'fKnowledgeNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fKnowledgeNum')),
		*/'fKnowledgeNum'=>array('asc'=>'fKnowledgeNum','desc'=>'fKnowledgeNum desc','label'=>ItemcatalogueCopy::model()->getAttributeLabel('fKnowledgeNum')),
        );
        $sort->defaultOrder='fCatalogueNo';
        $sort->applyOrder($criteria);

        // find all
        $models=ItemcatalogueCopy::model()->findAll($criteria);
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
						'cell'=>array(CHtml::encode($model->fCatalogueNo).(Yii::app()->user->checkAccess('Item.itemcatalogueCopy.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fCatalogueNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('Item.itemcatalogueCopy.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fCatalogueNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('Item.itemcatalogueCopy.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fCatalogueNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fItemNo),
		 CHtml::encode($model->fTemplateNo),
		 CHtml::encode($model->fIsActive),
		 CHtml::encode($model->fSort),
		 CHtml::encode($model->fStatus),
		 CHtml::encode($model->fWarnStart),
		 CHtml::encode($model->fWarnEnd),
		 CHtml::encode($model->fFatherCatalogueNo),
		 CHtml::encode($model->fUserGroup),
		 CHtml::encode($model->fWaitFinishingNum),
		 CHtml::encode($model->fFinishedNum),
		 CHtml::encode($model->fResultNum),
		 CHtml::encode($model->fDocumentNum),
		 CHtml::encode($model->fTaskNum),
		 CHtml::encode($model->fKnowledgeNum),
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
		$model=ItemcatalogueCopy::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='itemcatalogue-copy-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
