<?php
$this->breadcrumbs=array(
	'Modules'=>array('index'),
	$model->fModuleID=>array('view','id'=>$model->fModuleID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Modules', 'url'=>array('index')),
	array('label'=>'Create Modules', 'url'=>array('create')),
	array('label'=>'View Modules', 'url'=>array('view', 'id'=>$model->fModuleID)),
	array('label'=>'Manage Modules', 'url'=>array('admin')),
);
?>

<h1>Update Modules <?php echo $model->fModuleID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>