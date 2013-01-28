<?php

class HistoryController extends AppController
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
		$model=new History;
		if(isset($_POST['History']))
		{
			$model->attributes=$_POST['History'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fHistoryNo));
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
		$model=History::model()->findByPk($id);
		if($model===null){
			$model=new History();
		}
		if(isset($_POST['History']))
		{
			$model->attributes=$_POST['History'];
			$transaction = Yii::app()->db->beginTransaction();
			try {
			$model->fHistoryNo=empty($model->fHistoryNo)?GuidUtil::getUuid():$model->fHistoryNo;
			$model->save();
			$item=Item::model()->findByPk($model->fItemNo);
			$item->fStatus=1;
			$item->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$item->fUpdateDate=time();
			$item->save();
			$transaction->commit();
			$this->redirect($this->createUrl('item/view/id/'.$model->fItemNo));
			//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
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

		if(isset($_POST['History']))
		{
			$createmodel=new History;
			$createmodel->attributes=$_POST['History'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fHistoryNo));
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
			$this->loadModel($id)->delete();
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
		$model=new History('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['History']))
			$model->attributes=$_GET['History'];

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

        $pages=new CPagination(History::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('History');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>History::model()->getAttributeLabel('fItemNo')),
		'fHistoryNo'=>array('asc'=>'fHistoryNo','desc'=>'fHistoryNo desc','label'=>History::model()->getAttributeLabel('fHistoryNo')),
		'fHistoryeVolution'=>array('asc'=>'fHistoryeVolution','desc'=>'fHistoryeVolution desc','label'=>History::model()->getAttributeLabel('fHistoryeVolution')),
		'fStockeVolution'=>array('asc'=>'fStockeVolution','desc'=>'fStockeVolution desc','label'=>History::model()->getAttributeLabel('fStockeVolution')),
		'fLatestGreatBusinessRecombination'=>array('asc'=>'fLatestGreatBusinessRecombination','desc'=>'fLatestGreatBusinessRecombination desc','label'=>History::model()->getAttributeLabel('fLatestGreatBusinessRecombination')),
		'fLatestCorrelationTrade'=>array('asc'=>'fLatestCorrelationTrade','desc'=>'fLatestCorrelationTrade desc','label'=>History::model()->getAttributeLabel('fLatestCorrelationTrade')),
		/*
		'fPublisherExplain'=>array('asc'=>'fPublisherExplain','desc'=>'fPublisherExplain desc','label'=>History::model()->getAttributeLabel('fPublisherExplain')),
		'fTeamAppraise'=>array('asc'=>'fTeamAppraise','desc'=>'fTeamAppraise desc','label'=>History::model()->getAttributeLabel('fTeamAppraise')),
		*/'fTeamAppraise'=>array('asc'=>'fTeamAppraise','desc'=>'fTeamAppraise desc','label'=>History::model()->getAttributeLabel('fTeamAppraise')),
        );
        $sort->defaultOrder='fHistoryNo';
        $sort->applyOrder($criteria);

        // find all
        $models=History::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fItemNo)),
		 array('content'=>CHtml::encode($model->fHistoryNo)),
		 array('content'=>CHtml::encode($model->fHistoryeVolution)),
		 array('content'=>CHtml::encode($model->fStockeVolution)),
		 array('content'=>CHtml::encode($model->fLatestGreatBusinessRecombination)),
		 array('content'=>CHtml::encode($model->fLatestCorrelationTrade)),
		/*
		 array('content'=>CHtml::encode($model->fPublisherExplain)),
		 array('content'=>CHtml::encode($model->fTeamAppraise)),
		*/
            );
        }	
		
		$model=new History;
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
						'fItemNo'=>History::model()->getAttributeLabel('fItemNo'),
		'fHistoryNo'=>History::model()->getAttributeLabel('fHistoryNo'),
		'fHistoryeVolution'=>History::model()->getAttributeLabel('fHistoryeVolution'),
		'fStockeVolution'=>History::model()->getAttributeLabel('fStockeVolution'),
		'fLatestGreatBusinessRecombination'=>History::model()->getAttributeLabel('fLatestGreatBusinessRecombination'),
		'fLatestCorrelationTrade'=>History::model()->getAttributeLabel('fLatestCorrelationTrade'),
		/*
		'fPublisherExplain'=>History::model()->getAttributeLabel('fPublisherExplain'),
		'fTeamAppraise'=>History::model()->getAttributeLabel('fTeamAppraise'),
		*/'fTeamAppraise'=>array('asc'=>'fTeamAppraise','desc'=>'fTeamAppraise desc','label'=>History::model()->getAttributeLabel('fTeamAppraise')),
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
        
		$pages=new CPagination(History::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('History');
		
        $sort->attributes=array(
           		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>History::model()->getAttributeLabel('fItemNo')),
		'fHistoryNo'=>array('asc'=>'fHistoryNo','desc'=>'fHistoryNo desc','label'=>History::model()->getAttributeLabel('fHistoryNo')),
		'fHistoryeVolution'=>array('asc'=>'fHistoryeVolution','desc'=>'fHistoryeVolution desc','label'=>History::model()->getAttributeLabel('fHistoryeVolution')),
		'fStockeVolution'=>array('asc'=>'fStockeVolution','desc'=>'fStockeVolution desc','label'=>History::model()->getAttributeLabel('fStockeVolution')),
		'fLatestGreatBusinessRecombination'=>array('asc'=>'fLatestGreatBusinessRecombination','desc'=>'fLatestGreatBusinessRecombination desc','label'=>History::model()->getAttributeLabel('fLatestGreatBusinessRecombination')),
		'fLatestCorrelationTrade'=>array('asc'=>'fLatestCorrelationTrade','desc'=>'fLatestCorrelationTrade desc','label'=>History::model()->getAttributeLabel('fLatestCorrelationTrade')),
		/*
		'fPublisherExplain'=>array('asc'=>'fPublisherExplain','desc'=>'fPublisherExplain desc','label'=>History::model()->getAttributeLabel('fPublisherExplain')),
		'fTeamAppraise'=>array('asc'=>'fTeamAppraise','desc'=>'fTeamAppraise desc','label'=>History::model()->getAttributeLabel('fTeamAppraise')),
		*/'fTeamAppraise'=>array('asc'=>'fTeamAppraise','desc'=>'fTeamAppraise desc','label'=>History::model()->getAttributeLabel('fTeamAppraise')),
        );
        $sort->defaultOrder='fHistoryNo';
        $sort->applyOrder($criteria);

        // find all
        $models=History::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 CHtml::encode($model->fItemNo),
		 'fHistoryNo'=>$model->fHistoryNo,
						'cell'=>array(CHtml::encode($model->fHistoryNo).(Yii::app()->user->checkAccess('Item.history.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fHistoryNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('Item.history.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fHistoryNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('Item.history.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fHistoryNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fHistoryeVolution),
		 CHtml::encode($model->fStockeVolution),
		 CHtml::encode($model->fLatestGreatBusinessRecombination),
		 CHtml::encode($model->fLatestCorrelationTrade),
		 CHtml::encode($model->fPublisherExplain),
		 CHtml::encode($model->fTeamAppraise),
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
		$model=History::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='history-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
