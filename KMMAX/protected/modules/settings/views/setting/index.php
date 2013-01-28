<?php
$this->breadcrumbs=array(
	'Settings',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Settings</h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Settings'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('settings.setting.Index')),
						array('label'=>Yii::t('label','Create Settings'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('settings.setting.Create')),					
						array('label'=>Yii::t('label','Manage Settings'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('settings.setting.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		array('title'=>CHtml::encode($sort->resolveLabel('fName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLabel'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fValue'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fDescription'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fGroupName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSequence'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fIsActive'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fModule'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fName'),
		array('name'=>'fLabel'),
		array('name'=>'fValue'),
		array('name'=>'fDescription'),
		array('name'=>'fGroupName'),
		array('name'=>'fSequence'),
		/*
		array('name'=>'fIsActive'),
		array('name'=>'fModule'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fName')),
		array('title'=>$sort->link('fLabel')),
		array('title'=>$sort->link('fValue')),
		array('title'=>$sort->link('fDescription')),
		array('title'=>$sort->link('fGroupName')),
		array('title'=>$sort->link('fSequence')),
		/*
		array('title'=>$sort->link('fIsActive')),
		array('title'=>$sort->link('fModule')),
		*/
	
        ),
       'sortname'=>'fName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('settings/setting/gridData',$_GET),
        'modulename'=>'Settings',
    )); ?>
</div>