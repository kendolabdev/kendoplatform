<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 */

/**
 * Security check constant. <br/>
 * defined('KENDO') or die("Access denied.");
 */
define('KENDO', true);

/**
 * Check required version php
 */
if (version_compare(phpversion(), '5.4.0', '<')) {
    exit('Required at least php 5.4');
}

/**
 * Include general config
 */
if (!file_exists('config/general.conf.php')) {
    include 'config/general.conf.php';
} else {
    include 'config/general.conf.php';
}


// for debug only
register_shutdown_function(function () {
    if (null != ($err = error_get_last())) {
        echo json_encode($err);
    }
});


/**
 * Is in command line mode
 */
define('KENDO_CLI', PHP_SAPI === 'cli');

/**
 * enabled disabled debug mode
 */
define('KENDO_DEBUG', true);


/**
 * Set default timezone
 */
date_default_timezone_set('UTC');


/**
 * Config php 5.6
 *
 * @link http://php.net/manual/en/ini.core.php#ini.default-charset
 */
if (version_compare(PHP_VERSION, '5.6', '<')) {
    if (function_exists('mb_internal_encoding')) {
        mb_internal_encoding("UTF-8");
    }

    if (function_exists('iconv_set_encoding')) {
        // Not sure if we want to do all of these
        iconv_set_encoding("input_encoding", "UTF-8");
        iconv_set_encoding("output_encoding", "UTF-8");
        iconv_set_encoding("internal_encoding", "UTF-8");
    }
}


/**
 * Reset error reporting <br/>
 * Production mode: E_ALL & E_STRICT & E_NOTICE & E_WARNING
 * Developement mode: E_ALL
 *
 */
error_reporting(E_ALL & E_STRICT & E_NOTICE & E_WARNING);

/**
 * Example: 2015-12-29 11:20:00
 *
 * @var string 'YYYY-MM-DD HH:ii:ss'
 */
define('KENDO_DATE_TIME', date('Y-m-d H:i:s'));

/**
 * Define picaso charset
 * value utf8
 */
define('KENDO_CHARSET', 'utf8');

/**
 * Kendo default language "en"
 */
define('KENDO_LANGUAGE', 'en');

/**
 * @var int
 */
define('KENDO_START_TIME', microtime(true));

/**
 * ./
 * @var string
 */
defined('KENDO_ROOT_DIR') or define('KENDO_ROOT_DIR', dirname(dirname(__FILE__)));

/**
 * ./include
 *
 * @var string
 */
defined('KENDO_CONFIG_DIR') or define('KENDO_CONFIG_DIR', KENDO_ROOT_DIR . '/app/config');


/**
 * Static Directory
 */
define('KENDO_STATIC_DIR', KENDO_ROOT_DIR . '/static');

/**
 *
 */
defined('KENDO_TEMPLATE_DIR') or define('KENDO_TEMPLATE_DIR', KENDO_ROOT_DIR . '/app/template');

/**
 * Directory separator
 *
 * @var string
 */
defined('define') or define('KENDO_DS', DIRECTORY_SEPARATOR);


/**
 * ./vendor
 *
 * @var string
 */
defined('KENDO_VENDOR_DIR') or define('KENDO_VENDOR_DIR', KENDO_ROOT_DIR . '/app/vendor');

/**
 * ./public
 *
 * @var string
 */
defined('KENDO_PUBLIC_DIR') or define('KENDO_PUBLIC_DIR', KENDO_ROOT_DIR . '/public');

/**
 * ./temp
 *
 * @var string
 */
defined('KENDO_TEMP_DIR') or define('KENDO_TEMP_DIR', KENDO_ROOT_DIR . '/app/temp');

/**
 * upload file
 */
defined('KENDO_UPLOAD_DIR') or define('KENDO_UPLOAD_DIR', KENDO_TEMP_DIR . '/upload');

/**
 * ./module
 *
 * @var string
 */
define('KENDO_BUNDLE_DIR', KENDO_ROOT_DIR . '/app/bundle');


/**
 * @var int
 * Default role id
 */
define('KENDO_DEFAULT_ROLE_ID', 4);

/**
 * Default role id
 *
 * @var int
 */
define('KENDO_GUEST_ROLE_ID', 11);

/**
 * Constant of secret key, private for your application.
 * WARNING! Do not share secret key to anyone.
 */
