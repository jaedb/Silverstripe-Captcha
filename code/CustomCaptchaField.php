<?php
/**
 *  MathSpamProtectorField: basically a TextField copy with a
 *  fixed maxlength setting, that validates against the
 *  given MathSpamProtection setting
 *
 *  20-09-2010
 *  @author: M. Bloem, Balbus Design
 */
class CustomCaptchaField extends SpamProtectorField {

	/**
	 * Creates an input field, class="text" and type="text"
	 * with a 'fixed label' to which the current
	 * MathSpamProtection question is added.
	 */
	function __construct($name, $title = null, $value = "", $form = null){
		
		// initiate captcha
		include("CustomCaptchaImage.php");
		$_SESSION['captcha'] = captcha();
		
		// add the MathSpamProtection question
		//$title .= MathSpamProtection::getMathQuestion();
		$title = 'Please enter code';
		
		parent::__construct($name, $title, $value, $form);
	}


    /*
     *  These values are copied from the TextField class,
     *  where only the maxlength and size settings are different
     */
	function Field() {
		$attributes = array(
			'type' => 'text',
			'class' => 'CustomCaptchaField',
			'id' => $this->id(),
			'name' => $this->Name(),
			'value' => $this->Value(),
			'tabindex' => $this->getTabIndex(),
			'maxlength' => 5,
			'size' => 30
		);
		
		// create image to display code
		$html =  '<img src='.$_SESSION['captcha']['image_src'].'" class="customcaptcha-image" alt="CAPTCHA security code" />';
		
		// include javascript behaviours
		$html .= '<script type="text/javascript" src="customcaptcha/js/effects.js"></script>';
		
		// parse code to javascript
		$html .= '<script type="text/javascript">var customCaptchaCode = "'.hash('sha256',$_SESSION['captcha']['code']).'";</script>';
		
		// create input field
		$html .= $this->createTag('input', $attributes);
		
		// parse captcha code into customcaptcha session
		$_SESSION['customcaptcha'] = $_SESSION['captcha']['code'];
		
		// return html
		return $html;
			
	}


	/*
	 *  Validation
	 *  This is used as a backup if javascript is disabled
	 */
	function validate($validator){
		
		$this->value = trim($this->value);
		
		$customCaptchaCode = $_SESSION['customcaptcha'];
		
		if(!$this->value || $this->value != $customCaptchaCode ) {
			$validator->validationError(
			$this->name,
				_t(
				  'MathSpamProtectionField.VALIDATION',
				  'Codes do not match, please try again'
				),
				'validation'
			);
		}
		
	}
}

