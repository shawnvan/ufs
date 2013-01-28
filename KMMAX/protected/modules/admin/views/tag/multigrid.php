<?php
$this->breadcrumbs=array(
	'Users',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('submenu .current').click(function(){
	return false;
});	
   $('#Confrim').click(function(){
	   var selectedRowId=grid.jqGrid('getGridParam','selarrrow');
		if(selectedRowId=='') {alert('您未选择任务标准任务');return false;}
		 var insertUserNo='';
		 var insertUserName='';
              	     for(var i=0;i<selectedRowId.length;i++) {
                  	    var ret = grid.jqGrid('getRowData',selectedRowId[i]);
                  	    if(insertUserNo==''){
						  insertUserNo=ret.fTagNo;
		                  insertUserName=ret.fName;
						}
		                else {
		                insertUserNo=insertUserNo+','+ret.fTagNo;
						insertUserName=insertUserName+','+ret.fName;
		                }
         }
		parent.$('#Knowledge_fTags').val(insertUserNo);
		parent.$('#fTags').val(insertUserName);
	   parent.$('.SelectTag').colorbox.close('保存成功');

     return false;
  });

");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Tags')?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','Confirm'),'url'=>array('Confirm'),'linkOptions'=>array('id'=>'Confrim','class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Index')),											
                    ),
                ));
    ?>
	</div>

</div>
<div class="content">
<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
array('title'=>CHtml::encode($sort->resolveLabel('fTagNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
        ),
        'columnsModel'=>array(
array('name'=>'fTagNo'),
		array('name'=>'fName'),
		array('name'=>'fStatus'),
		array('name'=>'fCreateUser'),
		array('name'=>'fCreateDate'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
		 		
        ),
		'multiselect'=>'true',
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
array('title'=>$sort->link('fTagNo')),
		array('title'=>$sort->link('fName')),
		array('title'=>$sort->link('fStatus')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
	
        ),
       'sortname'=>'fName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/tag/gridData/multi',$_GET),
        'modulename'=>'Tag',
    )); ?>

</div>