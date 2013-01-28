<?php

class StockStructureController extends AppController
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

		$model=new StockStructure;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StockStructure']))
		{
			$model->attributes=$_POST['StockStructure'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fSSNo));
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

		if(isset($_POST['StockStructure']))
		{
			$model->attributes=$_POST['StockStructure'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fSSNo));
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

		if(isset($_POST['StockStructure']))
		{
			$createmodel=new StockStructure;
			$createmodel->attributes=$_POST['StockStructure'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fSSNo));
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
		$model=new StockStructure('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StockStructure']))
			$model->attributes=$_GET['StockStructure'];

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

        $pages=new CPagination(StockStructure::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('StockStructure');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fSSNo'=>array('asc'=>'fSSNo','desc'=>'fSSNo desc','label'=>StockStructure::model()->getAttributeLabel('fSSNo')),
		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>StockStructure::model()->getAttributeLabel('fItemNo')),
		'fHistoryNo'=>array('asc'=>'fHistoryNo','desc'=>'fHistoryNo desc','label'=>StockStructure::model()->getAttributeLabel('fHistoryNo')),
		'fShareholderName'=>array('asc'=>'fShareholderName','desc'=>'fShareholderName desc','label'=>StockStructure::model()->getAttributeLabel('fShareholderName')),
		'fShareholdingNum'=>array('asc'=>'fShareholdingNum','desc'=>'fShareholdingNum desc','label'=>StockStructure::model()->getAttributeLabel('fShareholdingNum')),
		'fShareholderRate'=>array('asc'=>'fShareholderRate','desc'=>'fShareholderRate desc','label'=>StockStructure::model()->getAttributeLabel('fShareholderRate')),
        );
        $sort->defaultOrder='fSSNo';
        $sort->applyOrder($criteria);

        // find all
        $models=StockStructure::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fSSNo)),
		 array('content'=>CHtml::encode($model->fItemNo)),
		 array('content'=>CHtml::encode($model->fHistoryNo)),
		 array('content'=>CHtml::encode($model->fShareholderName)),
		 array('content'=>CHtml::encode($model->fShareholdingNum)),
		 array('content'=>CHtml::encode($model->fShareholderRate)),
            );
        }	
		
		$model=new StockStructure;
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
						'fSSNo'=>StockStructure::model()->getAttributeLabel('fSSNo'),
		'fItemNo'=>StockStructure::model()->getAttributeLabel('fItemNo'),
		'fHistoryNo'=>StockStructure::model()->getAttributeLabel('fHistoryNo'),
		'fShareholderName'=>StockStructure::model()->getAttributeLabel('fShareholderName'),
		'fShareholdingNum'=>StockStructure::model()->getAttributeLabel('fShareholdingNum'),
		'fShareholderRate'=>StockStructure::model()->getAttributeLabel('fShareholderRate'),
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
        
		$pages=new CPagination(StockStructure::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('StockStructure');
		
        $sort->attributes=array(
           		'fSSNo'=>array('asc'=>'fSSNo','desc'=>'fSSNo desc','label'=>StockStructure::model()->getAttributeLabel('fSSNo')),
		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>StockStructure::model()->getAttributeLabel('fItemNo')),
		'fHistoryNo'=>array('asc'=>'fHistoryNo','desc'=>'fHistoryNo desc','label'=>StockStructure::model()->getAttributeLabel('fHistoryNo')),
		'fShareholderName'=>array('asc'=>'fShareholderName','desc'=>'fShareholderName desc','label'=>StockStructure::model()->getAttributeLabel('fShareholderName')),
		'fShareholdingNum'=>array('asc'=>'fShareholdingNum','desc'=>'fShareholdingNum desc','label'=>StockStructure::model()->getAttributeLabel('fShareholdingNum')),
		'fShareholderRate'=>array('asc'=>'fShareholderRate','desc'=>'fShareholderRate desc','label'=>StockStructure::model()->getAttributeLabel('fShareholderRate')),
        );
        $sort->defaultOrder='fSSNo';
        $sort->applyOrder($criteria);

        // find all
        $models=StockStructure::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fSSNo'=>$model->fSSNo,
						'cell'=>array(CHtml::encode($model->fSSNo).(Yii::app()->user->checkAccess('Item.stockStructure.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fSSNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('Item.stockStructure.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fSSNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('Item.stockStructure.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fSSNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fItemNo),
		 CHtml::encode($model->fHistoryNo),
		 CHtml::encode($model->fShareholderName),
		 CHtml::encode($model->fShareholdingNum),
		 CHtml::encode($model->fShareholderRate),
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
		$model=StockStructure::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='stock-structure-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
