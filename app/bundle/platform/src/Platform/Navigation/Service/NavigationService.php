<?php

namespace Platform\Navigation\Service;

use Kendo\Kernel\KernelServiceAgreement;

/**
 * Class Platform\NavigationService
 *
 * @package Platform\Navigation\Service
 */
class NavigationService extends KernelServiceAgreement
{
    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminNavigationPaging($query = [], $page = 1, $limit = 10)
    {
        $select = \App::table('navigation')
            ->select()
            ->where('is_admin=?', 0);

        if (!empty($query)) {
            // do filter here
        }

        return $select->paging($page, $limit);
    }
}