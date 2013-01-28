<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $fUserID
 * @property string $fUserName
 * @property string $fPassword
 * @property string $fLastName
 * @property string $fFirstName
 * @property string $fEmail
 * @property string $fLead
 * @property string $fUserType
 * @property string $fUserCompany
 * @property integer $fIsAdmin
 * @property integer $fIsActive
 * @property integer $fIsLog
 * @property string $fMemo
 * @property integer $fStatus
 * @property integer $fCreateDate
 * @property string $fCreateUser
 * @property integer $fUpdateDate
 * @property string $fUpdateUser
 * @property string $fOrgNo
 * The followings are the available model relations:
 * @property Groupuser[] $groupusers
 * @property Profile $profile
 * @property Contacts[] $tblContacts
 * @property Userfilter[] $userfilters
 * @property Userlog[] $userlogs
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return '{{user}}';
	}

	public function behaviors() {
		return array(
			 'X2LinkableBehavior'=>array(
				'class'=>'X2LinkableBehavior',
				'baseRoute'=>'/users',
				'viewRoute'=>'/profile',
			),
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fUserID', 'required'),
			array('fIsAdmin, fIsActive, fIsLog, fStatus, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fUserID, fUserType,fLead,fUserCompany,fUserName, fCreateUser, fUpdateUser,fOrgNo', 'length', 'max'=>50),
			array('fPassword, fEmail', 'length', 'max'=>100),
			array('fLastName', 'length', 'max'=>40),
			array('fFirstName', 'length', 'max'=>20),
			array('fMemo', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fUserName','unique','allowEmpty'=>false),
			array('fUserName','match','pattern'=>'/^\d+$/','not'=>true),// No numeric usernames. That will break association with groups.
			array('fUserID, fOrgNo,fUserName, fLead,fPassword, fLastName, fFirstName, fEmail, fIsAdmin, fIsActive, fIsLog, fMemo, fStatus, fCreateDate, fCreateUser, fUpdateDate, fUpdateUser', 'safe', 'on'=>'search'),
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
			'groupusers' => array(self::HAS_MANY, 'Groupuser', 'fUserID'),
			'profile' => array(self::HAS_ONE, 'Profile', 'fUserID'),
			'tblContacts' => array(self::MANY_MANY, 'Contacts', '{{usercontact}}(fUserID, fContactID)'),
			'userfilters' => array(self::HAS_MANY, 'Userfilter', 'fUserID'),
			'userlogs' => array(self::HAS_MANY, 'Userlog', 'fUserID'),
			'company' => array(self::HAS_ONE, 'cooperativecompany', '','on' => 't.fUserCompany=company.fCooperativeCompanyID'),
			'org' => array(self::BELONGS_TO, 'companyorganisation', '','on' => 't.fOrgNo=org.fOrgNo'),
		);
	}


	public static function getNames() {
		
		$userNames = array();
		$query = Yii::app()->db->createCommand()
			->select('fUserName, CONCAT(fFirstName," ",fLastName) AS name')
			->from('tbl_user')
			->where('fIsActive=1')
			->order('name ASC')
			->query();

		while(($row = $query->read()) !== false)
			$userNames[$row['fUserName']] = $row['name'];
		natcasesort($userNames);

		return array('Anyone'=>Yii::t('app','Anyone')) + $userNames;
	}
    
    public static function getUserIds(){
        $userNames = array();
		$query = Yii::app()->db->createCommand()
			->select('fUserID, CONCAT(fFirstName," ",fLastName) AS name')
			->from('tbl_user')
			->where('fIsActive=1')
			->order('name ASC')
			->query();

		while(($row = $query->read()) !== false)
			$userNames[$row['fUserID']] = $row['name'];
		natcasesort($userNames);

		return array(''=>Yii::t('app','Anyone')) + $userNames;
    }
	
	public function getName() {
		return $this->fFirstName .' '.$this->fLastName;
	}

	public static function getProfiles(){
		$arr=CActiveRecord::model('User')->findAll('fStatus="1"');
		$names=array('0'=>Yii::t('app','All'));
		foreach($arr as $user){
			$names[$user->fUserID]=$user->fFirstName." ".$user->fLastName;
		}
		return $names;
	}

	/**
	 * Generate a link to a user or group.
	 * 
	 * Creates a link or list of links to a user or group to be displayed on a record. 
	 * @param integer|array|string $users If array, links to a group; if integer, the user whose ID is that value; if keyword "Anyone", not a link but simply displays "anyone".
	 * @param boolean $makeLinks Can be set to False to disable creating links but still return the name of the linked-to object
	 * @return string The rendered links
	 */
	public static function getUserLinks($users, $makeLinks = true) {
		if(!is_array($users)) {
			 /* x2temp */
			if(is_numeric($users)) {
				$group = Groups::model()->findByPk($users);
				if(isset($group))
					$link = $makeLinks? CHtml::link($group->name,array('/groups/groups/view','id'=>$group->id)) : $group->name;
				else
					$link = '';
				return $link;
			}
			/* end x2temp */
			if($users=='' || $users=='Anyone')
				return Yii::t('app','Anyone');
				
			$users = explode(', ',$users);
		}
		$links = array();
		foreach($users as $user) {
			if($user == 'Anyone' || $user == 'Email') {		// skip these, they aren't users
				continue;
			} else if(is_numeric($user)) {		// this is a group
				$group = Groups::model()->findByPk($user);
				// $group = Groups::model()->findByPk($users);
				if(isset($group))
					$links[] = $makeLinks? CHtml::link($group->name,array('/groups/groups/view','id'=>$group->id)) : $group->name;
			} else {
				$model = CActiveRecord::model('User')->findByAttributes(array('username'=>$user));
				if(isset($model))
					$links[] = $makeLinks? CHtml::link($model->name,array('/profile/view','id'=>$model->id)) : $model->name;
			}
		}
		return implode(', ',$links);
	}

	public static function getEmails(){
		$userArray = User::model()->findAll();
		$emails = array('Anyone'=>Yii::app()->params['adminEmail']);
		foreach($userArray as $user){
			$emails[$user->fUserName]=$user->fEmail;
		}
		return $emails;
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fUserID' => Yii::t('model','F User'),
			'fUserName' => Yii::t('model','F User Name'),
			'fPassword' => Yii::t('model','F Password'),
			'fUserType' => Yii::t('model','F User Type'),
			'fUserCompany' => Yii::t('model','F User Company'),
			'fLastName' => Yii::t('model','F Last Name'),
			'fFirstName' => Yii::t('model','F Frist Name'),
			'fEmail' => Yii::t('model','F Email'),
			'fIsAdmin' => Yii::t('model','F Is Admin'),
			'fIsActive' => Yii::t('model','F Is Active'),
			'fIsLog' => Yii::t('model','F Is Log'),
			'fMemo' => Yii::t('model','F Memo'),
			'fLead' => Yii::t('model','F Lead'),
			'fStatus' => Yii::t('model','F Status'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fOrgNo' => Yii::t('model','F Org No'),
				
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

		$criteria->compare('fUserID',$this->fUserID,true);
		$criteria->compare('fUserName',$this->fUserName,true);
		$criteria->compare('fPassword',$this->fPassword,true);
		$criteria->compare('fUserType',$this->fUserType,true);
		$criteria->compare('fUserCompany',$this->fUserCompany,true);
		$criteria->compare('fLastName',$this->fLastName,true);
		$criteria->compare('fFirstName',$this->fFirstName,true);
		$criteria->compare('fEmail',$this->fEmail,true);
		$criteria->compare('fIsAdmin',$this->fIsAdmin);
		$criteria->compare('fIsActive',$this->fIsActive);
		$criteria->compare('fIsLog',$this->fIsLog);
		$criteria->compare('fMemo',$this->fMemo,true);
		$criteria->compare('fLead',$this->fLead,true);
		$criteria->compare('fStatus',$this->fStatus);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fOrgNo',$this->fOrgNo,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}