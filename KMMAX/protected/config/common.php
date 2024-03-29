<?php
    $common_config = array(
        'basePath'          => COMMON_ROOT . DIRECTORY_SEPARATOR . 'protected',
        'name'              => 'ZurmoCRM',
        'defaultController' => 'home/default/welcome',
        'sourceLanguage'    => 'en',

        'behaviors' => array(
            'onBeginRequest' => array(
                'class' => 'application.modules.UFSBase.components.BeginRequestBehavior'
            ),
            'onEndRequest' => array(
                'class' => 'application.modules.UFSBase.components.EndRequestBehavior'
            )
        ),

        'components' => array(
            'minScript' => array(
                'class' => 'application.extensions.zurmoinc.framework.components.ZurmoExtMinScript',
                'groupMap' => array(
                    'css' => array(
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'themes/THEME_NAME/css/newui.css',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'themes/THEME_NAME/css/jquery-multiselect.css',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/timepicker/assets/jquery-ui-timepicker-addon.css'
                    ),

                    'js' => array(
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . '/../yii/framework/web/js/source/jquery.min.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . '/../yii/framework/web/js/source/jquery.yii.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . '/../yii/framework/web/js/source/jquery.ba-bbq.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . '/../yii/framework/web/js/source/jui/js/jquery-ui.min.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . '/../yii/framework/web/js/source/jquery.yiiactiveform.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/qtip/assets/jquery.qtip-2.min.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/extendedGridView/jquery.yiigridview.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/fusionChart/jquery.fusioncharts.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/elements/assets/Modal.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/views/assets/FormUtils.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/views/assets/ListViewUtils.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/views/assets/interactions.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/views/assets/dropDownInteractions.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/views/assets/jquery.dropkick-1.0.0.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/rssReader/jquery.zrssfeed.min.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/juiportlets/JuiPortlets.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/jnotify/jquery.jnotify.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/juiMultiSelect/jquery.multiselect.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/fileUpload/jquery.fileupload.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/fileUpload/jquery.fileupload-ui.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/fileUpload/jquery.tmpl.min.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/fileUpload/jquery.iframe-transport.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/timepicker/assets/jquery-ui-timepicker-addon.min.js',
                        INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'protected/extensions/zurmoinc/framework/widgets/assets/calendar/Calendar.js'
                    )
                ),
                //Add scripts here that do not need to load when using an ajax request such as a modal search box.  The scripts
                //are already loaded in the minified script that loads on every page.
                'usingAjaxShouldNotIncludeJsPathAliasesAndFileNames' => array(
                    array('system.web.js.source',                                       '/jquery.min.js'),
                    array('system.web.js.source',                                       '/jquery.yii.js'),
                    array('system.web.js.source',                                       '/jquery.ba-bbq.js'),
                    array('system.web.js.source',                                       '/jui/js/jquery-ui.min.js'),
                    array('system.web.js.source',                                       '/jquery.yiiactiveform.js'),
                    array('application.extensions.qtip.assets',                         '/jquery.qtip-2.min.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/extendedGridView/jquery.yiigridview.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/fusionChart/jquery.fusioncharts.js'),
                    array('application.extensions.zurmoinc.framework.elements.assets',  '/Modal.js'),
                    array('application.extensions.zurmoinc.framework.views.assets',     '/FormUtils.js'),
                    array('application.extensions.zurmoinc.framework.views.assets',     '/ListViewUtils.js'),
                    array('application.extensions.zurmoinc.framework.views.assets',     '/interactions.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/rssReader/jquery.zrssfeed.min.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/juiportlets/JuiPortlets.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/jnotify/jquery.jnotify.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/juiMultiSelect/jquery.multiselect.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/fileUpload/jquery.fileupload.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/fileUpload/jquery.fileupload-ui.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/fileUpload/jquery.tmpl.min.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/fileUpload/jquery.iframe-transport.js'),
                    array('application.extensions.timepicker.assets',                   '/jquery-ui-timepicker-addon.min.js'),
                    array('application.extensions.zurmoinc.framework.widgets.assets',   '/calendar/Calendar.js')
                ),
            ),
            'languageHelper' => array(
                'class'          => 'application.modules.zurmo.components.ZurmoLanguageHelper',
            ),
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class'  => 'CFileLogRoute',
                        'levels' => 'error, warning',
                    ),
                ),
            ),
            'mappingHelper' => array(
                'class' => 'application.modules.maps.components.ZurmoMappingHelper',
            ),
            'pagination' => array(
                'class' => 'application.modules.zurmo.components.ZurmoPaginationHelper',
                'listPageSize'             => 10,
                'subListPageSize'          => 5,
                'modalListPageSize'        => 5,
                'massEditProgressPageSize' => 5,
                'autoCompleteListPageSize' => 5,
                'importPageSize'           => 50,
                'dashboardListPageSize'    => 5,
                'apiListPageSize'          => 10,
                'unlimitedPageSize'        => 1000000000
            ),
            'performance' => array(
                'class'          => 'application.extensions.zurmoinc.framework.components.PerformanceMeasurement',
            ),
            'sanitizer' => array(
                'class'          => 'application.extensions.esanitizer.ESanitizer',
                'sanitizeGet'    => false, //off for now
                'sanitizePost'   => false, //off for now
                'sanitizeCookie' => false, //off for now
            ),
            'session' => array(
                'class'     => 'application.modules.zurmo.components.ZurmoSession',
                'autoStart' => false,
            ),
            'themeManager' => array(
                'basePath' => INSTANCE_ROOT . DIRECTORY_SEPARATOR . 'themes',
            ),
            'timeZoneHelper' => array(
                'class' => 'application.modules.zurmo.components.ZurmoTimeZoneHelper',
                'timeZone'             => 'America/Chicago',
            ),
            'request' => array(
                'enableCsrfValidation' => true,
                'enableCookieValidation' => false, //keep off until we can fix it on linux/windows servers.
            ),
            'statePersister' => array(
                'class'     => 'application.modules.zurmo.components.ZurmoDbStatePersister',
            ),
            'urlManager' => array (
                'urlFormat' => 'path',
                'caseSensitive' => true,
                'showScriptName' => true,
                'rules' => array(
                    // API REST patterns
                    array('zurmo/api/logout',      'pattern' => 'zurmo/api/logout',                    'verb' => 'GET'),    // Not Coding Standard
                    array('<module>/api/read',     'pattern' => '<module:\w+>/api/read/<id:\d+>',      'verb' => 'GET'),    // Not Coding Standard
                    array('<module>/api/list',     'pattern' => '<module:\w+>/api/list/*',             'verb' => 'GET'),    // Not Coding Standard
                    array('<module>/api/update',   'pattern' => '<module:\w+>/api/update/<id:\d+>',    'verb' => 'PUT'),    // Not Coding Standard
                    array('<module>/api/delete',   'pattern' => '<module:\w+>/api/delete/<id:\d+>',    'verb' => 'DELETE'), // Not Coding Standard
                    array('<module>/api/create',   'pattern' => '<module:\w+>/api/create/',            'verb' => 'POST'),   // Not Coding Standard

                    array('zurmo/<model>Api/read', 'pattern' => 'zurmo/<model:\w+>/api/read/<id:\d+>', 'verb' => 'GET'),    // Not Coding Standard
                    array('zurmo/<model>Api/read', 'pattern' => 'zurmo/<model:\w+>/api/read/<id:\w+>', 'verb' => 'GET'),    // Not Coding Standard
                    array('zurmo/<model>Api/list', 'pattern' => 'zurmo/<model:\w+>/api/list/*',        'verb' => 'GET'),    // Not Coding Standard
                    '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',                       // Not Coding Standard
                )
            ),
            'user' => array(
                'allowAutoLogin' => true,
                'class'          => 'WebUser',
                'loginUrl'       => array('zurmo/default/login'),
				'behaviors' => array(
					'onAfterLogin' => array(
						'class' => 'application.modules.gamification.behaviors.WebUserAfterLoginGamificationBehavior'
					),
				),
            ),
            'widgetFactory' => array(
                'widgets' => array(
                    'EJuiDateTimePicker' => array(
                        'cssFile' => false,
                    ),
                    'JuiDatePicker' => array(
                        'cssFile' => false,
                    ),
                    'CJuiDialog' => array(
                        'cssFile' => false,
                    ),
                    'CJuiProgressBar' => array(
                        'cssFile' => false,
                    ),
                    'CJuiAutoComplete' => array(
                        'cssFile' => false,
                    ),
                    'JuiSortable' => array(
                        'cssFile' => false,
                    ),
                ),
            ),
        ),
        'controllerMap' => array(
            'min' => 'application.extensions.minscript.controllers.ExtMinScriptController',
        ),
        'import' => array(
            'application.modules.zurmo.components.BeginRequestBehavior',
            'application.extensions.zurmoinc.framework.utils.ArrayUtil',
            'application.extensions.zurmoinc.framework.utils.FileUtil',
            'application.extensions.zurmoinc.framework.utils.GeneralCache',
            'application.extensions.zurmoinc.framework.exceptions.NotFoundException',
            'application.extensions.zurmoinc.framework.components.ZurmoLocale',
            'application.modules.api.tests.unit.models.*',
            'application.modules.api.tests.unit.forms.*',
            'application.modules.install.serviceHelpers.MemcacheServiceHelper',
            'application.modules.install.serviceHelpers.ServiceHelper',
            'application.modules.install.serviceHelpers.SetIncludePathServiceHelper',
            'application.modules.install.utils.InstallUtil',
        ),

        'modules' => array(
			'UFSBase',
            'api',
        ),

        'params' => array(
            'redBeanVersion'    => '1.3',
            'yiiVersion'        => '1.1.10',
            'memcacheServers'   => $memcacheServers,
            'supportedLanguages' => array(
                'en' => 'English',
                'es' => 'Spanish',
                'it' => 'Italian',
                'fr' => 'French',
                'de' => 'German',
            ),
        ),
        'preload' => array(
            'browser',
            'sanitizer'
        ),
    );

    // Routes for api test
    $testApiConfig['components']['urlManager']['rules'] = array(
        array('api/<model>Api/read',     'pattern' => 'api/<model:\w+>/api/read/<id:\d+>',   'verb' => 'GET'),    // Not Coding Standard
        array('api/<model>Api/list',     'pattern' => 'api/<model:\w+>/api/list/*',          'verb' => 'GET'),    // Not Coding Standard
        array('api/<model>Api/update',   'pattern' => 'api/<model:\w+>/api/update/<id:\d+>', 'verb' => 'PUT'),    // Not Coding Standard
        array('api/<model>Api/delete',   'pattern' => 'api/<model:\w+>/api/delete/<id:\d+>', 'verb' => 'DELETE'), // Not Coding Standard
        array('api/<model>Api/create',   'pattern' => 'api/<model:\w+>/api/create/',         'verb' => 'POST'),   // Not Coding Standard
        array('api/<model>Api/<action>', 'pattern' => 'api/<model:\w+>/api/<action>/*'),                          // Not Coding Standard
    );

    $common_config = CMap::mergeArray($testApiConfig, $common_config);
    return $common_config;
?>
