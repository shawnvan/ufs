<?php

/**
 * This is the model class for table "{{itemplan}}".
 *
 * The followings are the available columns in table '{{itemplan}}':
 * @property string $fItemNo
 * @property string $fItemTimeNode
 * @property string $fItemStart
 * @property string $fItemEnd
 * @property string $fItemPerson
 * @property double $fItemFee
 * @property string $fItemOtherPerson
 */
class Itemplan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Itemplan the static model class
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
		return '{{itemplan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fItemFee', 'numerical'),
			array('fItemNo', 'length', 'max'=>50),
			array('fItemPerson, fItemOtherPerson', 'length', 'max'=>200),
			array('fItemTimeNode, fItemStart, fItemEnd', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fItemNo, fItemTimeNode, fItemStart, fItemEnd, fItemPerson, fItemFee, fItemOtherPerson', 'safe', 'on'=>'search'),
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
			'fItemTimeNode' => Yii::t('model','F Item Time Node'),
			'fItemStart' => Yii::t('model','F Item Start'),
			'fItemEnd' => Yii::t('model','F Item End'),
			'fItemPerson' => Yii::t('model','F Item Person'),
			'fItemFee' => Yii::t('model','F Item Fee'),
			'fItemOtherPerson' => Yii::t('model','F Item Other Person'),
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
		$criteria->compare('fItemTimeNode',$this->fItemTimeNode,true);
		$criteria->compare('fItemStart',$this->fItemStart,true);
		$criteria->compare('fItemEnd',$this->fItemEnd,true);
		$criteria->compare('fItemPerson',$this->fItemPerson,true);
		$criteria->compare('fItemFee',$this->fItemFee);
		$criteria->compare('fItemOtherPerson',$this->fItemOtherPerson,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}