<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_payment_currency`
 */

namespace Platform\Payment\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\PaymentCurrency
 *
 * @package Platform\Payment\Model
 */
class PaymentCurrency extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('currency_code');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('currency_code', $value);
    }

    /**
     * @return null|string
     */
    public function getCurrencyCode()
    {
        return $this->__get('currency_code');
    }

    /**
     * @param $value
     */
    public function setCurrencyCode($value)
    {
        $this->__set('currency_code', $value);
    }

    /**
     * @return null|string
     */
    public function getCurrencyName()
    {
        return $this->__get('currency_name');
    }

    /**
     * @param $value
     */
    public function setCurrencyName($value)
    {
        $this->__set('currency_name', $value);
    }

    /**
     * @return null|string
     */
    public function getCurrencySymbol()
    {
        return $this->__get('currency_symbol');
    }

    /**
     * @param $value
     */
    public function setCurrencySymbol($value)
    {
        $this->__set('currency_symbol', $value);
    }

    /**
     * @return null|string
     */
    public function getCurrencyActive()
    {
        return $this->__get('currency_active');
    }

    /**
     * @param $value
     */
    public function setCurrencyActive($value)
    {
        $this->__set('currency_active', $value);
    }

    /**
     * @return null|string
     */
    public function getCurrencyPosition()
    {
        return $this->__get('currency_position');
    }

    /**
     * @param $value
     */
    public function setCurrencyPosition($value)
    {
        $this->__set('currency_position', $value);
    }

    /**
     * @return null|string
     */
    public function getCurrencyPrecision()
    {
        return $this->__get('currency_precision');
    }

    /**
     * @param $value
     */
    public function setCurrencyPrecision($value)
    {
        $this->__set('currency_precision', $value);
    }

    /**
     * @return null|string
     */
    public function getCurrencyScript()
    {
        return $this->__get('currency_script');
    }

    /**
     * @param $value
     */
    public function setCurrencyScript($value)
    {
        $this->__set('currency_script', $value);
    }

    /**
     * @return null|string
     */
    public function getCurrencyFormat()
    {
        return $this->__get('currency_format');
    }

    /**
     * @param $value
     */
    public function setCurrencyFormat($value)
    {
        $this->__set('currency_format', $value);
    }

    /**
     * @return null|string
     */
    public function getCurrencyDisplay()
    {
        return $this->__get('currency_display');
    }

    /**
     * @param $value
     */
    public function setCurrencyDisplay($value)
    {
        $this->__set('currency_display', $value);
    }

    /**
     * @return \Platform\Payment\Model\PaymentCurrencyTable
     */
    public function table()
    {
        return \App::table('platform_payment_currency');
    }
    //END_TABLE_GENERATOR
}