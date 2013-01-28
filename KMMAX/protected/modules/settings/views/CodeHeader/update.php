<?php
$this->breadcrumbs=array(
	'Codeheaders'=>array('index'),
	$model->fListName=>array('view','id'=>$model->fListName),
	'Update',
);

$this->menu=array(
	array('label'=>'List Codeheader', 'url'=>array('index')),
	array('label'=>'Create Codeheader', 'url'=>array('create')),
	array('label'=>'View Codeheader', 'url'=>array('view', 'id'=>$model->fListName)),
	array('label'=>'Manage Codeheader', 'url'=>array('admin')),
);
?>

<h1>Update Codeheader <?php echo $model->fListName; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>