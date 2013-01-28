<?php

/**
 * This is the model class for table "{{itemuser}}".
 *
 * The followings are the available columns in table '{{itemuser}}':
 * @property string $fItemNo
 * @property string $fEmployeeNo
 * @property string $fEmployeeName
 * @property string $fRoleNo
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUserGroup
 * @property string $fUserType
 */
class Itemuser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Itemuser the static model class
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
		return '{{itemuser}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fCreateDate', 'numerical', 'integerOnly'=>true),
			array('fItemNo, fEmployeeNo, fRoleNo, fCreateUser, fUserGroup', 'length', 'max'=>50),
			array('fEmployeeName', 'length', 'max'=>100),
			array('fUserType', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fItemNo, fEmployeeNo, fEmployeeName, fRoleNo, fCreateUser, fCreateDate, fUserGroup, fUserType', 'safe', 'on'=>'search'),
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
			'fItemNo' => Yii::t('model','F Item No'),
			'fEmployeeNo' => Yii::t('model','F Employee No'),
			'fEmployeeName' => Yii::t('model','F Employee Name'),
			'fRoleNo' => Yii::t('model','F Role No'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fUserGroup' => Yii::t('model','F User Group'),
			'fUserType' => Yii::t('model','F User Type'),
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

		$criteria->compare('fItemNo',$this->fItemNo,true);
		$criteria->compare('fEmployeeNo',$this->fEmployeeNo,true);
		$criteria->compare('fEmployeeName',$this->fEmployeeName,true);
		$criteria->compare('fRoleNo',$this->fRoleNo,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUserGroup',$this->fUserGroup,true);
		$criteria->compare('fUserType',$this->fUserType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}