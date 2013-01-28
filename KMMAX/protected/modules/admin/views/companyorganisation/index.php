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
$('#test').click(function(e){
        alert('asdf');
		return false;
});

            $('#show-list').click(function(e){
	   	        alert('asdf');
                e.preventDefault();
                $('#list-html').toggle('fast', function(){
                    if($(this).is(':visible')){
                        $('#show-list').text('Hide underlying list.');
                        $('.topbar').fadeTo('fast',0.9);
                    }else{
                        $('#show-list').text('Show underlying list.');
                        $('.topbar').fadeTo('fast',1);                  
                    }
                });
            });
            $('#list-html').text($('#org').html());
            $('#org').bind('DOMSubtreeModified', function() {
                $('#list-html').text('');
                $('#list-html').text($('#org').html());
                prettyPrint();                
            });
");
?>

<div class="content-head underline">
    <h2><?php echo Yii::t('label','Companyorganisations') ?></h2>
	<div class="content-action">
	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Index')),
						array('label'=>Yii::t('label','Update'), 'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Update')),					
                    ),
                ));
    ?>
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