<?php
namespace Picaso\Application;

/**
 * Interface InstallHandler
 *
 * @package Picaso\Application
 */
interface InstallHandler
{
    /**
     * export extension
     *
     * @param \Core\Model\CoreExtension $extension
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