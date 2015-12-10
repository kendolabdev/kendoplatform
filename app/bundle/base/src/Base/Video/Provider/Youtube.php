<?php
namespace Base\Video\Provider;

/**
 * Class Youtube
 *
 * @package Video\Provider
 */
class Youtube implements ProviderInterface
{
    /**
     * @param string $code
     * @param array  $context
     *
     * @return string
     */
    public function getEmbedCode($code, $context = [])
    {
        $id = uniqid('_youtube');

        $props = array_merge([
            'id'              => $id,
            'width'           => 600,
            'height'          => 337,
            'frameborder'     => 0,
            'allowfullscreen' => 'true',
            'src'             => sprintf('https://www.youtube.com/embed/%s', $code),
        ], $context);

        $attrs = [];

        foreach ($props as $name => $value) {
            $attrs[] = sprintf('%s="%s"', $name, $value);
        }

        $iframe = '<iframe ' . implode(' ', $attrs) . '></iframe>';

        return \App::viewHelper()->partial('base/video/partial/embed-video-youtube', [
            'iframe' => $iframe,
            'id'     => $id
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
            throw new \InvalidArgumentException("Invalid YouTube video url");


        $videoInfo = $this->_videoInfo($code);

        // validate result
        if (empty($videoInfo))
            throw new \InvalidArgumentException("Invalid YouTube video");


        $result = new ParseResult('youtube', $code);

        $snippet = $videoInfo['items'][0]['snippet'];
        $contentDetail = $videoInfo['items'][0]['contentDetails'];

        $result->setTitle($snippet['title']);
        $result->setDescription($snippet['description']);


        $result->setThumbnailUrl($snippet['thumbnails']['high']['url']);
        $result->setThumbnailUrl('http://img.youtube.com/vi/' . $code . '/sddefault.jpg');
        $result->setThumbnailSmallUrl($snippet['thumbnails']['medium']['url']);

        $result->setVideoDuration($this->extractDuration($contentDetail['duration']));
        $result->setDimension($contentDetail['dimension']);
        $result->setDefinition($contentDetail['definition']);
        $result->setThumbMode('large');

        $result->setProviderName('www.youtube.com');
        $result->setOriginUrl($url);

        return $result;
    }

    /**
     * @param  $url
     *
     * @return string
     */
    public function extractCode($url)
    {
        $code = false;
        $url = parse_url($url);
        if (strcasecmp($url['host'], 'youtu.be') === 0) {
            #### (dontcare)://youtu.be/<video id>
            $code = substr($url['path'], 1);
        } elseif (strcasecmp($url['host'], 'www.youtube.com') === 0) {
            if (isset($url['query'])) {
                parse_str($url['query'], $url['query']);
                if (isset($url['query']['v'])) {
                    #### (dontcare)://www.youtube.com/(dontcare)?v=<video id>
                    $code = $url['query']['v'];
                }
            }
            if ($code == false) {
                $url['path'] = explode('/', substr($url['path'], 1));
                if (in_array($url['path'][0], ['e', 'embed', 'v'])) {
                    #### (dontcare)://www.youtube.com/(whitelist)/<video id>
                    $code = $url['path'][1];
                }
            }
        }

        return $code;
    }

    /**
     * @param string $code
     *
     * @return array
     */
    public function _videoInfo($code)
    {
        $url = 'https://www.googleapis.com/youtube/v3/videos?' . http_build_query([
                'id'   => $code,
                'key'  => $this->getApiKey(),
                'part' => 'snippet,contentDetails'
            ], '&');

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURL_IPRESOLVE_V4      => 1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_REFERER        => 'http://namnv.younetco.com/',
            CURLOPT_RETURNTRANSFER => 1,
        ]);

        $content = curl_exec($ch);

        if ($content) {
            return json_decode($content, true);
        }
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return \App::setting('google', 'public_key');

    }

    /**
     * @param string $duration
     *
     * @return int
     */
    public function extractDuration($duration)
    {
        $result = 0;
        if (preg_match_all("#(\\d+\\w)#", $duration, $matches)) {
            foreach ($matches[1] as $match) {
                $unit = preg_replace("#\\d+#", "", $match);
                $value = (int)str_replace($unit, "", $match);
                switch (strtolower($unit)) {
                    case 'h':
                        $result += $value * 3600; // hour
                        break;
                    case 'm':
                        $result += $value * 60; // hour
                        break;
                    case 's':
                    default:
                        $result += $value;
                }
            }
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function checkDependencies()
    {
        return true;
    }

}