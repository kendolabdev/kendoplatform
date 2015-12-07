<?php

namespace Kendo\Package;

/**
 * Interface Installer
 *
 * @package Kendo\Package
 */
interface Installer
{
    /**
     * export extension
     */
    public function export();

    /**
     * @param array $package
     */
    public function install($package);

    /**
     * @return null
     */
    public function uninstall();

    /**
     * @return null
     */
    public function upgrade();
}