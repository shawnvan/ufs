<?php

/**
 * This is the model class for table "{{itemcatalogue_copy}}".
 *
 * The followings are the available columns in table '{{itemcatalogue_copy}}':
 * @property string $fCatalogueNo
 * @property string $fItemNo
 * @property string $fTemplateNo
 * @property string $fIsActive
 * @property integer $fSort
 * @property integer $fStatus
 * @property string $fWarnStart
 * @property string $fWarnEnd
 * @property string $fFatherCatalogueNo
 * @property string $fUserGroup
 * @property integer $fWaitFinishingNum
 * @property integer $fFinishedNum
 * @property integer $fResultNum
 * @property integer $fDocumentNum
 * @property integer $fTaskNum
 * @property integer $fKnowledgeNum
 */
class ItemcatalogueCopy extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ItemcatalogueCopy the static model class
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
		return '{{itemcatalogue_copy}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fSort, fStatus, fWaitFinishingNum, fFinishedNum, fResultNum, fDocumentNum, fTaskNum, fKnowledgeNum', 'numerical', 'integerOnly'=>true),
			array('fCatalogueNo, fItemNo, fTemplateNo, fFatherCatalogueNo, fUserGroup', 'length', 'max'=>50),
			array('fIsActive', 'length', 'max'=>10),
			array('fWarnStart, fWarnEnd', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fCatalogueNo, fItemNo, fTemplateNo, fIsActive, fSort, fStatus, fWarnStart, fWarnEnd, fFatherCatalogueNo, fUserGroup, fWaitFinishingNum, fFinishedNum, fResultNum, fDocumentNum, fTaskNum, fKnowledgeNum', 'safe', 'on'=>'search'),
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
			'fCatalogueNo' => Yii::t('model','F Catalogue No'),
			'fItemNo' => Yii::t('model','F Item No'),
			'fTemplateNo' => Yii::t('model','F Template No'),
			'fIsActive' => Yii::t('model','F Is Active'),
			'fSort' => Yii::t('model','F Sort'),
			'fStatus' => Yii::t('model','F Status'),
			'fWarnStart' => Yii::t('model','F Warn Start'),
			'fWarnEnd' => Yii::t('model','F Warn End'),
			'fFatherCatalogueNo' => Yii::t('model','F Father Catalogue No'),
			'fUserGroup' => Yii::t('model','F User Group'),
			'fWaitFinishingNum' => Yii::t('model','F Wait Finishing Num'),
			'fFinishedNum' => Yii::t('model','F Finished Num'),
			'fResultNum' => Yii::t('model','F Result Num'),
			'fDocumentNum' => Yii::t('model','F Document Num'),
			'fTaskNum' => Yii::t('model','F Task Num'),
			'fKnowledgeNum' => Yii::t('model','F Knowledge Num'),
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
		$criteria->compare('fItemNo',$this->fItemNo,true);
		$criteria->compare('fTemplateNo',$this->fTemplateNo,true);
		$criteria->compare('fIsActive',$this->fIsActive,true);
		$criteria->compare('fSort',$this->fSort);
		$criteria->compare('fStatus',$this->fStatus);
		$criteria->compare('fWarnStart',$this->fWarnStart,true);
		$criteria->compare('fWarnEnd',$this->fWarnEnd,true);
		$criteria->compare('fFatherCatalogueNo',$this->fFatherCatalogueNo,true);
		$criteria->compare('fUserGroup',$this->fUserGroup,true);
		$criteria->compare('fWaitFinishingNum',$this->fWaitFinishingNum);
		$criteria->compare('fFinishedNum',$this->fFinishedNum);
		$criteria->compare('fResultNum',$this->fResultNum);
		$criteria->compare('fDocumentNum',$this->fDocumentNum);
		$criteria->compare('fTaskNum',$this->fTaskNum);
		$criteria->compare('fKnowledgeNum',$this->fKnowledgeNum);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}