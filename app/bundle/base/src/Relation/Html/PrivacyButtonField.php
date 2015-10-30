<?php
namespace Relation\Html;

use Picaso\Html\FormField;
use Picaso\Html\HtmlElement;
use Picaso\View\View;

/**
 * Class PrivacyButtonField
 *
 * @package Relation\Html
 */
class PrivacyButtonField extends HtmlElement implements FormField
{
    /**
     * @var string
     */
    protected $size = 'default';

    /**
     * @var string
     */
    protected $valign = '';

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var \Picaso\Content\Poster
     */
    protected $forParent;

    /**
     * @var string
     */
    protected $forAction;

    /**
     * @var \Picaso\Content\Poster
     */
    protected $forPoster;

    /**
     * @var \Picaso\Content\Content
     */
    protected $forItem;

    /**
     * @var string
     */
    protected $forItemAction = 'view';

    /**
     * @var string
     */
    protected $alignment = 'left';

    /**
     * @var array
     */
    protected $excludes = [];

    /**
     * @var array
     */
    protected $accepts = [];

    /**
     * @return array
     */
    public function getExcludes()
    {
        return $this->excludes;
    }

    /**
     * @param array $excludes
     */
    public function setExcludes($excludes)
    {
        $this->excludes = $excludes;
    }

    /**
     * @return array
     */
    public function getAccepts()
    {
        return $this->accepts;
    }

    /**
     * @param array $accepts
     */
    public function setAccepts($accepts)
    {
        $this->accepts = $accepts;
    }

    /**
     * @return string
     */
    public function getForItemAction()
    {
        return $this->forItemAction;
    }

    /**
     * @param string $forItemAction
     */
    public function setForItemAction($forItemAction)
    {
        $this->forItemAction = $forItemAction;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getValign()
    {
        return $this->valign;
    }

    /**
     * @param string $valign
     */
    public function setValign($valign)
    {
        $this->valign = $valign;
    }


    /**
     * @return \Picaso\Content\Content
     */
    public function getForItem()
    {
        return $this->forItem;
    }

    /**
     * @param \Picaso\Content\Content $forItem
     */
    public function setForItem($forItem)
    {
        $this->forItem = $forItem;
    }

    /**
     * @return string
     */
    public function getAlignment()
    {
        return $this->alignment;
    }

    /**
     * @param string $alignment
     */
    public function setAlignment($alignment)
    {
        $this->alignment = $alignment;
    }

    /**
     * @return \Picaso\Content\Poster
     */
    public function getForPoster()
    {
        if (null == $this->forPoster) {
            $this->forPoster = \App::auth()->getViewer();
        }

        return $this->forPoster;
    }

    /**
     * @param \Picaso\Content\Poster $forPoster
     */
    public function setForPoster($forPoster)
    {
        $this->forPoster = $forPoster;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getForAction()
    {
        if (null == $this->forAction) {
            $this->forAction = 'share_status';
        }

        return $this->forAction;
    }

    /**
     * @param string $forAction
     */
    public function setForAction($forAction)
    {
        $this->forAction = $forAction;
    }

    /**
     * @return \Picaso\Content\Poster
     */
    public function getForParent()
    {
        if (null == $this->forParent) {
            $this->forParent = \App::auth()->getViewer();
        }

        return $this->forParent;
    }

    /**
     * @param \Picaso\Content\Poster $forParent
     */
    public function setForParent($forParent)
    {
        $this->forParent = $forParent;
    }

    /**
     *
     */
    public function getSizeClass()
    {
        switch ($this->getSize()) {
            case 'sm':
            case 'small':
                return 'btn-sm';
            case 'xs':
                return 'btn-xs';
            case 'default':
            default:
                return '';

        }
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        $forParent = $this->getForParent();
        $forPoster = $this->getForPoster();
        $forAction = $this->getForAction();
        $forItem = $this->getForItem();

        // default Relation Type, Relation Id.
        $relationValue = null;
        $relationType = null;

        if (null != $forItem) {
            list($relationType, $relationValue) = $forItem->getPrivacy($this->getForItemAction());
        }

        // privacy_view , blog_post_view, 18, 24; how to control following items.
        $privacy = \App::relation()->getRelationOptionForSelect($forParent, $forPoster, $forAction, $relationType, $relationValue);

        $attrs = json_encode([
            'forAction'  => $forAction,
            'alignment'  => $this->getAlignment(),
            'parentType' => $forParent->getType(),
            'parentId'   => $forParent->getId(),
            'excludes'   => $this->getExcludes(),
            'accepts'    => $this->getAccepts(),
        ]);


        $params = [
            'parent'    => $forParent,
            'action'    => $forAction,
            'attrs'     => $attrs,
            'poster'    => $forPoster,
            'privacy'   => $privacy,
            'valign'    => $this->getValign(),
            'sizeClass' => $this->getSizeClass(),
            'alignment' => $this->getAlignment(),
            'name'      => $this->getName(),
        ];

        return (new View('/base/relation/partial/button-privacy', $params))->render();

    }
}