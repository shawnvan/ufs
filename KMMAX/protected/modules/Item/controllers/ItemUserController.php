<?php

class ItemuserController extends AppController
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
		$model=new Itemuser;
		if(isset($_POST['Itemuser']))
		{
			$model->attributes=$_POST['Itemuser'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fEmployeeNo));
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
		if(isset($_POST['Itemuser']))
		{
			$model->attributes=$_POST['Itemuser'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fEmployeeNo));
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

		if(isset($_POST['Itemuser']))
		{
			$createmodel=new Itemuser;
			$createmodel->attributes=$_POST['Itemuser'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fEmployeeNo));
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
		$model=new Itemuser('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Itemuser']))
			$model->attributes=$_GET['Itemuser'];

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
		$keyid='';
		if(isset($_GET['id'])){ $keyid=$_GET['id'];
			$item=Item::model()->findByPk($keyid);
			if($item->fStatus==0){
				$this->redirect($this->createUrl('item/update/id/'.$item->fItemNo));
				return;
			}
		}
		$criteria->addCondition("fItemNo = :fItemNo");
		$criteria->params[':fItemNo']=$keyid;
        $pages=new CPagination(Itemuser::model()->count($criteria));//记录总数
        $pages->pageSize=Yii::app()->params['pagesize'];//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Itemuser');//排序，参考YII文档CSort
        $sort->attributes=array( 
		'fEmployeeName'=>array('asc'=>'fEmployeeName','desc'=>'fEmployeeName desc','label'=>Itemuser::model()->getAttributeLabel('fEmployeeName')),
		'fRoleNo'=>array('asc'=>'fRoleNo','desc'=>'fRoleNo desc','label'=>Itemuser::model()->getAttributeLabel('fRoleNo')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Itemuser::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Itemuser::model()->getAttributeLabel('fCreateDate')),
		'fUserType'=>array('asc'=>'fUserType','desc'=>'fUserType desc','label'=>Itemuser::model()->getAttributeLabel('fUserType')),
        );
        $sort->defaultOrder='fEmployeeNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Itemuser::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
		$model=new Itemuser;
		$model->unsetAttributes();  // clear any default values

        // render the view file
        $this->render('index',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,'keyid'=>$keyid,
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
        $keyid='';
        if(isset($_GET['id'])) $keyid=$_GET['id'];
        $criteria->addCondition("fItemNo = :fItemNo");
        $criteria->params[':fItemNo']=$keyid;
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
		'fEmployeeName'=>Itemuser::model()->getAttributeLabel('fEmployeeName'),
		'fRoleNo'=>Itemuser::model()->getAttributeLabel('fRoleNo'),
		'fCreateUser'=>Itemuser::model()->getAttributeLabel('fCreateUser'),
		'fCreateDate'=>Itemuser::model()->getAttributeLabel('fCreateDate'),
		'fUserGroup'=>Itemuser::model()->getAttributeLabel('fUserGroup'),
		'fUserType'=>Itemuser::model()->getAttributeLabel('fUserType'),
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
		$pages=new CPagination(Itemuser::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Itemuser');
		
        $sort->attributes=array(
           		
		
		'fEmployeeName'=>array('asc'=>'fEmployeeName','desc'=>'fEmployeeName desc','label'=>Itemuser::model()->getAttributeLabel('fEmployeeName')),
		'fRoleNo'=>array('asc'=>'fRoleNo','desc'=>'fRoleNo desc','label'=>Itemuser::model()->getAttributeLabel('fRoleNo')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Itemuser::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Itemuser::model()->getAttributeLabel('fCreateDate')),

		'fUserType'=>array('asc'=>'fUserType','desc'=>'fUserType desc','label'=>Itemuser::model()->getAttributeLabel('fUserType')),
		
        );
        $sort->defaultOrder='fUserType,fCreateDate desc';
        $sort->applyOrder($criteria);

        // find all
        $models=Itemuser::model()->findAll($criteria);
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
		 'fEmployeeNo'=>$model->fEmployeeNo,
						'cell'=>array(CHtml::encode($model->fEmployeeName).(Yii::app()->user->checkAccess('Item.itemuser.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fEmployeeNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right',
					'rel'=>$model->fItemNo.'-'.$model->fEmployeeName,
                    'title'=>Yii::t('label','Delete')
                )):''),		 
		 CHtml::encode($model->fRoleNo),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode(empty($model->fCreateDate)?'':date('y-m-d',$model->fCreateDate)),
		 CHtml::encode($model->fUserType==0?Yii::t('label','Users'):Yii::t('label','Cooperativepartners')),
            ));
        }
        UFSBaseUtil::printJson($data);
    }

    /**
     * Grid of all models.
     */
    public function actionPopgrid()
    {
    	$criteria=new CDbCriteria;
    	$keyid='';
    	if(isset($_GET['id'])) $keyid=$_GET['id'];
    	$criteria->addCondition("fItemNo = :fItemNo");
    	$criteria->params[':fItemNo']=$keyid;
    	$pages=new CPagination(Itemuser::model()->count($criteria));//记录总数
    	$pages->pageSize=Yii::app()->params['pagesize'];//设置每页的记录显示条数
    	$pages->applyLimit($criteria);
    
    	$sort=new CSort('Itemuser');//排序，参考YII文档CSort
    	$sort->attributes=array(
    			'fEmployeeName'=>array('asc'=>'fEmployeeName','desc'=>'fEmployeeName desc','label'=>Itemuser::model()->getAttributeLabel('fEmployeeName')),
    			'fRoleNo'=>array('asc'=>'fRoleNo','desc'=>'fRoleNo desc','label'=>Itemuser::model()->getAttributeLabel('fRoleNo')),
    			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Itemuser::model()->getAttributeLabel('fCreateUser')),
    			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Itemuser::model()->getAttributeLabel('fCreateDate')),
    			'fUserType'=>array('asc'=>'fUserType','desc'=>'fUserType desc','label'=>Itemuser::model()->getAttributeLabel('fUserType')),
    	);
    	$sort->defaultOrder='fEmployeeNo';
    	$sort->applyOrder($criteria);
    
    	// find all
    	$models=Itemuser::model()->findAll($criteria);
    
    	// rows for the static grid
    	$gridRows=array();
    	$model=new Itemuser;
    	$model->unsetAttributes();  // clear any default values
    
    	// render the view file
    	$this->render('popgrid',array(
    			'models'=>$models,
    			'pages'=>$pages,
    			'sort'=>$sort,
    			'gridRows'=>$gridRows,
    			'model'=>$model,'keyid'=>$keyid,
    	));
    }
    
    
    /**
     * Print out array of models for the jqGrid rows.
     */
    public function actionPopgridData()
    {
    	if(!Yii::app()->request->isPostRequest)
    	{
    		throw new CHttpException(400,Yii::t('http','Invalid request. Please do not repeat this request again.'));
    		exit;
    	}
    	// specify request details
    	$jqGrid=$this->processJqGridRequest();
    	$criteria=new CDbCriteria;
    	$keyid='';
    	if(isset($_GET['id'])) $keyid=$_GET['id'];
    	$criteria->addCondition("fItemNo = :fItemNo");
    	$criteria->params[':fItemNo']=$keyid;
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
    				'fEmployeeName'=>Itemuser::model()->getAttributeLabel('fEmployeeName'),
    				'fRoleNo'=>Itemuser::model()->getAttributeLabel('fRoleNo'),
    				'fCreateUser'=>Itemuser::model()->getAttributeLabel('fCreateUser'),
    				'fCreateDate'=>Itemuser::model()->getAttributeLabel('fCreateDate'),
    				'fUserGroup'=>Itemuser::model()->getAttributeLabel('fUserGroup'),
    				'fUserType'=>Itemuser::model()->getAttributeLabel('fUserType'),
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
    	$pages=new CPagination(Itemuser::model()->count($criteria));
    	$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
    	$pages->applyLimit($criteria);
    	// sort
    	$sort=new CSort('Itemuser');
    
    	$sort->attributes=array(
    			 
    
    			'fEmployeeName'=>array('asc'=>'fEmployeeName','desc'=>'fEmployeeName desc','label'=>Itemuser::model()->getAttributeLabel('fEmployeeName')),
    			'fRoleNo'=>array('asc'=>'fRoleNo','desc'=>'fRoleNo desc','label'=>Itemuser::model()->getAttributeLabel('fRoleNo')),
    			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Itemuser::model()->getAttributeLabel('fCreateUser')),
    			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Itemuser::model()->getAttributeLabel('fCreateDate')),
    
    			'fUserType'=>array('asc'=>'fUserType','desc'=>'fUserType desc','label'=>Itemuser::model()->getAttributeLabel('fUserType')),
    
    	);
    	$sort->defaultOrder='fUserType,fCreateDate desc';
    	$sort->applyOrder($criteria);
    
    	// find all
    	$models=Itemuser::model()->findAll($criteria);
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
    				'fEmployeeNo'=>$model->fEmployeeNo,
    				'cell'=>array(CHtml::encode($model->fEmployeeName),
    						CHtml::encode($model->fRoleNo),
    						CHtml::encode($model->fCreateUser),
    						CHtml::encode(empty($model->fCreateDate)?'':date('y-m-d',$model->fCreateDate)),
    						CHtml::encode($model->fUserType==0?Yii::t('label','Users'):Yii::t('label','Cooperativepartners')),
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
		$model=Itemuser::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='itemuser-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * 插入新的哦用户
	 * Type ：0，是内部员工，1：合作伙伴
	 */
	public function actionInsertUser(){
		if(isset($_POST['id']) && isset($_POST['name'])){
			$itemno=$_GET['id'];
			$inserName=explode(',', $_POST['name']);
			$transaction = Yii::app()->db->beginTransaction();
			try {
				for($i=0;$i<count($inserName);$i++){
					$itemuser=new Itemuser();
					$itemuser->fItemNo=$itemno;
					$itemuser->fEmployeeName=$inserName[$i];
					$itemuser->fCreateDate=time();
					$itemuser->fCreateUser=Yii::app()->params->loginuser->fUserName;
					$itemuser->fUserType=0;
					$itemuser->save();
				}
				$transaction->commit();
				//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}
	}
	/**
	 * 插入新的哦用户
	 * Type ：0，是内部员工，1：合作伙伴
	 */
	public function actionInsertPartner(){
		if(isset($_POST['id']) && isset($_POST['name'])){
			$itemno=$_GET['id'];
			$inserName=explode(',', $_POST['name']);
			$transaction = Yii::app()->db->beginTransaction();
			try {
				for($i=0;$i<count($inserName);$i++){
					$itemuser=new Itemuser();
					$itemuser->fItemNo=$itemno;
					$itemuser->fEmployeeName=$inserName[$i];
					$itemuser->fCreateDate=time();
					$itemuser->fCreateUser=Yii::app()->params->loginuser->fUserName;
					$itemuser->fUserType=1;
					$itemuser->save();
				}
				$transaction->commit();
				//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
		}
	}
    
	/**
	 * 删除已经添加的用户
	 */
	public function actionDeleteuser(){
		if(isset($_GET['id'])){
			$id=explode('-', $_GET['id']);
			$model=new Itemuser();
			$model->deleteAllByAttributes(array('fItemNo'=>$id[0],'fEmployeeName'=>$id[1]));
		}
	}
}
