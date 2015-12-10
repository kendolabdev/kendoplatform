<?php

$paths = [
    'Platform' => dirname(dirname(__FILE__)) . '/bundle/platform/src/Platform',
    'Base'     => dirname(dirname(__FILE__)) . '/bundle/base/src/Base',
];

$result = [];

foreach ($paths as $vendor => $starpath) {

    $ritit = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($starpath), RecursiveIteratorIterator::CHILD_FIRST);


    foreach ($ritit as $splFileInfo) {

        if ($splFileInfo->isDir()) continue;

        $path = $splFileInfo->getPathName();

        if (substr($path, -9) != 'Table.php') continue;

        $class = '\\' . $vendor . str_replace([$starpath, '.php', DIRECTORY_SEPARATOR], ['', '', '\\'], $path);

        $array = strtolower(trim(preg_replace('/([a-z0-9])([A-Z])/', '\1_\2', $class), '_. '));

        $array  = explode('\\', $array, 3);

        $vendor  = $array[1];
        $module =  $array[2];
        $name = str_replace('_table','', $array[4]);

        echo $name, PHP_EOL;

        $name = strtolower($vendor).'_'. $name;

        $class = str_replace('\\','\\\\', $class);

        $result[] =  '('. implode(', ', array_map(function($str){return '\''. $str. '\'';}, [$name, '', '0', strtolower($vendor) . '_'.$module, '', $class])) . ')';
    }
}

echo 'insert ignore into picaso_platform_core_type (type_id, name, is_poster, module_name, has_attribute_catalog, table_name) values ', PHP_EOL, implode(PHP_EOL. ', ', $result);
