<?php

/**
 * This is the model class for table "{{financeaccounting}}".
 *
 * The followings are the available columns in table '{{financeaccounting}}':
 * @property string $fItemNo
 * @property double $fPropertyAll1
 * @property double $fPropertyIncrease1
 * @property double $fDebtAll1
 * @property double $fDebtIncrease1
 * @property double $fShareholderRights1
 * @property double $fShareholderRightsIncrease1
 * @property double $fPropertyDebt1
 * @property double $fPropertyDebtIncrease1
 * @property double $fBusinessReceipt1
 * @property double $fBusinessReceiptIncrease1
 * @property double $fClearProfit1
 * @property double $fClearProfitIncrease1
 * @property double $fPerStockProfit1
 * @property double $fPerStockProfitIncrease1
 * @property double $fPerStockIncome1
 * @property double $fPerStockIncomeIncrease1
 * @property double $fFreeCash1
 * @property double $fFreeCashIncrease1
 * @property double $fPropertyAll2
 * @property double $fPropertyIncrease2
 * @property double $fDebtAll2
 * @property double $fDebtIncrease2
 * @property double $fShareholderRights2
 * @property double $fShareholderRightsIncrease2
 * @property double $fPropertyDebt2
 * @property double $fPropertyDebtIncrease2
 * @property double $fBusinessReceipt2
 * @property double $fBusinessReceiptIncrease2
 * @property double $fClearProfit2
 * @property double $fClearProfitIncrease2
 * @property double $fPerStockProfit2
 * @property double $fPerStockProfitIncrease2
 * @property double $fPerStockIncome2
 * @property double $fPerStockIncomeIncrease2
 * @property double $fFreeCash2
 * @property double $fFreeCashIncrease2
 * @property double $fPropertyAll3
 * @property double $fPropertyIncrease3
 * @property double $fDebtAll3
 * @property double $fDebtIncrease3
 * @property double $fShareholderRights3
 * @property double $fShareholderRightsIncrease3
 * @property double $fPropertyDebt3
 * @property double $fPropertyDebtIncrease3
 * @property double $fBusinessReceipt3
 * @property double $fBusinessReceiptIncrease3
 * @property double $fClearProfit3
 * @property double $fClearProfitIncrease3
 * @property double $fPerStockProfit3
 * @property double $fPerStockProfitIncrease3
 * @property double $fPerStockIncome3
 * @property double $fPerStockIncomeIncrease3
 * @property double $fFreeCash3
 * @property double $fFreeCashIncrease3
 * @property string $fAuditOpinion1
 * @property string $fAuditOpinion2
 * @property string $fAuditOpinion3
 * @property double $fInvisiblePropertyRate
 * @property string $fFinanceAnalyse
 * @property string $fAffixName1
 * @property string $fAffixAddress1
 * @property string $fAffixName2
 * @property string $fAffixAddress2
 * @property string $fAffixName3
 * @property string $fAffixAddress3
 */
