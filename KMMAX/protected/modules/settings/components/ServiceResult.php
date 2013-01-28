<?php
class ServiceResult{
    /**
    * Return constants
    */
    const RETURN_SUCCESS = 'R00'; //Service processed successfully
    const RETURN_INVALID_REQUEST = 'R01'; //Not a valid request
    const RETURN_FAILURE = 'R02'; //Service fail, whatever the error is, check ErrorCode for more details
    
    /**
    * Error constants
    */
    const ERR_NONE = 'E00'; //Service processed successfully
    const ERR_INVALID_DATA = 'E01'; //Invalid input parameter or violated data integrity in database
    const ERR_UNAUTHORIZED = 'E02'; //User doesn't have enough authorized privilege 
    const ERR_SESSION_ID = 'E03'; //User's session expired
    const ERR_SERVICE_SPECIFIC = 'E04'; //Specific service error, should come with specific error message
    const ERR_UNKNOWN = 'E99'; //Not sure what the error is about
    
    const FORMAT_JSON = 'json';
    const FORMAT_XML = 'xml';  //Not supported yet
    const FORMAT_HTML = 'html'; //Not supported yet
    const FORMAT_TEXT = 'text';
    
    
    public $ServiceId;
    public $ReturnCode;
    public $ErrorCode;
    public $ErrorMessages = array();
    public $ReturnedData = array();
    
    public function __construct($return = self::RETURN_SUCCESS, $error = self::ERR_NONE, $message = ''){
        $this->ReturnCode = $return;
        $this->ErrorCode = $error;
        if ($message != '')
            $this->ErorrMessages = array($message);
    }
    
    /**
    * Reset result to SUCCESS status
    * 
    * In a chained process where many service methods in a service
    * are executed, $this->result could fail at a step but the whole
    * step can be considered successful if the failure is managed.
    * We can call success() on this case with care!
    * 
    * If YII_DEBUG is TRUE, failure will be logged
    * 
    */
    public function success() {
        if (YII_DEBUG && $this->ReturnCode != self::RETURN_SUCCESS) 
            Yii::trace("Service result is reset to success status from failure\n".print_r($this->ErrorMessages,1));
        
        $this->ReturnCode = self::RETURN_SUCCESS;
        $this->ErrorCode = self::ERR_NONE;
        $this->ErrorMessages = array();
        
        return $this;
    }
    
    /**
    * Set a FAILURE status and reutrn the result
    * 
    * @param mixed $errorCode
    * @param mixed $errorMessages If null, get all errors logged while the service is processed
    */
    public function fail($errorCode, $errorMessages = null){
        $this->ReturnCode = self::RETURN_FAILURE;
        $this->ErrorCode = $errorCode;
        
        if ($errorMessages == null){
            $errorMessages = array();
            $errors = ErrorHandler::getUserExceptions();
            foreach($errors as $err)
                $errorMessages[] = $err->getErrorMessage();
        }
        
        $this->addErrorMessages($errorMessages);
        return $this;
    }
    
    public function isFailed(){
        return $this->ReturnCode != self::RETURN_SUCCESS;
    }
    
    /**
    * Add error messages to the current list of error messagess
    * 
    * @param mixed $errorMessages
    */
    public function addErrorMessages($errorMessages){
        if (!is_string($errorMessages) && !is_array($errorMessages)) return;
        if(is_array($errorMessages))
            $this->ErrorMessages = array_merge($this->ErrorMessages, $errorMessages);
        else
            $this->ErrorMessages = array_merge($this->ErrorMessages, array($errorMessages));
    }
    
    /**
    * Return JSON string of this service result. 
    * 
    */
    public function toJson($simplified = 0){
        if ($simplified){
            $jsonString = json_encode($this->normalizeData($this->ReturnedData));
            return "({$jsonString})";
        }
        
        $tmp = $this->ReturnedData;
        
        $this->ReturnedData = $this->normalizeData($this->ReturnedData);
        $jsonString = json_encode($this);
        
        $this->ReturnedData = $tmp;
        return "({$jsonString})";
    }
    
    /**
    * Return TEXT string of this service result.
    * 
    * For serialized data, JS consumer can unserilize it if using tool such as PhpJs
    * See http://phpjs.org/pages/home for mor detail.
    * 
    * FlexicaCMS use php.default.namespaced.min.js
    */
    public function toText(){                
        if (is_string($this->ReturnedData)) return $this->ReturnedData;
        return serialize($this->ReturnedData);
    }
    
    /**
    * Normalize a $data variable to be able to convert it into JSON with json_encode()
    * 
    * @param mixed $data
    */
    protected function normalizeData($data){
        if (is_array($data)){
            $ret = array();
            foreach($data as $key => $value){
                if (is_array($value))
                    $ret[$key] = $this->normalizeData($value);
                elseif(is_a($value,'CActiveRecord'))
                    $ret[$key] = $value->attributes;
                else
                    $ret[$key] = $value;
            }
            return $ret;
        }elseif(is_a($data, 'CActiveRecord')){
            return $data->attributes;
        }else
            return $data;
    }
}
?>
