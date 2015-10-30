<?php
namespace Video\Provider;

/**
 * Class ParseResult
 *
 * @package Video\Provider
 */
class ParseResult
{

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var int
     */
    private $videoDuration = 0;

    /**
     * @var string
     */
    private $originUrl = '';

    /**
     * @var string
     */
    private $providerCode = '';

    /**
     * @var string
     */
    private $videoCode = '';

    /**
     * @var string
     */
    private $dimension = '2d';

    /**
     * @var string
     */
    private $definition = 'normal';

    /**
     * @var string
     */
    private $thumbMode = 'normal';

    /**
     * @var string
     */
    private $thumbnailUrl;

    /**
     * @var string
     */
    private $thumbnailSmallUrl;

    /**
     * @var string
     */
    private $providerName;

    /**
     * @param $source
     * @param $code
     */
    function __construct($source, $code)
    {
        $this->setProviderCode($source);
        $this->setVideoCode($code);

    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'video_code'          => $this->getVideoCode(),
            'video_duration'      => $this->getVideoDuration(),
            'provider_code'       => $this->getProviderCode(),
            'provider_name'       => (string)$this->getProviderName(),
            'title'               => $this->getTitle(),
            'description'         => $this->getDescription(),
            'definition'          => $this->getDefinition(),
            'dimension'           => $this->getDimension(),
            'thumbnail_url'       => $this->getThumbnailUrl(),
            'thumbnail_small_url' => $this->getThumbnailSmallUrl(),
            'origin_url'          => $this->getOriginUrl(),
            'thumb_mode'          => $this->getThumbMode(),
        ];
    }

    /**
     * @return string
     */
    public function getVideoCode()
    {
        return $this->videoCode;
    }

    /**
     * @param string $videoCode
     */
    public function setVideoCode($videoCode)
    {
        $this->videoCode = $videoCode;
    }

    /**
     * @return int
     */
    public function getVideoDuration()
    {
        return $this->videoDuration;
    }

    /**
     * @param int $videoDuration
     */
    public function setVideoDuration($videoDuration)
    {
        $this->videoDuration = $videoDuration;
    }

    /**
     * @return string
     */
    public function getProviderCode()
    {
        return $this->providerCode;
    }

    /**
     * @param string $providerCode
     */
    public function setProviderCode($providerCode)
    {
        $this->providerCode = $providerCode;
    }

    /**
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }

    /**
     * @param string $providerName
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return strip_tags(html_entity_decode($this->title));
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = mb_convert_encoding(strip_tags(html_entity_decode($title)), 'UTF-8');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = mb_convert_encoding(strip_tags(html_entity_decode(urldecode($description))), 'UTF-8');
    }

    /**
     * @return string
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @param string $definition
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
    }

    /**
     * @return string
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * @param string $dimension
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;
    }

    /**
     * @return string
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    /**
     * @param string $thumbnailUrl
     */
    public function setThumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    /**
     * @return string
     */
    public function getThumbnailSmallUrl()
    {
        return $this->thumbnailSmallUrl;
    }

    /**
     * @param string $thumbnailSmallUrl
     */
    public function setThumbnailSmallUrl($thumbnailSmallUrl)
    {
        $this->thumbnailSmallUrl = $thumbnailSmallUrl;
    }

    /**
     * @return string
     */
    public function getOriginUrl()
    {
        return $this->originUrl;
    }

    /**
     * @param string $originUrl
     */
    public function setOriginUrl($originUrl)
    {
        $this->originUrl = $originUrl;
    }

    /**
     * @return string
     */
    public function getThumbMode()
    {
        return $this->thumbMode;
    }

    /**
     * @param string $thumbMode
     */
    public function setThumbMode($thumbMode)
    {
        $this->thumbMode = $thumbMode;
    }


}