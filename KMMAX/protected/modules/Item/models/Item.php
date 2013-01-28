<?php

/**
 * This is the model class for table "{{item}}".
 *
 * The followings are the available columns in table '{{item}}':
 * @property string $fItemNo
 * @property string $fItemNum
 * @property string $fItemName
 * @property string $fItemType
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 * @property string $fContent
 * @property string $fRemark
 * @property string $fResponsibleCreate
 * @property string $fCompanyName
 * @property string $fCompanyaddress
 * @property string $fContactor
 * @property double $fCapitalAuthority
 * @property string $fSetTime
 * @property string $fCompanyType
 * @property string $fLegalRepresentative
 * @property string $fIndustry
 * @property string $fBusiness
 * @property string $fProduct
 * @property string $fShareholder
 * @property double $fShareholdeRatio
 * @property string $fRealityMan
 * @property string $fShareholderBackground
 * @property string $fProjectSituation
 * @property double $fItemIncome
 * @property string $fSetOwnership
 * @property string $fBusinessIintroduce
 * @property string $fDevelopForeground
 * @property string $fFuturePlans
 * @property string $fProfitForecast
 * @property string $fFundInvest
 * @property string $fItemRisk
 * @property string $fApplicantSummary
 * @property string $fOtherOpinion
 * @property string $fQualityOpinion
 * @property string $fPresidentOpinion
 * @property integer $fStatus
 * @property string $fUserGroup
 * @property string $fTemplateNo
 */
