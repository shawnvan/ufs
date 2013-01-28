<?php

/**
 * Helpers Class for whole CMS
 * 
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package backend.components
 */
class GxcHelpers {
    
    public static function loadDetailModel($model_name,$id){    
            $model=call_user_func(array($model_name, 'model'))->findByPk((int)$id);
            if($model===null)
                    throw new CHttpException(404,t('The requested page does not exist.'));
            return $model;	
    }
    
    public static function deleteModel($model_name,$id){
            if(Yii::app()->request->isPostRequest){
                    // we only allow deletion via POST request
                   GxcHelpers::loadDetailModel($model_name, $id)->delete();
                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            } else
                    throw new CHttpException(400,t('Invalid request. Please do not repeat this request again.'));
    }
    
    public static function getAvailableLayouts($render_view=false){
    	
			$cache_id= $render_view ? 'gxchelpers-available-layouts' : 'gxchelpers-available-layouts-false';
    		$layouts=Yii::app()->cache->get($cache_id);	    		 		
			
			if($layouts===false)
			{
			    //Need to implement Cache HERE                    
	            $layouts = array();            
	            $folders = get_subfolders_name(Yii::getPathOfAlias('common.front_layouts')) ;    
	            foreach($folders as $folder){
	                $temp=parse_ini_file(Yii::getPathOfAlias('common.front_layouts.'.$folder.'').DIRECTORY_SEPARATOR.'info.ini');
	                 if($render_view)
	                    $layouts[$temp['id']]=$temp['name'];
	                 else 
	                    $layouts[$temp['id']]=$temp;
	            }  
			    Yii::app()->cache->set($cache_id,$layouts,7200);
			}
			                             
            return $layouts;            
    }
	
	
    
    public static function getAvailableBlocks($render_view=false){
    		$cache_id= $render_view ? 'gxchelpers-available-blocks' : 'gxchelpers-available-blocks-false';
    		$blocks=Yii::app()->cache->get($cache_id);	
						
			if($blocks===false){
				                  
	            $blocks = array();            
	            $folders = get_subfolders_name(Yii::getPathOfAlias('common.front_blocks')) ;    
				
	            foreach($folders as $folder){
	                $temp=parse_ini_file(Yii::getPathOfAlias('common.front_blocks.'.$folder.'').DIRECTORY_SEPARATOR.'info.ini');
					
					
	                 if($render_view)
	                    $blocks[$temp['id']]=$temp['name'];
	                 else 
	                    $blocks[$temp['id']]=$temp;
	            }     
				Yii::app()->cache->set($cache_id,$blocks,7200);   
			}
			            
            return $blocks;
    }
	
	public static function getStorages($get_class=false){		
		$cache_id= $get_class ? 'gxchelpers-storages' : 'gxchelpers-storages-false';
    	$types=Yii::app()->cache->get($cache_id);		
		if($types===false){
			$temp=parse_ini_file(Yii::getPathOfAlias('common.storages.'.'').DIRECTORY_SEPARATOR.'info.ini');								
			$types=array();		
			foreach ($temp['storages'] as $key=>$value){
				if(!$get_class)
					$types[$key]=trim(ucfirst($key));
				else {
					$types[$key]=trim($value);
				}		
			}
			Yii::app()->cache->set($cache_id,$types,7200);
		}
				
		return $types;
	}
       
    
    public static function getAvailableContentType($render_view=false){
    		$cache_id= $render_view ? 'gxchelpers-content-types' : 'gxchelpers-content-types-false';
    		$types=Yii::app()->cache->get($cache_id);
				
			if($types===false){
				$types = array();            
	            $folders = get_subfolders_name(Yii::getPathOfAlias('common.content_type')) ;   						 
	            foreach($folders as $folder){
	                $temp=parse_ini_file(Yii::getPathOfAlias('common.content_type.'.$folder.'').DIRECTORY_SEPARATOR.'info.ini');
	                 if($render_view)
	                    $types[$temp['id']]=$temp['name'];
	                 else 
	                    $types[$temp['id']]=$temp;
	            }   
				Yii::app()->cache->set($cache_id,$types,7200);
			}                    
                
            			
            return $types;
    }
	
