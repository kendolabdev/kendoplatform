<?php
namespace Picaso\Content;

/**
 * Class ImpHasPrivacy
 *
 * @package Picaso\Content
 */
Trait ImpHasPrivacy
{

    /**
     * @var array
     */
    public $_privacy;

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

            \App::feedService()->updatePrivacy($this);
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
}