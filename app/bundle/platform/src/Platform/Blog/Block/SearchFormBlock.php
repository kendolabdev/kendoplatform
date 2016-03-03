<?php
namespace Platform\Blog\Block;

use Kendo\Layout\BlockController;

/**
 * Class SearchFormBlock
 *
 * @package Base\Blog\Block
 */
class SearchFormBlock extends BlockController
{
    /**
     * @var string
     */
    protected $basePath = 'platform/blog/block/blog-search-form';

    /**
     *
     */
    public function execute()
    {
        $form = \App::htmlService()->factory('\Blog\Form\SearchBlog', []);

        $this->view->assign([
            'form' => $form,
        ]);
    }

}