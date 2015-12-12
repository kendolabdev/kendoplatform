<?php
include '../init.php';

$paths = [
    KENDO_ROOT_DIR . '/app/bundle/platform/src/Platform',
];

foreach ($paths as $directory)
{
    $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory), \RecursiveIteratorIterator::CHILD_FIRST);

    foreach ($iterator as $info)
    {
        if (!$info->isFile()) continue;
        if ($info->getBaseName() != 'EventHandlerService.php') continue;


        echo $info->getPathName(), PHP_EOL;
        copy($info->getPathName(), $info->getPath(). '/DispatcherService.php');
        unlink($info->getPathName());

        continue;
        $pathname = $info->getPathname();

        $script = trim(substr($pathname, strlen($directory)), DIRECTORY_SEPARATOR);

        $script = trim(str_replace(DIRECTORY_SEPARATOR, '/', substr($script, 0, strlen($script) - 4)), '/');

        if (!empty($files[ $script ])) continue;

        $files[ $script ] = substr($directory, strlen(KENDO_ROOT_DIR));
    }
}