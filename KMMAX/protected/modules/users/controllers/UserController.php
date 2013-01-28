<?php

class UserController extends UserCommon
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=User::model()->with('company')->findByPk($id);
		
		$this->render('view',array(
			'model'=>$model,
			'keyid'=>$id,'UserType'=>Yii::app()->params['UserType']
				,'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','View Success'),Yii::app()->params['notytype']['success'])
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->fUserID=GuidUtil::getUuid();
			$model->fUserName = trim($model->fUserName);
			$model->fPassword = md5($model->fPassword);
			$model->fCreateUser =Yii::app()->params->loginuser->fUserName;
			$model->fCreateDate =time();
			$model->fUpdateUser =Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate =time();
			$model->fUserType ='U';
			$model->fStatus =1;
			if($model->save())
				$this->redirect(array('view','id'=>$model->fUserID));
		}

		$this->render('create',array(
			'model'=>$model,'UserType'=>Yii::app()->params['UserType']
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=User::model()->with('company')->findByPk($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->fUserName = trim($model->fUserName);
			$model->fPassword = md5($model->fPassword);
			$model->fUpdateUser =Yii::app()->params->loginuser->fUserName;
			$model->fUpdateDate =time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->fUserID));
		}
		$this->render('update',array(
			'model'=>$model,
			'keyid'=>$id,'UserType'=>Yii::app()->params['UserType']
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionCopy()
	{
		if(isset($_POST['User']))
		{
			$createmodel=new User;
			$createmodel->attributes=$_POST['User'];
			$createmodel->fUserID=GuidUtil::getUuid();
			$createmodel->fUserName = trim($createmodel->fUserName);
			$createmodel->fPassword = md5($createmodel->fPassword);
			$createmodel->fCreateUser =Yii::app()->params->loginuser->fUserName;
			$createmodel->fCreateDate =time();
			$createmodel->fUpdateUser =Yii::app()->params->loginuser->fUserName;
			$createmodel->fUpdateDate =time();
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fUserID));
		}
		$id=$_GET['id'];
		$model=$this->loadModel($id);
		$this->render('copy',array(
			'model'=>$model,'UserType'=>Yii::app()->params['UserType'],
			'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Copy Success'),Yii::app()->params['notytype']['success'])
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
			$model=User::model()->findByPk($id);
			$model->fStatus =0;
			$model->save();
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
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Grid of all models.
	 */
	public function actionIndex()
	{	
		$sort=new CSort('User');//排序，参考YII文档CSort
		$gridRows=array();
		$model=new User;
		$this->render('index',array(
		'pages'=>'',
		'sort'=>$sort,
		'gridRows'=>$gridRows,
		'model'=>$model,
		'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','View Success'),Yii::app()->params['notytype']['success'])
		));
  }

/**
 * Print out array of models for the jqGrid rows.
 */
