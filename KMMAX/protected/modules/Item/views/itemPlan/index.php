<?php
$this->breadcrumbs=array(
	'Itemplans',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
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
                		array('label'=>Yii::t('label','List Itemplan'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.itemplan.Index')),
						array('label'=>Yii::t('label','Create Itemplan'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.itemplan.Create')),					
						array('label'=>Yii::t('label','Manage Itemplan'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.itemplan.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		array('title'=>CHtml::encode($sort->resolveLabel('fItemNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fItemTimeNode'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fItemStart'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fItemEnd'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fItemPerson'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fItemFee'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fItemOtherPerson'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fItemNo'),
		array('name'=>'fItemTimeNode'),
		array('name'=>'fItemStart'),
		array('name'=>'fItemEnd'),
		array('name'=>'fItemPerson'),
		array('name'=>'fItemFee'),
		/*
		array('name'=>'fItemOtherPerson'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fItemNo')),
		array('title'=>$sort->link('fItemTimeNode')),
		array('title'=>$sort->link('fItemStart')),
		array('title'=>$sort->link('fItemEnd')),
		array('title'=>$sort->link('fItemPerson')),
		array('title'=>$sort->link('fItemFee')),
		/*
		array('title'=>$sort->link('fItemOtherPerson')),
		*/
	
        ),
       'sortname'=>'fItemNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/itemplan/gridData',$_GET),
        'modulename'=>'Itemplan',
    )); ?>
</div>