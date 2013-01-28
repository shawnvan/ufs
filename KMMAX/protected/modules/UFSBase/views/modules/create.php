<?php
$this->breadcrumbs=array(
	'Modules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Modules', 'url'=>array('index')),
	array('label'=>'Manage Modules', 'url'=>array('admin')),
);
?>

<h1>Create Modules</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>