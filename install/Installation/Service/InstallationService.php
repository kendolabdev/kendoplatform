<?php
namespace Installation\Service;


/**
 * Class InstallationService
 *
 * @package Installation\Service
 */
class InstallationService
{

    /**
     *
     */
    public function import()
    {
        $handler = new InstallHandlerService();
        $handler->install();
    }

    /**
     *
     */
    public function export()
    {
        $handler = new InstallHandlerService();
        $handler->export();
    }

    /**
     * @param $config
     */
    public function updateDatabaseConfiguration($config)
    {
        $content = var_export($config, true);

        $path = PICASO_CONFIG_DIR . '/database.conf.php';

        $fp = fopen($path, 'w');

        if (!$fp)
            throw new \RuntimeException("Could not write to $path");

        fwrite($fp, '<?php defined("PICASO") or die("Access denied"); return ' . $content . ';');

        fclose($fp);

        @chmod($path, 0777);
    }

    /**
     * @param $data
     */
    public function createSuperAdminAccount($data)
    {
        $user = \App::user()
            ->addUser($data);

        $user->setRoleId(1);
        $user->setActive(1);
        $user->setApproved(1);
        $user->setVerified(1);
        $user->setPublished(1);

        $user->save();
    }
}