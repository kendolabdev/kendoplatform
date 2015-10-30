<?php
namespace Mail\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Mail\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'mail';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Mail';

    /**
     *
     */
    public function _afterExport()
    {
        $this->finalData['mail_adapter']
            = \App::table('mail.mail_adapter')
            ->select()
            ->toAssocs();
    }

    /**
     *
     */
    public function _afterImport()
    {
        if (!empty($this->finalData['mail_adapter'])) {
            foreach ($this->finalData['mail_adapter'] as $data) {
                \App::table('mail.mail_adapter')
                    ->insertIgnore($data);
            }
        }
    }
}