<?php

/**
 * This is the model class for table "{{module}}".
 *
 * The followings are the available columns in table '{{module}}':
 * @property string $fModuleID
 * @property string $fModuleName
 * @property string $fModuleTitle
 * @property integer $fIsVisible
 * @property integer $fSearchable
 * @property string $FCustom
 * @property integer $fCreateDate
 * @property string $fCreateUser
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 */
class Modules extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Modules the static model class
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
		return '{{module}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fModuleID', 'required'),
			array('fIsVisible, fSearchable, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fModuleID, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fModuleName, fModuleTitle', 'length', 'max'=>100),
			array('FCustom', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fModuleID, fModuleName, fModuleTitle, fIsVisible, fSearchable, FCustom, fCreateDate, fCreateUser, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
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
			'fModuleID' => Yii::t('model','F Module'),
			'fModuleName' => Yii::t('model','F Module Name'),
			'fModuleTitle' => Yii::t('model','F Module Title'),
			'fIsVisible' => Yii::t('model','F Is Visible'),
			'fSearchable' => Yii::t('model','F Searchable'),
			'FCustom' => Yii::t('model','Fcustom'),
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

		$criteria->compare('fModuleID',$this->fModuleID,true);
		$criteria->compare('fModuleName',$this->fModuleName,true);
		$criteria->compare('fModuleTitle',$this->fModuleTitle,true);
		$criteria->compare('fIsVisible',$this->fIsVisible);
		$criteria->compare('fSearchable',$this->fSearchable);
		$criteria->compare('FCustom',$this->FCustom,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}