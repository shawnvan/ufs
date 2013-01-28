<?php
$this->breadcrumbs=array(
	'Fields'=>array('index'),
	$model->fFieldID=>array('view','id'=>$model->fFieldID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Fields', 'url'=>array('index')),
	array('label'=>'Create Fields', 'url'=>array('create')),
	array('label'=>'View Fields', 'url'=>array('view', 'id'=>$model->fFieldID)),
	array('label'=>'Manage Fields', 'url'=>array('admin')),
);
?>

<h1>Update Fields <?php echo $model->fFieldID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>