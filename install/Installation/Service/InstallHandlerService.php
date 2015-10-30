<?php
namespace Installation\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Installation\Service
 */
class InstallHandlerService extends InstallHandler
{

    /**
     * @return string
     */
    public function getPackageFilePath()
    {
        return dirname(dirname(__FILE__)) . '/Install/package.json';
    }

    /**
     * @return array
     */
    public function getListTableSuffix()
    {
        return [
            'core',
            'feed',
            'like',
            'comment',
            'share',
            'attribute',
            'acl',
            'layout',
            'follow',
            'notification',
            'invitation',
            'navigation',
            'link',
            'mail',
            'message',
            'payment',
            'user',
            'storage',
            'setting',
            'review',
            'relation',
            'phrase',
            'photo',
            'video',
            'help',
            'blog',
            'captcha',
            'social',
            'captcha',
            'tag',
        ];
    }

    /**
     * @return array
     */
    public function getModuleList()
    {
        return [
            'core',
            'feed',
            'like',
            'comment',
            'share',
            'report',
            'attribute',
            'user',
            'follow',
            'layout',
            'acl',
            'message',
            'review',
            'photo',
            'video',
            'help',
            'blog',
            'captcha',
            'phrase',
            'relation',
            'storage',
            'link',
            'notification',
            'invitation',
            'navigation',
            'setting',
            'mail',
            'payment',
            'social',
            'tag',
        ];
    }

    public function _afterExport()
    {
        /**
         *
         */
        foreach (\App::extensions()->getActiveModuleNames() as $module) {
            $handler = \App::service("$module.install_handler");
            if ($handler instanceof InstallHandler)
                $handler->export();
        }
    }

    public function _afterImport()
    {
        /**
         *
         */
        foreach ($this->finalData['core_extension'] as $data) {
            $module = $data['name'];

            $handler = \App::service("$module.install_handler");
            if ($handler instanceof InstallHandler)
                $handler->import();
        }

    }
}