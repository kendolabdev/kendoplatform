<?php
namespace Platform\Video\Provider;

/**
 * Interface ProviderInterface
 *
 * @package Video\Provider
 */
interface ProviderInterface
{

    /**
     * @param string $url
     *
     * @return ParseResult
     * @throws ParseException
     */
    public function parseFromUrl($url);

    /**
     * @param string $code
     * @param array  $context
     *
     * @return string
     */
    public function getEmbedCode($code, $context = []);
}