<?php
$this->breadcrumbs=array(
	'Itemplans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Itemplan', 'url'=>array('index')),
	array('label'=>'Create Itemplan', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('itemplan-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Itemplans</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Itemplan'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Item.itemplan.Index')),
						array('label'=>Yii::t('label','Create Itemplan'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.itemplan.Create')),					
						array('label'=>Yii::t('label','Manage Itemplan'),'linkOptions'=>array('class'=>'current') ,'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.itemplan.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'itemplan-grid',
	'dataProvider'=>$model->search(),
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<div class="title-bar">'.'{summary}</div>{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'fItemNo',
		'fItemTimeNode',
		'fItemStart',
		'fItemEnd',
		'fItemPerson',
		'fItemFee',
		/*
		'fItemOtherPerson',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
