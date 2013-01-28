<?php
$this->breadcrumbs=array(
	'Msgtos',
);
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
				  url:'".Yii::app()->createUrl('msg/msgto/delete/id')."/'+$(this).attr('rel'),
				  type:'POST',
				  success: function(data){
				     var urlindex='".Yii::app()->createUrl('msg/msgto/gridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });		
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Msgtos') ?></h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('msg.msgto.Index')),
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
<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fSendMsgStatus'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendToLookDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromModule'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromType'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendFromTheme'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendToAllAccount'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSendToAllName'))),
        ),
        'columnsModel'=>array(
		array('name'=>'fSendMsgStatus'),
		array('name'=>'fSendToLookDate'),
		array('name'=>'fSendFromName'),
		array('name'=>'fSendFromDate'),
		array('name'=>'fSendFromModule'),
		array('name'=>'fSendFromType'),
		array('name'=>'fSendFromTheme'),
		array('name'=>'fSendToAllAccount'),
		array('name'=>'fSendToAllName'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
		array('title'=>$sort->link('fSendMsgStatus')),
		array('title'=>$sort->link('fSendToLookDate')),
		array('title'=>$sort->link('fSendUserNo')),
		array('title'=>$sort->link('fSendFromName')),
		array('title'=>$sort->link('fSendFromDate')),
		array('title'=>$sort->link('fSendFromModule')),
		array('title'=>$sort->link('fSendFromType')),
		array('title'=>$sort->link('fSendFromTheme')),
		array('title'=>$sort->link('fSendToAllAccount')),
		array('title'=>$sort->link('fSendToAllName')),
	
        ),
       'sortname'=>'fSendToNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('msg/msgto/gridData',$_GET),
        'modulename'=>'Msgto',
    )); ?>
</div>