<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CatalogTable
 *
 * @package Platform\Catalog\Model
 */
class CatalogTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_catalog`
     * @var string
     */
    protected $class = '\Platform\Catalog\Model\Catalog';

    /**
     * @var string
     */
    protected $name = 'platform_catalog';

    /**
     * @var array
     */
    protected $column = [
        'catalog_id'   => 1,
        'catalog_code' => 1,
        'catalog_name' => 1,
        'content_id'   => 1];

    /**
     * @var array
     */
    protected $primary = ['catalog_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'catalog_id';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Catalog\Model\Catalog
     */
    public function findById($value)
    {
        return $this->select()
            ->where('catalog_id=?', $value)
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
            ->where('catalog_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}