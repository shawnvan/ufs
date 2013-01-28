<?php

class WmsReleaseorderdetailController extends AppController
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

		$model=new WmsReleaseorderdetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['WmsReleaseorderdetail']))
		{
			$model->attributes=$_POST['WmsReleaseorderdetail'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fReleaseOrderKey));
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

		if(isset($_POST['WmsReleaseorderdetail']))
		{
			$model->attributes=$_POST['WmsReleaseorderdetail'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fReleaseOrderKey));
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

		if(isset($_POST['WmsReleaseorderdetail']))
		{
			$createmodel=new WmsReleaseorderdetail;
			$createmodel->attributes=$_POST['WmsReleaseorderdetail'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fReleaseOrderKey));
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
		$model=new WmsReleaseorderdetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['WmsReleaseorderdetail']))
			$model->attributes=$_GET['WmsReleaseorderdetail'];

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

        $pages=new CPagination(WmsReleaseorderdetail::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('WmsReleaseorderdetail');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fReleaseOrderKey'=>array('asc'=>'fReleaseOrderKey','desc'=>'fReleaseOrderKey desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fReleaseOrderKey')),
		'fReleaseOrderLineNO'=>array('asc'=>'fReleaseOrderLineNO','desc'=>'fReleaseOrderLineNO desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fReleaseOrderLineNO')),
		'fWarehouseCode'=>array('asc'=>'fWarehouseCode','desc'=>'fWarehouseCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fWarehouseCode')),
		'fCustomerLineNO'=>array('asc'=>'fCustomerLineNO','desc'=>'fCustomerLineNO desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCustomerLineNO')),
		'fStorerSKUCode'=>array('asc'=>'fStorerSKUCode','desc'=>'fStorerSKUCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fStorerSKUCode')),
		'fSKUDescription'=>array('asc'=>'fSKUDescription','desc'=>'fSKUDescription desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUDescription')),
		/*
		'fAlternateSKUCode'=>array('asc'=>'fAlternateSKUCode','desc'=>'fAlternateSKUCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAlternateSKUCode')),
		'fAlternateSKUDesc'=>array('asc'=>'fAlternateSKUDesc','desc'=>'fAlternateSKUDesc desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAlternateSKUDesc')),
		'fPackCode'=>array('asc'=>'fPackCode','desc'=>'fPackCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPackCode')),
		'fUnitCode'=>array('asc'=>'fUnitCode','desc'=>'fUnitCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUnitCode')),
		'fOrderedQty'=>array('asc'=>'fOrderedQty','desc'=>'fOrderedQty desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fOrderedQty')),
		'fAdjustedQty'=>array('asc'=>'fAdjustedQty','desc'=>'fAdjustedQty desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAdjustedQty')),
		'fAllocatedQty'=>array('asc'=>'fAllocatedQty','desc'=>'fAllocatedQty desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAllocatedQty')),
		'fPickedQty'=>array('asc'=>'fPickedQty','desc'=>'fPickedQty desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPickedQty')),
		'fShippedQty'=>array('asc'=>'fShippedQty','desc'=>'fShippedQty desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fShippedQty')),
		'fAllocateStatusCode'=>array('asc'=>'fAllocateStatusCode','desc'=>'fAllocateStatusCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAllocateStatusCode')),
		'fPickStatusCode'=>array('asc'=>'fPickStatusCode','desc'=>'fPickStatusCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPickStatusCode')),
		'fOutboundStatusCode'=>array('asc'=>'fOutboundStatusCode','desc'=>'fOutboundStatusCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fOutboundStatusCode')),
		'fPrice'=>array('asc'=>'fPrice','desc'=>'fPrice desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPrice')),
		'fCurrencyCode'=>array('asc'=>'fCurrencyCode','desc'=>'fCurrencyCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCurrencyCode')),
		'fSerialNO'=>array('asc'=>'fSerialNO','desc'=>'fSerialNO desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSerialNO')),
		'fSourcePOKey'=>array('asc'=>'fSourcePOKey','desc'=>'fSourcePOKey desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSourcePOKey')),
		'fSourcePOLineNO'=>array('asc'=>'fSourcePOLineNO','desc'=>'fSourcePOLineNO desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSourcePOLineNO')),
		'fOriginalCountry'=>array('asc'=>'fOriginalCountry','desc'=>'fOriginalCountry desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fOriginalCountry')),
		'fMAWB'=>array('asc'=>'fMAWB','desc'=>'fMAWB desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fMAWB')),
		'fHAWB'=>array('asc'=>'fHAWB','desc'=>'fHAWB desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fHAWB')),
		'fGrossWGT'=>array('asc'=>'fGrossWGT','desc'=>'fGrossWGT desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fGrossWGT')),
		'fNetWGT'=>array('asc'=>'fNetWGT','desc'=>'fNetWGT desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fNetWGT')),
		'fCube'=>array('asc'=>'fCube','desc'=>'fCube desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCube')),
		'fUnitNetWGT'=>array('asc'=>'fUnitNetWGT','desc'=>'fUnitNetWGT desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUnitNetWGT')),
		'fUnitCube'=>array('asc'=>'fUnitCube','desc'=>'fUnitCube desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUnitCube')),
		'fCartonCount'=>array('asc'=>'fCartonCount','desc'=>'fCartonCount desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCartonCount')),
		'fCartonNO'=>array('asc'=>'fCartonNO','desc'=>'fCartonNO desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCartonNO')),
		'fCommand'=>array('asc'=>'fCommand','desc'=>'fCommand desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCommand')),
		'fLotAttribute01'=>array('asc'=>'fLotAttribute01','desc'=>'fLotAttribute01 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute01')),
		'fLotAttribute02'=>array('asc'=>'fLotAttribute02','desc'=>'fLotAttribute02 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute02')),
		'fLotAttribute03'=>array('asc'=>'fLotAttribute03','desc'=>'fLotAttribute03 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute03')),
		'fLotAttribute04'=>array('asc'=>'fLotAttribute04','desc'=>'fLotAttribute04 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute04')),
		'fLotAttribute05'=>array('asc'=>'fLotAttribute05','desc'=>'fLotAttribute05 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute05')),
		'fLotAttribute06'=>array('asc'=>'fLotAttribute06','desc'=>'fLotAttribute06 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute06')),
		'fLotAttribute07'=>array('asc'=>'fLotAttribute07','desc'=>'fLotAttribute07 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute07')),
		'fLotAttribute08'=>array('asc'=>'fLotAttribute08','desc'=>'fLotAttribute08 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute08')),
		'fLotAttribute09'=>array('asc'=>'fLotAttribute09','desc'=>'fLotAttribute09 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute09')),
		'fLotAttribute10'=>array('asc'=>'fLotAttribute10','desc'=>'fLotAttribute10 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute10')),
		'fSKUCategory01'=>array('asc'=>'fSKUCategory01','desc'=>'fSKUCategory01 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory01')),
		'fSKUCategory02'=>array('asc'=>'fSKUCategory02','desc'=>'fSKUCategory02 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory02')),
		'fSKUCategory03'=>array('asc'=>'fSKUCategory03','desc'=>'fSKUCategory03 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory03')),
		'fSKUCategory04'=>array('asc'=>'fSKUCategory04','desc'=>'fSKUCategory04 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory04')),
		'fSKUCategory05'=>array('asc'=>'fSKUCategory05','desc'=>'fSKUCategory05 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory05')),
		'fSKUCategory06'=>array('asc'=>'fSKUCategory06','desc'=>'fSKUCategory06 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory06')),
		'fSKUCategory07'=>array('asc'=>'fSKUCategory07','desc'=>'fSKUCategory07 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory07')),
		'fSKUCategory08'=>array('asc'=>'fSKUCategory08','desc'=>'fSKUCategory08 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory08')),
		'fSKUCategory09'=>array('asc'=>'fSKUCategory09','desc'=>'fSKUCategory09 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory09')),
		'fSKUCategory10'=>array('asc'=>'fSKUCategory10','desc'=>'fSKUCategory10 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory10')),
		'fUserDef01'=>array('asc'=>'fUserDef01','desc'=>'fUserDef01 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef01')),
		'fUserDef02'=>array('asc'=>'fUserDef02','desc'=>'fUserDef02 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef02')),
		'fUserDef03'=>array('asc'=>'fUserDef03','desc'=>'fUserDef03 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef03')),
		'fUserDef04'=>array('asc'=>'fUserDef04','desc'=>'fUserDef04 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef04')),
		'fUserDef05'=>array('asc'=>'fUserDef05','desc'=>'fUserDef05 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef05')),
		'fUserDef06'=>array('asc'=>'fUserDef06','desc'=>'fUserDef06 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef06')),
		'fUserDef07'=>array('asc'=>'fUserDef07','desc'=>'fUserDef07 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef07')),
		'fUserDef08'=>array('asc'=>'fUserDef08','desc'=>'fUserDef08 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef08')),
		'fUserDef09'=>array('asc'=>'fUserDef09','desc'=>'fUserDef09 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef09')),
		'fUserDef10'=>array('asc'=>'fUserDef10','desc'=>'fUserDef10 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef10')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUpdateDate')),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='fReleaseOrderKey';
        $sort->applyOrder($criteria);

        // find all
        $models=WmsReleaseorderdetail::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fReleaseOrderKey)),
		 array('content'=>CHtml::encode($model->fReleaseOrderLineNO)),
		 array('content'=>CHtml::encode($model->fWarehouseCode)),
		 array('content'=>CHtml::encode($model->fCustomerLineNO)),
		 array('content'=>CHtml::encode($model->fStorerSKUCode)),
		 array('content'=>CHtml::encode($model->fSKUDescription)),
		/*
		 array('content'=>CHtml::encode($model->fAlternateSKUCode)),
		 array('content'=>CHtml::encode($model->fAlternateSKUDesc)),
		 array('content'=>CHtml::encode($model->fPackCode)),
		 array('content'=>CHtml::encode($model->fUnitCode)),
		 array('content'=>CHtml::encode($model->fOrderedQty)),
		 array('content'=>CHtml::encode($model->fAdjustedQty)),
		 array('content'=>CHtml::encode($model->fAllocatedQty)),
		 array('content'=>CHtml::encode($model->fPickedQty)),
		 array('content'=>CHtml::encode($model->fShippedQty)),
		 array('content'=>CHtml::encode($model->fAllocateStatusCode)),
		 array('content'=>CHtml::encode($model->fPickStatusCode)),
		 array('content'=>CHtml::encode($model->fOutboundStatusCode)),
		 array('content'=>CHtml::encode($model->fPrice)),
		 array('content'=>CHtml::encode($model->fCurrencyCode)),
		 array('content'=>CHtml::encode($model->fSerialNO)),
		 array('content'=>CHtml::encode($model->fSourcePOKey)),
		 array('content'=>CHtml::encode($model->fSourcePOLineNO)),
		 array('content'=>CHtml::encode($model->fOriginalCountry)),
		 array('content'=>CHtml::encode($model->fMAWB)),
		 array('content'=>CHtml::encode($model->fHAWB)),
		 array('content'=>CHtml::encode($model->fGrossWGT)),
		 array('content'=>CHtml::encode($model->fNetWGT)),
		 array('content'=>CHtml::encode($model->fCube)),
		 array('content'=>CHtml::encode($model->fUnitNetWGT)),
		 array('content'=>CHtml::encode($model->fUnitCube)),
		 array('content'=>CHtml::encode($model->fCartonCount)),
		 array('content'=>CHtml::encode($model->fCartonNO)),
		 array('content'=>CHtml::encode($model->fCommand)),
		 array('content'=>CHtml::encode($model->fLotAttribute01)),
		 array('content'=>CHtml::encode($model->fLotAttribute02)),
		 array('content'=>CHtml::encode($model->fLotAttribute03)),
		 array('content'=>CHtml::encode($model->fLotAttribute04)),
		 array('content'=>CHtml::encode($model->fLotAttribute05)),
		 array('content'=>CHtml::encode($model->fLotAttribute06)),
		 array('content'=>CHtml::encode($model->fLotAttribute07)),
		 array('content'=>CHtml::encode($model->fLotAttribute08)),
		 array('content'=>CHtml::encode($model->fLotAttribute09)),
		 array('content'=>CHtml::encode($model->fLotAttribute10)),
		 array('content'=>CHtml::encode($model->fSKUCategory01)),
		 array('content'=>CHtml::encode($model->fSKUCategory02)),
		 array('content'=>CHtml::encode($model->fSKUCategory03)),
		 array('content'=>CHtml::encode($model->fSKUCategory04)),
		 array('content'=>CHtml::encode($model->fSKUCategory05)),
		 array('content'=>CHtml::encode($model->fSKUCategory06)),
		 array('content'=>CHtml::encode($model->fSKUCategory07)),
		 array('content'=>CHtml::encode($model->fSKUCategory08)),
		 array('content'=>CHtml::encode($model->fSKUCategory09)),
		 array('content'=>CHtml::encode($model->fSKUCategory10)),
		 array('content'=>CHtml::encode($model->fUserDef01)),
		 array('content'=>CHtml::encode($model->fUserDef02)),
		 array('content'=>CHtml::encode($model->fUserDef03)),
		 array('content'=>CHtml::encode($model->fUserDef04)),
		 array('content'=>CHtml::encode($model->fUserDef05)),
		 array('content'=>CHtml::encode($model->fUserDef06)),
		 array('content'=>CHtml::encode($model->fUserDef07)),
		 array('content'=>CHtml::encode($model->fUserDef08)),
		 array('content'=>CHtml::encode($model->fUserDef09)),
		 array('content'=>CHtml::encode($model->fUserDef10)),
		 array('content'=>CHtml::encode($model->fCreateUser)),
		 array('content'=>CHtml::encode($model->fCreateDate)),
		 array('content'=>CHtml::encode($model->fUpdateUser)),
		 array('content'=>CHtml::encode($model->fUpdateDate)),
		*/
            );
        }	
		
		$model=new WmsReleaseorderdetail;
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
						'fReleaseOrderKey'=>WmsReleaseorderdetail::model()->getAttributeLabel('fReleaseOrderKey'),
		'fReleaseOrderLineNO'=>WmsReleaseorderdetail::model()->getAttributeLabel('fReleaseOrderLineNO'),
		'fWarehouseCode'=>WmsReleaseorderdetail::model()->getAttributeLabel('fWarehouseCode'),
		'fCustomerLineNO'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCustomerLineNO'),
		'fStorerSKUCode'=>WmsReleaseorderdetail::model()->getAttributeLabel('fStorerSKUCode'),
		'fSKUDescription'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUDescription'),
		/*
		'fAlternateSKUCode'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAlternateSKUCode'),
		'fAlternateSKUDesc'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAlternateSKUDesc'),
		'fPackCode'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPackCode'),
		'fUnitCode'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUnitCode'),
		'fOrderedQty'=>WmsReleaseorderdetail::model()->getAttributeLabel('fOrderedQty'),
		'fAdjustedQty'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAdjustedQty'),
		'fAllocatedQty'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAllocatedQty'),
		'fPickedQty'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPickedQty'),
		'fShippedQty'=>WmsReleaseorderdetail::model()->getAttributeLabel('fShippedQty'),
		'fAllocateStatusCode'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAllocateStatusCode'),
		'fPickStatusCode'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPickStatusCode'),
		'fOutboundStatusCode'=>WmsReleaseorderdetail::model()->getAttributeLabel('fOutboundStatusCode'),
		'fPrice'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPrice'),
		'fCurrencyCode'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCurrencyCode'),
		'fSerialNO'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSerialNO'),
		'fSourcePOKey'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSourcePOKey'),
		'fSourcePOLineNO'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSourcePOLineNO'),
		'fOriginalCountry'=>WmsReleaseorderdetail::model()->getAttributeLabel('fOriginalCountry'),
		'fMAWB'=>WmsReleaseorderdetail::model()->getAttributeLabel('fMAWB'),
		'fHAWB'=>WmsReleaseorderdetail::model()->getAttributeLabel('fHAWB'),
		'fGrossWGT'=>WmsReleaseorderdetail::model()->getAttributeLabel('fGrossWGT'),
		'fNetWGT'=>WmsReleaseorderdetail::model()->getAttributeLabel('fNetWGT'),
		'fCube'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCube'),
		'fUnitNetWGT'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUnitNetWGT'),
		'fUnitCube'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUnitCube'),
		'fCartonCount'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCartonCount'),
		'fCartonNO'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCartonNO'),
		'fCommand'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCommand'),
		'fLotAttribute01'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute01'),
		'fLotAttribute02'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute02'),
		'fLotAttribute03'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute03'),
		'fLotAttribute04'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute04'),
		'fLotAttribute05'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute05'),
		'fLotAttribute06'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute06'),
		'fLotAttribute07'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute07'),
		'fLotAttribute08'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute08'),
		'fLotAttribute09'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute09'),
		'fLotAttribute10'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute10'),
		'fSKUCategory01'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory01'),
		'fSKUCategory02'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory02'),
		'fSKUCategory03'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory03'),
		'fSKUCategory04'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory04'),
		'fSKUCategory05'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory05'),
		'fSKUCategory06'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory06'),
		'fSKUCategory07'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory07'),
		'fSKUCategory08'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory08'),
		'fSKUCategory09'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory09'),
		'fSKUCategory10'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory10'),
		'fUserDef01'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef01'),
		'fUserDef02'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef02'),
		'fUserDef03'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef03'),
		'fUserDef04'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef04'),
		'fUserDef05'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef05'),
		'fUserDef06'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef06'),
		'fUserDef07'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef07'),
		'fUserDef08'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef08'),
		'fUserDef09'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef09'),
		'fUserDef10'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef10'),
		'fCreateUser'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCreateUser'),
		'fCreateDate'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCreateDate'),
		'fUpdateUser'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUpdateUser'),
		'fUpdateDate'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUpdateDate'),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUpdateDate')),
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
        
		$pages=new CPagination(WmsReleaseorderdetail::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('WmsReleaseorderdetail');
		
        $sort->attributes=array(
           		'fReleaseOrderKey'=>array('asc'=>'fReleaseOrderKey','desc'=>'fReleaseOrderKey desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fReleaseOrderKey')),
		'fReleaseOrderLineNO'=>array('asc'=>'fReleaseOrderLineNO','desc'=>'fReleaseOrderLineNO desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fReleaseOrderLineNO')),
		'fWarehouseCode'=>array('asc'=>'fWarehouseCode','desc'=>'fWarehouseCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fWarehouseCode')),
		'fCustomerLineNO'=>array('asc'=>'fCustomerLineNO','desc'=>'fCustomerLineNO desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCustomerLineNO')),
		'fStorerSKUCode'=>array('asc'=>'fStorerSKUCode','desc'=>'fStorerSKUCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fStorerSKUCode')),
		'fSKUDescription'=>array('asc'=>'fSKUDescription','desc'=>'fSKUDescription desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUDescription')),
		/*
		'fAlternateSKUCode'=>array('asc'=>'fAlternateSKUCode','desc'=>'fAlternateSKUCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAlternateSKUCode')),
		'fAlternateSKUDesc'=>array('asc'=>'fAlternateSKUDesc','desc'=>'fAlternateSKUDesc desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAlternateSKUDesc')),
		'fPackCode'=>array('asc'=>'fPackCode','desc'=>'fPackCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPackCode')),
		'fUnitCode'=>array('asc'=>'fUnitCode','desc'=>'fUnitCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUnitCode')),
		'fOrderedQty'=>array('asc'=>'fOrderedQty','desc'=>'fOrderedQty desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fOrderedQty')),
		'fAdjustedQty'=>array('asc'=>'fAdjustedQty','desc'=>'fAdjustedQty desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAdjustedQty')),
		'fAllocatedQty'=>array('asc'=>'fAllocatedQty','desc'=>'fAllocatedQty desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAllocatedQty')),
		'fPickedQty'=>array('asc'=>'fPickedQty','desc'=>'fPickedQty desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPickedQty')),
		'fShippedQty'=>array('asc'=>'fShippedQty','desc'=>'fShippedQty desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fShippedQty')),
		'fAllocateStatusCode'=>array('asc'=>'fAllocateStatusCode','desc'=>'fAllocateStatusCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fAllocateStatusCode')),
		'fPickStatusCode'=>array('asc'=>'fPickStatusCode','desc'=>'fPickStatusCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPickStatusCode')),
		'fOutboundStatusCode'=>array('asc'=>'fOutboundStatusCode','desc'=>'fOutboundStatusCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fOutboundStatusCode')),
		'fPrice'=>array('asc'=>'fPrice','desc'=>'fPrice desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fPrice')),
		'fCurrencyCode'=>array('asc'=>'fCurrencyCode','desc'=>'fCurrencyCode desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCurrencyCode')),
		'fSerialNO'=>array('asc'=>'fSerialNO','desc'=>'fSerialNO desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSerialNO')),
		'fSourcePOKey'=>array('asc'=>'fSourcePOKey','desc'=>'fSourcePOKey desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSourcePOKey')),
		'fSourcePOLineNO'=>array('asc'=>'fSourcePOLineNO','desc'=>'fSourcePOLineNO desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSourcePOLineNO')),
		'fOriginalCountry'=>array('asc'=>'fOriginalCountry','desc'=>'fOriginalCountry desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fOriginalCountry')),
		'fMAWB'=>array('asc'=>'fMAWB','desc'=>'fMAWB desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fMAWB')),
		'fHAWB'=>array('asc'=>'fHAWB','desc'=>'fHAWB desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fHAWB')),
		'fGrossWGT'=>array('asc'=>'fGrossWGT','desc'=>'fGrossWGT desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fGrossWGT')),
		'fNetWGT'=>array('asc'=>'fNetWGT','desc'=>'fNetWGT desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fNetWGT')),
		'fCube'=>array('asc'=>'fCube','desc'=>'fCube desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCube')),
		'fUnitNetWGT'=>array('asc'=>'fUnitNetWGT','desc'=>'fUnitNetWGT desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUnitNetWGT')),
		'fUnitCube'=>array('asc'=>'fUnitCube','desc'=>'fUnitCube desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUnitCube')),
		'fCartonCount'=>array('asc'=>'fCartonCount','desc'=>'fCartonCount desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCartonCount')),
		'fCartonNO'=>array('asc'=>'fCartonNO','desc'=>'fCartonNO desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCartonNO')),
		'fCommand'=>array('asc'=>'fCommand','desc'=>'fCommand desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCommand')),
		'fLotAttribute01'=>array('asc'=>'fLotAttribute01','desc'=>'fLotAttribute01 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute01')),
		'fLotAttribute02'=>array('asc'=>'fLotAttribute02','desc'=>'fLotAttribute02 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute02')),
		'fLotAttribute03'=>array('asc'=>'fLotAttribute03','desc'=>'fLotAttribute03 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute03')),
		'fLotAttribute04'=>array('asc'=>'fLotAttribute04','desc'=>'fLotAttribute04 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute04')),
		'fLotAttribute05'=>array('asc'=>'fLotAttribute05','desc'=>'fLotAttribute05 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute05')),
		'fLotAttribute06'=>array('asc'=>'fLotAttribute06','desc'=>'fLotAttribute06 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute06')),
		'fLotAttribute07'=>array('asc'=>'fLotAttribute07','desc'=>'fLotAttribute07 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute07')),
		'fLotAttribute08'=>array('asc'=>'fLotAttribute08','desc'=>'fLotAttribute08 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute08')),
		'fLotAttribute09'=>array('asc'=>'fLotAttribute09','desc'=>'fLotAttribute09 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute09')),
		'fLotAttribute10'=>array('asc'=>'fLotAttribute10','desc'=>'fLotAttribute10 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fLotAttribute10')),
		'fSKUCategory01'=>array('asc'=>'fSKUCategory01','desc'=>'fSKUCategory01 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory01')),
		'fSKUCategory02'=>array('asc'=>'fSKUCategory02','desc'=>'fSKUCategory02 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory02')),
		'fSKUCategory03'=>array('asc'=>'fSKUCategory03','desc'=>'fSKUCategory03 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory03')),
		'fSKUCategory04'=>array('asc'=>'fSKUCategory04','desc'=>'fSKUCategory04 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory04')),
		'fSKUCategory05'=>array('asc'=>'fSKUCategory05','desc'=>'fSKUCategory05 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory05')),
		'fSKUCategory06'=>array('asc'=>'fSKUCategory06','desc'=>'fSKUCategory06 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory06')),
		'fSKUCategory07'=>array('asc'=>'fSKUCategory07','desc'=>'fSKUCategory07 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory07')),
		'fSKUCategory08'=>array('asc'=>'fSKUCategory08','desc'=>'fSKUCategory08 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory08')),
		'fSKUCategory09'=>array('asc'=>'fSKUCategory09','desc'=>'fSKUCategory09 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory09')),
		'fSKUCategory10'=>array('asc'=>'fSKUCategory10','desc'=>'fSKUCategory10 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fSKUCategory10')),
		'fUserDef01'=>array('asc'=>'fUserDef01','desc'=>'fUserDef01 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef01')),
		'fUserDef02'=>array('asc'=>'fUserDef02','desc'=>'fUserDef02 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef02')),
		'fUserDef03'=>array('asc'=>'fUserDef03','desc'=>'fUserDef03 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef03')),
		'fUserDef04'=>array('asc'=>'fUserDef04','desc'=>'fUserDef04 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef04')),
		'fUserDef05'=>array('asc'=>'fUserDef05','desc'=>'fUserDef05 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef05')),
		'fUserDef06'=>array('asc'=>'fUserDef06','desc'=>'fUserDef06 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef06')),
		'fUserDef07'=>array('asc'=>'fUserDef07','desc'=>'fUserDef07 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef07')),
		'fUserDef08'=>array('asc'=>'fUserDef08','desc'=>'fUserDef08 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef08')),
		'fUserDef09'=>array('asc'=>'fUserDef09','desc'=>'fUserDef09 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef09')),
		'fUserDef10'=>array('asc'=>'fUserDef10','desc'=>'fUserDef10 desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUserDef10')),
		'fCreateUser'=>array('asc'=>'fCreateUser','desc'=>'fCreateUser desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCreateUser')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fCreateDate')),
		'fUpdateUser'=>array('asc'=>'fUpdateUser','desc'=>'fUpdateUser desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUpdateUser')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUpdateDate')),
		*/'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>WmsReleaseorderdetail::model()->getAttributeLabel('fUpdateDate')),
        );
        $sort->defaultOrder='fReleaseOrderKey';
        $sort->applyOrder($criteria);

        // find all
        $models=WmsReleaseorderdetail::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                		 'fReleaseOrderKey'=>$model->fReleaseOrderKey,
						'cell'=>array(CHtml::encode($model->fReleaseOrderKey).(Yii::app()->user->checkAccess('oreder.oreder/wmsReleaseorderdetail.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fReleaseOrderKey),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('oreder.oreder/wmsReleaseorderdetail.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fReleaseOrderKey),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('oreder.oreder/wmsReleaseorderdetail.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fReleaseOrderKey),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fReleaseOrderLineNO),
		 CHtml::encode($model->fWarehouseCode),
		 CHtml::encode($model->fCustomerLineNO),
		 CHtml::encode($model->fStorerSKUCode),
		 CHtml::encode($model->fSKUDescription),
		 CHtml::encode($model->fAlternateSKUCode),
		 CHtml::encode($model->fAlternateSKUDesc),
		 CHtml::encode($model->fPackCode),
		 CHtml::encode($model->fUnitCode),
		 CHtml::encode($model->fOrderedQty),
		 CHtml::encode($model->fAdjustedQty),
		 CHtml::encode($model->fAllocatedQty),
		 CHtml::encode($model->fPickedQty),
		 CHtml::encode($model->fShippedQty),
		 CHtml::encode($model->fAllocateStatusCode),
		 CHtml::encode($model->fPickStatusCode),
		 CHtml::encode($model->fOutboundStatusCode),
		 CHtml::encode($model->fPrice),
		 CHtml::encode($model->fCurrencyCode),
		 CHtml::encode($model->fSerialNO),
		 CHtml::encode($model->fSourcePOKey),
		 CHtml::encode($model->fSourcePOLineNO),
		 CHtml::encode($model->fOriginalCountry),
		 CHtml::encode($model->fMAWB),
		 CHtml::encode($model->fHAWB),
		 CHtml::encode($model->fGrossWGT),
		 CHtml::encode($model->fNetWGT),
		 CHtml::encode($model->fCube),
		 CHtml::encode($model->fUnitNetWGT),
		 CHtml::encode($model->fUnitCube),
		 CHtml::encode($model->fCartonCount),
		 CHtml::encode($model->fCartonNO),
		 CHtml::encode($model->fCommand),
		 CHtml::encode($model->fLotAttribute01),
		 CHtml::encode($model->fLotAttribute02),
		 CHtml::encode($model->fLotAttribute03),
		 CHtml::encode($model->fLotAttribute04),
		 CHtml::encode($model->fLotAttribute05),
		 CHtml::encode($model->fLotAttribute06),
		 CHtml::encode($model->fLotAttribute07),
		 CHtml::encode($model->fLotAttribute08),
		 CHtml::encode($model->fLotAttribute09),
		 CHtml::encode($model->fLotAttribute10),
		 CHtml::encode($model->fSKUCategory01),
		 CHtml::encode($model->fSKUCategory02),
		 CHtml::encode($model->fSKUCategory03),
		 CHtml::encode($model->fSKUCategory04),
		 CHtml::encode($model->fSKUCategory05),
		 CHtml::encode($model->fSKUCategory06),
		 CHtml::encode($model->fSKUCategory07),
		 CHtml::encode($model->fSKUCategory08),
		 CHtml::encode($model->fSKUCategory09),
		 CHtml::encode($model->fSKUCategory10),
		 CHtml::encode($model->fUserDef01),
		 CHtml::encode($model->fUserDef02),
		 CHtml::encode($model->fUserDef03),
		 CHtml::encode($model->fUserDef04),
		 CHtml::encode($model->fUserDef05),
		 CHtml::encode($model->fUserDef06),
		 CHtml::encode($model->fUserDef07),
		 CHtml::encode($model->fUserDef08),
		 CHtml::encode($model->fUserDef09),
		 CHtml::encode($model->fUserDef10),
		 CHtml::encode($model->fCreateUser),
		 CHtml::encode($model->fCreateDate),
		 CHtml::encode($model->fUpdateUser),
		 CHtml::encode($model->fUpdateDate),
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
		$model=WmsReleaseorderdetail::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='wms-releaseorderdetail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
