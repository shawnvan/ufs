<?php
$this->breadcrumbs=array(
	'Configs'=>array('index'),
	$model->fName=>array('view','id'=>$model->fName),
	'Update',
);

$this->menu=array(
	array('label'=>'List Config', 'url'=>array('index')),
	array('label'=>'Create Config', 'url'=>array('create')),
	array('label'=>'View Config', 'url'=>array('view', 'id'=>$model->fName)),
	array('label'=>'Manage Config', 'url'=>array('admin')),
);
?>

<h1>Update Config <?php echo $model->fName; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>