<?php

include '../init.php';

app()->coreService()
    ->hook()
    ->scanHookFromEnableModulesThenImportToRepository();

echo 'Rebuild hook: DONE', PHP_EOL;

app()->cacheService()
    ->flush();

echo 'Flush cached: DONE', PHP_EOL;