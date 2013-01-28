<?php
class SettingService extends ServiceBase
{    
    /**
    * Override init() to set permissions for some privileged services
    * 
    * @param mixed $module
    */
    public function init($module){
        parent::init($module);
    }
    
    /**
    * Rebuild all module cache files and page and categogy caches
    */
    public function rebuildCache($params) {
        //Cms::service('Cms/Page/cache', array());
        //Cms::service('Cms/Category/cache', array());
        
        foreach(Yii::app()->Modules as $id => $params)
            $this->db2php(array('Module' => $id));
        
        return $this->result;
    }
    
    /**
    * Rebuild system cache or cache of a module
    * 
    * @param array $params
    *   - Module string Module name or system (Cms) cache if empty
    * @return ServiceResult
    */
    public function db2php($params){
    	
        $module = $this->getParam($params, 'Module', '');

        //For Cms module, save settings as system's settings
        if ($module == 'UFSBase' || $module == 'gii') $module = '';
        //Get module's params in DB
        //Yii::import('Cms.models.Setting', true);
        $params = Settings::model()->findAll("fModule = '{$module}'");

        $consts = '';
        $labelgroup=array();
        foreach($params as $param){
        	array_push($labelgroup,$param->fLabel);
            if (!is_numeric($param->fValue)) $param->fValue = "'".addslashes($param->fValue)."'";
            $consts .= "\t//{$param->fDescription}\n\tpublic static $".str_pad($param->fName,48,' ')."= '{$param->fValue}';\n";
        }
        //循环出数组
        $labelgroup=array_unique($labelgroup);
        
        if(isset($labelgroup)){
	        foreach($labelgroup as $key=>$value){
	        	if($key>=2){
		        	$tempLabel= $labelgroup[$key].'List';
		        	$consts .= "\t//\n\tpublic static $".str_pad($tempLabel,48,' ')."= array(" ;
		        	foreach($params as $labelparam){
		        		if($labelparam->fLabel==$tempLabel){
		        			$consts .= "'".$labelparam->fName."'=>".$labelparam->fValue .",";
		        		}
		        	}
		        	
		        	$consts .= ");\n";
	        	}
	        }
        }
        
        $php = 
"<?php
/**
* DONOT modify this file as it's automatically generated based on setting parameters.
**/
class {$module}Settings{
{$consts}
}
?>";
        $filename = $module.'Settings.php';
        
        $path = yii::app()->getBasePath()."/runtime/cached/";
        if (!is_dir($path)){
            $this->result->fail(ServiceResult::ERR_SERVICE_SPECIFIC,'Folder utilities under the module/application folder does not exist.');
            return $this->result;
        }
        
        $f = fopen($path.$filename, 'w+');
        if ($f == false){
            $this->result->fail(ServiceResult::ERR_SERVICE_SPECIFIC,'Cannot create file under utilities folder.');
            return $this->result;
        }
        fwrite($f,$php);
        fclose($f);
        
        return $this->result;
    }
    
