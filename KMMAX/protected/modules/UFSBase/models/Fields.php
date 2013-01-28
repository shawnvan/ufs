<?php

/**
 * This is the model class for table "{{fields}}".
 *
 * The followings are the available columns in table '{{fields}}':
 * @property string $fFieldID
 * @property string $fModelName
 * @property string $fFieldName
 * @property string $fAttributeLabel
 * @property integer $fModified
 * @property integer $fCustom
 * @property string $fType
 * @property integer $fRequired
 * @property integer $fReadOnly
 * @property string $fLinkType
 * @property integer $fSearchable
 * @property string $fRelevance
 * @property integer $fIsVirtual
 * @property integer $fCreateDate
 * @property string $fCreateUser
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 */
class Fields extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fields the static model class
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
		return '{{fields}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fFieldID', 'required'),
			array('fModified, fCustom, fRequired, fReadOnly, fSearchable, fIsVirtual, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fFieldID, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fModelName, fFieldName', 'length', 'max'=>100),
			array('fAttributeLabel', 'length', 'max'=>200),
			array('fType', 'length', 'max'=>20),
			array('fLinkType, fRelevance', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fFieldID, fModelName, fFieldName, fAttributeLabel, fModified, fCustom, fType, fRequired, fReadOnly, fLinkType, fSearchable, fRelevance, fIsVirtual, fCreateDate, fCreateUser, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
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
			'fFieldID' => Yii::t('model','F Field'),
			'fModelName' => Yii::t('model','F Model Name'),
			'fFieldName' => Yii::t('model','F Field Name'),
			'fAttributeLabel' => Yii::t('model','F Attribute Label'),
			'fModified' => Yii::t('model','F Modified'),
			'fCustom' => Yii::t('model','F Custom'),
			'fType' => Yii::t('model','F Type'),
			'fRequired' => Yii::t('model','F Required'),
			'fReadOnly' => Yii::t('model','F Read Only'),
			'fLinkType' => Yii::t('model','F Link Type'),
			'fSearchable' => Yii::t('model','F Searchable'),
			'fRelevance' => Yii::t('model','F Relevance'),
			'fIsVirtual' => Yii::t('model','F Is Virtual'),
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

		$criteria->compare('fFieldID',$this->fFieldID,true);
		$criteria->compare('fModelName',$this->fModelName,true);
		$criteria->compare('fFieldName',$this->fFieldName,true);
		$criteria->compare('fAttributeLabel',$this->fAttributeLabel,true);
		$criteria->compare('fModified',$this->fModified);
		$criteria->compare('fCustom',$this->fCustom);
		$criteria->compare('fType',$this->fType,true);
		$criteria->compare('fRequired',$this->fRequired);
		$criteria->compare('fReadOnly',$this->fReadOnly);
		$criteria->compare('fLinkType',$this->fLinkType,true);
		$criteria->compare('fSearchable',$this->fSearchable);
		$criteria->compare('fRelevance',$this->fRelevance,true);
		$criteria->compare('fIsVirtual',$this->fIsVirtual);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}