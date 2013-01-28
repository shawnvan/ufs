<?php
$this->breadcrumbs=array(
	'Templates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Template', 'url'=>array('index')),
	array('label'=>'Create Template', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
jQuery('.datepicker').datepicker();		
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('template-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('.submenu .current').click(function(){
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
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.template.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.template.Create')),					
						array('label'=>Yii::t('label','Manage'),'linkOptions'=>array('class'=>'current') ,'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.template.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<?php echo CHtml::link(Yii::t('label','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,'fTemplateType'=>$fTemplateType,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'template-grid',
	'dataProvider'=>$model->search(),
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<div class="title-bar">'.'{summary}</div>{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'fTemplateNo',
		'fTemplateName',
		'fTemplateType',
		'fCreate',
		'fCreateDate',
		'fUpdate',
		'fUpdateDate',

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
