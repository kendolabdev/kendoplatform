<?php

namespace Photo\Service;

use Photo\Model\Photo;
use Photo\Model\PhotoAlbum;
use Photo\Model\PhotoCategory;
use Photo\Model\PhotoCollection;
use Photo\Model\PhotoCover;
use Kendo\Content\AtomInterface;
use Kendo\Content\PosterInterface;
use Kendo\Request\HttpRequest;
use Kendo\Storage\InputFile;
use Kendo\Storage\InputFileList;

/**
 * Class PhotoService
 *
 * @package Photo\Service
 */
class PhotoService
{

    /**
     * User upload albums for customize album creation
     */
    const ALBUM_TYPE_UPLOAD = 'upload';

    /**
     * Timeline album
     */
    const ALBUM_TYPE_TIMELINE = 'timeline';

    /**
     * Comment album
     */
    const ALBUM_TYPE_COMMENT = 'comment';


    /**
     * @param string $id
     *
     * @return \Photo\Model\PhotoCategory
     */
    public function findCategoryById($id)
    {
        return \App::table('photo.photo_category')
            ->findById(intval($id));
    }

    /**
     * @param array $data
     *
     * @return \Photo\Model\PhotoCategory
     */
    public function addCategory($data = [])
    {

        if (empty($data['category_name']))
            throw new \InvalidArgumentException("Missing params [category_name]");

        $entry = new PhotoCategory($data);

        $entry->save();

        return $entry;

    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminCategoryPaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('photo.photo_category')->select('t');

        if (!empty($query['q']))
            $select->where('category_name like ?', '%' . $query['q'] . '%');

        return $select->paging($page, $limit);
    }


    /**
     * Find album by album id
     *
     * @param $albumId
     *
     * @return \Photo\Model\PhotoAlbum
     */
    public function findAlbumById($albumId)
    {
        return \App::table('photo.photo_album')
            ->findById($albumId);
    }

