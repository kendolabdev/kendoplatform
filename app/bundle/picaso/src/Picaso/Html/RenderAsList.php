<?php

namespace Picaso\Html;

use Picaso\View\View;

/**
 * Class RenderAsList
 *
 * @package Picaso\Html
 */
class RenderAsList implements RenderInterface
{

    /**
     * @var string
     */
    private $script = 'layout/form/as-list';

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

        return (new View($this->getScript(), [
            'form'    => $form,
            'options' => $options,
            'render'  => $this,
        ]))->render();
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