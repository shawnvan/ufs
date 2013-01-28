<?php
$this->breadcrumbs=array(
	'Timezones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Timezone', 'url'=>array('index')),
	array('label'=>'Manage Timezone', 'url'=>array('admin')),
);
?>

<h1>Create Timezone</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>