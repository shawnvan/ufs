<?php

class DefaultController extends AppController
{

    public function actions ()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact
            // page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'testLimit' => 1
            ),
            // page action renders "static" pages stored under
            // 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction'
            ),
            'inlineEmail' => array(
                'class' => 'InlineEmailAction'
            )
        );
    }

    public function actionIndex ()
    {
        $this->renderPartial('//layouts/iframe');
    }

    public function actionDashboard ()
    {
        $this->render('dashborad');
    }

    /**
     * Error printing.
     *
     * This is the action to handle external exceptions.
     */
    public function actionError ()
    {
        $error = Yii::app()->errorHandler->error;
        
        if ($error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
}