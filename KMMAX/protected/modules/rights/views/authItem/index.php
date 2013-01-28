<?php
$this->breadcrumbs=array(
	'Companyorganisations',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
 $('#org').jOrgChart({chartElement : '#chart',dragAndDrop : false});
$('#list-html').text($('#org').html());
 $('#org').bind('DOMSubtreeModified', function() {});
$('.SelectOrg').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('admin/companyorganisation/popgrid')."/id/'+jQuery('#hiddenpkey').val();
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'100%',onClosed: function (message) {}});
    return false;
 });
$('#addRole').live('click',function(){ 
	var checkValue=jQuery('#modelsaction option:selected').text();
	var checkIndex=jQuery('#modelsaction').selectedIndex;
	$('#userroles').append( $('<option>'+checkValue+'</option>') );
    jQuery('#modelsaction option:selected').remove(); 
 })	;
$('#deleteRole').live('click',function(){ 
	var checkValue=jQuery('#userroles option:selected').text();
	var checkIndex=jQuery('#userroles').selectedIndex;
	$('#modelsaction').append( $('<option>'+checkValue+'</option>') );
    jQuery('#userroles option:selected').remove(); 
 })	;
$('#modelsaction').dblclick(function() {
	var checkValue=jQuery('#modelsaction option:selected').text();
	var checkIndex=jQuery('#modelsaction').selectedIndex;
	$('#userroles').append( $('<option>'+checkValue+'</option>') );
    jQuery('#modelsaction option:selected').remove(); 
});	
$('#userroles').dblclick(function() {
	var checkValue=jQuery('#userroles option:selected').text();
	var checkIndex=jQuery('#userroles').selectedIndex;
	$('#modelsaction').append( $('<option>'+checkValue+'</option>') );
    jQuery('#userroles option:selected').remove(); 
});							
$('select').css('height','500px');
$('#modules').change(function(){
    jQuery.ajax({				
		  url:'".Yii::app()->createUrl('rights/authitem/operate/mou')."/'+$(this).find('option:selected').text(),
		  success: function(data){
		  		$('#modelsaction').empty();
		  		$.each(data,function(key,val){ 
		  		jQuery('#modelsaction').append('<option value=\''+key+'\'>'+val+'</option>');
				}); 
		  }
	 });	
});			
");
?>

<div class="content-head underline">
    <h2><?php echo Yii::t('label','Companyorganisations') ?></h2>
	<div class="content-action">
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/jOrgChart/jquery.jOrgChart.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/jOrgChart/custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/jOrgChart/prettify.css" />
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jOrgChart/prettify.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jOrgChart/jquery.jOrgChart.js"></script>
<div class="content">
    <ul id="org" style="display:none"><?php echo $orgchat?></ul>            
    <div id="chart" class="orgChart"></div>
    <div class="input-group"><?php echo CHtml::textField('fOrgName','',array('disabled'=>'disabled')); ?>
         <div class="inputs"> <span class="btn-icon-horizontal btn-icon-input btn-icon-user SelectOrg">选择</span>
    <?php echo CHtml::dropDownList('org', '', $modelsResult,array('size'=>30,'id'=>'modules'))?>
    <?php echo CHtml::dropDownList('modelsaction', '', array(),array('size'=>30,'id'=>'modelsaction'))?>
     <?php echo CHtml::button('Add>>',array('id'=>'addRole'))?>
     <?php echo CHtml::button('<<Delete',array('id'=>'deleteRole'))?>
     <?php echo CHtml::dropDownList('modelsaction', '', array(),array('size'=>30,'id'=>'userroles'))?>
     </div></div>
    
</div>