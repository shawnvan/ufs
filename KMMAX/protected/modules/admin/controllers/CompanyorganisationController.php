<?php

class CompanyorganisationController extends UserCommon
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

		$model=new Companyorganisation;
		if(isset($_POST['Companyorganisation']))
		{
			$model->attributes=$_POST['Companyorganisation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fOrgNo));
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
	public function actionUpdate()
	{
		$model=new Companyorganisation();
		$this->render('update',array(
				'model'=>$model,'dataNode'=>$this->GetOrg(),
		));
	}
	/**
	 * 查看
	 */
	public function actionAjaxview($id){
		$knowledge=Companyorganisation::model()->findByPk($id);
		$this->renderPartial('update',array(
				'data'=>UFSBaseUtil::printJson(array(
						'fCreateDate'=>CHtml::encode(empty($knowledge->fCreateDate)?'':date('Y-m-d',$knowledge->fCreateDate)),
						'fCreateUser'=>CHtml::encode($knowledge->fCreateUser),
						'fUpdateDate'=>CHtml::encode(empty($knowledge->fUpdateDate)?'':date('Y-m-d',$knowledge->fUpdateDate)),
						'fUpdateUser'=>CHtml::encode($knowledge->fUpdateUser),
				))
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionInsertnode()
	{
		$model=new Companyorganisation();
		$model->fOrgNo=GuidUtil::getUuid();
		$model->fOrgName=$_POST['name'];
		$model->fUpOrgNo=$_POST['id'];
		$model->fCreateUser=Yii::app()->params->loginuser->fUserName;
		$model->fCreateDate=time();
		$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
		$model->fUpdateDate=time();
		if($model->save())
		{
			$this->renderPartial('update',array(
					'data'=>UFSBaseUtil::printJson(array(
							'fOrgNo'=>CHtml::encode($model->fOrgNo),
							'fOrgName'=>CHtml::encode($model->fOrgName),
							'fUpOrgNo'=>CHtml::encode($model->fUpOrgNo),
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
	public function actionUpdatenode()
	{
		if(isset($_POST['name']) && isset($_POST['id']))
		{ $model=$this->loadModel($_POST['id']);
			$model->fOrgName=$_POST['name'];
			$model->fUpdateUser=Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate=time();
			if($model->save())
			{
				$this->renderPartial('update',array(
						'data'=>UFSBaseUtil::printJson(array(
								'fUpdateDate'=>CHtml::encode(empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate)),
								'fUpdateUser'=>CHtml::encode($model->fUpdateUser),
								'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Update Success'),Yii::app()->params['notytype']['success']),
						))
				));
			}
		}
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeletenode($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
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

		if(isset($_POST['Companyorganisation']))
		{
			$createmodel=new Companyorganisation;
			$createmodel->attributes=$_POST['Companyorganisation'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fOrgNo));
		}

		$this->render('copy',array(
			'model'=>$model,
		));
	}
	/**
	 * 弹出框
	 */
	public function actionPopgrid(){
		$orgchat='';
    	$companyorganisation=Companyorganisation::model()->findByPk('999');
    	$content='';
    	if(Companyorganisation::model()->countByAttributes(array('fUpOrgNo'=>'999'))>0){
    		$content=sprintf('<ul>%s</ul>',$this->GetSubCompanyOrg('999'));
    	}
    	$orgchat=sprintf('<li id=\'%s\'>%s %s</li>',$companyorganisation->fOrgNo,$companyorganisation->fOrgName,$content);
        $this->render('popgrid',array(
            'orgchat'=>$orgchat,
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
		$model=new Companyorganisation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Companyorganisation']))
			$model->attributes=$_GET['Companyorganisation'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
     * Grid of all models.
     */
    public function actionIndex()
    {
    	$orgchat='';
    	$companyorganisation=Companyorganisation::model()->findByPk('999');
    	$content='';
    	if(Companyorganisation::model()->countByAttributes(array('fUpOrgNo'=>'999'))>0){
    		$content=sprintf('<ul>%s</ul>',$this->GetSubCompanyOrg('999'));
    	}
    	$orgchat=sprintf('<li id=\'%s\'>%s %s</li>',$companyorganisation->fOrgNo,$companyorganisation->fOrgName,$content);
        $this->render('index',array(
            'orgchat'=>$orgchat,
        ));
    }
    /**
     * 获得所有的格式子类
     */
    public function GetSubCompanyOrg($orgno){
    	$contents='';
    	$models=Companyorganisation::model()->findAllByAttributes(array('fUpOrgNo'=>$orgno));
    	foreach ($models as $model){
    		$subcontents='';
    		if(Companyorganisation::model()->countByAttributes(array('fUpOrgNo'=>$model->fOrgNo))>0){
    			$subcontents=sprintf('<ul>%s</ul>',$this->GetSubCompanyOrg($model->fOrgNo));
    		}
    		$contents=$contents.sprintf('<li id=\'%s\'>%s</li>',$model->fOrgNo,$model->fOrgName.$subcontents);
    	}
    	return $contents;
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
        
		$pages=new CPagination(Companyorganisation::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Companyorganisation');
		
        $sort->attributes=array(
           		'fOrgNo'=>array('asc'=>'fOrgNo','desc'=>'fOrgNo desc','label'=>Companyorganisation::model()->getAttributeLabel('fOrgNo')),
		'fOrgName'=>array('asc'=>'fOrgName','desc'=>'fOrgName desc','label'=>Companyorganisation::model()->getAttributeLabel('fOrgName')),
		'fUpOrgNo'=>array('asc'=>'fUpOrgNo','desc'=>'fUpOrgNo desc','label'=>Companyorganisation::model()->getAttributeLabel('fUpOrgNo')),
        );
        $sort->defaultOrder='fOrgNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Companyorganisation::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fOrgNo'=>$model->fOrgNo,
						'cell'=>array(CHtml::encode($model->fOrgNo).(Yii::app()->user->checkAccess('admin.companyorganisation.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fOrgNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('admin.companyorganisation.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fOrgNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('admin.companyorganisation.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fOrgNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fOrgName),
		 CHtml::encode($model->fUpOrgNo),
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
		$model=Companyorganisation::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='companyorganisation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
