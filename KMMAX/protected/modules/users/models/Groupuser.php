<?php

/**
 * This is the model class for table "{{groupuser}}".
 *
 * The followings are the available columns in table '{{groupuser}}':
 * @property string $fGroupUID
 * @property string $fGroupID
 * @property string $fUserID
 * @property string $fUserName
 * @property integer $fCreateDate
 * @property string $fCreateUser
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 *
 * The followings are the available model relations:
 * @property Group $fGroup
 * @property User $fUser
 */
class Groupuser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Groupuser the static model class
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
		return '{{groupuser}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fGroupUID', 'required'),
			array('fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fGroupUID, fGroupID, fUserID, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fUserName', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fGroupUID, fGroupID, fUserID, fUserName, fCreateDate, fCreateUser, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
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
			'fGroup' => array(self::BELONGS_TO, 'Group', 'fGroupID'),
			'fUser' => array(self::BELONGS_TO, 'User', 'fUserID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fGroupUID' => Yii::t('model','F Group Uid'),
			'fGroupID' => Yii::t('model','F Group'),
			'fUserID' => Yii::t('model','F User'),
			'fUserName' => Yii::t('model','F User Name'),
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

		$criteria->compare('fGroupUID',$this->fGroupUID,true);
		$criteria->compare('fGroupID',$this->fGroupID,true);
		$criteria->compare('fUserID',$this->fUserID,true);
		$criteria->compare('fUserName',$this->fUserName,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}