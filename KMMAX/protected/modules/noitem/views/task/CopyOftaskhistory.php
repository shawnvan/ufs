<?php $form = $this->beginWidget ( 'CActiveForm', array ('id' => 'item-form','enableAjaxValidation' => false,
		'htmlOptions'=>array('class'=>'form','enctype' => 'multipart/form-data',) ) );
?>	
<?php echo CHtml::beginForm(); ?>
  <script>
jQuery(function() {
    jQuery(':submit').click(function(){
	   $('#item-form').attr('action',$(this).attr('rel'));
	   $('#item-form').submit();
});

   });
</script>	
<div class="line"></div>
<div id="edit-form">
	<table border="0" width="95%" cellpadding="0" cellspacing="0" class="BorderSilver">
		    <tbody><tr bgcolor="Silver" >
		        <td colspan='1'></td>
		        <td colspan="4">
		            <table width="100%">
		                <tbody><tr>
		                    <td width="20px" align="left">
		                    </td>
		                    <td style="font-weight:bold;" align="left"><font><?php echo $form->labelEx($model,'fTheme'); ?></font>
		                    <font><?php echo CHtml::encode($model->fTheme); ?></font></td>
		                </tr>
		            </tbody></table>
		        </td>
		         <td colspan='1'></td>
		    </tr>
		    <tr style="height:22px;">
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fCatalogueNo'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode($model->fCatalogueName->fCatalogueName); ?></font></td>
		    </tr>
		    <tr style="height:22px;">
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fStartDate'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode(date('Y-m-d',$model->fStartDate)); ?></font></td>
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fEndDate'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode(date('Y-m-d',$model->fEndDate)); ?></font></td>
		    </tr>
		    <tr style="height:22px;">
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fSponsor'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode($model->fSponsor); ?></font></td>
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fExecutor'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode($model->fExecutor); ?></font></td>
		    </tr>
		    <tr style="height:22px;">
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fTaskType'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode(array_key_exists($model->fTaskType,ItemSettings::$TaskType)?ItemSettings::$TaskType[$model->fTaskType]:''); ?></font></td>
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fPriority'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode(array_key_exists($model->fPriority,ItemSettings::$Priority)?ItemSettings::$Priority[$model->fPriority]:''); ?></font></td>
		    </tr>
		    <tr style="height:22px;">
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fCreateDate'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode(date('Y-m-d',$model->fCreateDate)); ?></font></td>
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fWarnFrequency'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode(array_key_exists($model->fWarnFrequency,ItemSettings::$WarnCycle)?ItemSettings::$WarnCycle[$model->fWarnFrequency]:''); ?></font></td>
		    </tr>
		    <tr style="height:22px;">
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font>相关附件</font></td>
		        <td align="left"><font>
		        <a href='http://localhost:8081/data/upload/<?php echo CHtml::encode($attch->fAttachmentFalseName); ?>'><?php echo CHtml::encode($attch->fAttachmentName); ?></a></font></td>
		    </tr>
		    <tr style="height:22px;">
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fContent'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode($model->fContent); ?></font></td>
		    </tr>
		    <tr style="height:22px;">
		        <td width="20px" align="left"></td>
		        <td width="150px" align="left"><font><?php echo $form->labelEx($model,'fRemarks'); ?></font></td>
		        <td align="left"><font><?php echo CHtml::encode($model->fRemarks); ?></font></td>
		    </tr>
			 <tr style="height:22px; padding-top: 4px;">
			    <td align="left" style="padding-top: 4px;" width="20px" valign="top"></td>
			 	<td align="left" style="padding-top: 4px;" width="150px" valign="top" colspan='4'>
					<?php echo $handle; ?>
			 	</td>
		        <td align="left" style="padding-top: 4px;" valign="top"></td>
			 </tr>
			
		</tbody>
	</table>
	<br>
	<table border="0" width="95%" cellpadding="0" cellspacing="0" class="BorderSilver">
	    <tbody>
	    <tr>
	        <td colspan="2" align="left">
	            <table bgcolor="Silver" width="100%">
	                <tbody><tr>
	                    <td width="20px" align="left"></td>
	                    <td style="font-weight:bold;" align="left"><font><font>任务执行历史</font></font></td>
	                </tr>
	            </tbody></table>
	        </td>
	    </tr>
		<tr>
			<td colspan="2" align="left">
				<table width="100%">
					<tbody>
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
				</tbody>
				</table>		
			</td>
		</tr>
		<tr>
	        <td colspan="2" align="left">
	            <table bgcolor="Silver" width="100%">
	                <tbody><tr>
	                    <td width="20px" align="left"></td>
	                    <td style="font-weight:bold;" align="left"><font>任务执行</font></td>
	                </tr>
	            </tbody></table>
	        </td>
	    </tr>
		<tr>
		   <td colspan="2" align="left">
		      <table width="100%">
		        <thead>
		        
		        <tr>
		           <td>操作者</td>
		           <td>输入内容</td>
		           <td>附件</td>
		           <td>进度百分比</td>
		        </tr>
		        </thead>
		        <tbody>
		         <tr>
		           <td>自动添加</td>
		           <td><?php echo CHtml::textArea('fContent'); ?></td>
		           <td><?php echo CHtml::fileField('file'); ?></td>
		           <td><?php echo CHtml::textField('fFinishPercent'); ?></td>
		          </tr>
		          <tr>
		           <td></td>
		           <td colspan='2'>
		           <?php echo $downHandle ?>
						</td>
		          </tr>
		         </tbody>
		      </table>
		   </td>
		</tr>
	</tbody>
	</table>
</div>
<?php echo CHtml::endForm(); ?>
<?php echo $form->errorSummary($model); ?>
  <?php $this->endWidget(); ?>
