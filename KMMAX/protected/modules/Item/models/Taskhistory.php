<?php

/**
 * This is the model class for table "{{taskhistory}}".
 *
 * The followings are the available columns in table '{{taskhistory}}':
 * @property string $fTaskHistoryNo
 * @property string $fTaskNo
 * @property string $fAction
 * @property integer $fActionDate
 * @property string $fContent
 * @property string $fMemo
 * @property string $fActionUser
 * @property integer $fFinishPercent
 * @property string $fAttchFalseName
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fAttchName
 */
class Taskhistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Taskhistory the static model class
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
		return '{{taskhistory}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fTaskHistoryNo', 'required'),
			array('fActionDate, fFinishPercent, fCreateDate', 'numerical', 'integerOnly'=>true),
			array('fTaskHistoryNo, fTaskNo, fAction, fActionUser, fCreateUser', 'length', 'max'=>50),
			array('fAttchFalseName', 'length', 'max'=>200),
			array('fAttchName', 'length', 'max'=>500),
			array('fContent, fMemo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fTaskHistoryNo, fTaskNo, fAction, fActionDate, fContent, fMemo, fActionUser, fFinishPercent, fAttchFalseName, fCreateUser, fCreateDate, fAttchName', 'safe', 'on'=>'search'),
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
			'fTaskHistoryNo' => '历史编号',
			'fTaskNo' => '任务编号',
			'fAction' => '操作',
			'fActionDate' => '操作时间',
			'fContent' => '操作内容',
			'fMemo' => '备注',
			'fActionUser' => '操作用户',
			'fFinishPercent' => '任务百分比',
			'fAttchFalseName' => '附件名称',
			'fCreateUser' => '创建用户',
			'fCreateDate' => '创建时间',
			'fAttchName' => '附件名称',
		);
	}
}