<?php

include '../init.php';

echo "Start execute theme ", PHP_EOL;

App::cache()
    ->flush();

$themeId =  'default-dark';

$theme = \App::layout()
    ->theme()
    ->findThemeById($themeId);

echo "Compiling: ", $theme->getTitle(),  PHP_EOL;

\App::layout()
    ->theme()
    ->rebuildStylesheetForTheme($themeId);

echo "Set to system default: ", $theme->getTitle(),  PHP_EOL;

\App::layout()
    ->theme()
    ->setDefaultTheme($theme);

echo "Flush cache ", PHP_EOL;

\App::cache()
    ->flush();

echo "Done!", PHP_EOL;