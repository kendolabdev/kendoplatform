<?php
namespace Platform\Video\Provider;


/**
 * Class Vimeo
 *
 * @package Video\Provider
 */
class Vimeo implements ProviderInterface
{
    /**
     * @param string $code
     * @param array  $context
     *
     * @return string
     */
    public function getEmbedCode($code, $context = [])
    {
        $id = uniqid('_vimeo');

        $props = array_merge([
            'src'                   => sprintf('https://player.vimeo.com/video/%s', $code),
            'id'                    => $id,
            'width'                 => 600,
            'height'                => 337,
            'frameborder'           => 0,
            'webkitallowfullscreen' => true,
            'mozallowfullscreen'    => true,
            'allowfullscreen'       => true,
        ], $context);

        $attrs = [];

        foreach ($props as $name => $value) {
            $attrs[] = sprintf('%s="%s"', $name, $value);
        }

        $iframe = '<iframe ' . implode(' ', $attrs) . '></iframe>';

        return \App::viewHelper()->partial('platform/video/partial/embed-video-vimeo', [
            'iframe' => $iframe,
            'id'     => $id,
        ]);
    }

    /**
     * @param string $url
     *
     * @return ParseResult
     */
    public function parseFromUrl($url)
    {

        $code = $this->extractCode($url);


        if (!$code)
            throw new \InvalidArgumentException("Invalid video url");


        $videoInfo = $this->_videoInfo($code);

        if (empty($videoInfo))
            throw new \InvalidArgumentException("Invalid video url");


        $info = $videoInfo[0];

        if (empty($info))
            throw new \InvalidArgumentException("Invalid video url");


        $result = new ParseResult('vimeo', $code);
        $result->setTitle($info['title']);
        $result->setDescription($info['description']);
        $result->setVideoDuration($info['duration']);

        $result->setThumbnailUrl($info['thumbnail_large']);
        $result->setThumbnailSmallUrl($info['thumbnail_medium']);
        $result->setThumbMode('large');

        $result->setProviderName('vimeo.com');
        $result->setOriginUrl($url);

        return $result;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function extractCode($url)
    {
        $info = parse_url($url);

        $code = trim($info['path'], '/');

        if (preg_match('#^\d+$#', $code, $maches)) {
            return $code;
        }
    }

    /**
     * @param  $code
     *
     * @return array
     */
    private function _videoInfo($code)
    {

        $url = strtr('https://vimeo.com/api/v2/video/{$code}.json', ['{$code}' => $code]);

        $content = file_get_contents($url);

        if ($content) {
            return json_decode($content, true);
        }
    }
}