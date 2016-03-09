<?php
namespace Platform\Core\Service;

use Kendo\Content\PosterInterface;

/**
 * Class ProfileService
 *
 * @package Core\Service
 */
class ProfileService
{

    /**
     * @return array
     */
    public function getStorageTypes()
    {
        return app()->table('core.process_data_type')
            ->select()
            ->where('module_name IN ?', app()->packages()->getActiveModules())
            ->toPairs('data_type', 'storage');
    }

    /**
     * @param PosterInterface $profile
     * @param array           $names
     *
     * @return array
     */
    public function loadValuesForEdit(PosterInterface $profile, $names = null)
    {

        $fields = $this->getProfileFields($profile->getType());

        /**
         * reduce number of fields to limit how to access point to this values
         */
        if (!empty($names)) {

        }

        $storages = [];

        /**
         * load macheds contents
         */
        foreach ($fields as $field) {
            $storages[ $field['storage'] ][] = $field['field_name'];
        }

        // has all name by profile type

        $response = [];

        foreach ($storages as $storage => $names) {


            $rows = app()->table($storage)->loadContentValues($profile->getId(), $names);

            foreach ($rows as $row) {
                $name = $row->__get('name');
                $index = $row->__get('sort_order');
                $field = $fields[ $name ];

                if ($field['is_multiple']) {
                    $response[ $name ][] = $row->getValue();
                } else {
                    $response[ $name ] = $row->getValue();
                }
            }
        }

        return $response;
    }

    /**
     * @param string $contentType
     *
     * @return array
     */
    public function getProfileFields($contentType)
    {
        $dataType = app()->table('core.process_data_type');

        $fields = app()->table('core.profile_field')
            ->select('pt')
            ->where('content_type=?', $contentType)
            ->join($dataType->getName(), 'dt', 'dt.data_type=pt.data_type', null, null)
            ->toAssocs();

        $response = [];

        foreach ($fields as $field) {
            $response[ $field['field_name'] ] = $field;
        }

        return $response;
    }

    /**
     * @param int   $profileId
     * @param array $names
     *
     * @return array
     */
    public function findValueRows($profileId, $names = [])
    {
        return app()->table('core.profile_value')
            ->select()
            ->where('content_id=?', $profileId)
            ->where('name in ?', $names)
            ->toAssocs();

    }

    /**
     * @param PosterInterface $profile
     * @param array           $data
     *
     * @return array
     */
    public function updateValues(PosterInterface $profile, $data)
    {
        /**
         * each rows contain name => array(
         *  value: string/ or array belong to data type.
         * dta type.
         *  privacy_type: string
         *  privacy_value: string
         * )
         * value,privacy_type, privacy_id. => nope to cancelling.
         */
        $names = array_intersect(array_keys($data), $this->findSupportedFields($profile->getType()));
        // check exists name in this score.

        if (empty($names)) {
            return [];
        }

        $fields = $this->getProfileFields($profile->getType());

        foreach ($names as $name) {
            $value = $data[ $name ];
            $field = $fields[ $name ];

            $table = app()->table($field['storage']);

            $table->updateContentValues($profile->getId(), $name, $field['is_multiple'], $value);
        }
        // build custom data from data storage is needed to caching to any match.
    }

    /**
     * @param string $contentType
     *
     * @return array
     */
    public function findSupportedFields($contentType)
    {
        return app()->table('core.profile_field')
            ->select()
            ->where('content_type=?', $contentType)
            ->fields('field_name');
    }

    /**
     * @param PosterInterface $profile
     *
     * @return array
     */
    public function getAbout(PosterInterface $profile)
    {
        $processService = app()->instance()->make('platform_core_process');

        if (!$processService instanceof ProcessService) ;

        $structure = $processService->getAboutFieldStructure($profile->getType(), 'about', 0);

        $values = $this->loadValuesForRender($profile, $structure['fields']);

        foreach ($structure['sections'] as $sectionIndex => $section) {
            foreach ($section['fields'] as $fieldName => $_) {
                if (empty($values[ $fieldName ])) {
                    unset($structure['sections'][ $sectionIndex ]['fields'][ $fieldName ]);
                } else {
                    $structure['sections'][ $sectionIndex ]['fields'][ $fieldName ]['data'] = $values[ $fieldName ];
                }
            }
        }

        return $structure;
    }

    /**
     * @param PosterInterface $profile
     * @param array           $names
     *
     * @return array
     */
    public function loadValuesForRender(PosterInterface $profile, $names = null)
    {
        $fields = $this->getProfileFields($profile->getType());

        /**
         * reduce number of fields to limit how to access point to this values
         */
        if (!empty($names)) {

        }

        $storages = [];

        /**
         * load macheds contents
         */
        foreach ($fields as $field) {
            $storages[ $field['storage'] ][] = $field['field_name'];
        }

        // has all name by profile type

        $response = [];

        foreach ($storages as $storage => $names) {


            $rows = app()->table($storage)->loadContentValues($profile->getId(), $names);

            foreach ($rows as $row) {

                $name = $row->__get('name');

                $field = $fields[ $name ];

                if ($field['is_multiple']) {
                    $response[ $name ][] = [
                        'html'  => $row->toHtml(),
                        'value' => $row->getValue(),
                    ];
                } else {
                    $response[ $name ] = [
                        'html'  => $row->toHtml(),
                        'value' => $row->getValue(),
                    ];
                }
            }
        }

        return $response;
    }
}