<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 6/6/15
 * Time: 2:16 PM
 */
namespace Kendo\Storage;


/**
 * Class Manager
 *
 * @package Kendo\Storage
 */
interface StorageManagerInterface
{
    /**
     * @param $fileName
     * @param $options
     *
     * @return InputFileList
     */
    public function getUploadFileList($fileName, $options);

    /**
     * @param $fileName
     * @param $options
     *
     * @return InputFile
     */
    public function getUploadFile($fileName, $options);


    /**
     * @param string $dir
     * @param string $filename
     * @param string $extension
     *
     * @return string
     */
    public function getPathPattern($dir, $filename, $extension);

    /**
     * @return PathGeneratorInterface
     */
    public function getPathGenerator();

    /**
     * @param  string $id
     *
     * @return StorageInterface
     */
    public function getStorage($id = null);

    /**
     * @return mixed
     */
    public function getDefaultId();

    /**
     * @param mixed $id
     */
    public function setDefaultId($id);

    /**
     * @param  string $adapter
     * @param  array  $params
     *
     * @return StorageInterface
     */
    public function createStorage($adapter, $params);

    /**
     * @param $id
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function getParamsForStorage($id);

    /**
     * @param int    $fileId
     * @param string $maker
     *
     * @return mixed
     */
    public function getFileItem($fileId, $maker);

    /**
     * @param int    $originalId
     * @param string $maker
     *
     * @return string
     */
    public function getUrlByOriginAndMaker($originalId, $maker);

    /**
     * @param array $tempIdList
     *
     * @return InputFileList
     */
    public function getTempInputFileList($tempIdList);

    /**
     * @param $tempId
     *
     * @return mixed
     */
    public function getTempInputFile($tempId);

    /**
     * saved temporaty photo to token by something we need to process
     *
     * @param  InputFile        $item
     * @param  StorageInterface $storage
     *
     * @return mixed
     */
    public function saveToTemporary(InputFile $item, StorageInterface $storage = null);

    /**
     * @param array            $data
     * @param string           $uploadTemporaryDir
     * @param StorageInterface $storage
     *
     * @return array
     */
    public function saveAllProcessedPhoto($data, $uploadTemporaryDir, StorageInterface $storage = null);
}