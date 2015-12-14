<?php

include '../init.php';

$modules = \App::instance()
    ->getModules();

$allTableList = \App::db()->getMaster()
    ->tables();

/**
 *
 */
foreach ($modules as $moduleKey) {

    $arr = explode('_', $moduleKey);
    $namespaceDir = $arr[0];
    $moduleDir = $arr[1];
    $namespace = ucfirst($namespaceDir);
    $moduleName = ucfirst($moduleDir);

    $filename = KENDO_ROOT_DIR . '/app/bundle/' . $namespaceDir . '/src/' . $namespace . '/' . $moduleName . '/Service/InstallerService.php';

    if (file_exists($filename) && !strpos(file_get_contents($filename), 'code generator'))
        continue;

    $content = file_get_contents('_generate_installer_service.txt');

    $acceptTableList = [];

    foreach ($allTableList as $tableName) {
        if (strpos($tableName, 'picaso_' . $moduleKey) === 0) {
            $acceptTableList[] = substr($tableName, strlen('picaso_'));
        }
    }

    $pathList = [
        'app/bundle/' . $namespaceDir . '/src/' . $namespace . '/' . $moduleName,
        'app/template/default/' . $namespaceDir . '/' . $moduleDir,
        'app/theme/default/sass/' . $namespaceDir . '/' . $moduleDir,
        'app/theme/admin/sass/' . $namespaceDir . '/' . $moduleDir,
        'static/jscript/' . $namespaceDir . '/' . $moduleDir,
    ];

    if ($moduleName == 'platform_core') {
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

    $moduleList = [$namespaceDir . "_" . $moduleDir];

    $separator = ',' . PHP_EOL . '        ';
    $content = strtr($content, [
        '{namespaceDir}' => $namespaceDir,
        '{moduleDir}'    => $moduleDir,
        '{namespace}'    => $namespace,
        '{moduleName}'   => $moduleName,
        '{tableList}'    => implode($separator, array_map(function ($val) {
            return '\'' . $val . '\'';
        }, $acceptTableList)),
        '{moduleList}'   => implode($separator, array_map(function ($val) {
            return '\'' . $val . '\'';
        }, $moduleList)),
        '{pathList}'     => implode($separator, array_map(function ($val) {
            return '\'' . $val . '\'';
        }, $pathList))
    ]);

    $dir = dirname($filename);

    if (!is_dir($dir)) {
        if (!mkdir($dir, 0777, true)) {
            throw new \RuntimeException("Could not make dir [$dir]");
        }
    }

    file_put_contents($filename, $content);

    chmod($filename, 0777);

    echo 'generate ', $filename, PHP_EOL;
}
//$installer->export();
