<?php
$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>'Create Task', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('#CreateTask').attr('href',$('#CreateTask').attr('href')+'/id/".$keyid."');
$('#ListTask').attr('href',$('#ListTask').attr('href')+'/id/".$keyid."');
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('task-grid', {
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
	<h2><?php echo Yii::t('label','Tasks')?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('id'=>'ListTask'),'visible'=>Yii::app()->user->checkAccess('Item.task.Index')),
                      array('label'=>Yii::t('label','Create'), 'linkOptions'=>array('id'=>'CreateTask','class'=>'current'),'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.task.Create')),					
						array('label'=>Yii::t('label','Manage'),'linkOptions'=>array('class'=>'current') ,'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.task.Admin')),					
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
	'id'=>'task-grid',
	'dataProvider'=>$model->search(),
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<div class="title-bar">'.'{summary}</div>{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'fTaskNo',
		'fItemNo',
		'fCatalogueNo',
		'fTheme',
		'fContent',
		'fRemarks',
		/*
		'fStartDate',
		'fEndDate',
		'fSponsor',
		'fExecutor',
		'fCreateUser',
		'fCreateDate',
		'fSchedule',
		'fStatus',
		'fPriority',
		'fWarnFrequency',
		'fTaskType',
		'fLatestAffixId',
		'fIsItem',
		'fUserGroup',
		'fUpdateUser',
		'fUpdateDate',
		'fRemarks1',
		'fRemarks2',
		'fRemarks3',
		'fRemarks4',
		'fRemarks5',
		'fStandardStatus',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
