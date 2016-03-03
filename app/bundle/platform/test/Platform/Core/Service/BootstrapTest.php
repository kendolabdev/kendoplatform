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