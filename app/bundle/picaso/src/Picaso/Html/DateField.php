<?php
namespace Picaso\Html;

/**
 * Class DateField
 *
 * @package Picaso\Html
 */
class DateField extends HtmlElement implements FormField
{

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $day;

    /**
     * @var string
     */
    protected $month;

    /**
     * @var string
     */
    protected $year;

    /**
     * @return string
     */
    protected $minDate = null;

    /**
     * @var string
     */
    protected $maxDate = null;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string|array $value
     */
    public function setValue($value)
    {
        if (is_array($value)) {
            $this->value = sprintf("%4d-%2d-%2d", $value['year'], $value['month'], $value['day']);
        } else {
            $this->value = $value;
        }
    }

    /**
     * @return array
     */
    public function getDayOptions()
    {
        $options = [];

        for ($i = 1; $i <= 31; ++$i) {
            $options[] = [
                'value' => $i,
                'label' => $i,
            ];
        }

        return $options;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $yearField = \App::html()->create([
            'plugin'      => 'select',
            'name'        => $this->getName() . '[year]',
            'options'     => $this->getYearOptions(),
            'required'    => $this->isRequired(),
            'disabled'    => $this->isDisabled(),
            'value'       => $this->getYear(),
            'class'       => 'form-control',
            'placeholder' => 'core.year',
        ]);

        $monthField = \App::html()->create([
            'plugin'      => 'select',
            'name'        => $this->getName() . '[month]',
            'options'     => $this->getMonthOptions(),
            'required'    => $this->isRequired(),
            'disabled'    => $this->isDisabled(),
            'value'       => $this->getMonth(),
            'class'       => 'form-control',
            'placeholder' => 'core.month',
        ]);

        $dayField = \App::html()->create([
            'plugin'      => 'select',
            'name'        => $this->getName() . '[day]',
            'options'     => $this->getMonthOptions(),
            'required'    => $this->isRequired(),
            'disabled'    => $this->isDisabled(),
            'value'       => $this->getDay(),
            'class'       => 'form-control',
            'placeholder' => 'core.day',
        ]);

        if ($this->isRequired()) {
            return sprintf('%s %s %s %s %s %s',
                \App::text('core.month'), $monthField->toHtml(),
                \App::text('core.day'), $dayField->toHtml(),
                \App::text('core.year'), $yearField->toHtml());
        }

        return sprintf('<div class="form-inline">%s %s %s</div>', $monthField->toHtml(), $dayField->toHtml(), $yearField->toHtml());
    }

    /**
     * what is scale of this flavour
     */
    public function getYearOptions()
    {
        list($minYear) = explode('-', $this->minDate, 2);
        list($maxYear) = explode('-', $this->maxDate, 2);

        $options = [];

        for ($i = $minYear; $i <= $maxYear; ++$i) {
            $options[] = [
                'value' => $i,
                'label' => $i,
            ];
        }

        return $options;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return array
     */
    public function getMonthOptions()
    {
        $options = [];

        for ($i = 1; $i <= 12; ++$i) {
            $options[] = [
                'value' => $i,
                'label' => $i,
            ];
        }

        return $options;
    }

    /**
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param string $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param string $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    protected function init()
    {
        parent::init();

        list($y, $m, $d) = explode('-', date('Y-m-d'));

        $this->setYear($y);
        $this->setMonth($m);
        $this->setDay($d);

        if (null == $this->maxDate) {
            $this->maxDate = (intval(date('Y')) + 50) . date('-m-d');
        }

        if (null == $this->minDate) {
            $this->minDate = (intval(date('Y')) - 50) . date('-m-d');
        }
    }
}