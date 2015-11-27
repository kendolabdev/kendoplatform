<?php

include '../init.php';

echo "Start execute theme ", PHP_EOL;

App::cacheService()
    ->flush();

$themeId =  'default-dark';

$theme = \App::layoutService()
    ->theme()
    ->findThemeById($themeId);

echo "Compiling: ", $theme->getTitle(),  PHP_EOL;

\App::layoutService()
    ->theme()
    ->rebuildStylesheetForTheme($themeId);

echo "Set to system default: ", $theme->getTitle(),  PHP_EOL;

\App::layoutService()
    ->theme()
    ->setDefaultTheme($theme);

echo "Flush cache ", PHP_EOL;

\App::cacheService()
    ->flush();

echo "Done!", PHP_EOL;