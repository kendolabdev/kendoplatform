<?php

namespace Platform\Phrase\Service;

use Kendo\Kernel\KernelService;
use Platform\Phrase\Model\PhraseLanguage;
use Kendo\I18n\PhraseLoaderInterface;

/**
 * Class Platform\PhraseService
 *
 * @package Core\Service
 */
class PhraseService extends KernelService implements PhraseLoaderInterface
{

    /**
     * @param string $language
     *
     * @return array
     */
    public function loadFromRepository($language)
    {


        $valueTable = app()->table('platform_phrase_value')->getName();

        $select = app()->table('platform_phrase')
            ->select('p')
            ->leftJoin($valueTable, 'pv', 'p.phrase_id=pv.phrase_id and pv.language_id=:language', [':language' => $language])
            ->columns('pv.phrase_value, pv.language_id, p.*');

        $response = [];

        foreach ($select->toAssocs() as $p) {
            $key = $p['phrase_group'] . '.' . $p['phrase_name'];
            $value = $p['default_value'];

            if ($p['phrase_value']) {
                $value = $p['phrase_value'];
            }
            $response[ $key ] = $value;
        }

        return $response;
    }

    /**
     * @param $language
     *
     * @return array
     */
    public function load($language)
    {
        return app()->cacheService()
            ->get(['phrase', 'load', 'language'], 0, function () use ($language) {
                return $this->loadFromRepository($language);
            });
    }

    /**
     * @param $query
     * @param $page
     * @param $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminPhrasePaging($query, $page = 1, $limit = 24)
    {
        $tablePhrase = app()->table('platform_phrase');
        $tableValue = app()->table('platform_phrase_value');

        if (empty($query['langId']))
            $query['langId'] = 'en';

        $select = $tablePhrase
            ->select('p');

        if (!empty($query['langId'])) {
            $langId = $query['langId'];

            $select->leftJoin($tableValue->getName(), 'v',
                'p.phrase_id=v.phrase_id and v.language_id=:langId', [':langId' => $langId], null)
                ->columns('p.*, v.phrase_value');
        }

        if (!empty($query['q'])) {
            $like = '%' . $query['q'] . '%';
            $select->where('p.default_value like ?', $like)
                ->orWhere('v.phrase_value like ?', $like)
                ->orWhere('concat(p.phrase_group,\'.\', p.phrase_name) like ?', $like);
        }


        return $select->paging($page, $limit);
    }

    /**
     * @return array
     */
    public function getLanguageOptions()
    {
        return app()->cacheService()
            ->get(['phrase', 'getLanguageOptions', ''], 0, function () {
                return $this->getLanguageOptionsFromRepository();
            });
    }

    /**
     * @return array
     */
    public function getLanguageOptionsFromRepository()
    {
        $select = app()->table('platform_phrase_language')->select();

        $items = $select->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof PhraseLanguage) continue;

            $options [] = [
                'value' => $item->getId(),
                'label' => $item->getName(),
            ];
        }

        return $options;
    }
}