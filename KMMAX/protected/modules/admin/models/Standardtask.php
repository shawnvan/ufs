<?php

/**
 * This is the model class for table "{{standardtask}}".
 *
 * The followings are the available columns in table '{{standardtask}}':
 * @property string $fTaskNo
 * @property string $fCatalogueNo
 * @property string $fAttachNo
 * @property string $fAttachName
 * @property string $fAttachFalseName
 * @property string $fItemNo
 * @property string $fOldTaskNo
 * @property string $fTheme
 * @property string $fContent
 * @property string $fRemarks
 * @property string $fTaskType
 * @property string $fSubmitUser
 * @property integer $fSubmitDate
 * @property string $fConfirmUser
 * @property integer $fConfirmDate
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fStatus
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 * @property string $fRemarks1
 * @property string $fRemarks2
 * @property string $fRemarks3
 * @property string $fRemarks4
 * @property string $fRemarks5
 * @property string $fUserGroup
 */
class Standardtask extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Standardtask the static model class
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
		return '{{standardtask}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fTaskNo', 'required'),
			array('fSubmitDate, fConfirmDate, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fTaskNo, fCatalogueNo, fAttachNo, fItemNo, fOldTaskNo, fTaskType, fSubmitUser, fConfirmUser, fCreateUser, fUpdateUser, fUserGroup', 'length', 'max'=>50),
			array('fAttachName', 'length', 'max'=>500),
			array('fAttachFalseName, fTheme', 'length', 'max'=>200),
			array('fStatus', 'length', 'max'=>20),
			array('fContent, fRemarks, fRemarks1, fRemarks2, fRemarks3, fRemarks4, fRemarks5', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fTaskNo, fCatalogueNo, fAttachNo, fAttachName, fAttachFalseName, fItemNo, fOldTaskNo, fTheme, fContent, fRemarks, fTaskType, fSubmitUser, fSubmitDate, fConfirmUser, fConfirmDate, fCreateUser, fCreateDate, fStatus, fUpdateUser, fUpdateDate, fRemarks1, fRemarks2, fRemarks3, fRemarks4, fRemarks5, fUserGroup', 'safe', 'on'=>'search'),
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
			'knowledgecatalogue' => array(self::HAS_ONE, 'knowledgecatalogue', '', 'on' => 't.fCatalogueNo=knowledgecatalogue.fCatalogueNo'),
			'item' => array(self::HAS_ONE, 'Item', '', 'on' => 't.fItemNo=item.fItemNo'),
			'task' => array(self::HAS_ONE, 'Task', '', 'on' => 't.fOldTaskNo=task.fTaskNo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fTaskNo' => Yii::t('model','F Task No'),
			'fCatalogueNo' => Yii::t('model','F Catalogue No'),
			'fAttachNo' => Yii::t('model','F Attach No'),
			'fAttachName' => Yii::t('model','F Attach Name'),
			'fAttachFalseName' => Yii::t('model','F Attach False Name'),
			'fItemNo' => Yii::t('model','F Item No'),
			'fOldTaskNo' => Yii::t('model','F Old Task No'),
			'fTheme' => Yii::t('model','F Theme'),
			'fContent' => Yii::t('model','F Content'),
			'fRemarks' => Yii::t('model','F Remarks'),
			'fTaskType' => Yii::t('model','F Task Type'),
			'fSubmitUser' => Yii::t('model','F Submit User'),
			'fSubmitDate' => Yii::t('model','F Submit Date'),
			'fConfirmUser' => Yii::t('model','F Confirm User'),
			'fConfirmDate' => Yii::t('model','F Confirm Date'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fStatus' => Yii::t('model','F Status'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fRemarks1' => Yii::t('model','F Remarks1'),
			'fRemarks2' => Yii::t('model','F Remarks2'),
			'fRemarks3' => Yii::t('model','F Remarks3'),
			'fRemarks4' => Yii::t('model','F Remarks4'),
			'fRemarks5' => Yii::t('model','F Remarks5'),
			'fUserGroup' => Yii::t('model','F User Group'),
		);
	}
	/**
	 * 高级查询
	 * @return CDbCriteria
	 */
	public function AdvancedSearch(){
		$criteria=new CDbCriteria;
		$criteria->compare('fAttachName',$this->fAttachName,true);
		$criteria->compare('fTheme',$this->fTheme,true);
		$criteria->compare('fSubmitUser',$this->fSubmitUser,true);
		$criteria->compare('fConfirmUser',$this->fConfirmUser,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);		
		return $criteria;
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

		$criteria->compare('fTaskNo',$this->fTaskNo,true);
		$criteria->compare('fCatalogueNo',$this->fCatalogueNo,true);
		$criteria->compare('fAttachNo',$this->fAttachNo,true);
		$criteria->compare('fAttachName',$this->fAttachName,true);
		$criteria->compare('fAttachFalseName',$this->fAttachFalseName,true);
		$criteria->compare('fItemNo',$this->fItemNo,true);
		$criteria->compare('fOldTaskNo',$this->fOldTaskNo,true);
		$criteria->compare('fTheme',$this->fTheme,true);
		$criteria->compare('fContent',$this->fContent,true);
		$criteria->compare('fRemarks',$this->fRemarks,true);
		$criteria->compare('fTaskType',$this->fTaskType,true);
		$criteria->compare('fSubmitUser',$this->fSubmitUser,true);
		$criteria->compare('fSubmitDate',$this->fSubmitDate);
		$criteria->compare('fConfirmUser',$this->fConfirmUser,true);
		$criteria->compare('fConfirmDate',$this->fConfirmDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fStatus',$this->fStatus,true);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fRemarks1',$this->fRemarks1,true);
		$criteria->compare('fRemarks2',$this->fRemarks2,true);
		$criteria->compare('fRemarks3',$this->fRemarks3,true);
		$criteria->compare('fRemarks4',$this->fRemarks4,true);
		$criteria->compare('fRemarks5',$this->fRemarks5,true);
		$criteria->compare('fUserGroup',$this->fUserGroup,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}