<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//$config = CMap::mergeArray(
require('UFSConfig.php');
return	array(	
		'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name'=>$appName,
		'defaultController' => 'home/default',
		'theme'=>'ufs',
		'preload'=>array('log'),
		'timeZone'=>'Asia/Chongqing',
		'charset'=>'utf-8',
		'import' => array(
			'application.components.ApplicationConfigBehavior',
			'application.components.ERememberFiltersBehavior',
			'application.components.EButtonColumnWithClearFilters',
			'application.components.ApplicationConfigBehavior',
 			'application.modules.admin.models.*',
 			'application.modules.item.models.*',
 			'application.modules.msg.models.*',
 			'application.modules.knowledge.models.*',
 			'application.modules.users.components.*',
			'application.modules.users.models.*',
 			'application.modules.rights.components.*',
			'application.modules.rights.models.*',
 			'application.common.*',
 			'application.extensions.*',
 			'application.service.*',
 			'application.modules.common.*',
 			'application.modules.Item.components.*',
 			'application.modules.Item.service.*',
 			'application.modules.settings.components.*',
 			'application.modules.settings.models.*',
 			'application.runtime.cached.*',
			'application.extensions.jqBarGraph.*',
			'ext.giix.components.*',
        ),		

		'behaviors' => array('ApplicationConfigBehavior'),

		'modules'=>array(
			// uncomment the following to enable the Gii tool
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'1',
        		
			),
			'UFSBase',
			'home',
			'users',
			'settings',	
			'order',
			'rights'=>array(	
				'class'=>'application.modules.rights.RightsModule',	
			),
			'admin',
			'settings',
			'msg',
			'knowledge',
			'msg', 
			'workflow',
			'Item',
			'noitem',
			'report',
		),
	
		
		// application components
		'components'=>array(
			'user'=>array(
				'class'=>'application.modules.users.components.WebUser',
				'allowAutoLogin'=>true,
				'loginUrl' =>  array('users/login'),
			),
			'authManager'=>array(
				'class'=>'application.modules.rights.components.RDbAuthManager',//认证类名称
				'defaultRoles'=>array('Guest'),
				//'defaultRoles'=>array('Guest','Authenticated'),	//默认角色		
				//'defaultRoles'=>array('guest'),//默认角色
				//'itemTable' => 'tbl_authitem',//认证项表名称
				//'itemChildTable' => 'tbl_authitemchild',//认证项父子关系
				//'assignmentTable' => 'tbl_authassignment',//认证项赋权关系
			),
			'db'=>array_merge(
                array(
                  'connectionString' => 'mysql:host=218.242.222.121;dbname=kmmax',
                //'connectionString' => 'mysql:host=localhost;dbname=kmmax',  
                    'emulatePrepare' => true,
                 /*   'username' => 'root',
				   'password' => '107587',  */
               		'username' => 'kernel',
                		'password' => '123456', 
                    'charset' => 'utf8',
                    'charset' => 'utf8',
					'tablePrefix' => 'tbl_',
					'enableParamLogging'=>true,
					'enableProfiling'=>true,
                ),
                array(
                    'schemaCachingDuration'=>84600
                )
            ),
			'urlManager'=>array(
				'urlFormat'=>'path',
				
				'rules' => array(
					'<controller:\w+>/<id:\d+>' => '<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
					'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				),
			),
			'cfile'=>array(
			     'class'=>'application.extensions.cfile.CFile',
			),
			'errorHandler'=>array(
				'errorAction'=>'home/default/error',
			),
			'log'=>array(
				'class'=>'CLogRouter',
				'routes'=>array(
//					'web'=>array(
//							'class'=>'CWebLogRoute',
//							'levels'=>'',//trace,info, error, warning
//							'categories'=>'system.db.*',
//							'showInFireBug'=>false //true/falsefirebug only - turn off otherwise
//					),
					/*   'file'=>array(
							'class'=>'CFileLogRoute',
							'levels'=>'error, warning, watch',
							'categories'=>'system.*',
					),
					'profile'=>array(
						'class' => 'CProfileLogRoute',
						'report'=>'summary',
					),  */
				),
			),
		//),
	),
'params'=>array(
		// this is used in contact page
		'sourceLanguage'=>'zh_cn',
		'language'=>'zh_cn',
		'adminEmail'=>$email,
		'adminModel'=>null,
		'profile'=>null,
		'uploadPath'=>$uploadurl,
		'loginuser'=>null,
		'roles'=>array(),
		'pagesize'=>20,
		'timeout'=>3600,
		'groups'=>array(),
		'logo'=>"uploads/logos/yourlogohere.png",
		'webRoot'=>__DIR__.DIRECTORY_SEPARATOR.'..',
		'trueWebRoot'=>substr(__DIR__,0,-17), 
		'registeredWidgets'=>array(
			'TimeZone' => 'Time Zone',
			'MessageBox'=>'Message Board',
			'QuickContact'=>'Quick Contact',
			'GoogleMaps'=>'Google Map',
			'ChatBox'=>'Chat',
			'NoteBox'=>'Note Pad',
			'ActionMenu'=>'My Actions',
			'TagCloud'=>'Tag Cloud',
			'OnlineUsers'=>'Active Users',
			'MediaBox' => 'Media',
			'DocViewer' => 'Doc Viewer',
			'TopSites' => 'Top Sites',
		),
		'currency'=>'',
		'version'=>$version,
		'edition'=>'',
		'buildDate'=>$buildDate,
		'IsDownLoad'=>array('N'=>'不可以下载','Y'=>'可以下载',),
		'UserType'=>array('U'=>'公司员工','P'=>'合作伙伴',),
		'itemStatus'=>array('0'=>'初始化','1'=>'正常运行','3'=>'关闭','4'=>'开放','5'=>'完成',),
		'delete'=>array('success'=>'删除成功','failure'=>'删除失败','IsActive'=>'使用中，不可删除',),
		'upload_path_all'=>'D:/xampp/htdocs/UFS/KMMAX/uploads/upload/',
		'upload_path_pdf'=>'D:/xampp/htdocs/UFS/KMMAX/uploads/pdf/',
		'upload_path_swf'=>'D:/xampp/htdocs/UFS/KMMAX/uploads/swf/',
		'upload_path'=>'D:/xampp/htdocs/UFS/KMMAX/uploads/upload',
		'item'=>array('init'=>array('theme'=>'新的项目','content'=>'领导下达了新的项目:%s'),
			'initupdate'=>array('theme'=>'项目更新','content'=>'领导更新了项目:%s'),),
			'task'=>array('create'=>array('theme'=>'新建任务','content'=>'任务名称%s'),
					  'new'=>array('theme'=>'新的任务','content'=>'任务名称%s'),
					      'confirm'=>array('theme'=>'项目任务确认','content'=>'项目任务:名称    %s'),
					 	  'feedback'=>array('theme'=>'项目任务更新','content'=>'任务名称%s'),
					'Middlefinished'=>array('theme'=>'项目任务完成','content'=>'任务名称%s'),
					'refusefinish'=>array('theme'=>'项目任务完成拒绝','content'=>'任务名称%s'),
					'finish'=>array('theme'=>'项目任务完成','content'=>'任务名称%s'),
					'refusefinish'=>array('theme'=>'项目任务完成拒绝','content'=>'任务名称%s'),
					'standard'=>array('theme'=>'项目任务申请入标准库','content'=>'任务名称%s'),),
            'res'=>array(
					'confirm'=>array('theme'=>'项目成果确认','content'=>'项目任务:名称    %s','memo'=>'成果确认并且同步的项目文档库'),
					),
			'doc'=>array(
					'agree'=>array('theme'=>'项目文档同意归档','content'=>'项目任务:名称    %s','memo'=>'sssss'),
					'refuse'=>array('theme'=>'项目文档拒绝归档','content'=>'项目任务:名称    %s','memo'=>'ssss'),
			),
			'standtask'=>array(
					'agree'=>array('theme'=>'标准任务同意归档','content'=>'任务名称    %s','memo'=>'sssss'),
					'refuse'=>array('theme'=>'标准任务拒绝归档','content'=>'任务名称    %s','memo'=>'理由: %s'),
			),
			'knw'=>array(
					'agree'=>array('theme'=>'知识文档同意归档','content'=>'文档名称    %s','memo'=>'sssss'),
					'refuse'=>array('theme'=>'知识文档拒绝归档','content'=>'文档名称    %s','memo'=>'ssss'),
			),
			'msg'=>array(
					'phone'=>array('theme'=>'下载通知','content'=>'请在输入框输入:   %s','memo'=>'sssss'),
			),
			'layouttype'=>array(
					'top'=>'top',
			),
			'notytype'=>array(
					'alert'=>'alert','information'=>'information','error'=>'error',
					'notification'=>'notification','success'=>'success',
			),
			'const'=>array('confirm'=>'分配人员已经确认',
			'feedback'=>'任务交互',
			'refusefinish'=>'拒绝完成申请','finish'=>'完成',
			'middlefinished'=>'任务完成申请','stop'=>'停止','goon'=>'重新开启'),
	),
);
//return $config;