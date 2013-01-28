<?php
$this->breadcrumbs=array(
	'Codeheaders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Codeheader', 'url'=>array('index')),
	array('label'=>'Manage Codeheader', 'url'=>array('admin')),
);
?>

<h1>Create Codeheader</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>