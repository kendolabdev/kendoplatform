<?php

namespace Kendo\Html;

use Kendo\View\View;

/**
 * Class RenderAsTable
 *
 * @package Kendo\Html
 */
class RenderAsTable implements RenderInterface
{

    /**
     * @var string
     */
    private $script = 'layout/partial/form-render/as-table';

    /**
     * @param HtmlElement $form
     * @param array       $options
     *
     * @return string
     */
    public function render(HtmlElement $form, $options = [])
    {
        if ($form instanceof Form) ;

        $form->beforeRender();

        return app()->viewHelper()
            ->partial($this->getScript(),
                ['form'    => $form,
                 'options' => $options,
                 'render'  => $this]);
    }

    /**
     * @return string
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * @param string $script
     */
    public function setScript($script)
    {
        $this->script = $script;
    }
}