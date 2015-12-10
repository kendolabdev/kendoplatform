<?php
namespace Platform\Core\Block;

use Kendo\Layout\Block;

/**
 * Class AdminInfoBlock
 *
 * @package Core\Block
 */
class AdminInfoBlock extends Block
{

    /**
     * @var string
     */
    protected $basePath = 'base/core/block/admin-info';

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'License Information';
    }

    /**
     *
     */
    public function execute()
    {
        $license = \App::setting('license');

        $this->view->assign([
            'date'    => date('Y-m-d H:i:s'),
            'license' => $license,
            'version' => \App::version(),
        ]);
    }
}