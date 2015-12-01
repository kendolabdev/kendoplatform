<?php

include '../init.php';

\App::coreService()
    ->hook()
    ->scanHookFromEnableModulesThenImportToDatabase();

echo 'Rebuild hook: DONE', PHP_EOL;

\App::cacheService()
    ->flush();

echo 'Flush cached: DONE', PHP_EOL;