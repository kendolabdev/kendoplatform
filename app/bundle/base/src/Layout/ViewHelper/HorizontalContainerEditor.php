<?php
namespace Layout\ViewHelper;

use Layout\Model\LayoutSupportBlock;

/**
 * Class HorizontalContainerEditor
 *
 * @package Layout\ViewHelper
 */
class HorizontalContainerEditor
{

    /**
     * @param LayoutSupportBlock $item
     * @param array              $data
     *
     * @return string
     */
    public function render($item, $data = [])
    {
        $response = [];

        if (empty($data['grids'])) {
            $data['grids'] = '6,6';
        }

        $grids = explode(',', $data['grids']);

        for ($offset = 0; $offset < count($grids); ++$offset) {
            $location = 'pos' . $offset;
            $grid = $grids[ $offset ];

            $response[] = ' <div class="col-sm-' . $grid . ' col-md-' . $grid . ' location leaf" data-location = "' . $location . '">';

            if (empty($data['locations'][ $location ])) {
                $response[] = '';
            } else {
                foreach ($data['locations'][ $location ] as $blockData) {
                    $response[] = \App::layoutService()->renderBlockForEdit($blockData);
                }
            }
            $response[] = '</div>';
        }
        $data['item'] = $item;
        $data['content'] = implode(PHP_EOL, $response);

        return \App::viewHelper()->partial('base/layout/partial/horizontal-container-editor', $data);
    }
}