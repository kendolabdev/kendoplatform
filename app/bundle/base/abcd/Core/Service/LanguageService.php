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
}