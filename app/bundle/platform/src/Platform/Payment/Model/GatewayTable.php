<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_payment_gateway`
 */

namespace Platform\Payment\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class GatewayTable
 * @package Platform\Payment\Model
 */
class GatewayTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_payment_gateway`
     * @var string
     */
    protected $class =  '\Platform\Payment\Model\Gateway';

    /**
     * @var string
     */
    protected $name =  'platform_payment_gateway';

    /**
     * @var array
     */
    protected $column = array(
		'gateway_id'=>1,
		'gateway_title'=>1,
		'gateway_description'=>1,
		'gateway_active'=>1,
		'gateway_admin_form'=>1,
		'gateway_params_text'=>1,
		'gateway_test_mode'=>1,
		'gateway_sort_order'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'gateway_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Payment\Model\Gateway
     */
    public function findById($value){
       return $this->select()
           ->where('gateway_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('gateway_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}