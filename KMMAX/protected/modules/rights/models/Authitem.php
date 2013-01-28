<?php

/**
 * This is the model class for table "{{authitem}}".
 *
 * The followings are the available columns in table '{{authitem}}':
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $bizrule
 * @property string $data
 * @property string $fOrgNo
 * @property string $fUpOrgNo
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 *
 * The followings are the available model relations:
 * @property Authassignment[] $authassignments
 * @property Authitemchild[] $authitemchildren
 * @property Authitemchild[] $authitemchildren1
 * @property AuthitemchildCopy[] $authitemchildCopies
 * @property AuthitemchildCopy[] $authitemchildCopies1
 * @property Rights $rights
 */
class Authitem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Authitem the static model class
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
		return '{{authitem}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type', 'required'),
			array('type, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('fOrgNo, fUpOrgNo, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('description, bizrule, data', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, type, description, bizrule, data, fOrgNo, fUpOrgNo, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
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
			'authassignments' => array(self::HAS_MANY, 'Authassignment', 'itemname'),
			'authitemchildren' => array(self::HAS_MANY, 'Authitemchild', 'parent'),
			'authitemchildren1' => array(self::HAS_MANY, 'Authitemchild', 'child'),
			'authitemchildCopies' => array(self::HAS_MANY, 'AuthitemchildCopy', 'parent'),
			'authitemchildCopies1' => array(self::HAS_MANY, 'AuthitemchildCopy', 'child'),
			'rights' => array(self::HAS_ONE, 'Rights', 'itemname'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => Yii::t('model','Name'),
			'type' => Yii::t('model','Type'),
			'description' => Yii::t('model','Description'),
			'bizrule' => Yii::t('model','Bizrule'),
			'data' => Yii::t('model','Data'),
			'fOrgNo' => Yii::t('model','F Org No'),
			'fUpOrgNo' => Yii::t('model','F Up Org No'),
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('bizrule',$this->bizrule,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('fOrgNo',$this->fOrgNo,true);
		$criteria->compare('fUpOrgNo',$this->fUpOrgNo,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}