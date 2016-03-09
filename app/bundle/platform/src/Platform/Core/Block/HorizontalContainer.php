<?php
namespace Platform\Core\Block;

use Kendo\Layout\BlockController;

/**
 * Class HorizontalContainer
 *
 * @package Core\Block
 */
class HorizontalContainer extends BlockController
{
    /**
     * @return string
     */
    public function render()
    {
        $locations = $this->getParam('locations');
        $grids = explode(',', $this->getParam('grids', '6,6'));

        ksort($locations);

        if (empty($grids)) {
            $grids = ['6', '6'];
        }

        $response = [];

        $response[] = '<div class="row">';

        $offset = 0;

        foreach ($locations as $location => $blocks) {
            $grid = $grids[ $offset ];
            $response[] = '<div class="col-md-' . $grid . ' col-sm-' . $grid . '">';
            foreach ($blocks as $blockData) {
                $response[] = app()->layouts()->renderBlock($blockData['block_class'], $blockData);
            }
            $response [] = '</div>';

            ++$offset;
        }

        $response[] = '</div>';

        return implode(PHP_EOL, $response);
    }
}