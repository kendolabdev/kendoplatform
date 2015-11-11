<?php
namespace Layout\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Layout\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'layout';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Layout';


    /**
     *
     */
    public function afterExport()
    {
        $this->finalData['layout_template']
            = \App::table('layout.layout_template')
            ->select()
            ->toAssocs();

        $this->finalData['layout_support_section']
            = \App::table('layout.layout_support_section')
            ->select()
            ->toAssocs();
    }

    /**
     *
     */
    public function afterImport()
    {
        if (!empty($this->finalData['layout_template'])) {
            foreach ($this->finalData['layout_template'] as $data) {
                \App::table('layout.layout_template')
                    ->insertIgnore($data);
            }
        }

        if (!empty($this->finalData['layout_support_section'])) {
            foreach ($this->finalData['layout_support_section'] as $data) {
                \App::table('layout.layout_support_section')
                    ->insertIgnore($data);
            }
        }

        \App::table('layout.layout_theme')
            ->insertIgnore([
                'theme_id'        => 'default',
                'parent_theme_id' => '',
                'is_active'       => 1,
                'is_default'      => 1,
                'variable_params' => '[]',
            ]);
    }
}