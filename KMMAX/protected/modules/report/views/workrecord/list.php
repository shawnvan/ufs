<?php
$this->breadcrumbs=array(
	'Workrecords',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Workrecords') ?></h2>

	<div class="content-action">

	<?php   $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('report.workrecord.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('report.workrecord.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('report.workrecord.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'workplan-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>
	  <div class="input-group">
          <?php echo $form->labelEx($workplan,'fTitle'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($workplan,'fTitle',array('size'=>60,'maxlength'=>200,'disabled'=>'disabled')); ?>
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($workplan,'fMonth'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($workplan,'fMonth',array('size'=>2,'maxlength'=>2,'disabled'=>'disabled')); ?>
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($workplan,'fNowPlan'); ?>
          <div class="inputs">
          <?php echo $form->textArea($workplan,'fNowPlan',array('rows'=>6, 'cols'=>50,'disabled'=>'disabled')); ?>
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','View') , array('class' =>'btn-icon submit no-margin workPlan-view')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Update') , array('class' =>'btn-icon submit no-margin workPlan-update')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Create') , array('class' =>'btn-icon submit no-margin workPlan-create')); ?>
	</div>

<?php $this->endWidget(); ?>

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fRecordUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fRecordDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fPlan'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
        ),
        'columnsModel'=>array(
		array('name'=>'fRecordUser'),
		array('name'=>'fRecordDate'),
		array('name'=>'fPlan'),
		array('name'=>'fCreateUser'),
		array('name'=>'fCreateDate'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
		array('title'=>$sort->link('fRecordUser')),
		array('title'=>$sort->link('fRecordDate')),
		array('title'=>$sort->link('fPlan')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
	
        ),
       'sortname'=>'fRecordNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('report/workrecord/gridData',$_GET),
        'modulename'=>'Workrecord',
    )); ?>
</div>