<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/fullcalendar/fullcalendar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/fullcalendar/fullcalendar.print.css"   media='print'/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/jquery-ui-timepicker-addon.css"/>

<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jquery-ui-timepicker-zh-CN.js"></script>
 
<?php
$this->breadcrumbs=array(
	'Items'=>array('calendar'),
	'calendar',
);
Yii::app()->clientScript->registerScript('search', "
   $(function() {
		 /*日期控件*/
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    var calendar = $('#calendar').fullCalendar({
	      header: {
	        left: 'prev,next today',
	        center: 'title',
	        right: 'month'
	      },
	      select: function(start, end, allDay) {
	        calendar.fullCalendar('unselect');
	      },
	      dayClick: function() {
	       $('#info_calendar').dialog('open');
          },
	      editable: false,
          selectable:true,//选择的时候高亮 
          selectHelper:true,//只对agenda有效果 
          eventClick:function(event,jsEvent,view){ 
		    jQuery('#fPlan').val(event.title);
		    jQuery('#fRecordDate').val(event.start);
		    jQuery('#fResult').val(event.result);
		    jQuery('#fSummary').val(event.summary);
		    jQuery('#fEvaluate').val(event.evaluate);
		    jQuery('#fMemo').val(event.memo);
		    $('#view_calendar').dialog('open');
			},  
	      events: $calender_str
	    });
    });
    jQuery('.datepicker').datetimepicker();
    $('#info_calendar').dialog({
    	    autoOpen: false,
    	    height: 900,
    	    width:1100,
    	    modal: true,
    	    buttons: {
    	        Ok: function() {
    	            $.ajax({
						  url:'".Yii::app()->createUrl('report/workrecord/insert')."',
						  cache: false,
						  type:'POST',
						  data: 'date='+$('#Workrecord_fRecordDate').val()+'&plan='+$('#Workrecord_fPlan').val()+'&result='+$('#Workrecord_fResult').val()+'&summary='+$('#Workrecord_fSummary').val()+'&evaluate='+$('#Workrecord_fEvaluate').val()+'&memo='+$('#Workrecord_fMemo').val(),
						  success: function(data){
					           $('#calendar').fullCalendar('renderEvent',
					            {
					              title: $('#Workrecord_fPlan').val(),
					              start: $('#Workrecord_fRecordDate').val(),
					              end: $('#Workrecord_fRecordDate').val(),
					          	  plan: $('#Workrecord_fPlan').val(),
	      						  result: $('#Workrecord_fResult').val(),
						      	  summary: $('#Workrecord_fSummary').val(),
						      	  evaluate: $('#Workrecord_fEvaluate').val(),
					          	  memo: $('#Workrecord_fMemo').val(),
					              allDay: true
					            },
					            true // make the event 'stick'
					          );
					         $('#calendar').fullCalendar('unselect');
			          		 $('#Workrecord_fPlan').val('');
			          		 $('#Workrecord_fRecordDate').val('');
          		             $('#Workrecord_fPlan').val('');
			          		 $('#Workrecord_fResult').val();
			          		 $('#Workrecord_fSummary').val();
				      		 $('#Workrecord_fEvaluate').val();
				      		 $('#Workrecord_fMemo').val();
							 $('#info_calendar').dialog('close');
						  }
						});	
    	        }
    	    }
    	});
	$('#view_calendar').dialog({
    	    autoOpen: false,
    	    height: 900,
    	    width:1100,
    	    modal: true,
    	    buttons: {
    	        Ok: function() {
    	           $('#view_calendar').dialog('close');
    	        }
    	    }
    	});	
         
");
?>
<div class="content-head underline">
	<h2><?php echo Yii::t('label','Workrecords') ?></h2>
	<div class="content-action">
	</div>
</div>
<div id="footer" class="content"><div id='calendar'></div></div>
<style type='text/css'> #calendar {width: 95%;margin: 0 auto;background: #FFF;color: #333;}</style>
<div id="info_calendar" title="消息" style="display:none;width:100%;height:100%;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'workrecord-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRecordDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRecordDate',array('class'=>'datepicker')); ?>
   
          <?php echo $form->error($model,'fRecordDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPlan'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fPlan',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fPlan'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResult'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fResult',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fResult'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSummary'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fSummary',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fSummary'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEvaluate'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fEvaluate',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fEvaluate'); ?>
        
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
 </div>
 <div id="view_calendar" title="消息" style="display:none;width:100%;height:100%;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'workrecord-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<div class="input-group">
          <?php echo $form->labelEx($model,'fRecordDate'); ?>
     
          <div class="inputs">
         <?php echo CHtml::textField('fRecordDate','',array('disabled'=>'disabled')); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPlan'); ?>
     
          <div class="inputs">
 <?php echo CHtml::textArea('fPlan','',array('rows'=>6, 'cols'=>25,'disabled'=>'disabled')); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResult'); ?>
     
          <div class="inputs">
    <?php echo CHtml::textArea('fResult','',array('rows'=>6, 'cols'=>25,'disabled'=>'disabled')); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSummary'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textArea('fSummary','',array('rows'=>6, 'cols'=>25,'disabled'=>'disabled')); ?>
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEvaluate'); ?>
     
          <div class="inputs">
         <?php echo CHtml::textArea('fEvaluate','',array('rows'=>6, 'cols'=>25,'disabled'=>'disabled')); ?>
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textArea('fMemo','',array('rows'=>6, 'cols'=>25,'disabled'=>'disabled')); ?>
      	</div>
      </div>
<?php $this->endWidget(); ?>    
 </div>