	public static function getClassOfContent($type){
			$cache_id='class-of-content-type'.$type;
			$class_name=Yii::app()->cache->get($cache_id);
			if($class_name===false){
				$types=self::getAvailableContentType();
				if(isset($types[$type])){
					$class_name=$types[$type]['class'];
					Yii::app()->cache->set($cache_id,$class_name,7200);
				} else {
					$class_name='Object';
				}	
			}
			
			return $class_name;
			
			
	}
	
	public static function getRemoteFile(&$resource,$model,&$process,&$message,$path,$ext,$changeresname=true,$max_size=ConstantDefine::UPLOAD_MAX_SIZE,$min_size=ConstantDefine::UPLOAD_MIN_SIZE,$allow=array()){
				
		if(GxcHelpers::remoteFileExists($path)){
			$storages=GxcHelpers::getStorages(true);		
			$upload_handle=new $storages[$model->where]($max_size,$min_size,$allow);									
			if(!$upload_handle->getRemoteFile($resource,$model,$process,$message,$path,$ext,true)){
				$model->addError('upload', $message);
			} else {
				$process=true;
				return true;
			} 
			
		} else {
			$process=false;
			$message=t('Remote file not exist');
			return false;
		}

	}


	public static function remoteFileExists($url) {
		$curl = curl_init($url);
	    
		//don't fetch the actual page, you only want to check the connection is ok
		curl_setopt($curl, CURLOPT_NOBODY, true);
	    
		//do request
		$result = curl_exec($curl);
	    
		$ret = false;
	    
		//if request did not fail
		if ($result !== false) {
		    //if request was ok, check response code
		    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
	    
		    if ($statusCode == 200) {
			$ret = true;   
		    }
		}
	    
		curl_close($curl);
	    
		return $ret;
	}
    
    public static function generateAvatarThumb($upload_name,$folder,$filename){		
            //Start to check if the File type is Image type, so we Generate Everythumb size for it
            if(in_array(strtolower(CFileHelper::getExtension($upload_name)),array('gif','jpg','png'))){
                
                //Start to create Thumbs for it                
                $sizes=AvatarSize::getSizes();
                foreach($sizes as $size){
                        if (!(file_exists(AVATAR_FOLDER.DIRECTORY_SEPARATOR.$size['id'].DIRECTORY_SEPARATOR.$folder) && (AVATAR_FOLDER.DIRECTORY_SEPARATOR.$size.DIRECTORY_SEPARATOR.$folder))){
                                        mkdir(AVATAR_FOLDER.DIRECTORY_SEPARATOR.$size['id'].DIRECTORY_SEPARATOR.$folder,0777,true);
                        }
                        
                        $thumbs = new ImageResizer(
                                AVATAR_FOLDER.DIRECTORY_SEPARATOR.'root'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR,
                                $filename,
                                AVATAR_FOLDER.DIRECTORY_SEPARATOR.$size['id'].DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR,
                                $filename,
                                $size['width'],
                                $size['height'],
                                $size['ratio'],
                                90,
                                '#FFFFFF');
                                $thumbs->output();

                }
            }
            
    }
    
    public static function getUserAvatar($size,$avatar,$default){
        if(($avatar!=null)&&($avatar!='')){
            return AVATAR_URL.'/'.$size.'/'.$avatar;
        } else {
            return $default;
        }
    }
	
	
	public static function renderTextBoxResourcePath($data){
		return '<input type="text" class="pathResource" value="'.$data->getFullPath().'" />';
	}
	
