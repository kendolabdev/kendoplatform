<?php
namespace Feed\ViewHelper;

/**
 * Class DecorateStory
 *
 * @package Feed\ViewHelper
 */
class DecorateStory
{

    /**
     * @param $story
     *
     * @return string
     */
    function __invoke($story)
    {
        if (empty($story)) {
            return '';
        }

        return \App::feed()->decorateStory($story);
    }

}