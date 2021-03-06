<?php
namespace Kendo\Auth;

/**
 * Interface AuthStorageInterface
 *
 * @package Kendo\Auth
 */
interface AuthStorageInterface
{
    /**
     * @param      $user
     * @param bool $remember
     *
     * @return bool
     */
    public function store($user, $remember = false);

    /**
     * @return string
     */
    public function restore();

    /**
     * @return bool
     */
    public function forget();

    /**
     * @param $poster
     *
     * @return bool
     */
    public function saveViewer($poster);
}