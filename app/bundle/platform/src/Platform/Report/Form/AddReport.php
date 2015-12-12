<?php

namespace Platform\Report\Form;

use Kendo\Html\Form;

/**
 * Class AddReport
 *
 * @package Report\Form
 */
class AddReport extends Form
{
    /**
     * @var mixed
     */
    private $about;

    /**
     *
     */
    protected function init()
    {
        $about = $this->getAbout();

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'aboutId',
            'value'  => $about->getId(),
        ]);

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'aboutType',
            'value'  => $about->getType(),
        ]);

        $categoryOptions = \App::reportService()->loadCategoryOptions();
        $categoryPlugin = count($categoryOptions) > 1 ? 'select' : 'hidden';

        $this->addElement([
            'plugin'   => $categoryPlugin,
            'name'     => 'category_id',
            'label'    => 'Reason',
            'required' => $categoryPlugin == 'select',
            'options'  => $categoryOptions,
        ]);

        $this->addElement([
            'plugin'      => 'textarea',
            'name'        => 'message',
            'label'       => 'Message',
            'value'       => '',
            'required'    => true,
            'placeholder' => 'core.report_message',
            'class'       => 'form-control'
        ]);
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @param $about
     */
    public function setAbout($about)
    {
        $this->about = $about;
    }
}