<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 12:52 AM
 */

namespace Platform\Phrase\Service;


class PhraseServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGeneral()
    {
        $phraseService = app()->phraseService();

        $phraseService->loadFromRepository('en');

        $phraseService->load('en');

        $phraseService->getLanguageOptions();

        $phraseService->getLanguageOptionsFromRepository();

        $phraseService->loadAdminPhrasePaging(['langId' => 'en'], 1, 24);
        $phraseService->loadAdminPhrasePaging(['langId' => 'en', 'q' => 'test'], 1, 24);


    }
}
