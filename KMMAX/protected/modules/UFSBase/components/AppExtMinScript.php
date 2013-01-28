<?php

    /**
     * AppExtMinScript minify, combine, minify, compress, cache javascript and css files.
     */
    Yii::import('application.extensions.minscript.components.ExtMinScript');
    class AppExtMinScript extends ExtMinScript
    {
        protected $themePath;

        /**
         * Add scripts here that do not need to load when using an ajax request such as a modal search box.  The scripts
         * are already loaded in the minified script that loads on every page.
         */
        public $usingAjaxShouldNotIncludeJsPathAliasesAndFileNames = array();

        /**
         * Used to avoid call to ExtMinScript::init() function
         * @see ExtMinScript::init()
         */
        public function init()
        {
            CApplicationComponent::init();
            $minifyDir = dirname(dirname(__FILE__)) . '/vendors/minify/min';
            $this -> _minifyDir = $minifyDir;
            if (!extension_loaded('apc'))
            {
              $cachePath = Yii::app() -> runtimePath . '/minScript/cache';
              if (!is_dir($cachePath))
              {
                  mkdir($cachePath, 0777, true);
              }
              elseif (!is_writable($cachePath))
              {
                  throw new CException('ext.minScript: ' . $cachePath . ' is not writable.');
              }
              chmod(Yii::app() -> runtimePath . '/minScript' , 0777);
              chmod(Yii::app() -> runtimePath . '/minScript/cache' , 0777);
            }
            $this -> _processGroupMap();
            $this -> _readOnlyGroupMap = true;
        }

        /**
         * Set path to theme directory.
         * @param string $themePath
         */
        public function setThemePath($themePath)
        {
            $this->themePath = $themePath;
        }

        /**
         * Get theme path
         */
        public function getThemePath()
        {
            return $this->themePath;
        }

        /**
         * We don't need to load data into groupsConfig.php
         * @see ExtMinScript::_processGroupMap()
         */
        protected function _processGroupMap()
        {
            $groupMap = $this->getGroupMap();
            $this -> setGroupMap($groupMap);
        }
    }
?>