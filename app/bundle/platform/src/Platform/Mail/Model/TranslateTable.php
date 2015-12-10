<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_mail_translate`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class TranslateTable
 * @package Platform\Mail\Model
 */
class TranslateTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_mail_translate`
     * @var string
     */
    protected $class =  '\Platform\Mail\Model\Translate';

    /**
     * @var string
     */
    protected $name =  'platform_mail_translate';

    /**
     * @var array
     */
    protected $column = array(
		'template_id'=>1,
		'language_id'=>1,
		'subject'=>1,
		'body_text'=>1,
		'body_html'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'template_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'template_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Mail\Model\Translate
     */
    public function findById($value){
       return $this->select()
           ->where('template_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('template_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}