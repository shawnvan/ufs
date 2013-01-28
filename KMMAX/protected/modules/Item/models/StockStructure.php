<?php

/**
 * This is the model class for table "{{stockstructure}}".
 *
 * The followings are the available columns in table '{{stockstructure}}':
 * @property string $fSSNo
 * @property string $fItemNo
 * @property string $fHistoryNo
 * @property string $fShareholderName
 * @property double $fShareholdingNum
 * @property double $fShareholderRate
 */
class StockStructure extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StockStructure the static model class
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
		return '{{stockstructure}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fSSNo', 'required'),
			array('fShareholdingNum, fShareholderRate', 'numerical'),
			array('fSSNo, fItemNo, fHistoryNo, fShareholderName', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fSSNo, fItemNo, fHistoryNo, fShareholderName, fShareholdingNum, fShareholderRate', 'safe', 'on'=>'search'),
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
			'fSSNo' => Yii::t('model','F Ssno'),
			'fItemNo' => Yii::t('model','F Item No'),
			'fHistoryNo' => Yii::t('model','F History No'),
			'fShareholderName' => Yii::t('model','F Shareholder Name'),
			'fShareholdingNum' => Yii::t('model','F Shareholding Num'),
			'fShareholderRate' => Yii::t('model','F Shareholder Rate'),
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

		$criteria->compare('fSSNo',$this->fSSNo,true);
		$criteria->compare('fItemNo',$this->fItemNo,true);
		$criteria->compare('fHistoryNo',$this->fHistoryNo,true);
		$criteria->compare('fShareholderName',$this->fShareholderName,true);
		$criteria->compare('fShareholdingNum',$this->fShareholdingNum);
		$criteria->compare('fShareholderRate',$this->fShareholderRate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}