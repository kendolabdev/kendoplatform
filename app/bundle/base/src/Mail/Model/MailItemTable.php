<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_mail_item`
 */

namespace Mail\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class MailItemTable
 *
 * @package Mail\Model
 */
class MailItemTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_mail_item`
     * @var string
     */
    protected $class =  '\Mail\Model\MailItem';

    /**
     * @var string
     */
    protected $name =  'mail_item';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'is_sent'=>1,
		'priority'=>1,
		'subject'=>1,
		'body_text'=>1,
		'body_html'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = 'id';

    
    /**
     * @param  string|int $value
     * @return \Mail\Model\MailItem
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