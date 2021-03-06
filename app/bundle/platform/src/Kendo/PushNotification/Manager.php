<?php

namespace Kendo\PushNotification;
use Kendo\Kernel\KernelService;

/**
 * Class Manager
 *
 * @package Kendo\PushNotification
 */
class Manager extends KernelService
{

    /**
     * @var array
     */
    private $configs = [];

    /**
     * @var array
     */
    private $drivers = [];

    /**
     * Default constructor
     */
    public function __construct()
    {
        // load all configurations or not.
    }

    /**
     * @return array
     */
    public function getConfigs()
    {
        return $this->configs;
    }

    /**
     * @param array $configs
     */
    public function setConfigs($configs)
    {
        $this->configs = $configs;
    }

    /**
     * @return array
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    /**
     * @param array $drivers
     */
    public function setDrivers($drivers)
    {
        $this->drivers = $drivers;
    }

    /**
     * @param                     $name
     * @param PushSenderInterface $driver
     */
    public function setDriver($name, PushSenderInterface $driver)
    {

        $this->drivers[ $name ] = $driver;
    }

    /**
     * @param  string $name
     *
     * @return array
     */
    public function getConfig($name)
    {
        return (array)$this->configs[ $name ];
    }

    /**
     * @param       $name
     * @param array $params
     */
    public function setConfig($name, $params = [])
    {
        $this->configs[ $name ] = $params;
    }

    /**
     * @param PushMessage $message
     * @param array       $recipients
     */
    public function push(PushMessage $message, $recipients)
    {
        $groups = [];

        foreach ($recipients as $recipient) {
            $groups[ $recipient['type'] ][] = $recipient['id'];
        }

        try {
            foreach ($groups as $driver => $ids) {
                $this->getDriver($driver)->push($message, $ids);
            }
        } catch (PushException $ex) {

        }
    }

    /**
     * @param  string $name
     *
     * @return Driver
     * @throws PushException
     */
    public function getDriver($name)
    {
        if (!isset($this->drivers[ $name ])) {
            if (!isset($this->configs[ $name ])) {
                throw new PushException("Configuration is not valid");
            }
            $this->drivers[ $name ] = $this->createDriver($name, $this->configs[ $name ]);
        }

        return $this->drivers[ $name ];
    }

    /**
     * @param       $name
     * @param array $params
     *
     * @return PushSenderInterface
     * @throws PushException
     */
    private function createDriver($name, $params = [])
    {

        switch ($name) {
            case 'google':
            case 'gcm':
            case 'android':
                return new GoogleSender($params);
            case 'apn':
            case 'apple':
            case 'iphone':
            case 'ipad':
            case 'ios':
                return new AppleSender($params);
            default:
                throw new PushException("Driver does not support");

        }
    }
}