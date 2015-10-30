<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_captcha_adapter`
 */

namespace Captcha\Model;

/**
 */
use Picaso\Db\DbTable;

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
     * @see `picaso_captcha_adapter`
     * @var string
     */
    protected $class =  '\Captcha\Model\CaptchaAdapter';

    /**
     * @var string
     */
    protected $name =  'captcha_adapter';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'name'=>1,
		'is_active'=>1,
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
     * @return \Captcha\Model\CaptchaAdapter
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