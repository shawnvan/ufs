<?php
$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	$model->fUserID=>array('view','id'=>$model->fUserID),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserProfile', 'url'=>array('index')),
	array('label'=>'Create UserProfile', 'url'=>array('create')),
	array('label'=>'View UserProfile', 'url'=>array('view', 'id'=>$model->fUserID)),
	array('label'=>'Manage UserProfile', 'url'=>array('admin')),
);
?>

<h1>Update UserProfile <?php echo $model->fUserID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>