public function actionGridData()
{  	
		// specify request details
		$jqGrid=$this->processJqGridRequest();
		$criteria=new CDbCriteria;
		$criteria->addCondition("t.fUserType = :fUserType");
		$criteria->params[':fUserType']='U';
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
			'fUserName'=>User::model()->getAttributeLabel('fUserName'),
			'fLastName'=>User::model()->getAttributeLabel('fLastName'),
			'fFirstName'=>User::model()->getAttributeLabel('fFirstName'),
			'fEmail'=>User::model()->getAttributeLabel('fEmail'),
			'fMemo'=>User::model()->getAttributeLabel('fMemo'),
			'fStatus'=>User::model()->getAttributeLabel('fStatus'),
			'fCreateDate'=>User::model()->getAttributeLabel('fCreateDate'),
			'fCreateUser'=>User::model()->getAttributeLabel('fCreateUser'),
			'fUpdateDate'=>User::model()->getAttributeLabel('fUpdateDate'),
			'fUpdateUser'=>User::model()->getAttributeLabel('fUpdateUser'),
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
		$pages=new CPagination(User::model()->count($criteria));
		$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Settings::$SystemPage;
		$pages->applyLimit($criteria);
		$sort=new CSort('User');
		$sort->attributes=array(
				'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>User::model()->getAttributeLabel('fUserName')),
				'fLastName'=>array('asc'=>'fLastName','desc'=>'fLastName desc','label'=>User::model()->getAttributeLabel('fLastName')),
				'fFirstName'=>array('asc'=>'fFirstName','desc'=>'fFirstName desc','label'=>User::model()->getAttributeLabel('fFirstName')),
				'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>User::model()->getAttributeLabel('fEmail')),
				'fIsAdmin'=>array('asc'=>'fIsAdmin','desc'=>'fIsAdmin desc','label'=>User::model()->getAttributeLabel('fIsAdmin')),
				'fIsActive'=>array('asc'=>'fIsActive','desc'=>'fIsActive desc','label'=>User::model()->getAttributeLabel('fIsActive')),
				'fIsLog'=>array('asc'=>'fIsLog','desc'=>'fIsLog desc','label'=>User::model()->getAttributeLabel('fIsLog')),
				'fMemo'=>array('asc'=>'fMemo','desc'=>'fMemo desc','label'=>User::model()->getAttributeLabel('fMemo')),
				'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>User::model()->getAttributeLabel('fStatus')),
				'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>User::model()->getAttributeLabel('fCreateDate')),
				'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>User::model()->getAttributeLabel('fCreateUser')),
				'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>User::model()->getAttributeLabel('fUpdateDate')),
				'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>User::model()->getAttributeLabel('fUpdateUser')),
		);
		$sort->defaultOrder='fUserType desc';
		$sort->applyOrder($criteria);
		$models=User::model()->with('org')->findAll($criteria);
		$data=array(
			'page'=>$pages->getCurrentPage()+1,
			'total'=>$pages->getPageCount(),
			'records'=>$pages->getItemCount(),
			'rows'=>array()
			);
		foreach($models as $model)
		{
		$data['rows'][]=array(
				 'fUserName'=>$model->fUserName,
								'cell'=>array(CHtml::encode($model->fUserName).(Yii::app()->user->checkAccess('users.user.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fUserID),array(
										'class'=>'UFSGrid-edit UFSGrid-row-button','align'=>'right','title'=>Yii::t('label','Update'))):'')
										.(Yii::app()->user->checkAccess('users.user.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fUserID),array(
											'class'=>'UFSGrid-show UFSGrid-row-button','align'=>'right','title'=>Yii::t('label','View'))):'')
										.(Yii::app()->user->checkAccess('users.user.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fUserID),array(
											'class'=>'UFSGrid-edit UFSGrid-row-button','align'=>'right','title'=>Yii::t('label','Delete'))):''),		
				 CHtml::encode($model->fLastName),
				 CHtml::encode($model->fFirstName),
				 CHtml::encode($model->fEmail),
				 CHtml::encode($model->fLead ),
				 CHtml::encode($model->fStatus),
				 CHtml::encode($model->fOrgNo),
				CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
				CHtml::encode($model->fCreateUser),
				CHtml::encode(empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate)),
				CHtml::encode($model->fUpdateUser),										
		));
		}
		UFSBaseUtil::printJson($data);
}
/**
 * Grid of all models.
 */
public function actionPartner()
{
	$sort=new CSort('User');//排序，参考YII文档CSort
	$gridRows=array();
	$model=new User;
	$this->render('partner',array(
			'pages'=>'',
			'sort'=>$sort,
			'gridRows'=>$gridRows,
			'model'=>$model,
			'msg'=>$this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','View Success'),Yii::app()->params['notytype']['success'])
	));
}
/**
 * Print out array of models for the jqGrid rows.
 */
