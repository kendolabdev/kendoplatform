<?php
namespace Video\Form;

use Picaso\Html\Form;

/**
 * Class VideoFromUrl
 *
 * @package Video\Form
 */
class VideoFromUrl extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('video.embed_video');


        $this->addElements([
            [
                'plugin'      => 'text',
                'name'        => 'videoUrl',
                'label'       => 'Video Url',
                'placeholder' => 'video url',
                'note'        => 'Support YouTube',
                'required'    => true,
                'class'       => 'form-control'
            ]
        ]);
    }
}
