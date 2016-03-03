<?php

/**
 * Security check constant. <br/>
 * defined('KENDO') or die("Access denied.");
 */
define('KENDO',true);

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

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);


// for debug only
register_shutdown_function(function () {
    if (null != ($err = error_get_last())) {
        echo json_encode($err);
    }
});

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
 * Is in command line mode
 */
defined('KENDO_CLI') or define('KENDO_CLI', PHP_SAPI === 'cli');

/**
 * enabled disabled debug mode
 */
defined('KENDO_DEBUG') or define('KENDO_DEBUG', true);

/**
 * Example: 2015-12-29 11:20:00
 *
 * @var string 'YYYY-MM-DD HH:ii:ss'
 */
defined('KENDO_DATE_TIME') or define('KENDO_DATE_TIME', date('Y-m-d H:i:s'));

/**
 * Define picaso charset
 * value utf8
 */
defined('KENDO_CHARSET') or define('KENDO_CHARSET', 'utf8');

/**
 * Kendo default language "en"
 */
defined('KENDO_LANGUAGE') or define('KENDO_LANGUAGE', 'en');

/**
 * @var int
 */
defined('KENDO_START_TIME') or define('KENDO_START_TIME', microtime(true));

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
defined('KENDO_STATIC_DIR') or define('KENDO_STATIC_DIR', KENDO_ROOT_DIR . '/static');

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
defined('KENDO_BUNDLE_DIR') or define('KENDO_BUNDLE_DIR', KENDO_ROOT_DIR . '/app/bundle');


/**
 * @var int
 * Default role id
 */
defined('KENDO_DEFAULT_ROLE_ID') or define('KENDO_DEFAULT_ROLE_ID', 3);

/**
 * Default role id
 *
 * @var int
 */
defined('KENDO_GUEST_ROLE_ID') or define('KENDO_GUEST_ROLE_ID', 1);


/**
 * Constant of secret key, private for your application.
 * WARNING! Do not share secret key to anyone.
 */
defined('KENDO_SECRET_KEY') or define('KENDO_SECRET_KEY', 'abx');

/**
 * Owner only privacy
 */
defined('RELATION_TYPE_OWNER') or define('RELATION_TYPE_OWNER', 0);

/**
 * Public privacy
 */
defined('RELATION_TYPE_ANYONE') or define('RELATION_TYPE_ANYONE', 1);

/**
 * Registered can view privacy
 */
defined('RELATION_TYPE_REGISTERED') or define('RELATION_TYPE_REGISTERED', 2);

/**
 * Member's of owner privacy
RELATION_TYPE_MEMBER
defined('RELATION_TYPE_MEMBER') or define('RELATION_TYPE_MEMBER', 4);

/**
 * Member of member of owner privacy
 */
defined('RELATION_TYPE_MEMBER_OF_MEMBER') or define('RELATION_TYPE_MEMBER_OF_MEMBER', 5);

/**
 * Admin list
 * Preserve value for page, event, store etc ...
 */
defined('RELATION_TYPE_ADMIN') or define('RELATION_TYPE_ADMIN', 6);

/**
 * Officier member list
 * Preserve value
 */
defined('RELATION_TYPE_OFFICER') or define('RELATION_TYPE_OFFICER', 7);

/**
 * Moderator member list
 * Preserve value
 */
defined('RELATION_TYPE_MODERATOR') or define('RELATION_TYPE_MODERATOR', 8);

/**
 * Editor member list
 * Preserve value
 */
defined('RELATION_TYPE_EDITOR') or define('RELATION_TYPE_EDITOR', 9);

/**
 * Custom list privacy added by member lists.
 */
defined('RELATION_TYPE_CUSTOM') or define('RELATION_TYPE_CUSTOM', 100);

/**
 * Check and define unitest
 */

defined('KENDO_UNITEST') or define('KENDO_UNITEST', false);

/**
 * Log level "LOG"
 */
defined('LOG_LEVEL_LOG') or define('LOG_LEVEL_LOG', 'LOG');

/**
 * Log level "DEBUG"
 */
defined('LOG_LEVEL_DEBUG') or define('LOG_LEVEL_DEBUG', 'DEBUG');

/**
 * Log level "INFO"
 */
defined('LOG_LEVEL_INFO') or define('LOG_LEVEL_INFO', 'INFO');

/**
 * Log level "NOTICE"
 */
defined('LOG_LEVEL_NOTICE') or define('LOG_LEVEL_NOTICE', 'NOTICE');

/**
 * Log level "WARN"
 */
defined('LOG_LEVEL_WARNING') or define('LOG_LEVEL_WARNING', 'WARN');

/**
 * Log level "CRIT"
 */
defined('define') or define('LOG_LEVEL_CRIT', 'CRIT');

defined('KENDO_PROFILER') or define('KENDO_PROFILER', true);


/**
 * Vendor autoload by composer
 */
include_once KENDO_VENDOR_DIR . '/autoload.php';


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

include_once KENDO_BUNDLE_DIR . '/platform/src/Kendo/Kernel/ServiceInterface.php';
include_once KENDO_BUNDLE_DIR . '/platform/src/Kendo/Kernel/KernelServiceAgreement.php';
include_once KENDO_BUNDLE_DIR . '/platform/src/Kendo/Kernel/Application.php';
include_once KENDO_BUNDLE_DIR . '/platform/src/Kendo/Kernel/ClassAutoload.php';
include_once KENDO_BUNDLE_DIR . '/platform/src/Kendo/Registry/Manager.php';
include_once KENDO_BUNDLE_DIR . '/platform/src/Kendo/Db/DbManager.php';
include_once KENDO_BUNDLE_DIR . '/platform/src/Kendo/App.php';

\App::instance()->start();

/**
 * @param mixed $desktop
 * @param mixed $tablet
 * @param mixed $mobile
 *
 * @return mixed
 */
function _screen($desktop, $tablet, $mobile)
{
    return \App::requester()->isMobile() ?
        (\App::requester()->isTablet() ? $tablet : $mobile) :
        $desktop;
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

/**
 * Get Upper Words of string, No whitespace
 *
 * @param $string
 *
 * @return string Return "Upper Words" of string
 */
function _inflect($string)
{
    return str_replace(' ', '', ucwords(str_replace(['.', '-'], ' ', $string)));
}

/**
 * Get Lower Case Words of string
 *
 * @param $string
 *
 * @return string Return "Lower Case Words" of string, joined White Space by "-"
 */
function _deflect($string)
{
    return strtolower(trim(preg_replace('/([a-z0-9])([A-Z])/', '\1-\2', $string), '-. '));
}

/**
 * Get Lower Case Words of string
 *
 * @param string|array $string
 *
 * @return string Return "Lower Case Words" of string, joined White Space by "_"
 */
function _underscore($string)
{
    if (is_array($string)) {
        $string = implode('.', $string);
    }

    return preg_replace('/\W+/', '', strtolower(trim(preg_replace('/([a-z0-9])([^a-z0-9])/', '\1_\2', $string), '.- ')));
}