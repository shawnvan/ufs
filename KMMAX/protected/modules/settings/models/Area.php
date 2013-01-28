<?php

/**
 * This is the model class for table "{{area}}".
 *
 * The followings are the available columns in table '{{area}}':
 * @property string $fAreaID
 * @property string $fAreaName
 * @property string $fParentID
 */
class Area extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Area the static model class
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
		return '{{area}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fAreaID', 'required'),
			array('fAreaID, fParentID', 'length', 'max'=>50),
			array('fAreaName', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fAreaID, fAreaName, fParentID', 'safe', 'on'=>'search'),
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
			'fAreaID' => Yii::t('model','F Area'),
			'fAreaName' => Yii::t('model','F Area Name'),
			'fParentID' => Yii::t('model','F Parent'),
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

		$criteria->compare('fAreaID',$this->fAreaID,true);
		$criteria->compare('fAreaName',$this->fAreaName,true);
		$criteria->compare('fParentID',$this->fParentID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getProvinceList()
	{
		$model = Area::model()->findAllByAttributes(array('fParentID'=>0));
		return CHtml::listData($model, 'fAreaID', 'fAreaName');
	}

	public function getCityList($pid)
	{
		$model = Area::model()->findAllByAttributes(array('fParentID'=>$pid));
		return CHtml::listData($model, 'fAreaID', 'fAreaName');
	}
	
	public function getCityName($id)
	{
		$model = Area::model()->findByPk($id);
		return $model->fAreaName;
	}
}