<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_mail_transport`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\MailTransport
 *
 * @package Platform\Mail\Model
 */
class MailTransport extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('transport_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('transport_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTransportId()
    {
        return $this->__get('transport_id');
    }

    /**
     * @param $value
     */
    public function setTransportId($value)
    {
        $this->__set('transport_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTransportType()
    {
        return $this->__get('transport_type');
    }

    /**
     * @param $value
     */
    public function setTransportType($value)
    {
        $this->__set('transport_type', $value);
    }

    /**
     * @return null|string
     */
    public function isSystem()
    {
        return $this->__get('is_system');
    }

    /**
     * @return null|string
     */
    public function getSystem()
    {
        return $this->__get('is_system');
    }

    /**
     * @param $value
     */
    public function setSystem($value)
    {
        $this->__set('is_system', $value);
    }

    /**
     * @return null|string
     */
    public function getTransportName()
    {
        return $this->__get('transport_name');
    }

    /**
     * @param $value
     */
    public function setTransportName($value)
    {
        $this->__set('transport_name', $value);
    }

    /**
     * @return null|string
     */
    public function getParamsText()
    {
        return $this->__get('params_text');
    }

    /**
     * @param $value
     */
    public function setParamsText($value)
    {
        $this->__set('params_text', $value);
    }

    /**
     * @return \Platform\Mail\Model\MailTransportTable
     */
    public function table()
    {
        return \App::table('platform_mail_transport');
    }
    //END_TABLE_GENERATOR
}