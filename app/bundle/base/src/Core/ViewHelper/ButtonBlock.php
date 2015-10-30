<?php
namespace Core\ViewHelper;

use Core\Service\BlockService;
use User\Model\User;

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
        if (!\App::auth()->logged()) return '';
        if (!\App::acl()->authorize('core.block_other')) return '';
        if (\App::auth()->getId() == $item->getId()) return '';

        $poster = \App::auth()->getViewer();

        if (null === $blocking) {
            $service = \App::service('core.block');

            if ($service instanceof BlockService) ;

            $blocking = $service->isBlocked($poster, $item);
        }

        switch ($ctx) {
            case 'menu':
            case 'menu-item':
                $script = 'base/core/partial/menu-item-block';
                break;
            default:
                $script = 'base/core/partial/button-block';
        }


        return \App::viewHelper()->partial($script, [
            'blocking' => $blocking,
            'attrs'    => ['id' => $item->getId(), 'type' => $item->getType()]
        ]);
    }

}