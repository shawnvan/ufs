<?php

/**
 * This is the model class for table "{{history}}".
 *
 * The followings are the available columns in table '{{history}}':
 * @property string $fItemNo
 * @property string $fHistoryNo
 * @property string $fHistoryeVolution
 * @property string $fStockeVolution
 * @property string $fLatestGreatBusinessRecombination
 * @property string $fLatestCorrelationTrade
 * @property string $fPublisherExplain
 * @property string $fTeamAppraise
 */
class History extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return History the static model class
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
		return '{{history}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fItemNo, fHistoryNo', 'required'),
			array('fItemNo, fHistoryNo', 'length', 'max'=>50),
			array('fHistoryeVolution, fStockeVolution, fLatestGreatBusinessRecombination, fLatestCorrelationTrade, fPublisherExplain, fTeamAppraise', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fItemNo, fHistoryNo, fHistoryeVolution, fStockeVolution, fLatestGreatBusinessRecombination, fLatestCorrelationTrade, fPublisherExplain, fTeamAppraise', 'safe', 'on'=>'search'),
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
			'fHistoryeVolution' => Yii::t('model','F Historye Volution'),
			'fStockeVolution' => Yii::t('model','F Stocke Volution'),
			'fLatestGreatBusinessRecombination' => Yii::t('model','F Latest Great Business Recombination'),
			'fLatestCorrelationTrade' => Yii::t('model','F Latest Correlation Trade'),
			'fPublisherExplain' => Yii::t('model','F Publisher Explain'),
			'fTeamAppraise' => Yii::t('model','F Team Appraise'),
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
		$criteria->compare('fHistoryeVolution',$this->fHistoryeVolution,true);
		$criteria->compare('fStockeVolution',$this->fStockeVolution,true);
		$criteria->compare('fLatestGreatBusinessRecombination',$this->fLatestGreatBusinessRecombination,true);
		$criteria->compare('fLatestCorrelationTrade',$this->fLatestCorrelationTrade,true);
		$criteria->compare('fPublisherExplain',$this->fPublisherExplain,true);
		$criteria->compare('fTeamAppraise',$this->fTeamAppraise,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}