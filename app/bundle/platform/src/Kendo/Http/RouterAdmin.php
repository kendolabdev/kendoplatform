<?php
namespace Kendo\Http;

/**
 * Class RouterAdmin
 *
 * @package Kendo\Routing
 */
class RouterAdmin extends Router
{
    /**
     * @param \Kendo\Http\RoutingResult $result
     *
     * @return bool
     */
    protected function filter(RoutingResult $result)
    {
        $any = $result->get('any');

        // admin dashboard
        if (empty($any)) {
            $result->setVars([
                'controller' => 'Platform\Core\Controller\Admin\DashboardController',
                'action'     => 'index',
            ]);

            return true;
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

        $join = [$bundle, $module, 'Controller', 'Admin'];

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