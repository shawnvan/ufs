<?php
$this->breadcrumbs=array(
	'Fields',
);

$this->menu=array(
	array('label'=>'Create Fields', 'url'=>array('create')),
	array('label'=>'Manage Fields', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Fields</h2>

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
            		array('title'=>CHtml::encode($sort->resolveLabel('fFieldID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fModelName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fFieldName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fAttributeLabel'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fModified'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCustom'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fType'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fRequired'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fReadOnly'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLinkType'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSearchable'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fRelevance'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fIsVirtual'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fFieldID'),
		array('name'=>'fModelName'),
		array('name'=>'fFieldName'),
		array('name'=>'fAttributeLabel'),
		array('name'=>'fModified'),
		array('name'=>'fCustom'),
		/*
		array('name'=>'fType'),
		array('name'=>'fRequired'),
		array('name'=>'fReadOnly'),
		array('name'=>'fLinkType'),
		array('name'=>'fSearchable'),
		array('name'=>'fRelevance'),
		array('name'=>'fIsVirtual'),
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
            		array('title'=>$sort->link('fFieldID')),
		array('title'=>$sort->link('fModelName')),
		array('title'=>$sort->link('fFieldName')),
		array('title'=>$sort->link('fAttributeLabel')),
		array('title'=>$sort->link('fModified')),
		array('title'=>$sort->link('fCustom')),
		/*
		array('title'=>$sort->link('fType')),
		array('title'=>$sort->link('fRequired')),
		array('title'=>$sort->link('fReadOnly')),
		array('title'=>$sort->link('fLinkType')),
		array('title'=>$sort->link('fSearchable')),
		array('title'=>$sort->link('fRelevance')),
		array('title'=>$sort->link('fIsVirtual')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		*/
	
        ),
         		'sortname'=>'fFieldID',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('UFSBase/fields/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>