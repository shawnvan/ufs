<?php

class PartnerController extends AppController
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

		$model=new Partner;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Partner']))
		{
			$model->attributes=$_POST['Partner'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fPartnerNo));
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

		if(isset($_POST['Partner']))
		{
			$model->attributes=$_POST['Partner'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fPartnerNo));
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

		if(isset($_POST['Partner']))
		{
			$createmodel=new Partner;
			$createmodel->attributes=$_POST['Partner'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fPartnerNo));
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
		$model=new Partner('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Partner']))
			$model->attributes=$_GET['Partner'];

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

        $pages=new CPagination(Partner::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Partner');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fPartnerNo'=>array('asc'=>'fPartnerNo','desc'=>'fPartnerNo desc','label'=>Partner::model()->getAttributeLabel('fPartnerNo')),
		'fCompanyName'=>array('asc'=>'fCompanyName','desc'=>'fCompanyName desc','label'=>Partner::model()->getAttributeLabel('fCompanyName')),
		'fCompanyaddress'=>array('asc'=>'fCompanyaddress','desc'=>'fCompanyaddress desc','label'=>Partner::model()->getAttributeLabel('fCompanyaddress')),
		'fContactor'=>array('asc'=>'fContactor','desc'=>'fContactor desc','label'=>Partner::model()->getAttributeLabel('fContactor')),
		'fCapitalAuthority'=>array('asc'=>'fCapitalAuthority','desc'=>'fCapitalAuthority desc','label'=>Partner::model()->getAttributeLabel('fCapitalAuthority')),
		'fSetTime'=>array('asc'=>'fSetTime','desc'=>'fSetTime desc','label'=>Partner::model()->getAttributeLabel('fSetTime')),
		/*
		'fCompanyType'=>array('asc'=>'fCompanyType','desc'=>'fCompanyType desc','label'=>Partner::model()->getAttributeLabel('fCompanyType')),
		'fLegalRepresentative'=>array('asc'=>'fLegalRepresentative','desc'=>'fLegalRepresentative desc','label'=>Partner::model()->getAttributeLabel('fLegalRepresentative')),
		'fIndustry'=>array('asc'=>'fIndustry','desc'=>'fIndustry desc','label'=>Partner::model()->getAttributeLabel('fIndustry')),
		'fBusiness'=>array('asc'=>'fBusiness','desc'=>'fBusiness desc','label'=>Partner::model()->getAttributeLabel('fBusiness')),
		'fProduct'=>array('asc'=>'fProduct','desc'=>'fProduct desc','label'=>Partner::model()->getAttributeLabel('fProduct')),
		'fShareholder'=>array('asc'=>'fShareholder','desc'=>'fShareholder desc','label'=>Partner::model()->getAttributeLabel('fShareholder')),
		'fShareholdeRatio'=>array('asc'=>'fShareholdeRatio','desc'=>'fShareholdeRatio desc','label'=>Partner::model()->getAttributeLabel('fShareholdeRatio')),
		'fRealityMan'=>array('asc'=>'fRealityMan','desc'=>'fRealityMan desc','label'=>Partner::model()->getAttributeLabel('fRealityMan')),
		'fShareholderBackground'=>array('asc'=>'fShareholderBackground','desc'=>'fShareholderBackground desc','label'=>Partner::model()->getAttributeLabel('fShareholderBackground')),
		'fProjectSituation'=>array('asc'=>'fProjectSituation','desc'=>'fProjectSituation desc','label'=>Partner::model()->getAttributeLabel('fProjectSituation')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Partner::model()->getAttributeLabel('fUserGroup')),
		*/'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Partner::model()->getAttributeLabel('fUserGroup')),
        );
        $sort->defaultOrder='fPartnerNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Partner::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fPartnerNo)),
		 array('content'=>CHtml::encode($model->fCompanyName)),
		 array('content'=>CHtml::encode($model->fCompanyaddress)),
		 array('content'=>CHtml::encode($model->fContactor)),
		 array('content'=>CHtml::encode($model->fCapitalAuthority)),
		 array('content'=>CHtml::encode($model->fSetTime)),
		/*
		 array('content'=>CHtml::encode($model->fCompanyType)),
		 array('content'=>CHtml::encode($model->fLegalRepresentative)),
		 array('content'=>CHtml::encode($model->fIndustry)),
		 array('content'=>CHtml::encode($model->fBusiness)),
		 array('content'=>CHtml::encode($model->fProduct)),
		 array('content'=>CHtml::encode($model->fShareholder)),
		 array('content'=>CHtml::encode($model->fShareholdeRatio)),
		 array('content'=>CHtml::encode($model->fRealityMan)),
		 array('content'=>CHtml::encode($model->fShareholderBackground)),
		 array('content'=>CHtml::encode($model->fProjectSituation)),
		 array('content'=>CHtml::encode($model->fUserGroup)),
		*/
            );
        }	
		
		$model=new Partner;
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
						'fPartnerNo'=>Partner::model()->getAttributeLabel('fPartnerNo'),
		'fCompanyName'=>Partner::model()->getAttributeLabel('fCompanyName'),
		'fCompanyaddress'=>Partner::model()->getAttributeLabel('fCompanyaddress'),
		'fContactor'=>Partner::model()->getAttributeLabel('fContactor'),
		'fCapitalAuthority'=>Partner::model()->getAttributeLabel('fCapitalAuthority'),
		'fSetTime'=>Partner::model()->getAttributeLabel('fSetTime'),
		/*
		'fCompanyType'=>Partner::model()->getAttributeLabel('fCompanyType'),
		'fLegalRepresentative'=>Partner::model()->getAttributeLabel('fLegalRepresentative'),
		'fIndustry'=>Partner::model()->getAttributeLabel('fIndustry'),
		'fBusiness'=>Partner::model()->getAttributeLabel('fBusiness'),
		'fProduct'=>Partner::model()->getAttributeLabel('fProduct'),
		'fShareholder'=>Partner::model()->getAttributeLabel('fShareholder'),
		'fShareholdeRatio'=>Partner::model()->getAttributeLabel('fShareholdeRatio'),
		'fRealityMan'=>Partner::model()->getAttributeLabel('fRealityMan'),
		'fShareholderBackground'=>Partner::model()->getAttributeLabel('fShareholderBackground'),
		'fProjectSituation'=>Partner::model()->getAttributeLabel('fProjectSituation'),
		'fUserGroup'=>Partner::model()->getAttributeLabel('fUserGroup'),
		*/'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Partner::model()->getAttributeLabel('fUserGroup')),
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
        
		$pages=new CPagination(Partner::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Partner');
		
        $sort->attributes=array(
           		'fPartnerNo'=>array('asc'=>'fPartnerNo','desc'=>'fPartnerNo desc','label'=>Partner::model()->getAttributeLabel('fPartnerNo')),
		'fCompanyName'=>array('asc'=>'fCompanyName','desc'=>'fCompanyName desc','label'=>Partner::model()->getAttributeLabel('fCompanyName')),
		'fCompanyaddress'=>array('asc'=>'fCompanyaddress','desc'=>'fCompanyaddress desc','label'=>Partner::model()->getAttributeLabel('fCompanyaddress')),
		'fContactor'=>array('asc'=>'fContactor','desc'=>'fContactor desc','label'=>Partner::model()->getAttributeLabel('fContactor')),
		'fCapitalAuthority'=>array('asc'=>'fCapitalAuthority','desc'=>'fCapitalAuthority desc','label'=>Partner::model()->getAttributeLabel('fCapitalAuthority')),
		'fSetTime'=>array('asc'=>'fSetTime','desc'=>'fSetTime desc','label'=>Partner::model()->getAttributeLabel('fSetTime')),
		/*
		'fCompanyType'=>array('asc'=>'fCompanyType','desc'=>'fCompanyType desc','label'=>Partner::model()->getAttributeLabel('fCompanyType')),
		'fLegalRepresentative'=>array('asc'=>'fLegalRepresentative','desc'=>'fLegalRepresentative desc','label'=>Partner::model()->getAttributeLabel('fLegalRepresentative')),
		'fIndustry'=>array('asc'=>'fIndustry','desc'=>'fIndustry desc','label'=>Partner::model()->getAttributeLabel('fIndustry')),
		'fBusiness'=>array('asc'=>'fBusiness','desc'=>'fBusiness desc','label'=>Partner::model()->getAttributeLabel('fBusiness')),
		'fProduct'=>array('asc'=>'fProduct','desc'=>'fProduct desc','label'=>Partner::model()->getAttributeLabel('fProduct')),
		'fShareholder'=>array('asc'=>'fShareholder','desc'=>'fShareholder desc','label'=>Partner::model()->getAttributeLabel('fShareholder')),
		'fShareholdeRatio'=>array('asc'=>'fShareholdeRatio','desc'=>'fShareholdeRatio desc','label'=>Partner::model()->getAttributeLabel('fShareholdeRatio')),
		'fRealityMan'=>array('asc'=>'fRealityMan','desc'=>'fRealityMan desc','label'=>Partner::model()->getAttributeLabel('fRealityMan')),
		'fShareholderBackground'=>array('asc'=>'fShareholderBackground','desc'=>'fShareholderBackground desc','label'=>Partner::model()->getAttributeLabel('fShareholderBackground')),
		'fProjectSituation'=>array('asc'=>'fProjectSituation','desc'=>'fProjectSituation desc','label'=>Partner::model()->getAttributeLabel('fProjectSituation')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Partner::model()->getAttributeLabel('fUserGroup')),
		*/'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Partner::model()->getAttributeLabel('fUserGroup')),
        );
        $sort->defaultOrder='fPartnerNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Partner::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fPartnerNo'=>$model->fPartnerNo,
						'cell'=>array(CHtml::encode($model->fPartnerNo).(Yii::app()->user->checkAccess('Item.partner.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fPartnerNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('Item.partner.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fPartnerNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('Item.partner.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fPartnerNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fCompanyName),
		 CHtml::encode($model->fCompanyaddress),
		 CHtml::encode($model->fContactor),
		 CHtml::encode($model->fCapitalAuthority),
		 CHtml::encode($model->fSetTime),
		 CHtml::encode($model->fCompanyType),
		 CHtml::encode($model->fLegalRepresentative),
		 CHtml::encode($model->fIndustry),
		 CHtml::encode($model->fBusiness),
		 CHtml::encode($model->fProduct),
		 CHtml::encode($model->fShareholder),
		 CHtml::encode($model->fShareholdeRatio),
		 CHtml::encode($model->fRealityMan),
		 CHtml::encode($model->fShareholderBackground),
		 CHtml::encode($model->fProjectSituation),
		 CHtml::encode($model->fUserGroup),
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
		$model=Partner::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='partner-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
