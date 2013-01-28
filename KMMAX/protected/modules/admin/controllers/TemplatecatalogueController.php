<?php

class TemplatecatalogueController extends AppController
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

		$model=new Templatecatalogue;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Templatecatalogue']))
		{
			$model->attributes=$_POST['Templatecatalogue'];
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

		if(isset($_POST['Templatecatalogue']))
		{
			$model->attributes=$_POST['Templatecatalogue'];
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

		if(isset($_POST['Templatecatalogue']))
		{
			$createmodel=new Templatecatalogue;
			$createmodel->attributes=$_POST['Templatecatalogue'];
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
		$model=new Templatecatalogue('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Templatecatalogue']))
			$model->attributes=$_GET['Templatecatalogue'];

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

        $pages=new CPagination(Templatecatalogue::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Templatecatalogue');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Templatecatalogue::model()->getAttributeLabel('fCatalogueNo')),
		'fTemplateNo'=>array('asc'=>'fTemplateNo','desc'=>'fTemplateNo desc','label'=>Templatecatalogue::model()->getAttributeLabel('fTemplateNo')),
		'fCatalogueName'=>array('asc'=>'fCatalogueName','desc'=>'fCatalogueName desc','label'=>Templatecatalogue::model()->getAttributeLabel('fCatalogueName')),
		'fWarnStart'=>array('asc'=>'fWarnStart','desc'=>'fWarnStart desc','label'=>Templatecatalogue::model()->getAttributeLabel('fWarnStart')),
		'fWarnEnd'=>array('asc'=>'fWarnEnd','desc'=>'fWarnEnd desc','label'=>Templatecatalogue::model()->getAttributeLabel('fWarnEnd')),
		'fWarnRate'=>array('asc'=>'fWarnRate','desc'=>'fWarnRate desc','label'=>Templatecatalogue::model()->getAttributeLabel('fWarnRate')),
		/*
		'fIsActive'=>array('asc'=>'fIsActive','desc'=>'fIsActive desc','label'=>Templatecatalogue::model()->getAttributeLabel('fIsActive')),
		'fSort'=>array('asc'=>'fSort','desc'=>'fSort desc','label'=>Templatecatalogue::model()->getAttributeLabel('fSort')),
		'fFatherCatalogueNo'=>array('asc'=>'fFatherCatalogueNo','desc'=>'fFatherCatalogueNo desc','label'=>Templatecatalogue::model()->getAttributeLabel('fFatherCatalogueNo')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Templatecatalogue::model()->getAttributeLabel('fUserGroup')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Templatecatalogue::model()->getAttributeLabel('fCreateDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Templatecatalogue::model()->getAttributeLabel('fCreateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Templatecatalogue::model()->getAttributeLabel('fUpdateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Templatecatalogue::model()->getAttributeLabel('fUpdateUser')),
		*/'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Templatecatalogue::model()->getAttributeLabel('fUpdateUser')),
        );
        $sort->defaultOrder='fCatalogueNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Templatecatalogue::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fCatalogueNo)),
		 array('content'=>CHtml::encode($model->fTemplateNo)),
		 array('content'=>CHtml::encode($model->fCatalogueName)),
		 array('content'=>CHtml::encode($model->fWarnStart)),
		 array('content'=>CHtml::encode($model->fWarnEnd)),
		 array('content'=>CHtml::encode($model->fWarnRate)),
		/*
		 array('content'=>CHtml::encode($model->fIsActive)),
		 array('content'=>CHtml::encode($model->fSort)),
		 array('content'=>CHtml::encode($model->fFatherCatalogueNo)),
		 array('content'=>CHtml::encode($model->fUserGroup)),
		 array('content'=>CHtml::encode($model->fCreateDate)),
		 array('content'=>CHtml::encode($model->fCreateUser)),
		 array('content'=>CHtml::encode($model->fUpdateDate)),
		 array('content'=>CHtml::encode($model->fUpdateUser)),
		*/
            );
        }	
		
		$model=new Templatecatalogue;
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
        
		$pages=new CPagination(Templatecatalogue::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Templatecatalogue');
		
        $sort->attributes=array(
           		'fCatalogueNo'=>array('asc'=>'fCatalogueNo','desc'=>'fCatalogueNo desc','label'=>Templatecatalogue::model()->getAttributeLabel('fCatalogueNo')),
		'fTemplateNo'=>array('asc'=>'fTemplateNo','desc'=>'fTemplateNo desc','label'=>Templatecatalogue::model()->getAttributeLabel('fTemplateNo')),
		'fCatalogueName'=>array('asc'=>'fCatalogueName','desc'=>'fCatalogueName desc','label'=>Templatecatalogue::model()->getAttributeLabel('fCatalogueName')),
		'fWarnStart'=>array('asc'=>'fWarnStart','desc'=>'fWarnStart desc','label'=>Templatecatalogue::model()->getAttributeLabel('fWarnStart')),
		'fWarnEnd'=>array('asc'=>'fWarnEnd','desc'=>'fWarnEnd desc','label'=>Templatecatalogue::model()->getAttributeLabel('fWarnEnd')),
		'fWarnRate'=>array('asc'=>'fWarnRate','desc'=>'fWarnRate desc','label'=>Templatecatalogue::model()->getAttributeLabel('fWarnRate')),
		/*
		'fIsActive'=>array('asc'=>'fIsActive','desc'=>'fIsActive desc','label'=>Templatecatalogue::model()->getAttributeLabel('fIsActive')),
		'fSort'=>array('asc'=>'fSort','desc'=>'fSort desc','label'=>Templatecatalogue::model()->getAttributeLabel('fSort')),
		'fFatherCatalogueNo'=>array('asc'=>'fFatherCatalogueNo','desc'=>'fFatherCatalogueNo desc','label'=>Templatecatalogue::model()->getAttributeLabel('fFatherCatalogueNo')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Templatecatalogue::model()->getAttributeLabel('fUserGroup')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Templatecatalogue::model()->getAttributeLabel('fCreateDate')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Templatecatalogue::model()->getAttributeLabel('fCreateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Templatecatalogue::model()->getAttributeLabel('fUpdateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Templatecatalogue::model()->getAttributeLabel('fUpdateUser')),
		*/'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Templatecatalogue::model()->getAttributeLabel('fUpdateUser')),
        );
        $sort->defaultOrder='fCatalogueNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Templatecatalogue::model()->findAll($criteria);
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
						'cell'=>array(CHtml::encode($model->fCatalogueNo).(Yii::app()->user->checkAccess('admin.templatecatalogueCopy.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fCatalogueNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('admin.templatecatalogueCopy.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fCatalogueNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('admin.templatecatalogueCopy.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fCatalogueNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fTemplateNo),
		 CHtml::encode($model->fCatalogueName),
		 CHtml::encode($model->fWarnStart),
		 CHtml::encode($model->fWarnEnd),
		 CHtml::encode($model->fWarnRate),
		 CHtml::encode($model->fIsActive),
		 CHtml::encode($model->fSort),
		 CHtml::encode($model->fFatherCatalogueNo),
		 CHtml::encode($model->fUserGroup),
		 CHtml::encode($model->fCreateDate),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode($model->fUpdateDate),
		 CHtml::encode($model->fUpdateUser),
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
		$model=Templatecatalogue::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='templatecatalogue-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * 获得节点属性
	 */
	public function actionSelect()
	{
		$fCatalogueNo=$_GET['cNo'];
		$fTemplateNo=$_GET['tNo'];
		if($fCatalogueNo=='999') $fTemplateNo='';
		$model=Templatecatalogue::model()->with('fathercatalogue')->findByAttributes(array ('fCatalogueNo' => $fCatalogueNo,'fTemplateNo' => $fTemplateNo));
		$this->renderPartial('update',array(
				'data'=>UFSBaseUtil::printJson(array(
						'fCatalogueNo'=>CHtml::encode($model->fCatalogueNo),
						'fCatalogueName'=>CHtml::encode($model->fCatalogueName),
						'fTemplateNo'=>CHtml::encode($model->fTemplateNo),
						'fIsActive'=>CHtml::encode($model->fIsActive),
						'fWarnRate'=>CHtml::encode($model->fWarnRate),
						'fathername'=>CHtml::encode(empty($model->fathercatalogue->fCatalogueName)?'':$model->fathercatalogue->fCatalogueName),
				))
		));
	}
	
	/**
	 * 删除节点
	 */
	public function actionDeletetree(){
		//存数值
		if(isset($_POST['cno']) && isset($_POST['tno'])){
			$fCatalogueNo=$_POST['cno'];
			$fTemplateNo=$_POST['tno'];
			$this->deleteCatalogue($fTemplateNo,$fCatalogueNo);
			$template=Templatecatalogue::model()->findByAttributes(array('fTemplateNo'=>$fTemplateNo,'fCatalogueNo'=>$fCatalogueNo));
			$template->delete();
			$dataNode = array();
	        Templetstandardtask::model()->deleteAllByAttributes(array('fTemplateNo'=>$fTemplateNo,'fCatalogueNo'=>$fCatalogueNo));
			$models=Templatecatalogue::model()->findAll('fTemplateNo=:fTemplateNo or fTemplateNo=\'\'',array(':fTemplateNo'=>$fTemplateNo));
			foreach ($models as $key=>$model){
				$dataNode[]=array(
						'id'=>CHtml::encode($model->fCatalogueNo),
						'name'=>CHtml::encode($model->fCatalogueName),
						'pId'=>CHtml::encode($model->fFatherCatalogueNo)
				);
			};
			UFSBaseUtil::printJson($dataNode);
		}
	}
	
	/**
	 * 迭代删除子节点
	 */
	public function deleteCatalogue($templateNo,$catalogueNo){
		$templates=Templatecatalogue::model()->findAllByAttributes(array('fTemplateNo'=>$templateNo,'fFatherCatalogueNo'=>$catalogueNo));
		foreach ($templates as $template){
			$this->deleteCatalogue($template->fTemplateNo,$template->fCatalogueNo);
			$template->delete();
			Templetstandardtask::model()->deleteAllByAttributes(array('fTemplateNo'=>$templateNo,'fFatherCatalogueNo'=>$catalogueNo));
		}
	}
	
	/**
	 * 新增节点
	 */
	public function actionInsert(){
		if(isset($_POST['tno']) || isset($_POST['cno'])){
			$tempcatalogue=new Templatecatalogue();
			$tempcatalogue->fCatalogueNo=GuidUtil::getUuid();
			$tempcatalogue->fTemplateNo=$_POST['tno'];
			$tempcatalogue->fCatalogueName=$_POST['name'];
			$tempcatalogue->fWarnRate=$_POST['WarnRate'];
			$tempcatalogue->fIsActive=$_POST['status'];
			$tempcatalogue->fSort=0;
			$tempcatalogue->fFatherCatalogueNo=$_POST['cno'];
			$tempcatalogue->fCreateDate=time();
			$tempcatalogue->fCreateUser=Yii::app()->params->loginuser->fUserName;
			$tempcatalogue->fUpdateDate=time();
			$tempcatalogue->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$tempcatalogue->save();
			$this->renderPartial('update',array(
					'data'=>UFSBaseUtil::printJson(array(
							'fCatalogueNo'=>CHtml::encode($tempcatalogue->fCatalogueNo),
							'fCatalogueName'=>CHtml::encode($_POST['name']),
							'fFatherNo'=>CHtml::encode($_POST['cno']),
					))
			));
		}
	}
	
	/**
	 * 新增节点
	 */
	public function actionUpdatenode(){
		if(isset($_POST['tno']) || isset($_POST['cno'])){
			$tempcatalogue=Templatecatalogue::model()->findByAttributes(array('fCatalogueNo'=>$_POST['cno'],'fTemplateNo'=>$_POST['tno']));
			if(empty($tempcatalogue)) return;
			$tempcatalogue->fCatalogueName=$_POST['name'];
			$tempcatalogue->fWarnRate=$_POST['WarnRate'];
			$tempcatalogue->fIsActive=$_POST['status'];
			$tempcatalogue->fUpdateDate=time();
			$tempcatalogue->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$tempcatalogue->save();
			$this->renderPartial('update',array(
					'data'=>UFSBaseUtil::printJson(array(
							'fCatalogueNo'=>CHtml::encode($_POST['name']),
							'fCatalogueName'=>CHtml::encode($_POST['cno']),
							'fFatherNo'=>CHtml::encode($tempcatalogue->fFatherCatalogueNo),
					))
			));
		}
	}
}