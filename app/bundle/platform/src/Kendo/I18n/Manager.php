<?php

namespace Kendo\I18n;

/**
 * Class Manager
 *
 * @package Kendo\I18n
 */
class Manager
{
    /**
     * @var string
     */
    private $locale = 'en_us';

    /**
     * @var string
     */
    private $language = 'en';

    /**
     * @var array
     */
    private $translators = [];

    /**
     * Init default locale
     */
    public function __construct()
    {
        $this->initLocale();
    }

    /**
     * Init locale
     */
    private function initLocale()
    {
        $locale = 'en';
        if (!empty($_COOKIE['locale'])) {
            $locale = $_COOKIE['locale'];
        } else if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {

        }

        $this->setLocale($locale);
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return array
     */
    public function getTranslators()
    {
        return $this->translators;
    }

    /**
     * @param array $translators
     */
    public function setTranslators($translators)
    {
        $this->translators = $translators;
    }

    /**
     * @param string     $locale
     * @param Translator $translator
     */
    public function setTranslator($locale, Translator $translator)
    {
        $this->translators[ $locale ] = $translator;
    }

    /**
     * @param string $locale
     *
     * @return Translator
     */
    public function getTranslator($locale = null)
    {
        if (null == $locale) {
            $locale = $this->getLocale();
        }

        if (empty($this->translators[ $locale ])) {
            $this->translators[ $locale ] = new Translator($this->language);
        }

        return $this->translators[ $locale ];
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        $this->setLanguage(substr($locale, 0, 2));
    }

    public function getBrowser()
    {
        $httplanguages = getenv('HTTP_ACCEPT_LANGUAGE');
        if (empty($httplanguages) && array_key_exists('HTTP_ACCEPT_LANGUAGE', $_SERVER)) {
            $httplanguages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        }

        $languages = [];
        if (empty($httplanguages)) {
            return $languages;
        }

        $accepted = preg_split('/,\s*/', $httplanguages);

        foreach ($accepted as $accept) {
            $match = null;
            $result = preg_match('/^([a-z]{1,8}(?:[-_][a-z]{1,8})*)(?:;\s*q=(0(?:\.[0-9]{1,3})?|1(?:\.0{1,3})?))?$/i',
                $accept, $match);

            if ($result < 1) {
                continue;
            }

            if (isset($match[2]) === true) {
                $quality = (float)$match[2];
            } else {
                $quality = 1.0;
            }

            $countrys = explode('-', $match[1]);
            $region = array_shift($countrys);

            $country2 = explode('_', $region);
            $region = array_shift($country2);

            foreach ($countrys as $country) {
                $languages[ $region . '_' . strtolower($country) ] = $quality;
            }

            foreach ($country2 as $country) {
                $languages[ $region . '_' . strtolower($country) ] = $quality;
            }

            if ((isset($languages[ $region ]) === false) || ($languages[ $region ] < $quality)) {
                $languages[ $region ] = $quality;
            }
        }

        return $languages;
    }
}