<?php
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->fContactID=>array('view','id'=>$model->fContactID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('index')),
	array('label'=>'Create Contacts', 'url'=>array('create')),
	array('label'=>'View Contacts', 'url'=>array('view', 'id'=>$model->fContactID)),
	array('label'=>'Manage Contacts', 'url'=>array('admin')),
);
?>

<h1>Update Contacts <?php echo $model->fContactID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>