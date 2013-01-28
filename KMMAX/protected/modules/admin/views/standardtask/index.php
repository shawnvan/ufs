<?php
$this->breadcrumbs=array(
	'Standardtasks',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.clear').click(function(){
	$('input:text').val('');
	return false;
});			
jQuery('.datepicker').datepicker().datepicker('option', 'dateFormat','yy-mm-dd');			
$('.UFSGrid-row-attach').live('click',function(){ 
		var url =	'".Yii::app()->createUrl('Item/attachment/view')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
	    $(this).colorbox({iframe:true, width:'100%', height:'100%',onClosed: function (message) {}});
  		return false;
     });
		function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
				var noteid=noteid+'_span';
		        jQuery('#treeid').val(treeId);
				jQuery('#ztree-checked-note').val(noteid);
				jQuery.ajax({				
				  cache: false,
				  success: function(html){
				     var urlindex='".Yii::app()->createUrl('admin/Standardtask/griddata')."';
					var url=urlindex +'/cno/'+treeId;
					gridReload(url);
				  }
				});		
			}
				     		
		$('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/standardtask/deletetask/id')."/'+$(this).attr('rel'),
				  success: function(data){
				     $('#info').html(data.msg);
				    var urlindex='".Yii::app()->createUrl('admin/Standardtask/griddata')."';
				    var url=urlindex +'/cno/'+ jQuery('#treeid').val();
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });
	$('.UFSGrid-row-agree').live('click',function(){ 
        if(confirm('您确定要同意吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Standardtask/agree/id')."/'+$(this).attr('rel'),
				  success: function(data){	
				    $('#info').html(data.msg);
				    var urlindex='".Yii::app()->createUrl('admin/Standardtask/griddata')."';
				    var url=urlindex +'/cno/'+ jQuery('#treeid').val();
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });
	var keyid='';						    		
	$('.UFSGrid-row-refuse').live('click',function(){ 
        if(confirm('您确定要拒绝吗？')){
		     $('#apply').dialog('open');	    		
		     keyid=$(this).attr('rel');				    					
    	}
  		return false;
     });
	$('#apply').dialog({
    	    autoOpen: false,
    	    height: 250,
    	    width:300,
    	    modal: true,
    	    buttons: {
    	        Ok: function() {
		  		 		  $.ajax({
						  url:'".Yii::app()->createUrl('admin/Standardtask/refuse')."',
						  cache: false,
						  type:'POST',
						  data: 'id='+keyid+'&memo='+$('#memo').val(),
						  success: function(data){
				  		  var urlindex='".Yii::app()->createUrl('knowledge/knowledge/gridData')."';
						    var urlindex='".Yii::app()->createUrl('admin/Standardtask/griddata')."';
						    var url=urlindex +'/cno/'+ jQuery('#treeid').val();
							gridReload(urlindex);
						 	 $('#memo').val('');
							 $('#apply').dialog('close');
						  }
						});	
    	        }
    	    }
    	});	
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Standardtasks') ?></h2>
<?php echo CHtml::hiddenField('treeid','');?>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Index')),
											
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<?php echo CHtml::link(Yii::t('label','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form advanced_search">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 <ul id="treeDemo" class="tree el-finder-tree"></ul>
          <?php 
       $this->widget('application.extensions.ztree.zTree',array(
	  'treeNodeNameKey'=>'name',
	  'treeNodeKey'=>'id',
	  'treeNodeParentKey'=>'pId',
      'htmlOptions'=>array('id'=>'fe'),
	  'options'=>array(
		'showLine'=>true,
				'keepParent'=>false,//锁定父节点
				'keepLeaf'=>false,//锁定叶子节点
				'editable'=> false,//编辑节点
				'expandSpeed'=>'slow',//设置为慢速显示动画效果
				'autoCancelSelected'=>false,//禁止配合 Ctrl 键进行取消节点选择的操作
				'dblClickExpand'=>false,//取消默认双击展开父节点的功能
				'showIcon'=>true,//设置 zTree 不显示图标
				'showLine'=>true,//设置 zTree 不显示节点之间的连线
				'showTitle'=>true,//设置 zTree 不显示提示信息
		'callback'=>array(
			'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.id,treeNode.pId,treeNode.name,treeNode.tId); }",
       ),
	),
	'data'=>$dataNode
));

?>
<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
        		array('title'=>CHtml::encode($sort->resolveLabel('fTheme'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fAttachName'))),

		
		array('title'=>CHtml::encode($sort->resolveLabel('fTaskType'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSubmitUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSubmitDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fConfirmUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fConfirmDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
        		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
        		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
        ),
        'columnsModel'=>array(
array('name'=>'fTheme'),
		array('name'=>'fCatalogueNo'),
		array('name'=>'fAttachName'),
		array('name'=>'fTaskType'),
		array('name'=>'fSubmitUser'),
		array('name'=>'fSubmitDate'),
		array('name'=>'fConfirmUser'),
		array('name'=>'fConfirmDate'),
		array('name'=>'fStatus'),
		array('name'=>'fCreateUser'),
		array('name'=>'fCreateDate'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
		array('title'=>$sort->link('fTheme')),
		array('title'=>$sort->link('fCatalogueNo')),

		array('title'=>$sort->link('fAttachName')),

		

		array('title'=>$sort->link('fTaskType')),
		array('title'=>$sort->link('fSubmitUser')),
		array('title'=>$sort->link('fSubmitDate')),
		array('title'=>$sort->link('fConfirmUser')),
		array('title'=>$sort->link('fConfirmDate')),
		array('title'=>$sort->link('fStatus')),
array('title'=>$sort->link('fCreateUser')),
array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
        ),
       'sortname'=>'fTaskNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/standardtask/gridData',$_GET),
        'modulename'=>'Standardtask',
    )); ?>
</div>
<div id="apply" title="拒绝理由" style="display:none;width:100%;height:100%;">
        <label for="username">备注</label>
        <div class="inputs">
          <?php echo CHtml::textArea('memo')?>
        </div>
 </div>