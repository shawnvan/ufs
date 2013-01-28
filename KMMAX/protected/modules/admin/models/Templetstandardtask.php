<?php

/**
 * This is the model class for table "{{templetstandardtask}}".
 *
 * The followings are the available columns in table '{{templetstandardtask}}':
 * @property string $fTemplateNo
 * @property string $fCatalogueNo
 * @property string $fTaskNo
 */
class Templetstandardtask extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Templetstandardtask the static model class
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
		return '{{templetstandardtask}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fTemplateNo, fCatalogueNo, fTaskNo', 'required'),
			array('fTemplateNo, fCatalogueNo, fTaskNo', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fTemplateNo, fCatalogueNo, fTaskNo', 'safe', 'on'=>'search'),
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
				'task'=> array(self::BELONGS_TO, 'Standardtask', 'fTaskNo'),
				'template'=> array(self::HAS_ONE, 'template ', '', 'on' => 't.fTemplateNo=template.fTemplateNo'),
				'catalogue' => array(self::HAS_ONE, 'Templatecatalogue', '', 'on' => 't.fCatalogueNo=catalogue.fCatalogueNo and t.fTemplateNo=catalogue.fTemplateNo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fTemplateNo' => Yii::t('model','F Template No'),
			'fCatalogueNo' => Yii::t('model','F Catalogue No'),
			'fTaskNo' => Yii::t('model','F Task No'),
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

		$criteria->compare('fTemplateNo',$this->fTemplateNo,true);
		$criteria->compare('fCatalogueNo',$this->fCatalogueNo,true);
		$criteria->compare('fTaskNo',$this->fTaskNo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}