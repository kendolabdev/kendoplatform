<?php

define('PICASO_UNIT_TEST', true);
ini_set('PICASO_DEBUG', false);


include dirname(dirname(__FILE__)) . '/init.php';

ini_set('display_startup_errors',0);
ini_set('display_errors',1);

\App::autoload()
    ->addNamespace('TestBase', PICASO_ROOT_DIR . '/app/tests/base');

