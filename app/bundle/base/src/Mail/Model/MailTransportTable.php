<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_mail_transport`
 */

namespace Mail\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class MailTransportTable
 *
 * @package Mail\Model
 */
class MailTransportTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_mail_transport`
     * @var string
     */
    protected $class =  '\Mail\Model\MailTransport';

    /**
     * @var string
     */
    protected $name =  'mail_transport';

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
     * @return \Mail\Model\MailTransport
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