<?php
$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Notification', 'url'=>array('index')),
	array('label'=>'Create Notification', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('notification-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Notifications</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notification-grid',
	'dataProvider'=>$model->search(),
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<div class="title-bar">'.'{summary}</div>{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'fNotifyID',
		'fType',
		'fComparison',
		'fValue',
		'fModelType',
		'fModelID',
		/*
		'fFieldName',
		'fUserName',
		'fUserID',
		'fCreatedBy',
		'fViewed',
		'fCreateDate',
		'fCreateUser',
		'fUpdateUser',
		'fUpdateDate',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
