<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/less/main.less">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/less-1.3.0.min.js"></script>   
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jquery.js"></script>   
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jquery.layout-latest.js"></script>   
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jquery-ui-1.8.2.custom.min.js"></script>   
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jquery.layout.resizePaneAccordions.min-1.0.js"></script>             

<!-- blueprint CSS framework -->
<style>.hide{display:none;}.show{display:block;}#header{background:#red;}</style>
<?php 
			Yii::app()->clientScript->registerScript('inputdisabled', "
			  jQuery.ajax({				
				  url:'".Yii::app()->createUrl('msg/msgto/noread')."',
				  success: function(data){
				    alert(data);
		            $('.');
				  }
			 });	
			
			");

        ?>
<script type="text/javascript">
var $=jQuery;
var myLayout;

$(function () {
	 
	 myLayout = $('body').layout({
		north__size: 80,
		north__closable:    false,
		north__resizable:   false,
		west__size:			210 ,
		//west__closable:    false,
		west__spacing_open:0,
		west__resizable:   false,
		south__size:  28,
		south__initClosed:  false,
		south__closable:    true,
		south__resizable:   false,
		south__spacing_open:8,
		spacing_open:0

,	north__showOverflowOnHover:	true

	});
	
	westLayout = $('div.ui-layout-west').layout({
			north__minSize:				50	// ALL panes
		,	north__paneSelector:	".west-north"
		,	center__paneSelector:	".west-center",
		center__onresize:		$.layout.callbacks.resizePaneAccordions // west accordion a child of pane

	});

	 var icons = {
	            header: "ui-icon-circle-arrow-e",
	            activeHeader: "ui-icon-circle-arrow-s",
	            headerSelected: 'ui-icon-circle-arrow-s'
	        };
	$("#accordion-west").accordion({ fillSpace: true ,icons: icons});
	
	$("form input:text").keypress(function(e) {
		if (e.which == 13){ // 判断所按是否回车键
			var inputs = $("form").find(":text"); // 获取表单中的所有输入框
			var idx = inputs.index(this); // 获取当前焦点输入框所处的位置
			if (idx == inputs.length - 1){ // 判断是否是最后一个输入框
				if (confirm("最后一个输入框已经输入,是否提交?")){ // 用户确认
					$("form[name='articleForm']").submit(); // 提交表单
				} else {
					inputs[idx + 1].focus(); // 设置焦点
					inputs[idx + 1].select(); // 选中文字
				}
			}
		}
		return false;// 取消默认的提交行为
	})
		
   $('#menulist li a').each(function(index){
		$(this).attr('rel',$(this).attr('href'));
		$(this).attr('href','#tabs-content-'+index);
	})
	
    $('#menulist li a').click(function () {
        menutitle=$(this).text();
	    menuhref=$(this).attr('rel');
	    menuindex='menu'+$(this).parent('li').index().toString()+$(this).parent().parent('#menulist').parent().parent().children("div").index($(this).parent().parent('#menulist').parent()).toString();	
	    $('#menulist li').removeClass('menu-active');
		$(this).parent('li').addClass('menu-active');
		$('#tabslist').hide();
		
		$('#page-tabs ul#tabsmenu li').each(function(index, element) {
			var strid=$(this).attr('id');
			var menuid='tabs'+menuindex;
			if(strid == menuid){
				$('#page-tabs ul#tabsmenu li').removeClass('selected');
				$('#'+menuid).addClass('selected');
				$('#iframelist').find('iframe').removeClass('show');
				$('#iframelist').find('iframe').addClass('hide');				
				$('#tabs-content-'+menuindex).removeClass('hide');
				$('#tabs-content-'+menuindex).addClass('show');
			}
			if(!$('#'+menuid).length>0){
				//添加tabs
				$('#page-tabs ul#tabsmenu li').removeClass('selected last');
				$('#page-tabs ul#tabsmenu li .last').remove();
				$('#page-tabs ul#tabsmenu').append('<li id="tabs'+menuindex+'" class="last selected" index="'+menuindex+'"><div></div><a href="'+menuhref+'">'+menutitle+'</a><div class="last"></div><span class="close-tabs">×</span></li>');
				//添加tabs列表
				$('#tabslist').append('<li id="tabslist-tabs'+menuindex+'" index="'+menuindex+'"><a>'+menutitle+'</a></div></li>');
				$('#iframelist').find('iframe').addClass('hide');
				$('#iframelist').find('iframe').removeClass('show');
				$('#iframelist').append('<iframe id="tabs-content-'+menuindex+'" name="tabsContent'+menuindex+'" class="iframe-page" frameborder="0" scrolling="auto" height="100%" src="'+menuhref+'"></iframe>');						
			}
        });	
		return false;
    });

	$('#page-tabs ul#tabsmenu li a').live('click',function(){
		
		$('#page-tabs ul#tabsmenu li').removeClass('selected');
		$(this).parent('li').addClass('selected');
		$('#iframelist').find('iframe').addClass('hide');
		$('#iframelist').find('iframe').removeClass('show');
		$('#tabs-content-'+$(this).parent('li').attr('index')).addClass('show');	
		return false;	
	});

	$('#tabscontrol').click(function(){
		$('#tabslist').toggle();
	});

	$('#tabslist').mouseover(function(){
		$('#tabslist').show();
	}).mouseout(function(){
		$('#tabslist').hide();
	})
	
	$('#tabslist li a').live('click',function(){
		$('#page-tabs ul#tabsmenu li').removeClass('selected');
		var tabscontrol=$(this).parent('li').attr('id');
		$('#'+tabscontrol.substring(9,tabscontrol.length)).children('a').click();
		$('#tabslist').hide();
	});
	
    $('.close-tabs').live('click',function(){
		var tabsindex=$(this).parent('li').attr('index');
		console.log(tabsindex);
		$('#tabs-content-'+tabsindex).remove();
		if($(this).parent('li').hasClass('last')){			
			$(this).parent('li').remove();
			$('#page-tabs ul#tabsmenu li:last').addClass('last').append('<div class="last"></div>');
			$('#page-tabs ul#tabsmenu li:last').addClass('selected');
			$('#iframelist').find('iframe').removeClass('show');
			$('#iframelist').find('iframe').addClass('hide');				
			$('#tabs-content-'+(tabsindex-1)).addClass('show');
		}else{
			$(this).parent('li').remove();				
			$('#page-tabs ul#tabsmenu li').eq(tabsindex-1).addClass('selected');			
			$('#iframelist').find('iframe').removeClass('show');
			$('#iframelist').find('iframe').addClass('hide');				
			$('#tabs-content-'+tabsindex).addClass('show');
		}
		var tabscontrol_close=$(this).parent('li').attr('id');
		$('#tabslist-'+tabscontrol_close).remove();
		return false;	
    }); 

	// toggle dropdown menus
	$(".dropdown span").mousedown(function() {
		var $dropdown = $(this).siblings('ul');	// the menu to be opened
		$dropdown.addClass('open');
		$('ul.open').show();
		$('.dropdown ul').not($dropdown).removeClass('open');	// close all other menus
		return false;
	});
	$('ul.open').live('mouseover',function(){
		$(this).show();
	}).live('mouseout',function(){
		$(this).hide();
	});

	$('#fullscreen-button').click(function() {
		myLayout.toggle('west');
	});
	   
});		
$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if(!$clicked.parents().is('.dropdown'))
			$('.dropdown ul').removeClass('open');
	});
