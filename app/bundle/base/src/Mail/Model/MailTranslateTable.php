<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_mail_translate`
 */

namespace Mail\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class MailTranslateTable
 *
 * @package Mail\Model
 */
class MailTranslateTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_mail_translate`
     * @var string
     */
    protected $class =  '\Mail\Model\MailTranslate';

    /**
     * @var string
     */
    protected $name =  'mail_translate';

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
     * @return \Mail\Model\MailTranslate
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