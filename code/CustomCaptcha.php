<?php
/**
 *  MathProtector: The protector implements MathSpamProtection
 *  by returning the required FormField (the MathProtectorField)
 *
 *  uses: the spamprotection mdule
 *
 *  Enable: SpamProtectorManager::set_spam_protector('MathSpamProtector');
 *
 *  20-09-2010
 *  @author: M. Bloem, Balbus Design
 */
class CustomCaptcha implements SpamProtector {

	/**
	 * Return the Field that we will use in this protector
	 *
	 * @return CustomCaptchaField
	 */
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