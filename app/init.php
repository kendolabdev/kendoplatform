<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 */

/**
 * Security check constant. <br/>
 * defined('PICASO') or die("Access denied.");
 */
define('PICASO', true);

/**
 * Define base url
 */
define('PICASO_BASE_DIR', '/picaso/');

/**
 * base path to root etc "https://your_site/base_dir/"
 *
 * @var string
 */
define('PICASO_BASE_URL', '/picaso/');


// for debug only
register_shutdown_function(function () {
    if (null != ($err = error_get_last())) {
        echo json_encode($err);
    }
});

/**
 * Define picaso database table prefix
 */
define('PICASO_TABLE_PREFIX', 'picaso_');


/**
 * Check required version php
 */
if (version_compare(phpversion(), '5.4.0', '<')) {
    exit('Required at least php 5.4');
}

/**
 * Is in command line mode
 */
define('PICASO_CLI', PHP_SAPI === 'cli');

/**
 * enabled disabled debug mode
 */
define('PICASO_DEBUG', true);

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
define('PICASO_DATE_TIME', date('Y-m-d H:i:s'));

/**
 * Define picaso charset
 * value utf8
 */
define('PICASO_CHARSET', 'utf8');

/**
 * Picaso default language "en"
 */
define('PICASO_LANGUAGE', 'en');

/**
 * @var int
 */
define('PICASO_START_TIME', microtime(true));

/**
 * ./
 * @var string
 */
defined('PICASO_ROOT_DIR') or define('PICASO_ROOT_DIR', dirname(dirname(__FILE__)));

/**
 * ./include
 *
 * @var string
 */
defined('PICASO_CONFIG_DIR') or define('PICASO_CONFIG_DIR', PICASO_ROOT_DIR . '/app/config');


/**
 *
 */
defined('PICASO_TEMPLATE_PATH') or define('PICASO_TEMPLATE_PATH', PICASO_ROOT_DIR . '/app/template');

/**
 * Directory separator
 *
 * @var string
 */
defined('define') or define('PICASO_DS', DIRECTORY_SEPARATOR);


/**
 * ./vendor
 *
 * @var string
 */
defined('PICASO_VENDOR_DIR') or define('PICASO_VENDOR_DIR', PICASO_ROOT_DIR . '/app/vendor');

/**
 * ./public
 *
 * @var string
 */
defined('PICASO_PUBLIC_DIR') or define('PICASO_PUBLIC_DIR', PICASO_ROOT_DIR . '/public');

/**
 * ./temp
 *
 * @var string
 */
defined('PICASO_TEMP_DIR') or define('PICASO_TEMP_DIR', PICASO_ROOT_DIR . '/app/temp');

/**
 * upload file
 */
defined('PICASO_UPLOAD_DIR') or define('PICASO_UPLOAD_DIR', PICASO_TEMP_DIR . '/upload');

/**
 * ./module
 *
 * @var string
 */
define('PICASO_MODULE_DIR', PICASO_ROOT_DIR . '/app/bundle');


/**
 * @var int
 * Default role id
 */
define('PICASO_DEFAULT_ROLE_ID', 4);

/**
 * Default role id
 *
 * @var int
 */
define('PICASO_GUEST_ROLE_ID', 11);

/**
 * Constant of secket key, private for your application.
 * WARNING! Do not share secret key to anyone.
 */
define('PICASO_SECRET_KEY', 'abx');

/**
 * Define all column name
 */
define('PICASO_KEY_COLUMN', 'column');


/**
 * Define identity column name
 */
define('PICASO_KEY_IDENTITY', 'identity');

/**
 * Define primary key
 */
define('PICASO_KEY_PRIMARY', 'primary');

/**
 * Define key driver
 */
define('PICASO_KEY_DRIVER', 'driver');

/**
 * Define Key table name
 */
define('PICASO_KEY_TABLE', 'table');

/**
 * Vendor autoload by composer
 */
include_once PICASO_VENDOR_DIR . '/autoload.php';


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
 * @param $array
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


include_once PICASO_MODULE_DIR . '/picaso/src/Picaso/Autoload/Manager.php';
include_once PICASO_MODULE_DIR . '/picaso/src/Picaso/Registry/Manager.php';
include_once PICASO_MODULE_DIR . '/picaso/src/Picaso/Db/Manager.php';
include_once PICASO_MODULE_DIR . '/picaso/src/Picaso/Session/Manager.php';
include_once PICASO_MODULE_DIR . '/picaso/src/Picaso/ServiceManager.php';
include_once PICASO_MODULE_DIR . '/picaso/src/Picaso/App.php';

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
    return \App::request()->isMobile() ? (\App::request()->isTablet() ? $tablet : $mobile) : $desktop;
}

/**
 * add package manager
 */
\App::autoload()->addNamespaces([
    'Core' => PICASO_MODULE_DIR . '/base/src/Core/',
]);