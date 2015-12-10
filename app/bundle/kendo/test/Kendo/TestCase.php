<?php
namespace Kendo;
use Faker\Factory;

/**
 * Base Test Case
 * Class TestCase
 *
 * @package Kendo
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $locale
     *
     * @return \Faker\Generator
     */
    public function getFaker($locale = null)
    {
        if (null == $locale) {
            $locale = Factory::DEFAULT_LOCALE;
        }

        return Factory::create($locale);
    }
}