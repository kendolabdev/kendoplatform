<?php

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

