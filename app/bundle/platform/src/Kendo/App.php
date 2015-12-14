<?php

/**
 * Class App
 */
class App extends \Kendo\Kernel\Application
{
    /**
     * Version base
     */
    const VERSION = '4.1.0';


    /**
     * @return string
     */
    public static function version()
    {
        return self::VERSION;
    }
}


