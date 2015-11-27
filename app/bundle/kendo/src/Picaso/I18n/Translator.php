<?php

namespace Picaso\I18n;

/**
 * Class Translator
 *
 * @package Picaso\I18n
 */
class Translator
{

    /**
     * @var DateFormatter
     */
    private $dateFormatter;

    /**
     * @var CurrencyFormatter
     */
    private $currencyFormatter;

    /**
     * @var NumberFomatter
     */
    private $numberFormatter;

    /**
     * @var array
     */
    private $phrases = [];


    /**
     * @var PhraseLoaderInterface
     */
    private $loader;

    /**
     * @param string $language
     */
    public function __construct($language)
    {
        $this->phrases = $this->getLoader()->load($language);
    }

    /**
     * @return PhraseLoaderInterface
     */
    public function getLoader()
    {
        if (null == $this->loader) {
            $this->loader = \App::phraseService();
        }

        return $this->loader;
    }

    /**
     * @param PhraseLoaderInterface $loader
     */
    public function setLoader($loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param $value
     * @param $format
     *
     * @return string
     */
    public function toDate($value, $format = null)
    {
        if (null == $format) {
            $format = 'F j, Y';
        }

        return date($format, strtotime($value));
    }

    public function toCurrency($value)
    {

    }

    /**
     * @param $value
     */
    public function toNumber($value)
    {
        $this->numberFormatter->format($value);
    }

    /**
     * @param int $value
     *
     * @return string
     */
    public function toDuration($value)
    {
        $value = intval($value);
        $hour = $min = $sec = 0;

        if ($value > 3600) {
            $hour = intval($value / 3600);
            $value = $value - $hour * 3600;
        }

        $min = intval($value / 60);
        $sec = $value - 60 * $min;


        if ($hour) {
            return $hour . ':' . ($min < 10 ? '0' . $min : $min) . ':' . ($sec < 10 ? '0' . $sec : $sec);
        }

        return $min . ':' . ($sec < 10 ? '0' . $sec : $sec);

    }

    /**
     * @param $count
     *
     * @return int
     */
    public function getPluralizeOffset($count)
    {
        if ($count == 1)
            return 0;

        return 1;
    }

    /**
     * @param string $id
     * @param null   $count
     *
     * @return string
     */
    public function msgId($id, $count = null)
    {
        if (null !== $count && isset($this->phrases[ $id ]) && is_array($this->phrases[ $id ])) {
            $offset = $this->getPluralizeOffset($count);

            if (isset($this->phrases[ $id ][ $offset ]))
                return $this->phrases[ $id ][ $offset ];

            return $this->phrases[ $id ][0];
        }


        return isset($this->phrases[ $id ]) ? $this->phrases[ $id ] : $id;
    }

    /**
     * @param string $id
     * @param mixed  $data
     * @param int    $count
     *
     * @return string
     */
    public function text($id, $data = null, $count = null)
    {
        if (!is_null($count) && $count != 1) {
            $id = $id . '_plural';
        }

        $id = isset($this->phrases[ $id ]) ? $this->phrases[ $id ] : $id;

        if (!isset($this->phrases[ $id ])) {
            // auto add msg phrase id to database in development mode
            $this->addMsgId($id);
        }


        if (is_null($data)) {
            return $id;
        } else if (is_array($data)) {
            return strtr($id, $data);
        } else if (is_scalar($id)) {
            return str_replace('$1', $data, $id);
        }
    }

    /**
     * @param $msgId
     *
     * @return bool
     */
    private function addMsgId($msgId)
    {
        if (!strpos($msgId, '.')) {
            return false;
        }

        $arr = explode('.', $msgId);

        $count = count($arr);

        $group = null;
        $name = null;

        if ($count > 2) {
            return false;
        }

        $group = array_shift($arr);
        $name = array_shift($arr);

        if (empty($group) or empty($name)) {
            return false;
        }

        if (strlen($group) > 50) {
            return false;
        }

        if (strpos($group, ' ') !== false) {
            return false;
        }

        if (strpos($name, ' ') !== false) {
            return false;
        }

        $value = ucfirst(str_replace('_', ' ', $name));

        try {
            $entry = \App::table('phrase')
                ->fetchNew([
                    'phrase_group'  => $group,
                    'phrase_name'   => $name,
                    'is_active'     => 0,
                    'default_value' => $value,
                ]);
            $entry->save();
        } catch (\Exception $e) {

        }
    }
}