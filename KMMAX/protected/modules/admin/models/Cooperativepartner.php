<?php

/**
 * This is the model class for table "{{cooperativepartner}}".
 *
 * The followings are the available columns in table '{{cooperativepartner}}':
 * @property string $fCooperativePartnerID
 * @property string $fCooperativeCompanyID
 * @property string $fPartnerName
 * @property string $fPartnerPassword
 * @property string $fRole
 * @property string $fBirthday
 * @property string $fPosition
 * @property integer $fSex
 * @property string $fCellphone
 * @property string $fEmail
 * @property string $fEducationalLevel
 * @property string $fHomeAddress
 * @property string $fPhoto
 * @property string $fQq
 * @property string $fMemo
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 * @property string $fUserGroup
 */
class Cooperativepartner extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cooperativepartner the static model class
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
		return '{{cooperativepartner}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fCooperativePartnerID, fSex,fCooperativeCompanyID, fPartnerName, fPartnerPassword, fRole, fBirthday, fPosition, fCellphone, fEmail, fEducationalLevel, fHomeAddress, fPhoto, fQq, fCreateUser, fUpdateUser, fUserGroup', 'length', 'max'=>50),
			array('fMemo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fCooperativePartnerID, fCooperativeCompanyID, fPartnerName, fPartnerPassword, fRole, fBirthday, fPosition, fSex, fCellphone, fEmail, fEducationalLevel, fHomeAddress, fPhoto, fQq, fMemo, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate, fUserGroup', 'safe', 'on'=>'search'),
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
				'company' => array(self::HAS_ONE, 'cooperativecompany', '','on' => 't.fCooperativeCompanyID=company.fCooperativeCompanyID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fCooperativePartnerID' => Yii::t('model','F Cooperative Partner'),
			'fCooperativeCompanyID' => Yii::t('model','F Cooperative Company'),
			'fPartnerName' => Yii::t('model','F Partner Name'),
			'fPartnerPassword' => Yii::t('model','F Partner Password'),
			'fRole' => Yii::t('model','F Role'),
			'fBirthday' => Yii::t('model','F Birthday'),
			'fPosition' => Yii::t('model','F Position'),
			'fSex' => Yii::t('model','F Sex'),
			'fCellphone' => Yii::t('model','F Cellphone'),
			'fEmail' => Yii::t('model','F Email'),
			'fEducationalLevel' => Yii::t('model','F Educational Level'),
			'fHomeAddress' => Yii::t('model','F Home Address'),
			'fPhoto' => Yii::t('model','F Photo'),
			'fQq' => Yii::t('model','F Qq'),
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

		$criteria->compare('fCooperativePartnerID',$this->fCooperativePartnerID,true);
		$criteria->compare('fCooperativeCompanyID',$this->fCooperativeCompanyID,true);
		$criteria->compare('fPartnerName',$this->fPartnerName,true);
		$criteria->compare('fPartnerPassword',$this->fPartnerPassword,true);
		$criteria->compare('fRole',$this->fRole,true);
		$criteria->compare('fBirthday',$this->fBirthday,true);
		$criteria->compare('fPosition',$this->fPosition,true);
		$criteria->compare('fSex',$this->fSex);
		$criteria->compare('fCellphone',$this->fCellphone,true);
		$criteria->compare('fEmail',$this->fEmail,true);
		$criteria->compare('fEducationalLevel',$this->fEducationalLevel,true);
		$criteria->compare('fHomeAddress',$this->fHomeAddress,true);
		$criteria->compare('fPhoto',$this->fPhoto,true);
		$criteria->compare('fQq',$this->fQq,true);
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