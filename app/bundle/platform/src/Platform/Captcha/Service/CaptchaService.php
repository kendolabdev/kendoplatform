<?php
namespace Platform\Captcha\Service;

/**
 * Class CaptchaService
 *
 * @package Captcha\Service
 */
class CaptchaService
{

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminAdapterPaging($query = [], $page = 1, $limit = 100)
    {
        $select = \App::table('platform_captcha_adapter')
            ->select();

        if (!empty($query)) ;

        return $select->paging($page, $limit);

    }

}