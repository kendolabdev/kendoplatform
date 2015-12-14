<?php
namespace Kendo\Upload;

use Kendo\Kernel\KernelServiceAgreement;

/**
 * Class UploadManager
 *
 * @package Kendo\Upload
 */
class UploadManager extends KernelServiceAgreement
{
    /**
     * @param $fileName
     * @param $options
     *
     * @return mixed
     */
    public function getUploadFileList($fileName, $options)
    {
        if (empty($_FILES[ $fileName ])) {
            return false;
        }

        $arr = $_FILES[ $fileName ];

        $list = new UploadFileList();

        /**
         * single upload file
         */
        if (is_string($_FILES[ $fileName ]['name'])) {
            $list->addFile($arr['name'], $arr['type'], $arr['tmp_name'], $arr['error'], $arr['size'], 'upload', $options);
        } else if (is_array($arr['name'])) {
            foreach ($arr['name'] as $index => $name) {
                $list->addFile($name, $arr['type'][ $index ], $arr['tmp_name'][ $index ], $arr['error'][ $index ], $arr['size'][ $index ], 'upload', $options);
            }
        }

        return $list;
    }

    /**
     * @param $fileName
     * @param $options
     *
     * @return mixed
     */
    public function getUploadFile($fileName, $options)
    {
        if (empty($_FILES[ $fileName ])) {
            return false;
        }

        $arr = $_FILES[ $fileName ];

        /**
         * single upload file
         */
        if (is_string($_FILES[ $fileName ]['name'])) {
            return new UploadFile($arr['name'], $arr['type'], $arr['tmp_name'], $arr['error'], $arr['size'], 'upload', $options);
        } else if (is_array($arr['name'])) {
            foreach ($arr['name'] as $index => $name) {
                return new UploadFile($name, $arr['type'][ $index ], $arr['tmp_name'][ $index ], $arr['error'][ $index ], $arr['size'][ $index ], 'upload', $options);
            }
        }

        return true;
    }
}