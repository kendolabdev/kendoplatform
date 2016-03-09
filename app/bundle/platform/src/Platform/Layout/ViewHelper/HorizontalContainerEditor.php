<?php
namespace Platform\Layout\ViewHelper;

use Platform\Layout\Model\LayoutSupportBlock;

/**
 * Class HorizontalContainerEditor
 *
 * @package Platform\Layout\ViewHelper
 */
class HorizontalContainerEditor
{

    /**
     * @param \Platform\Layout\Model\LayoutSupportBlock $item
     * @param array                                     $data
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
                    $response[] = app()->layouts()->renderBlockForEdit($blockData);
                }
            }
            $response[] = '</div>';
        }
        $data['item'] = $item;
        $data['content'] = implode(PHP_EOL, $response);

        return app()->viewHelper()->partial('platform/layout/partial/horizontal-container-editor', $data);
    }
}