	public static function renderLinkPreviewResource($data){
		switch($data->resource_type){
			case 'image':
				return '<a href="'.$data->getFullPath().'" rel="prettyPhoto" title="'.$data->resource_name.'">'.t('View').'</a>';
				break;
			case 'video':
				return '<a href="'.app()->controller->backend_asset.'/js/jwplayer/player.swf?width=470&amp;height=320&flashvars=file='.$data->getFullPath().'" title="'.$data->resource_name.'" rel="prettyPhoto">'.t('View').'</a>';
				break;
			default:
				return '<a href="'.$data->getFullPath().'">'.t('View').'</a>';
				break;
				
		}
		
	}
	
	public static function getArrayResourceObjectBinding($ownid){
		       
			   
        $upload_files=array();
		
		
		if(!isset($_POST['upload_id_'.$ownid.'_link'])){
			$arr_file_link=array();						
			return $upload_files;
		} 
		if(!isset($_POST['upload_id_'.$ownid.'_resid'])){
			$arr_file_resid=array();
			return $upload_files;
		}
		
		if(!isset($_POST['upload_id_'.$ownid.'_type'])){
			$arr_file_type=array();
			return $upload_files;
		}
		
		$arr_file_link=isset($_POST['upload_id_'.$ownid.'_link']) ? $_POST['upload_id_'.$ownid.'_link'] : array() ;
		$arr_file_resid=isset($_POST['upload_id_'.$ownid.'_resid']) ? $_POST['upload_id_'.$ownid.'_resid'] : array() ;
		$arr_file_type=isset($_POST['upload_id_'.$ownid.'_type']) ? $_POST['upload_id_'.$ownid.'_type'] : array() ;
		if(count($arr_file_link)>0){
            for($i=0; $i<count($arr_file_link);$i++){
                $file=array();
                $file['link']=$arr_file_link[$i];                
                $file['resid']=$arr_file_resid[$i];
				$file['type']=$arr_file_type[$i];
                $upload_files[]=$file;
            }
    	} 			            	
		
		return $upload_files;   
	}
	
	public static function getResourceObjectFromDatabase($model,$key){
		$upload_files=array();		
		$resources=ObjectResource::model()->findAll(array(
									    'condition'=>'object_id = :obj and type = :type',
									    'order' =>'resource_id ASC',
									    'limit'=>$model->total_number_resource > 0 ? $model->total_number_resource : 1 ,
									    'params'=> array(':obj'=>$model->object_id,':type'=>$key)));
		if($resources & count($resources)>0){
			foreach($resources as $res) {
				if($find_resource=Resource::model()->findByPk($res->resource_id)){
					$file=array();
	                $file['link']=$find_resource->getFullPath();                
	                $file['resid']=$find_resource->resource_id;
					$file['type']=$find_resource->resource_type;
	                $upload_files[]=$file;
				}
				
			}
		}								
										
										
		return $upload_files;
		
	}
	
	public static function getObjectMeta($id,$meta){
		$object_meta=ObjectMeta::model()->find('(meta_object_id = :id) and (meta_key=:meta_key)',array(':id'=>$id,':meta_key'=>$meta));
		if($object_meta){
			return $object_meta->meta_value;
		} else {
			return null;
		}
	}
    
	/**
	 * Encode the text into a string which all white spaces will be replaced by $rplChar
	 * @param string $text	text to be encoded
	 * @param Char $rplChar character to replace all the white spaces
	 * @param boolean upWords	set True to uppercase the first character of each word, set False otherwise
	 */
	public static function encode($text, $rplChar='', $upWords=true)
	{
		$encodedText = null;
		if($upWords)
		{
			$encodedText = ucwords($text);
		}
		else 
		{
			$encodedText = strtolower($text);
		}
		
		if($rplChar=='')
		{
			$encodedText = preg_replace('/\s[\s]+/','',$encodedText);    // Strip off multiple spaces
			$encodedText = preg_replace('/[\s\W]+/','',$encodedText);    // Strip off spaces and non-alpha-numeric
		}
		else
		{
			$encodedText = preg_replace('/\s[\s]+/',$rplChar, $encodedText);    // Strip off multiple spaces
			$encodedText = preg_replace('/[\s\W]+/',$rplChar, $encodedText);    // Strip off spaces and non-alpha-numeric
			$encodedText = preg_replace('/^[\\'.$rplChar.']+/','', $encodedText); // Strip off the starting $rplChar
			$encodedText = preg_replace('/[\\'.$rplChar.']+$/','',$encodedText); // // Strip off the ending $rplChar
		}
		return $encodedText;
		
	}
	
