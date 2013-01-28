<?php
$this->breadcrumbs=array(
	'Stock Structures',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Stock Structures</h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List StockStructure'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.stockStructure.Index')),
						array('label'=>Yii::t('label','Create StockStructure'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.stockStructure.Create')),					
						array('label'=>Yii::t('label','Manage StockStructure'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.stockStructure.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		array('title'=>CHtml::encode($sort->resolveLabel('fSSNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fItemNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fHistoryNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fShareholderName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fShareholdingNum'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fShareholderRate'))),
        ),
        'columnsModel'=>array(
 					array('name'=>'fSSNo'),
		array('name'=>'fItemNo'),
		array('name'=>'fHistoryNo'),
		array('name'=>'fShareholderName'),
		array('name'=>'fShareholdingNum'),
		array('name'=>'fShareholderRate'),
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fSSNo')),
		array('title'=>$sort->link('fItemNo')),
		array('title'=>$sort->link('fHistoryNo')),
		array('title'=>$sort->link('fShareholderName')),
		array('title'=>$sort->link('fShareholdingNum')),
		array('title'=>$sort->link('fShareholderRate')),
	
        ),
       'sortname'=>'fSSNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/stockStructure/gridData',$_GET),
        'modulename'=>'StockStructure',
    )); ?>
</div>