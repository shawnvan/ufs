<?php

/**
 * This is the model class for table "{{userlog}}".
 *
 * The followings are the available columns in table '{{userlog}}':
 * @property string $fLogID
 * @property string $fUserName
 * @property integer $fLoginDate
 * @property string $fLoginip
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 *
 * The followings are the available model relations:
 * @property User $fUser
 */
class Userlog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userlog the static model class
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
		return '{{userlog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fLogID', 'required'),
			array('fLoginDate, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fLogID, fUserName, fLoginip, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fLogID, fUserName, fLoginDate, fLoginip, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
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
			'fUser' => array(self::BELONGS_TO, 'User', 'fUserName'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fLogID' => Yii::t('model','F Log'),
			'fUserName' => Yii::t('model','F User'),
			'fLoginDate' => Yii::t('model','F Login Date'),
			'fLoginip' => Yii::t('model','F Loginip'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
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

		$criteria->compare('fLogID',$this->fLogID,true);
		$criteria->compare('fUserName',$this->fUserName,true);
		$criteria->compare('fLoginDate',$this->fLoginDate);
		$criteria->compare('fLoginip',$this->fLoginip,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}