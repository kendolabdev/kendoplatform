<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_payment_gateway`
 */

namespace Platform\Payment\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\PaymentGateway
 *
 * @package Platform\Payment\Model
 */
class PaymentGateway extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('gateway_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('gateway_id', $value);
    }

    /**
     * @return null|string
     */
    public function getGatewayId()
    {
        return $this->__get('gateway_id');
    }

    /**
     * @param $value
     */
    public function setGatewayId($value)
    {
        $this->__set('gateway_id', $value);
    }

    /**
     * @return null|string
     */
    public function getGatewayTitle()
    {
        return $this->__get('gateway_title');
    }

    /**
     * @param $value
     */
    public function setGatewayTitle($value)
    {
        $this->__set('gateway_title', $value);
    }

    /**
     * @return null|string
     */
    public function getGatewayDescription()
    {
        return $this->__get('gateway_description');
    }

    /**
     * @param $value
     */
    public function setGatewayDescription($value)
    {
        $this->__set('gateway_description', $value);
    }

    /**
     * @return null|string
     */
    public function getGatewayActive()
    {
        return $this->__get('gateway_active');
    }

    /**
     * @param $value
     */
    public function setGatewayActive($value)
    {
        $this->__set('gateway_active', $value);
    }

    /**
     * @return null|string
     */
    public function getGatewayAdminForm()
    {
        return $this->__get('gateway_admin_form');
    }

    /**
     * @param $value
     */
    public function setGatewayAdminForm($value)
    {
        $this->__set('gateway_admin_form', $value);
    }

    /**
     * @return null|string
     */
    public function getGatewayParamsText()
    {
        return $this->__get('gateway_params_text');
    }

    /**
     * @param $value
     */
    public function setGatewayParamsText($value)
    {
        $this->__set('gateway_params_text', $value);
    }

    /**
     * @return null|string
     */
    public function getGatewayTestMode()
    {
        return $this->__get('gateway_test_mode');
    }

    /**
     * @param $value
     */
    public function setGatewayTestMode($value)
    {
        $this->__set('gateway_test_mode', $value);
    }

    /**
     * @return null|string
     */
    public function getGatewaySortOrder()
    {
        return $this->__get('gateway_sort_order');
    }

    /**
     * @param $value
     */
    public function setGatewaySortOrder($value)
    {
        $this->__set('gateway_sort_order', $value);
    }

    /**
     * @return \Platform\Payment\Model\PaymentGatewayTable
     */
    public function table()
    {
        return \App::table('platform_payment_gateway');
    }
    //END_TABLE_GENERATOR
}