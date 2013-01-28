<?php //$this->beginContent('//layouts/main');?>
<link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/less/base.less">
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/less-1.3.0.min.js"></script>         

<?php
        $cs=Yii::app()->clientScript;
        $cssCoreUrl = $cs->getCoreScriptUrl();
        $cs->registerCoreScript('jquery');
        //Publish Files from backend assets folders
		$cs->registerCssFile(Yii::app()->themeManager->baseUrl . "/ufs/css/jqgrid/ui.jqgrid.css"); 
		$cs->registerCssFile(Yii::app()->themeManager->baseUrl . "/ufs/css/jquery-ui-1.8.2.custom.css"); 
		$cs->registerCssFile(Yii::app()->themeManager->baseUrl . "/ufs/css/ui.multiselect.css"); 
		$cs->registerCssFile(Yii::app()->themeManager->baseUrl . "/ufs/css/noty/buttons.css");
        $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/jqgrid/jquery-ui-1.8.2.custom.min.js');   
        $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/jqgrid/ui.multiselect.js');     
        $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/jqgrid/i18n/grid.locale-en.js');   
       	$cs->registerScriptFile(Yii::app()->themeManager->baseUrl."/ufs/js/jqgrid/json2.js"); 
        $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/jqgrid/jquery.jqGrid.min.js');
        $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/noty/jquery.noty.js');
        $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/noty/layouts/top.js');
        $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/noty/themes/default.js');
?>
<script type="text/javascript">
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
  }
</script>
<div class="container"><div id="customContainer"></div></div>
<div style='display:none' id='info'></div>
<div id="content">
    <div class="container">
<?php echo $content; ?>
    </div> </div>

<?php //$this->endContent(); ?>