<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;
    private $_name;

    public function authenticate($google=false) {
        $user = CActiveRecord::model('User')->findByAttributes(array('fUserName' => $this->username));

        if(isset($user))
            $this->username = $user->fUserName;
        if ($user === null || $user->fStatus < 1) {              // username not found, or is disabled
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif($google) {
            $this->errorCode = self::ERROR_NONE;
            $this->_id = $user->fUserID;
            return !$this->errorCode;
        } else {
            $isMD5 = (strlen($user->fPassword) == 32);
            if($isMD5)
                $isValid = ($user->fPassword == md5($this->password));   // if 32 characters, it's an MD5 hash
            else
                $isValid = (crypt($this->password,'$5$rounds=32678$'.$user->fPassword) == '$5$rounds=32678$'.$user->fPassword);   // otherwise, 2^15 rounds of sha256
        
            if($isValid) {
                $this->errorCode = self::ERROR_NONE;
                $this->_id = $user->fUserID;
                //$this->setState('lastLoginTime', $user->lastLoginTime); //not yet set up
                
                if($isMD5 && version_compare(phpversion(),'5.3') == 1) {    // regenerate a more secure hash and nonce
                    $nonce = '';
                    for($i = 0; $i<16; $i++)    // generate a random 16 character nonce with the Mersenne Twister
                        $nonce .= substr('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789./', mt_rand(0, 63), 1); 

                    $user->fPassword = substr(crypt($this->password,'$5$rounds=32678$'.$nonce),16);
                 
                    $user->save();
                }
                
            } else {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            }
        }

        return !$this->errorCode;
    }
    
    public function getId() {
        return $this->_id;
    }
    
    
}
