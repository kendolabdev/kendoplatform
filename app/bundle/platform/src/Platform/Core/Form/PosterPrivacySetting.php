<?php
namespace Platform\Core\Form;

use Kendo\Html\Form;

/**
 * Class PosterPrivacySetting
 *
 * @package Core\Form
 */
class PosterPrivacySetting extends Form
{

    /**
     * @var \Kendo\Content\PosterInterface
     */
    protected $poster;

    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * @param \Kendo\Content\PosterInterface $poster
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;
    }

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('form_privacy_setting.form_title');
        $this->setNote('form_privacy_setting.form_note');

        \App::emitter()
            ->emit('onBeforeInitFormPosterPrivacy', $this);

        \App::emitter()
            ->emit('onAfterInitFormPosterPrivacy', $this);
    }


}