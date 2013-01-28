<?php
$this->breadcrumbs=array(
	'Msgfroms',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.clear').click(function(){
	$('input:text').val('');
	return false;
});			
jQuery('.datepicker').datepicker().datepicker('option', 'dateFormat','yy-mm-dd');	
  $('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('msg/Msgfrom/deletemsg/id')."/'+$(this).attr('rel'),
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('msg/Msgfrom/gridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Msgfroms') ?></h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('msg.msgfrom.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('msg.msgfrom.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('msg.msgfrom.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<?php echo CHtml::link(Yii::t('label','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form advanced_search">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php    $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromModule'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromTheme'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromType'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromStatus'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendToAccount'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendToName'))),
        ),
        'columnsModel'=>array(
        array('name'=>'fSendFromModule'),
		array('name'=>'fSendFromTheme'),
		array('name'=>'fSendFromName'),
		array('name'=>'fSendFromType'),
		array('name'=>'fSendFromDate'),
		array('name'=>'fSendFromStatus'),
		array('name'=>'fSendToAccount'),
		array('name'=>'fSendToName'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
        array('title'=>$sort->link('fSendFromModule')),
		array('title'=>$sort->link('fSendFromTheme')),
		array('title'=>$sort->link('fSendFromName')),
		array('title'=>$sort->link('fSendFromType')),
		array('title'=>$sort->link('fSendFromDate')),
		array('title'=>$sort->link('fSendFromStatus')),
		array('title'=>$sort->link('fSendToAccount')),
		array('title'=>$sort->link('fSendToName')),
	
        ),
       'sortname'=>'fSendFromModule',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('msg/msgfrom/gridData',$_GET),
        'modulename'=>'Msgfrom',
    )); ?>
</div>