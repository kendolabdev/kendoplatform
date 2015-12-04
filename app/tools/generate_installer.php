<?php

include '../init.php';

$modules = \App::extensions()
    ->getActiveModuleNames();

$allTableList = \App::db()->getMaster()
    ->tables();

/**
 *
 */
foreach ($modules as $moduleName)
{
    $namespace = ucfirst($moduleName);

    $oldDir = PICASO_ROOT_DIR . '/app/bundle/base/src/' . $namespace . '/Install';

    if (is_dir($oldDir))
    {
        @unlink($oldDir . '/package.json');
        rmdir($oldDir);
    }


    $filename = PICASO_ROOT_DIR . '/app/bundle/base/src/' . $namespace . '/Service/InstallerService.php';

    if (file_exists($filename) && !strpos(file_get_contents($filename), 'code generator'))
        continue;

    $content = file_get_contents('_generate_installer_service.txt');

    $acceptTableList = [];

    foreach ($allTableList as $tableName)
    {
        if (strpos($tableName, 'picaso_' . $moduleName) === 0)
        {
            $acceptTableList[] = substr($tableName, strlen('picaso_'));
        }
    }

    $pathList = [
        'app/bundle/base/src/' . $namespace,
        'app/template/default/base/' . $moduleName,
        'app/theme/default/sass/base/' . $moduleName,
        'app/theme/admin/sass/base/' . $moduleName,
        'static/jscript/base/' . $moduleName,
    ];

    if ($moduleName == 'core')
    {
        $pathList = array_merge([
            'robots.txt',
            'index.php',
            'app/init.php',
            'app/composer.json',
            'app/config',
            'app/vendor',
            'app/bundle/kendo',
            'app/template/default/layout',
            'static/jscript/kendo',
            'static/jscript/dist',
            'install/',
        ], $pathList);
    }

    $separator = ',' . PHP_EOL . '        ';
    $content = strtr($content, [
        '{namespace}'  => $namespace,
        '{moduleName}' => $moduleName,
        '{tableList}'  => implode($separator, array_map(function ($val)
        {
            return '\'' . $val . '\'';
        }, $acceptTableList)),
        '{pathList}'   => implode($separator, array_map(function ($val)
        {
            return '\'' . $val . '\'';
        }, $pathList))
    ]);

    $dir = dirname($filename);

    if (!is_dir($dir))
    {
        if (!mkdir($dir, 0777, true))
        {
            throw new \RuntimeException("Could not make dir [$dir]");
        }
    }

    file_put_contents($filename, $content);

    chmod($filename, 0777);

    echo 'generate ', $filename, PHP_EOL;
}
//$installer->export();
