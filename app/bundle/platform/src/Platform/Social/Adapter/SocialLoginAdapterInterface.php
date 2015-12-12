<?php
namespace Platform\Social\Adapter;

/**
 * Interface SocialLoginAdapterInterface
 *
 * @package Social\Adapter
 */
interface SocialLoginAdapterInterface
{
    /**
     * @param $params
     *
     * @return string
     */
    public function getLoginUrl($params = []);

    /**
     * @return mixed
     */
    public function getTokenFromRedirect();

    /**
     * @return mixed
     */
    public function getAccountInfo();
}