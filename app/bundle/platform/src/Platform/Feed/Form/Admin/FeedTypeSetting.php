<?php
namespace Platform\Feed\Form\Admin;

use Platform\Feed\Model\FeedType;
use Kendo\Html\Form;

/**
 * Class FeedTypeSetting
 *
 * @package Feed\Form\Admin
 */
class FeedTypeSetting extends Form
{
    /**
     * @var \Feed\Model\FeedType
     */
    protected $feedType;

    /**
     *
     */
    public function load()
    {
        $item = $this->getFeedType();


        $target = [];

        if ($item->getShowOnPublic()) {
            $target[] = 1;
        }

        if ($item->getShowOnMain()) {
            $target[] = 2;
        }

        if ($item->getShowOnPoster()) {
            $target[] = 3;
        }

        if ($item->getShowOnPublic()) {
            $target[] = 4;
        }
        if ($item->getShowOnTagged()) {
            $target[] = 5;
        }

        $data = [
            'can_share'   => $item->getCanShare(),
            'can_like'    => $item->getCanLike(),
            'can_comment' => $item->getCanComment(),
            'is_active'   => $item->isActive(),
            'target'      => $target
        ];

        $this->setData($data);
    }

    /**
     *
     */
    public function save()
    {

        $item = $this->getFeedType();
        $data = $this->getData();


        $item->setActive($data['is_active'] ? 1 : 0);
        $item->setCanShare($data['can_share'] ? 1 : 0);

        $target = (array)$data['target'];

        $item->setShowOnPublic(in_array(1, $target) ? 1 : 0);
        $item->setShowOnMain(in_array(2, $target) ? 1 : 0);
        $item->setShowOnPoster(in_array(3, $target) ? 1 : 0);
        $item->setShowOnParent(in_array(4, $target) ? 1 : 0);
        $item->setShowOnTagged(in_array(4, $target) ? 1 : 0);

        $item->save();

    }

    /**
     *
     */
    protected function init()
    {

        $this->setTitle($this->getFeedType()->toText('activity.label_for_feed_type_'));

        $this->setNote('form_feed_type_setting.form_note');

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_active',
            'label'  => 'form_feed_type_setting.is_active_label',
            'note'   => 'form_feed_type_setting.is_active_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'can_share',
            'label'  => 'form_feed_type_setting.is_shareable_label',
            'note'   => 'form_feed_type_setting.is_shareable_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin'        => 'multicheckbox',
            'name'          => 'target',
            'label'         => 'form_feed_type_setting.target_label',
            'note'          => 'form_feed_type_setting.target_note',
            'optionTextKey' => 'form_feed_type_setting.target_opt_',
            'options'       => [
                ['value' => 1],
                ['value' => 2],
                ['value' => 3],
                ['value' => 4],
                ['value' => 5],
            ],
            'value'         => [1, 2, 3, 4, 5]
        ]);
    }

    /**
     * @return FeedType
     */
    public function getFeedType()
    {
        return $this->feedType;
    }

    /**
     * @param FeedType $feedType
     */
    public function setFeedType($feedType)
    {
        $this->feedType = $feedType;
    }


}
