<?php //$this->beginContent('//layouts/main');?>
<?php
        $cs=Yii::app()->clientScript;
        $cssCoreUrl = $cs->getCoreScriptUrl();
        $cs->registerCoreScript('jquery');
        //Publish Files from backend assets folders

		$cs->registerCssFile(Yii::app()->themeManager->baseUrl . "/ufs/css/jqgrid/ui.jqgrid.css"); 
		$cs->registerCssFile(Yii::app()->themeManager->baseUrl . "/ufs/css/jquery-ui-1.8.2.custom.css"); 
        $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/jqgrid/i18n/grid.locale-en.js');   
        $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/jqgrid/jquery.jqGrid.min.js');   
        $cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/jquery-ui-1.8.2.custom.min.js');   
		$cs->registerScriptFile(Yii::app()->themeManager->baseUrl.'/ufs/js/jquery.SelectSimu.js');           
?>
<link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/less/ui.less">
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/less-1.3.0.min.js"></script>             
<?php echo $content; ?>
<?php //$this->endContent(); ?>