public function actionPartnerData()
{
	// specify request details
	$jqGrid=$this->processJqGridRequest();
	$criteria=new CDbCriteria;
	$criteria->addCondition("t.fUserType = :fUserType");
	$criteria->params[':fUserType']='P';
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
				'fUserName'=>User::model()->getAttributeLabel('fUserName'),
				'fLastName'=>User::model()->getAttributeLabel('fLastName'),
				'fFirstName'=>User::model()->getAttributeLabel('fFirstName'),
				'fEmail'=>User::model()->getAttributeLabel('fEmail'),
				'fMemo'=>User::model()->getAttributeLabel('fMemo'),
				'fStatus'=>User::model()->getAttributeLabel('fStatus'),
				'fCreateDate'=>User::model()->getAttributeLabel('fCreateDate'),
				'fCreateUser'=>User::model()->getAttributeLabel('fCreateUser'),
				'fUpdateDate'=>User::model()->getAttributeLabel('fUpdateDate'),
				'fUpdateUser'=>User::model()->getAttributeLabel('fUpdateUser'),
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
	$pages=new CPagination(User::model()->count($criteria));
	$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Settings::$SystemPage;
	$pages->applyLimit($criteria);
	$sort=new CSort('User');
	$sort->attributes=array(
			'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>User::model()->getAttributeLabel('fUserName')),
			'fLastName'=>array('asc'=>'fLastName','desc'=>'fLastName desc','label'=>User::model()->getAttributeLabel('fLastName')),
			'fFirstName'=>array('asc'=>'fFirstName','desc'=>'fFirstName desc','label'=>User::model()->getAttributeLabel('fFirstName')),
			'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>User::model()->getAttributeLabel('fEmail')),
			'fIsAdmin'=>array('asc'=>'fIsAdmin','desc'=>'fIsAdmin desc','label'=>User::model()->getAttributeLabel('fIsAdmin')),
			'fIsActive'=>array('asc'=>'fIsActive','desc'=>'fIsActive desc','label'=>User::model()->getAttributeLabel('fIsActive')),
			'fIsLog'=>array('asc'=>'fIsLog','desc'=>'fIsLog desc','label'=>User::model()->getAttributeLabel('fIsLog')),
			'fMemo'=>array('asc'=>'fMemo','desc'=>'fMemo desc','label'=>User::model()->getAttributeLabel('fMemo')),
			'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>User::model()->getAttributeLabel('fStatus')),
			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>User::model()->getAttributeLabel('fCreateDate')),
			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>User::model()->getAttributeLabel('fCreateUser')),
			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>User::model()->getAttributeLabel('fUpdateDate')),
			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>User::model()->getAttributeLabel('fUpdateUser')),
	);
	$sort->defaultOrder='fUserType desc';
	$sort->applyOrder($criteria);
	$models=User::model()->findAll($criteria);
	$data=array(
			'page'=>$pages->getCurrentPage()+1,
			'total'=>$pages->getPageCount(),
			'records'=>$pages->getItemCount(),
			'rows'=>array()
	);
	foreach($models as $model)
	{
		$data['rows'][]=array(
				'fUserName'=>$model->fUserName,
				'cell'=>array(CHtml::encode($model->fUserName).(Yii::app()->user->checkAccess('users.user.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fUserID),array(
						'class'=>'UFSGrid-edit UFSGrid-row-button','align'=>'right','title'=>Yii::t('label','Update'))):'')
						.(Yii::app()->user->checkAccess('users.user.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fUserID),array(
								'class'=>'UFSGrid-show UFSGrid-row-button','align'=>'right','title'=>Yii::t('label','View'))):'')
						.(Yii::app()->user->checkAccess('users.user.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fUserID),array(
								'class'=>'UFSGrid-edit UFSGrid-row-button','align'=>'right','title'=>Yii::t('label','Delete'))):''),
						CHtml::encode($model->fLastName),
						CHtml::encode($model->fFirstName),
						CHtml::encode($model->fEmail),
						CHtml::encode($model->fLead ),
						CHtml::encode($model->fStatus),
						CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
						CHtml::encode($model->fCreateUser),
						CHtml::encode(empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate)),
						CHtml::encode($model->fUpdateUser),
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
	$pages=new CPagination(User::model()->count($criteria));//记录总数
	$pages->pageSize=Settings::$SystemPage;//设置每页的记录显示条数
	$pages->applyLimit($criteria);
	$sort=new CSort('User');//排序，参考YII文档CSort
	$sort->attributes=array(
			'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>User::model()->getAttributeLabel('fUserName')),
			'fPassword'=>array('asc'=>'fPassword','desc'=>'fPassword desc','label'=>User::model()->getAttributeLabel('fPassword')),
			'fLastName'=>array('asc'=>'fLastName','desc'=>'fLastName desc','label'=>User::model()->getAttributeLabel('fLastName')),
			'fFirstName'=>array('asc'=>'fFirstName','desc'=>'fFirstName desc','label'=>User::model()->getAttributeLabel('fFirstName')),
			'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>User::model()->getAttributeLabel('fEmail')),
			
			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>User::model()->getAttributeLabel('fCreateDate')),
			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>User::model()->getAttributeLabel('fCreateUser')),
			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>User::model()->getAttributeLabel('fUpdateDate')),
			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>User::model()->getAttributeLabel('fUpdateUser')),
	);
	$sort->defaultOrder='fUserID';
	$sort->applyOrder($criteria);
	$models=User::model()->findAll($criteria);
	$gridRows=array();
	$model=new User;
	$model->unsetAttributes();  // clear any default values
	$this->render('popgrid',array(
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
public function actionPopgridData()

{
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
				'fUserName'=>User::model()->getAttributeLabel('fUserName'),
				'fLastName'=>User::model()->getAttributeLabel('fLastName'),
				'fFirstName'=>User::model()->getAttributeLabel('fFirstName'),
				'fEmail'=>User::model()->getAttributeLabel('fEmail'),
				'fStatus'=>User::model()->getAttributeLabel('fStatus'),
				'fCreateDate'=>User::model()->getAttributeLabel('fCreateDate'),
				'fCreateUser'=>User::model()->getAttributeLabel('fCreateUser'),
				'fUpdateDate'=>User::model()->getAttributeLabel('fUpdateDate'),
				'fUpdateUser'=>User::model()->getAttributeLabel('fUpdateUser'),
				'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>User::model()->getAttributeLabel('fUpdateUser'))
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
	$pages=new CPagination(User::model()->count($criteria));
	$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Settings::$SystemPage;
	$pages->applyLimit($criteria);
	// sort
	$sort=new CSort('User');
	$sort->attributes=array(
			'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>User::model()->getAttributeLabel('fUserName')),
			'fLastName'=>array('asc'=>'fLastName','desc'=>'fLastName desc','label'=>User::model()->getAttributeLabel('fLastName')),
			'fFirstName'=>array('asc'=>'fFirstName','desc'=>'fFirstName desc','label'=>User::model()->getAttributeLabel('fFirstName')),
			'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>User::model()->getAttributeLabel('fEmail')),
			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>User::model()->getAttributeLabel('fCreateDate')),
			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>User::model()->getAttributeLabel('fCreateUser')),
			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>User::model()->getAttributeLabel('fUpdateDate')),
			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>User::model()->getAttributeLabel('fUpdateUser')),
	);
	$sort->defaultOrder='fUserID';
	$sort->applyOrder($criteria);
	// find all
	$models=User::model()->findAll($criteria);
	$data=array(
			'page'=>$pages->getCurrentPage()+1,
			'total'=>$pages->getPageCount(),
			'records'=>$pages->getItemCount(),
			'rows'=>array()
	);
	foreach($models as $model)
	{
		$data['rows'][]=array(
			'fUserName'=>$model->fUserName,
				'cell'=>array(CHtml::encode($model->fUserName),
					CHtml::encode($model->fLastName),
				 CHtml::encode($model->fFirstName),
				 CHtml::encode($model->fEmail),
				 CHtml::encode($model->fLead ),
				 CHtml::encode($model->fStatus),
				CHtml::encode(empty($model->fCreateDate)?'':date('Y-m-d',$model->fCreateDate)),
				CHtml::encode($model->fCreateUser),
				CHtml::encode(empty($model->fUpdateDate)?'':date('Y-m-d',$model->fUpdateDate)),
				CHtml::encode($model->fUpdateUser),				
				));
	}
	UFSBaseUtil::printJson($data);

}

