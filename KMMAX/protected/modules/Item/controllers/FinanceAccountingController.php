<?php

class FinanceaccountingController extends AppController
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

		$model=new Financeaccounting;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Financeaccounting']))
		{
			$model->attributes=$_POST['Financeaccounting'];
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
		$model=FinanceAccounting::model()->findByPk($id);
        if($model==null) $model=new Financeaccounting();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Financeaccounting']))
		{
			$model->attributes=$_POST['Financeaccounting'];
			$model->fItemNo=$id;
			$transaction = Yii::app()->db->beginTransaction();
			try {
				$model->save();
				$item=Item::model()->findByPk($model->fItemNo);
				$item->fStatus=1;
				$item->fUpdateUser=Yii::app()->params->loginuser->fUserName;
				$item->fUpdateDate=time();
				$item->save();
				$transaction->commit();
				$this->redirect($this->createUrl('item/view/id/'.$model->fItemNo));
				//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
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

		if(isset($_POST['Financeaccounting']))
		{
			$createmodel=new Financeaccounting;
			$createmodel->attributes=$_POST['Financeaccounting'];
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
		$model=new Financeaccounting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Financeaccounting']))
			$model->attributes=$_GET['Financeaccounting'];

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

        $pages=new CPagination(Financeaccounting::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('Financeaccounting');//排序，参考YII文档CSort
        $sort->attributes=array(
        			'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Financeaccounting::model()->getAttributeLabel('fItemNo')),
		'fPropertyAll1'=>array('asc'=>'fPropertyAll1','desc'=>'fPropertyAll1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyAll1')),
		'fPropertyIncrease1'=>array('asc'=>'fPropertyIncrease1','desc'=>'fPropertyIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyIncrease1')),
		'fDebtAll1'=>array('asc'=>'fDebtAll1','desc'=>'fDebtAll1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtAll1')),
		'fDebtIncrease1'=>array('asc'=>'fDebtIncrease1','desc'=>'fDebtIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtIncrease1')),
		'fShareholderRights1'=>array('asc'=>'fShareholderRights1','desc'=>'fShareholderRights1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRights1')),
		/*
		'fShareholderRightsIncrease1'=>array('asc'=>'fShareholderRightsIncrease1','desc'=>'fShareholderRightsIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRightsIncrease1')),
		'fPropertyDebt1'=>array('asc'=>'fPropertyDebt1','desc'=>'fPropertyDebt1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebt1')),
		'fPropertyDebtIncrease1'=>array('asc'=>'fPropertyDebtIncrease1','desc'=>'fPropertyDebtIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebtIncrease1')),
		'fBusinessReceipt1'=>array('asc'=>'fBusinessReceipt1','desc'=>'fBusinessReceipt1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceipt1')),
		'fBusinessReceiptIncrease1'=>array('asc'=>'fBusinessReceiptIncrease1','desc'=>'fBusinessReceiptIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceiptIncrease1')),
		'fClearProfit1'=>array('asc'=>'fClearProfit1','desc'=>'fClearProfit1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfit1')),
		'fClearProfitIncrease1'=>array('asc'=>'fClearProfitIncrease1','desc'=>'fClearProfitIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfitIncrease1')),
		'fPerStockProfit1'=>array('asc'=>'fPerStockProfit1','desc'=>'fPerStockProfit1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfit1')),
		'fPerStockProfitIncrease1'=>array('asc'=>'fPerStockProfitIncrease1','desc'=>'fPerStockProfitIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfitIncrease1')),
		'fPerStockIncome1'=>array('asc'=>'fPerStockIncome1','desc'=>'fPerStockIncome1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncome1')),
		'fPerStockIncomeIncrease1'=>array('asc'=>'fPerStockIncomeIncrease1','desc'=>'fPerStockIncomeIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncomeIncrease1')),
		'fFreeCash1'=>array('asc'=>'fFreeCash1','desc'=>'fFreeCash1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCash1')),
		'fFreeCashIncrease1'=>array('asc'=>'fFreeCashIncrease1','desc'=>'fFreeCashIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCashIncrease1')),
		'fPropertyAll2'=>array('asc'=>'fPropertyAll2','desc'=>'fPropertyAll2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyAll2')),
		'fPropertyIncrease2'=>array('asc'=>'fPropertyIncrease2','desc'=>'fPropertyIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyIncrease2')),
		'fDebtAll2'=>array('asc'=>'fDebtAll2','desc'=>'fDebtAll2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtAll2')),
		'fDebtIncrease2'=>array('asc'=>'fDebtIncrease2','desc'=>'fDebtIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtIncrease2')),
		'fShareholderRights2'=>array('asc'=>'fShareholderRights2','desc'=>'fShareholderRights2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRights2')),
		'fShareholderRightsIncrease2'=>array('asc'=>'fShareholderRightsIncrease2','desc'=>'fShareholderRightsIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRightsIncrease2')),
		'fPropertyDebt2'=>array('asc'=>'fPropertyDebt2','desc'=>'fPropertyDebt2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebt2')),
		'fPropertyDebtIncrease2'=>array('asc'=>'fPropertyDebtIncrease2','desc'=>'fPropertyDebtIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebtIncrease2')),
		'fBusinessReceipt2'=>array('asc'=>'fBusinessReceipt2','desc'=>'fBusinessReceipt2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceipt2')),
		'fBusinessReceiptIncrease2'=>array('asc'=>'fBusinessReceiptIncrease2','desc'=>'fBusinessReceiptIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceiptIncrease2')),
		'fClearProfit2'=>array('asc'=>'fClearProfit2','desc'=>'fClearProfit2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfit2')),
		'fClearProfitIncrease2'=>array('asc'=>'fClearProfitIncrease2','desc'=>'fClearProfitIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfitIncrease2')),
		'fPerStockProfit2'=>array('asc'=>'fPerStockProfit2','desc'=>'fPerStockProfit2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfit2')),
		'fPerStockProfitIncrease2'=>array('asc'=>'fPerStockProfitIncrease2','desc'=>'fPerStockProfitIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfitIncrease2')),
		'fPerStockIncome2'=>array('asc'=>'fPerStockIncome2','desc'=>'fPerStockIncome2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncome2')),
		'fPerStockIncomeIncrease2'=>array('asc'=>'fPerStockIncomeIncrease2','desc'=>'fPerStockIncomeIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncomeIncrease2')),
		'fFreeCash2'=>array('asc'=>'fFreeCash2','desc'=>'fFreeCash2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCash2')),
		'fFreeCashIncrease2'=>array('asc'=>'fFreeCashIncrease2','desc'=>'fFreeCashIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCashIncrease2')),
		'fPropertyAll3'=>array('asc'=>'fPropertyAll3','desc'=>'fPropertyAll3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyAll3')),
		'fPropertyIncrease3'=>array('asc'=>'fPropertyIncrease3','desc'=>'fPropertyIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyIncrease3')),
		'fDebtAll3'=>array('asc'=>'fDebtAll3','desc'=>'fDebtAll3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtAll3')),
		'fDebtIncrease3'=>array('asc'=>'fDebtIncrease3','desc'=>'fDebtIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtIncrease3')),
		'fShareholderRights3'=>array('asc'=>'fShareholderRights3','desc'=>'fShareholderRights3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRights3')),
		'fShareholderRightsIncrease3'=>array('asc'=>'fShareholderRightsIncrease3','desc'=>'fShareholderRightsIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRightsIncrease3')),
		'fPropertyDebt3'=>array('asc'=>'fPropertyDebt3','desc'=>'fPropertyDebt3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebt3')),
		'fPropertyDebtIncrease3'=>array('asc'=>'fPropertyDebtIncrease3','desc'=>'fPropertyDebtIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebtIncrease3')),
		'fBusinessReceipt3'=>array('asc'=>'fBusinessReceipt3','desc'=>'fBusinessReceipt3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceipt3')),
		'fBusinessReceiptIncrease3'=>array('asc'=>'fBusinessReceiptIncrease3','desc'=>'fBusinessReceiptIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceiptIncrease3')),
		'fClearProfit3'=>array('asc'=>'fClearProfit3','desc'=>'fClearProfit3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfit3')),
		'fClearProfitIncrease3'=>array('asc'=>'fClearProfitIncrease3','desc'=>'fClearProfitIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfitIncrease3')),
		'fPerStockProfit3'=>array('asc'=>'fPerStockProfit3','desc'=>'fPerStockProfit3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfit3')),
		'fPerStockProfitIncrease3'=>array('asc'=>'fPerStockProfitIncrease3','desc'=>'fPerStockProfitIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfitIncrease3')),
		'fPerStockIncome3'=>array('asc'=>'fPerStockIncome3','desc'=>'fPerStockIncome3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncome3')),
		'fPerStockIncomeIncrease3'=>array('asc'=>'fPerStockIncomeIncrease3','desc'=>'fPerStockIncomeIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncomeIncrease3')),
		'fFreeCash3'=>array('asc'=>'fFreeCash3','desc'=>'fFreeCash3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCash3')),
		'fFreeCashIncrease3'=>array('asc'=>'fFreeCashIncrease3','desc'=>'fFreeCashIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCashIncrease3')),
		'fAuditOpinion1'=>array('asc'=>'fAuditOpinion1','desc'=>'fAuditOpinion1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAuditOpinion1')),
		'fAuditOpinion2'=>array('asc'=>'fAuditOpinion2','desc'=>'fAuditOpinion2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAuditOpinion2')),
		'fAuditOpinion3'=>array('asc'=>'fAuditOpinion3','desc'=>'fAuditOpinion3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAuditOpinion3')),
		'fInvisiblePropertyRate'=>array('asc'=>'fInvisiblePropertyRate','desc'=>'fInvisiblePropertyRate desc','label'=>Financeaccounting::model()->getAttributeLabel('fInvisiblePropertyRate')),
		'fFinanceAnalyse'=>array('asc'=>'fFinanceAnalyse','desc'=>'fFinanceAnalyse desc','label'=>Financeaccounting::model()->getAttributeLabel('fFinanceAnalyse')),
		'fAffixName1'=>array('asc'=>'fAffixName1','desc'=>'fAffixName1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixName1')),
		'fAffixAddress1'=>array('asc'=>'fAffixAddress1','desc'=>'fAffixAddress1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress1')),
		'fAffixName2'=>array('asc'=>'fAffixName2','desc'=>'fAffixName2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixName2')),
		'fAffixAddress2'=>array('asc'=>'fAffixAddress2','desc'=>'fAffixAddress2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress2')),
		'fAffixName3'=>array('asc'=>'fAffixName3','desc'=>'fAffixName3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixName3')),
		'fAffixAddress3'=>array('asc'=>'fAffixAddress3','desc'=>'fAffixAddress3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress3')),
		*/'fAffixAddress3'=>array('asc'=>'fAffixAddress3','desc'=>'fAffixAddress3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress3')),
        );
        $sort->defaultOrder='fItemNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Financeaccounting::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            			 array('content'=>CHtml::encode($model->fItemNo)),
		 array('content'=>CHtml::encode($model->fPropertyAll1)),
		 array('content'=>CHtml::encode($model->fPropertyIncrease1)),
		 array('content'=>CHtml::encode($model->fDebtAll1)),
		 array('content'=>CHtml::encode($model->fDebtIncrease1)),
		 array('content'=>CHtml::encode($model->fShareholderRights1)),
		/*
		 array('content'=>CHtml::encode($model->fShareholderRightsIncrease1)),
		 array('content'=>CHtml::encode($model->fPropertyDebt1)),
		 array('content'=>CHtml::encode($model->fPropertyDebtIncrease1)),
		 array('content'=>CHtml::encode($model->fBusinessReceipt1)),
		 array('content'=>CHtml::encode($model->fBusinessReceiptIncrease1)),
		 array('content'=>CHtml::encode($model->fClearProfit1)),
		 array('content'=>CHtml::encode($model->fClearProfitIncrease1)),
		 array('content'=>CHtml::encode($model->fPerStockProfit1)),
		 array('content'=>CHtml::encode($model->fPerStockProfitIncrease1)),
		 array('content'=>CHtml::encode($model->fPerStockIncome1)),
		 array('content'=>CHtml::encode($model->fPerStockIncomeIncrease1)),
		 array('content'=>CHtml::encode($model->fFreeCash1)),
		 array('content'=>CHtml::encode($model->fFreeCashIncrease1)),
		 array('content'=>CHtml::encode($model->fPropertyAll2)),
		 array('content'=>CHtml::encode($model->fPropertyIncrease2)),
		 array('content'=>CHtml::encode($model->fDebtAll2)),
		 array('content'=>CHtml::encode($model->fDebtIncrease2)),
		 array('content'=>CHtml::encode($model->fShareholderRights2)),
		 array('content'=>CHtml::encode($model->fShareholderRightsIncrease2)),
		 array('content'=>CHtml::encode($model->fPropertyDebt2)),
		 array('content'=>CHtml::encode($model->fPropertyDebtIncrease2)),
		 array('content'=>CHtml::encode($model->fBusinessReceipt2)),
		 array('content'=>CHtml::encode($model->fBusinessReceiptIncrease2)),
		 array('content'=>CHtml::encode($model->fClearProfit2)),
		 array('content'=>CHtml::encode($model->fClearProfitIncrease2)),
		 array('content'=>CHtml::encode($model->fPerStockProfit2)),
		 array('content'=>CHtml::encode($model->fPerStockProfitIncrease2)),
		 array('content'=>CHtml::encode($model->fPerStockIncome2)),
		 array('content'=>CHtml::encode($model->fPerStockIncomeIncrease2)),
		 array('content'=>CHtml::encode($model->fFreeCash2)),
		 array('content'=>CHtml::encode($model->fFreeCashIncrease2)),
		 array('content'=>CHtml::encode($model->fPropertyAll3)),
		 array('content'=>CHtml::encode($model->fPropertyIncrease3)),
		 array('content'=>CHtml::encode($model->fDebtAll3)),
		 array('content'=>CHtml::encode($model->fDebtIncrease3)),
		 array('content'=>CHtml::encode($model->fShareholderRights3)),
		 array('content'=>CHtml::encode($model->fShareholderRightsIncrease3)),
		 array('content'=>CHtml::encode($model->fPropertyDebt3)),
		 array('content'=>CHtml::encode($model->fPropertyDebtIncrease3)),
		 array('content'=>CHtml::encode($model->fBusinessReceipt3)),
		 array('content'=>CHtml::encode($model->fBusinessReceiptIncrease3)),
		 array('content'=>CHtml::encode($model->fClearProfit3)),
		 array('content'=>CHtml::encode($model->fClearProfitIncrease3)),
		 array('content'=>CHtml::encode($model->fPerStockProfit3)),
		 array('content'=>CHtml::encode($model->fPerStockProfitIncrease3)),
		 array('content'=>CHtml::encode($model->fPerStockIncome3)),
		 array('content'=>CHtml::encode($model->fPerStockIncomeIncrease3)),
		 array('content'=>CHtml::encode($model->fFreeCash3)),
		 array('content'=>CHtml::encode($model->fFreeCashIncrease3)),
		 array('content'=>CHtml::encode($model->fAuditOpinion1)),
		 array('content'=>CHtml::encode($model->fAuditOpinion2)),
		 array('content'=>CHtml::encode($model->fAuditOpinion3)),
		 array('content'=>CHtml::encode($model->fInvisiblePropertyRate)),
		 array('content'=>CHtml::encode($model->fFinanceAnalyse)),
		 array('content'=>CHtml::encode($model->fAffixName1)),
		 array('content'=>CHtml::encode($model->fAffixAddress1)),
		 array('content'=>CHtml::encode($model->fAffixName2)),
		 array('content'=>CHtml::encode($model->fAffixAddress2)),
		 array('content'=>CHtml::encode($model->fAffixName3)),
		 array('content'=>CHtml::encode($model->fAffixAddress3)),
		*/
            );
        }	
		
		$model=new Financeaccounting;
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
						'fItemNo'=>Financeaccounting::model()->getAttributeLabel('fItemNo'),
		'fPropertyAll1'=>Financeaccounting::model()->getAttributeLabel('fPropertyAll1'),
		'fPropertyIncrease1'=>Financeaccounting::model()->getAttributeLabel('fPropertyIncrease1'),
		'fDebtAll1'=>Financeaccounting::model()->getAttributeLabel('fDebtAll1'),
		'fDebtIncrease1'=>Financeaccounting::model()->getAttributeLabel('fDebtIncrease1'),
		'fShareholderRights1'=>Financeaccounting::model()->getAttributeLabel('fShareholderRights1'),
		/*
		'fShareholderRightsIncrease1'=>Financeaccounting::model()->getAttributeLabel('fShareholderRightsIncrease1'),
		'fPropertyDebt1'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebt1'),
		'fPropertyDebtIncrease1'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebtIncrease1'),
		'fBusinessReceipt1'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceipt1'),
		'fBusinessReceiptIncrease1'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceiptIncrease1'),
		'fClearProfit1'=>Financeaccounting::model()->getAttributeLabel('fClearProfit1'),
		'fClearProfitIncrease1'=>Financeaccounting::model()->getAttributeLabel('fClearProfitIncrease1'),
		'fPerStockProfit1'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfit1'),
		'fPerStockProfitIncrease1'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfitIncrease1'),
		'fPerStockIncome1'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncome1'),
		'fPerStockIncomeIncrease1'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncomeIncrease1'),
		'fFreeCash1'=>Financeaccounting::model()->getAttributeLabel('fFreeCash1'),
		'fFreeCashIncrease1'=>Financeaccounting::model()->getAttributeLabel('fFreeCashIncrease1'),
		'fPropertyAll2'=>Financeaccounting::model()->getAttributeLabel('fPropertyAll2'),
		'fPropertyIncrease2'=>Financeaccounting::model()->getAttributeLabel('fPropertyIncrease2'),
		'fDebtAll2'=>Financeaccounting::model()->getAttributeLabel('fDebtAll2'),
		'fDebtIncrease2'=>Financeaccounting::model()->getAttributeLabel('fDebtIncrease2'),
		'fShareholderRights2'=>Financeaccounting::model()->getAttributeLabel('fShareholderRights2'),
		'fShareholderRightsIncrease2'=>Financeaccounting::model()->getAttributeLabel('fShareholderRightsIncrease2'),
		'fPropertyDebt2'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebt2'),
		'fPropertyDebtIncrease2'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebtIncrease2'),
		'fBusinessReceipt2'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceipt2'),
		'fBusinessReceiptIncrease2'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceiptIncrease2'),
		'fClearProfit2'=>Financeaccounting::model()->getAttributeLabel('fClearProfit2'),
		'fClearProfitIncrease2'=>Financeaccounting::model()->getAttributeLabel('fClearProfitIncrease2'),
		'fPerStockProfit2'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfit2'),
		'fPerStockProfitIncrease2'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfitIncrease2'),
		'fPerStockIncome2'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncome2'),
		'fPerStockIncomeIncrease2'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncomeIncrease2'),
		'fFreeCash2'=>Financeaccounting::model()->getAttributeLabel('fFreeCash2'),
		'fFreeCashIncrease2'=>Financeaccounting::model()->getAttributeLabel('fFreeCashIncrease2'),
		'fPropertyAll3'=>Financeaccounting::model()->getAttributeLabel('fPropertyAll3'),
		'fPropertyIncrease3'=>Financeaccounting::model()->getAttributeLabel('fPropertyIncrease3'),
		'fDebtAll3'=>Financeaccounting::model()->getAttributeLabel('fDebtAll3'),
		'fDebtIncrease3'=>Financeaccounting::model()->getAttributeLabel('fDebtIncrease3'),
		'fShareholderRights3'=>Financeaccounting::model()->getAttributeLabel('fShareholderRights3'),
		'fShareholderRightsIncrease3'=>Financeaccounting::model()->getAttributeLabel('fShareholderRightsIncrease3'),
		'fPropertyDebt3'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebt3'),
		'fPropertyDebtIncrease3'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebtIncrease3'),
		'fBusinessReceipt3'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceipt3'),
		'fBusinessReceiptIncrease3'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceiptIncrease3'),
		'fClearProfit3'=>Financeaccounting::model()->getAttributeLabel('fClearProfit3'),
		'fClearProfitIncrease3'=>Financeaccounting::model()->getAttributeLabel('fClearProfitIncrease3'),
		'fPerStockProfit3'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfit3'),
		'fPerStockProfitIncrease3'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfitIncrease3'),
		'fPerStockIncome3'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncome3'),
		'fPerStockIncomeIncrease3'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncomeIncrease3'),
		'fFreeCash3'=>Financeaccounting::model()->getAttributeLabel('fFreeCash3'),
		'fFreeCashIncrease3'=>Financeaccounting::model()->getAttributeLabel('fFreeCashIncrease3'),
		'fAuditOpinion1'=>Financeaccounting::model()->getAttributeLabel('fAuditOpinion1'),
		'fAuditOpinion2'=>Financeaccounting::model()->getAttributeLabel('fAuditOpinion2'),
		'fAuditOpinion3'=>Financeaccounting::model()->getAttributeLabel('fAuditOpinion3'),
		'fInvisiblePropertyRate'=>Financeaccounting::model()->getAttributeLabel('fInvisiblePropertyRate'),
		'fFinanceAnalyse'=>Financeaccounting::model()->getAttributeLabel('fFinanceAnalyse'),
		'fAffixName1'=>Financeaccounting::model()->getAttributeLabel('fAffixName1'),
		'fAffixAddress1'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress1'),
		'fAffixName2'=>Financeaccounting::model()->getAttributeLabel('fAffixName2'),
		'fAffixAddress2'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress2'),
		'fAffixName3'=>Financeaccounting::model()->getAttributeLabel('fAffixName3'),
		'fAffixAddress3'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress3'),
		*/'fAffixAddress3'=>array('asc'=>'fAffixAddress3','desc'=>'fAffixAddress3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress3')),
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
        
		$pages=new CPagination(Financeaccounting::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Financeaccounting');
		
        $sort->attributes=array(
           		'fItemNo'=>array('asc'=>'fItemNo','desc'=>'fItemNo desc','label'=>Financeaccounting::model()->getAttributeLabel('fItemNo')),
		'fPropertyAll1'=>array('asc'=>'fPropertyAll1','desc'=>'fPropertyAll1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyAll1')),
		'fPropertyIncrease1'=>array('asc'=>'fPropertyIncrease1','desc'=>'fPropertyIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyIncrease1')),
		'fDebtAll1'=>array('asc'=>'fDebtAll1','desc'=>'fDebtAll1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtAll1')),
		'fDebtIncrease1'=>array('asc'=>'fDebtIncrease1','desc'=>'fDebtIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtIncrease1')),
		'fShareholderRights1'=>array('asc'=>'fShareholderRights1','desc'=>'fShareholderRights1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRights1')),
		/*
		'fShareholderRightsIncrease1'=>array('asc'=>'fShareholderRightsIncrease1','desc'=>'fShareholderRightsIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRightsIncrease1')),
		'fPropertyDebt1'=>array('asc'=>'fPropertyDebt1','desc'=>'fPropertyDebt1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebt1')),
		'fPropertyDebtIncrease1'=>array('asc'=>'fPropertyDebtIncrease1','desc'=>'fPropertyDebtIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebtIncrease1')),
		'fBusinessReceipt1'=>array('asc'=>'fBusinessReceipt1','desc'=>'fBusinessReceipt1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceipt1')),
		'fBusinessReceiptIncrease1'=>array('asc'=>'fBusinessReceiptIncrease1','desc'=>'fBusinessReceiptIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceiptIncrease1')),
		'fClearProfit1'=>array('asc'=>'fClearProfit1','desc'=>'fClearProfit1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfit1')),
		'fClearProfitIncrease1'=>array('asc'=>'fClearProfitIncrease1','desc'=>'fClearProfitIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfitIncrease1')),
		'fPerStockProfit1'=>array('asc'=>'fPerStockProfit1','desc'=>'fPerStockProfit1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfit1')),
		'fPerStockProfitIncrease1'=>array('asc'=>'fPerStockProfitIncrease1','desc'=>'fPerStockProfitIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfitIncrease1')),
		'fPerStockIncome1'=>array('asc'=>'fPerStockIncome1','desc'=>'fPerStockIncome1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncome1')),
		'fPerStockIncomeIncrease1'=>array('asc'=>'fPerStockIncomeIncrease1','desc'=>'fPerStockIncomeIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncomeIncrease1')),
		'fFreeCash1'=>array('asc'=>'fFreeCash1','desc'=>'fFreeCash1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCash1')),
		'fFreeCashIncrease1'=>array('asc'=>'fFreeCashIncrease1','desc'=>'fFreeCashIncrease1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCashIncrease1')),
		'fPropertyAll2'=>array('asc'=>'fPropertyAll2','desc'=>'fPropertyAll2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyAll2')),
		'fPropertyIncrease2'=>array('asc'=>'fPropertyIncrease2','desc'=>'fPropertyIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyIncrease2')),
		'fDebtAll2'=>array('asc'=>'fDebtAll2','desc'=>'fDebtAll2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtAll2')),
		'fDebtIncrease2'=>array('asc'=>'fDebtIncrease2','desc'=>'fDebtIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtIncrease2')),
		'fShareholderRights2'=>array('asc'=>'fShareholderRights2','desc'=>'fShareholderRights2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRights2')),
		'fShareholderRightsIncrease2'=>array('asc'=>'fShareholderRightsIncrease2','desc'=>'fShareholderRightsIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRightsIncrease2')),
		'fPropertyDebt2'=>array('asc'=>'fPropertyDebt2','desc'=>'fPropertyDebt2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebt2')),
		'fPropertyDebtIncrease2'=>array('asc'=>'fPropertyDebtIncrease2','desc'=>'fPropertyDebtIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebtIncrease2')),
		'fBusinessReceipt2'=>array('asc'=>'fBusinessReceipt2','desc'=>'fBusinessReceipt2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceipt2')),
		'fBusinessReceiptIncrease2'=>array('asc'=>'fBusinessReceiptIncrease2','desc'=>'fBusinessReceiptIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceiptIncrease2')),
		'fClearProfit2'=>array('asc'=>'fClearProfit2','desc'=>'fClearProfit2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfit2')),
		'fClearProfitIncrease2'=>array('asc'=>'fClearProfitIncrease2','desc'=>'fClearProfitIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfitIncrease2')),
		'fPerStockProfit2'=>array('asc'=>'fPerStockProfit2','desc'=>'fPerStockProfit2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfit2')),
		'fPerStockProfitIncrease2'=>array('asc'=>'fPerStockProfitIncrease2','desc'=>'fPerStockProfitIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfitIncrease2')),
		'fPerStockIncome2'=>array('asc'=>'fPerStockIncome2','desc'=>'fPerStockIncome2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncome2')),
		'fPerStockIncomeIncrease2'=>array('asc'=>'fPerStockIncomeIncrease2','desc'=>'fPerStockIncomeIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncomeIncrease2')),
		'fFreeCash2'=>array('asc'=>'fFreeCash2','desc'=>'fFreeCash2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCash2')),
		'fFreeCashIncrease2'=>array('asc'=>'fFreeCashIncrease2','desc'=>'fFreeCashIncrease2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCashIncrease2')),
		'fPropertyAll3'=>array('asc'=>'fPropertyAll3','desc'=>'fPropertyAll3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyAll3')),
		'fPropertyIncrease3'=>array('asc'=>'fPropertyIncrease3','desc'=>'fPropertyIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyIncrease3')),
		'fDebtAll3'=>array('asc'=>'fDebtAll3','desc'=>'fDebtAll3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtAll3')),
		'fDebtIncrease3'=>array('asc'=>'fDebtIncrease3','desc'=>'fDebtIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fDebtIncrease3')),
		'fShareholderRights3'=>array('asc'=>'fShareholderRights3','desc'=>'fShareholderRights3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRights3')),
		'fShareholderRightsIncrease3'=>array('asc'=>'fShareholderRightsIncrease3','desc'=>'fShareholderRightsIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fShareholderRightsIncrease3')),
		'fPropertyDebt3'=>array('asc'=>'fPropertyDebt3','desc'=>'fPropertyDebt3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebt3')),
		'fPropertyDebtIncrease3'=>array('asc'=>'fPropertyDebtIncrease3','desc'=>'fPropertyDebtIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPropertyDebtIncrease3')),
		'fBusinessReceipt3'=>array('asc'=>'fBusinessReceipt3','desc'=>'fBusinessReceipt3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceipt3')),
		'fBusinessReceiptIncrease3'=>array('asc'=>'fBusinessReceiptIncrease3','desc'=>'fBusinessReceiptIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fBusinessReceiptIncrease3')),
		'fClearProfit3'=>array('asc'=>'fClearProfit3','desc'=>'fClearProfit3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfit3')),
		'fClearProfitIncrease3'=>array('asc'=>'fClearProfitIncrease3','desc'=>'fClearProfitIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fClearProfitIncrease3')),
		'fPerStockProfit3'=>array('asc'=>'fPerStockProfit3','desc'=>'fPerStockProfit3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfit3')),
		'fPerStockProfitIncrease3'=>array('asc'=>'fPerStockProfitIncrease3','desc'=>'fPerStockProfitIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockProfitIncrease3')),
		'fPerStockIncome3'=>array('asc'=>'fPerStockIncome3','desc'=>'fPerStockIncome3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncome3')),
		'fPerStockIncomeIncrease3'=>array('asc'=>'fPerStockIncomeIncrease3','desc'=>'fPerStockIncomeIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fPerStockIncomeIncrease3')),
		'fFreeCash3'=>array('asc'=>'fFreeCash3','desc'=>'fFreeCash3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCash3')),
		'fFreeCashIncrease3'=>array('asc'=>'fFreeCashIncrease3','desc'=>'fFreeCashIncrease3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fFreeCashIncrease3')),
		'fAuditOpinion1'=>array('asc'=>'fAuditOpinion1','desc'=>'fAuditOpinion1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAuditOpinion1')),
		'fAuditOpinion2'=>array('asc'=>'fAuditOpinion2','desc'=>'fAuditOpinion2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAuditOpinion2')),
		'fAuditOpinion3'=>array('asc'=>'fAuditOpinion3','desc'=>'fAuditOpinion3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAuditOpinion3')),
		'fInvisiblePropertyRate'=>array('asc'=>'fInvisiblePropertyRate','desc'=>'fInvisiblePropertyRate desc','label'=>Financeaccounting::model()->getAttributeLabel('fInvisiblePropertyRate')),
		'fFinanceAnalyse'=>array('asc'=>'fFinanceAnalyse','desc'=>'fFinanceAnalyse desc','label'=>Financeaccounting::model()->getAttributeLabel('fFinanceAnalyse')),
		'fAffixName1'=>array('asc'=>'fAffixName1','desc'=>'fAffixName1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixName1')),
		'fAffixAddress1'=>array('asc'=>'fAffixAddress1','desc'=>'fAffixAddress1 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress1')),
		'fAffixName2'=>array('asc'=>'fAffixName2','desc'=>'fAffixName2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixName2')),
		'fAffixAddress2'=>array('asc'=>'fAffixAddress2','desc'=>'fAffixAddress2 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress2')),
		'fAffixName3'=>array('asc'=>'fAffixName3','desc'=>'fAffixName3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixName3')),
		'fAffixAddress3'=>array('asc'=>'fAffixAddress3','desc'=>'fAffixAddress3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress3')),
		*/'fAffixAddress3'=>array('asc'=>'fAffixAddress3','desc'=>'fAffixAddress3 desc','label'=>Financeaccounting::model()->getAttributeLabel('fAffixAddress3')),
        );
        $sort->defaultOrder='fItemNo';
        $sort->applyOrder($criteria);

        // find all
        $models=Financeaccounting::model()->findAll($criteria);
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
						'cell'=>array(CHtml::encode($model->fItemNo).(Yii::app()->user->checkAccess('Item.financeaccounting.Update')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('update','id'=>$model->fItemNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                )):'').(Yii::app()->user->checkAccess('Item.financeaccounting.View')?CHtml::link("<span class='ui-icon ui-icon-zoomin'></span>",array('view','id'=>$model->fItemNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                )):'').(Yii::app()->user->checkAccess('Item.financeaccounting.Delete')?CHtml::link("<span class='ui-icon ui-icon-pencil'></span>",array('delete','id'=>$model->fItemNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                )):''),		 CHtml::encode($model->fPropertyAll1),
		 CHtml::encode($model->fPropertyIncrease1),
		 CHtml::encode($model->fDebtAll1),
		 CHtml::encode($model->fDebtIncrease1),
		 CHtml::encode($model->fShareholderRights1),
		 CHtml::encode($model->fShareholderRightsIncrease1),
		 CHtml::encode($model->fPropertyDebt1),
		 CHtml::encode($model->fPropertyDebtIncrease1),
		 CHtml::encode($model->fBusinessReceipt1),
		 CHtml::encode($model->fBusinessReceiptIncrease1),
		 CHtml::encode($model->fClearProfit1),
		 CHtml::encode($model->fClearProfitIncrease1),
		 CHtml::encode($model->fPerStockProfit1),
		 CHtml::encode($model->fPerStockProfitIncrease1),
		 CHtml::encode($model->fPerStockIncome1),
		 CHtml::encode($model->fPerStockIncomeIncrease1),
		 CHtml::encode($model->fFreeCash1),
		 CHtml::encode($model->fFreeCashIncrease1),
		 CHtml::encode($model->fPropertyAll2),
		 CHtml::encode($model->fPropertyIncrease2),
		 CHtml::encode($model->fDebtAll2),
		 CHtml::encode($model->fDebtIncrease2),
		 CHtml::encode($model->fShareholderRights2),
		 CHtml::encode($model->fShareholderRightsIncrease2),
		 CHtml::encode($model->fPropertyDebt2),
		 CHtml::encode($model->fPropertyDebtIncrease2),
		 CHtml::encode($model->fBusinessReceipt2),
		 CHtml::encode($model->fBusinessReceiptIncrease2),
		 CHtml::encode($model->fClearProfit2),
		 CHtml::encode($model->fClearProfitIncrease2),
		 CHtml::encode($model->fPerStockProfit2),
		 CHtml::encode($model->fPerStockProfitIncrease2),
		 CHtml::encode($model->fPerStockIncome2),
		 CHtml::encode($model->fPerStockIncomeIncrease2),
		 CHtml::encode($model->fFreeCash2),
		 CHtml::encode($model->fFreeCashIncrease2),
		 CHtml::encode($model->fPropertyAll3),
		 CHtml::encode($model->fPropertyIncrease3),
		 CHtml::encode($model->fDebtAll3),
		 CHtml::encode($model->fDebtIncrease3),
		 CHtml::encode($model->fShareholderRights3),
		 CHtml::encode($model->fShareholderRightsIncrease3),
		 CHtml::encode($model->fPropertyDebt3),
		 CHtml::encode($model->fPropertyDebtIncrease3),
		 CHtml::encode($model->fBusinessReceipt3),
		 CHtml::encode($model->fBusinessReceiptIncrease3),
		 CHtml::encode($model->fClearProfit3),
		 CHtml::encode($model->fClearProfitIncrease3),
		 CHtml::encode($model->fPerStockProfit3),
		 CHtml::encode($model->fPerStockProfitIncrease3),
		 CHtml::encode($model->fPerStockIncome3),
		 CHtml::encode($model->fPerStockIncomeIncrease3),
		 CHtml::encode($model->fFreeCash3),
		 CHtml::encode($model->fFreeCashIncrease3),
		 CHtml::encode($model->fAuditOpinion1),
		 CHtml::encode($model->fAuditOpinion2),
		 CHtml::encode($model->fAuditOpinion3),
		 CHtml::encode($model->fInvisiblePropertyRate),
		 CHtml::encode($model->fFinanceAnalyse),
		 CHtml::encode($model->fAffixName1),
		 CHtml::encode($model->fAffixAddress1),
		 CHtml::encode($model->fAffixName2),
		 CHtml::encode($model->fAffixAddress2),
		 CHtml::encode($model->fAffixName3),
		 CHtml::encode($model->fAffixAddress3),
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
		$model=Financeaccounting::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='financeaccounting-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
