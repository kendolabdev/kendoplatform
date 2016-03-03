<?php
namespace Platform\Relation\Html;

use Kendo\Html\FormField;
use Kendo\Html\HtmlElement;
use Kendo\View\View;

/**
 * Class PrivacyButtonField
 *
 * @package Platform\Relation\Html
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
     * @var \Kendo\Content\PosterInterface
     */
    protected $forParent;

    /**
     * @var string
     */
    protected $forAction;

    /**
     * @var \Kendo\Content\PosterInterface
     */
    protected $forPoster;

    /**
     * @var \Kendo\Content\ContentInterface
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
     * @return \Kendo\Content\ContentInterface
     */
    public function getForItem()
    {
        return $this->forItem;
    }

    /**
     * @param \Kendo\Content\ContentInterface $forItem
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
     * @return \Kendo\Content\PosterInterface
     */
    public function getForPoster()
    {
        if (null == $this->forPoster) {
            $this->forPoster = \App::authService()->getViewer();
        }

        return $this->forPoster;
    }

    /**
     * @param \Kendo\Content\PosterInterface $forPoster
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
     * @return \Kendo\Content\PosterInterface
     */
    public function getForParent()
    {
        if (null == $this->forParent) {
            $this->forParent = \App::authService()->getViewer();
        }

        return $this->forParent;
    }

    /**
     * @param \Kendo\Content\PosterInterface $forParent
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

        if (empty($forAction) or empty($forPoster)) {
            return '';
        }

        // default Platform\Relation Type, Relation Id.
        $relationValue = null;
        $relationType = null;

        if (null != $forItem) {
            list($relationType, $relationValue) = $forItem->getPrivacy($this->getForItemAction());
        }

        // privacy_view , blog_post_view, 18, 24; how to control following items.
        $privacy = \App::relationService()->getRelationOptionForSelect($forParent, $forPoster, $forAction, $relationType, $relationValue);

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

        return (new View('platform/relation/partial/button-privacy', $params))->render();

    }
}