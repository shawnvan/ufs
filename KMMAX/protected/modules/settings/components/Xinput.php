<?php

/**
* Filter input data for XSS protection and purified HTML content
*/
class XInput{
    /**
    * Array that contain input data
    * Possible values: $_POST, $_GET, $_COOKIE
    * 
    * @var mixed
    */
    protected $data;
    
    /**
    * Filter options
    * 
    * - xss: clean xss code
    * - notag: strip tags
    * - newline: standardize newline character
    * 
    * @var mixed
    */
    protected $filters = array('xss', 'notag', 'newline');
    
    public function __construct($data){
        $this->data = &$data;
    }
    
    public function getInput($name, $defaultValue = null, $filter = ''){
        if (is_array($parsedName = $this->parseName($name))){
            $name = $parsedName[0];                         
            $key = $parsedName[1];
        }
        
        if (!array_key_exists($name, $this->data))
            return $defaultValue;
        else{
            $value = $this->data[$name];
            if (isset($key) && is_array($value)) $value = $value[$key];
            if (is_null($value)) return $defaultValue;
        }
            
        //Run filters
        if (is_string($value) || is_array($value)){
            foreach($this->filters as $flt){
                $value = call_user_func(array($this, $flt), $value, $filter);
            }
        }
        if (is_array($value)) return $value;
        //Convert to expected type
        if (is_null($defaultValue)) return $value;
        
        if (is_string($defaultValue)) return CPropertyValue::ensureString($value);
        if (is_int($defaultValue)) return CPropertyValue::ensureInteger($value);
        if (is_numeric($defaultValue)) return CPropertyValue::ensureFloat($value);
        
        if (is_array($defaultValue))
            if (!is_array($value)) 
                return array($value);
            else 
                return $value;
        
        return $value;
    }
    
    /**
    * Parse the name in case it's posted in form of $_POST['Article']['Id']
    * In this case, the name is Article[Id]
    * 
    * @param mixed $name
    * @return array
    */
    protected function parseName($name){
        if (preg_match('/(\w+)\[(\w+)\]/', $name, $matches))
            return array($matches[1], $matches[2]);
        else
            return $name;
    }
    
    protected function xss($value, $filter){
        $purifier = new CHtmlPurifier();
        if (!is_array($value))
            return $purifier->purify($value);
        else{
            foreach($value as $k => &$v)
                $v = $purifier->purify($v);
            return $value;
        }
    }
    
    protected function notag($value, $filter){
        if (strpos($filter, 'tag') !== false) 
            return $value;
        else
            if (!is_array($value))
                return strip_tags($value);
            else{
                foreach($value as $k => &$v)
                    $v = strip_tags($v);
                return $value;            
            }
    }
    
    protected function newline($value, $filter){
        if (!is_array($value)){
            $value = str_replace("\n\r","\n", $value);
            $value = str_replace("\r","\n", $value);
            return $value;
        }else{
                foreach($value as $k => &$v){
                    $v = str_replace("\n\r","\n", $v);
                    $v = str_replace("\r","\n", $v);
                }
                return $value;            
        }
    }
}
?>