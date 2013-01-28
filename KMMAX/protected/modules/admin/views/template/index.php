<?php
$this->breadcrumbs=array(
	'Templates',
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
				  url:'".Yii::app()->createUrl('admin/Template/deletetemp/id')."/'+$(this).attr('rel'),
				  type:'post',
				  success: function(data){
        		    if(data!='') alert(data);
				    var urlindex='".Yii::app()->createUrl('admin/Template/gridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Templates') ?></h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.template.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.template.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.template.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<?php echo CHtml::link(Yii::t('label','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form advanced_search">
<?php $this->renderPartial('_search',array(
	'model'=>$model,'fTemplateType'=>$fTemplateType
)); ?>
</div><!-- search-form -->
<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		array('title'=>CHtml::encode($sort->resolveLabel('fTemplateNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fTemplateName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fTemplateType'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
        ),
        'columnsModel'=>array(
		array('name'=>'fTemplateNo','editrules'=>'{required:true,edithidden:true}', 'hidden'=>true),
		array('name'=>'fTemplateName'),
		array('name'=>'fTemplateType'),
		array('name'=>'fCreate'),
		array('name'=>'fCreateDate'),
		array('name'=>'fUpdate'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fStatus'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
        array('title'=>$sort->link('fTemplateNo')),
		array('title'=>$sort->link('fTemplateName')),
		array('title'=>$sort->link('fTemplateType')),
		array('title'=>$sort->link('fCreate')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUpdate')),
		array('title'=>$sort->link('fUpdateDate')),
		array('title'=>$sort->link('fStatus')),
        ),
       'sortname'=>'fTemplateNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/template/gridData',$_GET),
        'modulename'=>'Template',
    )); ?>
</div>