<?php
$this->breadcrumbs=array(
	'Knowledgecatalogues',
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
$('.SelectUser').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('Item/itemuser/popgrid')."/id/'+jQuery('#keyid').val();
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'100%',onClosed: function (message) {}});
    return false;
 })
			
jQuery('.datepicker').datepicker();		
	jQuery('#AddCatalogue').click(function(){
		   if(jQuery('#treeid').val()=='') {alert('请选择节点');return false;}
			jQuery('#fFatherCatalogueName').val(jQuery('#fCatalogueName').val());
			jQuery('#add-template-form').removeAttr('style');
		    return false;
         });	
  jQuery('#Cancel').click(function(){
		   jQuery('#fCatalogueName').val('');
		   jQuery('#fWarnRate').val('');
		   jQuery('#fIsActive').val('');
      		jQuery('#add-template-form').attr('style', 'display:none');
		    return false;
 });    
 $('.UFSGrid-row-insert').live('click',function(){ 
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('Item/itemcatalogue/insert')."/id/'+$('#Itemcatalogue_fCatalogueNo').val(),
		           type:'POST',
		           data:'cno='+jQuery('#Itemcatalogue_fCatalogueNo').val()+'&id='+jQuery('#keyid').val()+'&name='+jQuery('#fNewCatalogueName').val()+'&warn='+jQuery('#fWarnRate').val()+'&start='+jQuery('#fWarnStart').val()+'&end='+jQuery('#fWarnEnd').val()+'&active='+jQuery('#fIsActive').val(),
				   success: function(data){
		           	 var newNode = {name:data.fCatalogueName,id:data.fCatalogueNo,pid:data.fFatherNo}; 
          		     zTree_Treeobject.addNodes(zTree_Treeobject.getNodeByTId(jQuery('#tid').val()), newNode);
		           	 jQuery('#Itemcatalogue_fUpdateUser').val(data.fUpdateUser);
		          	 jQuery('#Itemcatalogue_fUpdateDate').val(data.fUpdateDate);
		           	 $('#info').html(data.msg);
		           	 jQuery('#add-template-form').attr('style', 'display:none');
				  }
			 });		
  		return false;
     });			
   $('.UFSGrid-row-update').live('click',function(){ 
			if(jQuery('Itemcatalogue_fCatalogueNo').val()=='') return;
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('Item/itemcatalogue/updatetree')."/id/'+$('#Itemcatalogue_fCatalogueNo').val(),
		           type:'POST',
		           data:'cno='+jQuery('#Itemcatalogue_fCatalogueNo').val()+'&id='+jQuery('#keyid').val()+'&warn='+jQuery('#Itemcatalogue_fWarnRate').val()+'&start='+jQuery('#Itemcatalogue_fWarnStart').val()+'&end='+jQuery('#Itemcatalogue_fWarnEnd').val()+'&active='+jQuery('#Itemcatalogue_fIsActive').val()+'&user='+jQuery('#Task_fExecutor').val(),
				   success: function(data){
		            jQuery('#Itemcatalogue_fUpdateUser').val(data.fUpdateUser);
		          	jQuery('#Itemcatalogue_fUpdateDate').val(data.fUpdateDate);
		           	 $('#info').html(data.msg);
				  }
			 });		
  		return false;
     });
	 $('.UFSGrid-row-update-template').live('click',function(){ 
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('Item/itemcatalogue/updatetemplate')."/id/'+$('#keyid').val(),
		           type:'POST',
				   success: function(data){
		            return true;
				  }
			 });		
		   return true;
     }); 		
      function zTreeClickNode(tid,treeId,treeParentId, treeName) {
		         jQuery('#tid').val(tid); 
		         jQuery('#treeid').val(treeId); 
				jQuery.ajax({				
				  cache: false,
		          type:'POST',
		          data:'id='+$('#keyid').val()+'&tid='+treeId,
		          url:'".Yii::app()->createUrl('Item/itemcatalogue/ajaxview')."',
				  success: function(data){
		            jQuery('#fCatalogueName').val(treeName);
		          		jQuery('#Itemcatalogue_fCatalogueNo').val(treeId);
		          		jQuery('#Itemcatalogue_fFatherCatalogueNo').val(data.fFatherCatalogueName);
		          		jQuery('#Itemcatalogue_fWaitFinishingNum').val(data.fWaitFinishingNum);
		          		jQuery('#Itemcatalogue_fFinishedNum').val(data.fFinishedNum);
		          		jQuery('#Itemcatalogue_fResultNum').val(data.fResultNum);
		          		jQuery('#Itemcatalogue_fDocumentNum').val(data.fDocumentNum);
		          		jQuery('#Itemcatalogue_fTaskNum').val(data.fTaskNum);
		          		jQuery('#Itemcatalogue_fKnowledgeNum').val(data.fKnowledgeNum);
		          		jQuery('#Itemcatalogue_fWarnStart').val(data.fWarnStart);
		          		jQuery('#Itemcatalogue_fWarnEnd').val(data.fWarnEnd);
		          		jQuery('#Task_fExecutor').val(data.fExecutorUser);
		          		jQuery('#Itemcatalogue_fCreateUser').val(data.fCreateUser);
		          		jQuery('#Itemcatalogue_fCreateDate').val(data.fCreateDate);
		          		jQuery('#Itemcatalogue_fUpdateUser').val(data.fUpdateUser);
		          		jQuery('#Itemcatalogue_fUpdateDate').val(data.fUpdateDate);
		          		jQuery('#Itemcatalogue_fIsActive').val(data.fIsActive);
		          	    jQuery('#Itemcatalogue_fWarnRate').val(data.fWarnRate);
				  }
				});		
			}
