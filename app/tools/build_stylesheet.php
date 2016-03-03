<?php

include '../init.php';

echo "Start execute theme ", PHP_EOL;

App::cacheService()
    ->flush();

$themeId = isset($argv[1]) ? $argv[1] : null;

if (null == $themeId)
{
    $themeId = \App::layouts()
        ->getEditingThemeId();
}


$theme = \App::layouts()
    ->theme()
    ->findThemeById($themeId);

echo "Compiling: ", $theme->getTitle(), PHP_EOL;

\App::layouts()
    ->theme()
    ->rebuildStylesheetForTheme($themeId);

echo "Set to system default: ", $theme->getTitle(), PHP_EOL;

\App::layouts()
    ->theme()
    ->setDefaultTheme($theme);

echo "Flush cache ", PHP_EOL;

\App::cacheService()
    ->flush();

echo "Done!", PHP_EOL;