define('KENDO_SECRET_KEY', 'abx');

/**
 * Define all column name
 */
define('KENDO_KEY_COLUMN', 'column');


/**
 * Define identity column name
 */
define('KENDO_KEY_IDENTITY', 'identity');

/**
 * Define primary key
 */
define('KENDO_KEY_PRIMARY', 'primary');

/**
 * Define key driver
 */
define('KENDO_KEY_DRIVER', 'driver');

/**
 * Define Key table name
 */
define('KENDO_KEY_TABLE', 'table');

/**
 * Vendor autoload by composer
 */
include_once KENDO_VENDOR_DIR . '/autoload.php';


/**
 * Owner only privacy
 */
define('RELATION_TYPE_OWNER', 0);

/**
 * Public privacy
 */
define('RELATION_TYPE_ANYONE', 1);

/**
 * Registered can view privacy
 */
define('RELATION_TYPE_REGISTERED', 2);

/**
 * Member's of owner privacy
 */
define('RELATION_TYPE_MEMBER', 4);

/**
 * Member of member of owner privacy
 */
define('RELATION_TYPE_MEMBER_OF_MEMBER', 5);

/**
 * Admin list
 * Preserve value for page, event, store etc ...
 */
define('RELATION_TYPE_ADMIN', 6);

/**
 * Officier member list
 * Preserve value
 */
define('RELATION_TYPE_OFFICER', 7);

/**
 * Moderator member list
 * Preserve value
 */
define('RELATION_TYPE_MODERATOR', 8);

/**
 * Editor member list
 * Preserve value
 */
define('RELATION_TYPE_EDITOR', 9);

/**
 * Custom list privacy added by member lists.
 */
define('RELATION_TYPE_CUSTOM', 100);

/**
 * Check and define unitest
 */

defined('KENDO_UNITEST') or define('KENDO_UNITEST', false);

/**
 * Log level "LOG"
 */
define('LOG_LEVEL_LOG', 'LOG');

/**
 * Log level "DEBUG"
 */
define('LOG_LEVEL_DEBUG', 'DEBUG');

/**
 * Log level "INFO"
 */
define('LOG_LEVEL_INFO', 'INFO');

/**
 * Log level "NOTICE"
 */
define('LOG_LEVEL_NOTICE', 'NOTICE');

/**
 * Log level "WARN"
 */
define('LOG_LEVEL_WARNING', 'WARN');

/**
 * Log level "CRIT"
 */
define('LOG_LEVEL_CRIT', 'CRIT');


/**
 * Escape json string to html attribute so javascript can load directly.
 *
 * @param $string
 *
 * @return string
 */
function _escape($string)
{
    if (is_array($string)) {
        $string = json_encode($string);
    } else {
        $string = (string)$string;
    }

    return str_replace('\'', "&#39;", $string);
}

/**
 * @param array $array
 *
 * @return string
 */
function _htmlattrs($array)
{
    $part = [];
    foreach ($array as $key => $value) {
        $part[] = sprintf('%s="%s"', $key, $value);
    }

    return implode($part);
}


include_once KENDO_BUNDLE_DIR . '/kendo/src/Kendo/Autoload/Manager.php';
include_once KENDO_BUNDLE_DIR . '/kendo/src/Kendo/Registry/Manager.php';
include_once KENDO_BUNDLE_DIR . '/kendo/src/Kendo/Db/Manager.php';
include_once KENDO_BUNDLE_DIR . '/kendo/src/Kendo/Session/Manager.php';
include_once KENDO_BUNDLE_DIR . '/kendo/src/Kendo/ServiceManager.php';
include_once KENDO_BUNDLE_DIR . '/kendo/src/Kendo/App.php';

\App::load();

/**
 * @param mixed $desktop
 * @param mixed $tablet
 * @param mixed $mobile
 *
 * @return mixed
 */
function _screen($desktop, $tablet, $mobile)
{
    return \App::requestService()->isMobile() ? (\App::requestService()->isTablet() ? $tablet : $mobile) : $desktop;
}

/**
 *
 */
function _dump()
{
    echo '<pre>', var_export(func_get_args(), 1), '</pre>';
    die;
}

/**
 * @param        $array
 * @param        $name
 * @param string $default
 *
 * @return string
 */
function _array_get(&$array, $name, $default = '')
{
    return isset($array[ $name ]) ? $array[ $name ] : $default;
}