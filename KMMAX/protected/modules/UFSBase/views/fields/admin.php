<?php
$this->breadcrumbs=array(
	'Fields'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Fields', 'url'=>array('index')),
	array('label'=>'Create Fields', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('fields-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Fields</h1>

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
	'id'=>'fields-grid',
	'dataProvider'=>$model->search(),
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<div class="title-bar">'.'{summary}</div>{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'fFieldID',
		'fModelName',
		'fFieldName',
		'fAttributeLabel',
		'fModified',
		'fCustom',
		/*
		'fType',
		'fRequired',
		'fReadOnly',
		'fLinkType',
		'fSearchable',
		'fRelevance',
		'fIsVirtual',
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
