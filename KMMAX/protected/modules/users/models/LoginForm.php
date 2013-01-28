<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
/**
 * @package X2CRM.models
 */
class LoginForm extends CFormModel {

    public $fUserName;
    public $fPassword;
    public $rememberMe;
    public $verifyCode;
    public $useCaptcha;//是否使用验证码
    private $_identity;

    /**
     * Validation rules for logins.
     * @return array
     */
    public function rules() {

	return array(
	    // username and password are required
	    array('fUserName, fPassword', 'required'),
	    // rememberMe needs to be a boolean
	    array('rememberMe', 'boolean'),
	    // password needs to be authenticated
	    array('fPassword', 'authenticate'),
	    // captcha needs to be filled out
	    array('verifyCode', 'captcha', 'allowEmpty' => !(CCaptcha::checkRequirements()), 'on' => 'loginWithCaptcha'),
	    array('verifyCode', 'safe'),
	);
    }

    /**
     * Declares attribute labels.
     * @return array
     */
    public function attributeLabels() {
	return array(
	    'fUserName' => Yii::t('app', 'fUserName'),
	    'fPassword' => Yii::t('app', 'fPassword'),
	    'rememberMe' => Yii::t('app', 'Remember me'),
	    'verifyCode' => Yii::t('app', 'Verification Code'),
	);
    }

    /**
     * Authenticates the password.
     * 
     * This is the 'authenticate' validator as declared in rules().
     * @param string $attribute Attribute name
     * @param array $params validation parameters
     */
    public function authenticate($attribute, $params) {
		if (!$this->hasErrors()) {
		    $this->_identity = new UserIdentity($this->fUserName, $this->fPassword);
		    if (!$this->_identity->authenticate())
			$this->addError('fPassword', Yii::t('app', 'Incorrect username or password.'));
		}
    }

    /**
     * Logs in the user using the given username and password in the model.
     * 
     * @param boolean $google Whether or not Google is being used for the login
     * @return boolean whether login is successful
     */
    public function login($google = false) {
		if ($this->_identity === null) {
			print_r($this->fUserName);exit();
		    $this->_identity = new UserIdentity($this->fUserName, $this->fPassword);
		    $this->_identity->authenticate($google);
		}
		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
		    $duration = $this->rememberMe ? 2592000 : 0; //60*60*24*30 = 30 days
		    Yii::app()->user->login($this->_identity, $duration);
		    return true;
		}
		else{
			 return false;
		}
		   
	   }

}
