<?php
namespace Picaso\Html;

/**
 * Class SectionField
 *
 * @package Picaso\Html
 */
class SectionField extends HtmlElement
{
    const SECTION_TAG = 'h4';

    /**
     * @return bool
     */
    public function hasLabel()
    {
        return false;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $label = $this->label;

        if ($label) {
            $label = \App::text($label);
        }

        return sprintf('<%s class="form-section"><span>%s</span></%s>', self::SECTION_TAG, $label, self::SECTION_TAG);
    }

    /**
     * @return string
     */
    public function toFormatValue()
    {
        return $this->toHtml();
    }

    /**
     * @return bool
     */
    public function hasFormatValue()
    {
        return true;
    }
}