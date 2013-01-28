<div class="page">

<div class="form">

<input type='hidden' id='ino' value="<?php echo $id ?> ">
<div class="widgetbox">


  <h3 class=""><span>尽职调查表目录结构</span></h3>
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

?>

<?php 
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
				  url:'".Yii::app()->createUrl('Item/itemcatalogue/update')."/cno/'+treeId+'/ino/'+jQuery('#ino').val(),
				  cache: false,
				  success: function(data){
				  	jQuery('#fCatalogueName').val(data.fCatalogueName);
					jQuery('#fWarnStart').val(data.fWarnStart);
					jQuery('#fWarnEnd').val(data.fWarnEnd);
					jQuery('#fIsActive').val(data.fIsActive);
					jQuery('#fWaitFinishingNum').val(data.fWaitFinishingNum);
				    jQuery('#fFinishedNum').val(data.fFinishedNum);
					jQuery('#fTaskNum').val(data.fTaskNum);
					jQuery('#fResultNum').val(data.fResultNum);
					jQuery('#fDocumentNum').val(data.fDocumentNum);
					jQuery('#fKnowledgeNum').val(data.fKnowledgeNum);
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
				<dl>
					<dd>节点名称</dd>
					<dt><?php echo CHtml::textField('fCatalogueName'); ?></dt>					
				</dl>
				<dl>
					<dd>提醒开始时间</dd>
					<dt><?php echo CHtml::textField('fWarnStart'); ?></dt>					
				</dl>
				<dl>
					<dd>提醒结束时间</dd>
					<dt><?php echo CHtml::textField('fWarnEnd'); ?></dt>					
				</dl>
				<dl>
					<dd>是否启用</dd>
					<dt><?php echo CHtml::textField('fIsActive'); ?></dt>					
				</dl>
				<dl>
					<dd>待完成任务</dd>
					<dt><?php echo CHtml::textField('fWaitFinishingNum'); ?></dt>					
				</dl>
				<dl>
					<dd>已经完成任务</dd>
					<dt><?php echo CHtml::textField('fFinishedNum'); ?></dt>					
				</dl>
				<dl>
					<dd>任务数</dd>
					<dt><?php echo CHtml::textField('fTaskNum'); ?></dt>					
				</dl>
				<dl>
					<dd>成果数</dd>
					<dt><?php echo CHtml::textField('fResultNum'); ?></dt>					
				</dl>
				<dl>
					<dd>文档数</dd>
					<dt><?php echo CHtml::textField('fDocumentNum'); ?></dt>					
				</dl>
				<dl>
					<dd>知识数</dd>
					<dt><?php echo CHtml::textField('fKnowledgeNum'); ?></dt>					
				</dl>
				<div class="tree-submit">
					<?php echo CHtml::ajaxButton('编辑', $this->createUrl('itemcatalogue/updatetree'),
              array('type'=>'POST', 'success'=>'formSaved'), array('id'=>'itemcatalogue-updatetree','class'=>'submit')); ?>
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

