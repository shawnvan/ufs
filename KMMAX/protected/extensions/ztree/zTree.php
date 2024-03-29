<?php
/**
 * zTree class file.
 *
 * ztree Js扩展包
 * @author jake <jake451@163.com>
 * @link http://hi.baidu.com/jake451
 */
Yii::import('zii.widgets.jui.CJuiWidget');
/**
 *
 * ztree树形菜单
 * 
 * ztree扩展包使用方法:
 * <pre>
 * $this->widget('path.ztree.zTree',array(
 *              'treeNodeNameKey'=>'name',
 *              'treeNodeKey'=>'id',
 *              'treeNodeParentKey'=>'pId',
 *              'options'=>array(
 *                      'expandSpeed'=>"",
 *                      'showLine'=>true,
 *                      ),
 *              'data'=>array(
 *                      array('id'=>1, 'pId'=>0, 'name'=>'目录1'),
 *                      array('id'=>2, 'pId'=>1, 'name'=>'目录2'),
 *                      array('id'=>3, 'pId'=>1, 'name'=>'目录3'),
 *                      array('id'=>4, 'pId'=>1, 'name'=>'目录4'),
 *                      array('id'=>5, 'pId'=>2, 'name'=>'目录5'),
 *                      array('id'=>6, 'pId'=>3, 'name'=>'目录6')
 *              )
 * ));
 * </pre>
 *
 * 一、定义数据的两种方式：
 * 1、设置model属性后(model类名或者model对象)：
 *              数据获得方式则为$model->model()->findAll($this->criteria)
 *              例如：
 *                      1、array(
 *                              'model'=>'tree'
 *                      )
 *                      2、array(
 *                              'model'=>$model, //此处为一个model对象(需要是CModel的子类)
 *                      )
 * 2、设置data属性
 *              数据可以为数组，或者model的数据集(数组形式)
 *              例如：
 *                      1、array(
 *                              'data'=>array(
 *                                      array('id'=>1, 'pId'=>0, 'name'=>'目录1'),
 *                                      array('id'=>2, 'pId'=>1, 'name'=>'目录2'),
 *                                      array('id'=>3, 'pId'=>1, 'name'=>'目录3'),
 *                                      array('id'=>4, 'pId'=>1, 'name'=>'目录4'),
 *                                      array('id'=>5, 'pId'=>2, 'name'=>'目录5'),
 *                                      array('id'=>6, 'pId'=>3, 'name'=>'目录6')
 *                              )
 *                      )
 * 
 *                      2、array(
 *                              'data'=>tree::model()->findAll()
 *                      )
 *      二、提醒：
 *                      1、iconsCss属性请谨慎开启，在IE6下效率会比较低
 *                      2、width属性不填的话，背景层宽度与containerId宽度一样
 *
 */
class zTree extends CJuiWidget
{
        /**
         * 脚本文件列表
         * 
         * @var array|string
         */
        public $scriptFile=array('jquery.ztree.min.js');
        /**
         * 开启zTreeIcons样式
         * 需要支持IE6的话，谨慎开启此项
         * @var bool
         */
        public $iconsCss=false;
        /**
         * 样式文件列表
         * 
         * @var array|string
         */
        public $cssFile=array('zTreeStyle.css');
        /**
         * 数据
         * 
         * @var array|string
         */
        public $data='{}';
        /**
         * 容器宽度
         * 
         * @var int
         */
        public $width;
        /**
         * 容器高度
         * 
         * @var int
         */
        public $height;
        /**
         * 是否只允许选择子项
         * 
         * @var bool
         */
        public $onlySon=false;
        /**
         * 背景容器的ID名
         * 
         * @var string
         */
        public $backgroundId;
        /**
         * 背景容器
         * 默认为DIV，为空则没有背景层
         * @var string
         */
        public $backgroundTagName='div';
        /**
         * 背景容器HTML选项
         * 
         * @var array
         */
        public $backgroundHtmlOptions=array();
        /**
         * assets目录地址
         * 
         * @var string
         */
        public $baseUrl;
        /**
         * zTree数据的model名称
         * 设置此项，则为$model::model()->findAll($this->criteria)
         * @var string|object
         */
        public $model;
        /**
         * 查询条件
         * 设置model属性后生效
         * @var mixed
         */
        public $criteria;
        /**
         * 树形节点列名键名
         * 默认为name
         * @var string
         */
        public $treeNodeNameKey='name';
        /**
         * 树形节点ID键名
         * 
         * @var string
         */
        public $treeNodeKey;
        /**
         * 树形节点父ID键名
         * 
         * @var string
         */
        public $treeNodeParentKey;
        /**
         * 是否为普通数据
         * 
         * @var bool
         */
        public $isSimpleData=true;
        
