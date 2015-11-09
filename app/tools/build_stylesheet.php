<?php

include '../init.php';

App::cache()
    ->flush();

$themeId =  \App::layout()
    ->theme()
    ->getDefaultThemeId();

\App::layout()
    ->theme()
    ->rebuildStylesheetForTheme($themeId);