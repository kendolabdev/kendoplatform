<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_mail_adapter`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class AdapterTable
 * @package Platform\Mail\Model
 */
class AdapterTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_mail_adapter`
     * @var string
     */
    protected $class =  '\Platform\Mail\Model\Adapter';

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
     * @return \Platform\Mail\Model\Adapter
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