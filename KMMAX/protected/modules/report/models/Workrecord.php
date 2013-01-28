<?php

/**
 * This is the model class for table "{{workrecord}}".
 *
 * The followings are the available columns in table '{{workrecord}}':
 * @property string $fRecordNo
 * @property string $fRecordUser
 * @property integer $fRecordDate
 * @property string $fPlan
 * @property string $fResult
 * @property string $fSummary
 * @property string $fEvaluate
 * @property string $fMemo
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 */
class Workrecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Workrecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{workrecord}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fRecordNo', 'required'),
			array('fRecordDate, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fRecordNo, fRecordUser, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fPlan, fResult, fSummary, fEvaluate, fMemo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fRecordNo, fRecordUser, fRecordDate, fPlan, fResult, fSummary, fEvaluate, fMemo, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fRecordNo' => Yii::t('model','F Record No'),
			'fRecordUser' => Yii::t('model','F Record User'),
			'fRecordDate' => Yii::t('model','F Record Date'),
			'fPlan' => Yii::t('model','F Plan'),
			'fResult' => Yii::t('model','F Result'),
			'fSummary' => Yii::t('model','F Summary'),
			'fEvaluate' => Yii::t('model','F Evaluate'),
			'fMemo' => Yii::t('model','F Memo'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('fRecordNo',$this->fRecordNo,true);
		$criteria->compare('fRecordUser',$this->fRecordUser,true);
		$criteria->compare('fRecordDate',$this->fRecordDate);
		$criteria->compare('fPlan',$this->fPlan,true);
		$criteria->compare('fResult',$this->fResult,true);
		$criteria->compare('fSummary',$this->fSummary,true);
		$criteria->compare('fEvaluate',$this->fEvaluate,true);
		$criteria->compare('fMemo',$this->fMemo,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}