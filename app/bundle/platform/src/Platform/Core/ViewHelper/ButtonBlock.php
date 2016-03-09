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
        if (!app()->auth()->logged()) return '';
        if (!app()->aclService()->authorize('core.block_other')) return '';
        if (app()->auth()->getId() == $item->getId()) return '';

        $poster = app()->auth()->getViewer();

        if (null === $blocking) {
            $service = app()->instance()->make('core.block');

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


        return app()->viewHelper()->partial($script, [
            'blocking' => $blocking,
            'attrs'    => ['id' => $item->getId(), 'type' => $item->getType()]
        ]);
    }

}