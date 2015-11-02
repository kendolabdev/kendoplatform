<?php

define('PICASO_ROOT_DIR', dirname(dirname(__FILE__)));

$general_config = PICASO_ROOT_DIR . '/app/config/general.conf.php';
$htaccess_config = PICASO_ROOT_DIR . '/.htaccess';

if (!file_exists($general_config)) {

    $dir = str_replace('//', '/', '/' . trim(dirname(dirname(substr($_SERVER['SCRIPT_FILENAME'], strlen($_SERVER['DOCUMENT_ROOT'])))), '/') . '/');


    $content = file_get_contents(PICASO_ROOT_DIR . '/app/config/general.conf.example');
    $content = strtr($content, [
        'BASE_DIR_VALUE' => $dir,
        'BASE_URL_VALUE' => $dir,
    ]);
    file_put_contents($general_config, $content);
    @chmod($general_config, 0777);

    $content = file_get_contents(PICASO_ROOT_DIR . '/htaccess.txt');
    $content = strtr($content, [
        'BASE_DIR_VALUE' => $dir,
        'BASE_URL_VALUE' => $dir,
    ]);
    file_put_contents($htaccess_config, $content);
}


$step = isset($_GET['_step']) ? $_GET['_step'] : 'start';

define('PICASO_INSTALLATION', true);

include_once '../app/init.php';

\App::autoload()->addNamespace('Installation', dirname(__FILE__) . '/Installation');


switch ($step) {
    case 'db':
        include_once 'db.php';
        break;
    case 'account':
        include_once 'account.php';
        break;
    case 'complete':
        \App::cache()
            ->flush();
        include_once 'views/complete.tpl';
        break;
    case 'start':
    default:
        include_once 'start.php';
}

