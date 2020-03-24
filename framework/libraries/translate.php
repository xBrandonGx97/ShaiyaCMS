<?php //Import php-gettext libraries
    require_once 'streams.php';
    require_once 'gettext.php';

    // Constant value to check actual lang on templates
    define('CURRENT_LANG', LANG);

    // Init php-gettext classes
    $locale_lang = CURRENT_LANG;
    //echo 'locale lang: '.CURRENT_LANG;
    global $locale_file;
    $locale_file = new FileReader(CONFIG['ROOT'] . '/resources/locale/' . LANG . '/LC_MESSAGES/messages.mo');
    global $locale_fetch;
    $locale_fetch = new gettext_reader($locale_file);

    //echo 'trans:'.$locale_fetch->translate("test");

    /**
     * FUNCTIONS
     */

    // Return the translated string as value
    function __($text)
    {
        global $locale_fetch;
        return $locale_fetch->translate($text);
    }

    // Print the translates string
    function _e($text)
    {
        global $locale_fetch;
        echo $locale_fetch->translate($text);
    }
