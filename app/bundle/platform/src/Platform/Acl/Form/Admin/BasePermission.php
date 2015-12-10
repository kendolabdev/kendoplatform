<?php

namespace Platform\Acl\Form\Admin;

use Kendo\Html\Form;

/**
 * Class BasePermission
 *
 * @package Acl\Form\Admin
 */
class BasePermission extends Form
{

    /**
     * @var \Platform\Acl\Model\AclRole
     */
    protected $role;

    /**
     * @return \Platform\Acl\Model\AclRole
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param \Platform\Acl\Model\AclRole $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }


    /**
     *
     */
    public function load()
    {
        $data = \App::aclService()->getLoader()->loadForEdit($this->getRole()->getId(), $this->getGroups());

        $this->setData($data);
    }


    /**
     * @return array
     */
    public function getGroups()
    {
        $response = [];

        foreach ($this->byNames as $name => $_) {
            if (false == ($pos = strpos($name, '__'))) continue;
            $response[] = substr($name, 0, $pos);
        }

        return $response;
    }

    /**
     *
     */
    public function commit()
    {
        $data = $this->getData();

        \App::aclService()->getLoader()->saveForRole($this->getRole()->getId(), $data);
    }

    /**
     * @return bool
     */
    public function validate()
    {
        return true;
    }
}