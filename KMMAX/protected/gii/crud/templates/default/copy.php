<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Update',
);\n";
?>
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2><?php echo $label; ?></h2>
	<div class="content-action">

	<?php echo "<?php"; ?>
        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List <?php echo $this->modelClass; ?>'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Index')),
						array('label'=>Yii::t('label','Create <?php echo $this->modelClass; ?>'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Create')),					
						array('label'=>Yii::t('label','Copy <?php echo $this->modelClass; ?>'),'linkOptions'=>array('class'=>'current'),  'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Copy')),
						array('label'=>Yii::t('label','Manage <?php echo $this->modelClass; ?>'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="<?php echo $this->tableSchema->primaryKey; ?>" id="hiddenpkey" name="hiddenpkey" />

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>\n"; ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>

	  <div class="input-group">
          <?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>     
          <div class="inputs">
          <?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>   
          <?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
        
      	</div>
      </div>

<?php
}
?>
	<div class="form-submit">
		<?php echo "<?php echo CHtml::submitButton('Create', array('class' =>'btn-icon submit no-margin' , )); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->