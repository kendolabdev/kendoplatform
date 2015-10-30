<?php
namespace Layout\ViewHelper;

use Layout\Model\LayoutSupportBlock;

/**
 * Class TabContainerEditor
 *
 * @package Layout\ViewHelper
 */
class TabContainerEditor
{

    /**
     * @param LayoutSupportBlock $item
     *
     * @aparam array $data
     *
     * @return string
     */
    public function render($item, $data = [])
    {
        $content = '';

        if (!empty($data['locations']) && !empty($data['locations']['pos0'])) {
            foreach ($data['locations']['pos0'] as $blockData) {
                $content .= \App::layout()->renderBlockForEdit($blockData);
            }
        }


        return \App::viewHelper()->partial('base/layout/partial/tab-container-editor',
            ['item' => $item, 'content' => $content]);
    }
}