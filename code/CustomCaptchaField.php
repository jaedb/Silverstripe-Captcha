<?php

class CustomCaptchaField extends SpamProtectorField {
	
	// CONSTRUCT FORM FIELD
	
	function __construct($name, $title = null, $value = "", $form = null){
		
		// initiate captcha
		include("CustomCaptchaImage.php");
		$_SESSION['captcha'] = captcha();
		
		// add the label
		$title = 'Please enter code';
		
		parent::__construct($name, $title, $value, $form);
	}

	// FORM INPUT CONSTRUCTION
	
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
		
		// parse SHA256'd code to javascript
		$html .= '<script type="text/javascript">var customCaptchaCode = "'.hash('sha256',$_SESSION['captcha']['code']).'";</script>';
		
		// create input field
		$html .= $this->createTag('input', $attributes);
		
		// parse captcha code into CustomCaptcha session
		$_SESSION['customcaptcha'] = $_SESSION['captcha']['code'];
		
		// return html
		return $html;
			
	}


	// SERVER-SIDE VALIDATION (to ensure a browser with javascript disabled doesn't bypass validation)
	
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

