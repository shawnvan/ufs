<?php
/**
 * 
 * @author Jake Houser <jake@x2engine.com>
 * @package X2CRM.models
 */
class SessionChild extends Sessions {
    
    
    public static function getOnlineUsers(){
        $sessions=Sessions::model()->findAll();
        $temp=array();
        foreach($sessions as $session)
            $temp[]=$session->fUserName;
        
        return $temp;
    }
}

?>
