<?php
$this->breadcrumbs=array(
	'Areas',
);

$this->menu=array(
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Areas</h2>

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
            		array('title'=>CHtml::encode($sort->resolveLabel('fAreaID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fAreaName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fParentID'))),
        ),
        'columnsModel'=>array(
 					array('name'=>'fAreaID'),
		array('name'=>'fAreaName'),
		array('name'=>'fParentID'),
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fAreaID')),
		array('title'=>$sort->link('fAreaName')),
		array('title'=>$sort->link('fParentID')),
	
        ),
         		'sortname'=>'fAreaID',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('settings/area/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>