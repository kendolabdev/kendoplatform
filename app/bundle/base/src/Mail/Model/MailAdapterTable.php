<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_mail_adapter`
 */

namespace Mail\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class MailAdapterTable
 *
 * @package Mail\Model
 */
class MailAdapterTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_mail_adapter`
     * @var string
     */
    protected $class =  '\Mail\Model\MailAdapter';

    /**
     * @var string
     */
    protected $name =  'mail_adapter';

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
     * @return \Mail\Model\MailAdapter
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