class Item extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Item the static model class
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
		return '{{item}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fItemNo', 'required'),
			array('fCreateDate, fUpdateDate, fStatus', 'numerical', 'integerOnly'=>true),
			array('fItemIncome,fCapitalAuthority, fShareholdeRatio', 'numerical'),
			array('fItemNo, fItemNum, fCreateUser, fUpdateUser, fResponsibleCreate,fContactor, fCompanyType, fLegalRepresentative, fIndustry, fRealityMan, fUserGroup, fTemplateNo', 'length', 'max'=>50),
			array('fItemName', 'length', 'max'=>200),
			array('fItemType', 'length', 'max'=>100),
			array('fCompanyName', 'length', 'max'=>500),
			array('fCompanyaddress, fShareholder', 'length', 'max'=>1000),
			array('fBusiness, fProduct', 'length', 'max'=>2000),
			array('fContent, fRemark, fSetOwnership, fSetTime, fShareholderBackground, fProjectSituation,fBusinessIintroduce, fDevelopForeground, fFuturePlans, fProfitForecast, fFundInvest, fItemRisk, fApplicantSummary, fOtherOpinion, fQualityOpinion, fPresidentOpinion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fItemNo, fItemNum, fItemName, fItemType, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate, fContent, fRemark, fResponsibleCreate, fCompanyName, fCompanyaddress, fContactor, fCapitalAuthority, fSetTime, fCompanyType, fLegalRepresentative, fIndustry, fBusiness, fProduct, fShareholder, fShareholdeRatio, fRealityMan, fShareholderBackground, fProjectSituation, fItemIncome, fSetOwnership, fBusinessIintroduce, fDevelopForeground, fFuturePlans, fProfitForecast, fFundInvest, fItemRisk, fApplicantSummary, fOtherOpinion, fQualityOpinion, fPresidentOpinion, fStatus, fUserGroup, fTemplateNo', 'safe', 'on'=>'search'),
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
				'template' => array(self::HAS_ONE, 'template', '', 'on' => 't.fTemplateNo=template.fTemplateNo'),
				'financeaccountings' => array(self::HAS_MANY, 'Financeaccounting', 'fItemNo'),
				'histories' => array(self::HAS_MANY, 'History', 'fItemNo'),
				'itemcatalogues' => array(self::HAS_MANY, 'Itemcatalogue', 'fItemId'),
				'itemplans' => array(self::HAS_MANY, 'Itemplan', 'fItemNo'),
				'itemusers' => array(self::HAS_MANY, 'Itemuser', 'fItemNo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fItemNo' => Yii::t('model','F Item No'),
			'fItemNum' => Yii::t('model','F Item Num'),
			'fItemName' => Yii::t('model','F Item Name'),
			'fItemType' => Yii::t('model','F Item Type'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fContent' => Yii::t('model','F Content'),
			'fRemark' => Yii::t('model','F Remark'),
			'fResponsibleCreate' => Yii::t('model','F Responsible Create'),
			'fCompanyName' => Yii::t('model','F Company Name'),
			'fCompanyaddress' => Yii::t('model','F Companyaddress'),
			'fContactor' => Yii::t('model','F Contactor'),
			'fCapitalAuthority' => Yii::t('model','F Capital Authority'),
			'fSetTime' => Yii::t('model','F Set Time'),
			'fCompanyType' => Yii::t('model','F Company Type'),
			'fLegalRepresentative' => Yii::t('model','F Legal Representative'),
			'fIndustry' => Yii::t('model','F Industry'),
			'fBusiness' => Yii::t('model','F Business'),
			'fProduct' => Yii::t('model','F Product'),
			'fShareholder' => Yii::t('model','F Shareholder'),
			'fShareholdeRatio' => Yii::t('model','F Shareholde Ratio'),
			'fRealityMan' => Yii::t('model','F Reality Man'),
			'fShareholderBackground' => Yii::t('model','F Shareholder Background'),
			'fProjectSituation' => Yii::t('model','F Project Situation'),
			'fItemIncome' => Yii::t('model','F Item Income'),
			'fSetOwnership' => Yii::t('model','F Set Ownership'),
			'fBusinessIintroduce' => Yii::t('model','F Business Iintroduce'),
			'fDevelopForeground' => Yii::t('model','F Develop Foreground'),
			'fFuturePlans' => Yii::t('model','F Future Plans'),
			'fProfitForecast' => Yii::t('model','F Profit Forecast'),
			'fFundInvest' => Yii::t('model','F Fund Invest'),
			'fItemRisk' => Yii::t('model','F Item Risk'),
			'fApplicantSummary' => Yii::t('model','F Applicant Summary'),
			'fOtherOpinion' => Yii::t('model','F Other Opinion'),
			'fQualityOpinion' => Yii::t('model','F Quality Opinion'),
			'fPresidentOpinion' => Yii::t('model','F President Opinion'),
			'fStatus' => Yii::t('model','F Status'),
			'fUserGroup' => Yii::t('model','F User Group'),
			'fTemplateNo' => Yii::t('model','F Template No'),
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
		$criteria->compare('fItemNo',$this->fItemNo,true);
		$criteria->compare('fItemNum',$this->fItemNum,true);
		$criteria->compare('fItemName',$this->fItemName,true);
		$criteria->compare('fItemType',$this->fItemType,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fContent',$this->fContent,true);
		$criteria->compare('fRemark',$this->fRemark,true);
		$criteria->compare('fResponsibleCreate',$this->fResponsibleCreate,true);
		$criteria->compare('fCompanyName',$this->fCompanyName,true);
		$criteria->compare('fCompanyaddress',$this->fCompanyaddress,true);
		$criteria->compare('fContactor',$this->fContactor,true);
		$criteria->compare('fCapitalAuthority',$this->fCapitalAuthority);
		$criteria->compare('fSetTime',$this->fSetTime,true);
		$criteria->compare('fCompanyType',$this->fCompanyType,true);
		$criteria->compare('fLegalRepresentative',$this->fLegalRepresentative,true);
		$criteria->compare('fIndustry',$this->fIndustry,true);
		$criteria->compare('fBusiness',$this->fBusiness,true);
		$criteria->compare('fProduct',$this->fProduct,true);
		$criteria->compare('fShareholder',$this->fShareholder,true);
		$criteria->compare('fShareholdeRatio',$this->fShareholdeRatio);
		$criteria->compare('fRealityMan',$this->fRealityMan,true);
		$criteria->compare('fShareholderBackground',$this->fShareholderBackground,true);
		$criteria->compare('fProjectSituation',$this->fProjectSituation,true);
		$criteria->compare('fItemIncome',$this->fItemIncome);
		$criteria->compare('fSetOwnership',$this->fSetOwnership,true);
		$criteria->compare('fBusinessIintroduce',$this->fBusinessIintroduce,true);
		$criteria->compare('fDevelopForeground',$this->fDevelopForeground,true);
		$criteria->compare('fFuturePlans',$this->fFuturePlans,true);
		$criteria->compare('fProfitForecast',$this->fProfitForecast,true);
		$criteria->compare('fFundInvest',$this->fFundInvest,true);
		$criteria->compare('fItemRisk',$this->fItemRisk,true);
		$criteria->compare('fApplicantSummary',$this->fApplicantSummary,true);
		$criteria->compare('fOtherOpinion',$this->fOtherOpinion,true);
		$criteria->compare('fQualityOpinion',$this->fQualityOpinion,true);
		$criteria->compare('fPresidentOpinion',$this->fPresidentOpinion,true);
		$criteria->compare('fStatus',$this->fStatus);
		$criteria->compare('fUserGroup',$this->fUserGroup,true);
		$criteria->compare('fTemplateNo',$this->fTemplateNo,true);

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
		$criteria->compare('fItemNum',$this->fItemNum,true);
		$criteria->compare('fItemName',$this->fItemName,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fResponsibleCreate',$this->fResponsibleCreate,true);
		$criteria->compare('fTemplateNo',$this->fTemplateNo,true);
		return $criteria;
	}
}