        /**
         * 初始化
         * @see CJuiWidget::init()
         */
        public function init()
        {
        $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
        $this->baseUrl=Yii::app()->getAssetManager()->publish($path);
        $this->themeUrl = $this->scriptUrl      = $this->baseUrl;
        parent::init();
				$this->id = 'Treeobject';
                $this->htmlOptions['id']=$this->id;
                $this->htmlOptions['class']   = 'UFStree';
        
                if ($this->iconsCss)
                {
                        $this->cssFile[]        = 'zTreeIcons.css';
                }
                
                if ($this->treeNodeKey !== null)
                {
                        $this->options['treeNodeKey']           = $this->treeNodeKey;
                }
                if ($this->treeNodeParentKey !== null)
                {
                        $this->options['treeNodeParentKey']             = $this->treeNodeParentKey;
                }
                $this->options['isSimpleData']  = $this->isSimpleData;
                
                if ($this->width !== null)
                {
                        $this->backgroundHtmlOptions['style'] .= " width:{$this->width}px;";
                }
                if ($this->height !== null)
                {
                        $this->backgroundHtmlOptions['style'] .= " height:{$this->height}px;";
                }
                if ($this->backgroundId['id'] === null)
                {
                        $this->backgroundId     = isset($this->backgroundHtmlOptions['id']) ? $this->backgroundHtmlOptions['id'] :  $this->id.'background';
                }
                $this->backgroundHtmlOptions['id']      = $this->backgroundId;
        }
        
        public function run()
        {
                //外部容器
                if (!empty($this->backgroundTagName))
                {
                        echo CHtml::openTag($this->backgroundTagName, $this->backgroundHtmlOptions);
                }
                //树形容器
                echo CHtml::tag('ul', $this->htmlOptions);
                if (!empty($this->backgroundTagName))
                {
                        echo CHtml::closeTag($this->backgroundTagName);
                }
                
                // 是否只允许选择子节点
                if ($this->onlySon)
                {
                        $this->options['callback']['beforeClick']= "js:function(treeId, treeNode) {
                                var check = (treeNode && !treeNode.isParent);
                                return check;
                        }";
                        $this->options['callback']['onClick']= "onClick";
                }
                
                //注册JS
                $cs = Yii::app()->getClientScript();
                $cs->registerCoreScript('jquery');
                Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$this->id, implode("\n", $this->getRegisterScripts()));
        }
        
        /**
         * 注册JS列表
         * 
         */
        protected function getRegisterScripts()
        {
                $js             = array();
                $data   = $this->getData();
                $options=CJavaScript::encode($this->options);
                $js[] = "zTree_{$this->id} = jQuery('#{$this->id}').zTree({$options}, {$data});";
              	$js[] ="function refreshTree(){zTree_{$this->id} = jQuery('#{$this->id}').zTree({$options}, {$data});}";//新增的方法，刷新tree
                return $js;
        }
        
        
        /**
         * 获得数据
         * 
         */
        protected function getData()
        {
                if ($this->model !== null)
                {
                        $model  = is_object($this->model) ? $this->model : new $this->model;
                        if ($model instanceof CModel)
                        {
                                $data   = $model->findAll($this->criteria);
                        }
                }
                else 
                {
                        $data   = $this->data;
                }
                
                if(is_array($data))
                {
                        if (current($data) instanceof CModel)
                        {
                                $arr    = array();
                                foreach ($data as $key => $value)
                                {
                                        $arr[$key]      = $value->getAttributes();
                                        $arr[$key]['name']      = $arr[$key][$this->treeNodeNameKey];
                                }
                                $data   = $arr;
                        }
                        $data   = CJavaScript::encode($data);
                }
               
                return $data;
        }
}