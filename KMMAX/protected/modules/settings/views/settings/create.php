
    <h3>Create parameter</h3>
<?php

$form = $this->beginWidget('CActiveForm', array ('id' => 'Settings','enableAjaxValidation' => false,
		 'htmlOptions'=>array('class'=>'form') ) );
?>
    
    <div id="edit-form">
 		<table width="100%" border="0" style="background:#E3E2E2;margin:10px 0px;">
			<tr>
			<td>
				<dl>
					<dd><?php echo $form->labelEx($param,'fName'); ?></dd>
					<dt><?php echo $form->textField($param,'fName',array('class'=>'required')); ?></dt>					
				</dl>
				<?php echo $form->error($param,'fName'); ?>
			</td>
            </tr>
		<tr>
			<td>
				<dl>
					<dd><?php echo $form->labelEx($param,'fLabel'); ?></dd>
					<dt><?php echo $form->textField($param,'fLabel',array('class'=>'required')); ?></dt>					
				</dl>
				<?php echo $form->error($param,'fLabel'); ?>
			</td>
            </tr>
		<tr>
			<td>
				<dl>
					<dd><?php echo $form->labelEx($param,'fValue'); ?></dd>
					<dt><?php echo $form->textField($param,'fValue',array('class'=>'required')); ?></dt>					
				</dl>
				<?php echo $form->error($param,'fValue'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<dl>
					<dd><?php echo $form->labelEx($param,'fDescription'); ?></dd>
					<dt><?php echo $form->textField($param,'fDescription',array('class'=>'required')); ?></dt>					
				</dl>
				<?php echo $form->error($param,'fDescription'); ?>
			</td>
        </tr>
		<tr>
				<dl>
					<dd><?php echo $form->labelEx($param, 'fVisible'); ?></dd>
					<dt class="field switch" id='User_fIsActive'>
					    <label class="cb-enable selected"><span value='1'>是</span></label>
					    <label class="cb-disable"><span value='0'>否</span></label>
						<input type="hidden" value="1" name="fIsActive" id="hide_fIsActive" />
					</dt>
					<?php echo $form->error($param, 'fVisible'); ?>
				</dl>      
        </tr>
		</table>
</div>
	<?php echo $form->errorSummary($param); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save',array('class'=>'submit')); ?>
	</div>

<?php $this->endWidget(); ?>

