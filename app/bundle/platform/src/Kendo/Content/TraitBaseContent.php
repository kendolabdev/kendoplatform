<?php
namespace Kendo\Content;

/**
 * Trait ImpBaseContent
 *
 * @package Kendo\Content
 */
Trait TraitBaseContent
{

    /**
     * @var array
     */
    public $_privacy;

    /**
     * @param string $maker
     *
     * @return string
     */
    public function getPhoto($maker)
    {
        if (!$this instanceof ContentInterface) return '';

        if ($this->getPhotoFileId() > 0) {
            if (null != ($src = app()->storageService()
                    ->getUrlByOriginAndMaker($this->getPhotoFileId(), $maker))
            ) {
                return $src;
            }
        }

        return app()->assetService()->getUrl('/static/nophoto/' . $this->getType() . '_' . $maker . '.jpg');
    }

    /**
     * @return string
     */
    public function getStory()
    {
        return '';
    }

    /**
     * @param string $value
     */
    public function setStory($value)
    {

    }

    /**
     * @param $value
     */
    public function setPeopleCount($value)
    {

    }

    /**
     *
     */
    public function getPeopleCount()
    {

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strtr('<a href=":href">:title</a>', [':href' => $this->toHref(), ':title' => $this->getTitle()]);
    }

    /**
     * @return string
     */
    public function toToken()
    {
        return sprintf('%s@%s', $this->getId(), $this->getType());
    }

    /**
     * @return PosterInterface
     */
    public function getPoster()
    {
        return app()->find($this->getPosterType(), $this->getPosterId());
    }

    /**
     * @return PosterInterface
     */
    public function getParent()
    {
        return app()->find($this->getParentType(), $this->getParentId());
    }

    /**
     * @return \Platform\User\Model\User
     */
    public function getUser()
    {
        return app()->find('user', $this->getUserId());
    }


    /**
     * @return bool
     */
    public function viewerIsPoster()
    {
        if (!app()->auth()->logged())
            return false;

        return (bool)array_intersect([app()->auth()->getId(), app()->auth()->getUserId()],
            [$this->getId(), $this->getPosterId(), $this->getUserId()]);
    }

    /**
     * @return bool
     */
    public function viewerIsParent()
    {
        if (!app()->auth()->logged())
            return false;

        return (bool)array_intersect([app()->auth()->getId(), app()->auth()->getUserId()],
            [$this->getId(), $this->getParentId(), $this->getParentUserId()]);
    }

    /**
     * @return bool
     */
    public function viewerIsPosterOrParent()
    {
        if (!app()->auth()->logged())
            return false;

        return (bool)array_intersect([app()->auth()->getId(), app()->auth()->getUserId()],
            [$this->getId(), $this->getparentId(), $this->getParentUserId(), $this->getUserId(), $this->getPosterId()]);
    }

    /**
     * @return array
     */
    public function toTokenArray()
    {
        return [
            'type' => $this->getType(),
            'id'   => $this->getId()
        ];
    }

    /**
     * @return string
     */
    public function toTokenJson()
    {
        return json_encode([
            'type' => $this->getType(),
            'id'   => $this->getId()
        ]);
    }

    /**
     * @return ContentInterface
     */
    public function getAbout()
    {
        return app()->find($this->getAboutType(), $this->getAboutId());
    }

    /**
     * @return string
     */
    public function lnLike()
    {
        return (new LinkLike())->__invoke($this);
    }

    /**
     * @return string
     */
    public function lnComment()
    {
        return (new LinkComment())->__invoke($this);
    }

    /**
     * @return string
     */
    public function lnShare()
    {
        return (new LinkShare())->__invoke($this);
    }

    /**
     * Find associate place
     *
     * @return \Platform\Place\Model\Place
     */
    public function getPlace()
    {

        if (null != $this->getPlaceId()) {
            return app()->find($this->getPlaceType(), $this->getPlaceId());
        }

        return null;
    }

    /**
     * Require place params lat, lng, title, address
     *
     * @param mixed $place
     */
    public function setPlace($place)
    {
        if (!$this instanceof ContentInterface) ;

        if (!$place instanceof ContentInterface) {
//            $place = app()->make('place')->tryPlace($place);
        }

        if ($place instanceof ContentInterface) {
            $this->setPlaceId($place->getId());
            $this->setPlaceType($place->getType());
        }
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function getPeople($limit = null)
    {
        return app()->tagService()->loadPeople($this, $limit);
    }

    /**
     * @param $people
     */
    public function setPeople($people)
    {
        $total = app()->tagService()->tagPeople($this, $people);
        $this->setPeopleCount($total);
    }

    /**
     * @param $action
     * @param $type
     * @param $value
     */
    public function updatePrivacy($action, $type, $value)
    {

        $privacy = json_decode($this->__get('privacy_text'), 1);

        $name = $action;
        if (strpos($action, '__')) {
            list($group, $key) = explode('__', $action);
            $name = $key == 'view' ? 'view' : $group . '__' . $key;
        }


        if ($name == 'view') {
            $this->__set('privacy_type', $type);
            $this->__set('privacy_value', $value);

            app()->feedService()->updatePrivacy($this);
        }

        $privacy[ $name ] = ['type' => $type, 'value' => $value];

        $this->__set('privacy_text', json_encode($privacy));

        $this->save();

    }

    /**
     * @param $name
     *
     * @return array
     */
    public function getPrivacy($name)
    {
        if (null != ($text = $this->__get('privacy_text'))) {

            $data = json_decode($text, true);

            if (preg_match("#(\.|__)view$#", $name)) {
                $name = 'view';
            }

            foreach ([$name, 'view'] as $temp) {
                if (!empty($data[ $temp ])) {
                    $data = $data[ $temp ];

                    return [$data['type'], $data['value']];
                }
            }
        }

        return [
            $this->getPrivacyType(), $this->getPrivacyValue()
        ];
    }

    /**
     * @return int
     */
    public function getPlaceId()
    {
        return 0;
    }

    /**
     * @param $value
     */
    public function setPlaceId($value)
    {

    }

    /**
     * @return string
     */
    public function getPlaceType()
    {
        return '';
    }

    /**
     * @param $value
     */
    public function setPlaceType($value)
    {

    }

    /**
     * @param array $params
     */
    public function toHtml($params = [])
    {

    }

    public function getPhotoFileId()
    {
        return '';
    }


    public function setPhotoFileId($value)
    {

    }
}