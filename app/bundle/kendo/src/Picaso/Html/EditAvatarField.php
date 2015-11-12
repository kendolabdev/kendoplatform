<?php
namespace Picaso\Html;

/**
 * Class EditAvatarField
 *
 * @package Picaso\Html
 */
class EditAvatarField extends HtmlElement implements FormField
{

    /**
     * @var array|string
     */
    protected $value;

    /**
     * @return array|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param array|string $value
     */
    public function setValue($value)
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $fileInputId = uniqid('avatar_input_');
        $previewImgId = uniqid('avatar_img_');
        $fileHiddenId = uniqid('avatar_hidden_');

        $data = [
            'name'         => $this->name,
            'value'        => _escape($this->value),
            'photoUrl'     => '',
            'fileInputId'  => $fileInputId,
            'previewImgId' => $previewImgId,
            'fileHiddenId' => $fileHiddenId,
            'width'        => '0px',
            'height'       => '0px',
            'left'         => '0px',
            'top'          => '0px',
            'style'        => '',
            'opts'         => ['type' => 'temp', 'id' => ''],
        ];


        if (!empty($this->value)) {
            if (!empty($this->value['url'])) {
                $data['photoUrl'] = $this->value['url'];
            }

            if (!empty($this->value['options'])) {
                list($w, $h, $w2, $h2, $left, $top) = explode(',', $this->value['options']);
                $previewScale = 98.0 / intval($w2);

                $data['width'] = floor($w * $previewScale);
                $data['height'] = floor($h * $previewScale);
                $data['left'] = floor($left * $previewScale* -1) ;
                $data['top'] = floor($top * $previewScale* -1) ;
                $data['style'] =  'left:'. $data['left'] . 'px; top:'. $data['top'].'px; position:absolute;';
            }
        }

        return \App::viewHelper()
            ->partial('layout/partial/form-render/edit-avatar-field', $data);
    }
}