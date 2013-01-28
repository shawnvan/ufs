<?php

class ProfileController extends AppController
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

		$model=new Profile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fUserID));
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

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fUserID));
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

		if(isset($_POST['Profile']))
		{
			$createmodel=new Profile;
			$createmodel->attributes=$_POST['Profile'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fUserID));
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
		$model=new Profile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profile']))
			$model->attributes=$_GET['Profile'];

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

        $pages=new CPagination(Profile::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Profile');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fUserID'=>array('asc'=>'fUserID','desc'=>'fUserID desc','label'=>Profile::model()->getAttributeLabel('fUserID')),
		'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>Profile::model()->getAttributeLabel('fUserName')),
		'fCity'=>array('asc'=>'fCity','desc'=>'fCity desc','label'=>Profile::model()->getAttributeLabel('fCity')),
		'fWebsite'=>array('asc'=>'fWebsite','desc'=>'fWebsite desc','label'=>Profile::model()->getAttributeLabel('fWebsite')),
		'fZipCode'=>array('asc'=>'fZipCode','desc'=>'fZipCode desc','label'=>Profile::model()->getAttributeLabel('fZipCode')),
		'fCountry'=>array('asc'=>'fCountry','desc'=>'fCountry desc','label'=>Profile::model()->getAttributeLabel('fCountry')),
		/*
		'fAssignedTo'=>array('asc'=>'fAssignedTo','desc'=>'fAssignedTo desc','label'=>Profile::model()->getAttributeLabel('fAssignedTo')),
		'fQQ'=>array('asc'=>'fQQ','desc'=>'fQQ desc','label'=>Profile::model()->getAttributeLabel('fQQ')),
		'fLinkedIn'=>array('asc'=>'fLinkedIn','desc'=>'fLinkedIn desc','label'=>Profile::model()->getAttributeLabel('fLinkedIn')),
		'fMSN'=>array('asc'=>'fMSN','desc'=>'fMSN desc','label'=>Profile::model()->getAttributeLabel('fMSN')),
		'fFullName'=>array('asc'=>'fFullName','desc'=>'fFullName desc','label'=>Profile::model()->getAttributeLabel('fFullName')),
		'fOfficePhone'=>array('asc'=>'fOfficePhone','desc'=>'fOfficePhone desc','label'=>Profile::model()->getAttributeLabel('fOfficePhone')),
		'fCellPhone'=>array('asc'=>'fCellPhone','desc'=>'fCellPhone desc','label'=>Profile::model()->getAttributeLabel('fCellPhone')),
		'fHomePhone'=>array('asc'=>'fHomePhone','desc'=>'fHomePhone desc','label'=>Profile::model()->getAttributeLabel('fHomePhone')),
		'fNotes'=>array('asc'=>'fNotes','desc'=>'fNotes desc','label'=>Profile::model()->getAttributeLabel('fNotes')),
		'fAvatar'=>array('asc'=>'fAvatar','desc'=>'fAvatar desc','label'=>Profile::model()->getAttributeLabel('fAvatar')),
		'fLanguage'=>array('asc'=>'fLanguage','desc'=>'fLanguage desc','label'=>Profile::model()->getAttributeLabel('fLanguage')),
		'fTimeZone'=>array('asc'=>'fTimeZone','desc'=>'fTimeZone desc','label'=>Profile::model()->getAttributeLabel('fTimeZone')),
		'fShowSocialMedia'=>array('asc'=>'fShowSocialMedia','desc'=>'fShowSocialMedia desc','label'=>Profile::model()->getAttributeLabel('fShowSocialMedia')),
		'fShowDetailView'=>array('asc'=>'fShowDetailView','desc'=>'fShowDetailView desc','label'=>Profile::model()->getAttributeLabel('fShowDetailView')),
		'fShowWorkflow'=>array('asc'=>'fShowWorkflow','desc'=>'fShowWorkflow desc','label'=>Profile::model()->getAttributeLabel('fShowWorkflow')),
		'fGridviewSettings'=>array('asc'=>'fGridviewSettings','desc'=>'fGridviewSettings desc','label'=>Profile::model()->getAttributeLabel('fGridviewSettings')),
		'fFormSettings'=>array('asc'=>'fFormSettings','desc'=>'fFormSettings desc','label'=>Profile::model()->getAttributeLabel('fFormSettings')),
		'fEmailSignature'=>array('asc'=>'fEmailSignature','desc'=>'fEmailSignature desc','label'=>Profile::model()->getAttributeLabel('fEmailSignature')),
		'fEnableFullWidth'=>array('asc'=>'fEnableFullWidth','desc'=>'fEnableFullWidth desc','label'=>Profile::model()->getAttributeLabel('fEnableFullWidth')),
		'fSyncGoogleCalendarId'=>array('asc'=>'fSyncGoogleCalendarId','desc'=>'fSyncGoogleCalendarId desc','label'=>Profile::model()->getAttributeLabel('fSyncGoogleCalendarId')),
		'fSyncGoogleCalendarAccessToken'=>array('asc'=>'fSyncGoogleCalendarAccessToken','desc'=>'fSyncGoogleCalendarAccessToken desc','label'=>Profile::model()->getAttributeLabel('fSyncGoogleCalendarAccessToken')),
		'fSyncGoogleCalendarRefreshToken'=>array('asc'=>'fSyncGoogleCalendarRefreshToken','desc'=>'fSyncGoogleCalendarRefreshToken desc','label'=>Profile::model()->getAttributeLabel('fSyncGoogleCalendarRefreshToken')),
		'fGoogleId'=>array('asc'=>'fGoogleId','desc'=>'fGoogleId desc','label'=>Profile::model()->getAttributeLabel('fGoogleId')),
		'fUserCalendarsVisible'=>array('asc'=>'fUserCalendarsVisible','desc'=>'fUserCalendarsVisible desc','label'=>Profile::model()->getAttributeLabel('fUserCalendarsVisible')),
		'fGroupCalendarsVisible'=>array('asc'=>'fGroupCalendarsVisible','desc'=>'fGroupCalendarsVisible desc','label'=>Profile::model()->getAttributeLabel('fGroupCalendarsVisible')),
		'fTagsShowAllUsers'=>array('asc'=>'fTagsShowAllUsers','desc'=>'fTagsShowAllUsers desc','label'=>Profile::model()->getAttributeLabel('fTagsShowAllUsers')),
		'fWidgets'=>array('asc'=>'fWidgets','desc'=>'fWidgets desc','label'=>Profile::model()->getAttributeLabel('fWidgets')),
		'fAllowPost'=>array('asc'=>'fAllowPost','desc'=>'fAllowPost desc','label'=>Profile::model()->getAttributeLabel('fAllowPost')),
		'fBackgroundColor'=>array('asc'=>'fBackgroundColor','desc'=>'fBackgroundColor desc','label'=>Profile::model()->getAttributeLabel('fBackgroundColor')),
		'fTagLine'=>array('asc'=>'fTagLine','desc'=>'fTagLine desc','label'=>Profile::model()->getAttributeLabel('fTagLine')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Profile::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Profile::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Profile::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Profile::model()->getAttributeLabel('fUpdateDate')),
		'fEmailUserSignature'=>array('asc'=>'fEmailUserSignature','desc'=>'fEmailUserSignature desc','label'=>Profile::model()->getAttributeLabel('fEmailUserSignature')),
		'fAddress1'=>array('asc'=>'fAddress1','desc'=>'fAddress1 desc','label'=>Profile::model()->getAttributeLabel('fAddress1')),
		'fAddress2'=>array('asc'=>'fAddress2','desc'=>'fAddress2 desc','label'=>Profile::model()->getAttributeLabel('fAddress2')),
		*/'fAddress2'=>array('asc'=>'fAddress2','desc'=>'fAddress2 desc','label'=>Profile::model()->getAttributeLabel('fAddress2')),
        );
        $sort->defaultOrder='fUserID';
        $sort->applyOrder($criteria);

        // find all
        $models=Profile::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fUserID)),
		 array('content'=>CHtml::encode($model->fUserName)),
		 array('content'=>CHtml::encode($model->fCity)),
		 array('content'=>CHtml::encode($model->fWebsite)),
		 array('content'=>CHtml::encode($model->fZipCode)),
		 array('content'=>CHtml::encode($model->fCountry)),
		/*
		 array('content'=>CHtml::encode($model->fAssignedTo)),
		 array('content'=>CHtml::encode($model->fQQ)),
		 array('content'=>CHtml::encode($model->fLinkedIn)),
		 array('content'=>CHtml::encode($model->fMSN)),
		 array('content'=>CHtml::encode($model->fFullName)),
		 array('content'=>CHtml::encode($model->fOfficePhone)),
		 array('content'=>CHtml::encode($model->fCellPhone)),
		 array('content'=>CHtml::encode($model->fHomePhone)),
		 array('content'=>CHtml::encode($model->fNotes)),
		 array('content'=>CHtml::encode($model->fAvatar)),
		 array('content'=>CHtml::encode($model->fLanguage)),
		 array('content'=>CHtml::encode($model->fTimeZone)),
		 array('content'=>CHtml::encode($model->fShowSocialMedia)),
		 array('content'=>CHtml::encode($model->fShowDetailView)),
		 array('content'=>CHtml::encode($model->fShowWorkflow)),
		 array('content'=>CHtml::encode($model->fGridviewSettings)),
		 array('content'=>CHtml::encode($model->fFormSettings)),
		 array('content'=>CHtml::encode($model->fEmailSignature)),
		 array('content'=>CHtml::encode($model->fEnableFullWidth)),
		 array('content'=>CHtml::encode($model->fSyncGoogleCalendarId)),
		 array('content'=>CHtml::encode($model->fSyncGoogleCalendarAccessToken)),
		 array('content'=>CHtml::encode($model->fSyncGoogleCalendarRefreshToken)),
		 array('content'=>CHtml::encode($model->fGoogleId)),
		 array('content'=>CHtml::encode($model->fUserCalendarsVisible)),
		 array('content'=>CHtml::encode($model->fGroupCalendarsVisible)),
		 array('content'=>CHtml::encode($model->fTagsShowAllUsers)),
		 array('content'=>CHtml::encode($model->fWidgets)),
		 array('content'=>CHtml::encode($model->fAllowPost)),
		 array('content'=>CHtml::encode($model->fBackgroundColor)),
		 array('content'=>CHtml::encode($model->fTagLine)),
		 array('content'=>CHtml::encode($model->fCreateUser)),
		 array('content'=>CHtml::encode($model->fCreateDate)),
		 array('content'=>CHtml::encode($model->fUpdateUser)),
		 array('content'=>CHtml::encode($model->fUpdateDate)),
		 array('content'=>CHtml::encode($model->fEmailUserSignature)),
		 array('content'=>CHtml::encode($model->fAddress1)),
		 array('content'=>CHtml::encode($model->fAddress2)),
		*/
            );
        }	
		
		$model=new Profile;
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
						'fUserID'=>Profile::model()->getAttributeLabel('fUserID'),
		'fUserName'=>Profile::model()->getAttributeLabel('fUserName'),
		'fCity'=>Profile::model()->getAttributeLabel('fCity'),
		'fWebsite'=>Profile::model()->getAttributeLabel('fWebsite'),
		'fZipCode'=>Profile::model()->getAttributeLabel('fZipCode'),
		'fCountry'=>Profile::model()->getAttributeLabel('fCountry'),
		/*
		'fAssignedTo'=>Profile::model()->getAttributeLabel('fAssignedTo'),
		'fQQ'=>Profile::model()->getAttributeLabel('fQQ'),
		'fLinkedIn'=>Profile::model()->getAttributeLabel('fLinkedIn'),
		'fMSN'=>Profile::model()->getAttributeLabel('fMSN'),
		'fFullName'=>Profile::model()->getAttributeLabel('fFullName'),
		'fOfficePhone'=>Profile::model()->getAttributeLabel('fOfficePhone'),
		'fCellPhone'=>Profile::model()->getAttributeLabel('fCellPhone'),
		'fHomePhone'=>Profile::model()->getAttributeLabel('fHomePhone'),
		'fNotes'=>Profile::model()->getAttributeLabel('fNotes'),
		'fAvatar'=>Profile::model()->getAttributeLabel('fAvatar'),
		'fLanguage'=>Profile::model()->getAttributeLabel('fLanguage'),
		'fTimeZone'=>Profile::model()->getAttributeLabel('fTimeZone'),
		'fShowSocialMedia'=>Profile::model()->getAttributeLabel('fShowSocialMedia'),
		'fShowDetailView'=>Profile::model()->getAttributeLabel('fShowDetailView'),
		'fShowWorkflow'=>Profile::model()->getAttributeLabel('fShowWorkflow'),
		'fGridviewSettings'=>Profile::model()->getAttributeLabel('fGridviewSettings'),
		'fFormSettings'=>Profile::model()->getAttributeLabel('fFormSettings'),
		'fEmailSignature'=>Profile::model()->getAttributeLabel('fEmailSignature'),
		'fEnableFullWidth'=>Profile::model()->getAttributeLabel('fEnableFullWidth'),
		'fSyncGoogleCalendarId'=>Profile::model()->getAttributeLabel('fSyncGoogleCalendarId'),
		'fSyncGoogleCalendarAccessToken'=>Profile::model()->getAttributeLabel('fSyncGoogleCalendarAccessToken'),
		'fSyncGoogleCalendarRefreshToken'=>Profile::model()->getAttributeLabel('fSyncGoogleCalendarRefreshToken'),
		'fGoogleId'=>Profile::model()->getAttributeLabel('fGoogleId'),
		'fUserCalendarsVisible'=>Profile::model()->getAttributeLabel('fUserCalendarsVisible'),
		'fGroupCalendarsVisible'=>Profile::model()->getAttributeLabel('fGroupCalendarsVisible'),
		'fTagsShowAllUsers'=>Profile::model()->getAttributeLabel('fTagsShowAllUsers'),
		'fWidgets'=>Profile::model()->getAttributeLabel('fWidgets'),
		'fAllowPost'=>Profile::model()->getAttributeLabel('fAllowPost'),
		'fBackgroundColor'=>Profile::model()->getAttributeLabel('fBackgroundColor'),
		'fTagLine'=>Profile::model()->getAttributeLabel('fTagLine'),
		'fCreateUser'=>Profile::model()->getAttributeLabel('fCreateUser'),
		'fCreateDate'=>Profile::model()->getAttributeLabel('fCreateDate'),
		'fUpdateUser'=>Profile::model()->getAttributeLabel('fUpdateUser'),
		'fUpdateDate'=>Profile::model()->getAttributeLabel('fUpdateDate'),
		'fEmailUserSignature'=>Profile::model()->getAttributeLabel('fEmailUserSignature'),
		'fAddress1'=>Profile::model()->getAttributeLabel('fAddress1'),
		'fAddress2'=>Profile::model()->getAttributeLabel('fAddress2'),
		*/'fAddress2'=>array('asc'=>'fAddress2','desc'=>'fAddress2 desc','label'=>Profile::model()->getAttributeLabel('fAddress2')),
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
        
		$pages=new CPagination(Profile::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Profile');
		
        $sort->attributes=array(
           		'fUserID'=>array('asc'=>'fUserID','desc'=>'fUserID desc','label'=>Profile::model()->getAttributeLabel('fUserID')),
		'fUserName'=>array('asc'=>'fUserName','desc'=>'fUserName desc','label'=>Profile::model()->getAttributeLabel('fUserName')),
		'fCity'=>array('asc'=>'fCity','desc'=>'fCity desc','label'=>Profile::model()->getAttributeLabel('fCity')),
		'fWebsite'=>array('asc'=>'fWebsite','desc'=>'fWebsite desc','label'=>Profile::model()->getAttributeLabel('fWebsite')),
		'fZipCode'=>array('asc'=>'fZipCode','desc'=>'fZipCode desc','label'=>Profile::model()->getAttributeLabel('fZipCode')),
		'fCountry'=>array('asc'=>'fCountry','desc'=>'fCountry desc','label'=>Profile::model()->getAttributeLabel('fCountry')),
		/*
		'fAssignedTo'=>array('asc'=>'fAssignedTo','desc'=>'fAssignedTo desc','label'=>Profile::model()->getAttributeLabel('fAssignedTo')),
		'fQQ'=>array('asc'=>'fQQ','desc'=>'fQQ desc','label'=>Profile::model()->getAttributeLabel('fQQ')),
		'fLinkedIn'=>array('asc'=>'fLinkedIn','desc'=>'fLinkedIn desc','label'=>Profile::model()->getAttributeLabel('fLinkedIn')),
		'fMSN'=>array('asc'=>'fMSN','desc'=>'fMSN desc','label'=>Profile::model()->getAttributeLabel('fMSN')),
		'fFullName'=>array('asc'=>'fFullName','desc'=>'fFullName desc','label'=>Profile::model()->getAttributeLabel('fFullName')),
		'fOfficePhone'=>array('asc'=>'fOfficePhone','desc'=>'fOfficePhone desc','label'=>Profile::model()->getAttributeLabel('fOfficePhone')),
		'fCellPhone'=>array('asc'=>'fCellPhone','desc'=>'fCellPhone desc','label'=>Profile::model()->getAttributeLabel('fCellPhone')),
		'fHomePhone'=>array('asc'=>'fHomePhone','desc'=>'fHomePhone desc','label'=>Profile::model()->getAttributeLabel('fHomePhone')),
		'fNotes'=>array('asc'=>'fNotes','desc'=>'fNotes desc','label'=>Profile::model()->getAttributeLabel('fNotes')),
		'fAvatar'=>array('asc'=>'fAvatar','desc'=>'fAvatar desc','label'=>Profile::model()->getAttributeLabel('fAvatar')),
		'fLanguage'=>array('asc'=>'fLanguage','desc'=>'fLanguage desc','label'=>Profile::model()->getAttributeLabel('fLanguage')),
		'fTimeZone'=>array('asc'=>'fTimeZone','desc'=>'fTimeZone desc','label'=>Profile::model()->getAttributeLabel('fTimeZone')),
		'fShowSocialMedia'=>array('asc'=>'fShowSocialMedia','desc'=>'fShowSocialMedia desc','label'=>Profile::model()->getAttributeLabel('fShowSocialMedia')),
		'fShowDetailView'=>array('asc'=>'fShowDetailView','desc'=>'fShowDetailView desc','label'=>Profile::model()->getAttributeLabel('fShowDetailView')),
		'fShowWorkflow'=>array('asc'=>'fShowWorkflow','desc'=>'fShowWorkflow desc','label'=>Profile::model()->getAttributeLabel('fShowWorkflow')),
		'fGridviewSettings'=>array('asc'=>'fGridviewSettings','desc'=>'fGridviewSettings desc','label'=>Profile::model()->getAttributeLabel('fGridviewSettings')),
		'fFormSettings'=>array('asc'=>'fFormSettings','desc'=>'fFormSettings desc','label'=>Profile::model()->getAttributeLabel('fFormSettings')),
		'fEmailSignature'=>array('asc'=>'fEmailSignature','desc'=>'fEmailSignature desc','label'=>Profile::model()->getAttributeLabel('fEmailSignature')),
		'fEnableFullWidth'=>array('asc'=>'fEnableFullWidth','desc'=>'fEnableFullWidth desc','label'=>Profile::model()->getAttributeLabel('fEnableFullWidth')),
		'fSyncGoogleCalendarId'=>array('asc'=>'fSyncGoogleCalendarId','desc'=>'fSyncGoogleCalendarId desc','label'=>Profile::model()->getAttributeLabel('fSyncGoogleCalendarId')),
		'fSyncGoogleCalendarAccessToken'=>array('asc'=>'fSyncGoogleCalendarAccessToken','desc'=>'fSyncGoogleCalendarAccessToken desc','label'=>Profile::model()->getAttributeLabel('fSyncGoogleCalendarAccessToken')),
		'fSyncGoogleCalendarRefreshToken'=>array('asc'=>'fSyncGoogleCalendarRefreshToken','desc'=>'fSyncGoogleCalendarRefreshToken desc','label'=>Profile::model()->getAttributeLabel('fSyncGoogleCalendarRefreshToken')),
		'fGoogleId'=>array('asc'=>'fGoogleId','desc'=>'fGoogleId desc','label'=>Profile::model()->getAttributeLabel('fGoogleId')),
		'fUserCalendarsVisible'=>array('asc'=>'fUserCalendarsVisible','desc'=>'fUserCalendarsVisible desc','label'=>Profile::model()->getAttributeLabel('fUserCalendarsVisible')),
		'fGroupCalendarsVisible'=>array('asc'=>'fGroupCalendarsVisible','desc'=>'fGroupCalendarsVisible desc','label'=>Profile::model()->getAttributeLabel('fGroupCalendarsVisible')),
		'fTagsShowAllUsers'=>array('asc'=>'fTagsShowAllUsers','desc'=>'fTagsShowAllUsers desc','label'=>Profile::model()->getAttributeLabel('fTagsShowAllUsers')),
		'fWidgets'=>array('asc'=>'fWidgets','desc'=>'fWidgets desc','label'=>Profile::model()->getAttributeLabel('fWidgets')),
		'fAllowPost'=>array('asc'=>'fAllowPost','desc'=>'fAllowPost desc','label'=>Profile::model()->getAttributeLabel('fAllowPost')),
		'fBackgroundColor'=>array('asc'=>'fBackgroundColor','desc'=>'fBackgroundColor desc','label'=>Profile::model()->getAttributeLabel('fBackgroundColor')),
		'fTagLine'=>array('asc'=>'fTagLine','desc'=>'fTagLine desc','label'=>Profile::model()->getAttributeLabel('fTagLine')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>Profile::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Profile::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>Profile::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Profile::model()->getAttributeLabel('fUpdateDate')),
		'fEmailUserSignature'=>array('asc'=>'fEmailUserSignature','desc'=>'fEmailUserSignature desc','label'=>Profile::model()->getAttributeLabel('fEmailUserSignature')),
		'fAddress1'=>array('asc'=>'fAddress1','desc'=>'fAddress1 desc','label'=>Profile::model()->getAttributeLabel('fAddress1')),
		'fAddress2'=>array('asc'=>'fAddress2','desc'=>'fAddress2 desc','label'=>Profile::model()->getAttributeLabel('fAddress2')),
		*/'fAddress2'=>array('asc'=>'fAddress2','desc'=>'fAddress2 desc','label'=>Profile::model()->getAttributeLabel('fAddress2')),
        );
        $sort->defaultOrder='fUserID';
        $sort->applyOrder($criteria);

        // find all
        $models=Profile::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fUserID'=>$model->fUserID,
						'cell'=>array(CHtml::encode($model->fUserID).(Yii::app()->user->checkAccess('users.profile.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fUserID),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('users.profile.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fUserID),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('users.profile.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fUserID),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fUserName),
		 CHtml::encode($model->fCity),
		 CHtml::encode($model->fWebsite),
		 CHtml::encode($model->fZipCode),
		 CHtml::encode($model->fCountry),
		 CHtml::encode($model->fAssignedTo),
		 CHtml::encode($model->fQQ),
		 CHtml::encode($model->fLinkedIn),
		 CHtml::encode($model->fMSN),
		 CHtml::encode($model->fFullName),
		 CHtml::encode($model->fOfficePhone),
		 CHtml::encode($model->fCellPhone),
		 CHtml::encode($model->fHomePhone),
		 CHtml::encode($model->fNotes),
		 CHtml::encode($model->fAvatar),
		 CHtml::encode($model->fLanguage),
		 CHtml::encode($model->fTimeZone),
		 CHtml::encode($model->fShowSocialMedia),
		 CHtml::encode($model->fShowDetailView),
		 CHtml::encode($model->fShowWorkflow),
		 CHtml::encode($model->fGridviewSettings),
		 CHtml::encode($model->fFormSettings),
		 CHtml::encode($model->fEmailSignature),
		 CHtml::encode($model->fEnableFullWidth),
		 CHtml::encode($model->fSyncGoogleCalendarId),
		 CHtml::encode($model->fSyncGoogleCalendarAccessToken),
		 CHtml::encode($model->fSyncGoogleCalendarRefreshToken),
		 CHtml::encode($model->fGoogleId),
		 CHtml::encode($model->fUserCalendarsVisible),
		 CHtml::encode($model->fGroupCalendarsVisible),
		 CHtml::encode($model->fTagsShowAllUsers),
		 CHtml::encode($model->fWidgets),
		 CHtml::encode($model->fAllowPost),
		 CHtml::encode($model->fBackgroundColor),
		 CHtml::encode($model->fTagLine),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode($model->fCreateDate),
		 CHtml::encode($model->fUpdateUser),
		 CHtml::encode($model->fUpdateDate),
		 CHtml::encode($model->fEmailUserSignature),
		 CHtml::encode($model->fAddress1),
		 CHtml::encode($model->fAddress2),
            ));
        }
        $this->printJson($data);
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Profile::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
