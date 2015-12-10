<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 8:11 AM
 */

namespace Platform\Captcha\Service;


class CaptchaServiceTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $captchaService =  \App::captchaService();

        $captchaService->loadAdminAdapterPaging();
    }
}
