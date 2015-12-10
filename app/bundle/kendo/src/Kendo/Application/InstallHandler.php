<?php
namespace Kendo\Application;

/**
 * Interface InstallHandler
 *
 * @package Kendo\Application
 */
interface InstallHandler
{
    /**
     * export extension
     *
     * @param \Platform\Core\Model\CoreExtension $extension
     */
    public function export($extension);

    /**
     * @return null
     */
    public function install();

    /**
     * @return null
     */
    public function uninstall();

    /**
     * @return null
     */
    public function upgrade();

}