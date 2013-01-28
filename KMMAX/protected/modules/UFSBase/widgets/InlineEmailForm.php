<?php
/**
 * Provides an inline form for sending email from a view page.
 * 
 * @package X2CRM.components 
 */
class InlineEmailForm extends X2Widget {

	public $model;
	public $attributes;

	public $errors = array();
	public $startHidden = false;
	
	public $fUserID ='testuser';
	public $emailUseSignature ='user';
	public $emailSignature = 'user';
	public $emailAddress='uprosoft@163.com';

	public function init() {
		// $this->startHidden = false;
	
		$this->model = new InlineEmail;
		$this->model->attributes = $this->attributes;
		$signature = $this->getSignature(true);
		
		//if message comes prepopulated, don't overwrite with signature
		if (empty($this->model->message)) {
			$this->model->message = empty($signature)? '' : '<br><br><!--BeginSig--><font face="Arial" size="2">'.$signature.'</font><!--EndSig-->';
		}
		
		// die(var_dump($this->model->attributes));
		
		if(isset($_POST['InlineEmail'])) {
			$this->model->attributes = $_POST['InlineEmail'];
			$this->startHidden = false;
		}

 		Yii::app()->clientScript->registerScript('toggleEmailForm',
		($this->startHidden? "window.hideInlineEmail = true;\n" : "window.hideInlineEmail = false;\n") .
		"function toggleEmailForm() {
			setupEmailEditor();
			
			if($('#inline-email-form .wide.form').hasClass('hidden')) {
				$('#inline-email-form .wide.form').removeClass('hidden');
				$('#inline-email-form .form.email-status').remove();
				return;
			}
			
			if($('#inline-email-form').is(':hidden')) {
				$('.focus-mini-module').removeClass('focus-mini-module');
				$('#inline-email-form').find('.wide.form').addClass('focus-mini-module');
				$('html,body').animate({
					scrollTop: ($('#inline-email-top').offset().top - 100)
				}, 300);
			}
			
			$('#inline-email-form').animate({
				opacity: 'toggle',
				height: 'toggle'
			}, 300); // ,function() {  $('#inline-email-form #InlineEmail_subject').focus(); }
			
			$('#InlineEmail_subject').addClass('focus');
			$('#InlineEmail_subject').focus();
			$('#InlineEmail_subject').blur(function() {
				$(this).removeClass('focus');
			});
		}
		
		$(function() {
			// give send-email module focus when clicked
		    $('#inline-email-form').click(function() {
		    	if(!$('#inline-email-form').find('.wide.form').hasClass('focus-mini-module')) {
		    		$('.focus-mini-module').removeClass('focus-mini-module');
		    		$('#inline-email-form').find('.wide.form').addClass('focus-mini-module');
		    	}
		    });
		    
		    // give send-email module focus when tinyedit clicked
		    $('#email-message').click(function() {
		        if(!$('#inline-email-form').find('.wide.form').hasClass('focus-mini-module')) {
		        	$('.focus-mini-module').removeClass('focus-mini-module');
		        	$('#inline-email-form').find('.wide.form').addClass('focus-mini-module');
		        }
		    });
		});
		",CClientScript::POS_HEAD);
		
		Yii::app()->clientScript->registerScript('inlineEmailFormCC',
		"$(document).delegate('#email-template','change',function() {
			if($(this).val() != '0') // && $('#email-subject').val() == ''
				$('#email-subject').val($(this).find(':selected').text());
			$('#preview-email-button').click();
		});
		
		",CClientScript::POS_READY);
		
		Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl() .'/js/inlineEmailForm.js');
		
		parent::init();
	}

	public function run() {
		$action = new InlineEmailAction($this->controller,'inlineEmail');
		$action->model = &$this->model;
		$action->run(); 
	}
	
/*================================================================================*/	
	
		public function getSignature($html = false) {
		
		//$adminRule = Yii::app()->params->admin->emailUseSignature;
		$adminRule ='user';
		$userRule = $this->emailUseSignature;
		
		//$userModel = CActiveRecord::model('User')->findByPk($this->fUserID);
		$signature = '';
		
		switch($adminRule) {
			case 'admin': $signature = $this->emailSignature; break;
			case 'user':
				switch($userRule) {
					case 'user': $signature = $signature = $this->emailSignature; break;
					case 'admin': $this->emailSignature; break;
					case 'group': $signature == ''; break;
					default: $signature == '';
				}
				break;
			case 'group': $signature == ''; break;
			default: $signature == '';
		}
		
		
		$signature = preg_replace(
			array(
				'/\{first\}/',
				'/\{last\}/',
				'/\{phone\}/',
				'/\{group\}/',
				'/\{email\}/',
			),
			array(
				'$userModel->fUserID',
				'$userModel->fUserID',
				'$this->fUserID',
				'',
				$html? CHtml::mailto($this->emailAddress) : $this->emailAddress,
			),
			$signature
		);
		if($html)
			$signature = $this->convertLineBreaks($signature);
			// $signature = '<span style="color:grey;">' . x2base::convertLineBreaks($signature) . '</span>';
			
		return $signature;
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
	
}
