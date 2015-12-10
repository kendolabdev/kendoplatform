<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_phrase`
 */

namespace Platform\Phrase\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\PhraseTable
 *
 * @package Platform\Phrase\Model
 */
class PhraseTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_phrase`
     * @var string
     */
    protected $class =  '\Platform\Phrase\Model\Phrase';

    /**
     * @var string
     */
    protected $name =  'platform_phrase';

    /**
     * @var array
     */
    protected $column = array(
		'phrase_id'=>1,
		'module_name'=>1,
		'is_active'=>1,
		'phrase_group'=>1,
		'phrase_name'=>1,
		'default_value'=>1,
		'is_edited'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'phrase_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'phrase_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Phrase\Model\Phrase
     */
    public function findById($value){
       return $this->select()
           ->where('phrase_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('phrase_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}