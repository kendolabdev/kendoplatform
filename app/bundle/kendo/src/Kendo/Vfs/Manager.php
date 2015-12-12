<?php

namespace Kendo\Vfs;

/**
 * Class Manager
 *
 * @package Kendo\Vfs
 */
class Manager
{

    /**
     * @param $driverType
     * @param $driverConfig
     *
     * @return DriverInterface
     */
    public function createDriver($driverType, $driverConfig)
    {
        switch (strtolower($driverType)) {
            case 'ssh':
            case 'ssh2':
                return new SshDriver($driverConfig);
                break;
            case 'ftp':
            case 'ftps':
                return new FtpDriver($driverConfig);
                break;

            case 'local':
            case 'system':
                return new LocalDriver($driverConfig);
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Unexpected vfs driver "%s"', $driverType));
        }
    }
}