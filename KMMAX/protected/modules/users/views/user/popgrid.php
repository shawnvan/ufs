<?php
$this->breadcrumbs=array(
	'Users',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('submenu .current').click(function(){
	return false;
});
	
 function dbClickRow(rowid,status){
		if(rowid){
			var ret = grid.jqGrid('getRowData',rowid);
		     parent.$('#Item_fResponsibleCreate').val(ret.fUserName);
		     parent.$('#User_fLead').val(ret.fUserName);
		     parent.$('#Task_fExecutor').val(ret.fUserName);
		     parent.$('.SelectUser').colorbox.close('保存成功');
		}
	} 
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Users')?></h2>
</div>
<div class="content">
<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fUserName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLastName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fFirstName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fEmail'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLead'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
        ),
        'columnsModel'=>array(
		array('name'=>'fUserName'),
		array('name'=>'fLastName'),
		array('name'=>'fFirstName'),
		array('name'=>'fEmail'),
		array('name'=>'fLead'),
		array('name'=>'fStatus'),
		array('name'=>'fCreateDate'),
		array('name'=>'fCreateUser'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fUpdateUser'),
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
		array('title'=>$sort->link('fUserName')),
		array('title'=>$sort->link('fLastName')),
		array('title'=>$sort->link('fFirstName')),
		array('title'=>$sort->link('fEmail')),
		array('title'=>$sort->link('fLead')),
		array('title'=>$sort->link('fStatus')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		array('title'=>$sort->link('fUpdateUser')),
	
        ),
       'sortname'=>'fUserID',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('users/user/popgridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>