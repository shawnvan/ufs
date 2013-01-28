<?php
class UFSNotyUtil
{
	//public $position = Yii::app()->params['layouttype']['top'];
	//public $position = Yii::app()->params['layouttype']['top'];
	public $position = 'top';
	public $type = 'success';
	
	public function __construct(){
		 $baseUrl = Yii::app()->baseUrl; 
	  	 $cs = Yii::app()->getClientScript();
	  	 $cs->registerCssFile(Yii::app()->themeManager->baseUrl . "/ufs/css/noty/buttons.css");
		 $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/noty/jquery.noty.js');
         $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/noty/layouts/top.js');
         $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/noty/themes/default.js');
         Yii::app()->clientScript->registerScript('gethiddenpkey', "
			function generate(layout,text,type) {
			    var n = noty({
			        text: text,
			        type: type,
			        dismissQueue: true,
			        layout: layout,
			        theme: 'defaultTheme',
			        timeout: 2000,
			        animation: {
			            open: {height: 'toggle'},
			            close: {height: 'toggle'},
			            easing: 'swing',
			            speed: 500 // opening & closing animation speed
			          },
			    });
			 };
  		 ");

  }
    
	/*
	 *通知信息显示 
	 **/
	public static function NotyInfo($text,$layout = 'top' ,$type = 'success' ){
		//$layout = $this->position;
		//$type = $this->type;
		 
		Yii::app()->clientScript->registerScript('gethiddenpkey', "
			generate('".$layout."','".$text."','".$type."');
  		 ");
	}
	

}
?>