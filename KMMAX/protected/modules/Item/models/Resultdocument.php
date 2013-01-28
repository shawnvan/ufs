<?php

/**
 * This is the model class for table "{{resultdocument}}".
 *
 * The followings are the available columns in table '{{resultdocument}}':
 * @property string $fTaskNo
 * @property string $fItemNo
 * @property string $fResultNo
 * @property string $fDocumentNo
 * @property string $fCatalogueNo
 * @property string $fStatus
 * @property string $fAttachmentNo
 * @property integer $fIsDocument
 * @property integer $fIsItemResult
 * @property string $fResultSubmitUser
 * @property integer $fResultSubmitDate
 * @property string $fResultConfirmUser
 * @property integer $fResultConfirmDate
 * @property string $fArchiveUser
 * @property integer $fArchiveDate
 * @property string $fApplyArchiveUser
 * @property integer $fApplyArchiveDate
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 * @property string $fUserGroup
 * @property string $fMemo1
 * @property string $fMemo2
 * @property string $fMemo3
 * @property string $fMemo4
 * @property string $fDocumentStatus
 */
class Resultdocument extends CActiveRecord
{
	public $count;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resultdocument the static model class
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
		return '{{resultdocument}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fResultNo', 'required'),
			array('fIsDocument, fIsItemResult, fResultSubmitDate, fResultConfirmDate, fArchiveDate, fApplyArchiveDate, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fTaskNo, fItemNo, fResultNo, fDocumentNo, fCatalogueNo, fStatus, fAttachmentNo, fResultSubmitUser, fResultConfirmUser, fArchiveUser, fApplyArchiveUser, fCreateUser, fUpdateUser, fUserGroup, fDocumentStatus', 'length', 'max'=>50),
			array('fMemo1, fMemo2, fMemo3, fMemo4', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fTaskNo, fItemNo, fResultNo, fDocumentNo, fCatalogueNo, fStatus, fAttachmentNo, fIsDocument, fIsItemResult, fResultSubmitUser, fResultSubmitDate, fResultConfirmUser, fResultConfirmDate, fArchiveUser, fArchiveDate, fApplyArchiveUser, fApplyArchiveDate, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate, fUserGroup, fMemo1, fMemo2, fMemo3, fMemo4, fDocumentStatus', 'safe', 'on'=>'search'),
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
				'task' => array(self::BELONGS_TO, 'Task', 'fTaskNo'),
				'itemCatalogue' => array(self::BELONGS_TO, 'ItemCatalogue', '','on' => 'itemCatalogue.fCatalogueNo=t.fCatalogueNo and itemCatalogue.fItemNo=t.fItemNo'),
				'CatalogueName' => array(self::HAS_ONE, 'Templatecatalogue','', 'on' => 'itemCatalogue.fCatalogueNo=CatalogueName.fCatalogueNo and itemCatalogue.fTemplateNo=CatalogueName.fTemplateNo'),
				'attach' => array(self::HAS_ONE, 'Attachment','', 'on' => 'attach.fAttachmentId=t.fAttachmentNo'),
				'knowcatalogue' => array(self::BELONGS_TO, 'knowledgecatalogue','', 'on' => 'knowcatalogue.fCatalogueNo=t.fCatalogueNo'),
				'item' => array(self::BELONGS_TO, 'Item','', 'on' => 'Item.fItemNo=t.fItemNo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fTaskNo' => Yii::t('model','F Task No'),
			'fItemNo' => Yii::t('model','F Item No'),
			'fResultNo' => Yii::t('model','F Result No'),
			'fAttachmentName' => Yii::t('model','F Attachment Name'),
			'fDocumentNo' => Yii::t('model','F Document No'),
			'fCatalogueNo' => Yii::t('model','F Catalogue No'),
			'fStatus' => Yii::t('model','F Status'),
			'fAttachmentNo' => Yii::t('model','F Attachment No'),
			'fIsDocument' => Yii::t('model','F Is Document'),
			'fIsItemResult' => Yii::t('model','F Is Item Result'),
			'fResultSubmitUser' => Yii::t('model','F Result Submit User'),
			'fResultSubmitDate' => Yii::t('model','F Result Submit Date'),
			'fResultConfirmUser' => Yii::t('model','F Result Confirm User'),
			'fResultConfirmDate' => Yii::t('model','F Result Confirm Date'),
			'fArchiveUser' => Yii::t('model','F Archive User'),
			'fArchiveDate' => Yii::t('model','F Archive Date'),
			'fApplyArchiveUser' => Yii::t('model','F Apply Archive User'),
			'fApplyArchiveDate' => Yii::t('model','F Apply Archive Date'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fUserGroup' => Yii::t('model','F User Group'),
			'fMemo1' => Yii::t('model','F Memo1'),
			'fMemo2' => Yii::t('model','F Memo2'),
			'fMemo3' => Yii::t('model','F Memo3'),
			'fMemo4' => Yii::t('model','F Memo4'),
			'fDocumentStatus' => Yii::t('model','F Document Status'),
		);
	}
	/**
	 * 画图程序.
	 */
	public function GetResultGrap($itemNo){
		$criteria=new CDbCriteria;
		$criteria->addCondition("fItemNo = :fItemNo");
		$criteria->params[':fItemNo']=$itemNo;
		$criteria->addCondition("fIsItemResult = :fIsItemResult");
		$criteria->params[':fIsItemResult']=1;
		$criteria->group = 'fResultSubmitUser';
		$criteria->select = 'fResultSubmitUser,count("x") as count';
		$results=Resultdocument::model()->findAll($criteria);
		$resultGraphs=array();
		foreach ($results as $result){
			array_push($resultGraphs,' {label:\''.$result->fResultSubmitUser.'\', data:'.$result->count.'}');
		}		
		return str_replace('"',' ',json_encode($resultGraphs));
	}
	/**
	 * 画图程序.
	 */
	public function GetDocGrap($itemNo){
	$criteria=new CDbCriteria;
		$criteria->addCondition("fItemNo = :fItemNo");
		$criteria->params[':fItemNo']=$itemNo;
		$criteria->addCondition("fIsDocument = :fIsDocument");
		$criteria->params[':fIsDocument']=1;
		$criteria->group = 'fApplyArchiveUser';
		$criteria->select = 'fApplyArchiveUser,count("x") as count';
		$documents=Resultdocument::model()->findAll($criteria);
		$docGraphs=array();
		foreach ($documents as $document){
			array_push($docGraphs,' {label:\''.$document->fApplyArchiveUser.'\', data:'.$document->count.'}');
		}
		return str_replace('"',' ',json_encode($docGraphs));
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
		$criteria->compare('fTaskNo',$this->fTaskNo,true);
		$criteria->compare('fItemNo',$this->fItemNo,true);
		$criteria->compare('fResultNo',$this->fResultNo,true);
		$criteria->compare('fDocumentNo',$this->fDocumentNo,true);
		$criteria->compare('fCatalogueNo',$this->fCatalogueNo,true);
		$criteria->compare('fStatus',$this->fStatus,true);
		$criteria->compare('fAttachmentNo',$this->fAttachmentNo,true);
		$criteria->compare('fIsDocument',$this->fIsDocument);
		$criteria->compare('fIsItemResult',$this->fIsItemResult);
		$criteria->compare('fResultSubmitUser',$this->fResultSubmitUser,true);
		$criteria->compare('fResultSubmitDate',$this->fResultSubmitDate);
		$criteria->compare('fResultConfirmUser',$this->fResultConfirmUser,true);
		$criteria->compare('fResultConfirmDate',$this->fResultConfirmDate);
		$criteria->compare('fArchiveUser',$this->fArchiveUser,true);
		$criteria->compare('fArchiveDate',$this->fArchiveDate);
		$criteria->compare('fApplyArchiveUser',$this->fApplyArchiveUser,true);
		$criteria->compare('fApplyArchiveDate',$this->fApplyArchiveDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fUserGroup',$this->fUserGroup,true);
		$criteria->compare('fMemo1',$this->fMemo1,true);
		$criteria->compare('fMemo2',$this->fMemo2,true);
		$criteria->compare('fMemo3',$this->fMemo3,true);
		$criteria->compare('fMemo4',$this->fMemo4,true);
		$criteria->compare('fDocumentStatus',$this->fDocumentStatus,true);

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
		$criteria->compare('fTaskNo',$this->fTaskNo,true);
		$criteria->compare('fAttachmentNo',$this->fAttachmentNo,true);
		$criteria->compare('fResultSubmitUser',$this->fResultSubmitUser,true);
		$criteria->compare('fResultSubmitDate',$this->fResultSubmitDate,true);
		$criteria->compare('fResultConfirmUser',$this->fResultConfirmUser,true);
		$criteria->compare('fResultConfirmDate',$this->fResultConfirmDate,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate,true);
		$criteria->compare('fStatus',$this->fStatus,true);		
		return $criteria;
	}
	/**
	 * 高级查询
	 * @return CDbCriteria
	 */
	public function AdvancedDocSearch(){
		$criteria=new CDbCriteria;		
		$criteria->compare('fAttachmentNo',$this->fAttachmentNo,true);
		$criteria->compare('fArchiveUser',$this->fArchiveUser,true);
		$criteria->compare('fArchiveDate',$this->fArchiveDate,true);
		$criteria->compare('fApplyArchiveUser',$this->fApplyArchiveUser,true);
		$criteria->compare('fApplyArchiveDate',$this->fApplyArchiveDate,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate,true);
		$criteria->compare('fDocumentStatus',$this->fDocumentStatus,true);
		return $criteria;
	}
	/**
	 * 高级查询
	 * @return CDbCriteria
	 */
	public function NoItemAdvancedSearch(){
		$criteria=new CDbCriteria;	
		$criteria->compare('fStatus',$this->fStatus,true);
		$criteria->compare('fAttachmentNo',$this->fAttachmentNo,true);
		$criteria->compare('fResultSubmitUser',$this->fResultSubmitUser,true);
		$criteria->compare('fResultSubmitDate',$this->fResultSubmitDate,true);
		$criteria->compare('fResultConfirmUser',$this->fResultConfirmUser,true);
		$criteria->compare('fResultConfirmDate',$this->fResultConfirmDate,true);
		$criteria->compare('fArchiveUser',$this->fArchiveUser,true);
		$criteria->compare('fArchiveDate',$this->fArchiveDate,true);
		$criteria->compare('fApplyArchiveUser',$this->fApplyArchiveUser,true);
		$criteria->compare('fApplyArchiveDate',$this->fApplyArchiveDate,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate,true);
		return $criteria;
	}
}