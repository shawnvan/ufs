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
	        right: 'month,agendaWeek,agendaDay'
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
		    jQuery('#fTheme').val(event.title);
		    jQuery('#fContent').val(event.content);
		    jQuery('#fMemo').val(event.fMemo);
		    jQuery('#fStartTime').val(event.start);
		    jQuery('#fEndTime').val(event.end);
		    $('#view_calendar').dialog('open');
			},  
	      events: $calender_str
	    });
    });
    jQuery('.datepicker').datetimepicker();
    $('#info_calendar').dialog({
    	    autoOpen: false,
    	    height: 660,
    	    width:530,
    	    modal: true,
    	    buttons: {
    	        Ok: function() {
    	            $.ajax({
						  url:'".Yii::app()->createUrl('Item/Calendar/insert')."/id/'+jQuery('#hiddenpkey').val(),
						  cache: false,
						  type:'POST',
						  data: 'title='+$('#Calendar_fTheme').val()+'&content='+$('#Calendar_fContent').val()+'&memo='+$('#Calendar_fMemo').val()+'&start='+$('#Calendar_fStartTime').val()+'&end='+$('#Calendar_fEndTime').val(),
						  success: function(data){
					           $('#calendar').fullCalendar('renderEvent',
					            {
					              title: $('#Calendar_fTheme').val(),
					              start: $('#Calendar_fStartTime').val(),
					              end: $('#Calendar_fEndTime').val(),
					          	  content: $('#Calendar_fContent').val(),
					          	  memo: $('#Calendar_fMemo').val(),
					              allDay: false
					            },
					            true // make the event 'stick'
					          );
					         $('#calendar').fullCalendar('unselect');
			          		 $('#Calendar_fTheme').val('');
			          		 $('#Calendar_fContent').val('');
          		             $('#Calendar_fMemo').val('');
			          		 $('#Calendar_fStartTime').val();
			          		 $('#Calendar_fEndTime').val();
							 $('#info_calendar').dialog('close');
						  }
						});	
    	        }
    	    }
    	});
	$('#view_calendar').dialog({
    	    autoOpen: false,
    	    height: 660,
    	    width:530,
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
	<h2><?php echo Yii::t('label','ItemCalendars') ?></h2>
	<div class="content-action">
	</div>
</div>
<input type="hidden" value="<?php echo $keyid?>" id="hiddenpkey" name="hiddenpkey" />
<div id="footer" class="content"><div id='calendar'></div></div>
<div id="info_calendar" title="消息" style="display:none;width:100%;height:100%;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'c-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>    
      <div class="input-group">
          <?php echo $form->labelEx($calender,'fTheme'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($calender,'fTheme',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($calender,'fTheme'); ?>
        
      	</div>
      </div>
       <div class="input-group">
          <?php echo $form->labelEx($calender,'fContent'); ?>
     
          <div class="inputs">
    <?php echo $form->textArea($calender,'fContent',array('rows'=>6, 'cols'=>25)); ?>
          <?php echo $form->error($calender,'fContent'); ?>
        
      	</div>
      </div>
       <div class="input-group">
          <?php echo $form->labelEx($calender,'fMemo'); ?>
     
          <div class="inputs">
   <?php echo $form->textArea($calender,'fMemo',array('rows'=>6, 'cols'=>25)); ?>
          <?php echo $form->error($calender,'fMemo'); ?>
        
      	</div>
      </div>
       <div class="input-group">
          <?php echo $form->labelEx($calender,'fStartTime'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($calender,'fStartTime',array('size'=>50,'maxlength'=>50,'class'=>'datepicker')); ?>
   
          <?php echo $form->error($calender,'fStartTime'); ?>
        
      	</div>
      </div>
      <div class="input-group">
          <?php echo $form->labelEx($calender,'fEndTime'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($calender,'fEndTime',array('size'=>50,'maxlength'=>50,'class'=>'datepicker')); ?>
   
          <?php echo $form->error($calender,'fEndTime'); ?>
        
      	</div>
      </div>
<?php $this->endWidget(); ?>      
 </div>
 <div id="view_calendar" title="详细查看" style="display:none;width:100%;height:100%;">  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'view-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?> 
      <div class="input-group">
          <?php echo $form->labelEx($calender,'fTheme'); ?>
          <div class="inputs">
          <?php echo CHtml::textField('fTheme','',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
      	</div>
      </div>
      
       <div class="input-group">
          <?php echo $form->labelEx($calender,'fContent'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textArea('fContent','',array('rows'=>6, 'cols'=>25,'disabled'=>'disabled')); ?>
      	</div>
      </div>
      
       <div class="input-group">
          <?php echo $form->labelEx($calender,'fMemo'); ?>
     
          <div class="inputs">
         <?php echo CHtml::textArea('fMemo','',array('rows'=>6, 'cols'=>25,'disabled'=>'disabled')); ?>
      	</div>
      </div>
      
       <div class="input-group">
          <?php echo $form->labelEx($calender,'fStartTime'); ?>
          <div class="inputs">
             <?php echo CHtml::textField('fStartTime','',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>        
      	</div>
      </div>
      
      <div class="input-group">
          <?php echo $form->labelEx($calender,'fEndTime'); ?>     
          <div class="inputs">
        <?php echo CHtml::textField('fEndTime','',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>        
      	</div>
      </div>   
    <?php $this->endWidget(); ?>       
 </div>
<style type='text/css'> #calendar {width: 95%;margin: 0 auto;background: #FFF;color: #333;}</style>