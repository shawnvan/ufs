<?php
abstract class UFSBaseUtil
{
	    /**
     * A function to convert a timestamp into a string stated how long ago an object
     * was created.
     * 
     * @param $timestamp The time that the object was posted.
     * @return String How long ago the object was posted.
     */
    public static function timestampAge($timestamp) {
        $age = time() - strtotime($timestamp);
        //return $age;
        if ($age < 60)
            return Yii::t('app', 'Just now'); // less than 1 min ago
        if ($age < 3600)
            return Yii::t('app', '{n} minutes ago', array('{n}' => floor($age / 60))); // minutes (less than an hour ago)
        if ($age < 86400)
            return Yii::t('app', '{n} hours ago', array('{n}' => floor($age / 3600))); // hours (less than a day ago)

        return Yii::t('app', '{n} days ago', array('{n}' => floor($age / 86400))); // days (more than a day ago)
    }


    /**
     * Converts a record's Description or Background Info to deal with the discrepancy
     * between MySQL/PHP line breaks and HTML line breaks.
     */
    public static function convertLineBreaks($text, $allowDouble = true, $allowUnlimited = false) {

        $text = mb_ereg_replace("\r\n", "\n", $text);  //convert microsoft's stupid CRLF to just LF

        if (!$allowUnlimited)
            $text = mb_ereg_replace("[\r\n]{3,}", "\n\n", $text); // replaces 2 or more CR/LF chars with just 2

        if ($allowDouble)
            $text = mb_ereg_replace("[\r\n]", '<br />', $text); // replaces all remaining CR/LF chars with <br />
        else
            $text = mb_ereg_replace("[\r\n]+", '<br />', $text);

        return $text;
    }

    /**
     * Used in function convertUrls
     *
     * @param mixed $a
     * @param mixed $b
     * @return mixed  
     */
    public static function compareChunks($a, $b) {
        return $a[1] - $b[1];
    }

    /**
     * Replaces any URL in text with an html link (supports mailto links)
     * 
     * @todo refactor this out of controllers
     * @param string $text Text to be converted
     * @param boolean $convertLineBreaks
     */
    public static function convertUrls($text, $convertLineBreaks = true) {
        /* $text = preg_replace(
          array(
          '/(?(?=<a[^>]*>.+<\/a>)(?:<a[^>]*>.+<\/a>)|([^="\']?)((?:https?|ftp|bf2|):\/\/[^<> \n\r]+))/iex',
          '/<a([^>]*)target="?[^"\']+"?/i',
          '/<a([^>]+)>/i',
          '/(^|\s|>)(www.[^<> \n\r]+)/iex',
          '/(([_A-Za-z0-9-]+)(\\.[_A-Za-z0-9-]+)*@([A-Za-z0-9-]+)(\\.[A-Za-z0-9-]+)*)/iex'
          ),
          array(
          "stripslashes((strlen('\\2')>0?'\\1<a href=\"\\2\">\\2</a>\\3':'\\0'))",
          '<a\\1',
          '<a\\1 target="_blank">',
          "stripslashes((strlen('\\2')>0?'\\1<a href=\"http://\\2\">\\2</a>\\3':'\\0'))",
          "stripslashes((strlen('\\2')>0?'<a href=\"mailto:\\0\">\\0</a>':'\\0'))"
          ),
          $text
          ); */



        /* URL matching regex from the interwebs:
         * http://www.regexguru.com/2008/11/detecting-urls-in-a-block-of-text/
         */
        $url_pattern = '/\b(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[-A-Z0-9+&@#\/%=~_|$?!:,.])*(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[A-Z0-9+&@#\/%=~_|$])/i';
        $email_pattern = '/(([_A-Za-z0-9-]+)(\\.[_A-Za-z0-9-]+)*@([A-Za-z0-9-]+)(\\.[A-Za-z0-9-]+)*)/i';

        /* First break the text into two arrays, one containing <a> tags and the like
         * which should not have any replacements, and another with all the text that
         * should have URLs activated.  Each piece of each array has its offset from 
         * original string so we can piece it back together later
         */

        //add any additional tags to be passed over here	
        $tags_with_urls = "/(<a[^>]*>.*<\/a>)|(<img[^>]*>)/i";
        $text_to_add_links = preg_split($tags_with_urls, $text, NULL, PREG_SPLIT_OFFSET_CAPTURE);
        $matches = array();
        preg_match_all($tags_with_urls, $text, $matches, PREG_OFFSET_CAPTURE);
        $text_to_leave = $matches[0];

        // Convert all URLs into html links
        foreach ($text_to_add_links as $i => $value) {
            $text_to_add_links[$i][0] = preg_replace(
                    array($url_pattern,
                $email_pattern), array("<a href=\"\\0\">\\0</a>",
                "<a href=\"mailto:\\0\">\\0</a>"), $text_to_add_links[$i][0]
            );
        }

        // Merge the arrays and sort to be in the original order
        $all_text_chunks = array_merge($text_to_add_links, $text_to_leave);

        usort($all_text_chunks, 'UFSBaseUtil::compareChunks');

        $new_text = "";
        foreach ($all_text_chunks as $chunk) {
            $new_text = $new_text . $chunk[0];
        }
        $text = $new_text;

        // Make sure all links open in new window, and have http:// if missing
        $text = preg_replace(
                array('/<a([^>]+)target=("[^"]+"|\'[^\']\'|[^\s]+)([^>]+)/i',
            '/<a([^>]+)>/i',
            '/<a([^>]+href="?\'?)(www\.|ftp\.)/i'), array('<a\\1\\3',
            '<a\\1 target="_blank">',
            '<a\\1http://\\2'), $text
        );

        //convert any tags into links
        $template = "\\1<a href=" . Yii::app()->createUrl('/search/search') . '?term=%23\\2' . ">#\\2</a>";
        //$text = preg_replace('/(^|[>\s\.])#(\w\w+)($|[<\s\.])/u',$template,$text);
        $text = preg_replace('/(^|[>\s\.])#(\w\w+)/u', $template, $text);

        //TODO: separate convertUrl and convertLineBreak concerns
        if ($convertLineBreaks)
            return UFSBaseUtil::convertLineBreaks($text, true, false);
        else
            return $text;
    }

