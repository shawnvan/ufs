<?php
$this->breadcrumbs=array(
	'Resultdocuments',
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
$('.UFSGrid-row-applyknowledge').live('click',function(){ 
		var url =	'".Yii::app()->createUrl('knowledge/knowledge/applyknowledge')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
	    $(this).colorbox({iframe:true, width:'80%', height:'100%',onClosed: function (message) {}});
  		return false;
     });	
 $('.UFSGrid-row-confirm').live('click',function(){ 
		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('noitem/resultdocument/confirm/id')."/'+$(this).attr('rel'),
				  type:'POST',
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('noitem/resultdocument/gridData')."';
				    var url=urlindex +'/id/'+jQuery('#hiddenpkey').val() +'/cno/'+jQuery('#treeid').val();
					gridReload(url);
				  }
			 });		
  		return false;
  });				
$('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('noitem/resultdocument/delete/id')."/'+$(this).attr('rel'),
				  type:'POST',
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('noitem/resultdocument/gridData')."';
				    var url=urlindex +'/cno/'+jQuery('#treeId').val();
					gridReload(url);
				  }
			 });		
    	}
  		return false;
     });					
");
?>

<div class="content-head underline">
<h2><?php echo Yii::t('label','NoResultdocuments')?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Admin')),					
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
         <?php 
	       $this->widget('application.extensions.ztree.zTree',array(
		  'treeNodeNameKey'=>'name',
		  'treeNodeKey'=>'id',
		  'treeNodeParentKey'=>'pId',
	      'htmlOptions'=>array('id'=>'fe'),
		  'options'=>array(
			'expandSpeed'=>"",
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

		Yii::app()->getClientScript()->registerScript('itemcatalogue-update',"
			function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
				var noteid=noteid+'_span';
				jQuery('#ztree-checked-note').val(noteid);
				jQuery.ajax({				
				  cache: false,
				  success: function(html){
				  	 var urlindex='".Yii::app()->createUrl('noitem/resultdocument/gridData')."';
					 var url=urlindex +'/cno/'+treeId;
					 gridReload(url);
				  }
				});		
			}
								
		var userno='';
		var hrefno='';
		var itemno='';

    	function inputnoticemsg(){
			$.ajax({
				  url:'".Yii::app()->createUrl('noitem/resultdocument/applyres')."/uid/'+userno+'/ino/'+itemno+'/hid/'+hrefno+'/memo/'+$('#memo').val(),
				  cache: false,
				  success: function(data){
				  		 alert(data);
				  		 var urlindex='".Yii::app()->createUrl('noitem/resultdocument/gridData')."';
					     var url=urlindex +'/id/'+jQuery('#hiddenpkey').val();
					     gridReload(url);
					 	 $('#memo').val('');
						 $('#applydocument').dialog('close');
				  }
				});		
		   }

		    	$('#applydocument').dialog({
		    	    autoOpen: false,
		    	    height: 250,
		    	    width:300,
		    	    modal: true,
		    	    buttons: {
		    	        Ok: function() {
			    	        inputnoticemsg();
		    	        }
		    	    }
		    	});
				  		
				 function setDefault(ino,hno,uno){
					itemno=ino;
					userno=uno;
				    hrefno=hno;
				    $('#applydocument').dialog('open');
				    return false;
				}
		");

		?>
<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		 array('title'=>CHtml::encode($sort->resolveLabel('fTaskNo'))),
			  			array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fAttachmentNo'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultSubmitUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultSubmitDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultConfirmUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultConfirmDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fApplyArchiveUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fApplyArchiveDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fArchiveUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fArchiveDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fDocumentStatus'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
        ),
        'columnsModel'=>array(
 					array('name'=>'fTaskNo','frozen'=>true),
						array('name'=>'fCatalogueNo'),
						array('name'=>'fAttachmentNo'),
						array('name'=>'fResultSubmitUser'),
						array('name'=>'fResultSubmitDate'),
						array('name'=>'fResultConfirmUser'),
						array('name'=>'fResultConfirmDate'),
						array('name'=>'fApplyArchiveUser'),
						array('name'=>'fApplyArchiveDate'),
						array('name'=>'fArchiveUser'),
						array('name'=>'fArchiveDate'),
						array('name'=>'fDocumentStatus'),
						array('name'=>'fCreateUser'),
						array('name'=>'fCreateDate'),
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
          array('title'=>$sort->link('fTaskNo')),
		array('title'=>$sort->link('fCatalogueNo')),
		array('title'=>$sort->link('fAttachmentNo')),
		array('title'=>$sort->link('fResultSubmitUser')),
		array('title'=>$sort->link('fResultSubmitDate')),
		array('title'=>$sort->link('fResultConfirmUser')),
		array('title'=>$sort->link('fResultConfirmDate')),
		array('title'=>$sort->link('fApplyArchiveUser')),
		array('title'=>$sort->link('fApplyArchiveDate')),
		array('title'=>$sort->link('fArchiveUser')),
		array('title'=>$sort->link('fArchiveDate')),
		array('title'=>$sort->link('fDocumentStatus')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
        ),
       'sortname'=>'fResultNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('noitem/resultdocument/gridData',$_GET),
        'modulename'=>'Resultdocument',
    )); ?>
</div>