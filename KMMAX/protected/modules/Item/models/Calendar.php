<?php

/**
 * This is the model class for table "{{calendar}}".
 *
 * The followings are the available columns in table '{{calendar}}':
 * @property string $fCalendarNo
 * @property string $fUserName
 * @property integer $fStartTime
 * @property integer $fEndTime
 * @property string $fOtherNo
 * @property string $fTheme
 * @property string $fContent
 * @property string $fMemo
 * @property string $fIsItem
 * @property string $fStatus
 * @property string $fCreateUser
 * @property integer $fCreateDate
 */
class Calendar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Calendar the static model class
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
		return '{{calendar}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fCalendarNo', 'required'),
			array('fStartTime, fEndTime, fCreateDate', 'numerical', 'integerOnly'=>true),
			array('fCalendarNo, fUserName, fOtherNo, fStatus, fCreateUser', 'length', 'max'=>50),
			array('fTheme', 'length', 'max'=>200),
			array('fContent', 'length', 'max'=>2000),
			array('fIsItem', 'length', 'max'=>20),
			array('fMemo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fCalendarNo, fUserName, fStartTime, fEndTime, fOtherNo, fTheme, fContent, fMemo, fIsItem, fStatus, fCreateUser, fCreateDate', 'safe', 'on'=>'search'),
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
			'fCalendarNo' => Yii::t('model','F Calendar No'),
			'fUserName' => Yii::t('model','F User Name'),
			'fStartTime' => Yii::t('model','F Start Time'),
			'fEndTime' => Yii::t('model','F End Time'),
			'fOtherNo' => Yii::t('model','F Other No'),
			'fTheme' => Yii::t('model','F Theme'),
			'fContent' => Yii::t('model','F Content'),
			'fMemo' => Yii::t('model','F Memo'),
			'fIsItem' => Yii::t('model','F Is Item'),
			'fStatus' => Yii::t('model','F Status'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
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

		$criteria->compare('fCalendarNo',$this->fCalendarNo,true);
		$criteria->compare('fUserName',$this->fUserName,true);
		$criteria->compare('fStartTime',$this->fStartTime);
		$criteria->compare('fEndTime',$this->fEndTime);
		$criteria->compare('fOtherNo',$this->fOtherNo,true);
		$criteria->compare('fTheme',$this->fTheme,true);
		$criteria->compare('fContent',$this->fContent,true);
		$criteria->compare('fMemo',$this->fMemo,true);
		$criteria->compare('fIsItem',$this->fIsItem,true);
		$criteria->compare('fStatus',$this->fStatus,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}