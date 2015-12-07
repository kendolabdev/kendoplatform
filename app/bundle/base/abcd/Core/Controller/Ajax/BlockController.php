<?php
namespace Core\Controller\Ajax;

use Core\Service\BlockService;
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

        list($type, $id, $ctx) = $this->request->get('type', 'id', 'ctx');

        $object = \App::find($type, $id);

        $viewer = \App::authService()->getViewer();

        $blockService = \App::service('core.block');

        if (!$blockService instanceof BlockService) ;

        if (!$object instanceof PosterInterface) {
            throw new \InvalidArgumentException("Invalid argument exception");
        }


        $result = $blockService->toggle($viewer, $object);

        $this->response['html'] = \App::viewHelper()->btnBlock($object, $result, $ctx);
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function actionAdd()
    {

        $object = \App::find($this->request->getString('type'), $this->request->getInt('id'));

        $viewer = \App::authService()->getViewer();

        $blockService = \App::service('core.block');

        if (!$blockService instanceof BlockService) ;

        if (!$object instanceof PosterInterface) {
            throw new \InvalidArgumentException("Invalid argument exception");
        }


        $blockService->add($viewer, $object);
    }

    public function actionRemove()
    {
        $object = \App::find($this->request->getString('type'), $this->request->getInt('id'));

        $viewer = \App::authService()->getViewer();

        $blockService = \App::service('core.block');

        if (!$blockService instanceof BlockService) ;

        if (!$object instanceof PosterInterface) {
            throw new \InvalidArgumentException("Invalid argument exception");
        }


        $blockService->remove($viewer, $object);
    }
}