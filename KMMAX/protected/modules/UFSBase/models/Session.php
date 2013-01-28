<?php
/**
 * This is the model class for table "tbl_sessions".
 *
 * @package X2CRM.models
 * @property integer $fSessionID
 * @property string $fUserName
 * @property integer $fLastUpdate
 * @property string $fIP
 * @property integer $fStatus
 */
class Session extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @return Session the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'tbl_sessions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fLastUpdated', 'numerical', 'integerOnly'=>true),
			array('fUserName', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fSession, fUserName, fLastUpdated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'fSessionID' => Yii::t('sessions','ID'),
			'fUserName' => Yii::t('sessions','User'),
			'fLastUpdated' => Yii::t('sessions','Last Updated'),
			'fIP' => Yii::t('sessions','IP Address'),
			'fStatus' => Yii::t('sessions','Login Status'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('fSessionID',$this->fSessionID);
		$criteria->compare('fUserName',$this->fUserName,true);
		$criteria->compare('fLastUpdated',$this->fLastUpdated);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getOnlineUsers($useTimeout = false) {
		// $sessions = Session::model()->findAllByAttributes(array('status'=>1));
		// $temp = array();
		// foreach($sessions as $session)
			// $temp[] = $session->user;
		// return $temp;
		
		$query = Yii::app()->db->createCommand()->selectDistinct('fUserName')->from('tbl_sessions')->where('fStatus=1');
		if($useTimeout)
			$query = $query->where('fLastUpdated > "'.(time()-900).'"');

		return $query->queryColumn();
	}
}