<?php
$this->breadcrumbs=array(
	'Userfilters'=>array('index'),
	$model->fUserFilterID=>array('view','id'=>$model->fUserFilterID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userfilter', 'url'=>array('index')),
	array('label'=>'Create Userfilter', 'url'=>array('create')),
	array('label'=>'View Userfilter', 'url'=>array('view', 'id'=>$model->fUserFilterID)),
	array('label'=>'Manage Userfilter', 'url'=>array('admin')),
);
?>

<h1>Update Userfilter <?php echo $model->fUserFilterID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>