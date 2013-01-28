<?php

/**
 * This is the model class for table "{{notify}}".
 *
 * The followings are the available columns in table '{{notify}}':
 * @property string $fNotifyID
 * @property string $fType
 * @property string $fComparison
 * @property string $fValue
 * @property string $fModelType
 * @property string $fModelID
 * @property string $fFieldName
 * @property string $fUserName
 * @property string $fUserID
 * @property string $fCreatedBy
 * @property integer $fViewed
 * @property integer $fCreateDate
 * @property string $fCreateUser
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 */
class Notification extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notification the static model class
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
		return '{{notify}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fNotifyID', 'required'),
			array('fViewed, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fNotifyID, fModelID, fUserID, fCreatedBy, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fType', 'length', 'max'=>20),
			array('fValue, fModelType, fFieldName', 'length', 'max'=>250),
			array('fUserName', 'length', 'max'=>60),
			array('fComparison', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fNotifyID, fType, fComparison, fValue, fModelType, fModelID, fFieldName, fUserName, fUserID, fCreatedBy, fViewed, fCreateDate, fCreateUser, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
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
			'fNotifyID' => Yii::t('model','F Notify'),
			'fType' => Yii::t('model','F Type'),
			'fComparison' => Yii::t('model','F Comparison'),
			'fValue' => Yii::t('model','F Value'),
			'fModelType' => Yii::t('model','F Model Type'),
			'fModelID' => Yii::t('model','F Model'),
			'fFieldName' => Yii::t('model','F Field Name'),
			'fUserName' => Yii::t('model','F User Name'),
			'fUserID' => Yii::t('model','F User'),
			'fCreatedBy' => Yii::t('model','F Created By'),
			'fViewed' => Yii::t('model','F Viewed'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fCreateUser' => Yii::t('model','F Create User'),
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

		$criteria->compare('fNotifyID',$this->fNotifyID,true);
		$criteria->compare('fType',$this->fType,true);
		$criteria->compare('fComparison',$this->fComparison,true);
		$criteria->compare('fValue',$this->fValue,true);
		$criteria->compare('fModelType',$this->fModelType,true);
		$criteria->compare('fModelID',$this->fModelID,true);
		$criteria->compare('fFieldName',$this->fFieldName,true);
		$criteria->compare('fUserName',$this->fUserName,true);
		$criteria->compare('fUserID',$this->fUserID,true);
		$criteria->compare('fCreatedBy',$this->fCreatedBy,true);
		$criteria->compare('fViewed',$this->fViewed);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}