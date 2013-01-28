
<?php
$this->breadcrumbs=array(
	'Resultdocuments',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
<h2><?php echo Yii::t('label','Documents')?></h2>
<input type="hidden" value="<?php echo $itemno?>" id="hiddenpkey" name="hiddenpkey" />
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
 <ul id="treeDemo" class="tree el-finder-tree"></ul>
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
			//'editable'=> true,//编辑节点
			//'checkable'=> true,//选择
			'callback'=>array(
				'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.id,treeNode.pId,treeNode.name,treeNode.tId); }",
	       	),
		  ),
			'data'=>$dataNode
		));

		Yii::app()->getClientScript()->registerScript('itemcatalogue-update',"
			function apply(rid){
				  jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/resultdocument/apply')."/cno/'+treeId+'/id/'+jQuery('#ino').val(),
				  cache: false,
				  success: function(html){
				  	 var urlindex='".Yii::app()->createUrl('Item/resultdocument/docGridData')."';
					 var url=urlindex +'/cno/'+treeId +'/id/'+jQuery('#ino').val();
					 gridReload(url);
				  }
				});			 		
			}
			function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
				var noteid=noteid+'_span';
				jQuery('#ztree-checked-note').val(noteid);
				jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/resultdocument/docGridData')."/cno/'+treeId+'/id/'+jQuery('#ino').val(),
				  cache: false,
				  success: function(html){
				  	 var urlindex='".Yii::app()->createUrl('Item/resultdocument/docGridData')."';
					 var url=urlindex +'/cno/'+treeId +'/id/'+jQuery('#ino').val();
					 gridReload(url);
				  }
				});		
			}
								
		var userno='';
		var hrefno='';
		var itemno='';

    	function inputnoticemsg(){
			$.ajax({
				  url:'".Yii::app()->createUrl('Item/resultdocument/applyknowledge')."/uid/'+userno+'/ino/'+itemno+'/hid/'+hrefno+'/memo/'+$('#memo').val(),
				  cache: false,
				  success: function(data){
				  		 alert(data);
				  		 var urlindex='".Yii::app()->createUrl('Item/resultdocument/docGridData')."';
					     var url=urlindex +'/id/'+itemno;
					     gridReload(url);
					 	 $('#memo').val('');
						 $('#applyknowledge').dialog('close');
				  }
				});		
		   }

		    	$('#applyknowledge').dialog({
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
				    $('#applyknowledge').dialog('open');
				    return false;
				}
		");

		?>
<?php
			     $this->widget('application.modules.UFSBase.utils.WGrid',array(
			        'columns'=>array(
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
			        ),
			        'columnsModel'=>array(
						array('name'=>'fCatalogueNo','frozen'=>true),
						array('name'=>'fAttachmentNo'),
						array('name'=>'fResultSubmitUser'),
						array('name'=>'fResultSubmitDate'),
						array('name'=>'fResultConfirmUser'),
						array('name'=>'fResultConfirmDate'),
						array('name'=>'fApplyArchiveUser'),
						array('name'=>'fApplyArchiveDate'),
						array('name'=>'fArchiveUser'),
						array('name'=>'fArchiveDate'),
						array('name'=>'fDocumentStatus')
			        ),
			        'pages'=>$pages,
			        'rowNum'=>Yii::app()->params['pagesize'],
			        'rownumbers'=>'true',
			        'rows'=>$gridRows,
			        'sColumns'=>array(
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
			        ),
			        'sortname'=>'fTaskNo',
			        'sortorder'=>'asc',
			        'url'=>Yii::app()->createUrl('Item/resultdocument/docGridData',$_GET),
			    )); ?>
</div>
<div id="applyknowledge" title="入库申请" style="display:none;width:100%;height:100%;">
        <label for="username">备注</label>
        <div class="inputs">
          <?php echo CHtml::textArea('memo')?>
        </div>
 </div>
