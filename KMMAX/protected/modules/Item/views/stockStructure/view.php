<?php
$this->breadcrumbs=array(
	'Stock Structures'=>array('index'),
	$model->fSSNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyStockStructure').attr('href',$('#CopyStockStructure').attr('href')+'/id/".$keyid."');
$('#UpdateStockStructure').attr('href',$('#UpdateStockStructure').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2>Stock Structures</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Item.stockStructure.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.stockStructure.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyStockStructure'),'id'=>$model->fSSNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('Item.stockStructure.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateStockStructure'),'id'=>$model->fSSNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('Item.stockStructure.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fSSNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('Item.stockStructure.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.stockStructure.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stock-structure-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSSNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSSNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSSNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fItemNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fHistoryNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fHistoryNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fHistoryNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShareholderName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fShareholderName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShareholdingNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholdingNum'); ?>
   
          <?php echo $form->error($model,'fShareholdingNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShareholderRate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderRate'); ?>
   
          <?php echo $form->error($model,'fShareholderRate'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->