");
?>
<div class="content-head underline">
<h2><?php echo Yii::t('label','Itemcatalogues')?></h2>
<input type="hidden" id="keyid" value='<?php echo $id?>' name="hiddenpkey" />
<input type="hidden" id="tid" name="hiddenpkey" />
<input type="hidden" id="treeid" name="hiddenpkey" />
</div>
<div class="content">
<?php echo CHtml::link(Yii::t('label','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
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
		//'checkable'=> true,//选择
		'callback'=>array(
			'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.tId,treeNode.id,treeNode.pId,treeNode.name,treeNode.tId); }",
       ),
	),
	'data'=>$dataNode
));

?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'itemcatalogue-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
     <?php echo $form->hiddenField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>

     <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueName'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textField('fCatalogueName','',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
      	</div>
      </div>
      
      <div class="input-group">
          <?php echo $form->labelEx($model,'fExecutorUser'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textField('Task_fExecutor','',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
          <span class="btn-icon-horizontal btn-icon-input btn-icon-user SelectUser" id="open"></span>
          <?php echo $form->error($model,'fExecutorUser'); ?>
        
      	</div>
      </div>
      
    <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnRate'); ?>
     
          <div class="inputs">
          <?php echo $form->dropdownList($model,'fWarnRate',$fWarnRate); ?>
          <?php echo $form->error($model,'fWarnRate'); ?>
        
      	</div>
      </div>
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnStart'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWarnStart',array('class'=>'datepicker')); ?>
   
          <?php echo $form->error($model,'fWarnStart'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnEnd'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWarnEnd',array('class'=>'datepicker')); ?>
   
          <?php echo $form->error($model,'fWarnEnd'); ?>
        
      	</div>
      </div>

      <div class="input-group">
          <?php echo $form->labelEx($model,'fIsActive'); ?>
     
          <div class="inputs">
            <?php echo $form->dropdownList($model,'fIsActive',$fIsActive); ?>
          <?php echo $form->error($model,'fIsActive'); ?>
        
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
          <?php echo $form->labelEx($model,'fWaitFinishingNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWaitFinishingNum',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fWaitFinishingNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFinishedNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFinishedNum',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fFinishedNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResultNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fResultNum',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fResultNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDocumentNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fDocumentNum',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fDocumentNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTaskNum',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fTaskNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fKnowledgeNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fKnowledgeNum',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fKnowledgeNum'); ?>
      	</div>
      </div>

       <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('disabled'=>'disabled')); ?>
   
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
          <?php echo $form->textField($model,'fUpdateUser',array('disabled'=>'disabled')); ?>
   
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
	    <?php echo CHtml::submitButton(Yii::t('label','UpdateTemplate'), array('class' =>'btn-icon submit no-margin UFSGrid-row-update-template' , )); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Update'), array('class' =>'btn-icon submit no-margin UFSGrid-row-update' , )); ?>
		<?php echo CHtml::submitButton(Yii::t('label','AddCatalogue'), array('id'=>'AddCatalogue','class' =>'btn-icon submit no-margin')); ?>
	</div>
<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'add-template-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form','style'=>'display:none'),
)); ?>
	

     <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueName'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textField('fNewCatalogueName','',array('size'=>50,'maxlength'=>50)); ?>

      	</div>
      </div>

    <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnRate'); ?>
     
          <div class="inputs">
           <?php echo CHtml::dropDownList('fWarnRate', '', $fWarnRate); ?>

        
      	</div>
      </div>
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnStart'); ?>
     
          <div class="inputs">

              <?php echo CHtml::textField('fWarnStart','',array('class'=>'datepicker')); ?>

      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnEnd'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textField('fWarnEnd','',array('class'=>'datepicker')); ?>
          <?php echo $form->error($model,'fWarnEnd'); ?>
        
      	</div>
      </div>

      <div class="input-group">
          <?php echo $form->labelEx($model,'fIsActive'); ?>
     
          <div class="inputs">
            <?php echo CHtml::dropDownList('fIsActive', '', $fIsActive); ?>
        
      	</div>
      </div>
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFatherCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textField('fFatherCatalogueName','',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
      	</div>
      </div>

      <div class="form-submit">
	    <?php echo CHtml::submitButton(Yii::t('label','Create'), array('id'=>'SaveNode','class' =>'btn-icon submit no-margin UFSGrid-row-insert')); ?>
	      <?php echo CHtml::submitButton(Yii::t('label','Cancel'), array('id'=>'Cancel','class' =>'btn-icon submit no-margin')); ?>
	</div>
<?php $this->endWidget(); ?>
</div>