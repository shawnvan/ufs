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
	\$model->{$nameColumn},
);\n";
?>

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#Copy<?php echo $this->modelClass;?>').attr('href',$('#Copy<?php echo $this->modelClass;?>').attr('href')+'/id/".$keyid."');
$('#Update<?php echo $this->modelClass;?>').attr('href',$('#Update<?php echo $this->modelClass;?>').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label',$label); ?></h2>
	<div class="content-action">

	<?php echo "<?php"; ?>
        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'Copy<?php echo $this->modelClass;?>'),'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'Update<?php echo $this->modelClass;?>'),'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo '<?php echo $keyid;?>'; ?>" id="hiddenpkey" name="hiddenpkey" />
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
		<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->