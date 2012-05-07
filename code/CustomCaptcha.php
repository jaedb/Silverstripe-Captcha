<?php

class CustomCaptcha implements SpamProtector {
	
	// BUILDS CAPTCHA FORM FIELD
	
	function getFormField($name = 'Math', $title = '',
	                      $value = null, $form = null,
	                      $rightTitle = null) {
	                      $title = _t(
	                          'Spam protection question',
	                          'Spam protection: '
	                      );
		return new CustomCaptchaField(
			$name, $title, $value, $form, $rightTitle
		);
	}


	/**
	 *  Function required to handle dynamic feedback of the system.
	 *  if unneeded just return true
	 *
	 *  @return true
	 */
	public function sendFeedback($object = null, $feedback = ""){
		return true;
	}
}