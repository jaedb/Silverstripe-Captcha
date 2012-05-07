
SILVERSTRIPE MODULE: CUSTOMCAPTCHA
- Compiled by James Barnsley
- http://jamesbarnsley.co.nz
- May 2012


------------------------------------- DESCRIPTION ---
-----------------------------------------------------

This CustomCaptcha module extends the functionality of Silverstripe's 'SpamProtection' and 'UserForms' modules to allow clean, secure and user-friendly Captcha validation.



------------------------------------ INSTALLATION ---
-----------------------------------------------------

1 - Install the SpamProtection Module (http://www.silverstripe.org/spam-protection-module).
    This module enables all kinds of spam protection and is an extension built by SilverStripe themselves

2 - Install the UserForms Module (http://www.silverstripe.org/user-forms-module/)
    This module enables extremely user-friendly form building within the CMS

3 - Install SilverstripeCaptcha (this module)
    To install (as per previous modules), extract the files and copy the folder into the root of your Silverstripe install (ie public_html/silverstripecaptcha/)

4 - Set your Spam Protector as CustomCaptcha in your site's config (usually /mysite/_config.php)
    Add this line to the end of the _config.php file:
    SpamProtectorManager::set_spam_protector('CustomCaptcha');

5 - Run a cache build (/dev?build=1)

6 - In your UserForms form, you will now see a new form type 'Validation'. This is where your new captcha will appear.

7 - Done!

    


----------------------------------------- CREDITS ---
-----------------------------------------------------

PHP CAPTCHA IMAGE GENERATOR:
Copyright 2011 Cory LaViska for A Beautiful Site, LLC. (http://abeautifulsite.net/)
Dual licensed under the MIT / GPLv2 licenses

JAVASCRIPT SHA256 FUNCTION:
Copyright (c) 2008-2009, Alex Weber	