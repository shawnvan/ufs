<?php

/**
 * This is the model class for table "{{downloadattach}}".
 *
 * The followings are the available columns in table '{{downloadattach}}':
 * @property string $fDownNo
 * @property string $fAttachmentNo
 * @property string $fDownUser
 * @property integer $fDownDate
 */
class Downloadattach extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Downloadattach the static model class
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
		return '{{downloadattach}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fDownNo', 'required'),
			array('fDownDate', 'numerical', 'integerOnly'=>true),
			array('fDownNo, fAttachmentNo, fDownUser', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fDownNo, fAttachmentNo, fDownUser, fDownDate', 'safe', 'on'=>'search'),
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
			'fDownNo' => Yii::t('model','F Down No'),
			'fAttachmentNo' => Yii::t('model','F Attachment No'),
			'fDownUser' => Yii::t('model','F Down User'),
			'fDownDate' => Yii::t('model','F Down Date'),
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

		$criteria->compare('fDownNo',$this->fDownNo,true);
		$criteria->compare('fAttachmentNo',$this->fAttachmentNo,true);
		$criteria->compare('fDownUser',$this->fDownUser,true);
		$criteria->compare('fDownDate',$this->fDownDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}