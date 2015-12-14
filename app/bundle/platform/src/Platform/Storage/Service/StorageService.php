<?php

namespace Platform\Storage\Service;


use Kendo\Kernel\KernelServiceAgreement;
use Kendo\Upload\UploadFile;
use Kendo\Upload\UploadFileList;
use Kendo\Storage\LocalStorage;
use Kendo\Storage\PathGeneratorByDate;
use Kendo\Storage\PathGeneratorInterface;
use Kendo\Storage\StorageInterface;
use Kendo\Storage\StorageManagerInterface;
use Platform\Storage\Model\Storage;
use Platform\Storage\Model\StorageFile;
use Platform\Storage\Model\StorageFileTmp;

/**
 * Class Manager
 *
 * @package Kendo\Storage
 */
class StorageService extends KernelServiceAgreement implements StorageManagerInterface
{
    /**
     * @var int
     */
    private $defaultId;

    /**
     * @var array
     */
    private $storages = [];


    /**
     * @var \Kendo\Storage\PathGeneratorInterface
     */
    private $pathGenerator;


    /**
     * @param string $dir
     * @param string $filename
     * @param string $extension
     *
     * @return string
     */
    public function getPathPattern($dir, $filename, $extension)
    {
        return $this->getPathGenerator()->getPattern($dir, $filename, $extension);
    }


    /**
     * @return PathGeneratorInterface
     */
    public function getPathGenerator()
    {
        if (null == $this->pathGenerator) {
            $this->pathGenerator = new PathGeneratorByDate();
        }

        return $this->pathGenerator;
    }

    /**
     * @param PathGeneratorInterface $pathGenerator
     */
    public function setPathGenerator(PathGeneratorInterface $pathGenerator)
    {
        $this->pathGenerator = $pathGenerator;
    }


    /**
     * @param  int $id
     *
     * @return \Kendo\Storage\StorageInterface
     */
    public function getStorage($id = null)
    {
        if (null == $id) {
            $id = $this->getDefaultId();
        }

        if (!isset($this->storages[ $id ])) {
            $params = $this->getParamsForStorage($id);

            $this->storages[ $id ] = $this->createStorage($params['adapter'], $params);
        }

        return $this->storages[ $id ];
    }

    /**
     * @return mixed
     */
    public function getDefaultId()
    {
        if (null == $this->defaultId) {
            $id = \App::setting('core', 'storage', "1");

            $this->defaultId = $id ? (int)$id : 1;
        }

        return $this->defaultId;
    }

    /**
     * @param mixed $id
     */
    public function setDefaultId($id)
    {
        $params = $this->getParamsForStorage($id);

        if (empty($params)) {
            throw new \InvalidArgumentException("Invalid storage id");
        }

        $this->defaultId = $id;
    }

    /**
     * @param  string $adapter
     * @param  array  $params
     *
     * @return \Kendo\Storage\StorageInterface
     */
    public function createStorage($adapter, $params)
    {
        switch ($adapter) {
            case 'local':
            case 'file':
            case 'filesystem':
                return new LocalStorage($params);

            default:
                throw new \InvalidArgumentException("Storage not found");
        }
    }


    /**
     * @param $id
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function getParamsForStorage($id)
    {
        $entry = \App::table('platform_storage')
            ->findById((int)$id);

        if (!$entry) {
            throw new \InvalidArgumentException("Could not find storage storage [{$id}]");
        }

        if (!$entry instanceof Storage) {
            throw new \InvalidArgumentException("Could not find storage storage [{$id}]");
        }

        $params = $entry->getParams();

        if (empty($params['id'])) {
            throw new \InvalidArgumentException("Invalid storage creation params, missing [id]");
        }

        return $params;

    }

    /**
     * @param int    $fileId
     * @param string $maker
     *
     * @return \Platform\Storage\Model\StorageFile
     */
    public function getFileItem($fileId, $maker)
    {
        return \App::table('platform_storage_file')
            ->select()
            ->where('origin_id=?', (int)$fileId)
            ->where('maker=?', (string)$maker)
            ->one();
    }

    /**
     * @param int    $originalId
     * @param string $maker
     *
     * @return string
     */
    public function getUrlByOriginAndMaker($originalId, $maker)
    {
        $data = \App::table('platform_storage_file')
            ->select()
            ->where('origin_id=?', (int)$originalId)
            ->where('maker=?', (string)$maker)
            ->toAssoc();

        if (empty($data)) {
            return '';
        }

        return $this->getStorage($data['storage_id'])->getUrl($data['path']);
    }

    /**
     * @param array $tempIdList
     *
     * @return UploadFileList
     */
    public function getTempInputFileList($tempIdList)
    {
        if (!is_array($tempIdList)) {
            $tempIdList = [$tempIdList];
        }

        if (empty($tempIdList)) {
            $tempIdList = ['-1'];
        }

        $list = new UploadFileList();

        $items = \App::table('platform_storage_file_tmp')
            ->select()
            ->where('id IN ?', $tempIdList)
            ->all();


        foreach ($items as $item) {
            if (!$item instanceof StorageFileTmp) continue;
            $list->addFile($item->getName(), $item->getType(), $item->getUrl(), 0, $item->getSize(), 'temporary');
        }

        return $list;
    }

