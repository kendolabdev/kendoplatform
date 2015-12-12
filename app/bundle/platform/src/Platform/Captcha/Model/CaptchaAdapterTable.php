<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_captcha_adapter`
 */

namespace Platform\Captcha\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CaptchaAdapterTable
 *
 * @package Captcha\Model
 */
class CaptchaAdapterTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_captcha_adapter`
     * @var string
     */
    protected $class = '\Platform\Captcha\Model\CaptchaAdapter';

    /**
     * @var string
     */
    protected $name = 'platform_captcha_adapter';

    /**
     * @var array
     */
    protected $column = [
        'id'           => 1,
        'name'         => 1,
        'is_active'    => 1,
        'setting_form' => 1];

    /**
     * @var array
     */
    protected $primary = ['id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Captcha\Model\CaptchaAdapter
     */
    public function findById($value)
    {
        return $this->select()
            ->where('id=?', $value)
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
            ->where('id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}