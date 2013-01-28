<?php

class LoginController extends AppController
{
	public $defaultAction = 'login';

	protected function beforeAction($action=null){
        $auth=Yii::app()->authManager;
        $action=ucfirst($this->getId()) . ucfirst($this->getAction()->getId());
        $authItem=$auth->getAuthItem($action);
        if(Yii::app()->user->checkAccess($action) || is_null($authItem)){
            return true;
        }elseif(Yii::app()->user->isGuest){
            $this->redirect($this->createUrl('/user/login'));
        }else{
            throw new CHttpException(403, 'You are not authorized to perform this action.');
        }
    }
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		$model->useCaptcha = false;
		if(isset($_POST['LoginForm'])) {
			
			$model->fUserName = $_POST['LoginForm']['fUserName'];
			$model->fPassword = $_POST['LoginForm']['fPassword'];
			$model->rememberMe = $_POST['LoginForm']['rememberMe'];
			$activeCheck=User::model()->findByAttributes(array('fUserName'=>$model->fUserName));
                        if(isset($activeCheck)){
                            $model->fUserName=$activeCheck->fUserName;
                        }
			if(isset($activeCheck) && $activeCheck->fIsActive=='1')
				$activeCheck=true;
			else
				$activeCheck=false;
			$ip = UFSBaseUtil::getRealIp();
			UFSBaseUtil::cleanUpSessions();
			$session = CActiveRecord::model('Session')->findByAttributes(array('fUserName'=>$model->fUserName,'fIP'=>$ip));
			if(isset($session)) {
				$session->fLastUpdated = time();
				
				if($session->fStatus < 1) {
					if($session->fStatus > -3)
						$session->fStatus -= 1;
				} else {
					$session->fStatus = -1;
				}
/* 				if($session->fStatus < -1)
					$model->useCaptcha = true;
				if($session->fStatus < -2)
					$model->setScenario('loginWithCaptcha'); */
			} else if($activeCheck) {
				$session = new Session;
				$session->fSessionID = GuidUtil::getUuid();
				$session->fUserName = $model->fUserName;
				$session->fLastUpdated = time();
				$session->fStatus = 1;
				$session->fIP = $ip;
			}
			
			if($model->validate() && $model->login()) {
               /*记录登录日志*/
               $user = User::model()->findByPk(Yii::app()->user->getId());
             
               if($user->fIsActive == '1'){
				   $userlog = new UserLog;
		           $userlog->fLogID= GuidUtil::getUuid();
				   $userlog->fUserName = $user->fUserName;
				   $userlog->fLoginDate = UFSBaseUtil::getTime();
				   $userlog->fLoginip = $ip;
				   $userlog->fCreateUser = $user->fUserName;
				   $userlog->fCreateDate = UFSBaseUtil::getTime();
				   $userlog->save();
               }

				Yii::app()->session['loginTime']=time();
                $session->fStatus=1;
				$session->save();
			//	print_r(Yii::app()->user->returnUrl);exit;
				$this->redirect(Yii::app()->user->returnUrl);
			} else if($activeCheck) {
				$session->save();
				$model->verifyCode = '';
				if($model->hasErrors())
					$model->addError('fUserName',Yii::t('app','Incorrect username or password.'));
					$model->addError('fPassword',Yii::t('app','Incorrect username or password.'));
			}
			$activeCheck=User::model()->findByAttributes(array('fUserName'=>$model->fUserName));
                        if(isset($activeCheck)){
                            $model->fUserName=$activeCheck->fUserName;
                        }
			if(isset($activeCheck) && $activeCheck->fIsActive=='1')
				$activeCheck=true;
			else
				$activeCheck=false;
			
			$ip = UFSBaseUtil::getRealIp();
			UFSBaseUtil::cleanUpSessions();
			$session = CActiveRecord::model('Session')->findByAttributes(array('fUserName'=>$model->fUserName,'fIP'=>$ip));
			
			if(isset($session)) {
				$session->fLastUpdated = time();
				if($session->fStatus < 1) {
					if($session->fStatus > -3)
						$session->fStatus -= 1;
				} else {
					$session->fStatus = -1;
				}
				/* if($session->fStatus < -1)
					$model->useCaptcha = true;
				if($session->fStatus < -2)
					$model->setScenario('loginWithCaptcha'); */
			} else if($activeCheck) {
				$session = new Session;
				$session->fSessionID = GuidUtil::getUuid();
				$session->fUserName = $model->fUserName;
				$session->fLastUpdated = time();
				$session->fStatus = 1;
				$session->fIP = $ip;
			}
			if($model->validate() && $model->login()) {
               /*记录登录日志*/
               $user = User::model()->findByPk(Yii::app()->user->getId());
               if($user->fIsActive == '1'){
				   $userlog = new UserLog;
		           $userlog->fLogID= GuidUtil::getUuid();
				   $userlog->fUserName = $user->fUserName;
				   $userlog->fLoginDate = UFSBaseUtil::getTime();
				   $userlog->fLoginip = $ip;
				   $userlog->fCreateUser = $user->fUserName;
				   $userlog->fCreateDate = UFSBaseUtil::getTime();
				   $userlog->save();
               }

				Yii::app()->session['loginTime']=time();
                $session->fStatus=1;
				$session->save();

				$this->redirect(Yii::app()->user->returnUrl);
			} else if($activeCheck) {
				$session->save();
				$model->verifyCode = '';
				if($model->hasErrors())
					$model->addError('fUserName',Yii::t('app','Incorrect username or password.'));
					$model->addError('fPassword',Yii::t('app','Incorrect username or password.'));
			}
		}
		$this->render('login',array('model'=>$model));
	}
    public function actionForgetps(){
    	$model=new LoginForm;
    	if(isset($_POST['LoginForm'])) {
    		$this->render('waitps',array('name'=>$_POST['LoginForm']['fUserName']));
    		exit;
    	}
    	$this->render('forgetps',array('model'=>$model));
    }   
}