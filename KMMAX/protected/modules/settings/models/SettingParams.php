<?php

class SettingParams extends CComponent
{
    public static function params(){
        return array(
            'ADMIN_EMAIL' => array(
                'rules' => array('email' => null)
            ),
            'ARTICLE_LEADING_WORDS' => array(
                'rules' => array('numerical' => array('min' => 30,'max' => 200))
            ),
            'BO_PAGE_SIZE' => array(
                'rules' => array('numerical' => array('min' => 5, 'max' => 50))
            ),
            'BO_THEME' => array(
            ),
            'CATEGORIES_POPUP' => array(
                'rules' => array('numerical' => array('min' => 5, 'max' => 20))
            ),
            'DEFAULT_BO_LAYOUT' => array(
            ),
            'DEFAULT_LAYOUT' => array(
            ),
            'DEFAULT_PAGE_ID' => array(
            ),
            'PAGER_HEADER' => array(
            ),
            'PAGER_NEXT_PAGE_LABEL' => array(
            ),
            'PAGER_PREV_PAGE_LABEL' => array(
            ),
            'PAGE_SIZE' => array(
                'rules' => array('numerical' => array('min' => 5, 'max' => 20))
            ),
            'SITE_COPYRIGHT' => array(
            ),
            'SITE_NAME' => array(
            ),
            'THEME' => array(
            ),
            'URL_EXT' => array(
            ),
            'LOGO_WIDTH' => array(
                'rules' => array('numerical' => array('min' => 20, 'max' => 500))
            ),
            'LOGO_HEIGHT' => array(
                'rules' => array('numerical' => array('min' => 20, 'max' => 500))
            ),
            'MAIL_METHOD' => array(
                'widget' => 'dropDownList',
                'params' => array('name' => 'MAIL_METHOD', 'value' => '', 
                                    'data' => array('smtp' => 'SMTP', 'mail' => 'mail() function', 'sendmail' => 'sendmail')),
                
            ),
            'SMTP_PORT' => array(
                'rules' => array('numerical' => array())
            ),
            'SMTP_PASSWORD' => array(
                'widget' => 'passwordField',
            ),
            'SMTP_SECURE' => array(
                'widget' => 'dropDownList',
                'params' => array('name' => 'SMTP_SECURE', 'value' => '', 
                                    'data' => array('' => 'No secure connection', 'ssl' => 'SSL', 'tls' => 'TLS')),
                
            ),
            'VERSION' => array(
            ),
        );
    }
}
?>
