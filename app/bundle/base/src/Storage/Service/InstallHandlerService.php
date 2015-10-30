<?php
namespace Storage\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Storage\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'storage';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Storage';


    /**
     *
     */
    public function _afterExport()
    {
        $this->finalData['storage_adapter']
            = \App::table('storage.storage_adapter')
            ->select()
            ->toAssocs();
    }

    public function _afterImport()
    {
        if (!empty($this->finalData['storage_adapter'])) {
            foreach ($this->finalData['storage_adapter'] as $data) {
                \App::table('storage.storage_adapter')
                    ->insertIgnore($data);
            }
        }

        $host = $_SERVER['HTTP_HOST'];

        $params = json_encode([
            'baseUrl' => sprintf('http://%s/%spublic/', $host, PICASO_BASE_URL)
        ]);

        \App::table('storage')
            ->insertIgnore([
                'storage_id'  => 1,
                'adapter'     => 'local',
                'is_active'   => 1,
                'is_default'  => 1,
                'params_text' => $params,

            ]);
    }
}