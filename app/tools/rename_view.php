<?php
include '../init.php';

$paths = [
    KENDO_ROOT_DIR . '/app/theme',
    KENDO_ROOT_DIR . '/app/template',
];

foreach ($paths as $directory)
{
    $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory), \RecursiveIteratorIterator::CHILD_FIRST);

    foreach ($iterator as $info)
    {
        if (!$info->isFile()) continue;
        if ($info->getExtension() != 'tpl') continue;
        if ($info->getBaseName() != 'render1.logged.tpl') continue;


        echo dirname($info->getPathName()), PHP_EOL;

        copy($info->getPath() . '/render1.logged.tpl', $info->getPath(). '/view.logged.tpl');
        unlink($info->getPath() . '/render1.logged.tpl');

        echo $from =  dirname($info->getPath()), PHP_EOL;

//        $info->getBaseName(), PHP_EOL;
        continue;
        $pathname = $info->getPathname();

        $script = trim(substr($pathname, strlen($directory)), DIRECTORY_SEPARATOR);

        $script = trim(str_replace(DIRECTORY_SEPARATOR, '/', substr($script, 0, strlen($script) - 4)), '/');

        if (!empty($files[ $script ])) continue;

        $files[ $script ] = substr($directory, strlen(KENDO_ROOT_DIR));
    }
}