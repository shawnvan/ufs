<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	$model->fAreaID=>array('view','id'=>$model->fAreaID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'View Area', 'url'=>array('view', 'id'=>$model->fAreaID)),
	array('label'=>'Manage Area', 'url'=>array('admin')),
);
?>

<h1>Update Area <?php echo $model->fAreaID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>