</script>
</head>

<body>
<div class="ui-layout-north add-padding lightgray" id="header">
	<div class="header-logo">
    	<img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/images/logo2.png" alt="logo" />
    </div>
    <div class="accountinfo">
    	<?php if(!empty(Yii::app()->params->profile->fAvatar)){
				$avatar = Yii::app()->request->baseUrl.'/'.Yii::app()->params->profile->fAvatar;
        }else{
				$avatar = Yii::app()->request->baseUrl.'/uploads/default.jpg';
        };
        $userMenu = array(
			array('label'=>CHtml::link('<span>0</span>','#',array('id'=>'main-menu-notif','style'=>'z-index:999;')),'itemOptions'=>array('class'=>'special')),
			array('label'=>CHtml::link('<span>&nbsp;</span>','#',array('class'=>'ufs-button','id'=>'fullscreen-button')),'itemOptions'=>array('class'=>'search-bar special')),
			array('label'=>CHtml::image($avatar,'',array('height'=>25,'width'=>25)).Yii::app()->user->getName(),
				'itemOptions'=>array('id'=>'profile-dropdown','class'=>'dropdown'),
				'items' => array(
					array('label' => Yii::t('app','Profile'),'url' => array('/profile/view','id' => Yii::app()->user->getId())),
					array('label' => Yii::t('app','Notifications'),'url' => array('/site/viewNotifications')),
					array('label' => Yii::t('app','Preferences'),'url' => array('/profile/settings')),
					array('label' => Yii::t('app','---'),'itemOptions'=>array('class'=>'divider')),
					array('label' => Yii::t('app','Logout'),'url' => array('/users/logout'))
				)
			),
			
		);
        
        ?>
    	<?php 
        		$this->widget('zii.widgets.CMenu', array(
					'id' => 'user-menu',
					'items' => $userMenu,
					'htmlOptions'=>array('class'=>'main-menu'),
					'encodeLabel' => false
				));

        ?>
    </div>
    
   <div id="page-tabs">
          <ul id="tabsmenu">
             <li id="tabsmenu00" class="selected last" index='menu00'>
		      <div></div>
		      <a href="<?php echo Yii::app()->baseUrl;?>/index.php/home/Default/dashboard">控制面板</a>
              <div class="last"></div>
			</li>    
          </ul>
          <div id="tabscontrol"></div>
      </div>
