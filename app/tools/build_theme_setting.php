<?php
include '../init.php';

$themes = app()->table('platform_layout_layout_theme')
    ->select()
    ->all();

foreach ($themes as $theme) {
    if (!$theme instanceof \Layout\Model\LayoutTheme) continue;

    $info = $theme->toArray();

    $extension = new \Core\Model\CoreExtension([
        'name'           => $theme->getId(),
        'title'          => 'Theme ' . $theme->getName(),
        'is_active'      => $theme->isActive(),
        'is_default'     => $theme->isDefault(),
        'extension_type' => 'theme',
        'path'           => '/theme/' . $theme->getId(),
        'namespace'      => '/theme/' . $theme->getId(),
        'is_system'      => 1,
        'created_at'     => '2015-04-25 08:29:51',
        'modified_at'    => '2015-04-25 08:29:51',
    ]);

    $extension->save();
}