<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('submenu .current').click(function(){
	return false;
});
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
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.Cooperativecompany.index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.Cooperativecompany.create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.Cooperativecompany.admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="fUserID" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

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
              <?php echo CHtml::dropdownList('fStarLevel', false,$StarLevel);  ?>
            <?php echo $form->error($model,'fStarLevel'); ?>
		</div>
      </div>
      
      <div class="input-group">
               <?php echo $form->labelEx($model,'fType'); ?>
               <div class="inputs">
              <?php echo CHtml::dropdownList('fType', false,$CompanyType);  ?>
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
              <?php echo CHtml::dropdownList('fCity', false,$City);  ?>
            <?php echo $form->error($model,'fCity'); ?>
  		</div>
      </div>
      
      <div class="input-group">
               <?php echo $form->labelEx($model,'fIndustry'); ?>
               <div class="inputs">
              <?php echo CHtml::dropdownList('fIndustry', false,$CompanyIndustry);  ?>
            <?php echo $form->error($model,'fIndustry'); ?>
  		</div>
      </div>
      
      <div class="input-group">
               <?php echo $form->labelEx($model,'fDownIndustry'); ?>
               <div class="inputs">
              <?php echo CHtml::dropdownList('fDownIndustry', false,$CompanyIndustry);  ?>
            <?php echo $form->error($model,'fDownIndustry'); ?>
  		</div>
      </div>
      
       <div class="input-group">
               <?php echo $form->labelEx($model,'fOnIndustry'); ?>
               <div class="inputs">
              <?php echo CHtml::dropdownList('fOnIndustry', false,$CompanyIndustry);  ?>
            <?php echo $form->error($model,'fOnIndustry'); ?>
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
               <?php echo $form->labelEx($model,'fWebSite'); ?>
               <div class="inputs">
              <?php echo $form->textField($model,'fWebSite',array('size'=>60,'maxlength'=>200)); ?>
            <?php echo $form->error($model,'fWebSite'); ?>
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
               <?php echo $form->labelEx($model,'fMaintenanceEmployee'); ?>
               <div class="inputs">
              <?php echo $form->textField($model,'fMaintenanceEmployee',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'fMaintenanceEmployee'); ?>
    		</div>
      </div>
      
      <div class="input-group">
               <?php echo $form->labelEx($model,'fMemo'); ?>
               <div class="inputs">
              <?php echo $form->textArea($model,'fMemo',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'fMemo'); ?>
  		</div>
      </div>
      
	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
