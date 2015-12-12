<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_payment_gateway`
 */

namespace Platform\Payment\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\PaymentGatewayTable
 *
 * @package Platform\Payment\Model
 */
class PaymentGatewayTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_payment_gateway`
     * @var string
     */
    protected $class = '\Platform\Payment\Model\PaymentGateway';

    /**
     * @var string
     */
    protected $name = 'platform_payment_gateway';

    /**
     * @var array
     */
    protected $column = [
        'gateway_id'          => 1,
        'gateway_title'       => 1,
        'gateway_description' => 1,
        'gateway_active'      => 1,
        'gateway_admin_form'  => 1,
        'gateway_params_text' => 1,
        'gateway_test_mode'   => 1,
        'gateway_sort_order'  => 1];

    /**
     * @var array
     */
    protected $primary = ['gateway_id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Payment\Model\PaymentGateway
     */
    public function findById($value)
    {
        return $this->select()
            ->where('gateway_id=?', $value)
            ->one();
    }

    /**
     * @param  array $value
     *
     * @return array
     */
    public function findByIdList($value)
    {
        return $this->select()
            ->where('gateway_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}