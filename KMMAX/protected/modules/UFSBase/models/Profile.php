<?php

/**
 * This is the model class for table "{{profile}}".
 *
 * The followings are the available columns in table '{{profile}}':
 * @property string $fUserID
 * @property string $fCity
 * @property string $fWebsite
 * @property string $fZipCode
 * @property string $fCountry
 * @property string $fAssignedTo
 * @property integer $fQQ
 * @property string $fLinkedIn
 * @property string $fMSN
 * @property string $fFullName
 * @property string $fOfficePhone
 * @property string $fCellPhone
 * @property string $fHomePhone
 * @property string $fNotes
 * @property string $fAvatar
 * @property string $fLanguage
 * @property string $fTimeZone
 * @property integer $fShowSocialMedia
 * @property integer $fShowDetailView
 * @property integer $fShowWorkflow
 * @property string $fGridviewSettings
 * @property string $fFormSettings
 * @property string $fEmailSignature
 * @property integer $fEnableFullWidth
 * @property string $fSyncGoogleCalendarId
 * @property string $fSyncGoogleCalendarAccessToken
 * @property string $fSyncGoogleCalendarRefreshToken
 * @property string $fGoogleId
 * @property integer $fUserCalendarsVisible
 * @property integer $fGroupCalendarsVisible
 * @property integer $fTagsShowAllUsers
 * @property string $fWidgets
 * @property integer $fAllowPost
 * @property string $fBackgroundColor
 * @property string $fTagLine
 * @property string $fCreateUser
 * @property integer $fCreateDate
 * @property string $fUpdateUser
 * @property integer $fUpdateDate
 * @property string $fEmailUserSignature
 * @property string $fAddress1
 * @property string $fAddress2
 *
 * The followings are the available model relations:
 * @property User $fUser
 */
