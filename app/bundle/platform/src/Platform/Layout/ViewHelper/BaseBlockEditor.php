<?php
namespace Platform\Layout\ViewHelper;

use Platform\Layout\Model\LayoutSupportBlock;

/**
 * Class BaseBlockEditor
 *
 * @package Platform\Layout\ViewHelper
 */
class BaseBlockEditor
{

    /**
     * @param \Platform\Layout\Model\LayoutSupportBlock $item
     * @param array                                     $data
     *
     * @return string
     */
    public function render($item, $data = [])
    {
        $data['item'] = $item;

        return \App::viewHelper()->partial('platform/layout/partial/base-block-editor', $data);
    }
}