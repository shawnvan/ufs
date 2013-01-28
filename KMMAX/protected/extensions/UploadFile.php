<?php

/**
 +------------------------------------------------------------------------------
 * 文件上传类
 +------------------------------------------------------------------------------
 * @category   ORG
 * @package  ORG
 * @subpackage  Net
 * @version   $Id$
 +------------------------------------------------------------------------------
 */
class UploadFile 
{//类定义开始

	// 上传文件的最大值
	public $maxSize = -1;
	
	// 是否支持多文件上传
	public $supportMulti = true;
	
	// 允许上传的文件后缀
	//  留空不作后缀检查
	public $allowExts = array();
	
	// 允许上传的文件类型
	// 留空不做检查
	public $allowTypes = array();
	
	// 使用对上传图片进行缩略图处理
	public $thumb   =  false;
	// 缩略图最大宽度
	public $thumbMaxWidth = '100';
	// 缩略图最大高度
	public $thumbMaxHeight = '100';
	// 缩略图前缀
	public $thumbPrefix   =  'thumb_';
	public $thumbSuffix  =  '';
	// 缩略图保存路径
	public $thumbPath = '';
	// 缩略图文件名
	public $thumbFile		=	'';
	// 是否移除原图
	public $thumbRemoveOrigin = false;
	// 压缩图片文件上传
	public $zipImages = false;
	// 子目录创建方式 可以使用hash date
	public $subType   = 'hash';
	public $dateFormat = 'Ymd';
	public $hashLevel =  1; // hash的目录层次
	// 上传文件保存路径
	public $savePath = '';
	public $saveName = '';
	
	public $autoCheck = true; // 是否自动检查附件
	// 存在同名是否覆盖
	public $uploadReplace = false;
	
	// 上传文件命名规则
	// 例如可以是 time uniqid com_create_guid 等
	// 必须是一个无需任何参数的函数名 可以使用自定义函数
	public $saveRule = '';
	
	// 上传文件Hash规则函数名
	// 例如可以是 md5_file sha1_file 等
	public $hashType = 'md5_file';
	
	// 错误信息
	private $error = '';
	
	// 上传成功的文件信息
	private $uploadFileInfo ;
	

	/**
	 +----------------------------------------------------------
	 * 架构函数
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 */
	public function __construct($maxSize='',$allowExts='',$allowTypes='',$savePath='',$saveRule='')
	{
		if(!empty($maxSize) && is_numeric($maxSize)) {
			$this->maxSize = $maxSize;
		}
		if(!empty($allowExts)) {
			if(is_array($allowExts)) {
				$this->allowExts = array_map('strtolower',$allowExts);
			}else {
				$this->allowExts = explode(',',strtolower($allowExts));
			}
		}
		if(!empty($allowTypes)) {
			if(is_array($allowTypes)) {
				$this->allowTypes = array_map('strtolower',$allowTypes);
			}else {
				$this->allowTypes = explode(',',strtolower($allowTypes));
			}
		}
		if(!empty($saveRule)) {
			$this->saveRule = $saveRule;
		}else{
			$this->saveRule	=	time() + rand(1000,9999);
		}
		if(!empty($savePath)) {
			$this->savePath = $savePath;
		}else{
			$this->savePath	= Yii::app()->getBaseUrl().'/data/upload/';
		}
	}
	
