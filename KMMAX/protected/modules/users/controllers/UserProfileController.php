<?php

class UserProfileController extends AppController
{
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
	 * record user search and
	 */
	public function actionCreate()
	{
		$fUserID = Yii::app()->user->getState('Username');
		$fModelName = $_POST['modulename'];
		$fDataGridColumn = $_POST['columnsState'];
		$fQueryCondition = $_POST['myColumnStateName'];
		$fCreateDate = time();		
		$model=UserProfile::model()->find('fUserID="'.$fUserID.'"');		
		if($model->fUserID == $fUserID && $model->fModelName == $fModelName)
		{
			//update data
			$model->fDataGridColumn = $fDataGridColumn;
			$model->fQueryCondition = $fQueryCondition;
			$model->fUpdateDate = $fCreateDate;
			$model->fUpdateUser = $fUserID;
			$model->save(false);
		}else{
			//create data
			$model->fUserID = $fUserID;
			$model->fModelName = $fModelName;
			$model->fDataGridColumn = $fDataGridColumn;
			$model->fQueryCondition = $fQueryCondition;
			$model->fCreateUser = $fUserID;
			$model->fCreateDate = $fCreateDate;
			$model->save(false);
		}
	}
}
