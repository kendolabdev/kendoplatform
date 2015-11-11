<?php

include '../init.php';

App::cache()
    ->flush();

\App::layout()
    ->theme()
    ->rebuildStylesheetForTheme('admin');