<?php
namespace Phrase\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Phrase\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'phrase';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Phrase';

    /**
     *
     */
    public function afterInstall()
    {
        \App::table('phrase.phrase_language')
            ->insertIgnore([
                'id'   => 'en',
                'name' => 'English',
            ]);
    }
}