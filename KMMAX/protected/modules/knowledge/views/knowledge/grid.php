<div class="page">
<div class="form">

<div class="widgetbox">
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
				  url:'".Yii::app()->createUrl('knowledge/knowledge/grid')."/cno/'+treeId,
				  cache: false,
				  success: function(html){
				     var urlindex='".Yii::app()->createUrl('knowledge/knowledge/griddata')."';
					var url=urlindex +'/cno/'+treeId;
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
				        	array('title'=>CHtml::encode($sort->resolveLabel('fKnowledgeNo'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fItemNo'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fTaskNo'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fResultNo'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fKnowledgeName'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fContent'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fAttachmentName'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fSubmitDate'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fSubmitUser'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fConfirmUser'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fConfirmDate'))),
				        ),
				        'columnsModel'=>array(
							array('name'=>'fKnowledgeNo','frozen'=>true),
							array('name'=>'fItemNo'),
							array('name'=>'fTaskNo'),
							array('name'=>'fResultNo'),
							array('name'=>'fCatalogueNo'),
							array('name'=>'fKnowledgeName'),
							array('name'=>'fContent'),
							array('name'=>'fAttachmentName'),
							array('name'=>'fSubmitDate'),
							array('name'=>'fSubmitUser'),
							array('name'=>'fConfirmUser'),
							array('name'=>'fConfirmDate'),
				        ),
				        'pages'=>$pages,
				        'rowNum'=>'5',
				        'rownumbers'=>'true',
				        'rows'=>$gridRows,
				        'sColumns'=>array(
							array('title'=>$sort->link('fKnowledgeNo')),
							array('title'=>$sort->link('fItemNo')),
							array('title'=>$sort->link('fTaskNo')),
							array('title'=>$sort->link('fResultNo')),
							array('title'=>$sort->link('fCatalogueNo')),
							array('title'=>$sort->link('fKnowledgeName')),
							array('title'=>$sort->link('fAttachmentName')),
							array('title'=>$sort->link('fSubmitDate')),
							array('title'=>$sort->link('fSubmitUser')),
							array('title'=>$sort->link('fConfirmUser')),
							array('title'=>$sort->link('fConfirmDate')),
				        ),
				        'sortname'=>'fTaskNo',
				        'sortorder'=>'asc',
				        'url'=>Yii::app()->createUrl('knowledge/knowledge/gridData',$_GET),
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
