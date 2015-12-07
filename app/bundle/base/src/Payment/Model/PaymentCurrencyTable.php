<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_payment_currency`
 */

namespace Payment\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class PaymentCurrencyTable
 *
 * @package Payment\Model
 */
class PaymentCurrencyTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_payment_currency`
     * @var string
     */
    protected $class =  '\Payment\Model\PaymentCurrency';

    /**
     * @var string
     */
    protected $name =  'payment_currency';

    /**
     * @var array
     */
    protected $column = array(
		'currency_code'=>1,
		'currency_name'=>1,
		'currency_symbol'=>1,
		'currency_active'=>1,
		'currency_position'=>1,
		'currency_precision'=>1,
		'currency_script'=>1,
		'currency_format'=>1,
		'currency_display'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'currency_code'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Payment\Model\PaymentCurrency
     */
    public function findById($value){
       return $this->select()
           ->where('currency_code=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('currency_code IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}