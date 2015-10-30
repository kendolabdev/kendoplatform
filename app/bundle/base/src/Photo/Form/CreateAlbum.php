<?php
namespace Photo\Form;

use Picaso\Html\Form;

/**
 * Class CreateAlbum
 *
 * @package Photo\Form
 */
class CreateAlbum extends Form
{
    /**
     * Add elements
     */
    protected function init()
    {
        $this->setTitle('photo.create_album');

        $this->setEnctype('multipart/form-data');

        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'name',
            'required'    => true,
            'label'       => 'Album Name',
            'placeholder' => 'Album Name',
            'rules'       => ['required' => ['message' => 'Name is required']],
            'class'       => 'form-control',
        ]);

        $this->addElement([
            'plugin'      => 'textarea',
            'name'        => 'description',
            'label'       => 'Description',
            'placeholder' => 'Description',
            'class'       => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'file',
            'name'     => 'photos',
            'label'    => 'Upload Photo',
            'accept'   => 'image/*',
            'multiple' => true,
        ]);

        $this->addElement([
            'plugin'    => 'privacyButton',
            'name'      => 'privacy_view',
            'size'      => 'sm',
            'label'     => 'photo_album_form.privacy_view_label',
            'forAction' => 'photo_album_view',
        ]);
    }
}