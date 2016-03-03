<?php
namespace Platform\Core\Block;

use Kendo\Layout\BlockController;

/**
 * Class TabContainer
 *
 * @package Core\Block
 */
class TabContainer extends BlockController
{
    /**
     *
     */
    const KEY = 'pos0';


    /**
     * @return string
     */
    public function execute()
    {
        $locations = $this->getParam('locations');

        if (empty($locations) || empty($locations[ self::KEY ])) {
            $this->setNoRender(true);

            return;
        }

        $tabs = [];
        $offset = 0;
        foreach ($locations[ self::KEY ] as $blockData) {
            $class = $blockData['block_class'];
            $block = new $class($blockData);

            if (!$block instanceof BlockController) continue;

            $block->execute();

            if ($block->isNoRender()) continue;

            $title = $block->getTitle();

            $tabs[] = [
                'active'  => $offset == 0 ? 1 : 0,
                'content' => $block->getContent(),
                'title'   => $title ? $title : \App::text('core.untitled'),
                'id'      => $block->getParam('block_id'),
            ];
            ++$offset;

        }
        $this->view->setScript('platform/core/block/tab-container/tab-container')
            ->setData(['tabs' => $tabs]);
    }
}
