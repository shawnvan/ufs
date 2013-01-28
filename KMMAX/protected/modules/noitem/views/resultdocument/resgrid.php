<?php
    Yii::app()->clientScript->registerScript('search', "
    	var userno='';
		var hrefno='';
		var itemno='';

    	function inputnoticemsg(){
			$.ajax({
				  url:'".Yii::app()->createUrl('Item/resultdocument/applyres')."/uid/'+userno+'/ino/'+itemno+'/hid/'+hrefno+'/memo/'+$('#memo').val(),
				  cache: false,
				  success: function(data){
				  		 alert(data);
				  		 var urlindex='".Yii::app()->createUrl('Item/resultdocument/resGridData')."';
					     var url=urlindex +'/ino/'+jQuery('#ino').val();
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

<div class="page">
<div class="form">

<input type='hidden' id='ino' value="<?php echo $itemno ?> ">
<div class="widgetbox">
  <h3 class=""><span>尽职调查表目录结构-----项目成果库
  </span></h3>
    <div id="fileManager" class="el-finder">
      <div class="el-finder-workzone">
        <div class="el-finder-nav ui-resizable ui-resizable-autohide">
          <ul id="treeDemo" class="tree el-finder-tree"></ul>
          <?php 
          echo CHtml::textField('textField');
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
			function updateEditForm(target_id) {
				var  id=$.fn.yiiGridView.getSelection(target_id);		
				jQuery('#fTypeNo').val(id);		
				jQuery('#save_btn').attr('disabled', false);
				jQuery('#add_btn').attr('disabled', true);
				jQuery.getJSON('".Yii::app()->createUrl('admin/Dropdowntype/inputData')."/fTypeNo/'+id,
					function(data) {
						jQuery('#fTypeName').val(data.fTypeName);
						jQuery('#fStatus').val(data.fStatus);
					});
			}

			function formSaved(data, textStatus, XMLHttpRequest) {
				jQuery('#fCatalogueName').attr('disabled', false);	
				if(textStatus){//如果插入数据并返回结果成功则修改节点
					jQuery('#fCatalogueName').val(data.fCatalogueName);					
					var changeNotename=jQuery('#ztree-checked-note').val();
				    jQuery('#'+changeNotename).html(data.fCatalogueName);//重新给节点赋值					
				}
				
			}

			function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
				var noteid=noteid+'_span';
				jQuery('#ztree-checked-note').val(noteid);
				jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/resultdocument/resGridData')."/cno/'+treeId+'/id/'+jQuery('#ino').val(),
				  cache: false,
				  success: function(html){
				  	 var urlindex='".Yii::app()->createUrl('Item/resultdocument/resGridData')."';
					 var url=urlindex +'/cno/'+treeId +'/id/'+jQuery('#ino').val();
					 gridReload(url);
				  }
				});		
			}
		");

		?>

        </div>
        <?php echo CHtml::hiddenField('ztree-checked-note','');?>
        <?php echo CHtml::beginForm();?>
       	     
       	                
	        <div class="el-finder-cwd ui-selectable" unselectable="on">
	      	<div class="tree-edit-form">
			 <div class="datagrid-box">
			     <?php
			     $this->widget('application.modules.UFSBase.utils.WGrid',array(
			        'columns'=>array(
			            array('title'=>CHtml::encode($sort->resolveLabel('fTaskNo'))),
			  			array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fAttachmentNo'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultSubmitUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultSubmitDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultConfirmUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultConfirmDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fCreateUesr'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
			        ),
			        'columnsModel'=>array(
			            array('name'=>'fTaskNo','frozen'=>true),
						array('name'=>'fCatalogueNo'),
						array('name'=>'fAttachmentNo'),
						array('name'=>'fResultSubmitUser'),
						array('name'=>'fResultSubmitDate'),
						array('name'=>'fResultConfirmUser'),
						array('name'=>'fResultConfirmDate'),
						array('name'=>'fCreateUesr'),
						array('name'=>'fCreateDate'),
						array('name'=>'fStatus')
			        ),
			        'pages'=>$pages,
			        'rowNum'=>'5',
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
						array('title'=>$sort->link('fCreateUesr')),
						array('title'=>$sort->link('fCreateDate')),
						array('title'=>$sort->link('fStatus')),
			        ),
			        'sortname'=>'fTaskNo',
			        'sortorder'=>'asc',
			        'url'=>Yii::app()->createUrl('Item/resultdocument/resGridData',$_GET),
			    )); ?>
			    </div>
			</div>
	       </div>
        
        
        <?php echo CHtml::endForm();?>
        <div class="el-finder-spinner" style="display: none; "></div>
        <div style="clear:both"></div>
      </div>
    </div>
</div>

</div><!-- form -->
</div>
<script>


</script>
 <div id="applydocument" title="入库申请" style="display:none;width:100%;height:100%;">
        <label for="username">备注</label>
        <div class="inputs">
          <?php echo CHtml::textArea('memo')?>
        </div>
 </div>
