<?php
$this->breadcrumbs=array(
	'Groupusers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Groupuser', 'url'=>array('index')),
	array('label'=>'Manage Groupuser', 'url'=>array('admin')),
);
?>

<h1>Create Groupuser</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>