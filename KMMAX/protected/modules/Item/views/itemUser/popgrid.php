<?php
$this->breadcrumbs=array(
	'Itemusers',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
 function dbClickRow(rowid,status){
		if(rowid){
			var ret = grid.jqGrid('getRowData',rowid);
		     parent.$('#Task_fExecutor').val(ret.fEmployeeName);
		     parent.$('.SelectUser').colorbox.close('保存成功');
		}
	} 		
");
?>

<div class="content-head underline">
<h2><?php echo Yii::t('label','Itemusers')?></h2>
<input type="hidden" value="<?php echo $keyid?>" id="hiddenpkey" name="hiddenpkey" />
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fEmployeeName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fRoleNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
	array('title'=>CHtml::encode($sort->resolveLabel('fUserType'))),
        ),
        'columnsModel'=>array(
		array('name'=>'fEmployeeName'),
		array('name'=>'fRoleNo'),
		array('name'=>'fCreateUser'),
		array('name'=>'fCreateDate'),
	array('name'=>'fUserType'),	 		
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
		array('title'=>$sort->link('fEmployeeName')),
		array('title'=>$sort->link('fRoleNo')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUserType')),	
        ),
       'sortname'=>'fEmployeeNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/itemuser/popgridData',$_GET),
        'modulename'=>'Itemuser',
    )); ?>
</div>