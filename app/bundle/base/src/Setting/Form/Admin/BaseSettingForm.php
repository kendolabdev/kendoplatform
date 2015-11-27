<?php
namespace Setting\Form\Admin;

use Picaso\Html\Form;
use Picaso\Html\FormField;

/**
 * Class BaseSettingForm
 *
 * @package Setting\Form\Admin
 */
class BaseSettingForm extends Form
{

    /**
     * @return array
     */
    public function getKeyList()
    {
        $result = [];

        foreach ($this->byNames as $name => $element) {

            if (!$element instanceof FormField)
                continue;

            if (strpos($name, '__') == false)
                continue;

            if (substr($name, 0, 1) == '_')
                continue;

            list($group, $key) = explode('__', $name, 2);

            $result[ $group ][ $key ] = $element->getValue();
        }

        return $result;
    }

    /**
     * Populate data from storage
     */
    public function load()
    {
        $data = [];

        $setting = \App::settingService();

        foreach ($this->getKeyList() as $group => $actions) {
            foreach ($actions as $name => $defaultValue) {
                $key = sprintf('%s__%s', $group, $name);
                $data[ $key ] = $setting->get($group, $name, $defaultValue);
            }
        }

        $this->setData($data);
    }

    /**
     * save all group data to setting controllers.
     */
    public function save()
    {
        $data = $this->getData();

        $this->_save($data);
    }

    /**
     * Put data to storage
     *
     * @param $data
     */
    protected function _save($data)
    {

        $assoc = [];

        foreach ($data as $name => $value) {
            if (substr($name, 0, 1) == '_') continue;
            if (strpos($name, '__') == false) continue;

            list($group, $key) = explode('__', $name, 2);

            $assoc[ $group ][ $key ] = $value;
        }

        \App::settingService()->save($assoc);
    }
}