<?php

class ApiController extends AppController {

    public function actionView() {
    	print_r($_POST);exit;
        if (isset($_POST['authUser']) && isset($_POST['authPassword'])) {
            $username = $_POST['authUser'];
            $password = $_POST['authPassword'];
            $data = array(
            	'fUser' => $username,
            	'fPassword' => md5($password),
            );
            $apiUser = User::model()->findByAttributes($data);
             $da = array(
            	'username' => $apiUser->fUser,
            	'email' => $apiUser->fEmail,
             	'userid' => $apiUser->fUserID,
            );
           
            parent::printJson($da);
        } else {
            $this->_sendResponse(403, "No credentials provided.");
        }
    }
}

?>