    /**
     * Load photo paging
     *
     * @param array $context
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadPhotoPaging($context = [], $page = 1, $limit = 12)
    {

        $select = \App::table('photo')->select('t');

        $isOwner = false;
        $inProfile = false;

        if (!empty($context['posterId'])) {

            $posterId = $context['posterId'];

            $select->where('t.poster_id=?', $posterId);

            if ($posterId == \App::authService()->getId()) {

                $isOwner = true;
            }
        }

        if (!empty($context['userId'])) {

            $userId = $context['userId'];

            $select->where('t.user_id=?', $userId);

            if ($userId == \App::authService()->getUserId()) {
                $isOwner = true;
            }
        }

        if (!empty($context['parentId'])) {

            $parentId = $context['parentId'];

            $select->where('t.parent_id=?', $parentId);

            $inProfile = true;
        }

        if (!empty($context['albumId'])) {

            $albumId = $context['albumId'];

            $select->where('t.album_id=?', $albumId);

            $album = \App::find('photo.photo_album', $albumId);

            if ($album instanceof PhotoAlbum) {
                if ($album->viewerIsPosterOrParent()) {
                    $isOwner = true;
                }
            }
        }

        if (!empty($context['collectionId'])) {

            $collectionId = $context['collectionId'];

            $select->where('t.collection_id=?', $collectionId);
        }


        if (!$inProfile) {
            $browsingMode = \App::setting('photo', 'browsing_mode');
            switch ($browsingMode) {
                case 0:
                    break;
                case 1:
                    $select->where(\App::followService()->getFollowingConditionForQuery(\App::authService()->getId(), 't'), null);
                    break;
            }
        }

        if (!$isOwner) {
            switch (\App::setting('photo', 'browsing_filter')) {
                case 0:
                    $select->where(\App::relationService()->getPrivacyConditionForQuery(\App::authService()->getId(), 't'), null);
                    break;
                case 1:
                    if (\App::authService()->logged())
                        $select->where('t.privacy_type IN ?', [1, 2]);
                    else
                        $select->where('t.privacy_type = ?', 1);
                    break;
                case 2:
                    break;
            }
        }

        $select->order('created_at', -1);

        return $select->paging($page, $limit);
    }


    /**
     * Load album paging
     *
     * @param array $context
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAlbumPaging($context = [], $page = 1, $limit = 12)
    {
        $select = \App::table('photo.photo_album')->select('t');


        $isOwner = false;
        $inProfile = false;

        if (!empty($context['posterId'])) {

            $posterId = $context['posterId'];

            $select->where('t.poster_id=?', $posterId);

            if ($posterId == \App::authService()->getId()) {

                $isOwner = true;
            }
        }

        if (!empty($context['userId'])) {

            $userId = $context['userId'];

            $select->where('t.user_id=?', $userId);

            if ($userId == \App::authService()->getUserId()) {
                $isOwner = true;
            }
        }

        if (!empty($context['parentId'])) {

            $parentId = $context['parentId'];

            $select->where('t.parent_id=?', $parentId);

            $inProfile = true;
        }


        if (!$inProfile) {
            $browsingMode = \App::setting('photo', 'browsing_mode');
            switch ($browsingMode) {
                case 0:
                    break;
                case 1:
                    $select->where(\App::followService()->getFollowingConditionForQuery(\App::authService()->getId(), 't'), null);
                    break;
            }
        }

        if (!$isOwner) {
            switch (\App::setting('photo', 'browsing_filter')) {
                case 0:
                    $select->where(\App::relationService()->getPrivacyConditionForQuery(\App::authService()->getId(), 't'), null);
                    break;
                case 1:
                    if (\App::authService()->logged())
                        $select->where('t.privacy_type IN ?', [1, 2]);
                    else
                        $select->where('t.privacy_type = ?', 1);
                    break;
                case 2:
                    break;
            }
        }

        $select->order('created_at', -1);

        return $select->paging($page, $limit);
    }

    /**
     * Add photo from activity composer
     *
     * @see FeedController::actionPost()
     *
     * @param HttpRequest     $request
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return \Feed\Model\Feed
     */
    public function addFromActivityComposer(HttpRequest $request, PosterInterface $poster, PosterInterface $parent)
    {
        // process upload photo to handler set.

        $photoTemp = $request->getArray('photoTemp');

        $fileIdList = $this->processPhotoUploadFromTemporary($photoTemp, null);

        $object = null;
        $feed = null;

        $album = $this->getSingletonAlbum($parent);

        if (!$album instanceof PhotoAlbum)
            throw new \InvalidArgumentException();

        list($totalPhoto, $photoList, $album, $collection) = $this->addPhotos($fileIdList, $poster, $parent, $album, [], false);

        if ($totalPhoto == 1) {
            $object = $photoList[0];
        }

        if ($totalPhoto > 1) {
            $object = $collection;
        }

        // process to add feed

        $activityService = \App::feedService();

        if ($object instanceof PhotoCollection) {
            $feed = $activityService->addItemFeed('update_status', $object);
        } else if ($object instanceof Photo) {
            $feed = $activityService->addItemFeed('update_status', $object);
        }


        $statusTxt = $request->getString('statusTxt');

        $place = $request->getArray('place');

        if (!empty($place)) {
            foreach ($photoList as $photo) {
                if (!$photo instanceof Photo) ;
                $photo->setPlace($place);
                $photo->save();
            }
        }

        $shouldUpdate = false;

        if ($statusTxt) {
            $object->setStory($statusTxt);
            $shouldUpdate = true;
        }

        if (!empty($place)) {
            $object->setPlace($place);
            $shouldUpdate = true;
        }

        $people = $request->getArray('people');

        if (!empty($people)) {
            $peopleCount = \App::tagService()->tagPeople($object, $people);
            $object->setPeopleCount($peopleCount);
            $shouldUpdate = true;
        }

        if ($shouldUpdate) {
            $object->save();
        }

        return $feed;
    }

    /**
     * Get all site total photo count
     *
     * @return int
     */
    public function getPhotoCount()
    {
        return \App::table('photo')
            ->select()
            ->count();
    }

    /**
     * Get all site total album count
     *
     * @return int
     */
    public function getAlbumCount()
    {
        return \App::table('photo.photo_album')
            ->select()
            ->count();
    }

