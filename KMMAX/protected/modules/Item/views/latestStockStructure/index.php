<?php
$this->breadcrumbs=array(
	'Latest Stock Structures',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Latest Stock Structures</h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List LatestStockStructure'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.latestStockStructure.Index')),
						array('label'=>Yii::t('label','Create LatestStockStructure'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.latestStockStructure.Create')),					
						array('label'=>Yii::t('label','Manage LatestStockStructure'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.latestStockStructure.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		array('title'=>CHtml::encode($sort->resolveLabel('fItemNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fHistoryNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fShareholderName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fFristStrands'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fFristRate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSecondStrands'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fSecondRate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fThirdStrands'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fThirdRate'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fItemNo'),
		array('name'=>'fHistoryNo'),
		array('name'=>'fShareholderName'),
		array('name'=>'fFristStrands'),
		array('name'=>'fFristRate'),
		array('name'=>'fSecondStrands'),
		/*
		array('name'=>'fSecondRate'),
		array('name'=>'fThirdStrands'),
		array('name'=>'fThirdRate'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fItemNo')),
		array('title'=>$sort->link('fHistoryNo')),
		array('title'=>$sort->link('fShareholderName')),
		array('title'=>$sort->link('fFristStrands')),
		array('title'=>$sort->link('fFristRate')),
		array('title'=>$sort->link('fSecondStrands')),
		/*
		array('title'=>$sort->link('fSecondRate')),
		array('title'=>$sort->link('fThirdStrands')),
		array('title'=>$sort->link('fThirdRate')),
		*/
	
        ),
       'sortname'=>'fHistoryNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/latestStockStructure/gridData',$_GET),
        'modulename'=>'LatestStockStructure',
    )); ?>
</div>