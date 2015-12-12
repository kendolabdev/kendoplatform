<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_mail_adapter`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\MailAdapterTable
 *
 * @package Platform\Mail\Model
 */
class MailAdapterTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_mail_adapter`
     * @var string
     */
    protected $class =  '\Platform\Mail\Model\MailAdapter';

    /**
     * @var string
     */
    protected $name =  'platform_mail_adapter';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'name'=>1,
		'setting_form'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Mail\Model\MailAdapter
     */
    public function findById($value){
       return $this->select()
           ->where('id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}