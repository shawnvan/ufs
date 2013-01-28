<?php

/**
 * This is the model class for table "{{lateststockstructure}}".
 *
 * The followings are the available columns in table '{{lateststockstructure}}':
 * @property string $fItemNo
 * @property string $fHistoryNo
 * @property string $fShareholderName
 * @property double $fFristStrands
 * @property double $fFristRate
 * @property double $fSecondStrands
 * @property double $fSecondRate
 * @property double $fThirdStrands
 * @property double $fThirdRate
 */
class LatestStockStructure extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LatestStockStructure the static model class
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
		return '{{lateststockstructure}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fFristStrands, fFristRate, fSecondStrands, fSecondRate, fThirdStrands, fThirdRate', 'numerical'),
			array('fItemNo, fHistoryNo', 'length', 'max'=>50),
			array('fShareholderName', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fItemNo, fHistoryNo, fShareholderName, fFristStrands, fFristRate, fSecondStrands, fSecondRate, fThirdStrands, fThirdRate', 'safe', 'on'=>'search'),
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
			'fHistoryNo' => Yii::t('model','F History No'),
			'fShareholderName' => Yii::t('model','F Shareholder Name'),
			'fFristStrands' => Yii::t('model','F Frist Strands'),
			'fFristRate' => Yii::t('model','F Frist Rate'),
			'fSecondStrands' => Yii::t('model','F Second Strands'),
			'fSecondRate' => Yii::t('model','F Second Rate'),
			'fThirdStrands' => Yii::t('model','F Third Strands'),
			'fThirdRate' => Yii::t('model','F Third Rate'),
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
		$criteria->compare('fHistoryNo',$this->fHistoryNo,true);
		$criteria->compare('fShareholderName',$this->fShareholderName,true);
		$criteria->compare('fFristStrands',$this->fFristStrands);
		$criteria->compare('fFristRate',$this->fFristRate);
		$criteria->compare('fSecondStrands',$this->fSecondStrands);
		$criteria->compare('fSecondRate',$this->fSecondRate);
		$criteria->compare('fThirdStrands',$this->fThirdStrands);
		$criteria->compare('fThirdRate',$this->fThirdRate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}