class Financeaccounting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Financeaccounting the static model class
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
		return '{{financeaccounting}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fPropertyAll1, fPropertyIncrease1, fDebtAll1, fDebtIncrease1, fShareholderRights1, fShareholderRightsIncrease1, fPropertyDebt1, fPropertyDebtIncrease1, fBusinessReceipt1, fBusinessReceiptIncrease1, fClearProfit1, fClearProfitIncrease1, fPerStockProfit1, fPerStockProfitIncrease1, fPerStockIncome1, fPerStockIncomeIncrease1, fFreeCash1, fFreeCashIncrease1, fPropertyAll2, fPropertyIncrease2, fDebtAll2, fDebtIncrease2, fShareholderRights2, fShareholderRightsIncrease2, fPropertyDebt2, fPropertyDebtIncrease2, fBusinessReceipt2, fBusinessReceiptIncrease2, fClearProfit2, fClearProfitIncrease2, fPerStockProfit2, fPerStockProfitIncrease2, fPerStockIncome2, fPerStockIncomeIncrease2, fFreeCash2, fFreeCashIncrease2, fPropertyAll3, fPropertyIncrease3, fDebtAll3, fDebtIncrease3, fShareholderRights3, fShareholderRightsIncrease3, fPropertyDebt3, fPropertyDebtIncrease3, fBusinessReceipt3, fBusinessReceiptIncrease3, fClearProfit3, fClearProfitIncrease3, fPerStockProfit3, fPerStockProfitIncrease3, fPerStockIncome3, fPerStockIncomeIncrease3, fFreeCash3, fFreeCashIncrease3, fInvisiblePropertyRate', 'numerical'),
			array('fItemNo', 'length', 'max'=>50),
			array('fAffixName1, fAffixName2, fAffixName3', 'length', 'max'=>200),
			array('fAffixAddress1, fAffixAddress2, fAffixAddress3', 'length', 'max'=>500),
			array('fAuditOpinion1, fAuditOpinion2, fAuditOpinion3, fFinanceAnalyse', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fItemNo, fPropertyAll1, fPropertyIncrease1, fDebtAll1, fDebtIncrease1, fShareholderRights1, fShareholderRightsIncrease1, fPropertyDebt1, fPropertyDebtIncrease1, fBusinessReceipt1, fBusinessReceiptIncrease1, fClearProfit1, fClearProfitIncrease1, fPerStockProfit1, fPerStockProfitIncrease1, fPerStockIncome1, fPerStockIncomeIncrease1, fFreeCash1, fFreeCashIncrease1, fPropertyAll2, fPropertyIncrease2, fDebtAll2, fDebtIncrease2, fShareholderRights2, fShareholderRightsIncrease2, fPropertyDebt2, fPropertyDebtIncrease2, fBusinessReceipt2, fBusinessReceiptIncrease2, fClearProfit2, fClearProfitIncrease2, fPerStockProfit2, fPerStockProfitIncrease2, fPerStockIncome2, fPerStockIncomeIncrease2, fFreeCash2, fFreeCashIncrease2, fPropertyAll3, fPropertyIncrease3, fDebtAll3, fDebtIncrease3, fShareholderRights3, fShareholderRightsIncrease3, fPropertyDebt3, fPropertyDebtIncrease3, fBusinessReceipt3, fBusinessReceiptIncrease3, fClearProfit3, fClearProfitIncrease3, fPerStockProfit3, fPerStockProfitIncrease3, fPerStockIncome3, fPerStockIncomeIncrease3, fFreeCash3, fFreeCashIncrease3, fAuditOpinion1, fAuditOpinion2, fAuditOpinion3, fInvisiblePropertyRate, fFinanceAnalyse, fAffixName1, fAffixAddress1, fAffixName2, fAffixAddress2, fAffixName3, fAffixAddress3', 'safe', 'on'=>'search'),
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
			'fItemNo' => Yii::t('model','F Item No'),
			'fPropertyAll1' => Yii::t('model','F Property All1'),
			'fPropertyIncrease1' => Yii::t('model','F Property Increase1'),
			'fDebtAll1' => Yii::t('model','F Debt All1'),
			'fDebtIncrease1' => Yii::t('model','F Debt Increase1'),
			'fShareholderRights1' => Yii::t('model','F Shareholder Rights1'),
			'fShareholderRightsIncrease1' => Yii::t('model','F Shareholder Rights Increase1'),
			'fPropertyDebt1' => Yii::t('model','F Property Debt1'),
			'fPropertyDebtIncrease1' => Yii::t('model','F Property Debt Increase1'),
			'fBusinessReceipt1' => Yii::t('model','F Business Receipt1'),
			'fBusinessReceiptIncrease1' => Yii::t('model','F Business Receipt Increase1'),
			'fClearProfit1' => Yii::t('model','F Clear Profit1'),
			'fClearProfitIncrease1' => Yii::t('model','F Clear Profit Increase1'),
			'fPerStockProfit1' => Yii::t('model','F Per Stock Profit1'),
			'fPerStockProfitIncrease1' => Yii::t('model','F Per Stock Profit Increase1'),
			'fPerStockIncome1' => Yii::t('model','F Per Stock Income1'),
			'fPerStockIncomeIncrease1' => Yii::t('model','F Per Stock Income Increase1'),
			'fFreeCash1' => Yii::t('model','F Free Cash1'),
			'fFreeCashIncrease1' => Yii::t('model','F Free Cash Increase1'),
			'fPropertyAll2' => Yii::t('model','F Property All2'),
			'fPropertyIncrease2' => Yii::t('model','F Property Increase2'),
			'fDebtAll2' => Yii::t('model','F Debt All2'),
			'fDebtIncrease2' => Yii::t('model','F Debt Increase2'),
			'fShareholderRights2' => Yii::t('model','F Shareholder Rights2'),
			'fShareholderRightsIncrease2' => Yii::t('model','F Shareholder Rights Increase2'),
			'fPropertyDebt2' => Yii::t('model','F Property Debt2'),
			'fPropertyDebtIncrease2' => Yii::t('model','F Property Debt Increase2'),
			'fBusinessReceipt2' => Yii::t('model','F Business Receipt2'),
			'fBusinessReceiptIncrease2' => Yii::t('model','F Business Receipt Increase2'),
			'fClearProfit2' => Yii::t('model','F Clear Profit2'),
			'fClearProfitIncrease2' => Yii::t('model','F Clear Profit Increase2'),
			'fPerStockProfit2' => Yii::t('model','F Per Stock Profit2'),
			'fPerStockProfitIncrease2' => Yii::t('model','F Per Stock Profit Increase2'),
			'fPerStockIncome2' => Yii::t('model','F Per Stock Income2'),
			'fPerStockIncomeIncrease2' => Yii::t('model','F Per Stock Income Increase2'),
			'fFreeCash2' => Yii::t('model','F Free Cash2'),
			'fFreeCashIncrease2' => Yii::t('model','F Free Cash Increase2'),
			'fPropertyAll3' => Yii::t('model','F Property All3'),
			'fPropertyIncrease3' => Yii::t('model','F Property Increase3'),
			'fDebtAll3' => Yii::t('model','F Debt All3'),
			'fDebtIncrease3' => Yii::t('model','F Debt Increase3'),
			'fShareholderRights3' => Yii::t('model','F Shareholder Rights3'),
			'fShareholderRightsIncrease3' => Yii::t('model','F Shareholder Rights Increase3'),
			'fPropertyDebt3' => Yii::t('model','F Property Debt3'),
			'fPropertyDebtIncrease3' => Yii::t('model','F Property Debt Increase3'),
			'fBusinessReceipt3' => Yii::t('model','F Business Receipt3'),
			'fBusinessReceiptIncrease3' => Yii::t('model','F Business Receipt Increase3'),
			'fClearProfit3' => Yii::t('model','F Clear Profit3'),
			'fClearProfitIncrease3' => Yii::t('model','F Clear Profit Increase3'),
			'fPerStockProfit3' => Yii::t('model','F Per Stock Profit3'),
			'fPerStockProfitIncrease3' => Yii::t('model','F Per Stock Profit Increase3'),
			'fPerStockIncome3' => Yii::t('model','F Per Stock Income3'),
			'fPerStockIncomeIncrease3' => Yii::t('model','F Per Stock Income Increase3'),
			'fFreeCash3' => Yii::t('model','F Free Cash3'),
			'fFreeCashIncrease3' => Yii::t('model','F Free Cash Increase3'),
			'fAuditOpinion1' => Yii::t('model','F Audit Opinion1'),
			'fAuditOpinion2' => Yii::t('model','F Audit Opinion2'),
			'fAuditOpinion3' => Yii::t('model','F Audit Opinion3'),
			'fInvisiblePropertyRate' => Yii::t('model','F Invisible Property Rate'),
			'fFinanceAnalyse' => Yii::t('model','F Finance Analyse'),
			'fAffixName1' => Yii::t('model','F Affix Name1'),
			'fAffixAddress1' => Yii::t('model','F Affix Address1'),
			'fAffixName2' => Yii::t('model','F Affix Name2'),
			'fAffixAddress2' => Yii::t('model','F Affix Address2'),
			'fAffixName3' => Yii::t('model','F Affix Name3'),
			'fAffixAddress3' => Yii::t('model','F Affix Address3'),
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
		$criteria->compare('fPropertyAll1',$this->fPropertyAll1);
		$criteria->compare('fPropertyIncrease1',$this->fPropertyIncrease1);
		$criteria->compare('fDebtAll1',$this->fDebtAll1);
		$criteria->compare('fDebtIncrease1',$this->fDebtIncrease1);
		$criteria->compare('fShareholderRights1',$this->fShareholderRights1);
		$criteria->compare('fShareholderRightsIncrease1',$this->fShareholderRightsIncrease1);
		$criteria->compare('fPropertyDebt1',$this->fPropertyDebt1);
		$criteria->compare('fPropertyDebtIncrease1',$this->fPropertyDebtIncrease1);
		$criteria->compare('fBusinessReceipt1',$this->fBusinessReceipt1);
		$criteria->compare('fBusinessReceiptIncrease1',$this->fBusinessReceiptIncrease1);
		$criteria->compare('fClearProfit1',$this->fClearProfit1);
		$criteria->compare('fClearProfitIncrease1',$this->fClearProfitIncrease1);
		$criteria->compare('fPerStockProfit1',$this->fPerStockProfit1);
		$criteria->compare('fPerStockProfitIncrease1',$this->fPerStockProfitIncrease1);
		$criteria->compare('fPerStockIncome1',$this->fPerStockIncome1);
		$criteria->compare('fPerStockIncomeIncrease1',$this->fPerStockIncomeIncrease1);
		$criteria->compare('fFreeCash1',$this->fFreeCash1);
		$criteria->compare('fFreeCashIncrease1',$this->fFreeCashIncrease1);
		$criteria->compare('fPropertyAll2',$this->fPropertyAll2);
		$criteria->compare('fPropertyIncrease2',$this->fPropertyIncrease2);
		$criteria->compare('fDebtAll2',$this->fDebtAll2);
		$criteria->compare('fDebtIncrease2',$this->fDebtIncrease2);
		$criteria->compare('fShareholderRights2',$this->fShareholderRights2);
		$criteria->compare('fShareholderRightsIncrease2',$this->fShareholderRightsIncrease2);
		$criteria->compare('fPropertyDebt2',$this->fPropertyDebt2);
		$criteria->compare('fPropertyDebtIncrease2',$this->fPropertyDebtIncrease2);
		$criteria->compare('fBusinessReceipt2',$this->fBusinessReceipt2);
		$criteria->compare('fBusinessReceiptIncrease2',$this->fBusinessReceiptIncrease2);
		$criteria->compare('fClearProfit2',$this->fClearProfit2);
		$criteria->compare('fClearProfitIncrease2',$this->fClearProfitIncrease2);
		$criteria->compare('fPerStockProfit2',$this->fPerStockProfit2);
		$criteria->compare('fPerStockProfitIncrease2',$this->fPerStockProfitIncrease2);
		$criteria->compare('fPerStockIncome2',$this->fPerStockIncome2);
		$criteria->compare('fPerStockIncomeIncrease2',$this->fPerStockIncomeIncrease2);
		$criteria->compare('fFreeCash2',$this->fFreeCash2);
		$criteria->compare('fFreeCashIncrease2',$this->fFreeCashIncrease2);
		$criteria->compare('fPropertyAll3',$this->fPropertyAll3);
		$criteria->compare('fPropertyIncrease3',$this->fPropertyIncrease3);
		$criteria->compare('fDebtAll3',$this->fDebtAll3);
		$criteria->compare('fDebtIncrease3',$this->fDebtIncrease3);
		$criteria->compare('fShareholderRights3',$this->fShareholderRights3);
		$criteria->compare('fShareholderRightsIncrease3',$this->fShareholderRightsIncrease3);
		$criteria->compare('fPropertyDebt3',$this->fPropertyDebt3);
		$criteria->compare('fPropertyDebtIncrease3',$this->fPropertyDebtIncrease3);
		$criteria->compare('fBusinessReceipt3',$this->fBusinessReceipt3);
		$criteria->compare('fBusinessReceiptIncrease3',$this->fBusinessReceiptIncrease3);
		$criteria->compare('fClearProfit3',$this->fClearProfit3);
		$criteria->compare('fClearProfitIncrease3',$this->fClearProfitIncrease3);
		$criteria->compare('fPerStockProfit3',$this->fPerStockProfit3);
		$criteria->compare('fPerStockProfitIncrease3',$this->fPerStockProfitIncrease3);
		$criteria->compare('fPerStockIncome3',$this->fPerStockIncome3);
		$criteria->compare('fPerStockIncomeIncrease3',$this->fPerStockIncomeIncrease3);
		$criteria->compare('fFreeCash3',$this->fFreeCash3);
		$criteria->compare('fFreeCashIncrease3',$this->fFreeCashIncrease3);
		$criteria->compare('fAuditOpinion1',$this->fAuditOpinion1,true);
		$criteria->compare('fAuditOpinion2',$this->fAuditOpinion2,true);
		$criteria->compare('fAuditOpinion3',$this->fAuditOpinion3,true);
		$criteria->compare('fInvisiblePropertyRate',$this->fInvisiblePropertyRate);
		$criteria->compare('fFinanceAnalyse',$this->fFinanceAnalyse,true);
		$criteria->compare('fAffixName1',$this->fAffixName1,true);
		$criteria->compare('fAffixAddress1',$this->fAffixAddress1,true);
		$criteria->compare('fAffixName2',$this->fAffixName2,true);
		$criteria->compare('fAffixAddress2',$this->fAffixAddress2,true);
		$criteria->compare('fAffixName3',$this->fAffixName3,true);
		$criteria->compare('fAffixAddress3',$this->fAffixAddress3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}