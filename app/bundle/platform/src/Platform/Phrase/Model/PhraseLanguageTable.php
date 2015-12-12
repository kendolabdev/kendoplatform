<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_phrase_language`
 */

namespace Platform\Phrase\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\PhraseLanguageTable
 *
 * @package Platform\Phrase\Model
 */
class PhraseLanguageTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_phrase_language`
     * @var string
     */
    protected $class = '\Platform\Phrase\Model\PhraseLanguage';

    /**
     * @var string
     */
    protected $name = 'platform_phrase_language';

    /**
     * @var array
     */
    protected $column = [
        'id'   => 1,
        'name' => 1];

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
     * @return \Platform\Phrase\Model\PhraseLanguage
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