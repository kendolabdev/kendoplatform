<?php
namespace Platform\Core\ViewHelper;

use Platform\Core\Service\BlockService;
use Platform\User\Model\User;

/**
 * Class ButtonBlock
 *
 * @package Core\ViewHelper
 */
class ButtonBlock
{

    /**
     * @param        $item
     * @param bool   $blocking
     * @param string $ctx
     *
     * @return string
     */
    public function __invoke($item, $blocking = null, $ctx = 'btn')
    {

        if (!$item instanceof User) return '';
        if (!\App::authService()->logged()) return '';
        if (!\App::aclService()->authorize('core.block_other')) return '';
        if (\App::authService()->getId() == $item->getId()) return '';

        $poster = \App::authService()->getViewer();

        if (null === $blocking) {
            $service = \App::service('core.block');

            if ($service instanceof BlockService) ;

            $blocking = $service->isBlocked($poster, $item);
        }

        switch ($ctx) {
            case 'menu':
            case 'menu-item':
                $script = 'platform/core/partial/menu-item-block';
                break;
            default:
                $script = 'platform/core/partial/button-block';
        }


        return \App::viewHelper()->partial($script, [
            'blocking' => $blocking,
            'attrs'    => ['id' => $item->getId(), 'type' => $item->getType()]
        ]);
    }

}