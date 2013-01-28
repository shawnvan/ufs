<?php

class TempletstandardtaskController extends AppController
{
	/**
	 * 同步项目尽职调查表
	 * $catalogueno:分类编号
	 * $itemno: 分类编号
	 * $method: add,delete
	 */
	public function CatalogueSynchronization($catalogueno,$templetNo,$method){
		$templatecatalogue=Templatecatalogue::model()->findByAttributes(array('fCatalogueNo'=>$catalogueno,'fTemplateNo'=>$templetNo));
		if($templatecatalogue!=null){
			if($templatecatalogue->fCatalogueNo!='999') $this->CatalogueSynchronization($templatecatalogue->fFatherCatalogueNo,$templetNo,$method);
			if($method=='add')
				$templatecatalogue->fStandardtaskNum=$templatecatalogue->fStandardtaskNum+1;
			else
				$templatecatalogue->fStandardtaskNum=$templatecatalogue->fStandardtaskNum-1;
			$templatecatalogue->save();
		}
	}
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

		$model=new Templetstandardtask;
		if(isset($_POST['Templetstandardtask']))
		{
			$model->attributes=$_POST['Templetstandardtask'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fTaskNo));
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

		if(isset($_POST['Templetstandardtask']))
		{
			$model->attributes=$_POST['Templetstandardtask'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fTaskNo));
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

