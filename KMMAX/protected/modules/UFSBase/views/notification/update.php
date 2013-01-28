<?php
$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	$model->fNotifyID=>array('view','id'=>$model->fNotifyID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Notification', 'url'=>array('index')),
	array('label'=>'Create Notification', 'url'=>array('create')),
	array('label'=>'View Notification', 'url'=>array('view', 'id'=>$model->fNotifyID)),
	array('label'=>'Manage Notification', 'url'=>array('admin')),
);
?>

<h1>Update Notification <?php echo $model->fNotifyID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>