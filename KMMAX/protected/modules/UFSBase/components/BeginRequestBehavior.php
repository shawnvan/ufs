<?php

    class BeginRequestBehavior extends CBehavior
    {
        public function attach($owner)
        {
            if (Yii::app()->apiRequest->isApiRequest())
            {
                $owner->attachEventHandler('onBeginRequest', array($this, 'handleApplicationCache'));
                $owner->detachEventHandler('onBeginRequest', array(Yii::app()->request, 'validateCsrfToken'));
                $owner->attachEventHandler('onBeginRequest', array($this, 'handleImports'));

                $owner->attachEventHandler('onBeginRequest', array($this, 'handleDisableGamification'));
                $owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginApiRequest'));
                $owner->attachEventHandler('onBeginRequest', array($this, 'handleStartPerformanceClock'));

            }
            else
            {
                $owner->attachEventHandler('onBeginRequest', array($this, 'handleApplicationCache'));
                $owner->attachEventHandler('onBeginRequest', array($this, 'handleImports'));
                $owner->attachEventHandler('onBeginRequest', array($this, 'handleStartPerformanceClock'));
                $owner->attachEventHandler('onBeginRequest', array($this, 'handleBrowserCheck'));


                $owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
                    $owner->attachEventHandler('onBeginRequest', array($this, 'handleClearCache'));
                    $owner->attachEventHandler('onBeginRequest', array($this, 'handleLoadLanguage'));
                    $owner->attachEventHandler('onBeginRequest', array($this, 'handleLoadTimeZone'));
                    $owner->attachEventHandler('onBeginRequest', array($this, 'handleUserTimeZoneConfirmed'));
                    $owner->attachEventHandler('onBeginRequest', array($this, 'handleLoadActivitiesObserver'));
                    $owner->attachEventHandler('onBeginRequest', array($this, 'handleLoadConversationsObserver'));
                    $owner->attachEventHandler('onBeginRequest', array($this, 'handleLoadGamification'));
                    $owner->attachEventHandler('onBeginRequest', array($this, 'handleCheckAndUpdateCurrencyRates'));
                    $owner->attachEventHandler('onBeginRequest', array($this, 'handleResolveCustomData'));
            }
        }

        /**
        * Load memcache extension if memcache extension is
        * loaded and if memcache server is avalable
        * @param $event
        */
        public function handleApplicationCache($event)
        {
            if (MEMCACHE_ON)
            {
                $memcacheServiceHelper = new MemcacheServiceHelper();
                if ($memcacheServiceHelper->runCheckAndGetIfSuccessful())
                {
                    $cacheComponent = Yii::createComponent('CMemCache',
                        array('servers' => Yii::app()->params['memcacheServers']));
                    Yii::app()->setComponent('cache', $cacheComponent);
                }
            }
        }

        /**
        * Import all files that need to be included(for lazy loading)
        * @param $event
        */
        public function handleImports($event)
        {
            try
            {
                $filesToInclude = GeneralCache::getEntry('filesToInclude');
            }
            catch (NotFoundException $e)
            {
                $filesToInclude   = FileUtil::getFilesFromDir(Yii::app()->basePath . '/modules', Yii::app()->basePath . '/modules', 'application.modules');
                $filesToIncludeFromFramework = FileUtil::getFilesFromDir(Yii::app()->basePath . '/extensions/zurmoinc/framework', Yii::app()->basePath . '/extensions/zurmoinc/framework', 'application.extensions.zurmoinc.framework');
                $totalFilesToIncludeFromModules = count($filesToInclude);

                foreach ($filesToIncludeFromFramework as $key => $file)
                {
                    $filesToInclude[$totalFilesToIncludeFromModules + $key] = $file;
                }
                GeneralCache::cacheEntry('filesToInclude', $filesToInclude);
            }
            foreach ($filesToInclude as $file)
            {
                Yii::import($file);
            }
        }

        /**
        * This check is required during installation since if runtime, assets and data folders are missing
        * yii web application can not be started correctly.
        * @param $event
        */
        public function handleInstanceFolderCheck($event)
        {
            $instanceFoldersServiceHelper = new InstanceFoldersServiceHelper();
            if (!$instanceFoldersServiceHelper->runCheckAndGetIfSuccessful())
            {
                echo $instanceFoldersServiceHelper->getMessage();
                Yii::app()->end(0, false);
            }
        }

        public function handleInstallCheck($event)
        {
            $allowedInstallUrls = array (
                Yii::app()->createUrl('zurmo/default/unsupportedBrowser'),
                Yii::app()->createUrl('install/default'),
                Yii::app()->createUrl('install/default/welcome'),
                Yii::app()->createUrl('install/default/checkSystem'),
                Yii::app()->createUrl('install/default/settings'),
                Yii::app()->createUrl('install/default/runInstallation'),
                Yii::app()->createUrl('install/default/installDemoData'),
                Yii::app()->createUrl('min/serve')
            );
            $reqestedUrl = Yii::app()->getRequest()->getUrl();
            $redirect = true;
            foreach ($allowedInstallUrls as $allowedUrl)
            {
                if (strpos($reqestedUrl, $allowedUrl) === 0)
                {
                    $redirect = false;
                    break;
                }
            }
            if ($redirect)
            {
                $url = Yii::app()->createUrl('install/default');
                Yii::app()->request->redirect($url);
            }
        }

        public function handleBrowserCheck($event)
        {
            $browserName = Yii::app()->browser->getName();
            if (isset($_GET['ignoreBrowserCheck']))
            {
                $browserIsSupported = ($_GET['ignoreBrowserCheck'] == 1) ? 1 : 0;
            }
            else
            {
                $browserIsSupported = in_array($browserName, array('msie', 'mozilla', 'chrome', 'safari'));
            }
            if (array_key_exists('r', $_GET)                                   &&
                in_array($_GET['r'], array('UFSBase/default/unsupportedBrowser')) &&
                $browserIsSupported)
            {
                $url = Yii::app()->createUrl('/UFSBase/default');
                Yii::app()->request->redirect($url);
            }
            if ((!array_key_exists('r', $_GET) ||
                 !in_array($_GET['r'], array('UFSBase/default/unsupportedBrowser'))) &&
                !$browserIsSupported)
            {
                $url = Yii::app()->createUrl('UFSBase/default/unsupportedBrowser', array('name' => $browserName));
                Yii::app()->request->redirect($url);
            }
        }

        /**
         * Called if installed, and logged in.
         * @param CEvent $event
         */
        public function handleUserTimeZoneConfirmed($event)
        {
            if (!Yii::app()->user->isGuest && !Yii::app()->timeZoneHelper->isCurrentUsersTimeZoneConfirmed())
            {
                $allowedTimeZoneConfirmBypassUrls = array (
                    Yii::app()->createUrl('users/default/confirmTimeZone'),
                    Yii::app()->createUrl('min/serve'),
                );
                $reqestedUrl = Yii::app()->getRequest()->getUrl();
                $isUrlAllowedToByPass = false;
                foreach ($allowedTimeZoneConfirmBypassUrls as $url)
                {
                    if (strpos($reqestedUrl, $url) === 0)
                    {
                        $isUrlAllowedToByPass = true;
                    }
                }
                if (!$isUrlAllowedToByPass)
                {
                    $url = Yii::app()->createUrl('users/default/confirmTimeZone');
                    Yii::app()->request->redirect($url);
                }
            }
        }

        public function handleBeginRequest($event)
        {
            if (Yii::app()->user->isGuest)
            {
                $allowedGuestUserUrls = array (
                    Yii::app()->createUrl('UFSBase/default/unsupportedBrowser'),
                    Yii::app()->createUrl('UFSBase/default/login'),
                    Yii::app()->createUrl('min/serve'),
                );
                $reqestedUrl = Yii::app()->getRequest()->getUrl();
                $isUrlAllowedToGuests = false;
                foreach ($allowedGuestUserUrls as $url)
                {
                    if (strpos($reqestedUrl, $url) === 0)
                    {
                        $isUrlAllowedToGuests = true;
                    }
                }
                if (!$isUrlAllowedToGuests)
                {
                    Yii::app()->user->loginRequired();
                }
            }
        }

        public function handleBeginApiRequest($event)
        {
            if (Yii::app()->user->isGuest)
            {
                $allowedGuestUserUrls = array (
                    Yii::app()->createUrl('UFSBase/api/login'),
                    Yii::app()->createUrl('UFSBase/api/logout'),
                );
                $isUrlAllowedToGuests = false;
                foreach ($allowedGuestUserUrls as $url)
                {
                    if (AppUrlManager::getPositionOfPathInUrl($url) !== false)
                    {
                        $isUrlAllowedToGuests = true;
                        break;
                    }
                }

                if (!$isUrlAllowedToGuests)
                {
                    $message = Yii::t('Default', 'Sign in required.');
                    $result = new ApiResult(ApiResponse::STATUS_FAILURE, null, $message, null);
                    Yii::app()->apiHelper->sendResponse($result);
                    exit;
                }
            }
        }


        /**
         * In the case where you have reloaded the database, some cached items might still exist.  This is a way
         * to clear that cache. Helpful during development and testing.
         */
        public function handleClearCache($event)
        {
            if (isset($_GET['clearCache']) && $_GET['clearCache'] == 1)
            {
                ForgetAllCacheUtil::forgetAllCaches();
            }
        }

        public function handleStartPerformanceClock($event)
        {
            Yii::app()->performance->startClock();
        }

        public function handleLoadLanguage($event)
        {
            if (!Yii::app()->apiRequest->isApiRequest())
            {
                if (isset($_GET['lang']) && $_GET['lang'] != null)
                {
                    Yii::app()->languageHelper->setActive($_GET['lang']);
                }
            }
            else
            {
                if ($lang = Yii::app()->apiRequest->getLanguage())
                {
                    Yii::app()->languageHelper->setActive($lang);
                }
            }
            Yii::app()->languageHelper->load();
        }

        public function handleLoadTimeZone($event)
        {
            Yii::app()->timeZoneHelper->load();
        }

        public function handleCheckAndUpdateCurrencyRates($event)
        {
            Yii::app()->currencyHelper->checkAndUpdateCurrencyRates();
        }

        public function handleResolveCustomData($event)
        {
            if (isset($_GET['resolveCustomData']) && $_GET['resolveCustomData'] == 1)
            {
                Yii::app()->custom->resolveIsCustomDataLoaded();
            }
        }

        public function handleLoadActivitiesObserver($event)
        {
            $activitiesObserver = new ActivitiesObserver();
            $activitiesObserver->init(); //runs init();
        }

        public function handleLoadConversationsObserver($event)
        {
            $conversationsObserver = new ConversationsObserver();
            $conversationsObserver->init(); //runs init();
        }

        public function handleLoadGamification($event)
        {
            Yii::app()->gameHelper;
            Yii::app()->gamificationObserver; //runs init();
        }

        public function handleDisableGamification($event)
        {
            Yii::app()->gamificationObserver->enabled = false;
        }
     }
?>
