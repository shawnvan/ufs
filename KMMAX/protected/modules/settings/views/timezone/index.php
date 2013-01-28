<?php
$this->breadcrumbs=array(
	'Timezones',
);

$this->menu=array(
	array('label'=>'Create Timezone', 'url'=>array('create')),
	array('label'=>'Manage Timezone', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Timezones</h2>

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
            		array('title'=>CHtml::encode($sort->resolveLabel('fTimeZoneID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fTimeZoneName'))),
        ),
        'columnsModel'=>array(
 					array('name'=>'fTimeZoneID'),
		array('name'=>'fTimeZoneName'),
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fTimeZoneID')),
		array('title'=>$sort->link('fTimeZoneName')),
	
        ),
         		'sortname'=>'fTimeZoneID',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('settings/timezone/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>