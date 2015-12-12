<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_social_service`
 */

namespace Platform\Social\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class SocialServiceTable
 *
 * @package Social\Model
 */
class SocialServiceTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_social_service`
     * @var string
     */
    protected $class = '\Platform\Social\Model\SocialService';

    /**
     * @var string
     */
    protected $name = 'platform_social_service';

    /**
     * @var array
     */
    protected $column = [
        'id'             => 1,
        'name'           => 1,
        'is_active'      => 1,
        'sort_order'     => 1,
        'setting_form'   => 1,
        'ion_icon_class' => 1];

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
     * @return \Platform\Social\Model\SocialService
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