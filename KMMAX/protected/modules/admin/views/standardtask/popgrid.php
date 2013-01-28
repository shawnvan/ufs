<?php
$this->breadcrumbs=array(
	'Standardtasks',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});

$('#Confrim').click(function(){
	   var selectedRowId=grid.jqGrid('getGridParam','selarrrow');
		if(selectedRowId=='') {alert('您未选择任务标准任务');return false;}
		 var insertTaskNo='';
              	     for(var i=0;i<selectedRowId.length;i++) {
                  	    var ret = grid.jqGrid('getRowData',selectedRowId[i]);
                  	    if(insertTaskNo =='') insertTaskNo=ret.fTaskNo;
		                else insertTaskNo=insertTaskNo+','+ret.fTaskNo;
         }
		jQuery.ajax({
			url:'".Yii::app()->createUrl('admin/Templetstandardtask/insertstandardtask')."/cNo/'+jQuery('#treeid').val()+'/tNo/'+jQuery('#fTemplateNo').val()+'/taskno/'+ret.fTaskNo,
		    cache: false,
		    type:'POST',
		    data: 'tno='+insertTaskNo+'&id='+$('#hiddenpkey').val()+'&cno='+$('#treeid').val(),
			success: function(data){
               parent.$('#AddStandardTask').colorbox.close('保存成功');
		     }
		 });
     return false;
  });
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Standardtasks') ?></h2>
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
<input type="hidden" value="<?php echo $keyid?>" id="hiddenpkey" name="hiddenpkey" />
<input type="hidden" id="treeid"  value="<?php echo $treeid?>"/>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            	array('title'=>CHtml::encode($sort->resolveLabel('fTaskNo'))),
        		array('title'=>CHtml::encode($sort->resolveLabel('fTheme'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fAttachName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fContent'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fTaskType'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSubmitUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSubmitDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fConfirmUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fConfirmDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
        ),
        'columnsModel'=>array(
        array('name'=>'fTaskNo','editrules'=>'{required:true,edithidden:true}', 'hidden'=>true),
        		array('name'=>'fTheme'),
		array('name'=>'fCatalogueNo'),
		array('name'=>'fAttachName'),
		
		array('name'=>'fContent'),
		array('name'=>'fTaskType'),
		array('name'=>'fSubmitUser'),
		array('name'=>'fSubmitDate'),
		array('name'=>'fConfirmUser'),
		array('name'=>'fConfirmDate'),
		array('name'=>'fCreateUser'),
		array('name'=>'fCreateDate'),
		array('name'=>'fStatus'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
		'multiselect'=>'true',
        'sColumns'=>array(
         array('title'=>$sort->link('fTaskNo')),array('title'=>$sort->link('fTheme')),
		array('title'=>$sort->link('fCatalogueNo')),
		array('title'=>$sort->link('fAttachName')),
		array('title'=>$sort->link('fContent')),
		array('title'=>$sort->link('fTaskType')),
		array('title'=>$sort->link('fSubmitUser')),
		array('title'=>$sort->link('fSubmitDate')),
		array('title'=>$sort->link('fConfirmUser')),
		array('title'=>$sort->link('fConfirmDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fStatus')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
	
        ),
       'sortname'=>'fTaskNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/standardtask/popgridData',$_GET),
        'modulename'=>'Standardtask',
    )); ?>
</div>