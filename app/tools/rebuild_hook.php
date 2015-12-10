<?php

include '../init.php';

\App::coreService()
    ->hook()
    ->scanHookFromEnableModulesThenImportToRepository();

echo 'Rebuild hook: DONE', PHP_EOL;

\App::cacheService()
    ->flush();

echo 'Flush cached: DONE', PHP_EOL;