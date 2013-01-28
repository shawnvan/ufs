<?php
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('index')),
	array('label'=>'Create Contacts', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contacts-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Contacts</h1>

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
	'id'=>'contacts-grid',
	'dataProvider'=>$model->search(),
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<div class="title-bar">'.'{summary}</div>{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'fContactID',
		'fContactName',
		'fFristName',
		'fLastName',
		'fContactTitle',
		'fCompany',
		/*
		'fPhone',
		'fPhone2',
		'fEmail',
		'fWebsite',
		'fAddress',
		'fAddress2',
		'fCity',
		'fState',
		'fZipCode',
		'fCountry',
		'fVisibility',
		'fAssignedTo',
		'fBackGroundInfo',
		'fQQ',
		'fLinkedIn',
		'fMSN',
		'fCreateDate',
		'fCreateUser',
		'fUpdateDate',
		'fUpadateUser',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
