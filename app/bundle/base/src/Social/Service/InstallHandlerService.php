<?php
namespace Social\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Social\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'social';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Social';

    /**
     *
     */
    public function afterExport()
    {
        $this->finalData['social_service']
            = \App::table('social.social_service')
            ->select()
            ->toAssocs();
    }

    /**
     *
     */
    public function afterImport()
    {

        if (!empty($this->finalData['social_service'])) {
            foreach ($this->finalData['social_service'] as $data) {
                \App::table('social.social_service')
                    ->insertIgnore($data);
            }
        }

    }
}