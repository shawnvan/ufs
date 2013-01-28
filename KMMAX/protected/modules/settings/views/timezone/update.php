<?php
$this->breadcrumbs=array(
	'Timezones'=>array('index'),
	$model->fTimeZoneID=>array('view','id'=>$model->fTimeZoneID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Timezone', 'url'=>array('index')),
	array('label'=>'Create Timezone', 'url'=>array('create')),
	array('label'=>'View Timezone', 'url'=>array('view', 'id'=>$model->fTimeZoneID)),
	array('label'=>'Manage Timezone', 'url'=>array('admin')),
);
?>

<h1>Update Timezone <?php echo $model->fTimeZoneID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>