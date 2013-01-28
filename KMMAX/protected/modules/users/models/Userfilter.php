<?php

/**
 * This is the model class for table "{{userfilter}}".
 *
 * The followings are the available columns in table '{{userfilter}}':
 * @property string $fUserFilterID
 * @property string $fUserID
 * @property string $fFormID
 * @property string $fDataGridColumn
 * @property string $fQueryCondition
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 *
 * The followings are the available model relations:
 * @property User $fUser
 */
class Userfilter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userfilter the static model class
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
		return '{{userfilter}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fUserFilterID', 'required'),
			array('fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fUserFilterID, fUserID, fFormID, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fDataGridColumn, fQueryCondition', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fUserFilterID, fUserID, fFormID, fDataGridColumn, fQueryCondition, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
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
			'fUser' => array(self::BELONGS_TO, 'User', 'fUserID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fUserFilterID' => Yii::t('model','F User Filter'),
			'fUserID' => Yii::t('model','F User'),
			'fFormID' => Yii::t('model','F Form'),
			'fDataGridColumn' => Yii::t('model','F Data Grid Column'),
			'fQueryCondition' => Yii::t('model','F Query Condition'),
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

		$criteria->compare('fUserFilterID',$this->fUserFilterID,true);
		$criteria->compare('fUserID',$this->fUserID,true);
		$criteria->compare('fFormID',$this->fFormID,true);
		$criteria->compare('fDataGridColumn',$this->fDataGridColumn,true);
		$criteria->compare('fQueryCondition',$this->fQueryCondition,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}