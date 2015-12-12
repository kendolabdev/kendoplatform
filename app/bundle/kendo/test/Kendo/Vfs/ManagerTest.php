<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/11/15
 * Time: 8:25 AM
 */

namespace Kendo\Vfs;


class ManagerTest extends \PHPUnit_Framework_TestCase
{
    public function connectionProvider()
    {
        return [
            ['system', [
                'basePath' => KENDO_PUBLIC_DIR,
            ]],
            ['local', []],
            ['ftp', [
                'host'     => '192.168.11.211',
                'username' => 'product-dev',
                'password' => 'product-dev@2@13',
                'port'     => 21,
                'timeout'  => 3,
                'basePath' => '/home/product-dev/public_html/namnv/static_dir/',
            ]],
            ['ssh', [
                'host'     => '192.168.11.211',
                'username' => 'product-dev',
                'password' => 'product-dev@2@13',
                'port'     => 22,
                'timeout'  => 3,
                'basePath' => '/home/product-dev/public_html/namnv/static_dir_ssh/',
            ]]
        ];
    }

    /**
     * @dataProvider connectionProvider
     *
     * @param $driverType
     * @param $driverConfig
     */
    public function testConnection($driverType, $driverConfig)
    {
        $manager = new Manager();

        $driver = $manager->createDriver($driverType, $driverConfig);

        $name = 'test-data-' . time() . '.txt';
        $local = KENDO_TEMP_DIR . '/cache/' . $name;

        file_put_contents($local, '.nocontent');

        $path = 'test/data/' . $name;

        $driver->put($path, $local);

        $driver->getPath('tset/data');

        $driver->getGid();
        $driver->getUid();
        $driver->getUmask();
        $driver->getDirectorySeparator();
        $driver->getSystemType();


        $this->assertTrue($driver->isDirectory(dirname($path)));
        $this->assertFalse($driver->isFile(dirname($path)));
        $this->assertFalse($driver->isDirectory($path));
        $this->assertTrue($driver->isFile($path));


        $info = $driver->info($path);


        $info->exists();
        $info->getAtime();
        $info->getCtime();
        $info->getChildren();
        $info->getDirectoryName();
        $info->getBaseName();
        $info->getGid();
        $info->getUid();
        $info->toString();
        $info->reload();
        $info->getDriver();
        $info->getMtime();
        $info->getPath();
        $info->getRealPath();
        $info->getSize();
        $info->getType();
        $info->getRights();
        $info->isFile();
        $info->isDirectory();
        $info->isExecutable();
        $info->isLink();
        $info->isReadable();
        $info->isWritable();
        $info->isExecutable();

        // try to read content
        $object = $driver->object($path);

        $object->getPath();
        $object->getFileInfo();
        $object->getMode();
        $object->getResource();

        $object->end();

        $writeObject = $driver->object($path, 'w');
        $writeObject->write('test ok');
        $writeObject->flush();
        $writeObject->end();

        $directory = $driver->directory(dirname($path));

        // remove directory
        $driver->unlink($path);


//        $this->assertFalse($driver->isFile($path), sprintf('driver type %s', $driverType));
//        $this->assertFalse($driver->isDirectory($path));
    }

    public function testPathGenerator()
    {

        $generator = new PathGeneratorByDate();

        $result =  $generator->getPattern('temp', 'abc', 'jpg');

        $this->assertNotEmpty($result);

        $result =  $generator->getPattern('temp', null, 'jpg');

        $this->assertNotEmpty($result);

    }
}
