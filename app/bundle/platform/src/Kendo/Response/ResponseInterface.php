<?php
namespace Kendo\Response;
use Kendo\Request\RequestInterface;

/**
 * Interface ReponseInterface
 *
 * @package Kendo\Response
 */
interface ResponseInterface
{
    /**
     * ResponseInterface constructor.
     *
     * @param \Kendo\Request\RequestInterface $request
     */
    public function __construct(RequestInterface $request);
}