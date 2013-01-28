<?php
$this->breadcrumbs=array(
	'Modules',
);

$this->menu=array(
	array('label'=>'Create Modules', 'url'=>array('create')),
	array('label'=>'Manage Modules', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Modules</h2>

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
            		array('title'=>CHtml::encode($sort->resolveLabel('fModuleID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fModuleName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fModuleTitle'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fIsVisible'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSearchable'))),
		array('title'=>CHtml::encode($sort->resolveLabel('FCustom'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fModuleID'),
		array('name'=>'fModuleName'),
		array('name'=>'fModuleTitle'),
		array('name'=>'fIsVisible'),
		array('name'=>'fSearchable'),
		array('name'=>'FCustom'),
		/*
		array('name'=>'fCreateDate'),
		array('name'=>'fCreateUser'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fModuleID')),
		array('title'=>$sort->link('fModuleName')),
		array('title'=>$sort->link('fModuleTitle')),
		array('title'=>$sort->link('fIsVisible')),
		array('title'=>$sort->link('fSearchable')),
		array('title'=>$sort->link('FCustom')),
		/*
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		*/
	
        ),
         		'sortname'=>'fModuleID',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('UFSBase/modules/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>