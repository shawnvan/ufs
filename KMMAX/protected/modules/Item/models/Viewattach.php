<?php

/**
 * This is the model class for table "{{viewattach}}".
 *
 * The followings are the available columns in table '{{viewattach}}':
 * @property string $fViewNo
 * @property string $fAttachmentNo
 * @property string $fViewer
 * @property integer $fViewDate
 */
class Viewattach extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Viewattach the static model class
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
		return '{{viewattach}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fViewNo', 'required'),
			array('fViewDate,', 'numerical', 'integerOnly'=>true),
			array('fViewNo, fAttachmentNo, fViewer', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fViewNo, fAttachmentNo, fViewer, fViewDate', 'safe', 'on'=>'search'),
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
			'fViewNo' => Yii::t('model','F View No'),
			'fAttachmentNo' => Yii::t('model','F Attachment No'),
			'fViewer' => Yii::t('model','F Viewer'),
			'fViewDate' => Yii::t('model','F View Date'),
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

		$criteria->compare('fViewNo',$this->fViewNo,true);
		$criteria->compare('fAttachmentNo',$this->fAttachmentNo,true);
		$criteria->compare('fViewer',$this->fViewer,true);
		$criteria->compare('fViewDate',$this->fViewDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}