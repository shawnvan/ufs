<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/fullcalendar/fullcalendar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/fullcalendar/fullcalendar.print.css"   media='print'/>

<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/fullcalendar/fullcalendar.min.js"></script>  
<?php
$this->breadcrumbs=array(
	'Items'=>array('calendar'),
	'calendar',
);

Yii::app()->clientScript->registerScript('search', "
tinyMCE.init({
		mode : 'textareas',
		content_css : 'css/content.css',
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		]
	});
    var d = document;
    var safari = (navigator.userAgent.toLowerCase().indexOf('safari') != -1) ? true : false;
    var gebtn = function(parEl,child) { return parEl.getElementsByTagName(child); };

    onload = function() {
        
        var body = gebtn(d,'body')[0];
        body.className = body.className && body.className != '' ? body.className + ' has-js' : 'has-js';
        
        if (!d.getElementById || !d.createTextNode) return;
        var ls = gebtn(d,'label');
        for (var i = 0; i < ls.length; i++) {
            var l = ls[i];
            if (l.className.indexOf('label_') == -1) continue;
            var inp = gebtn(l,'input')[0];
            if (l.className == 'label_check') {
                l.className = (safari && inp.checked == true || inp.checked) ? 'label_check c_on' : 'label_check c_off';
                l.onclick = check_it;
            }else if (l.className == 'label_check c_on') {
                l.className = (safari && inp.checked == true || inp.checked) ? 'label_check c_off' : 'label_check c_on';
                l.onclick = check_it;
            }
            if (l.className == 'label_radio') {
                l.className = (safari && inp.checked == true || inp.checked) ? 'label_radio r_on' : 'label_radio r_off';
                l.onclick = turn_radio;
            };
        };
    };
    var check_it = function() {
        var inp = gebtn(this,'input')[0];
        if (this.className == 'label_check c_off' || (!safari && inp.checked)) {
            this.className = 'label_check c_on';
            if (safari) inp.click();
        } else {
            this.className = 'label_check c_off';
            if (safari) inp.click();
        };
    };
    var turn_radio = function() {
        var inp = gebtn(this,'input')[0];
        if (this.className == 'label_radio r_off' || inp.checked) {
            var ls = gebtn(this.parentNode,'label');
            for (var i = 0; i < ls.length; i++) {
                var l = ls[i];
                if (l.className.indexOf('label_radio') == -1)  continue;
                l.className = 'label_radio r_off';
            };
            this.className = 'label_radio r_on';
            if (safari) inp.click();
        } else {
            this.className = 'label_radio r_off';
            if (safari) inp.click();
        };
    };
");


Yii::app()->clientScript->registerScript('search', "
   $(function() {
        var availableTags = [
            'ActionScript',
            'AppleScript',
            'Asp',
            'BASIC',
            'C',
            'C++',
            'Clojure',
            'COBOL',
            'ColdFusion',
            'Erlang',
            'Fortran',
            'Groovy',
            'Haskell',
            'Java',
            'JavaScript',
            'Lisp',
            'Perl',
            'PHP',
            'Python',
            'Ruby',
            'Scala',
            'Scheme'
        ];
        $( '#tags' ).autocomplete({
            source: availableTags
        });
		 $( '#datepicker' ).datepicker();
    
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
	      selectable: true,
	      selectHelper: true,
	      select: function(start, end, allDay) {
	        var title = prompt('输入提醒标题:');
	        if (title) {
	          calendar.fullCalendar('renderEvent',
	            {
	              title: title,
	              start: start,
	              end: end,
	              allDay: allDay
	            },
	            true // make the event 'stick'
	          );
	        }
	        calendar.fullCalendar('unselect');
	        
	      },
	      dayClick: function() { alert('单击天!'); },
	      editable: false,
          eventMouseover:function(event,jsEvent,view){ 
			alert('鼠标经过某个事件的标题'+event.title); 
			alert('鼠标经过某个事件位置'+jsEvent.clientX); 
			alert('鼠标经过某个事件视图名称'+view.title); 
			}, 
	      events: [{title: '当天所有任务',start: new Date(y, m, 1)},
	        {title: '项目审批',start: new Date(y, m, d-5),end: new Date(y, m, d-2)},
	        {id: 999,title: '项目任务',start: new Date(y, m, d-3, 16, 0),allDay: false},
	        {id: 999,title: '重复',start: new Date(y, m, d+4, 16, 0),allDay: false},
	        {title: '会议',start: new Date(y, m, d, 10, 30),allDay: false},
	        {title: '午饭',start: new Date(y, m, d, 12, 0),end: new Date(y, m, d, 14, 0),allDay: false},
	        {title: '生日聚会',start: new Date(y, m, d+1, 12, 0),end: new Date(y, m, d+1, 22, 30),allDay: false},
	        {title: 'Click for Google',start: new Date(y, m, 28),end: new Date(y, m, 29),url: 'http://google.com/'}]
	    });
    });
");
?>
<script>
    
    </script>
<div class="content-head underline">
	<h2><?php echo Yii::t('label','ItemCalendars') ?></h2>

	<div class="content-action">
	</div>
</div>

<div id="footer" class="content"><div id='calendar'></div></div>

<style type='text/css'> #calendar {width: 95%;margin: 0 auto;background: #FFF;color: #333;}</style>