	/**
	 +----------------------------------------------------------
	 * 上传一个文件
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param mixed $name 数据
	 * @param string $value  数据表名
	 +----------------------------------------------------------
	 * @return string
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	private function save($file)
	{
		$filename = $file['savepath'].$file['savename'];
		if(!$this->uploadReplace && is_file($filename)) {
			// 不覆盖同名文件
			$this->error	=	'文件已经存在！'.$filename;
			return false;
		}
		if(!move_uploaded_file($file['tmp_name'], $this->auto_charset($filename,'utf-8','gbk'))) {
			$this->error = '文件上传保存错误！';
			return false;
		}
		if($this->thumb) {
			// 生成图像缩略图
			$image = include(APPPATH.'../common/libraries/Image.php');
			if(false !== $image) {
				//是图像文件生成缩略图
				$thumbWidth		=	explode(',',$this->thumbMaxWidth);
				$thumbHeight		=	explode(',',$this->thumbMaxHeight);
				$thumbPrefix		=	explode(',',$this->thumbPrefix);
				$thumbSuffix = explode(',',$this->thumbSuffix);
				$thumbFile			=	explode(',',$this->thumbFile);
				$thumbPath    =  $this->thumbPath?$this->thumbPath:$file['savepath'];
				for($i=0,$len=count($thumbWidth); $i<$len; $i++) {
					$thumbname	=	$thumbPath.$thumbPrefix[$i].substr($file['savename'],0,strrpos($file['savename'], '.')).$thumbSuffix[$i].'.'.$file['extension'];
					$thumbImg = Image::thumb($filename,$thumbname,'',$thumbWidth[$i],$thumbHeight[$i],true);
				}
				if($this->thumbRemoveOrigin) {
					// 生成缩略图之后删除原图
					unlink($filename);
				}
			}
		}
		/*if($this->zipImags) {
		 // TODO 对图片压缩包在线解压
	
		}*/
	
		//由于很多时候，后台不需要水印，所以需要水印的在应用中自己实现，参考如下代码
		//require_cache(SITE_PATH."/addons/libs/WaterMark/WaterMark.php");
		//WaterMark::iswater($filename);
	
