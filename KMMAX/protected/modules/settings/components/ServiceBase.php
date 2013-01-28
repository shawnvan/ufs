<?php
class ServiceBase extends CComponent
{
    /**
    * Service result object
    * @var ServiceResult
    */
    protected $result;
    
    /**
    * Service permission array
    * A map of service method => friendly meaningful name + user roles which can execute the method
    * This array should include only method that need to be able to grant/revoke execution priviledge.
    * Public service don't need to be listed.
    * 
    * Sample: array(
    *   'method_name' => array('friendly method name','role1','role2',...),
    *   'method_name_hidden' => array('','role1','role2',...), //This method will not display on Service permission page because friendly method name is empty
    *   ...
    * )
    * 
    * @var array
    */
    
    public function __construct() {
        $this->result = new ServiceResult();    
    }
        
    public function init($module){
        Yii::import('application.modules.'.$module.'.models.*');
    }
        
    /**
    * Get a param passed into the service given its name 
    * 
    * @param mixed $params Service's param array
    * @param mixed $key name of the parameter to get value of
    * @param mixed $default default value if param is not passed into service
    * @param mixed $filter 
    * @return mixed
    */
    public function getParam($params, $key, $default = null, $filter = ''){
        $xinput = new XInput($params);
        return $xinput->getInput($key, $default,$filter);
    }
    
    /**
    * Extract the model data from service's parameters
    * 
    * @param mixed $params
    * @param mixed $model
    * @param mixed $scenario Set to null to bypass user input validation
    */
    public function getModel($params, &$model, $scenario = '', $allowNull = FALSE){
        $class = get_class($model);
        if (!array_key_exists($class, $params) && !$allowNull){
            //param for this model is not passed
            $this->result->fail(ServiceResult::ERR_INVALID_DATA, "Expected a {$class} parameter.");
        }
        
        $modelParams = @$params[$class];

        if (!is_array($modelParams) && !is_a($modelParams, 'CModel')){
            if (!$allowNull){
                $this->result->fail(ServiceResult::ERR_INVALID_DATA, "{$class} parameter is not in array or CModel format.");
                return $this->result;
              
            }else
                return;
        }else{    
            $this->result->ReturnedData[$class] = $model;
            //Save some RAM
            unset($params[$class]);
        }

        //Assign model attributes
        if (is_array($modelParams))
            foreach ($modelParams as $attr => $value)
                $model->$attr = $value;
        else
            $model = $modelParams;
        if (!is_null($scenario)){
            $model->scenario = $scenario;
            if (!$model->validate()){
                $this->result->fail(ServiceResult::ERR_INVALID_DATA, self::normalizeModelErrors($model->getErrors()));
            }
        }
    }    
    
    /**
    * Turn an array of array of errors into an simplifier array of error messages
    * 
    * Model object's getErrors() returns an array of attribute errors in which
    * each attribute is a key as point to an array of its errors.
    * 
    * @param mixed $errors
    */
    public function normalizeModelErrors($errors){
        $returnedErrors = array();
        foreach($errors as $attr => $arrErrors){
            //With each attribute, CModel return an array of its errors
            $returnedErrors = array_merge($returnedErrors, $arrErrors);
        }
        return $returnedErrors;
    }
}

?>