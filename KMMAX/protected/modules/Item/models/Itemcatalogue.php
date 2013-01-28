<?php

/**
 * This is the model class for table "{{itemcatalogue}}".
 *
 * The followings are the available columns in table '{{itemcatalogue}}':
 * @property string $fCatalogueNo
 * @property string $fItemNo
 * @property string $fTemplateNo
 * @property string $fCatalogueName
 * @property string $fIsActive
 * @property string $fWarnRate
 * @property string $fExecutorUser
 * @property integer $fSort
 * @property integer $fStatus
 * @property integer $fWarnStart
 * @property integer $fWarnEnd
 * @property string $fFatherCatalogueNo
 * @property string $fUserGroup
 * @property integer $fWaitFinishingNum
 * @property integer $fFinishedNum
 * @property integer $fResultNum
 * @property integer $fDocumentNum
 * @property integer $fTaskNum
 * @property integer $fKnowledgeNum
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 */
class Itemcatalogue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Itemcatalogue the static model class
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
		return '{{itemcatalogue}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fSort, fStatus, fCreateDate, fUpdateDate,fWaitFinishingNum, fFinishedNum, fResultNum, fDocumentNum, fTaskNum, fKnowledgeNum', 'numerical', 'integerOnly'=>true),
			array('fCatalogueNo,fWarnRate,fItemNo, fExecutorUser,fCreateUser, fUpdateUser,fTemplateNo, fFatherCatalogueNo, fUserGroup', 'length', 'max'=>50),
			array('fCatalogueName', 'length', 'max'=>200),
			array('fIsActive', 'length', 'max'=>10),
			array('fWarnStart, fWarnEnd', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fCatalogueNo, fItemNo, fTemplateNo, fWarnRate,fIsActive,fCatalogueName, fExecutorUser,fSort, fStatus, fWarnStart, fWarnEnd, fFatherCatalogueNo, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate,fUserGroup, fWaitFinishingNum, fFinishedNum, fResultNum, fDocumentNum, fTaskNum, fKnowledgeNum', 'safe', 'on'=>'search'),
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
				'catalogue' => array(self::HAS_ONE, 'Templatecatalogue','', 'on' => 't.fCatalogueNo=catalogue.fCatalogueNo'),
				'fathercatalogue' => array(self::HAS_ONE, 'Templatecatalogue', '', 'on' => 't.fFatherCatalogueNo=fathercatalogue.fCatalogueNo'),
				'itemcatalogue' => array(self::HAS_ONE, 'Templatecatalogue', '', 'on' => 't.fCatalogueNo=itemcatalogue.fCatalogueNo and t.fTemplateNo=itemcatalogue.fTemplateNo '),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fCatalogueNo' => Yii::t('model','F Catalogue No'),
			'fCatalogueName' => Yii::t('model','F Catalogue Name'),
			'fItemNo' => Yii::t('model','F Item No'),
			'fTemplateNo' => Yii::t('model','F Template No'),
			'fIsActive' => Yii::t('model','F Is Active'),
			'fSort' => Yii::t('model','F Sort'),
			'fStatus' => Yii::t('model','F Status'),
			'fWarnRate' => Yii::t('model','F Warn Rate'),
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
			'fExecutorUser' => Yii::t('model','F Executor User'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fCatalogueName' => Yii::t('model','F Catalogue Name'),
				
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
		$criteria->compare('fExecutorUser',$this->fExecutorUser);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}