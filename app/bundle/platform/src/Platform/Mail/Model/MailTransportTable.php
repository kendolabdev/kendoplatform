<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_mail_transport`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\MailTransportTable
 *
 * @package Platform\Mail\Model
 */
class MailTransportTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_mail_transport`
     * @var string
     */
    protected $class =  '\Platform\Mail\Model\MailTransport';

    /**
     * @var string
     */
    protected $name =  'platform_mail_transport';

    /**
     * @var array
     */
    protected $column = array(
		'transport_id'=>1,
		'transport_type'=>1,
		'is_system'=>1,
		'transport_name'=>1,
		'params_text'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'transport_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'transport_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Mail\Model\MailTransport
     */
    public function findById($value){
       return $this->select()
           ->where('transport_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('transport_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}