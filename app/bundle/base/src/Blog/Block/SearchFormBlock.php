<?php
namespace Blog\Block;

use Kendo\Layout\Block;

/**
 * Class SearchFormBlock
 *
 * @package Blog\Block
 */
class SearchFormBlock extends Block
{
    /**
     * @var string
     */
    protected $basePath = 'base/blog/block/blog-search-form';

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