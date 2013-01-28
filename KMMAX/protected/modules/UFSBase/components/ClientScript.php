<?php
    /**
     * Adds support Ajax support where some
     * javascript files are not needed to be renderd
     * based on position
     */
    class ClientScript extends CClientScript
    {
        private $shouldRenderCoreScripts = true;

        /**
         * Used in AJAX calls to make sure
         * .js files are not rendered again
         * if they are not needed
         * TODO: potentially clear scriptFiles, although this was
         * causing an issue with WorldClock.
         */
        public function setToAjaxMode()
        {
            $this->cssFiles    = array();
            $this->setRenderCoreScripts(false);
        }

        private function setRenderCoreScripts($value)
        {
            assert('is_bool($value)');
            $this->shouldRenderCoreScripts = $value;
        }

        public function isAjaxMode()
        {
            return !$this->shouldRenderCoreScripts;
        }

        public function renderCoreScripts()
        {
            if ($this->shouldRenderCoreScripts)
            {
                parent::renderCoreScripts();
            }
        }

        /**
         * Method override to call @see removeAllPageLoadedScriptFilesWhenRenderingInAjaxMode
         * (non-PHPdoc)
         * @see CClientScript::render()
         */
        public function render(& $output)
        {
            if ($this->isAjaxMode())
            {
                $this->removeAllPageLoadedScriptFilesWhenRenderingInAjaxMode();
            }
            parent::render($output);
        }

        /**
         * When the page is loading in ajax mode, it is assumed certain script files have always
         * been loaded by the main page.  These need to therefore be removed from the scriptFiles
         * array.
         */
        protected function removeAllPageLoadedScriptFilesWhenRenderingInAjaxMode()
        {
            $filesToRemove = parent::getScriptFilesThatLoadOnAllPages();
            foreach ($this->scriptFiles as $position => $data)
            {
                foreach ($data as $key => $scriptFile)
                {
                    if (in_array($scriptFile, $filesToRemove))
                    {
                        unset($this->scriptFiles[$position][$key]);
                    }
                }
            }
        }
		
        /**
         * Register into clientScript->scriptFiles any scripts that should load on all pages
         * @see getScriptFilesThatLoadOnAllPages
         */
        public static function registerAllPagesScriptFiles()
        {
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerCoreScript('jquery.ui');
        }
    }
?>