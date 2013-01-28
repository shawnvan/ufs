<?php
$this->breadcrumbs=array(
	'Templetstandardtasks',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Templetstandardtasks</h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Templetstandardtask'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.templetstandardtask.Index')),
						array('label'=>Yii::t('label','Create Templetstandardtask'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.templetstandardtask.Create')),					
						array('label'=>Yii::t('label','Manage Templetstandardtask'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.templetstandardtask.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		array('title'=>CHtml::encode($sort->resolveLabel('fTemplateNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fTaskNo'))),
        ),
        'columnsModel'=>array(
 					array('name'=>'fTemplateNo'),
		array('name'=>'fCatalogueNo'),
		array('name'=>'fTaskNo'),
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fTemplateNo')),
		array('title'=>$sort->link('fCatalogueNo')),
		array('title'=>$sort->link('fTaskNo')),
	
        ),
       'sortname'=>'fTaskNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/templetstandardtask/gridData',$_GET),
        'modulename'=>'Templetstandardtask',
    )); ?>
</div>