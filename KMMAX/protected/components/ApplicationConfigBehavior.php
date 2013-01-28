<?php
/**
 * ApplicationConfigBehavior is a behavior for the application.
 * It loads additional config paramenters that cannot be statically 
 * written in config/main
 * 
 * @package UFS.components 
 */
class ApplicationConfigBehavior extends CBehavior {
    
	/**
	 * Declares events and the event handler methods.
	 * 
	 * See yii documentation on behavior; this is an override of 
	 * {@link CBehavior::events()}
	 */
	public function events() {
		return array_merge(parent::events(), array(
			'onBeginRequest'=>'beginRequest',
		));
	}

	/**
	 * Load dynamic app configuration.
	 * 
	 * Per the onBeginRequest key in the array returned by {@link events()},
	 * this method will be called when the request has begun. It allows for
	 * many extra configuration tasks to be run on a per-request basis
	 * without having to extend {@link Yii} and override its methods.
	 */
	public function beginRequest() {
		// $t0 = microtime(true);
		if($this->owner->request->getPathInfo() == 'notifications/get') {	// skip all the loading if this is a chat/notification update
			$timezone = $this->owner->db->createCommand()->select('fTimeZone')->from('tbl_profile')->where('fUserID=1')->queryScalar();	// set the timezone to the admin's
			if(!isset($timezone)){
				$timezone = 'UTC';
			}
			date_default_timezone_set($timezone);
			return;
		}

		Yii::import('application.models.*');
		Yii::import('application.controllers.AppBaseController');
		Yii::import('application.controllers.AppBase');
		Yii::import('application.components.*');
		Yii::import('application.modules.users.components.*');
		Yii::import('application.modules.users.models.*');
		Yii::import('application.modules.settings.components.*');
		Yii::import('application.modules.settings.models.*');
		Yii::import('application.modules.rights.*');
		Yii::import('application.modules.rights.components.*');
		Yii::import('application.modules.UFSBase.components.*');
		Yii::import('application.modules.UFSBase.utils.*');
		Yii::import('application.modules.UFSBase.models.*');
		Yii::import('application.runtime.cached.*');
		$this->owner->messages->forceTranslation = true;
		$this->owner->messages->onMissingTranslation = array(new TranslationLogger,'log');

		$this->owner->params->loginuser = CActiveRecord::model('User')->findByAttributes(array('fUserID'=>$this->owner->user->getId()));
		if(!$this->owner->user->isGuest) {
			$this->owner->params->loginuser = CActiveRecord::model('User')->findByAttributes(array('fUserID'=>$this->owner->user->getId()));
		
			$session = Session::model()->findByAttributes(array('fUserName'=>$this->owner->user->getName()));
			if(isset($session)) {
				if($session->fLastUpdated + $this->owner->params->timeout < time() ) {
					$session->delete();
					$this->owner->user->logout();
				} else if($this->owner->request->getPathInfo() != 'site/checkNotifications') {
					$session->fLastUpdated = time();
					$session->save();
				}
			} else {
				$this->owner->user->logout();
			}
		}
      
		// set language
		if (!empty($this->owner->params->loginuser->fLanguage))
			$this->owner->language = $this->owner->params->loginuser->fLanguage;
		else if(isset($adminProf))
			$this->owner->language = $adminProf->language;
		else
			$this->owner->language = 'zh_cn';
	}
}
