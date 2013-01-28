<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="wide form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl(\$this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>\n"; ?>

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field=$this->generateInputField($this->modelClass,$column);
	if(strpos($field,'password')!==false)
		continue;
?>
		<div class="input-group">
          <?php echo "<?php echo \$form->label(\$model,'{$column->name}'); ?>\n"; ?>  
          <div class="inputs">
          <?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?> 
          <?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
        
      	</div>
      </div>


<?php endforeach; ?>
	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo "<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>\n"; ?>
	</div>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- search-form -->