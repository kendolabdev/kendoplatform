<?php
namespace Platform\Core\Controller\Ajax;

use Platform\Core\Service\BlockService;
use Kendo\Content\PosterInterface;
use Kendo\Controller\AjaxController;


/**
 * Class BlockController
 *
 * @package Core\Controller\Ajax
 */
class BlockController extends AjaxController
{
    /**
     * @throws \InvalidArgumentException
     */
    public function actionToggle()
    {

        list($type, $id, $ctx) = $this->request->getList('type', 'id', 'ctx');

        $object = app()->find($type, $id);

        $viewer = app()->auth()->getViewer();

        $blockService = app()->instance()->make('platform_core_block');

        if (!$blockService instanceof BlockService) ;

        if (!$object instanceof PosterInterface) {
            throw new \InvalidArgumentException("Invalid argument exception");
        }


        $result = $blockService->toggle($viewer, $object);

        $this->response['html'] = app()->viewHelper()->btnBlock($object, $result, $ctx);
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function actionAdd()
    {

        $object = app()->find($this->request->getString('type'), $this->request->getInt('id'));

        $viewer = app()->auth()->getViewer();

        $blockService = app()->instance()->make('platform_core_block');

        if (!$blockService instanceof BlockService) ;

        if (!$object instanceof PosterInterface) {
            throw new \InvalidArgumentException("Invalid argument exception");
        }


        $blockService->add($viewer, $object);
    }

    public function actionRemove()
    {
        $object = app()->find($this->request->getString('type'), $this->request->getInt('id'));

        $viewer = app()->auth()->getViewer();

        $blockService = app()->instance()->make('platform_core_block');

        if (!$blockService instanceof BlockService) ;

        if (!$object instanceof PosterInterface) {
            throw new \InvalidArgumentException("Invalid argument exception");
        }


        $blockService->remove($viewer, $object);
    }
}