		if(isset($_POST['Templetstandardtask']))
		{
			$createmodel=new Templetstandardtask;
			$createmodel->attributes=$_POST['Templetstandardtask'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fTaskNo));
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
		$model=new Templetstandardtask('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Templetstandardtask']))
			$model->attributes=$_GET['Templetstandardtask'];

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

        $pages=new CPagination(Templetstandardtask::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Templetstandardtask');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fTemplateNo'=>array('asc'=>'fTemplateNo','desc'=>'fTemplateNo desc','label'=>Templetstandardtask::model()->getAttributeLabel('fTemplateNo')),
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Templetstandardtask::model()->getAttributeLabel('fCatalogueNo')),
		'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Templetstandardtask::model()->getAttributeLabel('fTaskNo')),
        );
        $sort->defaultOrder='fTaskNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Templetstandardtask::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fTemplateNo)),
		 array('content'=>CHtml::encode($model->fCatalogueNo)),
		 array('content'=>CHtml::encode($model->fTaskNo)),
            );
        }	
		
		$model=new Templetstandardtask;
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
						'fTemplateNo'=>Templetstandardtask::model()->getAttributeLabel('fTemplateNo'),
		'fCatalogueNo'=>Templetstandardtask::model()->getAttributeLabel('fCatalogueNo'),
		'fTaskNo'=>Templetstandardtask::model()->getAttributeLabel('fTaskNo'),
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
        
		$pages=new CPagination(Templetstandardtask::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Templetstandardtask');
		
        $sort->attributes=array(
           		'fTemplateNo'=>array('asc'=>'fTemplateNo','desc'=>'fTemplateNo desc','label'=>Templetstandardtask::model()->getAttributeLabel('fTemplateNo')),
		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Templetstandardtask::model()->getAttributeLabel('fCatalogueNo')),
		'fTaskNo'=>array('asc'=>'fTaskNo','desc'=>'fTaskNo desc','label'=>Templetstandardtask::model()->getAttributeLabel('fTaskNo')),
        );
        $sort->defaultOrder='fTaskNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Templetstandardtask::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 CHtml::encode($model->fTemplateNo),
		 CHtml::encode($model->fCatalogueNo),
		 'fTaskNo'=>$model->fTaskNo,
						'cell'=>array(CHtml::encode($model->fTaskNo).(Yii::app()->user->checkAccess('admin.templetstandardtask.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('admin.templetstandardtask.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('admin.templetstandardtask.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fTaskNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),            ));
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
		$model=Templetstandardtask::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='templetstandardtask-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * 获得对应模块的标准任务
	 */
	public function actionTaskData(){
		$jqGrid=$this->processJqGridRequest();
		$criteria=new CDbCriteria;
		if(isset($_GET['cNo']) && (!empty($_GET['cNo']))){
			$criteria->addCondition("t.fCatalogueNo = :fCatalogueNo");
			$criteria->params[':fCatalogueNo']=$_GET['cNo'];
		}
		if(isset($_GET['id'])){
			$criteria->addCondition("t.fTemplateNo = :fTemplateNo");
			$criteria->params[':fTemplateNo']=$_GET['id'];
		}
		$pages=new CPagination(Templetstandardtask::model()->count($criteria));
		$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
		$pages->applyLimit($criteria);
		$sort=new CSort('Templetstandardtask');
		$sort->attributes=array(
				'fTheme'=>array('asc'=>"fTheme",'desc'=>"fTheme desc",'label'=>Standardtask::model()->getAttributeLabel('fTheme')),
				'fCatalogueNo'=>array('asc'=>"fCatalogueNo",'desc'=>"fCatalogueNo desc",'label'=>Standardtask::model()->getAttributeLabel('fCatalogueNo')),
				'fAttachName'=>array('asc'=>"fAttachName",'desc'=>"fAttachName desc",'label'=>Standardtask::model()->getAttributeLabel('fAttachName')),
				'fSubmitUser'=>array('asc'=>"fSubmitUser",'desc'=>"fSubmitUser desc",'label'=>Standardtask::model()->getAttributeLabel('fSubmitUser')),
				'fSubmitDate'=>array('asc'=>"fSubmitDate",'desc'=>"fSubmitDate desc",'label'=>Standardtask::model()->getAttributeLabel('fSubmitDate')),
				'fConfirmUser'=>array('asc'=>"fConfirmUser",'desc'=>"fConfirmUser desc",'label'=>Standardtask::model()->getAttributeLabel('fConfirmUser')),
				'fConfirmDate'=>array('asc'=>"fConfirmDate",'desc'=>"fConfirmDate desc",'label'=>Standardtask::model()->getAttributeLabel('fConfirmDate')),
				'fTaskType'=>array('asc'=>"fTaskType",'desc'=>"fTaskType desc",'label'=>Standardtask::model()->getAttributeLabel('fTaskType')),
		);
		//$sort->defaultOrder="fTemplateNo";
		$sort->applyOrder($criteria);
		$models=Templetstandardtask::model()->with('task')->with('catalogue')->findAll($criteria);
		$data=array(
				'page'=>$pages->getCurrentPage()+1,
				'total'=>$pages->getPageCount(),
				'records'=>$pages->getItemCount(),
				'rows'=>array()
		);
		foreach($models as $model)
		{
			$data['rows'][]=array('fTaskNo'=>$model->fTaskNo,'cell'=>array(
					CHtml::encode($model->task->fTheme)
					 .(Yii::app()->user->checkAccess('admin.templetstandardtask.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fTaskNo),array(
                     'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right',
                     'title'=>Yii::t('label','Delete'),
					 'rel'=>$model->fTaskNo
                         )):''),
					CHtml::encode($model->catalogue->fCatalogueName),
					CHtml::encode($model->task->fAttachName),
					CHtml::encode($model->task->fSubmitUser),
					CHtml::encode(date('Y-m-d',$model->task->fSubmitDate)),
					CHtml::encode($model->task->fConfirmUser),
					CHtml::encode(empty($model->fConfirmDate)?'':date('Y-m-d',$model->task->fConfirmDate)),
					CHtml::encode(array_key_exists($model->task->fTaskType,ItemSettings::$TaskType)?ItemSettings::$TaskType[$model->task->fTaskType]:''),
			));
		}
		UFSBaseUtil::printJson($data);
	}
	
	/**
	 * 删除模板中的标准任务
	 */
	public function actionDeletetask(){
		$taskno='';
		$tempno='';
		if(isset($_GET['id'])){
			$tempno=$_GET['id'];
		}
		if(isset($_GET['tno'])){
			$taskno=$_GET['tno'];
		}
		try {
			$transaction = Yii::app()->db->beginTransaction();
			$task=Standardtask::model()->findByPk($taskno);
			Templetstandardtask::model()->deleteAllByAttributes(array('fTemplateNo'=>$tempno,'fTaskNo'=>$taskno));
			$this->CatalogueSynchronization($task->fCatalogueNo,$tempno,'delete');
		    $transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	
	/**
	 * 添加模板中的标准任务库
	 */
	public function actionInsertstandardtask(){
		$taskno='';
		$tempno='';
		$catalogueno='';
		if(isset($_POST['cno'])){
			$catalogueno=$_POST['cno'];
		}
		if(isset($_POST['id'])){
			$tempno=$_POST['id'];
		}
		if(isset($_POST['tno'])){
		try {
	    	$transaction = Yii::app()->db->beginTransaction();
			$taskno=explode(',',$_POST['tno']);
			for($i=0;$i<count($taskno);$i++)
			{
				$task=Standardtask::model()->findByPk($taskno);
				//检查模板分类是不是已经存在，如果不存在，就添加，如果存在，就不管
				$cata=Templatecatalogue::model()->findByAttributes(array('fCatalogueNo'=>$task->fCatalogueNo,'fTemplateNo'=>$tempno));
				if(empty($cata)){
					$this->InsertCatalogue($task->fCatalogueNo,$tempno);
				}
				$standardtask=new Templetstandardtask();
				$standardtask->fCatalogueNo=$task->fCatalogueNo;
				$standardtask->fTemplateNo=$tempno;
				$standardtask->fTaskNo=$taskno[$i];
				$standardtask->save();
				$this->CatalogueSynchronization($task->fCatalogueNo,$tempno,'add');
			}
		 $transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
		}
	}
	
	/**
	 * 检查模板中是否已经存在节点，如果不存在，就添加
	 */
	public function InsertCatalogue($catalogueno,$tempno){		
		if($catalogueno=='999') return;
		$knowCatalogue=Knowledgecatalogue::model()->findByAttributes(array('fCatalogueNo'=>$catalogueno));
		$tempCatalogue=Templatecatalogue::model()->findByAttributes(array('fCatalogueNo'=>$catalogueno,'fTemplateNo'=>$tempno));
		if(empty($tempCatalogue)){
			$temp='';
			$temp=empty($knowCatalogue->fFatherCatalogueNo)?'':$knowCatalogue->fFatherCatalogueNo;
		    $this->InsertCatalogue($temp,$tempno);
			$insert=new Templatecatalogue();
			$insert->fCatalogueNo=$knowCatalogue->fCatalogueNo;
			$insert->fCatalogueName=$knowCatalogue->fCatalogueName;
			$insert->fTemplateNo=$tempno;
			$insert->fFatherCatalogueNo=$knowCatalogue->fFatherCatalogueNo;
			$insert->fIsActive='IsActive';
			$insert->fCreateDate=time();
			$insert->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$insert->fUpdateDate=time();
			$insert->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$insert->save();
		}
	}
}
