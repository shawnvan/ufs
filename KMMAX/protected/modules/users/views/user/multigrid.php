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
              	     for(var i=0;i<selectedRowId.length;i++) {
                  	    var ret = grid.jqGrid('getRowData',selectedRowId[i]);
                  	    if(insertUserNo=='')insertUserNo=ret.fUserName;
		                else insertUserNo=insertUserNo+','+ret.fUserName
         }
		jQuery.ajax({
			url:'".Yii::app()->createUrl('Item/itemuser/insertUser')."/id/'+jQuery('#hiddenpkey').val(),
		    cache: false,
		    type:'post',
		    data: 'name='+insertUserNo+'&id='+$('#hiddenpkey').val(),
			success: function(data){
               parent.$('#CreateUser').colorbox.close('保存成功');
		     }
		 });
     return false;
  });
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Users')?></h2>
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
	<input type="hidden" value="<?php echo $keyid?>" id="hiddenpkey" name="hiddenpkey" />
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fUserName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLastName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fFirstName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fEmail'))),
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
		array('name'=>'fCreateDate'),
		array('name'=>'fCreateUser'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fUpdateUser'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
		'multiselect'=>'true',
        'sColumns'=>array(
		array('title'=>$sort->link('fUserName')),
		array('title'=>$sort->link('fPassword')),
		array('title'=>$sort->link('fLastName')),
		array('title'=>$sort->link('fFirstName')),
		array('title'=>$sort->link('fEmail')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		array('title'=>$sort->link('fUpdateUser')),
	
        ),
       'sortname'=>'fUserID',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('users/user/multigridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>