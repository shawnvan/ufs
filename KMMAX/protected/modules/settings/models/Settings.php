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
 * @property integer $fIsActive
 * @property string $fModule
 */
class Settings extends CActiveRecord
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
			array('fName,fValue,fLabel', 'required'),
			array('fName','unique','allowEmpty'=>false),
			array('fSequence, fIsActive', 'numerical', 'integerOnly'=>true),
			array('fName, fLabel, fGroupName, fModule', 'length', 'max'=>100),
			array('fValue', 'length', 'max'=>200),
			array('fDescription', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fName, fLabel, fValue, fDescription, fGroupName, fSequence, fIsActive, fModule', 'safe', 'on'=>'search'),
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
			'fName' => Yii::t('model','F Name'),
			'fLabel' => Yii::t('model','F Lable'),
			'fValue' => Yii::t('model','F Value'),
			'fDescription' => Yii::t('model','F Description'),
			'fGroupName' => Yii::t('model','F Group Name'),
			'fSequence' => Yii::t('model','F Sequence'),
			'fIsActive' => Yii::t('model','F Is Active'),
			'fModule' => Yii::t('model','F Module'),
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

		$criteria->compare('fName',$this->fName,true);
		$criteria->compare('fLabel',$this->fLabel,true);
		$criteria->compare('fValue',$this->fValue,true);
		$criteria->compare('fDescription',$this->fDescription,true);
		$criteria->compare('fGroupName',$this->fGroupName,true);
		$criteria->compare('fSequence',$this->fSequence);
		$criteria->compare('fIsActive',$this->fIsActive);
		$criteria->compare('fModule',$this->fModule,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}