	// Query Filter String from Litpi.com
	
	public static function queryFilterString($str)
		{
			//Use RegEx for complex pattern
			$filterPattern = array(
									'/select.*(from|if|into)/i',  // select table query, 
									'/0x[0-9a-f]*/i',				// hexa character
									'/\(.*\)/',						// call a sql function
									'/union.*select/i',				// UNION query
									'/insert.*values/i',		// INSERT query
									'/order.*by/i'				// ORDER BY injection
									);
			$str = preg_replace($filterPattern, '', $str);

			//Use normal replace for simple replacement
			$filterHaystack = array(
									'--',	// query comment
									'||',	// OR operator
									'\*',	// OR operator
									);

			$str = str_replace($filterHaystack, '', $str);
			return $str;
		}
	
	
	//XSS Clean Data Input from Litpi.com
	public static function xss_clean($data)
		{
			return $data;
			// Fix &entity\n;
			$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
			$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
			$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
			$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

			// Remove any attribute starting with "on" or xmlns
			$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

			// Remove javascript: and vbscript: protocols
			$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
			$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
			$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

			// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
			$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
			$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
			$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

			// Remove namespaced elements (we do not need them)
			$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

			do
			{
				// Remove really unwanted tags
				$old_data = $data;
				$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
			}
			while ($old_data !== $data);

			// we are done...
			return $data;
		}
	
		function curl_post_async($url, $params)
		{
		    foreach ($params as $key => &$val) {
		      if (is_array($val)) $val = implode(',', $val);
		        $post_params[] = $key.'='.urlencode($val);
		    }
		    $post_string = implode('&', $post_params);

		    $parts=parse_url($url);

		    $fp = fsockopen($parts['host'],
		        isset($parts['port'])?$parts['port']:80,
		        $errno, $errstr, 30);

		    $out = "POST ".$parts['path']." HTTP/1.1\r\n";
		    $out.= "Host: ".$parts['host']."\r\n";
		    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
		    $out.= "Content-Length: ".strlen($post_string)."\r\n";
		    $out.= "Connection: Close\r\n\r\n";
		    if (isset($post_string)) $out.= $post_string;

		    fwrite($fp, $out);
		    fclose($fp);
		}
		
		function curl_get_async($url, $params)
			{
			    foreach ($params as $key => &$val) {
			      if (is_array($val)) $val = implode(',', $val);
			        $post_params[] = $key.'='.urlencode($val);
			    }
			    $post_string = implode('&', $post_params);

			    $parts=parse_url($url);

			    $fp = fsockopen($parts['host'],
			        isset($parts['port'])?$parts['port']:80,
			        $errno, $errstr, 30);

			    $out = "GET ".$parts['path']." HTTP/1.1\r\n";
			    $out.= "Host: ".$parts['host']."\r\n";
			    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
			    $out.= "Content-Length: ".strlen($post_string)."\r\n";
			    $out.= "Connection: Close\r\n\r\n";
			    if (isset($post_string)) $out.= $post_string;

			    fwrite($fp, $out);
			    fclose($fp);
			}
		
