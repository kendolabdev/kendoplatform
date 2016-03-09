<?php
namespace Platform\Report\ViewHelper;

/**
 * Class ButtonReport
 *
 * @package Report\ViewHelper
 */
class ButtonReport
{

    /**
     * @param        $item
     * @param bool   $reported
     * @param string $type
     *
     * @return string
     */
    public function __invoke($item, $reported = null, $type = 'btn')
    {

        if (!app()->auth()->logged()) return '';
        if ($item->viewerIsPoster()) return '';

        $poster = app()->auth()->getViewer();

        if (null === $reported) {
        }

        switch ($type) {
            case 'menu':
            case 'menu-item':
                $script = 'platform/report/partial/menu-item-report';
                break;
            default:
                $script = 'platform/report/partial/button-report';
        }


        return app()->viewHelper()->partial($script, [
            'attrs' => ['id' => $item->getId(), 'type' => $item->getType()]
        ]);
    }

}