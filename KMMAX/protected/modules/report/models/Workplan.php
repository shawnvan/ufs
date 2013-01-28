<?php

/**
 * This is the model class for table "{{workplan}}".
 *
 * The followings are the available columns in table '{{workplan}}':
 * @property string $fPlanNo
 * @property string $fTitle
 * @property string $fMonth
 * @property string $fUpPlan
 * @property string $fNowPlan
 * @property string $fMemo
 * @property integer $fCreateDate
 * @property string $fCreateUser
 * @property integer $fUpdateDate
 * @property string $fUpdateUser
 */
class Workplan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Workplan the static model class
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
		return '{{workplan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fPlanNo', 'required'),
			array('fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fPlanNo, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fTitle', 'length', 'max'=>200),
			array('fMonth', 'length', 'max'=>2),
			array('fUpPlan, fNowPlan, fMemo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fPlanNo, fTitle, fMonth, fUpPlan, fNowPlan, fMemo, fCreateDate, fCreateUser, fUpdateDate, fUpdateUser', 'safe', 'on'=>'search'),
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
			'fPlanNo' => Yii::t('model','F Plan No'),
			'fTitle' => Yii::t('model','F Title'),
			'fMonth' => Yii::t('model','F Month'),
			'fUpPlan' => Yii::t('model','F Up Plan'),
			'fNowPlan' => Yii::t('model','F Now Plan'),
			'fMemo' => Yii::t('model','F Memo'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
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

		$criteria->compare('fPlanNo',$this->fPlanNo,true);
		$criteria->compare('fTitle',$this->fTitle,true);
		$criteria->compare('fMonth',$this->fMonth,true);
		$criteria->compare('fUpPlan',$this->fUpPlan,true);
		$criteria->compare('fNowPlan',$this->fNowPlan,true);
		$criteria->compare('fMemo',$this->fMemo,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}