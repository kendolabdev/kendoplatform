<?php
namespace Kendo\Resources;

use Kendo\Kernel\KernelServiceAgreement;
use Kendo\Kernel\UniqueIdGeneratorInterface;

/**
 * Class KernelResourceProvider
 *
 * @package Kendo\Kernel
 */
class ResourcesContainer extends KernelServiceAgreement
{
    /**
     * @var int
     */
    const MIN_NEXT_ID = 1000;

    /**
     * @IdGener
     */
    protected $idGenerator;

    /**
     * @var array [string: string]
     */
    protected $requires = [
        'platform_core_extension' => '\Platform\Core\Model\CoreExtensionTable',
        'platform_core_hook'      => '\Platform\Core\Model\CoreHookTable',
        'platform_core_type'      => '\Platform\Core\Model\CoreTypeTable',
    ];

    /**
     * @var array
     */
    protected $byNames = [];

    /**
     * @var array
     */
    protected $byInstances = [];

    /**
     * @codeCoverageIgnore
     */
    public function bound()
    {
        $this->byNames = $this->loadNamesFromRepository();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array
     */
    protected function loadNamesFromRepository()
    {
        $activePackages = $this->make('platform_core_extension')
            ->select()
            ->where('extension_type=?', 'module')
            ->where('is_active=?', 1)
            ->fields('name');

        return $this->make('platform_core_type')
            ->select()
            ->where('module_name in ?', $activePackages)
            ->toPairs('type_id', 'table_name');
    }

    /**
     * Caculate model class & Table class of specific entity type.
     *
     * @param $name
     *
     * @return string
     */
    public function normalizeClassName($name)
    {

        if (isset($this->requires[ $name ])) {
            return $this->requires[ $name ];
        }

        if (isset($this->byNames[ $name ])) {
            return $this->byNames[ $name ];
        }

        return '\\' . str_replace(' ', '', ucwords(str_replace(['.', '_'], ['\Model\ ', ' '], $name))) . 'Table';
    }

    /**
     * @param string $name
     *
     * @return \Kendo\Db\DbTable
     */
    protected function create($name)
    {
        $class = $this->normalizeClassName($name);

        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Unexpcected resource "%s": "%s"', $name, $class));
        }

        return $this->byInstances[ $name ] = new $class();
    }

    /**
     * @param string $name
     *
     * @return \Kendo\Db\DbTable
     */
    public function make($name)
    {
        return isset($this->byInstances[ $name ]) ? $this->byInstances[ $name ] : $this->create($name);
    }
}