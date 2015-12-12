<?php

namespace Kendo\Html;


/**
 * Class ReCaptchaField
 *
 * @package Kendo\Html
 */
class ReCaptchaField extends HtmlElement implements FormField
{

    /**
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->setAttribute('value', $value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        $key = \App::setting('recaptcha', 'public_key');

        return '<script src="//www.google.com/recaptcha/api.js"></script>'
        . '<div class="g-recaptcha" data-sitekey="' . $key . '"></div>';
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function isValid($value)
    {

        $result = $this->verify();

        /**
         * @codeCoverageIgnoreStart
         */
        if (!$result) {
            $this->addErrors(\App::text('core.invalid_captcha_value'));
        }

        return $result;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return bool
     */
    private function verify()
    {
        if (KENDO_UNITEST)
            return true;

        $value = $_REQUEST['g-recaptcha-response'];

        $ch = curl_init('//www.google.com/recaptcha/api/siteverify');

        $postFields = http_build_query([
            'secret'   => \App::setting('recaptcha', 'private_key'),
            'response' => $value,
            'remoteip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',
        ], null, '&');


        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

        $txt = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($txt, true);

        if (empty($response))
            return false;

        if (!$response['success'])
            return false;

        return true;
    }


    /**
     * Override method
     */
    protected function init()
    {
        $this->setAttribute('type', 'text');
        $this->setName('g-recaptcha-response');
    }

}
