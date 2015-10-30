<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_mail_template`
 */

namespace Mail\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class MailTemplateTable
 *
 * @package Mail\Model
 */
class MailTemplateTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_mail_template`
     * @var string
     */
    protected $class =  '\Mail\Model\MailTemplate';

    /**
     * @var string
     */
    protected $name =  'mail_template';

    /**
     * @var array
     */
    protected $column = array(
		'template_id'=>1,
		'module_name'=>1,
		'title'=>1,
		'template_name'=>1,
		'subject_default'=>1,
		'body_text_default'=>1,
		'body_html_default'=>1);

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
     * @return \Mail\Model\MailTemplate
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