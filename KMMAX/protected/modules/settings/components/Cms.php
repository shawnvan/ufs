<?php

class Cms extends CApplicationComponent
{
    private static $ReturnCode;
    private static $ErrorCode;
    public function init(){}
    public function show404(){
        $ex = new CHttpException(404, 'Page not found');
        throw $ex;
    }
 
    public static function service($serviceId, $data, $unwrap = null){
        $tmp = explode('/', $serviceId);
        if (count($tmp) != 3) throw new Exception("Invalid service ID format {$serviceId}. The correct service ID format is module/service/action");
        $class = ucfirst($tmp[1]).'Service';
        Yii::import('application.modules.'.$tmp[0].'.components.'.$class, true);
        //Yii::import('application.modules.settings.components.SettingsService');
        //var_dump(Yii::import($tmp[0].'.components.'.$class, true));exit;
        if(!class_exists($class))
            throw new Exception("{$class} service is not found while trying to call service ID {$serviceId}");
        $service = new $class();

        if (!is_callable(array($service, $tmp[2])))
            throw new Exception("Function {$tmp[2]} is not found in {$class} service");
        $service->init($tmp[0]);

        $serviceResult = call_user_func(array($service, $tmp[2]), $data);
	
        $serviceResult->ServiceId = $serviceId;
		
        self::$ReturnCode = $serviceResult->ReturnCode;
        self::$ErrorCode = $serviceResult->ErrorCode;
        if (is_string($unwrap)) {
            return $serviceResult->ReturnedData[$unwrap];
        } elseif ($unwrap === TRUE) {
            return $serviceResult->ReturnedData;
        }
        return $serviceResult;
    }
    public static function rawService($serviceId, $data, $unwrap = null){
        $tmp = explode('/', $serviceId);
        if (count($tmp) != 3) throw new Exception("Invalid service ID format {$serviceId}. The correct service ID format is module/service/action");
        $class = ucfirst($tmp[1]).'Service';
        Yii::import($tmp[0].'.services.'.$class, true);
        if(!class_exists($class))
            throw new Exception("{$class} service is not found while trying to call service ID {$serviceId}");
        $service = new $class();
        if (!is_callable(array($service, $tmp[2])))
            throw new Exception("Function {$tmp[2]} is not found in {$class} service");
        $service->init($tmp[0]);
        $serviceResult = call_user_func(array($service, $tmp[2]), $data);
        $serviceResult->ServiceId = $serviceId;
        self::$ReturnCode = $serviceResult->ReturnCode;
        self::$ErrorCode = $serviceResult->ErrorCode;
        if (is_string($unwrap)) {
            return $serviceResult->ReturnedData[$unwrap];
        } elseif ($unwrap === TRUE) {
            return $serviceResult->ReturnedData;
        }
        return $serviceResult;
    }
}
?>