/**
 * Grid of all models.addmultiuser
 */
public function actionMultigrid()

{

	$criteria=new CDbCriteria;

	$keyid='';
	if(isset($_GET['id'])) $keyid=$_GET['id'];

	$pages=new CPagination(User::model()->count($criteria));//记录总数

	$pages->pageSize=Settings::$SystemPage;//设置每页的记录显示条数

	$pages->applyLimit($criteria);



	$sort=new CSort('User');//排序，参考YII文档CSort

	$sort->attributes=array(

			'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>User::model()->getAttributeLabel('fUserName')),

			'fPassword'=>array('asc'=>'fPassword','desc'=>'fPassword desc','label'=>User::model()->getAttributeLabel('fPassword')),

			'fLastName'=>array('asc'=>'fLastName','desc'=>'fLastName desc','label'=>User::model()->getAttributeLabel('fLastName')),

			'fFirstName'=>array('asc'=>'fFirstName','desc'=>'fFirstName desc','label'=>User::model()->getAttributeLabel('fFirstName')),

			'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>User::model()->getAttributeLabel('fEmail')),

			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>User::model()->getAttributeLabel('fCreateDate')),

			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>User::model()->getAttributeLabel('fCreateUser')),

			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>User::model()->getAttributeLabel('fUpdateDate')),

			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>User::model()->getAttributeLabel('fUpdateUser')),

	);

	$sort->defaultOrder='fUserID';

	$sort->applyOrder($criteria);



	// find all

	$models=User::model()->findAll($criteria);



	// rows for the static grid

	$gridRows=array();

	$model=new User;

	$model->unsetAttributes();  // clear any default values



	// render the view file

	$this->render('multigrid',array(

			'models'=>$models,

			'pages'=>$pages,

			'sort'=>$sort,

			'gridRows'=>$gridRows,

			'model'=>$model,'keyid'=>$keyid

	));

}
/**
 * Grid of all models.
 */
public function actionAddmultiuser()

