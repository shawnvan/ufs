<?php
$this->breadcrumbs=array(
	'Cooperativecompanies'=>array('index'),
	$model->fCooperativeCompanyID,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyCooperativecompany').attr('href',$('#CopyCooperativecompany').attr('href')+'/id/".$keyid."');
$('#UpdateCooperativecompany').attr('href',$('#UpdateCooperativecompany').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Cooperativecompanies') ?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativecompany.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativecompany.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyCooperativecompany'),'id'=>$model->fCooperativeCompanyID,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativecompany.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateCooperativecompany'),'id'=>$model->fCooperativeCompanyID,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativecompany.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fCooperativeCompanyID,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativecompany.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativecompany.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cooperativecompany-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>
	<?php echo $form->errorSummary($model); ?>
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCooperativeCompanyName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCooperativeCompanyName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fCooperativeCompanyName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCooperativeCompanyShortName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCooperativeCompanyShortName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCooperativeCompanyShortName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStarLevel'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStarLevel',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fStarLevel'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fType',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fKeyContacts'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fKeyContacts',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fKeyContacts'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCity'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCity',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fCity'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIndustry'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIndustry',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fIndustry'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDownIndustry'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fDownIndustry',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fDownIndustry'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOnIndustry'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOnIndustry',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fOnIndustry'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMainProduct'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fMainProduct',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($model,'fMainProduct'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWebSite'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWebSite',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fWebSite'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fZipCode'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fZipCode',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fZipCode'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMaintenanceEmployee'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fMaintenanceEmployee',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fMaintenanceEmployee'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo',array('rows'=>6, 'cols'=>50,'disabled' => 'disabled')); ?>
   
          <?php echo $form->error($model,'fMemo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
   
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
   
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->