<?php
namespace Kendo\Routing;

/**
 * Class RouterAjax
 *
 * @package Kendo\Routing
 */
class RouterAjax extends Router
{
    /**
     * @param \Kendo\Routing\RoutingResult $result
     *
     * @return bool
     */
    protected function filter(RoutingResult $result)
    {
        $any = $result->get('any');

        // admin dashboard
        if (empty($any)) {
           return false;
        }

        $parts = explode('/', $any);

        if (count($parts) < 2) {
            return false;
        }

        $bundle = array_shift($parts);
        $module = array_shift($parts);
        $lastControl = null;
        $actionName = null;

        // the last path is action
        if (!empty($parts)) {
            $actionName = array_pop($parts);
        } else {
            $actionName = $module;
        }

        if (!empty($parts)) {
            $lastControl = array_pop($parts);
        }

        if (empty($lastControl)) {
            $lastControl = $module;
        }

        if (empty($actionName)) {
            $actionName = $lastControl;
        }

        $join = [$bundle, $module, 'Controller', 'Ajax'];

        if (!empty($parts)) {
            foreach ($parts as $part) {
                $join[] = $part;
            }
        }

        $join[] = $lastControl . '-controller';

        $controllerName = implode('\\', array_map("_inflect", $join));

        if (class_exists($controllerName)) {
            $result->addVars([
                'controller' => $controllerName,
                'action'     => $actionName
            ]);

            return true;
        }

        return false;
    }
}