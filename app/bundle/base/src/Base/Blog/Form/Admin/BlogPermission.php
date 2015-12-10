<?php
namespace Base\Blog\Form\Admin;

use Platform\Acl\Form\Admin\BasePermission;

/**
 * Class Base\BlogPermission
 *
 * @package Base\Blog\Form\Admin
 */
class BlogPermission extends BasePermission
{
    protected function init()
    {
        $this->setTitle('blog_form_permission.form_title');
        $this->setNote('blog_form_permission.form_note');

        $role = $this->getRole();

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'blog__blog_tab_exists',
                'label'  => 'blog_form_permission.blog_tab_exists',
                'note'   => 'blog_form_permission.blog_tab_exists_note',
                'value'  => 1,
            ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'blog__blog_tab_view',
            'label'  => 'blog_form_permission.blog_tab_view',
            'note'   => 'blog_form_permission.blog_tab_view_note',
            'value'  => 1,
        ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'blog__create',
                'label'  => 'blog_form_permission.blog_create',
                'note'   => 'blog_form_permission.blog_create_note',
                'value'  => 1,
            ]);


        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'blog__view',
            'label'  => 'blog_form_permission.blog_view',
            'note'   => 'blog_form_permission.blog_view_note',
            'value'  => 1,
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'blog__edit',
                'label'  => 'blog_form_permission.blog_edit',
                'note'   => 'blog_form_permission.blog_edit_note',
                'value'  => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'blog__delete',
                'label'  => 'blog_form_permission.blog_delete',
                'note'   => 'blog_form_permission.blog_delete_note',
                'value'  => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'blog__limit',
                'label'  => 'blog_form_permission.blog_limit',
                'note'   => 'blog_form_permission.blog_limit_note',
                'value'  => 100,
            ]);
    }
}