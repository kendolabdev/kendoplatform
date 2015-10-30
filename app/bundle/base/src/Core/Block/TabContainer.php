<?php
namespace Core\Block;

use Picaso\Layout\Block;

/**
 * Class TabContainer
 *
 * @package Core\Block
 */
class TabContainer extends Block
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

            if (!$block instanceof Block) continue;

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
        $this->view->setScript('base/core/block/tab-container/tab-container')
            ->setData(['tabs' => $tabs]);
    }
}