    /**
     * Get dafault settings using to create thumbnail
     *
     * @return array
     */
    public function getDefaultAvatarThumbsSettings()
    {
        $thumbs = [
            'avatar_xl' => [
                'width'    => 220,
                'height'   => 220,
                'position' => 'center',
                'crop'     => true
            ],
            'avatar_lg' => [
                'width'    => 100,
                'height'   => 100,
                'position' => 'center',
                'crop'     => true
            ],
            'avatar_md' => [
                'width'    => 50,
                'height'   => 50,
                'position' => 'center',
                'crop'     => true
            ],
            'avatar_sm' => [
                'width'    => 32,
                'height'   => 32,
                'position' => 'center',
                'crop'     => true
            ],
            'avatar_xs' => [
                'width'    => 24,
                'height'   => 24,
                'position' => 'center',
                'crop'     => true
            ],
        ];

        return $thumbs;
    }

    /**
     * Get select photo in context, This method is used to spotlight view & view detail & next & prev
     *
     * @param Photo $photo
     * @param null  $context
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getSelectPhotoContext(Photo $photo, $context = null)
    {
        $select = \App::table('photo')
            ->select();

        switch ($context) {
            case 'user':
                $select->where('user_id=?', $photo->getPosterId());
                break;
            case 'poster':
                $select->where('poster_id=?', $photo->getPosterId());
                break;
            case 'owner':
            case 'profile':
            case 'parent':
                $select->where('parent_id=?', $photo->getParentId());
                break;
            case 'collection':
            case 'post':
                if ($photo->getCollectionId() > 0) {
                    $select->where('collection_id=?', $photo->getCollectionId());
                } else {
                    $select->where('collection_id=?', -1);
                }
                break;
            case 'album':
                $select->where('album_id=?', $photo->getAlbumId());
                break;
            default:
                $select->where('album_id=?', $photo->getAlbumId());

        }

        $select->order('created_at', 1);

        return $select;
    }

    /**
     * Get next phot in context
     *
     * @param Photo  $photo
     * @param string $context
     *
     * @return \Photo\Model\Photo
     */
    public function nextPhoto(Photo $photo, $context = null)
    {
        return $this->getSelectPhotoContext($photo, $context)
            ->where('photo_id>?', $photo->getId())
            ->order('photo_id', 1)
            ->one();
    }

    /**
     * Get previous photo in context
     *
     * @param Photo  $photo
     * @param string $context
     *
     * @return \Photo\Model\Photo
     */
    public function prevPhoto(Photo $photo, $context = null)
    {
        return $this->getSelectPhotoContext($photo, $context)
            ->where('photo_id<?', $photo->getId())
            ->order('photo_id', -1)
            ->one();
    }

    /**
     * Get default photo settings to generate thumbnails
     *
     * @return array
     */
    public function getDefaultPhotoThumbsSettings()
    {
        $thumbs = [
            '860' => [
                'width'    => 860,
                'height'   => 860,
                'position' => 'center',
                'crop'     => false
            ],
            '440' => [
                'width'    => 440,
                'height'   => 440,
                'position' => 'center',
                'crop'     => false
            ],
            '220' => [
                'width'    => 220,
                'height'   => 220,
                'position' => 'center',
                'crop'     => false
            ],
        ];

        return $thumbs;
    }

    /**
     * Process photo upload photo, Result is a collection of file id.
     * We used file id list result to create photo in specific albums
     *
     *
     * @param array $tempIdList
     * @param array $thumbs
     *
     * @return array fileIdList (original file id list)
     */
    public function processPhotoUploadFromTemporary($tempIdList = [], $thumbs = null)
    {
        /**
         * load file info from temp
         */

        $storage = \App::storageService();


        $info = $storage->getTempInputFileList($tempIdList);

        return $this->processUploadPhotos($info, $thumbs);
    }

    /**
     * Process photo upload photo, Result is a collection of file id.
     * We used file id list result to create photo in specific albums
     *
     *
     * @param array $tempId
     * @param array $thumbs
     *
     * @return array fileIdList (original file id list)
     */
    public function processSinglePhotoUploadFromTemporary($tempId, $thumbs = null)
    {
        /**
         * load file info from temp
         */

        $storage = \App::storageService();

        $info = $storage->getTempInputFileList([$tempId]);

        $result = $this->processUploadPhotos($info, $thumbs);

        if (empty($result))
            return false;

        return $result[0];
    }

