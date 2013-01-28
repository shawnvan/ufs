<?php

/**
 * This is the model class for table "{{cooperativecompany}}".
 *
 * The followings are the available columns in table '{{cooperativecompany}}':
 * @property string $fCooperativeCompanyID
 * @property string $fCooperativeCompanyName
 * @property string $fCooperativeCompanyShortName
 * @property string $fStarLevel
 * @property string $fType
 * @property string $fKeyContacts
 * @property string $fCity
 * @property string $fIndustry
 * @property string $fDownIndustry
 * @property string $fOnIndustry
 * @property string $fMainProduct
 * @property string $fWebSite
 * @property string $fZipCode
 * @property string $fMaintenanceEmployee
 * @property string $fMemo
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 * @property string $fUserGroup
 */
class Cooperativecompany extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cooperativecompany the static model class
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
		return '{{cooperativecompany}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fCooperativeCompanyID,fCooperativeCompanyName', 'required'),
			array('fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fCooperativeCompanyID, fCooperativeCompanyShortName, fStarLevel, fType, fKeyContacts, fZipCode, fMaintenanceEmployee, fCreateUser, fUpdateUser, fUserGroup', 'length', 'max'=>50),
			array('fCooperativeCompanyName, fCity, fIndustry, fDownIndustry, fOnIndustry, fWebSite', 'length', 'max'=>200),
			array('fMainProduct', 'length', 'max'=>500),
			array('fMemo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fCooperativeCompanyID, fCooperativeCompanyName, fCooperativeCompanyShortName, fStarLevel, fType, fKeyContacts, fCity, fIndustry, fDownIndustry, fOnIndustry, fMainProduct, fWebSite, fZipCode, fMaintenanceEmployee, fMemo, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate, fUserGroup', 'safe', 'on'=>'search'),
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
			'fCooperativeCompanyID' => Yii::t('model','F Cooperative Company'),
			'fCooperativeCompanyName' => Yii::t('model','F Cooperative Company Name'),
			'fCooperativeCompanyShortName' => Yii::t('model','F Cooperative Company Short Name'),
			'fStarLevel' => Yii::t('model','F Star Level'),
			'fType' => Yii::t('model','F Type'),
			'fKeyContacts' => Yii::t('model','F Key Contacts'),
			'fCity' => Yii::t('model','F City'),
			'fIndustry' => Yii::t('model','F Industry'),
			'fDownIndustry' => Yii::t('model','F Down Industry'),
			'fOnIndustry' => Yii::t('model','F On Industry'),
			'fMainProduct' => Yii::t('model','F Main Product'),
			'fWebSite' => Yii::t('model','F Web Site'),
			'fZipCode' => Yii::t('model','F Zip Code'),
			'fMaintenanceEmployee' => Yii::t('model','F Maintenance Employee'),
			'fMemo' => Yii::t('model','F Memo'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fUserGroup' => Yii::t('model','F User Group'),
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

		$criteria->compare('fCooperativeCompanyID',$this->fCooperativeCompanyID,true);
		$criteria->compare('fCooperativeCompanyName',$this->fCooperativeCompanyName,true);
		$criteria->compare('fCooperativeCompanyShortName',$this->fCooperativeCompanyShortName,true);
		$criteria->compare('fStarLevel',$this->fStarLevel,true);
		$criteria->compare('fType',$this->fType,true);
		$criteria->compare('fKeyContacts',$this->fKeyContacts,true);
		$criteria->compare('fCity',$this->fCity,true);
		$criteria->compare('fIndustry',$this->fIndustry,true);
		$criteria->compare('fDownIndustry',$this->fDownIndustry,true);
		$criteria->compare('fOnIndustry',$this->fOnIndustry,true);
		$criteria->compare('fMainProduct',$this->fMainProduct,true);
		$criteria->compare('fWebSite',$this->fWebSite,true);
		$criteria->compare('fZipCode',$this->fZipCode,true);
		$criteria->compare('fMaintenanceEmployee',$this->fMaintenanceEmployee,true);
		$criteria->compare('fMemo',$this->fMemo,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fUserGroup',$this->fUserGroup,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}