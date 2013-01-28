<?php

/**
 * This is the model class for table "{{msgfrom}}".
 *
 * The followings are the available columns in table '{{msgfrom}}':
 * @property string $fSendFromNo
 * @property string $fSendFromUserNo
 * @property string $fSendFromName
 * @property string $fSendFromContent
 * @property string $fSendFromModule
 * @property string $fSendFromType
 * @property integer $fSendFromDate
 * @property string $fSendFromTheme
 * @property string $fSendFromStatus
 * @property string $fSendToUserNo
 * @property string $fSendToAccount
 * @property string $fSendToName
 * @property string $fRemark1
 * @property string $fRemark2
 * @property string $fRemark3
 */
class Msgfrom extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Msgfrom the static model class
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
		return '{{msgfrom}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fSendFromNo', 'required'),
			array('fSendFromDate', 'numerical', 'integerOnly'=>true),
			array('fSendFromNo, fSendFromUserNo, fSendFromModule, fSendFromType, fSendFromStatus', 'length', 'max'=>50),
			array('fSendFromName, fSendFromTheme, fSendToUserNo, fSendToAccount, fSendToName', 'length', 'max'=>200),
			array('fRemark1, fRemark2, fRemark3', 'length', 'max'=>2000),
			array('fSendFromContent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fSendFromNo, fSendFromUserNo, fSendFromName, fSendFromContent, fSendFromModule, fSendFromType, fSendFromDate, fSendFromTheme, fSendFromStatus, fSendToUserNo, fSendToAccount, fSendToName, fRemark1, fRemark2, fRemark3', 'safe', 'on'=>'search'),
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
			'fSendFromNo' => Yii::t('model','F Send From No'),
			'fSendFromUserNo' => Yii::t('model','F Send From User No'),
			'fSendFromName' => Yii::t('model','F Send From Name'),
			'fSendFromContent' => Yii::t('model','F Send From Content'),
			'fSendFromModule' => Yii::t('model','F Send From Module'),
			'fSendFromType' => Yii::t('model','F Send From Type'),
			'fSendFromDate' => Yii::t('model','F Send From Date'),
			'fSendFromTheme' => Yii::t('model','F Send From Theme'),
			'fSendFromStatus' => Yii::t('model','F Send From Status'),
			'fSendToUserNo' => Yii::t('model','F Send To User No'),
			'fSendToAccount' => Yii::t('model','F Send To Account'),
			'fSendToName' => Yii::t('model','F Send To Name'),
			'fRemark1' => Yii::t('model','F Remark1'),
			'fRemark2' => Yii::t('model','F Remark2'),
			'fRemark3' => Yii::t('model','F Remark3'),
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

		$criteria->compare('fSendFromNo',$this->fSendFromNo,true);
		$criteria->compare('fSendFromUserNo',$this->fSendFromUserNo,true);
		$criteria->compare('fSendFromName',$this->fSendFromName,true);
		$criteria->compare('fSendFromContent',$this->fSendFromContent,true);
		$criteria->compare('fSendFromModule',$this->fSendFromModule,true);
		$criteria->compare('fSendFromType',$this->fSendFromType,true);
		$criteria->compare('fSendFromDate',$this->fSendFromDate);
		$criteria->compare('fSendFromTheme',$this->fSendFromTheme,true);
		$criteria->compare('fSendFromStatus',$this->fSendFromStatus,true);
		$criteria->compare('fSendToUserNo',$this->fSendToUserNo,true);
		$criteria->compare('fSendToAccount',$this->fSendToAccount,true);
		$criteria->compare('fSendToName',$this->fSendToName,true);
		$criteria->compare('fRemark1',$this->fRemark1,true);
		$criteria->compare('fRemark2',$this->fRemark2,true);
		$criteria->compare('fRemark3',$this->fRemark3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}