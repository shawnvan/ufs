<?php

/**
 * This is the model class for table "{{templatecatalogue}}".
 *
 * The followings are the available columns in table '{{templatecatalogue}}':
 * @property string $fCatalogueNo
 * @property string $fTemplateNo
 * @property string $fCatalogueName
 * @property string $fWarnStart
 * @property string $fWarnEnd
 * @property string $fWarnRate
 * @property string $fIsActive
 * @property integer $fSort
 * @property string $fFatherCatalogueNo
 * @property string $fUserGroup
 * @property integer $fCreateDate
 * @property string $fCreateUser
 * @property integer $fUpdateDate
 * @property string $fUpdateUser
 * @property integer $fStandardtaskNum
 */
class Templatecatalogue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Templatecatalogue the static model class
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
		return '{{templatecatalogue}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fCatalogueNo', 'required'),
			array('fSort, fCreateDate, fUpdateDate,fStandardtaskNum', 'numerical', 'integerOnly'=>true),
			array('fCatalogueNo, fIsActive,fTemplateNo, fWarnRate, fFatherCatalogueNo, fUserGroup, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fCatalogueName', 'length', 'max'=>100),
			array('fWarnStart, fWarnEnd', 'safe'),
			array('fCatalogueNo, fTemplateNo, fCatalogueName, fWarnStart, fStandardtaskNum,fWarnEnd, fWarnRate, fIsActive, fSort, fFatherCatalogueNo, fUserGroup, fCreateDate, fCreateUser, fUpdateDate, fUpdateUser', 'safe', 'on'=>'search'),
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
				'fathercatalogue' => array(self::HAS_ONE, 'templatecatalogue', '', 'on' => 't.fFatherCatalogueNo=fathercatalogue.fCatalogueNo and t.fTemplateNo=fathercatalogue.fTemplateNo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fCatalogueNo' => Yii::t('model','F Catalogue No'),
			'fTemplateNo' => Yii::t('model','F Template No'),
			'fCatalogueName' => Yii::t('model','F Catalogue Name'),
			'fWarnStart' => Yii::t('model','F Warn Start'),
			'fWarnEnd' => Yii::t('model','F Warn End'),
			'fWarnRate' => Yii::t('model','F Warn Rate'),
			'fIsActive' => Yii::t('model','F Is Active'),
			'fSort' => Yii::t('model','F Sort'),
			'fFatherCatalogueNo' => Yii::t('model','F Father Catalogue No'),
			'fUserGroup' => Yii::t('model','F User Group'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fStandardtaskNum' => Yii::t('model','F Standard Task Num'),
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

		$criteria->compare('fCatalogueNo',$this->fCatalogueNo,true);
		$criteria->compare('fTemplateNo',$this->fTemplateNo,true);
		$criteria->compare('fCatalogueName',$this->fCatalogueName,true);
		$criteria->compare('fWarnStart',$this->fWarnStart,true);
		$criteria->compare('fWarnEnd',$this->fWarnEnd,true);
		$criteria->compare('fWarnRate',$this->fWarnRate,true);
		$criteria->compare('fIsActive',$this->fIsActive);
		$criteria->compare('fSort',$this->fSort);
		$criteria->compare('fFatherCatalogueNo',$this->fFatherCatalogueNo,true);
		$criteria->compare('fUserGroup',$this->fUserGroup,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fStandardtaskNum',$this->fStandardtaskNum,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}