<?php

namespace Phrase\Service;

use Phrase\Model\PhraseLanguage;
use Picaso\I18n\PhraseLoaderInterface;

/**
 * Class PhraseService
 *
 * @package Core\Service
 */
class PhraseService implements PhraseLoaderInterface
{

    /**
     * @param string $language
     *
     * @return array
     */
    public function _load($language)
    {


        $valueTable = \App::table('phrase.phrase_value')->getName();

        $select = \App::table('phrase')
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
        return \App::cache()
            ->get(['phrase', 'load', 'language'], 0, function () use ($language) {
                return $this->_load($language);
            });
    }

    /**
     * @param $query
     * @param $page
     * @param $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadAdminPhrasePaging($query, $page, $limit = 24)
    {
        $tablePhrase = \App::table('phrase');
        $tableValue = \App::table('phrase.phrase_value');

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
        return \App::cache()
            ->get(['phrase', 'getLanguageOptions', ''], 0, function () {
                return $this->_getLanguageOptions();
            });
    }

    /**
     * @return array
     */
    public function _getLanguageOptions()
    {
        $select = \App::table('phrase.phrase_language')->select();

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

    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListPhraseByModuleName($moduleList)
    {
        return \App::table('phrase')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->columns('module_name, is_active, phrase_group, phrase_name, default_value')
            ->toAssocs();
    }
}