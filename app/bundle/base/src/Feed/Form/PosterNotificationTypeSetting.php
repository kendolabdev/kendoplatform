<?php
namespace Feed\Form;

use Notification\Model\Type;
use Picaso\Html\Form;

/**
 * Class PosterNotificationTypeSetting
 *
 * @package Feed\Form
 */
class PosterNotificationTypeSetting extends Form
{
    /**
     * @var \Picaso\Content\Poster
     */
    protected $poster = null;

    /**
     *
     */
    public function load()
    {
        $poster = $this->getPoster();

        $values = \App::value($poster, 'notification', []);

        $this->setData($values);
    }

    /**
     * @return \Picaso\Content\Poster
     */
    public function getPoster()
    {
        if (null == $this->poster) {
            $this->poster = \App::authService()->getUser();
        }

        return $this->poster;
    }

    /**
     * @param \Picaso\Content\Poster $poster
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;
    }

    /**
     *
     */
    public function save()
    {
        $data = $this->getData();

        $disabled = [];

        foreach ($data as $key => $value) {
            if (substr($key, 0, 1) != '_' && $value == "0") {
                $disabled[ $key ] = 0;
            }
        }

        \App::values()->setValue($this->getPoster(), 'notification', $disabled);
    }

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('form_notification_setting.form_title');
        $this->setNote('form_notification_setting.form_note');

        $groups = \App::notificationService()
            ->getListTypeGroup();

        /**
         *
         */
        foreach ($groups as $group) {
            $options = [];
            $items = \App::notificationService()
                ->getListTypeByGroup($group);

            $item = null;

            foreach ($items as $item) {
                if (!$item instanceof Type) continue;
                $options[] = ['value' => $item->getId(), 'label' => $item->getTitle()];
            }

            if (!$item instanceof Type) continue;

            $this->addElement([
                'plugin'  => 'multicheckbox',
                'name'    => $item->getNotificationGroup(),
                'label'   => $item->getGroupTitle(),
                'options' => $options
            ]);
        }

    }
}