<?php

/**
 * This is the model class for table "{{knowledgecatalogue}}".
 *
 * The followings are the available columns in table '{{knowledgecatalogue}}':
 * @property string $fCatalogueNo
 * @property string $fCatalogueName
 * @property string $fFatherCatalogueNo
 * @property string $fStatus
 * @property string $fIsDownLoad
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 * @property string $fUserGroup
 * @property string $fMemo1
 * @property string $fMemo2
 */
class Knowledgecatalogue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Knowledgecatalogue the static model class
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
		return '{{knowledgecatalogue}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fCatalogueNo', 'required'),
			array('fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fCatalogueNo, fIsDownLoad,fFatherCatalogueNo, fStatus, fCreateUser, fUpdateUser, fUserGroup, fMemo1, fMemo2', 'length', 'max'=>50),
			array('fCatalogueName', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fCatalogueNo, fCatalogueName, fIsDownLoad,fFatherCatalogueNo, fStatus, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate, fUserGroup, fMemo1, fMemo2', 'safe', 'on'=>'search'),
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
				'fatherknowledgecatalogue' => array(self::HAS_ONE, 'knowledgecatalogue', '', 'on' => 't.fFatherCatalogueNo=fatherknowledgecatalogue.fCatalogueNo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fCatalogueNo' => Yii::t('model','F Catalogue No'),
			'fCatalogueName' => Yii::t('model','F Catalogue Name'),
			'fFatherCatalogueNo' => Yii::t('model','F Father Catalogue No'),
			'fStatus' => Yii::t('model','F Status'),
		    'fIsDownLoad' => Yii::t('model','F Is Down Load'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fUserGroup' => Yii::t('model','F User Group'),
			'fMemo1' => Yii::t('model','F Memo1'),
			'fMemo2' => Yii::t('model','F Memo2'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('fCatalogueNo',$this->fCatalogueNo,true);
		$criteria->compare('fCatalogueName',$this->fCatalogueName,true);
		$criteria->compare('fFatherCatalogueNo',$this->fFatherCatalogueNo,true);
		$criteria->compare('fStatus',$this->fStatus,true);
		$criteria->compare('fIsDownLoad',$this->fIsDownLoad,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fUserGroup',$this->fUserGroup,true);
		$criteria->compare('fMemo1',$this->fMemo1,true);
		$criteria->compare('fMemo2',$this->fMemo2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}