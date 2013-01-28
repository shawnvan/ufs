<?php

class MailController
{

	/**
	 * 邮件发送
	 */
	public static function actionSend($msgto){
		$to=new Msgto();
		$to=$msgto;
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = 'SMTP.163.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'uprosoft@163.com';
		$mail->Password = 'uprosoft123';
		$mail->SetFrom('uprosoft@163.com', 'uprosoft');
		$mail->Subject = 'test';
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$mail->MsgHTML('<h1>JUST A TEST!</h1>');
		$mail->AddAddress('2009_jinya@163.com', 'John Doe');
		$mail->Send();
	}
}