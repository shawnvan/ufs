<?php
$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	$model->fUserID,
);

$this->menu=array(
	array('label'=>'List UserProfile', 'url'=>array('index')),
	array('label'=>'Create UserProfile', 'url'=>array('create')),
	array('label'=>'Update UserProfile', 'url'=>array('update', 'id'=>$model->fUserID)),
	array('label'=>'Delete UserProfile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fUserID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserProfile', 'url'=>array('admin')),
);
?>

<h1>View UserProfile #<?php echo $model->fUserID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fUserID',
		'fModelName',
		'fDataGridColumn',
		'fQueryCondition',
		'fCreateUser',
		'fCreateDate',
		'fUpdateUser',
		'fUpdateDate',
	),
)); ?>
