<?php
include '../init.php';

$themes = \App::table('layout.layout_theme')
    ->select()
    ->all();

foreach ($themes as $theme) {
    if (!$theme instanceof \Layout\Model\LayoutTheme) continue;

    $info = $theme->toArray();

    $info['paths'] = [
        "/app/theme/" . $theme->getId(),
        "/static/theme/" . $theme->getId(),
    ];

    $filename = PICASO_ROOT_DIR . "/app/theme/" . $theme->getId() . "/info.json";

    file_put_contents($filename, json_encode($info,JSON_PRETTY_PRINT));

    chmod($filename, 0777);
}
