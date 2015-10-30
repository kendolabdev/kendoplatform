<?php
namespace Layout\ViewHelper;

use Layout\Model\LayoutSupportBlock;

/**
 * Class BaseBlockEditor
 *
 * @package Layout\ViewHelper
 */
class BaseBlockEditor
{

    /**
     * @param LayoutSupportBlock $item
     * @param array              $data
     *
     * @return string
     */
    public function render($item, $data = [])
    {
        $data['item'] = $item;

        return \App::viewHelper()->partial('base/layout/partial/base-block-editor', $data);
    }
}