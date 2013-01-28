<?php

class ItemplanController extends AppController
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

		$model=new Itemplan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Itemplan']))
		{
			$model->attributes=$_POST['Itemplan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fItemNo));
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

		if(isset($_POST['Itemplan']))
		{
			$model->attributes=$_POST['Itemplan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fItemNo));
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

		if(isset($_POST['Itemplan']))
		{
			$createmodel=new Itemplan;
			$createmodel->attributes=$_POST['Itemplan'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fItemNo));
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
		$model=new Itemplan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Itemplan']))
			$model->attributes=$_GET['Itemplan'];

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

        $pages=new CPagination(Itemplan::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Itemplan');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Itemplan::model()->getAttributeLabel('fItemNo')),
		'fItemTimeNode'=>array('asc'=>'fItemTimeNode','desc'=>'fItemTimeNode desc','label'=>Itemplan::model()->getAttributeLabel('fItemTimeNode')),
		'fItemStart'=>array('asc'=>'fItemStart','desc'=>'fItemStart desc','label'=>Itemplan::model()->getAttributeLabel('fItemStart')),
		'fItemEnd'=>array('asc'=>'fItemEnd','desc'=>'fItemEnd desc','label'=>Itemplan::model()->getAttributeLabel('fItemEnd')),
		'fItemPerson'=>array('asc'=>'fItemPerson','desc'=>'fItemPerson desc','label'=>Itemplan::model()->getAttributeLabel('fItemPerson')),
		'fItemFee'=>array('asc'=>'fItemFee','desc'=>'fItemFee desc','label'=>Itemplan::model()->getAttributeLabel('fItemFee')),
		/*
		'fItemOtherPerson'=>array('asc'=>'fItemOtherPerson','desc'=>'fItemOtherPerson desc','label'=>Itemplan::model()->getAttributeLabel('fItemOtherPerson')),
		*/'fItemOtherPerson'=>array('asc'=>'fItemOtherPerson','desc'=>'fItemOtherPerson desc','label'=>Itemplan::model()->getAttributeLabel('fItemOtherPerson')),
        );
        $sort->defaultOrder='fItemNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Itemplan::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fItemNo)),
		 array('content'=>CHtml::encode($model->fItemTimeNode)),
		 array('content'=>CHtml::encode($model->fItemStart)),
		 array('content'=>CHtml::encode($model->fItemEnd)),
		 array('content'=>CHtml::encode($model->fItemPerson)),
		 array('content'=>CHtml::encode($model->fItemFee)),
		/*
		 array('content'=>CHtml::encode($model->fItemOtherPerson)),
		*/
            );
        }	
		
		$model=new Itemplan;
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
						'fItemNo'=>Itemplan::model()->getAttributeLabel('fItemNo'),
		'fItemTimeNode'=>Itemplan::model()->getAttributeLabel('fItemTimeNode'),
		'fItemStart'=>Itemplan::model()->getAttributeLabel('fItemStart'),
		'fItemEnd'=>Itemplan::model()->getAttributeLabel('fItemEnd'),
		'fItemPerson'=>Itemplan::model()->getAttributeLabel('fItemPerson'),
		'fItemFee'=>Itemplan::model()->getAttributeLabel('fItemFee'),
		/*
		'fItemOtherPerson'=>Itemplan::model()->getAttributeLabel('fItemOtherPerson'),
		*/'fItemOtherPerson'=>array('asc'=>'fItemOtherPerson','desc'=>'fItemOtherPerson desc','label'=>Itemplan::model()->getAttributeLabel('fItemOtherPerson')),
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
        
		$pages=new CPagination(Itemplan::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Itemplan');
		
        $sort->attributes=array(
           		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Itemplan::model()->getAttributeLabel('fItemNo')),
		'fItemTimeNode'=>array('asc'=>'fItemTimeNode','desc'=>'fItemTimeNode desc','label'=>Itemplan::model()->getAttributeLabel('fItemTimeNode')),
		'fItemStart'=>array('asc'=>'fItemStart','desc'=>'fItemStart desc','label'=>Itemplan::model()->getAttributeLabel('fItemStart')),
		'fItemEnd'=>array('asc'=>'fItemEnd','desc'=>'fItemEnd desc','label'=>Itemplan::model()->getAttributeLabel('fItemEnd')),
		'fItemPerson'=>array('asc'=>'fItemPerson','desc'=>'fItemPerson desc','label'=>Itemplan::model()->getAttributeLabel('fItemPerson')),
		'fItemFee'=>array('asc'=>'fItemFee','desc'=>'fItemFee desc','label'=>Itemplan::model()->getAttributeLabel('fItemFee')),
		/*
		'fItemOtherPerson'=>array('asc'=>'fItemOtherPerson','desc'=>'fItemOtherPerson desc','label'=>Itemplan::model()->getAttributeLabel('fItemOtherPerson')),
		*/'fItemOtherPerson'=>array('asc'=>'fItemOtherPerson','desc'=>'fItemOtherPerson desc','label'=>Itemplan::model()->getAttributeLabel('fItemOtherPerson')),
        );
        $sort->defaultOrder='fItemNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Itemplan::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fItemNo'=>$model->fItemNo,
						'cell'=>array(CHtml::encode($model->fItemNo).(Yii::app()->user->checkAccess('Item.itemplan.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fItemNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('Item.itemplan.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fItemNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('Item.itemplan.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fItemNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fItemTimeNode),
		 CHtml::encode($model->fItemStart),
		 CHtml::encode($model->fItemEnd),
		 CHtml::encode($model->fItemPerson),
		 CHtml::encode($model->fItemFee),
		 CHtml::encode($model->fItemOtherPerson),
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
		$model=Itemplan::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='itemplan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
