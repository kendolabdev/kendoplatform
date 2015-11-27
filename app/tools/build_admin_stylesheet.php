<?php

include '../init.php';

App::cacheService()
    ->flush();

\App::layoutService()
    ->theme()
    ->rebuildStylesheetForTheme('admin');