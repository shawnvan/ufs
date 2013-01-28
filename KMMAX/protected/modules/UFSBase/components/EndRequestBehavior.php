<?php
    class EndRequestBehavior extends CBehavior
    {
        public function attach($owner)
        {
            $owner->attachEventHandler('onEndRequest', array($this, 'handleSaveGlobalStateCheck'));
            $owner->attachEventHandler('onEndRequest', array($this, 'handleEndRequest'));
        }

        // Save global state into ZurmoConfig, before handleEndRequest event handler is called.
        // This is needed because handleEndRequest is attached to component before saveGlobalState handler
        // and therefore will be execute before, so we need to change order.
        public function handleSaveGlobalStateCheck($event)
        {
            $allEventHandlers = Yii::app()->getEventHandlers('onEndRequest');
            if (count($allEventHandlers))
            {
                foreach ($allEventHandlers as $eventHandler)
                {
                    if ($eventHandler[0] instanceof CApplication && $eventHandler[1] == 'saveGlobalState')
                    {
                        Yii::app()->saveGlobalState();
                    }
                }
            }
        }

        public function handleEndRequest($event)
        {
            exit;
        }

        /**
         * Process any points that need to be tabulated based on scoring that occurred during the request.
         * @param CEvent $event
         */
        public function handleGamification($event)
        {
            if (Yii::app()->user->userModel != null)
            {
                Yii::app()->gameHelper->processDeferredPoints();
                Yii::app()->gameHelper->resolveNewBadges();
                Yii::app()->gameHelper->resolveLevelChange();
            }
        }
    }
?>
