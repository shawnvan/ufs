<?php
$this->breadcrumbs=array(
	'Groupusers'=>array('index'),
	$model->fGroupUID=>array('view','id'=>$model->fGroupUID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Groupuser', 'url'=>array('index')),
	array('label'=>'Create Groupuser', 'url'=>array('create')),
	array('label'=>'View Groupuser', 'url'=>array('view', 'id'=>$model->fGroupUID)),
	array('label'=>'Manage Groupuser', 'url'=>array('admin')),
);
?>

<h1>Update Groupuser <?php echo $model->fGroupUID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>