    /**
     * Process upload photo from clients. It collect upload data
     *
     * @param string $fileName Upload File input name
     * @param array  $thumbs   Thumbnail generator options
     *
     * @return array fileIdList (original file id list)
     */
    public function processPhotoUploadFromClient($fileName, $thumbs)
    {
        $options = [
            'accept'  => 'photo',
            'minSize' => 10240, // 10 Kb
            'maxSize' => 10485760, // 10 Mb
        ];

        $fileList = \App::storageService()->getUploadFileList($fileName, $options);


        return $this->processUploadPhotos($fileList, $thumbs);
    }

    /**
     * Process cover photo upload
     *
     * @param         InputFile $inputFile
     * @param         array     $thumbs
     *
     * @return int
     * @throws \InvalidArgumentException
     */
    public function processCover(InputFile $inputFile, $thumbs)
    {
        if (null == $thumbs) {
            $thumbs = $this->getDefaultPhotoThumbsSettings();
        }

        // make sure sort caculated.
        krsort($thumbs);

        $fileData = [];
        $uploadTemporaryDir = Kendo_UPLOAD_DIR . '/';
        $imageService = \App::imageService();

        $path = $inputFile->getPath();

        $alloc = [];

        $pathTemp = \App::storageService()->getPathPattern('photo', null, '.jpg');

        $dir = dirname($uploadTemporaryDir . $pathTemp);

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, 1)) {
                throw new \InvalidArgumentException("Could not write to directory [$dir]");
            }
        }


        // load original image
        $img = $imageService->load($path);

        // yes, keep origin of avatar file to save after all ...
        if (true) {
            $temp = strtr($pathTemp, ['$maker' => 'origin']);

            $img->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($uploadTemporaryDir . $temp, 100);

            list($w, $h) = getimagesize($uploadTemporaryDir . $temp, $imageInfo);

            $alloc['origin'] = [
                'maker'      => 'origin',
                'path'       => $temp,
                'width'      => (int)$w,
                'height'     => (int)$h,
                'main_type'  => 'photo',
                'created_at' => Kendo_DATE_TIME,
            ];
        }

        foreach ($thumbs as $maker => $thumb) {

            $temp = strtr($pathTemp, ['$maker' => $maker]);

            if ($thumb['crop']) {
                $img->fit($thumb['width'], $thumb['height'])->save($uploadTemporaryDir . $temp);
            } else {
                $img->resize($thumb['width'], $thumb['height'])->save($uploadTemporaryDir . $temp);
            }

            list($w, $h) = getimagesize($uploadTemporaryDir . $temp, $imageInfo);


            $alloc['children'][ $maker ] = [
                'maker'      => $maker,
                'path'       => $temp,
                'width'      => (int)$w,
                'height'     => (int)$h,
                'main_type'  => 'photo',
                'created_at' => Kendo_DATE_TIME,
            ];

        }

        $fileData[] = $alloc;

        $response = null;

        if (!empty($fileData)) {

            $storage = \App::storageService();

            $response = $storage->saveAllProcessedPhoto($fileData, $uploadTemporaryDir);

            foreach ($fileData as $item) {
                if (!empty($item['origin'])) {
                    if (!empty($item['origin']['path'])) {
                        @unlink($uploadTemporaryDir . $item['origin']['path']);
                    }
                }
                if (!empty($item['children'])) {
                    foreach ($item['children'] as $child) {
                        if (!empty($child['path'])) {
                            @unlink($uploadTemporaryDir . $child['path']);
                        }
                    }
                }
            }
        }

        return $response[0];
    }

    /**
     * Process upload avatar from input file. not from client.
     *
     * @param  PosterInterface $parent
     * @param         int      $photoFileId
     * @param         array    $options
     *
     * @return int
     * @throws \InvalidArgumentException
     */
    public function processAvatar($parent, $photoFileId, $options)
    {
        $thumbs = $this->getDefaultAvatarThumbsSettings();

        $uploadTemporaryDir = Kendo_UPLOAD_DIR . '/';
        $imageService = \App::imageService();

        $file = \App::storageService()->getFileItem($photoFileId, 'origin');

        $path = $file->getUrl();

        $alloc = [];

        $pathTemp = \App::storageService()->getPathPattern('photo', null, '.jpg');

        $dir = dirname($uploadTemporaryDir . $pathTemp);

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, 1)) {
                throw new \InvalidArgumentException("Could not write to directory [$dir]");
            }
        }

        // load original image
        $img = $imageService->make($path);

        // yes, keep origin of avatar file to save after all ...
        if (true) {

            $img->resize($options['w1'], null, function ($constraint) {
                $constraint->aspectRatio();
            })->crop($options['w2'], $options['h2'], $options['x'], $options['y']);
        }

        foreach ($thumbs as $maker => $thumb) {

            $temp = strtr($pathTemp, ['$maker' => $maker]);

            $img->resize($thumb['width'], $thumb['height'])->save($uploadTemporaryDir . $temp);

            list($w, $h) = getimagesize($uploadTemporaryDir . $temp, $imageInfo);

            $alloc[ $maker ] = [
                'maker'      => $maker,
                'path'       => $temp,
                'width'      => (int)$w,
                'height'     => (int)$h,
                'main_type'  => 'photo',
                'created_at' => Kendo_DATE_TIME,
            ];

        }

        /**
         * require clear old avatar
         */

        $makers = array_keys($alloc);

        \App::storageService()->removeByOriginIdAndMakerList($photoFileId, $makers);


        if (empty($alloc))
            throw new \InvalidArgumentException("Could not process avatar");

        return \App::storageService()->saveAllProcessedPhotoByOriginId($photoFileId, $alloc, $uploadTemporaryDir);

    }

    /**
     * @param PosterInterface $poster
     * @param                 $cropit
     */
    public function setPosterAvatar($poster, $cropit)
    {
        list($w1, $h1, $w2, $h2, $x, $y) = explode(',', $cropit['options']);

        $options = [
            'w1' => $w1,
            'h1' => $h1,
            'w2' => $w2,
            'h2' => $h2,
            'x'  => $x,
            'y'  => $y,
        ];

        $photo = null;
        $parent = $poster;
        $album = \App::photoService()->getSingletonAlbum($parent);

        if (!empty($cropit['photoId'])) {
            $photo = \App::find('photo', $cropit['photoId']);
        } else if (!empty($cropit['tempId'])) {

            $photoTemp = $cropit['tempId'];

            $fileId = \App::photoService()->processSinglePhotoUploadFromTemporary($photoTemp);

            $addParams = array_merge([], ['type' => 1, 'value' => 1]);

            $photo = \App::photoService()->addPhoto($fileId, $poster, $parent, $album, $addParams);
        }

        if (!$photo instanceof Photo)
            throw new \InvalidArgumentException(\App::text('photo.can_not_update_avatar'));

        $response = \App::photoService()->processAvatar($parent, $photo->getPhotoFileId(), $options);

        if (empty($response))
            throw new \InvalidArgumentException(\App::text('photo.can_not_update_avatar'));

        $poster->setPhotoFileId($photo->getPhotoFileId());
        $poster->save();
    }

    /**
     * Process Upload photo from file input list => file item list
     *
     * @param         InputFileList $fileList
     * @param         array         $thumbs
     *
     * @return array|null
     * @throws \InvalidArgumentException
     */
    public function processUploadPhotos(InputFileList $fileList, $thumbs)
    {
        if (null == $thumbs) {
            $thumbs = $this->getDefaultPhotoThumbsSettings();
        }

        krsort($thumbs);

        $fileData = [];
        $uploadTemporaryDir = Kendo_UPLOAD_DIR . '/';
        $imageService = \App::imageService();

        foreach ($fileList->getFiles() as $file) {

            $path = $file->getPath();

            $alloc = [];

            $pathTemp = \App::storageService()->getPathPattern('photo', null, '.jpg');

            $dir = dirname($uploadTemporaryDir . $pathTemp);

            if (!is_dir($dir)) {
                if (!mkdir($dir, 0777, 1)) {
                    throw new \InvalidArgumentException("Could not write to directory [$dir]");
                }
            }


            // load original image
            $img = $imageService->load($path);

            // keep origin
            if (true) {

                $temp = strtr($pathTemp, ['$maker' => 'origin']);

                $img->resize(1280, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($uploadTemporaryDir . $temp);

                list($w, $h) = getimagesize($uploadTemporaryDir . $temp, $imageInfo);

                $alloc['origin'] = [
                    'maker'      => 'origin',
                    'path'       => $temp,
                    'width'      => (int)$w,
                    'height'     => (int)$h,
                    'main_type'  => 'photo',
                    'created_at' => Kendo_DATE_TIME,
                ];
            }

            foreach ($thumbs as $maker => $thumb) {

                $temp = strtr($pathTemp, ['$maker' => $maker]);

                if ($thumb['crop']) {
                    $img->fit($thumb['width'], $thumb['height'], function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($uploadTemporaryDir . $temp);
                } else {
                    $img->resize($thumb['width'], $thumb['height'], function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($uploadTemporaryDir . $temp);
                }

                list($w, $h) = getimagesize($uploadTemporaryDir . $temp, $imageInfo);


                $alloc['children'][ $maker ] = [
                    'maker'      => $maker,
                    'path'       => $temp,
                    'width'      => (int)$w,
                    'height'     => (int)$h,
                    'main_type'  => 'photo',
                    'created_at' => Kendo_DATE_TIME,
                ];

            }
            $fileData[] = $alloc;
        }

        $response = null;

        if (!empty($fileData)) {

            $storage = \App::storageService();

            $response = $storage->saveAllProcessedPhoto($fileData, $uploadTemporaryDir);

            foreach ($fileData as $item) {
                if (!empty($item['origin'])) {
                    if (!empty($item['origin']['path'])) {
                        @unlink($uploadTemporaryDir . $item['origin']['path']);
                    }
                }
                if (!empty($item['children'])) {
                    foreach ($item['children'] as $child) {
                        if (!empty($child['path'])) {
                            @unlink($uploadTemporaryDir . $child['path']);
                        }
                    }
                }

            }
        }

        return $response;
    }

    /**
     * Get Singleton album.
     * Each profile have some singleton album, etc: "wall", "mobile", "comments"
     *
     * @param  PosterInterface $parent
     *
     * @return PhotoAlbum
     */
    public function getSingletonAlbum(PosterInterface $parent)
    {
        $album = \App::table('photo.photo_album')
            ->select()
            ->where('parent_id=?', $parent->getId())
            ->where('parent_type=?', $parent->getType())
            ->one();

        if (empty($album)) {
            $album = new PhotoAlbum([
                'user_id'        => $parent->getUserId(),
                'poster_id'      => $parent->getPosterId(),
                'poster_type'    => $parent->getPosterType(),
                'parent_id'      => $parent->getId(),
                'parent_type'    => $parent->getType(),
                'parent_user_id' => $parent->getUserId(),
                'title'          => '',
                'content'        => '',
                'description'    => '',
                'created_at'     => Kendo_DATE_TIME,
                'modified_at'    => Kendo_DATE_TIME,
            ]);

            $album->save();
        }

        return $album;
    }

    /**
     * Create new album
     *
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param array           $params
     *
     * @return PhotoAlbum
     */
    public function addAlbum(PosterInterface $poster, PosterInterface $parent, $params = [])
    {
        $params = array_merge($params, [
            'user_id'        => $poster->getUserId(),
            'poster_id'      => $poster->getId(),
            'poster_type'    => $poster->getType(),
            'parent_id'      => $parent->getId(),
            'parent_user_id' => $parent->getUserId(),
            'album_type'     => self::ALBUM_TYPE_UPLOAD,
            'parent_type'    => $parent->getType(),
            'created_at'     => Kendo_DATE_TIME,
            'modified_at'    => Kendo_DATE_TIME,
        ]);


        if (empty($params['title'])) {
            $params['title'] = date('M D, Y');
        }

        $album = new PhotoAlbum($params);

        $album->save();

        return $album;
    }

    /**
     * Create collection to database
     *
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param PhotoAlbum      $album
     * @param null            $params
     *
     * @return PhotoCollection
     */
    public function _addCollection(PosterInterface $poster, PosterInterface $parent, PhotoAlbum $album, $params = null)
    {

        $collection = new PhotoCollection([
            'poster_id'      => $poster->getId(),
            'poster_type'    => $poster->getType(),
            'user_id'        => $poster->getUserId(),
            'parent_id'      => $parent->getId(),
            'parent_type'    => $parent->getType(),
            'parent_user_id' => $parent->getUserId(),
            'album_id'       => $album->getId(),
            'created_at'     => Kendo_DATE_TIME,
            'modified_at'    => Kendo_DATE_TIME
        ]);

        $collection->save();

        return $collection;
    }


    /**
     * Add Photos to album from $fileIdList
     *
     * @param array           $fileIdList
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param Album           $album
     * @param array           $params
     * @param bool            $addFeed = false
     *
     * @return array [total, array: Photo, Album, Collection]
     */
    public function addPhotos($fileIdList, PosterInterface $poster, PosterInterface $parent = null, PhotoAlbum $album = null, $params = [], $addFeed = false)
    {
        if (null == $parent) {
            $parent = $poster;
        }

        if (null == $album) {
            $album = $this->getSingletonAlbum($parent);
        }

        $photoList = [];

        $totalFile = count($fileIdList);

        $collection = null;
        $collectionId = 0;

        if ($totalFile > 1) {
            $collection = $this->_addCollection($poster, $parent, $album);
            $collectionId = $collection->getId();
        }

        $albumParams = [
            'privacy_type'  => $album->getPrivacyType(),
            'privacy_value' => $album->getPrivacyValue(),
            'privacy_text'  => $album->getPrivacyText(),
        ];

        foreach ($fileIdList as $fileId) {
            $photo = new Photo(array_merge($albumParams, [
                'album_id'       => $album->getId(),
                'collection_id'  => $collectionId,
                'user_id'        => $poster->getUserId(),
                'poster_id'      => $poster->getId(),
                'poster_type'    => $poster->getType(),
                'parent_id'      => $parent->getId(),
                'parent_type'    => $parent->getType(),
                'parent_user_id' => $parent->getUserId(),
                'photo_file_id'  => (int)$fileId,
                'title'          => '',
                'content'        => '',
                'created_at'     => Kendo_DATE_TIME,
                'modified_at'    => Kendo_DATE_TIME,
            ], $params));

            $photo->setFromArray($params);
            $photo->save();
            $photoList[] = $photo;
        }

        if (!empty($photoList)) {

            $album->setPhotoCount($album->getPhotoCount() + count($photoList));

            if ($album->getPhotoFileId() == 0) {

                $firstPhoto = $photoList[0];

                if (!$firstPhoto instanceof Photo) ;

                $album->setPhotoFileId($firstPhoto->getPhotoFileId());
            }
            $album->save();
        }

        $totalPhoto = count($photoList);
        $feed = null;

        if ($addFeed) {
            if ($totalPhoto == 1) {

                $firstPhoto = $photoList[0];

                $feed = \App::feedService()->addItemFeed('photo_upload', $firstPhoto);

            } else if ($totalPhoto > 1) {

                $feed = \App::feedService()->addItemFeed('photo_upload_collection', $collection, ['count' => $totalPhoto]);
            }
        }

        return [$totalPhoto, $photoList, $album, $collection, $feed];
    }

    /**
     * @param array           $fileId
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param PhotoAlbum      $album
     * @param array           $params
     *
     * @return Photo
     */
    public function addPhoto($fileId, PosterInterface $poster, PosterInterface $parent = null, PhotoAlbum $album = null, $params = [])
    {
        if (null == $parent) {
            $parent = $poster;
        }

        if (null == $album)
            $album = $this->getSingletonAlbum($parent);

        $photo = new Photo([
            'album_id'       => $album->getId(),
            'collection_id'  => 0,
            'user_id'        => $poster->getUserId(),
            'poster_id'      => $poster->getId(),
            'poster_type'    => $poster->getType(),
            'parent_id'      => $parent->getId(),
            'parent_type'    => $parent->getType(),
            'parent_user_id' => $parent->getUserId(),
            'photo_file_id'  => (int)$fileId,
            'title'          => '',
            'content'        => '',
            'created_at'     => Kendo_DATE_TIME,
            'modified_at'    => Kendo_DATE_TIME,
        ]);

        $photo->setFromArray($params);
        $photo->save();

        $album->setPhotoCount($album->getPhotoCount() + 1);

        if ($album->getPhotoFileId() == 0) {
            $album->setPhotoFileId($photo->getPhotoFileId());
        }
        $album->save();

        return $photo;
    }

    /**
     * Make album cover
     *
     * @param Photo $photo
     *
     * @throws \InvalidArgumentException
     *
     */
    public function makeAlbumCover(Photo $photo)
    {
        $album = $photo->getAlbum();

        if (!$album)
            throw new \InvalidArgumentException(\App::text('photo.this_photo_does_not_has_album'));

        $album->setPhotoFileId($photo->getPhotoFileId());

        $album->save();

    }

    /**
     * @param AtomInterface $object
     *
     * @return \Photo\Model\PhotoCover
     */
    private function findCoverByObject(AtomInterface $object)
    {
        return \App::table('photo.photo_cover')
            ->select()
            ->where('object_id=?', $object->getId())
            ->where('object_type=?', $object->getType())
            ->one();
    }

    /**
     * @param AtomInterface $object
     *
     * @return \Photo\Model\PhotoCover
     */
    public function getCover(AtomInterface $object)
    {
        return $this->findCoverByObject($object);
    }

    /**
     * @param AtomInterface $object
     * @param Photo    $photo
     * @param int      $positionTop
     *
     * @return \Photo\Model\PhotoCover
     */
    public function setCover(AtomInterface $object, $photo, $positionTop = 0)
    {
        $cover = $this->findCoverByObject($object);

        if (null == $cover) {
            $cover = new PhotoCover(
                [
                    'object_id'   => $object->getId(),
                    'object_type' => $object->getType(),
                ]
            );
        }

        // update cover information
        $cover->setPositionTop($positionTop);
        $cover->setPhotoFileId($photo->getPhotoFileId());
        $cover->setPhotoId($photo->getId());
        $cover->setCreatedAt(Kendo_DATE_TIME);

        $cover->save();

        return $cover;
    }

    /**
     * @param AtomInterface $object
     * @param          $positionTop
     *
     * @return bool
     */
    public function updatePosition(AtomInterface $object, $positionTop)
    {
        $cover = $this->findCoverByObject($object);

        if (null == $cover) {
            throw new \InvalidArgumentException("Cover not found");
        }

        $cover->setPositionTop($positionTop);

        $cover->save();

        return true;
    }

    /**
     * @param AtomInterface $object
     *
     * @return bool
     */
    public function removeCover(AtomInterface $object)
    {

        $cover = $this->findCoverByObject($object);

        if (null != $cover) {
            $cover->delete();
        }

        return true;
    }

    /**
     * @param AtomInterface $object
     * @param int      $positionTop
     *
     * @return \Photo\Model\PhotoCover
     * @throws \InvalidArgumentException
     */
    public function repositionCover(AtomInterface $object, $positionTop)
    {

        $cover = $this->findCoverByObject($object);

        if (empty($cover))
            throw new \InvalidArgumentException("Cover not found");

        $cover->setPositionTop($positionTop);
        $cover->save();

        return $cover;
    }

    /**
     * @return array
     */
    public function getCategoryOptions()
    {

        return \App::cacheService()
            ->get(['photo', 'getCategoryOptions'], 0, function () {
                return $this->_getCategoryOptions();
            });

    }


    /**
     * @return array
     */
    private function _getCategoryOptions()
    {
        $select = \App::table('photo.category')->select()
            ->order('category_name', 1);

        $items = $select->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof PhotoCategory) continue;
            $options[] = ['value' => $item->getId(), 'label' => $item->getTitle()];
        }

        return $options;
    }
}