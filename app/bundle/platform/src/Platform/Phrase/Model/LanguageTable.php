<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_phrase_language`
 */

namespace Platform\Phrase\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class LanguageTable
 * @package Platform\Phrase\Model
 */
class LanguageTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_phrase_language`
     * @var string
     */
    protected $class =  '\Platform\Phrase\Model\Language';

    /**
     * @var string
     */
    protected $name =  'platform_phrase_language';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'name'=>1);

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
     * @return \Platform\Phrase\Model\Language
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