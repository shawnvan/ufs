<?php

class CalendarController extends AppController
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

		$model=new Calendar;
		if(isset($_POST['Calendar']))
		{
			$model->attributes=$_POST['Calendar'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fCalendarNo));
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

		if(isset($_POST['Calendar']))
		{
			$model->attributes=$_POST['Calendar'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fCalendarNo));
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

		if(isset($_POST['Calendar']))
		{
			$createmodel=new Calendar;
			$createmodel->attributes=$_POST['Calendar'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel->fCalendarNo));
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
		$model=new Calendar('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Calendar']))
			$model->attributes=$_GET['Calendar'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
     * Grid of all models.
     */
    public function actionIndex()
    {
		$id=isset($_GET['id'])?$_GET['id']:'';
		$item=Item::model()->findByPk($id);
		
		if($item->fStatus==0){
			$this->redirect($this->createUrl('item/update/id/'.$item->fItemNo));
			return;
		}
		$calenders=Calendar::model()->findAllByAttributes(array('fOtherNo'=>$id));
		$formate_str='{id:\'%s\',title: \'%s\',start: \'%s\',end: \'%s\',content: \'%s\',memo: \'%s\',allDay: false},';
		$tempStr='';
		foreach($calenders as $calender)
		{
			$tempStr=$tempStr.sprintf($formate_str,$calender->fCalendarNo,$calender->fTheme
					,date('Y-m-d H:i',$calender->fStartTime),date('Y-m-d H:i',$calender->fEndTime),$calender->fContent,$calender->fMemo);
		}
		
		$calender_str='['.$tempStr.']';
		$calender=new Calendar();
		$this->render('index',array(
				'calender'=>$calender,'calender_str'=>$calender_str,'keyid'=>$id
		));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Calendar::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='calendar-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * 添加新的哦提醒
	 */
	public function actionInsert($id){
		$calendar=new Calendar();
		$calendar->fCalendarNo=GuidUtil::getUuid();
		$calendar->fUserName=Yii::app()->params->loginuser->fUserName;
		$calendar->fOtherNo=$id;
		$calendar->fTheme=isset($_POST['title'])?$_POST['title']:'';
		$calendar->fContent=isset($_POST['content'])?$_POST['content']:'';
		$calendar->fMemo=isset($_POST['memo'])?$_POST['memo']:'';
		$calendar->fStartTime=strtotime($_POST['start']);
		$calendar->fEndTime=strtotime($_POST['end']);
		$calendar->fIsItem='ItemUse_Yes';
		$calendar->fStatus='Y';
		$calendar->fCreateUser=Yii::app()->params->loginuser->fUserName;
		$calendar->fCreateDate=time();
		$calendar->save();
	}
}
