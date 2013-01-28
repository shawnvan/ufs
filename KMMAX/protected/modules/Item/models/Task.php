<?php

/**
 * This is the model class for table "{{task}}".
 *
 * The followings are the available columns in table '{{task}}':
 * @property string $fTaskNo
 * @property string $fConsultTask
 * @property string $fItemNo
 * @property string $fCatalogueNo
 * @property string $fTheme
 * @property string $fContent
 * @property string $fRemarks
 * @property integer $fStartDate
 * @property integer $fEndDate
 * @property string $fSponsor
 * @property string $fExecutor
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fSchedule
 * @property integer $fStatus
 * @property string $fPriority
 * @property string $fWarnFrequency
 * @property string $fTaskType
 * @property string $fLatestAffixId
 * @property string $fIsItem
 * @property string $fUserGroup
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 * @property string $fRemarks1
 * @property string $fRemarks2
 * @property string $fRemarks3
 * @property string $fRemarks4
 * @property string $fRemarks5
 * @property string $fStandardStatus
 */
class Task extends CActiveRecord
{
	public $count;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Task the static model class
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
		return '{{task}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fTaskNo,fTheme,fSponsor,fExecutor', 'required'),
			array('fStartDate, fEndDate, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fTaskNo, fConsultTask,fItemNo, fCatalogueNo, fSponsor,fStatus, fExecutor, fCreateUser, fPriority, fWarnFrequency, fTaskType, fLatestAffixId, fIsItem, fUserGroup, fUpdateUser, fStandardStatus', 'length', 'max'=>50),
			array('fTheme', 'length', 'max'=>200),
			array('fSchedule', 'length', 'max'=>20),
			array('fContent, fRemarks, fRemarks1, fRemarks2, fRemarks3, fRemarks4, fRemarks5', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fTaskNo,fConsultTask, fItemNo, fCatalogueNo, fTheme, fContent, fRemarks, fStartDate, fEndDate, fSponsor, fExecutor, fCreateUser, fCreateDate, fSchedule, fStatus, fPriority, fWarnFrequency, fTaskType, fLatestAffixId, fIsItem, fUserGroup, fUpdateUser, fUpdateDate, fRemarks1, fRemarks2, fRemarks3, fRemarks4, fRemarks5, fStandardStatus', 'safe', 'on'=>'search'),
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
				'itemCatalogue' => array(self::BELONGS_TO, 'ItemCatalogue','', 'on' => 't.fItemNo=itemCatalogue.fItemNo and itemCatalogue.fCatalogueNo=t.fCatalogueNo'),
				'tempCatalogue' => array(self::HAS_ONE, 'Templatecatalogue','', 'on' => 'tempCatalogue.fTemplateNo=itemCatalogue.fTemplateNo and itemCatalogue.fCatalogueNo=tempCatalogue.fCatalogueNo'),
				'fCatalogueName' => array(self::HAS_ONE, 'Templatecatalogue','', 'on' => 'itemCatalogue.fCatalogueNo=fCatalogueName.fCatalogueNo'),
				'knowcatalogue' => array(self::BELONGS_TO, 'knowledgecatalogue','', 'on' => 'knowcatalogue.fCatalogueNo=t.fCatalogueNo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fTaskNo' => Yii::t('model','F Task No'),
			'fConsultTask' => Yii::t('model','F Consult Task'),
			'fItemNo' => Yii::t('model','F Item No'),
			'fCatalogueNo' => Yii::t('model','F Catalogue No'),
			'fTheme' => Yii::t('model','F Theme'),
			'fContent' => Yii::t('model','F Content'),
			'fRemarks' => Yii::t('model','F Remarks'),
			'fStartDate' => Yii::t('model','F Start Date'),
			'fEndDate' => Yii::t('model','F End Date'),
			'fSponsor' => Yii::t('model','F Sponsor'),
			'fExecutor' => Yii::t('model','F Executor'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fSchedule' => Yii::t('model','F Schedule'),
			'fStatus' => Yii::t('model','F Status'),
			'fPriority' => Yii::t('model','F Priority'),
			'fWarnFrequency' => Yii::t('model','F Warn Frequency'),
			'fTaskType' => Yii::t('model','F Task Type'),
			'fLatestAffixId' => Yii::t('model','F Latest Affix'),
			'fIsItem' => Yii::t('model','F Is Item'),
			'fUserGroup' => Yii::t('model','F User Group'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fRemarks1' => Yii::t('model','F Remarks1'),
			'fRemarks2' => Yii::t('model','F Remarks2'),
			'fRemarks3' => Yii::t('model','F Remarks3'),
			'fRemarks4' => Yii::t('model','F Remarks4'),
			'fRemarks5' => Yii::t('model','F Remarks5'),
			'fStandardStatus' => Yii::t('model','F Standard Status'),
		);
	}

	public function GetTaskGrap($itemNo){
		$criteria=new CDbCriteria;
		$criteria->addCondition("fItemNo = :fItemNo");
		$criteria->params[':fItemNo']=$itemNo;
		$criteria->group = 'fExecutor';
		$criteria->select = 'fExecutor,count("x") as count';
		$tasks=Task::model()->findAll($criteria);
		$taskGraphs=array();
		foreach ($tasks as $task){
			array_push($taskGraphs,' {label:\''.$task->fExecutor.'\', data:'.$task->count.'}');
		}
				
		return str_replace('"',' ',json_encode($taskGraphs));
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
		$criteria->compare('fCatalogueNo',$this->fCatalogueNo,true);
		$criteria->compare('fTheme',$this->fTheme,true);
		$criteria->compare('fContent',$this->fContent,true);
		$criteria->compare('fRemarks',$this->fRemarks,true);
		$criteria->compare('fStartDate',$this->fStartDate);
		$criteria->compare('fEndDate',$this->fEndDate);
		$criteria->compare('fSponsor',$this->fSponsor,true);
		$criteria->compare('fExecutor',$this->fExecutor,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fSchedule',$this->fSchedule,true);
		$criteria->compare('fStatus',$this->fStatus);
		$criteria->compare('fPriority',$this->fPriority,true);
		$criteria->compare('fWarnFrequency',$this->fWarnFrequency,true);
		$criteria->compare('fTaskType',$this->fTaskType,true);
		$criteria->compare('fLatestAffixId',$this->fLatestAffixId,true);
		$criteria->compare('fIsItem',$this->fIsItem,true);
		$criteria->compare('fUserGroup',$this->fUserGroup,true);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fRemarks1',$this->fRemarks1,true);
		$criteria->compare('fRemarks2',$this->fRemarks2,true);
		$criteria->compare('fRemarks3',$this->fRemarks3,true);
		$criteria->compare('fRemarks4',$this->fRemarks4,true);
		$criteria->compare('fRemarks5',$this->fRemarks5,true);
		$criteria->compare('fStandardStatus',$this->fStandardStatus,true);

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
		$criteria->addCondition("t.fItemNo = :fItemNo");
		$criteria->params[':fItemNo']=$this->fItemNo;
		$criteria->addCondition("t.fIsItem = :fIsItem");
		$criteria->params[':fIsItem']='ItemUse_Yes';
		$criteria->compare('fTheme',$this->fTheme,true);
		//$criteria->compare('fCatalogueNo',$this->fCatalogueNo,true);
		$criteria->compare('fSponsor',$this->fSponsor,true);
		$criteria->compare('fExecutor',$this->fExecutor,true);
		$criteria->compare('fStartDate',$this->fStartDate,true);
		$criteria->compare('fEndDate',$this->fEndDate,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate,true);
		$criteria->compare('fSchedule',$this->fSchedule,true);
		$criteria->compare('fStatus',$this->fStatus,true);
		$criteria->compare('fStandardStatus',$this->fStandardStatus,true);
		/* $criteria->compare('fCreate',$this->fCreate,true);
			$criteria->compare('fUpdate',$this->fUpdate,true);
		if(!empty($this->fTemplateName)){
		$criteria->addSearchCondition('fTemplateName',$this->fTemplateName);
		}
		if(!empty($this->fCreateDateBeginDate))
			$criteria->addCondition("fCreateDate >= '".$this->fCreateDateBeginDate."'");
		if(!empty($this->fCreateDateEndDate))
			$criteria->addCondition("fCreateDate <= '".$this->fCreateDateEndDate."'");
		if(!empty($this->fUpdateDateBeginDate))
			$criteria->addCondition("fUpdateDate >= '".$this->fUpdateDateBeginDate."'");
		if(!empty($this->fUpdateDateBeginDate))
			$criteria->addCondition("fUpdateDate <= '".$this->fUpdateDateBeginDate."'"); */
	
		/* $criteria->with  = array(
		 'roh',
				'rod'=> array('group'=>'`rod`.`fSourcePOKey`')
		); */
		/* $criteria->select= array('sum(rod.fOrderedQty) as TotalQty','roh.fisShiped as fisShiped','roh.fLocation as fLocation','fSellerOrderCode','fWaveKey','fContainerCode','fReceiptDate'); */
		/* 	$criteria->addBetweenCondition('fCreateDate', $this->fCreateDateBeginDate, $this->fCreateDateEndDate);
		 $criteria->addBetweenCondition('fUpdateDate', $this->fUpdateDateBeginDate, $this->fUpdateDateBeginDate); */
	
		return $criteria;
	}
	/**
	 * 高级查询
	 * @return CDbCriteria
	 */
	public function NoItemAdvancedSearch(){
		$criteria=new CDbCriteria;
		$criteria->addCondition("t.fExecutor = :fname");
		$criteria->addCondition('fSponsor = :fname','OR');
		$criteria->params[':fname']=Yii::app()->params->loginuser->fUserName;
		$criteria->addCondition("t.fIsItem = :fIsItem");
		$criteria->params[':fIsItem']='ItemUse_No';
		$criteria->compare('fTheme',$this->fTheme,true);
		$criteria->compare('fCatalogueNo',$this->fCatalogueNo,true);
		$criteria->compare('fSponsor',$this->fSponsor,true);
		$criteria->compare('fExecutor',$this->fExecutor,true);
		$criteria->compare('fStartDate',$this->fStartDate,true);
		$criteria->compare('fEndDate',$this->fEndDate,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate,true);
		$criteria->compare('fSchedule',$this->fSchedule,true);
		$criteria->compare('fStatus',$this->fStatus,true);
		$criteria->compare('fStandardStatus',$this->fStandardStatus,true);		
		return $criteria;
	}
}