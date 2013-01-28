<?php
$this->breadcrumbs=array(
	'Configs',
);

$this->menu=array(
	array('label'=>'Create Config', 'url'=>array('create')),
	array('label'=>'Manage Config', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Configs</h2>

			<div class="content-action">
			<ul class="submenu">
				<li class="current"><a href="">添加用户</a></li>
				<li><a href="">修改用户</a></li>
				<li><a href="">复制用户</a></li><li><a href="">查看用户</a></li>
			</ul>
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
		array('title'=>CHtml::encode($sort->resolveLabel('fVisible'))),
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
		array('name'=>'fVisible'),
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
		array('title'=>$sort->link('fVisible')),
		array('title'=>$sort->link('fModule')),
		*/
	
        ),
         		'sortname'=>'fName',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('settings/config/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>