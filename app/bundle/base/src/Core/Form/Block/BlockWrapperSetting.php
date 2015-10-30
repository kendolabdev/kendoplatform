<?php

namespace Core\Form\Block;

use Picaso\Html\Form;

/**
 * Class BlockWrapperSetting
 *
 * @package Core\Block
 */
class BlockWrapperSetting extends Form
{

    protected function init()
    {
        $this->addElements([
            [
                'plugin'  => 'radio',
                'name'    => 'block_wrapper_type',
                'label'   => 'Type',
                'value'   => 'default',
                'inline'  => true,
                'options' => [
                    ['value' => 'none', 'label' => 'None'],
                    ['value' => 'default', 'label' => 'Default'],
                    ['value' => 'panel', 'label' => 'Panel'],
                    ['value' => 'callout', 'label' => 'Callout'],
                    ['value' => 'alert', 'label' => 'Alert'],
                ],
            ]
        ]);
    }

}