</div> 
<ul id="tabslist"></ul>

<div class="ui-layout-west">
    
    <div class="west-north">
        <div class="no-scrollbar no-padding west-header-bg">	
            <div id="app-searchbox" class="app-inset">
                    <form action="#">
                        <input type="text" class="app-search-input" />
                        <input type="submit" class="app-search-submit" />
                  </form>
             </div>
        </div>
    </div>
    <div class="west-center">

        <div id="accordion-west" class="full-height">
                <h3><a href="#">基础数据</a></h3>
                <div class="app-inset">
                 <?php $this->widget('zii.widgets.CMenu',array(
                                    'id'=>'menulist', 
                                    'activeCssClass'=>'menu-active',
                                    'lastItemCssClass'=>'last',
                                    'activateParents'=>true,
                                    'items'=>array(
                 					array('label'=>'控制面板', 'url'=>array('/home/default') ,'linkOptions'=>array('class'=>'icon-home')),
                                   array('label'=>'组织架构', 'url'=>array('/admin/companyorganisation/index'),'linkOptions'=>array('class'=>'icon-user'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Index')),
array('label'=>'系统用户', 'url'=>array('/users/user'),'linkOptions'=>array('class'=>'icon-user'),'visible'=>Yii::app()->user->checkAccess('users.user.Index')),
                                  array('label'=>'合作伙伴', 'url'=>array('/users/user/partner') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('users.user.partner')),
  array('label'=>'合作伙伴公司', 'url'=>array('/admin/Cooperativecompany/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('admin.Cooperativecompany.index')),
								array('label'=>'权限管理', 'url'=>array('/rights'),'linkOptions'=>array('class'=>'icon-user'),'visible'=>Yii::app()->user->checkAccess('users.user.Index')),
	array('label'=>'项目模板', 'url'=>array('/admin/template/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('admin.template.index')),
									array('label'=>'标准任务库', 'url'=>array('/admin/standardtask/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.index')),
array('label'=>'知识标签', 'url'=>array('/admin/tag/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('admin.tag.index')),									
array('label'=>'知识库管理', 'url'=>array('/knowledge/knowledge/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledge.index')),									
									array('label'=>'知识库目录', 'url'=>array('/knowledge/knowledgecatalogue/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledgecatalogue.index')),
									array('label'=>'项目列表', 'url'=>array('/Item/item/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('Item.item.index')),								
									array('label'=>'所有项目成果', 'url'=>array('/Item/resultdocument/allindex') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('Item.item.allindex')),
									array('label'=>'所有项目文档', 'url'=>array('/Item/resultdocument/alldoc') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.alldoc')),
									array('label'=>'所有非项目成果', 'url'=>array('/noitem/resultdocument/alldoc') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('noitem.resultdocument.alldoc')),
									array('label'=>'站点配置', 'url'=>array('/settings/settings/list'),'linkOptions'=>array('class'=>'icon-settings'),'visible'=>Yii::app()->user->checkAccess('settings.settings.index')),
							   )
                )); ?>					
                </div>
               <?php print_r(Yii::app()->user->GetItemMenu());?>
                <h3><a href="#">非项目</a></h3>
                <div class="app-inset">
                 <?php $this->widget('zii.widgets.CMenu',array(
                                    'id'=>'menulist', 
                                    'activeCssClass'=>'menu-active',
                                    'lastItemCssClass'=>'last',
                                    'activateParents'=>true,
                                    'items'=>array(
									array('label'=>'日历', 'url'=>array('/noitem/task/index') ,'linkOptions'=>array('class'=>'icon-home')),
                                    array('label'=>'任务库', 'url'=>array('/noitem/task/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('noitem.task.index')),
                                    array('label'=>'成果库', 'url'=>array('/noitem/resultdocument/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('noitem.resultdocument.index')),
									array('label'=>'日志', 'url'=>array('/report/Workrecord/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('report.Workrecord.index')),
							   )
                  )); ?>					
                </div>
    
                <h3><a href="#">知识库</a></h3>
    
                <div class="app-inset">
                 <?php $this->widget('zii.widgets.CMenu',array(
                                    'id'=>'menulist', 
                                    'activeCssClass'=>'menu-active',
                                    'lastItemCssClass'=>'last',
                                    'activateParents'=>true,
                                    'items'=>array(
                                    array('label'=>'索引', 'url'=>array('/knowledge/know/gird') ,'linkOptions'=>array('class'=>'icon-home')),
									array('label'=>'知识库', 'url'=>array('/knowledge/knowledge/show') ,'linkOptions'=>array('class'=>'icon-home')),
							   )
                )); ?>					
                </div>
                
                <h3><a href="#">消息中心</a></h3>
    
               <div class="app-inset">
                 <?php $this->widget('zii.widgets.CMenu',array(
                                    'id'=>'menulist', 
                                    'activeCssClass'=>'menu-active',
                                    'lastItemCssClass'=>'last',
                                    'activateParents'=>true,
                                    'items'=>array(
                                    array('label'=>'新建消息', 'url'=>array('/msg/msgfrom/create') ,'linkOptions'=>array('class'=>'icon-home')),
                                    array('label'=>'发件箱', 'url'=>array('/msg/msgfrom/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('msg.msgfrom.index')),
                                    array('label'=>'收件箱', 'url'=>array('/msg/msgto/index') ,'linkOptions'=>array('class'=>'icon-home'),'visible'=>Yii::app()->user->checkAccess('msg.msgto.index')),
							   )
                )); ?>					
                </div>
                
                <h3><a href="#">报表中心</a></h3>
    
                <div class="app-inset">
                 <?php $this->widget('zii.widgets.CMenu',array(
                                    'id'=>'menulist', 
                                    'activeCssClass'=>'menu-active',
                                    'lastItemCssClass'=>'last',
                                    'activateParents'=>true,
                                    'items'=>array(
                                    array('label'=>'员工成果、文档、知识统计', 'url'=>array('/reports/Item/create') ,'linkOptions'=>array('class'=>'icon-home')),
                                    array('label'=>'目的成果统计，文档统计，知识库统计', 'url'=>array('/report/workrecord/index') ,'linkOptions'=>array('class'=>'icon-home')),
                                    array('label'=>'员工日志', 'url'=>array('/report/workrecord/list') ,'linkOptions'=>array('class'=>'icon-home')),
							   )
                )); ?>					
                </div>
                
                <h3><a href="#">历史项目</a></h3>
    
                <div class="app-inset">
                 <?php $this->widget('zii.widgets.CMenu',array(
                                    'id'=>'menulist', 
                                    'activeCssClass'=>'menu-active',
                                    'lastItemCssClass'=>'last',
                                    'activateParents'=>true,
                                    'items'=>array(
                                    array('label'=>'企业公司上市', 'url'=>array('/Item/Item/create') ,'linkOptions'=>array('class'=>'icon-home')),
                                	)
                )); ?>					
                </div>
        </div>
    
    
    </div>
	
</div>

<div class="ui-layout-center">

        <div class="ui-layout-content" id="iframelist">
		<?php //echo $content; ?>
            <iframe id="tabs-content-0" class="iframe-page" name="tabsCenter0" src="<?php echo Yii::app()->baseUrl;?>/index.php/home/Default/dashboard" height="100%" frameborder="0" scrolling="auto"></iframe>
			
        </div>

    </div>


<div class="ui-layout-south ui-widget-content add-padding lightgray">
	
</div> 

</body>

</html>