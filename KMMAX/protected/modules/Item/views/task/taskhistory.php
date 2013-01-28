<?php
$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	$model->fTaskNo,
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('inputdisabled', "
$('.submenu .current').click(function(){
	return false;
});		
$('.ViewAttach').live('click',function(){ 
		var url =	'".Yii::app()->createUrl('Item/attachment/view')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
	    $(this).colorbox({iframe:true, width:'100%', height:'100%',onClosed: function (message) {}});
  		return false;
     });		
jQuery(':submit').click(function(){
	   $('#task-history-form').attr('action',$(this).attr('rel'));
	   $('#task-history-form').submit();
});

");

?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Tasks')?></h2>
	<input type="hidden" value="<?php echo $keyid?>" id="hiddenpkey" name="hiddenpkey" />
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('task/index/id/'.$model->fItemNo),'linkOptions'=>array('id'=>'ListTask'),'visible'=>Yii::app()->user->checkAccess('Item.task.Index')),
						array('label'=>Yii::t('label','Create'), 'linkOptions'=>array('id'=>'CreateTask'),'url'=>array('task/create/id/'.$model->fItemNo),'visible'=>Yii::app()->user->checkAccess('Item.task.Create')),					
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateTask'),'id'=>$model->fTaskNo,'url'=>array('task/update/id/'.$model->fTaskNo),'visible'=>Yii::app()->user->checkAccess('Item.task.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('id'=>'ViewTask'), 'id'=>$model->fTaskNo,'url'=>array('task/view/id/'.$model->fTaskNo),'visible'=>Yii::app()->user->checkAccess('Item.task.View')),
						
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form','enctype' => 'multipart/form-data',),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	 <div class="input-group">
          <?php echo $form->labelEx($model,'fTheme'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTheme',array('size'=>60,'maxlength'=>200,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fTheme'); ?>
        
      	</div>
      </div>
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textField('fCatalogueName',empty($model->fCatalogueName)?'':$model->fCatalogueName->fCatalogueName,array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
        
      	</div>
      </div>

      <div class="input-group">
          <?php echo $form->labelEx($model,'fExecutor'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fExecutor',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fExecutor'); ?>
        
      	</div>
      </div>
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStartDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStartDate',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fStartDate'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEndDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEndDate',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fEndDate'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSponsor'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSponsor',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fSponsor'); ?>
        
      	</div>
      </div>

       <div class="input-group">
          <?php echo $form->labelEx($model,'fContent'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fContent',array('rows'=>6, 'cols'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fContent'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStandardStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStandardStatus',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fStandardStatus'); ?>
        
      	</div>
      </div>
      
      <div class="input-group">
          <?php echo $form->labelEx($model,'fSchedule'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSchedule',array('size'=>20,'maxlength'=>20,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fSchedule'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
      	</div>
      </div>

       <div class="input-group">
          <?php echo $form->labelEx($model,'fLatestAffixId'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLatestAffixId',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
           <span class="btn-icon-horizontal btn-icon-input btn-icon-search ViewAttach" rel='<?php echo $viewattach ?>'></span>
          <?php echo $form->error($model,'fLatestAffixId'); ?>
        
      	</div>
      </div>
  
	 
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPriority'); ?>
     
          <div class="inputs">
              <?php echo $form->dropdownList($model,'fPriority',$fPriority,array('disabled'=>'disabled')); ?>
          <?php echo $form->error($model,'fPriority'); ?>
        
      	</div>
      </div>
      
	  
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnFrequency'); ?>
     
          <div class="inputs">
                 <?php echo $form->dropdownList($model,'fWarnFrequency',$fWarnFrequency,array('disabled'=>'disabled')); ?>
          <?php echo $form->error($model,'fWarnFrequency'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskType'); ?>
     
          <div class="inputs">
   <?php echo $form->dropdownList($model,'fTaskType',$fTaskType,array('disabled'=>'disabled')); ?>
          <?php echo $form->error($model,'fTaskType'); ?>
        
      	</div>
      </div>
      
      <div class="form-submit">
	  
	</div>
<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-history-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form','enctype' => 'multipart/form-data'),
)); ?>
	<?php
						$this->widget('zii.widgets.grid.CGridView', array(
								'dataProvider'=>$dataProvider,//数据源
						        'columns'=>array(
                                        'fActionUser',
                                        'fAction',
										'fActionDate',
										'fFinishPercent',
										'fContent',
										'fAttchName',
						               ),
						));
					?>

     <div class="input-group">
          <?php echo $form->labelEx($history,'fActionUser'); ?>
          <div class="inputs">
              <?php echo $form->textField($history,'fActionUser',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
              <?php echo $form->error($history,'fActionUser'); ?>
      	</div>
      </div>
	  
	 <div class="input-group">
          <?php echo $form->labelEx($history,'fContent'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($history,'fContent',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($history,'fContent'); ?>
        
      	</div>
      </div>
      
      <div class="input-group">
          <?php echo $form->labelEx($history,'fFinishPercent'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($history,'fFinishPercent',array('size'=>50,'maxlength'=>50)); ?>
          <?php echo $form->error($history,'fFinishPercent'); ?>
        
      	</div>
      </div>		

	  <div class="input-group">
          <?php echo $form->labelEx($history,'fAttchName'); ?>
     
          <div class="inputs">
          <?php echo $form->fileField($history,'fAttchName',array('size'=>50,'maxlength'=>50)); ?>
          <?php echo $form->error($history,'fAttchName'); ?>
        
      	</div>
      </div>	
       			
	<div class="form-submit">
	 <?php echo $handle ?>
	   <?php echo $downHandle ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->