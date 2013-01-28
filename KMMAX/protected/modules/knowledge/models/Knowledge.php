<?php

/**
 * This is the model class for table "{{knowledge}}".
 *
 * The followings are the available columns in table '{{knowledge}}':
 * @property string $fKnowledgeNo
 * @property string $fItemNo
 * @property string $fTaskNo
 * @property string $fResultNo
 * @property string $fCatalogueNo
 * @property string $fKnowledgeName
 * @property string $fContent
 * @property string $fMemo
 * @property string $fAttachmentNo
 * @property string $fAttachmentName
 * @property string $fAttachmentFalseName
 * @property string $fIsOpen
 * @property string $fStatus
 * @property string $fUserGroup
 * @property integer $fSubmitDate
 * @property string $fSubmitUser
 * @property string $fConfirmUser
 * @property integer $fConfirmDate
 * @property string $fTags
 * @property string $fCreate
 * @property integer $fCreateDate
 * @property integer $fUpdateDate
 * @property string $fUpdateUser
 */
class Knowledge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Knowledge the static model class
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
		return '{{knowledge}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fKnowledgeNo,fKnowledgeName,fCatalogueNo', 'required'),
			array('fSubmitDate, fConfirmDate, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fKnowledgeNo, fIsOpen,fStatus,fItemNo, fTaskNo, fResultNo, fCatalogueNo, fAttachmentNo, fUserGroup, fSubmitUser, fConfirmUser, fCreate, fUpdateUser', 'length', 'max'=>50),
			array('fKnowledgeName, fAttachmentName, fAttachmentFalseName,fTags', 'length', 'max'=>200),
			array('fContent, fMemo,', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fKnowledgeNo, fItemNo, fTaskNo, fResultNo, fCatalogueNo, fKnowledgeName, fContent, fMemo, fAttachmentNo, fAttachmentName, fAttachmentFalseName, fIsOpen, fStatus, fUserGroup, fTags,fSubmitDate, fSubmitUser, fConfirmUser, fConfirmDate, fCreate, fCreateDate, fUpdateDate, fUpdateUser', 'safe', 'on'=>'search'),
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
				'knowledgecatalogue' => array(self::HAS_ONE, 'knowledgecatalogue', '', 'on' => 't.fCatalogueNo=knowledgecatalogue.fCatalogueNo'),
				'task' => array(self::BELONGS_TO, 'Task', '', 'on' => 't.fTaskNo=task.fTaskNo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fKnowledgeNo' => Yii::t('model','F Knowledge No'),
			'fItemNo' => Yii::t('model','F Item No'),
			'fTaskNo' => Yii::t('model','F Task No'),
			'fResultNo' => Yii::t('model','F Result No'),
			'fCatalogueNo' => Yii::t('model','F Catalogue No'),
			'fKnowledgeName' => Yii::t('model','F Knowledge Name'),
			'fContent' => Yii::t('model','F Content'),
			'fMemo' => Yii::t('model','F Memo'),
			'fAttachmentNo' => Yii::t('model','F Attachment No'),
			'fAttachmentName' => Yii::t('model','F Attachment Name'),
			'fAttachmentFalseName' => Yii::t('model','F Attachment False Name'),
			'fIsOpen' => Yii::t('model','F Is Open'),
			'fStatus' => Yii::t('model','F Status'),
			'fSubmitDate' => Yii::t('model','F Submit Date'),
			'fSubmitUser' => Yii::t('model','F Submit User'),
			'fConfirmUser' => Yii::t('model','F Confirm User'),
			'fConfirmDate' => Yii::t('model','F Confirm Date'),
			'fTags' => Yii::t('model','F Tags'),
			'fCreate' => Yii::t('model','F Create'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
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
		$criteria->compare('fKnowledgeNo',$this->fKnowledgeNo,true);
		$criteria->compare('fItemNo',$this->fItemNo,true);
		$criteria->compare('fTaskNo',$this->fTaskNo,true);
		$criteria->compare('fResultNo',$this->fResultNo,true);
		$criteria->compare('fCatalogueNo',$this->fCatalogueNo,true);
		$criteria->compare('fKnowledgeName',$this->fKnowledgeName,true);
		$criteria->compare('fContent',$this->fContent,true);
		$criteria->compare('fMemo',$this->fMemo,true);
		$criteria->compare('fAttachmentNo',$this->fAttachmentNo,true);
		$criteria->compare('fAttachmentName',$this->fAttachmentName,true);
		$criteria->compare('fAttachmentFalseName',$this->fAttachmentFalseName,true);
		$criteria->compare('fIsOpen',$this->fIsOpen,true);
		$criteria->compare('fStatus',$this->fStatus,true);
		$criteria->compare('fUserGroup',$this->fUserGroup,true);
		$criteria->compare('fSubmitDate',$this->fSubmitDate);
		$criteria->compare('fSubmitUser',$this->fSubmitUser,true);
		$criteria->compare('fConfirmUser',$this->fConfirmUser,true);
		$criteria->compare('fConfirmDate',$this->fConfirmDate);
		$criteria->compare('fTags',$this->fTags,true);
		$criteria->compare('fCreate',$this->fCreate,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * 高级查询
	 * @return CDbCriteria
	 */
	public function AdvancedSearch(){
		$criteria=new CDbCriteria;
		$criteria->compare('fKnowledgeName',$this->fKnowledgeName,true);	
		$criteria->compare('fAttachmentName',$this->fAttachmentName,true);
		$criteria->compare('fCreate',$this->fCreate,true);
		$criteria->compare('fSubmitUser',$this->fSubmitUser,true);
		$criteria->compare('fConfirmUser',$this->fConfirmUser,true);
		return $criteria;
	}
}