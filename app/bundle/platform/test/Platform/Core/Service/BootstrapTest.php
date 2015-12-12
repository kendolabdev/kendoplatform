<?php
namespace Platform\Core\Service;

use Kendo\Test\TestCase;

/**
 * Class BootstrapTest
 *
 * @package Platform\Core\Service
 */
class BootstrapTest extends TestCase
{

    /**
     * @return array
     */
    public function serviceNameProvider()
    {
        $serviceList = [];

        $directory = KENDO_ROOT_DIR . '/app/bundle/kendo/src';

        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory), \RecursiveIteratorIterator::CHILD_FIRST);


        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isDir()) continue;
            $pathname = $fileInfo->getPathName();

            if (strpos($pathname, '/Service/') == false) continue;
            if (substr($pathname, -11) == 'Service.php') ;

            $pathname = substr($pathname, strlen($directory) + 1);
            $pathname = str_replace('Service.php', '', $pathname);

            list($vendor, $module, $temp, $suffix) = explode('/', $pathname, 4);

            if ($temp != 'Service') continue;

            $vendor = \App::underscore($vendor);
            $module = \App::underscore($module);
            $suffix = \App::underscore($suffix);


            if ($suffix == $module) {
                $serviceList[] = [$vendor . '_' . $module];
            } else {
                $serviceList[] = [$vendor . '_' . $module . '_' . $suffix];
            }
        }

        return $serviceList;
    }

    /**
     * @dataProvider serviceNameProvider
     *
     * @param $serviceName
     */
    public function _testHasCoreService($serviceName)
    {

        if (\App::hasService($serviceName)) {

            $serviceInstance = \App::service($serviceName);

            $this->assertNotNull($serviceInstance, sprintf('Service "%s" not found.', $serviceName));
        } else {
            $this->assertNull($serviceName, sprintf('Service "%s" not foun', $serviceName));
        }
    }

    /**
     * @return array
     */
    public function tableProvider()
    {

        $tableList = [];

        $items = \App::table('platform_core_type')
            ->select()
            ->toPairs('type_id', 'table_name');

        foreach ($items as $name => $value) {
            $tableList[] = [$name, $value];
        }

        return $tableList;
    }

    /**
     * @dataProvider tableProvider
     * @large
     *
     * @param $tableName
     */
    public function testTableName($tableName)
    {
        $item = \App::table($tableName)
            ->select()
            ->one();

        $this->assertNotFalse($item, 'Return result of Sql One could not be "FALSE"');
    }


}