		return true;
	}
	
	/**
	 +----------------------------------------------------------
	 * 上传文件
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param string $savePath  上传文件保存路径
	 +----------------------------------------------------------
	 * @return string
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	public function upload($savePath ='')
	{
		
		if (!is_dir($savePath)){
			mkdir($savePath,0777,true);
		}
		//如果不指定保存文件名，则由系统默认
		if(empty($savePath)) {
			$savePath = $this->savePath;
		}
		
		// 检查上传目录
		if(!is_dir($savePath)) {
			// 检查目录是否编码后的
			if(is_dir(base64_decode($savePath))) {
				$savePath	=	base64_decode($savePath);
			}else{
				// 尝试创建目录
				if(!mkdir($savePath,0777,true)){
					$this->error  =  '上传目录'.$savePath.'不存在';
					return false;
				}
			}
		}else {
			if(!is_writeable($savePath)) {
				$this->error  =  '上传目录'.$savePath.'不可写';
				return false;
			}
		}
		
		$fileInfo = array();
		$isUpload   = false;
		
		// 获取上传的文件信息
		// 对$_FILES数组信息处理
		$files	 =	$this->dealFiles($_FILES);
		foreach($files as $key => $file) {
			 
			//过滤无效的上传
			if(!empty($file['name'])) {
				//登记上传文件的扩展信息
				$file['key']          =  $key;
				$file['extension']  = $this->getExt($file['name']);
				$file['savepath']   = $savePath;
				$file['savename']   = $this->getSaveName($file);
	
				// 自动检查附件
				if($this->autoCheck) {
					
					if(!$this->check($file))
						return false;
				}
	
				//保存上传文件
				if(!$this->save($file)) {
					return false;
				}
				if(function_exists($this->hashType)) {
					$fun =  $this->hashType;
					$file['hash']   =  $fun($this->auto_charset($file['savepath'].$file['savename'],'utf-8','gbk'));
				}
				//上传成功后保存文件信息，供其它地方调用
				unset($file['tmp_name'],$file['error']);
				$fileInfo[] = $file;
				$isUpload   = true;
			}
		}
		
		if($isUpload) {
			$this->uploadFileInfo = $fileInfo;
			return true;
		}else {
			$this->error  =  '没有选择上传文件';
			return false;
		}
	
	}
	
	/**
	 +----------------------------------------------------------
	 * 转换上传文件数组变量为正确的方式
	 +----------------------------------------------------------
	 * @access private
	 +----------------------------------------------------------
	 * @param array $files  上传的文件变量
	 +----------------------------------------------------------
	 * @return array
	 +----------------------------------------------------------
	 */
	private function dealFiles($files) {
		$fileArray = array();
		$test=array();
		foreach ($files as $file){
			
			if(is_array($file['name'])) {
				$keys = array_keys($file);
				$count	=	 count($file['name']);
				for ($i=0; $i<$count; $i++) {
					foreach ($keys as $key) {
						foreach (array_keys($file[$key]) as $subkey){
							$fileArray[$i][$key]=$file[$key][$subkey];
						}
					}
				}
			}else{
				$fileArray	=	$files;
			}
			break;
		}
		return $fileArray;
	}
	
	/**
	 +----------------------------------------------------------
	 * 获取错误代码信息
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param string $errorNo  错误号码
	 +----------------------------------------------------------
	 * @return void
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	public  function error($errorNo)
	{
		switch($errorNo) {
			case 1:
	
				$size = ini_get("upload_max_filesize");
				if( strpos($size,'M')!==false || strpos($size,'m')!==false ) {
					$size = intval($size)*1024;
					$size = byte_format( $size );
				}
				//edit by  yangjs
				if(isset($this->maxSize) && !empty($this->maxSize)){
					$size = byte_format($this->maxSize);
				}
				$this->error = '上传文件大小超过了'.$size;
				break;
			case 2:
				$size = ini_get("upload_max_filesize");
				if( strpos($size,'M')!==false || strpos($size,'m')!==false ) {
					$size = intval($size)*1024;
					$size = byte_format( $size );
				}
				//edit by  yangjs
				if(isset($this->maxSize) && !empty($this->maxSize)){
					$size = byte_format($this->maxSize);
				}
	
				$this->error = '上传文件大小超过了'.$size;
				break;
			case 3:
				$this->error = '文件只有部分被上传';
				break;
			case 4:
				$this->error = '没有文件被上传';
				break;
			case 6:
				$this->error = '找不到临时文件夹';
				break;
			case 7:
				$this->error = '文件写入失败';
				break;
			default:
				$this->error = $errorNo;
		}
		return $this->error;
	}
	
	/**
	 +----------------------------------------------------------
	 * 根据上传文件命名规则取得保存文件名
	 +----------------------------------------------------------
	 * @access private
	 +----------------------------------------------------------
	 * @param string $filename 数据
	 +----------------------------------------------------------
	 * @return string
	 +----------------------------------------------------------
	 */
	private function getSaveName($filename)
	{
		if($this->saveName){
			return $this->saveName;
		}else{
			$rule = time()+rand(1000,9999);
			//$rule = $this->saveRule;
			if(empty($rule)) {//没有定义命名规则，则保持文件名不变
				$saveName = $filename['name'];
			}else {
				if(function_exists($rule)) {
					//使用函数生成一个唯一文件标识号
					$saveName = $rule().".".$filename['extension'];
				}else {
					//使用给定的文件名作为标识号
					$saveName = $rule.".".$filename['extension'];
				}
			}
			return $saveName;
		}
	
	}
	
	
	/**
	 +----------------------------------------------------------
	 * 获取子目录的名称
	 +----------------------------------------------------------
	 * @access private
	 +----------------------------------------------------------
	 * @param array $file  上传的文件信息
	 +----------------------------------------------------------
	 * @return string
	 +----------------------------------------------------------
	 */
	private function getSubName($file)
	{
		switch($this->subType) {
			case 'date':
				$dir   =  date($this->dateFormat,time());
				break;
			case 'hash':
			default:
				$name = md5($file['savename']);
				$dir   =  '';
				for($i=0;$i<$this->hashLevel;$i++) {
					$dir   .=  $name{0}.'/';
				}
				break;
		}
		if(!is_dir($file['savepath'].$dir)) {
			$this->mk_dir($file['savepath'].$dir);
		}
		return $dir;
	}
	
	// 循环创建目录
	function mk_dir($dir, $mode = 0755)
	{
		if (is_dir($dir) || @mkdir($dir,$mode)) return true;
		if (!$this->mk_dir(dirname($dir),$mode)) return false;
		return @mkdir($dir,$mode);
	}
	
	/**
	 +----------------------------------------------------------
	 * 检查上传的文件
	 +----------------------------------------------------------
	 * @access private
	 +----------------------------------------------------------
	 * @param array $file 文件信息
	 +----------------------------------------------------------
	 * @return boolean
	 +----------------------------------------------------------
	 */
	private function check($file) {
		if($file['error']!== 0) {
			//文件上传失败
			//捕获错误代码
			$this->error($file['error']);
			return false;
		}
		//文件上传成功，进行自定义规则检查
		//检查文件大小
		if(!$this->checkSize($file['size'])) {
			$this->error = '上传文件大小不符！';
			return false;
		}
	
		//检查文件Mime类型
		if(!$this->checkType($file['type'])) {
			$this->error = '上传文件MIME类型不允许！';
			return false;
		}
		//检查文件类型
		if(!$this->checkExt($file['extension'])) {
			$this->error ='上传文件类型不允许';
			return false;
		}
	  
		//检查是否合法上传
		if(!$this->checkUpload($file['tmp_name'])) {
			print_r($file['tmp_name']);exit;
			$this->error = '非法上传文件！';
			return false;
		}
		return true;
	}
	
	/**
	 +----------------------------------------------------------
	 * 检查上传的文件类型是否合法
	 +----------------------------------------------------------
	 * @access private
	 +----------------------------------------------------------
	 * @param string $type 数据
	 +----------------------------------------------------------
	 * @return boolean
	 +----------------------------------------------------------
	 */
	private function checkType($type)
	{
		if(!empty($this->allowTypes)) {
			return in_array(strtolower($type),$this->allowTypes);
		}
		return true;
	}
	
	
	/**
	 +----------------------------------------------------------
	 * 检查上传的文件后缀是否合法
	 +----------------------------------------------------------
	 * @access private
	 +----------------------------------------------------------
	 * @param string $ext 后缀名
	 +----------------------------------------------------------
	 * @return boolean
	 +----------------------------------------------------------
	 */
	private function checkExt($ext)
	{
		if(!empty($this->allowExts)) {
			return in_array(strtolower($ext),$this->allowExts,true);
		}
		return true;
	}
	
	/**
	 +----------------------------------------------------------
	 * 检查文件大小是否合法
	 +----------------------------------------------------------
	 * @access private
	 +----------------------------------------------------------
	 * @param integer $size 数据
	 +----------------------------------------------------------
	 * @return boolean
	 +----------------------------------------------------------
	 */
	private function checkSize($size)
	{
		return !($size > $this->maxSize) || (-1 == $this->maxSize);
	}
	
	/**
	 +----------------------------------------------------------
	 * 检查文件是否非法提交
	 +----------------------------------------------------------
	 * @access private
	 +----------------------------------------------------------
	 * @param string $filename 文件名
	 +----------------------------------------------------------
	 * @return boolean
	 +----------------------------------------------------------
	 */
	private function checkUpload($filename)
	{
		return is_uploaded_file($filename);
	}
	
	/**
	 +----------------------------------------------------------
	 * 取得上传文件的后缀
	 +----------------------------------------------------------
	 * @access private
	 +----------------------------------------------------------
	 * @param string $filename 文件名
	 +----------------------------------------------------------
	 * @return boolean
	 +----------------------------------------------------------
	 */
	private function getExt($filename)
	{
		$pathinfo = pathinfo($filename);
		return $pathinfo['extension'];
	}
	
	/**
	 +----------------------------------------------------------
	 * 取得上传文件的信息
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @return array
	 +----------------------------------------------------------
	 */
	public function getUploadFileInfo()
	{
		return $this->uploadFileInfo;
	}
	
	/**
	 +----------------------------------------------------------
	 * 取得最后一次错误信息
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @return string
	 +----------------------------------------------------------
	 */
	public function getErrorMsg()
	{
		return $this->error;
	}
	
	//内部方法
	
	// 快速导入第三方框架类库
	// 所有第三方框架的类库文件统一放到 系统的Vendor目录下面
	// 并且默认都是以.php后缀导入
	function vendor($class,$baseUrl = '',$ext='.php')
	{
		if(empty($baseUrl))  $baseUrl    =   '';
		return $this->import($class,$baseUrl,$ext);
	}
	
	// 自动转换字符集 支持数组转换
	function auto_charset($fContents,$from,$to){
		$from   =  strtoupper($from)=='UTF8'? 'utf-8':$from;
		$to       =  strtoupper($to)=='UTF8'? 'utf-8':$to;
		if( strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents)) ){
			//如果编码相同或者非字符串标量则不转换
			return $fContents;
		}
		if(is_string($fContents) ) {
			if(function_exists('mb_convert_encoding')){
				return mb_convert_encoding ($fContents, $to, $from);
			}elseif(function_exists('iconv')){
				return iconv($from,$to,$fContents);
			}else{
				return $fContents;
			}
		}
		elseif(is_array($fContents)){
			foreach ( $fContents as $key => $val ) {
				$_key =   $this->auto_charset($key,$from,$to);
				$fContents[$_key] = $this->auto_charset($val,$from,$to);
				if($key != $_key )
					unset($fContents[$key]);
			}
			return $fContents;
		}
		else{
			return $fContents;
		}
	}
	
	/**
	 +----------------------------------------------------------
	 * 导入所需的类库 同java的Import
	 * 本函数有缓存功能
	 +----------------------------------------------------------
	 * @param string $class 类库命名空间字符串
	 * @param string $baseUrl 起始路径
	 * @param string $ext 导入的文件扩展名
	 +----------------------------------------------------------
	 * @return boolen
	 +----------------------------------------------------------
	 */
	function import($class,$baseUrl = '',$ext='.php')
	{
		static $_file = array();
		static $_class = array();
		$class    =   str_replace(array('.','#'), array('/','.'), $class);
		if('' === $baseUrl && false === strpos($class,'/')) {
			// 检查别名导入
			return $this->alias_import($class);
		}
		if(isset($_file[$class.$baseUrl]))
			return true;
		else
			$_file[$class.$baseUrl] = true;
		$class_strut = explode("/",$class);
		if(empty($baseUrl)) {
			// 加载其它项目应用类库
			$baseUrl =  str_replace("\\", "/", SITE_PATH).'/';
		}
		if(substr($baseUrl, -1) != "/")    $baseUrl .= "/";
		$classfile = $baseUrl . $class . $ext;
		if($ext == '.php' && is_file($classfile)) {
			// 冲突检测
			$class = basename($classfile,$ext);
			if(isset($_class[$class]))
				throw_exception(L('_CLASS_CONFLICT_').':'.$_class[$class].' '.$classfile);
			$_class[$class] = $classfile;
		}
		//导入目录下的指定类库文件
		return $this->require_cache($classfile);
	}
	
	// 优化的require_once
	function require_cache($filename)
	{
		static $_importFiles = array();
		$filename   =  realpath($filename);
		if (!isset($_importFiles[$filename])) {
			if($this->file_exists_case($filename)){
				require $filename;
				$_importFiles[$filename] = true;
			}
			else
			{
				$_importFiles[$filename] = false;
			}
		}
		return $_importFiles[$filename];
	}
	
	// 区分大小写的文件存在判断
	function file_exists_case($filename) {
		if(is_file($filename)) {
			if(IS_WIN && true) {
				if(basename(realpath($filename)) != basename($filename))
					return false;
			}
			return true;
		}
		return false;
	}
	// 快速定义和导入别名
	function alias_import($alias,$classfile='') {
		static $_alias   =  array();
		if('' !== $classfile) {
			// 定义别名导入
			$_alias[$alias]  = $classfile;
			return ;
		}
		if(is_string($alias)) {
			if(isset($_alias[$alias]))
				return $this->require_cache($_alias[$alias]);
		}elseif(is_array($alias)){
			foreach ($alias as $key=>$val)
				$_alias[$key]  =  $val;
			return ;
		}
		return false;
	}
	
}//类定义结束
?>