<?php

namespace Kendo\Controller;

use Kendo\Http\HttpRequest;

/**
 * Interface Controller
 *
 * @package Kendo\Controller
 */
interface ControllerInterface
{
    /**
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request);

    /**
     * @return bool
     */
    public function execute();

    /**
     * @return string
     */
    public function render();
}