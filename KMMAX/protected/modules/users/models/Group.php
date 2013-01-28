<?php

/**
 * This is the model class for table "{{group}}".
 *
 * The followings are the available columns in table '{{group}}':
 * @property string $fGroupID
 * @property string $fGroupName
 * @property string $fDescription
 * @property integer $fCreateDate
 * @property string $fCreateUser
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 *
 * The followings are the available model relations:
 * @property Groupuser[] $groupusers
 */
class Group extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Group the static model class
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
		return '{{group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fGroupID', 'required'),
			array('fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fGroupID, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fGroupName', 'length', 'max'=>100),
			array('fDescription', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fGroupID, fGroupName, fDescription, fCreateDate, fCreateUser, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
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
			'groupusers' => array(self::HAS_MANY, 'Groupuser', 'fGroupID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fGroupID' => Yii::t('model','F Group'),
			'fGroupName' => Yii::t('model','F Group Name'),
			'fDescription' => Yii::t('model','F Description'),
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

		$criteria->compare('fGroupID',$this->fGroupID,true);
		$criteria->compare('fGroupName',$this->fGroupName,true);
		$criteria->compare('fDescription',$this->fDescription,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}