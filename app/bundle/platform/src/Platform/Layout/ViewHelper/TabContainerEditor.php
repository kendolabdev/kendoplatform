<?php
namespace Platform\Layout\ViewHelper;
/**
 * Class TabContainerEditor
 *
 * @package Platform\Layout\ViewHelper
 */
class TabContainerEditor
{

    /**
     * @param \Platform\Layout\Model\LayoutSupportBlock $item
     * @param array                                     $data
     *
     * @return string
     */
    public function render($item, $data = [])
    {
        $content = '';

        if (!empty($data['locations']) && !empty($data['locations']['pos0'])) {
            foreach ($data['locations']['pos0'] as $blockData) {
                $content .= \App::layoutService()->renderBlockForEdit($blockData);
            }
        }


        return \App::viewHelper()->partial('platform/layout/partial/tab-container-editor',
            ['item' => $item, 'content' => $content]);
    }
}