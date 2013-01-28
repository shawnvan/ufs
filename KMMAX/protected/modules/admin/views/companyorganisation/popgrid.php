<?php
$this->breadcrumbs=array(
	'Companyorganisations',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
 $('#org').jOrgChart({
            chartElement : '#chart',
            dragAndDrop  : true
  });
     $('#show-list').click(function(e){

     });
		   $('div').click(function(){
		    if($(this).attr('rel')){
             // alert($(this).attr('rel'));
		     // alert($(this).html());
		     parent.$('#User_fOrgNo').val($(this).attr('rel'));
		     parent.$('#fOrgName').val($(this).html());
		     parent.$('.SelectOrg').colorbox.close('保存成功');
		     }
            });
            $('#list-html').text($('#org').html());
            $('#org').bind('DOMSubtreeModified', function() {  
            }); 
");
?>

<div class="content-head underline">
    <h2><?php echo Yii::t('label','Companyorganisations') ?></h2>
	<div class="content-action">
	
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/jOrgChart/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/jOrgChart/jquery.jOrgChart.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/jOrgChart/custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/jOrgChart/prettify.css" />
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jOrgChart/prettify.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jOrgChart/jquery.jOrgChart.js"></script>

<div class="content">
    <ul id="org" style="display:none">
    <?php echo $orgchat?>
   </ul>            

    <div id="chart" class="orgChart"></div>
</div>