<?php

/**
 * This is the model class for table "{{attachment}}".
 *
 * The followings are the available columns in table '{{attachment}}':
 * @property string $fAttachmentId
 * @property string $fTaskNo
 * @property string $fResultNo
 * @property string $fDocumentNo
 * @property string $fKnowledgeNo
 * @property string $fCatalogueNo
 * @property string $fAttachmentName
 * @property string $fAttachmentFalseName
 * @property integer $fDownloadNum
 * @property integer $fViewNum
 * @property string $fVersion
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 */
class Attachment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Attachment the static model class
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
		return '{{attachment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fAttachmentId', 'required'),
			array('fDownloadNum, fViewNum, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fAttachmentId, fTaskNo, fResultNo, fDocumentNo, fKnowledgeNo, fCatalogueNo, fVersion, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fAttachmentName, fAttachmentFalseName', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fAttachmentId, fTaskNo, fResultNo, fDocumentNo, fKnowledgeNo, fCatalogueNo, fAttachmentName, fAttachmentFalseName, fDownloadNum, fViewNum, fVersion, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate', 'safe', 'on'=>'search'),
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
			'fAttachmentId' => Yii::t('model','F Attachment'),
			'fTaskNo' => Yii::t('model','F Task No'),
			'fResultNo' => Yii::t('model','F Result No'),
			'fDocumentNo' => Yii::t('model','F Document No'),
			'fKnowledgeNo' => Yii::t('model','F Knowledge No'),
			'fCatalogueNo' => Yii::t('model','F Catalogue No'),
			'fAttachmentName' => Yii::t('model','F Attachment Name'),
			'fAttachmentFalseName' => Yii::t('model','F Attachment False Name'),
			'fDownloadNum' => Yii::t('model','F Download Num'),
			'fViewNum' => Yii::t('model','F View Num'),
			'fVersion' => Yii::t('model','F Version'),
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

		$criteria->compare('fAttachmentId',$this->fAttachmentId,true);
		$criteria->compare('fTaskNo',$this->fTaskNo,true);
		$criteria->compare('fResultNo',$this->fResultNo,true);
		$criteria->compare('fDocumentNo',$this->fDocumentNo,true);
		$criteria->compare('fKnowledgeNo',$this->fKnowledgeNo,true);
		$criteria->compare('fCatalogueNo',$this->fCatalogueNo,true);
		$criteria->compare('fAttachmentName',$this->fAttachmentName,true);
		$criteria->compare('fAttachmentFalseName',$this->fAttachmentFalseName,true);
		$criteria->compare('fDownloadNum',$this->fDownloadNum);
		$criteria->compare('fViewNum',$this->fViewNum);
		$criteria->compare('fVersion',$this->fVersion,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}