    	    public function partialDateRange($input) {
        $datePatterns = array(
            array('/^(0-9)$/', '000-01-01', '999-12-31'),
            array('/^([0-9]{2})$/', '00-01-01', '99-12-31'),
            array('/^([0-9]{3})$/', '0-01-01', '9-12-31'),
            array('/^([0-9]{4})$/', '-01-01', '-12-31'),
            array('/^([0-9]{4})-$/', '01-01', '12-31'),
            array('/^([0-9]{4})-([0-1])$/', '0-01', '9-31'),
            array('/^([0-9]{4})-([0-1][0-9])$/', '-01', '-31'),
            array('/^([0-9]{4})-([0-1][0-9])-$/', '01', '31'),
            array('/^([0-9]{4})-([0-1][0-9])-([0-3])$/', '0', '9'),
            array('/^([0-9]{4})-([0-1][0-9])-([0-3][0-9])$/', '', ''),
        );

        $inputLength = strlen($input);

        $minDateParts = array();
        $maxDateParts = array();

        if ($inputLength > 0 && preg_match($datePatterns[$inputLength - 1][0], $input)) {

            $minDateParts = explode('-', $input . $datePatterns[$inputLength - 1][1]);
            $maxDateParts = explode('-', $input . $datePatterns[$inputLength - 1][2]);

            $minDateParts[1] = max(1, min(12, $minDateParts[1]));
            $minDateParts[2] = max(1, min(cal_days_in_month(CAL_GREGORIAN, $minDateParts[1], $minDateParts[0]), $minDateParts[2]));

            $maxDateParts[1] = max(1, min(12, $maxDateParts[1]));
            $maxDateParts[2] = max(1, min(cal_days_in_month(CAL_GREGORIAN, $maxDateParts[1], $maxDateParts[0]), $maxDateParts[2]));

            $minTimestamp = mktime(0, 0, 0, $minDateParts[1], $minDateParts[2], $minDateParts[0]);
            $maxTimestamp = mktime(23, 59, 59, $maxDateParts[1], $maxDateParts[2], $maxDateParts[0]);

            return array($minTimestamp, $maxTimestamp);
        } else
            return false;
    }

    public static function decodeQuotes($str) {
        return preg_replace('/&quot;/u', '"', $str);
    }

    public static function encodeQuotes($str) {
        // return htmlspecialchars($str);
        return preg_replace('/"/u', '&quot;', $str);
    }

    public static function cleanUpSessions() {
        Session::model()->deleteAll('fLastUpdated < :cutoff', array(':cutoff' => time() - Yii::app()->params->timeout));
    }

