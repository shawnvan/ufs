<?php
$this->breadcrumbs=array(
	'Workplans',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Workplans</h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Workplan'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.workplan.Index')),
						array('label'=>Yii::t('label','Create Workplan'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.workplan.Create')),					
						array('label'=>Yii::t('label','Manage Workplan'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.workplan.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		array('title'=>CHtml::encode($sort->resolveLabel('fPlanNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fTitle'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fMonth'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpPlan'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fNowPlan'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fMemo'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fPlanNo'),
		array('name'=>'fTitle'),
		array('name'=>'fMonth'),
		array('name'=>'fUpPlan'),
		array('name'=>'fNowPlan'),
		array('name'=>'fMemo'),
		/*
		array('name'=>'fCreateDate'),
		array('name'=>'fCreateUser'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fUpdateUser'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fPlanNo')),
		array('title'=>$sort->link('fTitle')),
		array('title'=>$sort->link('fMonth')),
		array('title'=>$sort->link('fUpPlan')),
		array('title'=>$sort->link('fNowPlan')),
		array('title'=>$sort->link('fMemo')),
		/*
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		array('title'=>$sort->link('fUpdateUser')),
		*/
	
        ),
       'sortname'=>'fPlanNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/workplan/gridData',$_GET),
        'modulename'=>'Workplan',
    )); ?>
</div>