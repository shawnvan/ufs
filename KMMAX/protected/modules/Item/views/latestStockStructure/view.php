<?php
$this->breadcrumbs=array(
	'Latest Stock Structures'=>array('index'),
	$model->fHistoryNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyLatestStockStructure').attr('href',$('#CopyLatestStockStructure').attr('href')+'/id/".$keyid."');
$('#UpdateLatestStockStructure').attr('href',$('#UpdateLatestStockStructure').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2>Latest Stock Structures</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Item.latestStockStructure.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.latestStockStructure.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyLatestStockStructure'),'id'=>$model->fHistoryNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('Item.latestStockStructure.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateLatestStockStructure'),'id'=>$model->fHistoryNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('Item.latestStockStructure.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fHistoryNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('Item.latestStockStructure.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.latestStockStructure.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'latest-stock-structure-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


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
          <?php echo $form->textField($model,'fShareholderName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fShareholderName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFristStrands'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFristStrands'); ?>
   
          <?php echo $form->error($model,'fFristStrands'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFristRate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFristRate'); ?>
   
          <?php echo $form->error($model,'fFristRate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSecondStrands'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSecondStrands'); ?>
   
          <?php echo $form->error($model,'fSecondStrands'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSecondRate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSecondRate'); ?>
   
          <?php echo $form->error($model,'fSecondRate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fThirdStrands'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fThirdStrands'); ?>
   
          <?php echo $form->error($model,'fThirdStrands'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fThirdRate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fThirdRate'); ?>
   
          <?php echo $form->error($model,'fThirdRate'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->