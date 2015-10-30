<?php
namespace Phrase\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Phrase\Service
 */
class InstallHandlerService extends InstallHandler
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
    public function _afterImport()
    {
        \App::table('phrase.phrase_language')
            ->insertIgnore([
                'id'   => 'en',
                'name' => 'English',
            ]);
    }
}