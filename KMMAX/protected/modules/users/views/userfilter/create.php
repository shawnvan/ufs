<?php
$this->breadcrumbs=array(
	'Userfilters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Userfilter', 'url'=>array('index')),
	array('label'=>'Manage Userfilter', 'url'=>array('admin')),
);
?>

<h1>Create Userfilter</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>