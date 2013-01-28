<?php
$this->breadcrumbs=array(
	'Tags',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.clear').click(function(){
	$('input:text').val('');
	return false;
});			
jQuery('.datepicker').datepicker().datepicker('option', 'dateFormat','yy-mm-dd');			
");
?>

<div class="content-head underline">
<h2><?php echo Yii::t('label','Tags')?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.tag.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.tag.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.tag.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<?php echo CHtml::link(Yii::t('label','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form advanced_search">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
        ),
        'columnsModel'=>array(
		array('name'=>'fName'),
		array('name'=>'fStatus'),
		array('name'=>'fCreateUser'),
		array('name'=>'fCreateDate'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
		array('title'=>$sort->link('fName')),
		array('title'=>$sort->link('fStatus')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
	
        ),
       'sortname'=>'fName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/tag/gridData',$_GET),
        'modulename'=>'Tag',
    )); ?>
</div>