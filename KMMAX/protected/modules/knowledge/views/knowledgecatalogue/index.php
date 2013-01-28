<?php
$this->breadcrumbs=array(
	'Knowledgecatalogues',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
   $('.UFSGrid-row-update').live('click',function(){ 
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('knowledge/Knowledgecatalogue/update')."/id/'+$('#Knowledgecatalogue_fCatalogueNo').val(),
		           type:'POST',
		           data:'name='+jQuery('#Knowledgecatalogue_fCatalogueName').val()+'&statu='+jQuery('#Knowledgecatalogue_fStatus').val()+'&down='+jQuery('#Knowledgecatalogue_fIsDownLoad').val(),
				   success: function(data){
		           	var node=zTree_Treeobject.getNodeByTId(jQuery('#tid').val());
			        node.name= jQuery('#Knowledgecatalogue_fCatalogueName').val();	
				    zTree_Treeobject.updateNode(node);		
					jQuery('#Knowledgecatalogue_fCatalogueName').val(data.fCatalogueName);
		          	jQuery('#Knowledgecatalogue_fUpdateUser').val(data.fUpdateUser);
		          	jQuery('#Knowledgecatalogue_fUpdateDate').val(data.fUpdateDate);
                    jQuery('#Knowledgecatalogue_fStatus').val(data.fStatus);
		           	jQuery('#Knowledgecatalogue_fIsDownLoad').val(data.fIsDownLoad);
		           	$('#info').html(data.msg);
				  }
			 });		
  		return false;
     });
 $('.UFSGrid-row-add').live('click',function(){ 
		    var fathername=jQuery('#Knowledgecatalogue_fCatalogueName').val();
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('knowledge/Knowledgecatalogue/insert')."',
		           type:'POST',
		           data:'no='+jQuery('#Knowledgecatalogue_fCatalogueNo').val()+'&name='+jQuery('#Knowledgecatalogue_fCatalogueName').val()+'&statu='+jQuery('#Knowledgecatalogue_fStatus').val()+'&down='+jQuery('#Knowledgecatalogue_fIsDownLoad').val(),
				   success: function(data){
		           	 var newNode = {name:data.fCatalogueName,id:data.fCatalogueNo,pid:data.fFatherNo}; 
          		     zTree_Treeobject.addNodes(zTree_Treeobject.getNodeByTId(jQuery('#tid').val()), newNode);
		           	jQuery('#Knowledgecatalogue_fFatherCatalogueNo').val(fathername);
					jQuery('#Knowledgecatalogue_fCatalogueName').val(data.fCatalogueName);
		           	jQuery('#Knowledgecatalogue_fCreateUser').val(data.fCreateUser);
		          	jQuery('#Knowledgecatalogue_fCreateDate').val(data.fCreateDate);
		          	jQuery('#Knowledgecatalogue_fUpdateUser').val(data.fUpdateUser);
		          	jQuery('#Knowledgecatalogue_fUpdateDate').val(data.fUpdateDate);
		           	jQuery('#Knowledgecatalogue_fStatus').val(data.fStatus);
		           	jQuery('#Knowledgecatalogue_fIsDownLoad').val(data.fIsDownLoad);
		           	$('#info').html(data.msg);
				  }
			 });		
  		return false;
     });
$('.UFSGrid-row-delete').live('click',function(){ 
     if(confirm('您确定要删除吗?')){		           		
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('knowledge/Knowledgecatalogue/deletecatalogue')."/id/'+$('#Knowledgecatalogue_fCatalogueNo').val(),
		           type:'POST',
				   success: function(data){
		           	 var node=zTree_Treeobject.getNodeByTId(jQuery('#tid').val());
				     zTree_Treeobject.removeNode(node);
		           	jQuery('#Knowledgecatalogue_fFatherCatalogueNo').val('');
					jQuery('#Knowledgecatalogue_fCatalogueName').val('');
		           	jQuery('#Knowledgecatalogue_fCreateUser').val('');
		          	jQuery('#Knowledgecatalogue_fCreateDate').val('');
		          	jQuery('#Knowledgecatalogue_fUpdateUser').val('');
		          	jQuery('#Knowledgecatalogue_fUpdateDate').val('');
		           	 $('#info').html(data.msg);
				  }
			 });	
		 }	
  		return false;
     });			    		
      function zTreeClickNode(tid,treeId,treeParentId, treeName) {
		         jQuery('#tid').val(tid); 
		         jQuery('#treeid').val(treeId); 
				jQuery.ajax({				
				  cache: false,
		          url:'".Yii::app()->createUrl('knowledge/Knowledgecatalogue/ajaxview/id')."/'+treeId,
				  success: function(data){
		            jQuery('#Knowledgecatalogue_fCatalogueNo').val(data.fCatalogueNo);
					jQuery('#Knowledgecatalogue_fCatalogueName').val(data.fCatalogueName);
					jQuery('#Knowledgecatalogue_fFatherCatalogueNo').val(data.fFatherCatalogueName);
		          	jQuery('#Knowledgecatalogue_fCreateUser').val(data.fCreateUser);
		          	jQuery('#Knowledgecatalogue_fCreateDate').val(data.fCreateDate);
		          	jQuery('#Knowledgecatalogue_fUpdateUser').val(data.fUpdateUser);
		          	jQuery('#Knowledgecatalogue_fUpdateDate').val(data.fUpdateDate);
                   	jQuery('#Knowledgecatalogue_fStatus').val(data.fStatus);
		          		jQuery('#Knowledgecatalogue_fIsDownLoad').val(data.fIsDownLoad);
				    zTree.expandNode(treeId);
				  }
				});		
			}
");
?>
<div class="content-head underline">
<h2><?php echo Yii::t('label','Knowledgecatalogues')?></h2>
<input type="hidden" id="tid" name="hiddenpkey" />
<input type="hidden" id="treeid" name="hiddenpkey" />
</div>
<div class="content">
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
		//'checkable'=> true,//选择
		'callback'=>array(
			'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.tId,treeNode.id,treeNode.pId,treeNode.name,treeNode.tId); }",
       ),
	),
	'data'=>$dataNode
));

?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'knowledgecatalogue-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
     <?php echo $form->hiddenField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCatalogueName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fCatalogueName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFatherCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFatherCatalogueNo',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fFatherCatalogueNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->dropdownList($model,'fStatus',$fStatus,array()); ?>
      	</div>
      </div>
     <div class="input-group">
          <?php echo $form->labelEx($model,'fIsDownLoad'); ?>
     
          <div class="inputs">
           <?php echo $form->dropdownList($model,'fIsDownLoad',$fIsDownLoad,array()); ?>
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Update'), array('class' =>'btn-icon submit no-margin UFSGrid-row-update' , )); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Create'), array('class' =>'btn-icon submit no-margin UFSGrid-row-add' , )); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Delete'), array('class' =>'btn-icon submit no-margin UFSGrid-row-delete' , )); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
