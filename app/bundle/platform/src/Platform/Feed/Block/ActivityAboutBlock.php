<?php

namespace Platform\Feed\Block;

use Kendo\Layout\BlockController;

/**
 * Class ActivityAboutBlock
 *
 * @package Feed\Block
 */
class ActivityAboutBlock extends BlockController
{

    /**
     *
     */
    public function execute()
    {

        $about = \App::registryService()->get('about');

        if (!$about) {
            $id = $this->getParam('id');
            $type = $this->getParam('type');

            $about = \App::find($type, $id);
        }

        /**
         * skip render if there no item
         */
        if (!$about) {
            $this->setNoRender(true);

            return;
        }

        $data = \App::feedService()->loadAboutBundles($about);

        $this->view->setData($data);
    }
}