    public static function getPhpMailer() {

        require_once('public/components/phpMailer/class.phpmailer.php');

        $phpMail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
        $phpMail->CharSet = 'utf-8';

        switch (Yii::app()->params->admin->emailType) {
            case 'sendmail':
                $phpMail->IsSendmail();
                break;
            case 'qmail':
                $phpMail->IsQmail();
                break;
            case 'smtp':
                $phpMail->IsSMTP();

                $phpMail->Host = Yii::app()->params->admin->emailHost;
                $phpMail->Port = Yii::app()->params->admin->emailPort;
                $phpMail->SMTPSecure = Yii::app()->params->admin->emailSecurity;

                if (Yii::app()->params->admin->emailUseAuth == 'admin') {
                    $phpMail->SMTPAuth = true;
                    $phpMail->Username = Yii::app()->params->admin->emailUser;
                    $phpMail->Password = Yii::app()->params->admin->emailPass;
                }
                break;
            case 'mail':
            default:
                $phpMail->IsMail();
        }
        return $phpMail;
    }

    public static function addEmailAddresses(&$phpMail, $addresses) {

        if (isset($addresses['to'])) {
            foreach ($addresses['to'] as $target) {
                if (count($target) == 2)
                    $phpMail->AddAddress($target[1], $target[0]);
            }
        } else {
            if (count($addresses) == 2 && !is_array($addresses[0])) // this is just an array of [name, address],
                $phpMail->AddAddress($addresses[1], $addresses[0]); // not an array of arrays
            else {
                foreach ($addresses as $target) {     //this is an array of [name, address] subarrays
                    if (count($target) == 2)
                        $phpMail->AddAddress($target[1], $target[0]);
                }
            }
        }
        if (isset($addresses['cc'])) {
            foreach ($addresses['cc'] as $target) {
                if (count($target) == 2)
                    $phpMail->AddCC($target[1], $target[0]);
            }
        }
        if (isset($addresses['bcc'])) {
            foreach ($addresses['bcc'] as $target) {
                if (count($target) == 2)
                    $phpMail->AddBCC($target[1], $target[0]);
            }
        }
    }

    public static function throwException($message) {
        throw new Exception($message);
    }

    public static function sendUserEmail($addresses, $subject, $message, $attachments = null) {

        $user = CActiveRecord::model('User')->findByPk(Yii::app()->user->getId());

        $phpMail = $this->getPhpMailer();

        try {
            if (empty(Yii::app()->params->profile->emailAddress))
                throw new Exception('<b>' . Yii::t('app', 'Your profile doesn\'t have a valid email address.') . '</b>');

            $phpMail->AddReplyTo(Yii::app()->params->profile->emailAddress, $user->name);
            $phpMail->SetFrom(Yii::app()->params->profile->emailAddress, $user->name);

            $this->addEmailAddresses($phpMail, $addresses);

            $phpMail->Subject = $subject;
            // $phpMail->AltBody = $message;
            $phpMail->MsgHTML($message);
            // $phpMail->Body = $message;
            // add attachments, if any
            if ($attachments) {
                foreach ($attachments as $attachment) {
                    if ($attachment['temp']) { // stored as a temp file?
                        $file = 'uploads/media/temp/' . $attachment['folder'] . '/' . $attachment['filename'];
                        if (file_exists($file)) // check file exists
                            if (filesize($file) <= (10 * 1024 * 1024)) // 10mb file size limit
                                $phpMail->AddAttachment($file);
                            else
                                $this->throwException("Attachment '{$attachment['filename']}' exceeds size limit of 10mb.");
                    } else { // stored in media library
                        $file = 'uploads/media/' . $attachment['folder'] . '/' . $attachment['filename'];
                        if (file_exists($file)) // check file exists
                            if (filesize($file) <= (10 * 1024 * 1024)) // 10mb file size limit
                                $phpMail->AddAttachment($file);
                            else
                                $this->throwException("Attachment '{$attachment['filename']}' exceeds size limit of 10mb.");
                    }
                }
            }

            $phpMail->Send();

            // delete temp attachment files, if they exist
            if ($attachments) {
                foreach ($attachments as $attachment) {
                    if ($attachment['temp']) {
                        $file = 'uploads/media/temp/' . $attachment['folder'] . '/' . $attachment['filename'];
                        $folder = 'uploads/media/temp/' . $attachment['folder'];
                        if (file_exists($file))
                            unlink($file); // delete temp file
                        if (file_exists($folder))
                            rmdir($folder); // delete temp folder
                        TempFile::model()->deleteByPk($attachment['id']);
                    }
                }
            }

            $status[] = '200';
            $status[] = Yii::t('app', 'Email Sent!');
        } catch (phpmailerException $e) {
            $status[] = '<span class="error">' . $e->errorMessage() . '</span>'; //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            $status[] = '<span class="error">' . $e->getMessage() . '</span>'; //Boring error messages from anything else!
        }

        return $status;
    }