	public static function getContentList($content_list_id, $max=null, $pagination=null, $return_type=ConstantDefine::CONTENT_LIST_RETURN_ACTIVE_RECORD) {
        		
			//Find the content list model first	
        	$model = ContentList::model()->findbyPk($content_list_id);        
        	$condition = 't.object_status = :status and t.object_date < :time';
        	$params = array(':status'=>ConstantDefine::OBJECT_STATUS_PUBLISHED, ':time'=>time()) ;
			
			
			                    
        	if (isset($model)) {
            	if ($model->type == ConstantDefine::CONTENT_LIST_TYPE_AUTO) {    //auto
                
	                $criteria_field = 'object_date DESC';                                                                         
	                
	                //object_type
	                if (isset($model->content_type)) {
	                    $content_types = $model->content_type;
	                    if ($content_types[0] != 'all') {	                        
	                        $condition .= ' AND (0';
	                        foreach ($content_types as $type) {
	                            $condition .= ' or object_type="'.$type.'"';
	                        }
	                        $condition .= ')';    
	                    }                         
	                }
                
                
	                //terms
	                
	                if (isset($model->terms)) {
	                    $content_terms = $model->terms;
	                    if ($content_terms[0] != '0') {	                        
	                        $condition .= ' AND (0';
	                        foreach ($content_terms as $term) {
	                            $condition .= ' or (object_id in (select object_id from `{{object_term}}` where term_id='.$term.'))';
	                        }
	                        $condition .= ')';    
	                    }    
	                } 
                                              
	                //criteria not newest
	                if ($model->criteria != ConstantDefine::CONTENT_LIST_CRITERIA_NEWEST) {
	                    $criteria_field = 'object_view DESC';                                             
	                      
	                }      
				
                if ($return_type == ConstantDefine::CONTENT_LIST_RETURN_DATA_PROVIDER && $model->number >=1) { 
                                        
                    $sort = new CSort('Object');
                    $sort->defaultOrder='t.object_date DESC';
                    $sort->attributes = array(
                            'object_view' => array(
                                    'asc'=>'object_view ASC',
                                    'desc'=>'object_view DESC',
                            ),
                            'object_date'=>array(
                                    'asc'=>'t.object_date ASC',
                                    'desc'=>'t.object_date DESC',
                            ),
                    );                    
                    
					
                    return new CActiveDataProvider('Object',array(
                                'criteria'=>array(
                                        'condition'=>$condition,
                                        'order'=>$criteria_field,
                                        'params'=>$params,
                                        'limit'=>isset($max)?$max:$model->number,                                
                                ),
                                'pagination'=>array(
                                        'pageSize'=>isset($max)?$max:$model->number*$model->paging, 
                                        'pageVar'=>'page'
                                ),
                                'sort'=>$sort,
                            ));                
                }

                
                return Object::model()->findAll(array(
                                        'condition'=>$condition,
                                        'params'=>$params,
                                        'order'=>$criteria_field,
                                        'limit'=>isset($max)?$max:$model->number,                
                                        ));
            }

			else {
				//manual
	            if (isset($model->manual_list)) {
	            						
	                $condition = '';
	                $manual_list = $model->manual_list;
	                $count = 0;
					
	                foreach ($manual_list as $manual_id) {	                    
	                    if ($count == 0) {
	                        $condition_string = $manual_id;
	                    } else 
	                        $condition_string .= ','.$manual_id;
	                    if (isset($max) && $count == $max)
	                       break;
	                    $count++;
	                }
					$condition = 'object_id IN ('.$condition_string.')';

	                if ($return_type == ConstantDefine::CONTENT_LIST_RETURN_DATA_PROVIDER && count($manual_list)>=1) { 
			
	                    return new CActiveDataProvider('Object',array(
	                               'criteria'=>array(	                               		   
	                                       'condition'=>$condition,
	                                       'params'=>$params,
	                                       'order'=>'FIELD(t.object_id, '.$condition_string.')'
	                               ),
	                               'pagination'=>array(
	                                       'pageSize'=>isset($max)?$max:$model->number*$model->paging, 
	                                       'pageVar'=>'page'
	                               ),
	                           ));
	                } 
	                
	                
	                return Object::model()->findAll(array(	                						
	                                        'condition'=>$condition,                                        
	                                        'params'=>$params,
	                                        'order'=>'FIELD(t.object_id, '.$condition_string.')'
	                                        ));
	            }
			}
            
        }   

		return null;              
    }
}
