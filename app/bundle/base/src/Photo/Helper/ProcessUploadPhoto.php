<?php
namespace Photo\Helper;

use Picaso\Upload\ProcessUploadInterface;

/**
 * Class ProcessUploadPhoto
 *
 * @package Photo\Helper
 */
class ProcessUploadPhoto implements ProcessUploadInterface
{

    /**
     * @var bool
     */
    private $keepOrigin = true;

    /**
     * @var array
     */
    private $results = [];

    /**
     * @var array
     */
    private $thumbs = [];

    /**
     * @param array $options
     */
    public function __construct($options)
    {
        $this->setOptions($options);
    }


    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        foreach ($options as $key => $value) {
            if (method_exists($this, $method = 'set' . ucfirst($key))) {
                $this->{$method}($value);
            }
        }

    }

    /**
     * @param array $items
     *
     * @return bool
     */
    public function process($items)
    {
        /**
         * Process upload item
         */
        foreach ($items as $item) {
            $this->processItem($item);
        }
    }

    /**
     * @param array $item
     */
    private function processItem($item)
    {
        // process uploaded photo as $item
        $source = $item['source'];
        $path = $item['path'];
        $size = $item['size'];
        $name = $item['name'];
        $type = $item['type'];


        $image = \WideImage::load($path);
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param boolean $keepOrigin
     */
    public function setKeepOrigin($keepOrigin)
    {
        $this->keepOrigin = $keepOrigin;
    }

    /**
     * @param array $thumbs
     */
    public function setThumbs($thumbs)
    {
        $this->thumbs = $thumbs;
    }
}