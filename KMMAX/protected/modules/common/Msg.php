<?php

class Msg
{
	/**
	 * Displays the login page
	 */
	public static function sendMsg($msgto){
		$msg=new Msgto();
		$msg->fSendToNo=GuidUtil::getUuid();
		$msg->fSendFromNo='';
		$msg->fSendToUserNo='';
		$msg->fSendToNo='';
		$msg->fSendFromNo='';
		$msg->fSendToUserNo='';
		$msg->fSendToAccount='';
		$msg->fSendToName='';
		$msg->fSendMsgStatus='Msg_NoRead';
		$msg->fSendUserNo='';
		$msg->fSendFromName='';
		$msg->fSendFromDate='';
		$msg->fSendFromModule='';
		$msg->fSendFromType='';
		$msg->fSendFromTheme='';
		$msg->fSendFromContent='';
		$msg->fSendToAllUserNo='';
		$msg->fSendToAllAccount='';
		$msg->fSendToAllName='';
		$msg->fRemark1='';
		$msg->fRemark2='';
		$msg->fRemark3='';
		$msg->save();
	}
}