<?php

/**
 * This is the model class for table "{{userprofile}}".
 *
 * The followings are the available columns in table '{{userprofile}}':
 * @property string $fUserID
 * @property string $fModelName
 * @property string $fDataGridColumn
 * @property string $fQueryCondition
 * @property string $fCreateUser
 * @property string $fCreateDate
 * @property string $fUpdateUser
 * @property string $fUpdateDate
 */
class UserProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserProfile the static model class
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
		return '{{userprofile}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fUserID, fModelName, fCreateUser, fCreateDate', 'required'),
			array('fUserID, fModelName, fCreateUser, fUpdateUser', 'length', 'max'=>25),
			array('fDataGridColumn, fQueryCondition, fUpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fUserID, fModelName, fDataGridColumn, fQueryCondition, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
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
			'fUserID' => 'F User',
			'fModelName' => 'F Form',
			'fDataGridColumn' => 'F Data Grid Column',
			'fQueryCondition' => 'F Query Condition',
			'fCreateUser' => 'F Create User',
			'fCreateDate' => 'F Create Date',
			'fUpdateUser' => 'F Update User',
			'fUpdateDate' => 'F Update Date',
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

		$criteria->compare('fUserID',$this->fUserID,true);
		$criteria->compare('fModelName',$this->fModelName,true);
		$criteria->compare('fDataGridColumn',$this->fDataGridColumn,true);
		$criteria->compare('fQueryCondition',$this->fQueryCondition,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate,true);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}