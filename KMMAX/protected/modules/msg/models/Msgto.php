<?php

/**
 * This is the model class for table "{{msgto}}".
 *
 * The followings are the available columns in table '{{msgto}}':
 * @property string $fSendToNo
 * @property string $fSendFromNo
 * @property string $fSendToUserNo
 * @property string $fSendToAccount
 * @property string $fSendToName
 * @property string $fSendMsgStatus
 * @property integer $fSendToLookDate
 * @property string $fSendUserNo
 * @property string $fSendFromName
 * @property integer $fSendFromDate
 * @property string $fSendFromModule
 * @property string $fSendFromType
 * @property string $fSendFromTheme
 * @property string $fSendFromContent
 * @property string $fSendToAllUserNo
 * @property string $fSendToAllAccount
 * @property string $fSendToAllName
 * @property string $fRemark1
 * @property string $fRemark2
 * @property string $fRemark3
 */
class Msgto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Msgto the static model class
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
		return '{{msgto}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fSendToNo', 'required'),
			array('fSendToLookDate, fSendFromDate', 'numerical', 'integerOnly'=>true),
			array('fSendToNo, fSendFromNo, fSendToUserNo, fSendMsgStatus, fSendUserNo, fSendFromModule, fSendFromType', 'length', 'max'=>50),
			array('fSendToAccount, fSendToName, fSendFromName, fSendFromTheme, fSendToAllUserNo, fSendToAllAccount, fSendToAllName', 'length', 'max'=>200),
			array('fRemark1, fRemark2, fRemark3', 'length', 'max'=>2000),
			array('fSendFromContent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fSendToNo, fSendFromNo, fSendToUserNo, fSendToAccount, fSendToName, fSendMsgStatus, fSendToLookDate, fSendUserNo, fSendFromName, fSendFromDate, fSendFromModule, fSendFromType, fSendFromTheme, fSendFromContent, fSendToAllUserNo, fSendToAllAccount, fSendToAllName, fRemark1, fRemark2, fRemark3', 'safe', 'on'=>'search'),
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
			'fSendToNo' => Yii::t('model','F Send To No'),
			'fSendFromNo' => Yii::t('model','F Send From No'),
			'fSendToUserNo' => Yii::t('model','F Send To User No'),
			'fSendToAccount' => Yii::t('model','F Send To Account'),
			'fSendToName' => Yii::t('model','F Send To Name'),
			'fSendMsgStatus' => Yii::t('model','F Send Msg Status'),
			'fSendToLookDate' => Yii::t('model','F Send To Look Date'),
			'fSendUserNo' => Yii::t('model','F Send User No'),
			'fSendFromName' => Yii::t('model','F Send From Name'),
			'fSendFromDate' => Yii::t('model','F Send From Date'),
			'fSendFromModule' => Yii::t('model','F Send From Module'),
			'fSendFromType' => Yii::t('model','F Send From Type'),
			'fSendFromTheme' => Yii::t('model','F Send From Theme'),
			'fSendFromContent' => Yii::t('model','F Send From Content'),
			'fSendToAllUserNo' => Yii::t('model','F Send To All User No'),
			'fSendToAllAccount' => Yii::t('model','F Send To All Account'),
			'fSendToAllName' => Yii::t('model','F Send To All Name'),
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

		$criteria->compare('fSendToNo',$this->fSendToNo,true);
		$criteria->compare('fSendFromNo',$this->fSendFromNo,true);
		$criteria->compare('fSendToUserNo',$this->fSendToUserNo,true);
		$criteria->compare('fSendToAccount',$this->fSendToAccount,true);
		$criteria->compare('fSendToName',$this->fSendToName,true);
		$criteria->compare('fSendMsgStatus',$this->fSendMsgStatus,true);
		$criteria->compare('fSendToLookDate',$this->fSendToLookDate);
		$criteria->compare('fSendUserNo',$this->fSendUserNo,true);
		$criteria->compare('fSendFromName',$this->fSendFromName,true);
		$criteria->compare('fSendFromDate',$this->fSendFromDate);
		$criteria->compare('fSendFromModule',$this->fSendFromModule,true);
		$criteria->compare('fSendFromType',$this->fSendFromType,true);
		$criteria->compare('fSendFromTheme',$this->fSendFromTheme,true);
		$criteria->compare('fSendFromContent',$this->fSendFromContent,true);
		$criteria->compare('fSendToAllUserNo',$this->fSendToAllUserNo,true);
		$criteria->compare('fSendToAllAccount',$this->fSendToAllAccount,true);
		$criteria->compare('fSendToAllName',$this->fSendToAllName,true);
		$criteria->compare('fRemark1',$this->fRemark1,true);
		$criteria->compare('fRemark2',$this->fRemark2,true);
		$criteria->compare('fRemark3',$this->fRemark3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}