    public static function parseEmailTo($string) {

        if (empty($string))
            return false;
        $mailingList = array();
        $splitString = explode(',', $string);

        require_once('public/components/phpMailer/class.phpmailer.php');

        foreach ($splitString as &$token) {

            $token = trim($token);
            if (empty($token))
                continue;

            $matches = array();

            if (PHPMailer::ValidateAddress($token)) { // if it's just a simple email, we're done!
                $mailingList[] = array('', $token);
            } else if (preg_match('/^"?([^"]*)"?\s*<(.+)>$/i', $token, $matches)) {
                if (count($matches) == 3 && PHPMailer::ValidateAddress($matches[2]))
                    $mailingList[] = array($matches[1], $matches[2]);
                else
                    return false;
            } else
                return false;

            // if(preg_match('/^"(.*)"/i',$token,$matches)) {		// if there is a name like <First Last> at the beginning,
            // $token = trim(preg_replace('/^".*"/i','',$token));	// remove it
            // if(isset($matches[1]))
            // $name = trim($matches[1]);						// and put it in $name
            // }
            // $address = trim(preg_replace($token);
            // if(PHPMailer::ValidateAddress($address))
            // $mailingList[] = array($address,$name);
            // else
            // return false;
        }
        // echo var_dump($mailingList);

        if (count($mailingList) < 1)
            return false;

        return $mailingList;
    }

    public function mailingListToString($list, $encodeQuotes = false) {
        $string = '';
        if (is_array($list)) {
            foreach ($list as &$value) {
                if (!empty($value[0]))
                    $string .= '"' . $value[0] . '" <' . $value[1] . '>, ';
                else
                    $string .= $value[1] . ', ';
            }
        }
        return $encodeQuotes ? $this->encodeQuotes($string) : $string;
    }

