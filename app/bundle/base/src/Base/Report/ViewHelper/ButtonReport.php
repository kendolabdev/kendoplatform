<?php
namespace Base\Report\ViewHelper;

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

        if (!\App::authService()->logged()) return '';
        if ($item->viewerIsPoster()) return '';

        $poster = \App::authService()->getViewer();

        if (null === $reported) {
        }

        switch ($type) {
            case 'menu':
            case 'menu-item':
                $script = 'base/report/partial/menu-item-report';
                break;
            default:
                $script = 'base/report/partial/button-report';
        }


        return \App::viewHelper()->partial($script, [
            'attrs' => ['id' => $item->getId(), 'type' => $item->getType()]
        ]);
    }

}