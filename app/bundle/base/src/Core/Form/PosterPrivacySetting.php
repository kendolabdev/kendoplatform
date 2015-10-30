<?php
namespace Core\Form;

use Picaso\Html\Form;

/**
 * Class PosterPrivacySetting
 *
 * @package Core\Form
 */
class PosterPrivacySetting extends Form
{

    /**
     * @var \Picaso\Content\Poster
     */
    protected $poster;

    /**
     * @return \Picaso\Content\Poster
     */
    public function getPoster()
    {
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
    protected function init()
    {
        $this->setTitle('form_privacy_setting.form_title');
        $this->setNote('form_privacy_setting.form_note');

        \App::hook()
            ->notify('onBeforeInitFormPosterPrivacy', $this);

        \App::hook()
            ->notify('onAfterInitFormPosterPrivacy', $this);
    }


}