    /**
    * Reorder parameters
    * 
    * @param int $prevId: previous item's id
    * @param int $curId: current item's id
    * @param int $nextId: next item's id
    */
    public function reorder($params)
    {
        $tmp = $this->getParam($params, 'curId', null);
        
        $tmp = json_decode($tmp);
        
        if (! empty($tmp))
        {
            $module = $tmp->Module; // We got module name here
            $groupName = $tmp->GroupName; // We got group name here
            $curName = $tmp->Name;
        }
        else
        {
            throw new CHttpException(404, 'Invalid request');
        }
        
        $tmp = $this->getParam($params, 'prevId', null);
        $tmp = json_decode($tmp);
        if (! empty($tmp)){
            $prevName = $tmp->Name;
        }
        else
        {
            $prevName = '';
        }
        
        $tmp = $this->getParam($params, 'nextId', null);
        $tmp = json_decode($tmp);
        if (! empty($tmp)){
            $nextName = $tmp->Name;
        }
        else
        {
            $nextName = '';
        }
        
        
        $prevParam = Settings::model()->findByPk(array('fName'=>$prevName, 'fModule'=>$module));
        $curParam = Settings::model()->findByPk(array('fName'=>$curName, 'fModule'=>$module));
        $nextParam = Settings::model()->findByPk(array('fName'=>$nextName, 'fModule'=>$module));
        
        // Move an item to top
        if ($prevName == '')
        {
            // All items < current item move up
            Settings::model()->updateCounters(array('fSequence'=>1), "fModule=:Module AND fGroupName=:GroupName AND fSequence<:CurOrdering", array(":Module" => $module, ':GroupName' => $groupName, ':CurOrdering' => $curParam->fSequence));
            
            // Current page's ordering = 0
            $curParam->fSequence = 0;
            $curParam->save();
        }
        
        // Move an item to bottom
        elseif ($nextName == '')
        {
            // All item > current item move down
            Settings::model()->updateCounters(array('fSequence'=>-1), "fModule=:Module AND fGroupName=:GroupName AND Ordering>:CurOrdering", array(":Module" => $module, ':GroupName' => $groupName, ':CurOrdering' => $curParam->Ordering));
            
            // Current item ordering = prev ordering
            $curParam->fSequence = $prevParam->fSequence;
            $curParam->save();
        }
        
        else
        {
            // Move up
            if ($curParam->fSequence > $nextParam->fSequence)
            {
                Settings::model()->updateCounters(array('Ordering'=>1), "fModule=:Module AND fGroupName=:GroupName AND Ordering>:Begin AND Ordering<:End", array(":Module" => $module, ':GroupName' => $groupName, ':Begin' => $prevParam->Ordering, ':End' => $curParam->Ordering));
                $curParam->Ordering = $nextParam->Ordering;
                $curParam->save();
            }
            else
            {
                // Move down
                Settings::model()->updateCounters(array('Ordering'=>-1), "fModule=:Module AND fGroupName=:GroupName AND Ordering>:Begin AND Ordering<:End", array(":Module" => $module, ':GroupName' => $groupName, ':Begin' => $curParam->Ordering, ':End' => $nextParam->Ordering));
                $curParam->Ordering = $prevParam->fSequence;
                $curParam->save();
            }
            
        }
        
        return $this->result;
    }
    
    /**
    * Delete a parameter by id
    * 
    * @param int $paramId: Parameter id
    */
    public function delete($params)
    {
        $tmp = $this->getParam($params, 'paramId', null);
        $tmp = json_decode($tmp);
        
        if (! empty($tmp))
        {
            $module = $tmp->fModule; // We got module name here
            $groupName = $tmp->fGroupName; // We got group name here
            $name = $tmp->fName;
        }
        else
        {
            $this->result->fail(ServiceResult::ERR_INVALID_DATA, Yii::t('Page', 'PARAMETER_INVALID_INPUT'));
            return $this->result;
        }
        
        $param = Settings::model()->findByPk(array('Name'=>$name, 'Module'=>$module));
        if (is_null($param))
        {
            $this->result->fail(ServiceResult::ERR_INVALID_DATA, Yii::t('Page', 'PARAMETER_INVALID_INPUT'));
        }
        
        if (! $param->delete())
        {
            $this->result->fail(ServiceResult::ERR_INVALID_DATA, $this->normalizeModelErrors($param->Errors));
        }
        else
        {
            // Move up params
            Settings::model()->updateCounters(array('fSequence'=>-1), "fModule=:Module AND fGroupName=:GroupName AND fSequence>:Begin", array(":Module" => $module, ':GroupName' => $groupName, ':Begin' => $param->fSequence));
            $this->db2php(array());
        }
        return $this->result;
    }
    
