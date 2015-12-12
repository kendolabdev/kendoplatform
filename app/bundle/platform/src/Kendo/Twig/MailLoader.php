<?php
namespace Kendo\Twig;

/**
 * Class PhraseLoader
 *
 * @package Kendo\Twig
 */
class MailLoader implements \Twig_LoaderInterface
{
    /**
     * @param string $name
     *
     * @return \Platform\Phrase\Service\PhraseService
     */
    public function getSource($name)
    {
        return \App::trans()->msgId($name);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getCacheKey($name)
    {
        return 'twig_template_phrase_loader__' . $name;
    }

    /**
     * @param string $name
     * @param int    $time
     *
     * @return bool
     */
    public function isFresh($name, $time)
    {
        return true;
    }
}