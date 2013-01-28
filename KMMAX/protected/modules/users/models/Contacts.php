<?php

/**
 * This is the model class for table "{{contacts}}".
 *
 * The followings are the available columns in table '{{contacts}}':
 * @property string $fContactID
 * @property string $fContactName
 * @property string $fFristName
 * @property string $fLastName
 * @property string $fContactTitle
 * @property string $fCompany
 * @property string $fPhone
 * @property string $fPhone2
 * @property string $fEmail
 * @property string $fWebsite
 * @property string $fAddress
 * @property string $fAddress2
 * @property string $fCity
 * @property string $fState
 * @property string $fZipCode
 * @property string $fCountry
 * @property integer $fVisibility
 * @property string $fAssignedTo
 * @property string $fBackGroundInfo
 * @property integer $fQQ
 * @property string $fLinkedIn
 * @property string $fMSN
 * @property integer $fCreateDate
 * @property string $fCreateUser
 * @property integer $fUpdateDate
 * @property string $fUpadateUser
 *
 * The followings are the available model relations:
 * @property User[] $tblUsers
 */
class Contacts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contacts the static model class
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
		return '{{contacts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fContactID, fFristName, fLastName', 'required'),
			array('fVisibility, fQQ, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fContactID, fFristName, fLastName, fCreateUser, fUpadateUser', 'length', 'max'=>50),
			array('fContactName, fEmail, fLinkedIn, fMSN', 'length', 'max'=>100),
			array('fContactTitle, fCompany, fWebsite, fAddress, fAddress2', 'length', 'max'=>200),
			array('fPhone, fPhone2, fZipCode, fAssignedTo', 'length', 'max'=>20),
			array('fCity, fState, fCountry', 'length', 'max'=>40),
			array('fBackGroundInfo', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fContactID, fContactName, fFristName, fLastName, fContactTitle, fCompany, fPhone, fPhone2, fEmail, fWebsite, fAddress, fAddress2, fCity, fState, fZipCode, fCountry, fVisibility, fAssignedTo, fBackGroundInfo, fQQ, fLinkedIn, fMSN, fCreateDate, fCreateUser, fUpdateDate, fUpadateUser', 'safe', 'on'=>'search'),
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
			'tblUsers' => array(self::MANY_MANY, 'User', '{{usercontact}}(fContactID, fUserID)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fContactID' => Yii::t('model','F Contact'),
			'fContactName' => Yii::t('model','F Contact Name'),
			'fFristName' => Yii::t('model','F Frist Name'),
			'fLastName' => Yii::t('model','F Last Name'),
			'fContactTitle' => Yii::t('model','F Contact Title'),
			'fCompany' => Yii::t('model','F Company'),
			'fPhone' => Yii::t('model','F Phone'),
			'fPhone2' => Yii::t('model','F Phone2'),
			'fEmail' => Yii::t('model','F Email'),
			'fWebsite' => Yii::t('model','F Website'),
			'fAddress' => Yii::t('model','F Address'),
			'fAddress2' => Yii::t('model','F Address2'),
			'fCity' => Yii::t('model','F City'),
			'fState' => Yii::t('model','F State'),
			'fZipCode' => Yii::t('model','F Zip Code'),
			'fCountry' => Yii::t('model','F Country'),
			'fVisibility' => Yii::t('model','F Visibility'),
			'fAssignedTo' => Yii::t('model','F Assigned To'),
			'fBackGroundInfo' => Yii::t('model','F Back Ground Info'),
			'fQQ' => Yii::t('model','F Qq'),
			'fLinkedIn' => Yii::t('model','F Linked In'),
			'fMSN' => Yii::t('model','F Msn'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fUpadateUser' => Yii::t('model','F Upadate User'),
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

		$criteria->compare('fContactID',$this->fContactID,true);
		$criteria->compare('fContactName',$this->fContactName,true);
		$criteria->compare('fFristName',$this->fFristName,true);
		$criteria->compare('fLastName',$this->fLastName,true);
		$criteria->compare('fContactTitle',$this->fContactTitle,true);
		$criteria->compare('fCompany',$this->fCompany,true);
		$criteria->compare('fPhone',$this->fPhone,true);
		$criteria->compare('fPhone2',$this->fPhone2,true);
		$criteria->compare('fEmail',$this->fEmail,true);
		$criteria->compare('fWebsite',$this->fWebsite,true);
		$criteria->compare('fAddress',$this->fAddress,true);
		$criteria->compare('fAddress2',$this->fAddress2,true);
		$criteria->compare('fCity',$this->fCity,true);
		$criteria->compare('fState',$this->fState,true);
		$criteria->compare('fZipCode',$this->fZipCode,true);
		$criteria->compare('fCountry',$this->fCountry,true);
		$criteria->compare('fVisibility',$this->fVisibility);
		$criteria->compare('fAssignedTo',$this->fAssignedTo,true);
		$criteria->compare('fBackGroundInfo',$this->fBackGroundInfo,true);
		$criteria->compare('fQQ',$this->fQQ);
		$criteria->compare('fLinkedIn',$this->fLinkedIn,true);
		$criteria->compare('fMSN',$this->fMSN,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fUpadateUser',$this->fUpadateUser,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}