    /**
     * @param $tempId
     *
     * @return UploadFile
     */
    public function getTempInputFile($tempId)
    {
        $item = \App::table('platform_storage_file_tmp')
            ->findById($tempId);

        if ($item instanceof StorageFileTmp) {
            return new UploadFile($item->getName(), $item->getType(), $item->getUrl(), 0, $item->getSize(), 'temporary');
        }

        throw new \InvalidArgumentException("");
    }

    /**
     * saved temporaty photo to token by something we need to process
     *
     * @param  UploadFile                      $item
     * @param  \Kendo\Storage\StorageInterface $storage
     *
     * @return \Platform\Storage\Model\StorageFileTmp
     */
    public function saveToTemporary(UploadFile $item, StorageInterface $storage = null)
    {
        if (null == $storage) {
            $storage = $this->getStorage();
        }

        $pathPattern = $this->getPathPattern('temp', null, '.jpg');

        $path = strtr($pathPattern, ['$maker' => 'temp_upload']);

        $storage->copyFromLocal($item->getPath(), $path);

        $temp = new StorageFileTmp([
            'name'       => $item->getName(),
            'path'       => $path,
            'size'       => $item->getSize(),
            'type'       => $item->getType(),
            'storage_id' => $storage->getId(),
            'created_at' => KENDO_DATE_TIME,
        ]);

        $temp->save();

        return $temp;
    }


    /**
     * @param array                           $data
     * @param string                          $uploadTemporaryDir
     * @param \Kendo\Storage\StorageInterface $storage
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function saveAllProcessedPhoto($data, $uploadTemporaryDir, StorageInterface $storage = null)
    {
        $response = [];

        if (null == $storage) {
            $storage = $this->getStorage();
        }

        $storageId = $storage->getId();

        if (empty($storageId)) {
            throw new \InvalidArgumentException("Storage Id could not be empty.");
        }

        foreach ($data as $item) {
            $originId = null;

            if (empty($item['origin'])) {
                throw new \InvalidArgumentException("Can not save all process photo without origin");
            }

            if (true) {
                $originItem = $item['origin'];


                // save origin item
                $origin = new StorageFile($originItem);
                $origin->setStorageId($storageId);
                $origin->setCreatedAt(KENDO_DATE_TIME);
                $origin->save();

                $originId = $origin->getId();

                // push origin id to origian

                $origin->setOriginId($originId);
                $origin->save();

                $path = $origin->getPath();

                if (!empty($path)) {
                    $localPath = $uploadTemporaryDir . $path;
                    $storage->copyFromLocal($localPath, $path);
                }
            }

            if (!empty($item['children'])) {
                foreach ($item['children'] as $child) {
                    $file = new StorageFile($child);
                    $file->setStorageId($storageId);
                    $file->setCreatedAt(KENDO_DATE_TIME);
                    $file->setOriginId($originId);
                    $file->save();

                    $path = $file->getPath();

                    if (!empty($path)) {
                        $localPath = $uploadTemporaryDir . $path;
                        $storage->copyFromLocal($localPath, $path);
                    }
                }
            }

            $response[] = $originId;
        }

        return $response;
    }

    /**
     * @param $originId
     * @param $makers
     */
    public function removeByOriginIdAndMakerList($originId, $makers)
    {
        if (empty($makers) || empty($originId))
            return;

        \App::table('platform_storage_file')
            ->delete()
            ->where('origin_id=?', $originId)
            ->where('maker IN ?', $makers)
            ->execute();
    }

    /**
     * @param                                       $originId
     * @param                                       $items
     * @param                                       $uploadTemporaryDir
     * @param \Kendo\Storage\StorageInterface|null  $storage
     *
     * @return array
     */
    public function saveAllProcessedPhotoByOriginId($originId, $items, $uploadTemporaryDir, StorageInterface $storage = null)
    {
        $response = [];

        if (null == $storage) {
            $storage = $this->getStorage();
        }

        $storageId = $storage->getId();

        if (empty($storageId))
            throw new \InvalidArgumentException("Storage Id could not be empty.");

        foreach ($items as $child) {
            $file = new StorageFile($child);
            $file->setStorageId($storageId);
            $file->setCreatedAt(KENDO_DATE_TIME);
            $file->setOriginId($originId);
            $file->save();

            $path = $file->getPath();

            $response[] = $file->getId();

            if (!empty($path) && !empty($uploadTemporaryDir)) {
                $localPath = $uploadTemporaryDir . $path;
                $storage->copyFromLocal($localPath, $path);
            }
        }

        return $response;
    }


    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminPagingStorage($query = [], $page = 1, $limit = 100)
    {
        $select = \App::table('platform_storage')
            ->select();

        if (!empty($query))
            ;

        return $select->paging($page, $limit);
    }

    /**
     * @param int $id
     *
     * @return \Platform\Storage\Model\Storage
     */
    public function findStorageById($id)
    {
        return \App::table('platform_storage')
            ->findById((int)$id);
    }

    /**
     * @param string $id
     *
     * @return \Platform\Storage\Model\StorageAdapter
     */
    public function findAdapterById($id)
    {
        return \App::table('platform_storage_adapter')
            ->findById((string)$id);
    }

    /**
     * @param string $type
     *
     * @return \Platform\Storage\Model\StorageAdapter
     */
    public function findAdapterByType($type)
    {
        return \App::table('platform_storage_adapter')
            ->findById((string)$type);
    }
}