    /**
     * 获取真实IP
     * @return string
     */
    public static function getRealIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            return $_SERVER['REMOTE_ADDR'];
    }
    
	/**
     * 获取当前时间戳
     * @return string
     */
    public static function getTime() {
       return time();
    }

    // This function needs to be made in your extensions of the class with similar code. 
    // Replace "Opportunities" with the Model being used.
    /*     * public function loadModel($id)
      {
      $model=Opportunity::model()->findByPk((int)$id);
      if($model===null)
      throw new CHttpException(404,'The requested page does not exist.');
      return $model;
      } */

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    public static function performAjaxValidation($model) {
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /*     * * Date Format Functions ** */

    /**
     * Format a date to be long (September 25, 2011)
     * @param integer $timestamp Unix time stamp
     */
    public static function formatLongDate($timestamp) {
        if (empty($timestamp))
            return '';
        else
            return Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'), $timestamp);
    }

    /**
     * Formats a date.
     * 
     * @param integer $timestamp
     * @param string $width A length keyword, i.e. "medium"
     * @return string 
     */
    public static function formatDate($timestamp, $width = '') {
        if (empty($timestamp))
            return '';
        else {
            if (Yii::app()->language == 'en')
                if ($width == 'medium')
                    return Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('medium'), $timestamp);
                else
                    return Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'), $timestamp);
            else
                return Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('short'), $timestamp);
        }
    }

    /**
     * Format dates for the date picker.
     * @param string $width A length keyword, i.e. "medium"
     * @return string 
     */
    public static function formatDatePicker($width = '') {
        if (Yii::app()->language == 'en') {
            if ($width == 'medium')
                return "M d, yy";
            else
                return "MM d, yy";
        } else {
            $format = Yii::app()->locale->getDateFormat('short'); // translate Yii date format to jquery
            $format = str_replace('yy', 'y', $format);
            $format = str_replace('MM', 'mm', $format);
            $format = str_replace('M', 'm', $format);
            return $format;
        }
    }

    /**
     * Formats time for the time picker.
     * 
     * @param string $width
     * @return string 
     */
    public static function formatTimePicker($width = '') {
        $format = Yii::app()->locale->getTimeFormat('short');
        $format = strtolower($format); // jquery specifies hours/minutes as hh/mm instead of HH//MM
        $format = str_replace('a', 'TT', $format); // yii and jquery have different format to specify am/pm
        return $format;
    }

    /**
     * Check if am/pm is being used in this locale.
     */
    public static function formatAMPM() {
        if (strstr(Yii::app()->locale->getTimeFormat(), "a") === false)
            return false;
        else
            return true;
    }

    /**
     * Obtain a Unix-style integer timestamp for a date format.
     * 
     * @param string $date
     * @return integer 
     */
    public static function parseDate($date) {
        if (Yii::app()->language == 'en')
            return strtotime($date);
        else
            return CDateTimeParser::parse($date, Yii::app()->locale->getDateFormat('short'));
    }

    /*     * * Date Time Format Functions ** */

    /**
     * Returns a formatted string for the date.
     * 
     * @param integer $timestamp
     * @return string 
     */
    public static function formatLongDateTime($timestamp) {
        if (empty($timestamp))
            return '';
        else
            return Yii::app()->dateFormatter->formatDateTime($timestamp, 'long', 'short');
    }

    /**
     * Returns a formatted string for the end of the day.
     * @param integer $timestamp
     * @return string
     */
    public static function formatDateEndOfDay($timestamp) {
        if (empty($timestamp))
            return '';
        else
        if (Yii::app()->language == 'en')
            return Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('medium') . ' ' . Yii::app()->locale->getTimeFormat('short'), strtotime("tomorrow", $timestamp) - 60);
        else
            return Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('short') . ' ' . Yii::app()->locale->getTimeFormat('short'), strtotime("tomorrow", $timestamp) - 60);
    }

    /**
     * Formats the date and time for a given timestamp.
     * @param type $timestamp
     * @return string 
     */
    public static function formatDateTime($timestamp) {
        if (empty($timestamp))
            return '';
        else
        if (Yii::app()->language == 'en')
            return Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('medium') . ' ' . Yii::app()->locale->getTimeFormat('short'), $timestamp);
        else
            return Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('short') . ' ' . Yii::app()->locale->getTimeFormat('short'), $timestamp);
    }

    /**
     * Parses both date and time into a Unix-style integer timestamp.
     * @param string $date
     * @return integer
     */
    public static function parseDateTime($date) {
        if (Yii::app()->language == 'en')
            return strtotime($date);
        else
            return CDateTimeParser::parse($date, Yii::app()->locale->getDateFormat('short') . ' hh:mm');
    }

    /**
     * Cuts string short.
     * @param string $str String to be truncated.
     * @param integer $length Maximum length of the string
     * @return string
     */
    public static function truncateText($str, $length = 30) {

        if (strlen($str) > $length - 3) {
            if ($length < 3)
                $str = '';
            else
                $str = substr($str, 0, $length - 3);
            $str .= '...';
        }
        return $str;
    }

    /**
     * Converts CamelCased words into first-letter-capitalized, spaced words.
     * @param type $str
     * @return type 
     */
    public static function deCamelCase($str) {
        $str = preg_replace("/(([a-z])([A-Z])|([A-Z])([A-Z][a-z]))/", "\\2\\4 \\3\\5", $str);
        return ucfirst($str);
    }

    /**
     * Copies a file, making directories for it at the receiving location as necessary.
     * @param type $filepath
     * @param type $file
     * @return type 
     */
    public static function ccopy($filepath, $file) {

        $pieces = explode('/', $file);
        unset($pieces[count($pieces)]);
        for ($i = 0; $i < count($pieces); $i++) {
            $str = "";
            for ($j = 0; $j < $i; $j++) {
                $str.=$pieces[$j] . '/';
            }

            if (!is_dir($str) && $str != "") {
                mkdir($str);
            }
        }
        return copy($filepath, $file);
    }

    public static function Array_Search_Preg($find, $in_array, $keys_found = Array()) {
        if (is_array($in_array)) {
            foreach ($in_array as $key => $val) {
                if (is_array($val))
                    $this->Array_Search_Preg($find, $val, $keys_found);
                else {
                    if (preg_match('/' . $find . '/', $val))
                        $keys_found[] = $key;
                }
            }
            return $keys_found;
        }
        return false;
    }

    public static function getDateRange() {

        $dateRange = array();
        $dateRange['strict'] = false;
        if (isset($_GET['strict']) && $_GET['strict'])
            $dateRange['strict'] = true;

        $dateRange['range'] = 'custom';
        if (isset($_GET['range']))
            $dateRange['range'] = $_GET['range'];

        switch ($dateRange['range']) {

            case 'thisWeek':
                $dateRange['start'] = strtotime('mon this week'); // first of this month
                $dateRange['end'] = time(); // now
                break;
            case 'thisMonth':
                $dateRange['start'] = mktime(0, 0, 0, date('n'), 1); // first of this month
                $dateRange['end'] = time(); // now
                break;
            case 'lastWeek':
                $dateRange['start'] = strtotime('mon last week'); // first of last month
                $dateRange['end'] = strtotime('mon this week') - 1;  // first of this month
                break;
            case 'lastMonth':
                $dateRange['start'] = mktime(0, 0, 0, date('n') - 1, 1); // first of last month
                $dateRange['end'] = mktime(0, 0, 0, date('n'), 1) - 1;  // first of this month
                break;
            case 'thisYear':
                $dateRange['start'] = mktime(0, 0, 0, 1, 1);  // first of the year
                $dateRange['end'] = time(); // now
                break;
            case 'lastYear':
                $dateRange['start'] = mktime(0, 0, 0, 1, 1, date('Y') - 1);  // first of last year
                $dateRange['end'] = mktime(0, 0, 0, 1, 1, date('Y')) - 1;   // first of this year
                break;
            case 'all':
                $dateRange['start'] = 0;        // every record
                $dateRange['end'] = time();
                if (isset($_GET['end'])) {
                    $dateRange['end'] = $this->parseDate($_GET['end']);
                    if ($dateRange['end'] == false)
                        $dateRange['end'] = time();
                    else
                        $dateRange['end'] = strtotime('23:59:59', $dateRange['end']);
                }
                break;

            case 'custom':
            default:
                $dateRange['end'] = time();
                if (isset($_GET['end'])) {
                    $dateRange['end'] = $this->parseDate($_GET['end']);
                    if ($dateRange['end'] == false)
                        $dateRange['end'] = time();
                    else
                        $dateRange['end'] = strtotime('23:59:59', $dateRange['end']);
                }

                $dateRange['start'] = strtotime('1 month ago', $dateRange['end']);
                if (isset($_GET['start'])) {
                    $dateRange['start'] = $this->parseDate($_GET['start']);
                    if ($dateRange['start'] == false)
                        $dateRange['start'] = strtotime('-30 days 0:00', $dateRange['end']);
                    else
                        $dateRange['start'] = strtotime('0:00', $dateRange['start']);
                }
        }
        return $dateRange;
    }
    
    public static function ucwords_specific ($string, $delimiters = '', $encoding = NULL) 
    { 
        
        if ($encoding === NULL) { $encoding = mb_internal_encoding();} 

        if (is_string($delimiters)) 
        { 
            $delimiters =  str_split( str_replace(' ', '', $delimiters)); 
        } 

        $delimiters_pattern1 = array(); 
        $delimiters_replace1 = array(); 
        $delimiters_pattern2 = array(); 
        $delimiters_replace2 = array(); 
        foreach ($delimiters as $delimiter) 
        { 
            $ucDelimiter=$delimiter;
            $delimiter=strtolower($delimiter);
            $uniqid = uniqid(); 
            $delimiters_pattern1[]   = '/'. preg_quote($delimiter) .'/'; 
            $delimiters_replace1[]   = $delimiter.$uniqid.' '; 
            $delimiters_pattern2[]   = '/'. preg_quote($ucDelimiter.$uniqid.' ') .'/'; 
            $delimiters_replace2[]   = $ucDelimiter; 
            $delimiters_cleanup_replace1[]   = '/'. preg_quote($delimiter.$uniqid).' ' .'/'; 
            $delimiters_cleanup_pattern1[]   = $delimiter; 
        } 
        $return_string = mb_strtolower($string, $encoding); 
        //$return_string = $string; 
        $return_string = preg_replace($delimiters_pattern1, $delimiters_replace1, $return_string);

        $words = explode(' ', $return_string); 
        
        foreach ($words as $index => $word) 
        { 
            $words[$index] = mb_strtoupper(mb_substr($word, 0, 1, $encoding), $encoding).mb_substr($word, 1, mb_strlen($word, $encoding), $encoding); 
        } 
        $return_string = implode(' ', $words); 
        
        $return_string = preg_replace($delimiters_pattern2, $delimiters_replace2, $return_string);
        $return_string = preg_replace($delimiters_cleanup_replace1, $delimiters_cleanup_pattern1, $return_string);

        return $return_string; 
    } 
	
    /**
     * Print out the data in the json format.
     * @param array of data
     */
    public static function printJson($data)
    {
        header('Content-type: application/json');
        echo json_encode($data);
        Yii::app()->end();
    }

}
?>