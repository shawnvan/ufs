<?php

/**
 * This is the model class for table "{{settings}}".
 *
 * The followings are the available columns in table '{{settings}}':
 * @property string $fName
 * @property string $fLabel
 * @property string $fValue
 * @property string $fDescription
 * @property string $fGroupName
 * @property integer $fSequence
 * @property integer $fVisible
 * @property string $fModule
 */
class SettingBase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Settings the static model class
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
		return '{{settings}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fName, fLabel', 'required'),
			array('fSequence', 'numerical', 'integerOnly'=>true),
			array('fName, fLabel, fGroupName', 'length', 'max'=>64),
			array('fDescription', 'length', 'max'=>255),
			array('fValue', 'safe'),
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
			'fName' => 'F Name',
			'fLabel' => 'F Label',
			'fValue' => 'F Value',
			'fDescription' => 'F Description',
			'fGroupName' => 'F Group Name',
			'fSequence' => 'F Sequence',
			'fVisible' => 'F Visible',
			'fModule' => 'F Module',
		);
	}
}