    /**
    * create a new page
    * 
    * @param mixed $params
    */
    public function create($params)
    {
    	
        $param = new Settings();
        $this->getModel($params, $param);
       
        if ($param->fModule == 'System'){
            $param->fModule = '';
        }
        
        // Get max ordering in a group
        $sql = "
                SELECT MAX(fSequence)
                FROM tbl_settings
                WHERE fModule=:Module AND fGroupName=:GroupName
                ";
        $con = Yii::app()->db;
        $command = $con->createCommand($sql);
        
        $maxOrdering = $command->queryScalar(array(':Module'=>$param->fModule, ':GroupName'=>$param->fGroupName));
        $param->fSequence = $maxOrdering+1;

        $temp = Settings::model()->findByPk(array('fName'=>$param->fName, 'fModule'=>$param->fModule));

        if (! is_null($temp))
        {
            $this->result->fail(ServiceResult::ERR_INVALID_DATA, Yii::t('Parameter', 'PARAMETER_EXISTS'));
            //ErrorHandler::logErrors(array(Yii::t('Parameter', 'PARAMETER_EXISTS')));
            
            return $this->result;
        }
        
        if ($this->result->isFailed())
        {
            return $this->result;
        }
        
        if (! $param->save())
        {
            $this->result->fail(ServiceResult::ERR_INVALID_DATA, $this->normalizeModelErrors($param->Errors));
        }
        else
        {
            $this->db2php(array());
        }
        
       
        return $this->result;
    }
    
    public function update($params)
    {
        $param = new Setting();
        $this->getModel($params, $param);
        
        if ($param->Module == 'System'){
            $param->Module = '';
        }
        
        // Get old Name & Module
        $oldName = $this->getParam($params, 'OldName');
        $oldModule = $this->getParam($params, 'OldModule');
        if ($oldModule == 'System') $oldModule = '';
        
        if ($oldName == $param->Name && $oldModule == $param->Module)
        {
            // User didn't change primary key -> update as usual
            foreach($param->attributes as $key=>$attr)
            {
                if ($key !== 'Name' && $key !== 'Module')
                {
                    $updatedFields[$key] = $param->$key;
                }
            }
            $result = Settings::model()->updateByPk(array('Name' => $oldName, 'Module' => $oldModule), $updatedFields);
            if (! $result)
            {
                $this->result->ReturnCode = ServiceResult::RETURN_FAILURE;
                $this->result->ErrorMessages = $param->getErrors();
                ErrorHandler::logErrors($this->result->ErrorMessages);
            }
            else
            {
                $this->db2php(array());
            }
        }
        else // User has changed primary key (Name or Module)
        {
            // Check if this new primary key exists or not
            $temp = Settings::model()->findByPk(array('Name'=>$param->Name, 'Module'=>$param->Module));
            
            if (! empty($temp))
            {
                $this->result->fail(ServiceResult::ERR_INVALID_DATA, Yii::t('Parameter', 'PARAMETER_EXISTS'));
                ErrorHandler::logErrors(array(Yii::t('Parameter', 'PARAMETER_EXISTS')));
                return $this->result;
            }
            // else
            // Delete old parameter
            Settings::model()->deleteByPk(array('Name' => $oldName, 'Module' => $oldModule));
            $param->Ordering = $this->getParam($params, 'OldOrdering');
            if (! $param->save())
            {
                $this->result->fail(ServiceResult::ERR_INVALID_DATA, $this->normalizeModelErrors($param->Errors));
            }
            else
            {
                $this->db2php(array());
            }
        }
        
        return $this->result;
    }
    
    /**
    * Set application locale. The locale information will be saved into browser's cookies
    * 
    * @param array $params
    *   - string locale Yii's locale ID format (langeId_regioanId, i.e. en_us)
    */
    public function setLocale($params){
        $locale = $this->getParam($params, 'locale', 'en_us');
        //Set cookies
        $localeCookie = new CHttpCookie('Locale', $locale);
        $localeCookie->expire = time() + 15*24*3600;
        Yii::app()->request->cookies['Locale'] = $localeCookie;
        //Set application langauge
        Yii::app()->setLanguage($locale);
        
        return $this->result;
    }
}
?>
