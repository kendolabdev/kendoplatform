<?php

namespace Kendo\Profiler;

use Kendo\Kernel\KernelServiceAgreement;

/**
 * Class ProfilerrContainer
 *
 * @package Kendo\Profiller
 */
class ProfilerContainer extends KernelServiceAgreement
{
    /**
     * Contain data
     * <code>
     * [
     * group: string,
     * name: string,
     * data: string,
     *
     * ]
     * </code>
     *
     * @var array
     */
    private $items = [];

    /**
     * @var array
     */
    private $groups = [];

    /**
     * Start a profilling item, You get a "key" string
     *
     * @param string $group
     * @param string $name
     * @param string $extra
     *
     * @return string key
     */
    public function start($group, $name, $extra = null)
    {
        $key = uniqid();

        $this->items[ $key ] = [
            'group'              => $group,
            'name'               => $name,
            'time_start'         => microtime(1),
            'time_end'           => 0,
            'memory_usage_start' => memory_get_usage(false),
            'memory_usage_end'   => 0,
            'extra'              => $extra,
            'time_usage'         => 0,
            'memory_usage'       => 0,
        ];

        if (empty($this->groups[ $group ])) {
            $this->groups[ $group ] = [
                'group'                => $group,
                'run_total'            => 1,
                'time_usage_total'     => 0,
                'time_usage_max'       => 0,
                'memory_usage_total'   => 0,
                'memory_usage_max'     => 0,
                'memory_usage_average' => 0,
            ];
        } else {
            $this->groups[ $group ]['run_total'] += 1;
        }

        return $key;
    }

    /**
     * Stop profilling usage last key
     *
     *
     * @param $key
     *
     * @return bool
     */
    public function stop($key)
    {

        if (empty($this->items[ $key ])) {
            return false;
        }

        $this->items[ $key ] = array_merge($this->items[ $key ], [
            'time_end'             => microtime(true),
            'memory_usage_end'     => memory_get_usage(false),
            'memory_allocated_end' => memory_get_usage(true),
        ]);
    }

    /**
     * Write files
     */
    public function stats()
    {

        foreach ($this->items as $index => $item) {

            $group = $item['group'];

            if ($this->items[ $index ]['time_end']) {
                $this->items[ $index ]['time_usage'] = $item['time_end'] - $item['time_start'];
            }
            if ($item['memory_usage_end']) {
                $this->items[ $index ]['memory_usage'] = $item['memory_usage_end'] - $item['memory_usage_start'];
            }

            $this->groups[ $group ]['time_usage_total'] += $this->items[ $index ]['time_usage'];
            $this->groups[ $group ]['memory_usage_total'] += $this->items[ $index ]['memory_usage'];

            if ($this->groups[ $group ]['time_usage_max'] < $this->items[ $index ]['time_usage']) {
                $this->groups[ $group ]['time_usage_max'] = $this->items[ $index ]['time_usage'];
                $this->groups[ $group ]['item_name'] = $this->items[ $index ]['name'];
                $this->groups[ $group ]['item_extra'] = $this->items[ $index ]['extra'];
            }

            if ($this->groups[ $group ]['memory_usage_max'] < $this->items[ $index ]['memory_usage']) {
                $this->groups[ $group ]['memory_usage_max'] = $this->items[ $index ]['memory_usage'];
            }

        }

        $content = json_encode([
            'groups' => $this->groups,
            'items'  => $this->items
        ], JSON_PRETTY_PRINT);

        $filename = KENDO_TEMP_DIR . '/profiler/' . date('Y-m-d-H-i') . '.json';
        @file_put_contents($filename, $content);
        @chmod($filename, 0777);
    }

}