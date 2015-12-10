<?php
namespace Base\Like\Helper;

use Kendo\Content\PosterInterface;

/**
 * Class LikeResult
 *
 * @package Like\Helper
 */
class LikeResult
{
    /**
     * @var bool
     */
    private $liked = false;

    /**
     * @var int
     */
    private $count = 0;

    /**
     * @var array
     */
    private $sample = [];

    /**
     * @var
     */
    private $about;

    /**
     * @param bool  $liked
     * @param int   $count
     * @param array $sample
     * @param       $about
     */
    function __construct($liked, $count, $sample, $about)
    {
        $this->liked = $liked;
        $this->sample = $sample;
        $this->count = $count;
        $this->about = $about;
    }

    /**
     * @return array
     */
    public function getSample()
    {
        return $this->sample;
    }

    /**
     * @param array $sample
     */
    public function setSample($sample)
    {
        $this->sample = $sample;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = intval($count);
    }

    /**
     * @return string
     */
    public function getSampleHtml()
    {
        if (!$this->count) {
            return '';
        }

        // clone to others
        $sample = $this->sample;

        $arr1 = [];

        foreach ($sample as $item) {

            if (!$item instanceof PosterInterface) continue;

            $arr1[] = strtr('<a href=":href" data-hover="card" data-card=":card">:label</a>', [
                ':href'  => $item->toHref(),
                ':card'  => $item->toToken(),
                ':label' => $item->getTitle()
            ]);
        }

        $remain = $this->count - count($sample) - ($this->isLiked() ? 1 : 0);
        $sampleCount = count($sample);

        if ($this->liked) {
            if ($sampleCount > 0) {
                if ($remain == 1) {
                    $context = 'activity.you_and_sample_and_1_other_liked_this';
                } else if ($remain > 1) {
                    $context = 'activity.you_and_sample_and_others_liked_this';
                } else {
                    $context = 'activity.you_and_sample_liked_this';
                }
            } else {
                if ($remain == 1) {
                    $context = 'activity.you_and_1_other_liked_this';
                } else if ($remain > 1) {
                    $context = 'activity.you_and_others_liked_this';
                } else {
                    $context = 'activity.you_liked_this';
                }
            }
        } else {
            if ($sampleCount > 0) {
                if ($remain == 1) {
                    $context = 'activity.sample_and_1_other_liked_this';
                } else if ($remain > 1) {
                    $context = 'activity.sample_and_others_liked_this';
                } else {
                    $context = 'activity.sample_liked_this';
                }
            } else {
                if ($remain == 1) {
                    $context = 'activity.1_people_liked_this';
                } else if ($remain > 1) {
                    $context = 'activity.number_people_liked_this';
                } else {
                    return '';
                }
            }
        }

        $about = $this->about;
        $posters = implode(', ', $arr1);
        $prop = sprintf('data-toggle="hyves" role="button" data-remote="ajax/like/like/liked-this?id=%s&type=%s"', $about->getId(), $about->getType());

        return \App::text($context, [
            '$sample' => $posters,
            '$count'  => $remain,
            '$prop'   => $prop,
        ]);
    }

    /**
     * @return boolean
     */
    public function isLiked()
    {
        return $this->liked;
    }

    /**
     * @param boolean $liked
     */
    public function setLiked($liked)
    {
        $this->liked = (bool)$liked;
    }
}