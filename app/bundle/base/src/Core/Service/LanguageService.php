<?php
namespace Core\Service;

/**
 * Class LanguageService
 *
 * @package Core\Service
 */
class LanguageService
{


    /**
     * @param $languageId
     *
     * @return bool
     */
    public function hasLanguage($languageId)
    {
        return null != $this->findLanguage($languageId);
    }

    /**
     * @param string $languageId
     *
     * @return \Core\Model\Language
     */
    public function findLanguage($languageId)
    {
        return \App::table('core.language')
            ->findById((string)$languageId);
    }
}