class Profile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
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
		return '{{profile}}';
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
			array('fQQ, fShowSocialMedia, fShowDetailView, fShowWorkflow, fEnableFullWidth, fUserCalendarsVisible, fGroupCalendarsVisible, fTagsShowAllUsers, fAllowPost, fCreateDate, fUpdateDate', 'numerical', 'integerOnly'=>true),
			array('fUserID, fCreateUser, fUpdateUser', 'length', 'max'=>50),
			array('fCity, fCountry', 'length', 'max'=>40),
			array('fWebsite, fAddress1, fAddress2', 'length', 'max'=>200),
			array('fZipCode, fAssignedTo, fLanguage', 'length', 'max'=>20),
			array('fLinkedIn, fMSN, fAvatar, fTimeZone', 'length', 'max'=>100),
			array('fFullName', 'length', 'max'=>60),
			array('fOfficePhone, fCellPhone, fHomePhone', 'length', 'max'=>30),
			array('fNotes, fGridviewSettings, fFormSettings, fEmailSignature, fEmailUserSignature', 'length', 'max'=>500),
			array('fGoogleId', 'length', 'max'=>250),
			array('fWidgets, fTagLine', 'length', 'max'=>255),
			array('fBackgroundColor', 'length', 'max'=>6),
			array('fSyncGoogleCalendarId, fSyncGoogleCalendarAccessToken, fSyncGoogleCalendarRefreshToken', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fUserID, fCity, fWebsite, fZipCode, fCountry, fAssignedTo, fQQ, fLinkedIn, fMSN, fFullName, fOfficePhone, fCellPhone, fHomePhone, fNotes, fAvatar, fLanguage, fTimeZone, fShowSocialMedia, fShowDetailView, fShowWorkflow, fGridviewSettings, fFormSettings, fEmailSignature, fEnableFullWidth, fSyncGoogleCalendarId, fSyncGoogleCalendarAccessToken, fSyncGoogleCalendarRefreshToken, fGoogleId, fUserCalendarsVisible, fGroupCalendarsVisible, fTagsShowAllUsers, fWidgets, fAllowPost, fBackgroundColor, fTagLine, fCreateUser, fCreateDate, fUpdateUser, fUpdateDate, fEmailUserSignature, fAddress1, fAddress2', 'safe', 'on'=>'search'),
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
			'fUser' => array(self::BELONGS_TO, 'User', 'fUserID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fUserID' => Yii::t('model','F User'),
			'fCity' => Yii::t('model','F City'),
			'fWebsite' => Yii::t('model','F Website'),
			'fZipCode' => Yii::t('model','F Zip Code'),
			'fCountry' => Yii::t('model','F Country'),
			'fAssignedTo' => Yii::t('model','F Assigned To'),
			'fQQ' => Yii::t('model','F Qq'),
			'fLinkedIn' => Yii::t('model','F Linked In'),
			'fMSN' => Yii::t('model','F Msn'),
			'fFullName' => Yii::t('model','F Full Name'),
			'fOfficePhone' => Yii::t('model','F Office Phone'),
			'fCellPhone' => Yii::t('model','F Cell Phone'),
			'fHomePhone' => Yii::t('model','F Home Phone'),
			'fNotes' => Yii::t('model','F Notes'),
			'fAvatar' => Yii::t('model','F Avatar'),
			'fLanguage' => Yii::t('model','F Language'),
			'fTimeZone' => Yii::t('model','F Time Zone'),
			'fShowSocialMedia' => Yii::t('model','F Show Social Media'),
			'fShowDetailView' => Yii::t('model','F Show Detail View'),
			'fShowWorkflow' => Yii::t('model','F Show Workflow'),
			'fGridviewSettings' => Yii::t('model','F Gridview Settings'),
			'fFormSettings' => Yii::t('model','F Form Settings'),
			'fEmailSignature' => Yii::t('model','F Email Signature'),
			'fEnableFullWidth' => Yii::t('model','F Enable Full Width'),
			'fSyncGoogleCalendarId' => Yii::t('model','F Sync Google Calendar'),
			'fSyncGoogleCalendarAccessToken' => Yii::t('model','F Sync Google Calendar Access Token'),
			'fSyncGoogleCalendarRefreshToken' => Yii::t('model','F Sync Google Calendar Refresh Token'),
			'fGoogleId' => Yii::t('model','F Google'),
			'fUserCalendarsVisible' => Yii::t('model','F User Calendars Visible'),
			'fGroupCalendarsVisible' => Yii::t('model','F Group Calendars Visible'),
			'fTagsShowAllUsers' => Yii::t('model','F Tags Show All Users'),
			'fWidgets' => Yii::t('model','F Widgets'),
			'fAllowPost' => Yii::t('model','F Allow Post'),
			'fBackgroundColor' => Yii::t('model','F Background Color'),
			'fTagLine' => Yii::t('model','F Tag Line'),
			'fCreateUser' => Yii::t('model','F Create User'),
			'fCreateDate' => Yii::t('model','F Create Date'),
			'fUpdateUser' => Yii::t('model','F Update User'),
			'fUpdateDate' => Yii::t('model','F Update Date'),
			'fEmailUserSignature' => Yii::t('model','F Email User Signature'),
			'fAddress1' => Yii::t('model','F Address1'),
			'fAddress2' => Yii::t('model','F Address2'),
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
		$criteria->compare('fCity',$this->fCity,true);
		$criteria->compare('fWebsite',$this->fWebsite,true);
		$criteria->compare('fZipCode',$this->fZipCode,true);
		$criteria->compare('fCountry',$this->fCountry,true);
		$criteria->compare('fAssignedTo',$this->fAssignedTo,true);
		$criteria->compare('fQQ',$this->fQQ);
		$criteria->compare('fLinkedIn',$this->fLinkedIn,true);
		$criteria->compare('fMSN',$this->fMSN,true);
		$criteria->compare('fFullName',$this->fFullName,true);
		$criteria->compare('fOfficePhone',$this->fOfficePhone,true);
		$criteria->compare('fCellPhone',$this->fCellPhone,true);
		$criteria->compare('fHomePhone',$this->fHomePhone,true);
		$criteria->compare('fNotes',$this->fNotes,true);
		$criteria->compare('fAvatar',$this->fAvatar,true);
		$criteria->compare('fLanguage',$this->fLanguage,true);
		$criteria->compare('fTimeZone',$this->fTimeZone,true);
		$criteria->compare('fShowSocialMedia',$this->fShowSocialMedia);
		$criteria->compare('fShowDetailView',$this->fShowDetailView);
		$criteria->compare('fShowWorkflow',$this->fShowWorkflow);
		$criteria->compare('fGridviewSettings',$this->fGridviewSettings,true);
		$criteria->compare('fFormSettings',$this->fFormSettings,true);
		$criteria->compare('fEmailSignature',$this->fEmailSignature,true);
		$criteria->compare('fEnableFullWidth',$this->fEnableFullWidth);
		$criteria->compare('fSyncGoogleCalendarId',$this->fSyncGoogleCalendarId,true);
		$criteria->compare('fSyncGoogleCalendarAccessToken',$this->fSyncGoogleCalendarAccessToken,true);
		$criteria->compare('fSyncGoogleCalendarRefreshToken',$this->fSyncGoogleCalendarRefreshToken,true);
		$criteria->compare('fGoogleId',$this->fGoogleId,true);
		$criteria->compare('fUserCalendarsVisible',$this->fUserCalendarsVisible);
		$criteria->compare('fGroupCalendarsVisible',$this->fGroupCalendarsVisible);
		$criteria->compare('fTagsShowAllUsers',$this->fTagsShowAllUsers);
		$criteria->compare('fWidgets',$this->fWidgets,true);
		$criteria->compare('fAllowPost',$this->fAllowPost);
		$criteria->compare('fBackgroundColor',$this->fBackgroundColor,true);
		$criteria->compare('fTagLine',$this->fTagLine,true);
		$criteria->compare('fCreateUser',$this->fCreateUser,true);
		$criteria->compare('fCreateDate',$this->fCreateDate);
		$criteria->compare('fUpdateUser',$this->fUpdateUser,true);
		$criteria->compare('fUpdateDate',$this->fUpdateDate);
		$criteria->compare('fEmailUserSignature',$this->fEmailUserSignature,true);
		$criteria->compare('fAddress1',$this->fAddress1,true);
		$criteria->compare('fAddress2',$this->fAddress2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}