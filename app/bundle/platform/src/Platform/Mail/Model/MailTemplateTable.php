<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_mail_template`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\MailTemplateTable
 *
 * @package Platform\Mail\Model
 */
class MailTemplateTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_mail_template`
     * @var string
     */
    protected $class = '\Platform\Mail\Model\MailTemplate';

    /**
     * @var string
     */
    protected $name = 'platform_mail_template';

    /**
     * @var array
     */
    protected $column = [
        'template_id'       => 1,
        'module_name'       => 1,
        'title'             => 1,
        'template_name'     => 1,
        'subject_default'   => 1,
        'body_text_default' => 1,
        'body_html_default' => 1];

    /**
     * @var array
     */
    protected $primary = ['template_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'template_id';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Mail\Model\MailTemplate
     */
    public function findById($value)
    {
        return $this->select()
            ->where('template_id=?', $value)
            ->one();
    }

    /**
     * @param  array $value
     *
     * @return array
     */
    public function findByIdList($value)
    {
        return $this->select()
            ->where('template_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}