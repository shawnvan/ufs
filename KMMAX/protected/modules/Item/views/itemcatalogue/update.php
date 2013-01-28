<div class="form">

<?php echo CHtml::beginForm(); ?>

		<?php echo CHtml::hiddenField('fItemNo',$model->fItemNo,array('size'=>50,'maxlength'=>50)); ?>		
		<?php echo CHtml::hiddenField('fTemplateNo',$model->fTemplateNo,array('size'=>50,'maxlength'=>50)); ?>

   
	<div class="row">
		<?php echo $model->fathercatalogue->fCatalogueName; ?>
	</div>
	
	 <div class="row">
	 	<?php echo CHtml::textField('fCatalogueName',$model->catalogue->fCatalogueName); ?>
	</div>
	
	<div class="row">
		<?php echo CHtml::textField('fIsActive',$model->fIsActive); ?>
	</div>
	<?php echo CHtml::ajaxSubmitButton('编辑', $this->createUrl('Item/itemcatalogue/updatetree'),
              array('type'=>'POST', 'success'=>'tttformSaved'),array('id'=>'itemcatalogue-update')); ?>     


 <?php echo CHtml::endForm(); ?>
<?php 
		Yii::app()->getClientScript()->registerScript('itemcatalogue-save',"
			alert('fefewa');
			
		");

		?>

</div><!-- form -->