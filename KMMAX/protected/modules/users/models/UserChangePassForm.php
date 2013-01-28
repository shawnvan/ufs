<?php


class UserChangePassForm extends CFormModel
{
        public $old_password;
        public $new_password_1;
        public $new_password_2;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
            return array(
                array('old_password, new_password_1, new_password_2', 'required'),
                array('old_password','checkOldPass'),
                array('new_password_2','checkNewPass')
             );
	}

        /**
         * Check the old pass is Ok or not
         * 
         * @param array $attribute
         * @param array $params
         * @return boolean 
         */
	public function checkOldPass($attribute,$params)
	{
               $u=User::model()->findbyPk(user()->id);
               if($u!=null){
                    if($u->password!==$u->hashPassword($this->old_password)){
                        $this->addError($attribute,t('Old password is not correct!'));
                        return false;
                    }
               } else {
                    $this->addError($attribute,t('No User Found!'));
                    return false;
               }
	      
	}
        
        /**
         * Compare the two new password match or not
         * @param array $attribute
         * @param array $params
         * @return boolean
         */
	public function checkNewPass($attribute,$params)
	{
              if($this->new_password_1!=$this->new_password_2){
                        $this->addError($attribute,t('Password does not match!'));
                        return false;
              }
	      
	}
        
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'old_password'=>t('Old Password'),
                        'new_password_1'=>t('New Password'),
                        'new_password_2'=>t('Retype new Password')
		);
	}

}