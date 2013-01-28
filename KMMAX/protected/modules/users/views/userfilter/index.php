<?php
$this->breadcrumbs=array(
	'Userfilters',
);

$this->menu=array(
	array('label'=>'Create Userfilter', 'url'=>array('create')),
	array('label'=>'Manage Userfilter', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Userfilters</h2>

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
            		array('title'=>CHtml::encode($sort->resolveLabel('fUserFilterID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUserID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fFormID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fDataGridColumn'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fQueryCondition'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fUserFilterID'),
		array('name'=>'fUserID'),
		array('name'=>'fFormID'),
		array('name'=>'fDataGridColumn'),
		array('name'=>'fQueryCondition'),
		array('name'=>'fCreateUser'),
		/*
		array('name'=>'fCreateDate'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fUserFilterID')),
		array('title'=>$sort->link('fUserID')),
		array('title'=>$sort->link('fFormID')),
		array('title'=>$sort->link('fDataGridColumn')),
		array('title'=>$sort->link('fQueryCondition')),
		array('title'=>$sort->link('fCreateUser')),
		/*
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		*/
	
        ),
         		'sortname'=>'fUserFilterID',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('users/userfilter/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>