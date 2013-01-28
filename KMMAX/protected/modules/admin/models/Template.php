<?php

/**
 * This is the model class for table "{{template}}".
 *
 * The followings are the available columns in table '{{template}}':
 * @property string $fTemplateNo
 * @property string $fTemplateName
 * @property string $fTemplateType
 * @property string $fCreate
 * @property integer $fCreateDate
 * @property string $fUpdate
 * @property integer $fUpdateDate
 * @property integer $fStatus
 * @property string $fUserGroup
 */
class Template extends CActiveRecord
{
	public $fCreateDateBeginDate;
	public $fCreateDateEndDate;
	public $fUpdateDateBeginDate;
	public $fUpdateDateEndDate;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Template the static model class
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
		return '{{template}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fTemplateNo,fTemplateName', 'required'),
			array('fCreateDate, fUpdateDate, fStatus', 'numerical', 'integerOnly'=>true),
			array('fTemplateNo, fTemplateName, fTemplateType, fCreate, fUpdate, fUserGroup', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fTemplateNo, fTemplateName, fTemplateType, fCreate, fCreateDate, fUpdate, fUpdateDate, fStatus, fUserGroup', 'safe', 'on'=>'search'),
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
			'fTemplateNo' => Yii::t('model','F Template No'),
			'fTemplateName' => Yii::t('model','F Template Name'),
			'fTemplateType' => Yii::t('model','F Template Type'),
			'fCreate' => Yii::t('model','F Create'),
			'fCreateDateBeginDate' => Yii::t('model','F Create Date Begin Date'),
			'fCreateDateEndDate' => Yii::t('model','F Create Date End Date'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fUpdate' => Yii::t('model','F Update'),
			'fUpdateDateBeginDate' => Yii::t('model','F Update Date Begin Date'),
			'fUpdateDateEndDate' => Yii::t('model','F Update Date End Date'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fStatus' => Yii::t('model','F Status'),
			'fUserGroup' => Yii::t('model','F User Group'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		return new CActiveDataProvider($this, array(
			'criteria'=>$this->AdvancedSearch(),
		));
	}
	public function TestSearch(){
		$criteria=new CDbCriteria;
		$criteria->compare('fTemplateNo',$this->fTemplateNo,true);
		$criteria->compare('fTemplateName',$this->fTemplateName,true);
		$criteria->compare('fTemplateType',$this->fTemplateType,true);
		$criteria->compare('fCreate',$this->fCreate,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdate',$this->fUpdate,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		
		if(isset($this->fCreateDateBeginDate) && !empty($this->fCreateDateBeginDate)){
			$criteria->addCondition("fCreateDate>='".strtotime($this->fCreateDateBeginDate)."'");
		}
		if(isset($this->fCreateDateEndDate) && !empty($this->fCreateDateEndDate)){
			$criteria->addCondition("fCreateDate<='".strtotime($this->fCreateDateEndDate)."'");
		}
		if(isset($this->fUpdateDateBeginDate) && !empty($this->fUpdateDateBeginDate)){
			$criteria->addCondition("fUpdateDate>='".strtotime($this->fUpdateDateBeginDate)."'");
		}
		if(isset($this->fUpdateDateEndDate) && !empty($this->fUpdateDateEndDate)){
			$criteria->addCondition("fUpdateDate<='".strtotime($this->fUpdateDateEndDate)."'");
		}
		/* $criteria->with  = array(
				'roh',
				'rod'=> array('group'=>'`rod`.`fSourcePOKey`')
		); */		
		/* $criteria->select= array('sum(rod.fOrderedQty) as TotalQty','roh.fisShiped as fisShiped','roh.fLocation as fLocation','fSellerOrderCode','fWaveKey','fContainerCode','fReceiptDate'); */
		$criteria->addBetweenCondition('fCreateDate', $this->fCreateDateBeginDate, $this->fCreateDateEndDate);
		$criteria->addBetweenCondition('fUpdateDate', $this->fUpdateDateBeginDate, $this->fUpdateDateBeginDate);
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
		$criteria->compare('fTemplateNo',$this->fTemplateNo,true);
		$criteria->compare('fTemplateType',$this->fTemplateType,true);
		$criteria->compare('fCreate',$this->fCreate,true);
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
			$criteria->addCondition("fUpdateDate <= '".$this->fUpdateDateBeginDate."'");

		/* $criteria->with  = array(
		 'roh',
				'rod'=> array('group'=>'`rod`.`fSourcePOKey`')
		); */
		/* $criteria->select= array('sum(rod.fOrderedQty) as TotalQty','roh.fisShiped as fisShiped','roh.fLocation as fLocation','fSellerOrderCode','fWaveKey','fContainerCode','fReceiptDate'); */
	/* 	$criteria->addBetweenCondition('fCreateDate', $this->fCreateDateBeginDate, $this->fCreateDateEndDate);
		$criteria->addBetweenCondition('fUpdateDate', $this->fUpdateDateBeginDate, $this->fUpdateDateBeginDate); */

		return $criteria;
	}
}