{

	$criteria=new CDbCriteria;

	$keyid='';
	if(isset($_GET['id'])) $keyid=$_GET['id'];

	$pages=new CPagination(User::model()->count($criteria));//记录总数

	$pages->pageSize=Settings::$SystemPage;//设置每页的记录显示条数

	$pages->applyLimit($criteria);



	$sort=new CSort('User');//排序，参考YII文档CSort

	$sort->attributes=array(

			'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>User::model()->getAttributeLabel('fUserName')),

			'fPassword'=>array('asc'=>'fPassword','desc'=>'fPassword desc','label'=>User::model()->getAttributeLabel('fPassword')),

			'fLastName'=>array('asc'=>'fLastName','desc'=>'fLastName desc','label'=>User::model()->getAttributeLabel('fLastName')),

			'fFirstName'=>array('asc'=>'fFirstName','desc'=>'fFirstName desc','label'=>User::model()->getAttributeLabel('fFirstName')),

			'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>User::model()->getAttributeLabel('fEmail')),

			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>User::model()->getAttributeLabel('fCreateDate')),

			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>User::model()->getAttributeLabel('fCreateUser')),

			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>User::model()->getAttributeLabel('fUpdateDate')),

			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>User::model()->getAttributeLabel('fUpdateUser')),

	);

	$sort->defaultOrder='fUserID';

	$sort->applyOrder($criteria);
	$models=User::model()->findAll($criteria);
	$gridRows=array();
	$model=new User;

	$model->unsetAttributes();  // clear any default values



	// render the view file

	$this->render('addmultiuser',array(

			'models'=>$models,

			'pages'=>$pages,

			'sort'=>$sort,

			'gridRows'=>$gridRows,

			'model'=>$model,'keyid'=>$keyid

	));

}




/**

 * Print out array of models for the jqGrid rows.

 */

public function actionMultigridData()

{

	// specify request details

	$jqGrid=$this->processJqGridRequest();

	$criteria=new CDbCriteria;

	if(isset($_GET['id'])&& !emptY($_GET['id'])){

		$temp=Itemuser::model()->findAllByAttributes(array('fItemNo'=>$_GET['id']));

		$notinuser=array();

		foreach ($temp as $tem)  array_push($notinuser,$tem['fEmployeeName']);

		$criteria->addNotInCondition('fUserName',$notinuser);

	}

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
				'fUserName'=>User::model()->getAttributeLabel('fUserName'),
				'fLastName'=>User::model()->getAttributeLabel('fLastName'),
				'fFirstName'=>User::model()->getAttributeLabel('fFirstName'),
				'fEmail'=>User::model()->getAttributeLabel('fEmail'),
				'fStatus'=>User::model()->getAttributeLabel('fStatus'),
				 'fCreateDate'=>User::model()->getAttributeLabel('fCreateDate'),
			'fCreateUser'=>User::model()->getAttributeLabel('fCreateUser'),
			'fUpdateDate'=>User::model()->getAttributeLabel('fUpdateDate'),
			'fUpdateUser'=>User::model()->getAttributeLabel('fUpdateUser'),
			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>User::model()->getAttributeLabel('fUpdateUser'))
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
	$pages=new CPagination(User::model()->count($criteria));
	$pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Settings::$SystemPage;
	$pages->applyLimit($criteria);
	$sort=new CSort('User');
	$sort->attributes=array(

			'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>User::model()->getAttributeLabel('fUserName')),

			'fLastName'=>array('asc'=>'fLastName','desc'=>'fLastName desc','label'=>User::model()->getAttributeLabel('fLastName')),

			'fFirstName'=>array('asc'=>'fFirstName','desc'=>'fFirstName desc','label'=>User::model()->getAttributeLabel('fFirstName')),

			'fEmail'=>array('asc'=>'fEmail','desc'=>'fEmail desc','label'=>User::model()->getAttributeLabel('fEmail')),

			'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>User::model()->getAttributeLabel('fCreateDate')),

			'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>User::model()->getAttributeLabel('fCreateUser')),
			'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>User::model()->getAttributeLabel('fUpdateDate')),
			'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>User::model()->getAttributeLabel('fUpdateUser')),
	);
	$sort->defaultOrder='fUserID';
	$sort->applyOrder($criteria);
	// find all
	$models=User::model()->findAll($criteria);
	$data=array(
			'page'=>$pages->getCurrentPage()+1,
			'total'=>$pages->getPageCount(),
			'records'=>$pages->getItemCount(),
			'rows'=>array()
	);
	foreach($models as $model)
	{
		$data['rows'][]=array(
				'fUserName'=>$model->fUserName,
				'cell'=>array(CHtml::encode($model->fUserName),
						CHtml::encode($model->fLastName),
						CHtml::encode($model->fFirstName),
						CHtml::encode($model->fEmail),
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
		$model=User::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
