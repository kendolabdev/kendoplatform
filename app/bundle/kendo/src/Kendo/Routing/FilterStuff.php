<?php
namespace Kendo\Routing;

/**
 * Class FilterStuff
 *
 * @package Kendo\Routing
 */
class FilterStuff implements FilterInterface
{

    /**
     * @var string
     */
    protected $params;

    protected $stuffCompiedExpression;

    /**
     * @param array $params
     */
    public function __construct($params)
    {
        $this->params = $params;

        $this->stuffCompiedExpression = $this->compile($params['stuff']);
    }

    /**
     * Compile uri
     *
     * @param string $uri
     * @param array  $regex
     *
     * @return string
     */
    public function compile($uri, $regex = null)
    {
        // The URI should be considered literal except for keys and optional parts
        // Escape everything preg_quote would escape except for : ( ) < >
        $expression = preg_replace('#' . '[.\\+*?[^\\]${}=!|]' . '#', '\\\\$0', $uri);

        if (strpos($expression, '(') !== false) {
            // Make optional parts of the URI non-capturing and optional
            $expression = str_replace([
                '(',
                ')'
            ], [
                '(?:',
                ')?'
            ], $expression);
        }

        // Insert default regex for keys
        $expression = str_replace([
            '<',
            '>'
        ], [
            '(?P<',
            '>' . '[^/]++' . ')'
        ], $expression);

        if ($regex) {
            $search = $replace = [];
            foreach ($regex as $key => $value) {
                $search[] = "<$key>" . '[^/]++';
                $replace[] = "<$key>$value";
            }

            // Replace the default regex with the user-specified regex
            $expression = str_replace($search, $replace, $expression);
        }

        return '#^' . $expression . '$#uD';
    }

    /**
     * @param array $params
     *
     * @return bool|array
     */
    public function filter($params)
    {
        if (empty($params['stuff'])) {
            return false;
        }
        if (!preg_match($this->stuffCompiedExpression, $params['stuff'], $matches)) {
            return false;
        }

        $result = $this->params;

        foreach ($matches as $key => $value) {
            if (is_int($key))
                continue;

            // Set the value for all matched keys
            $result[ $key ] = $value;
        }

        return $result;
    }

    /**
     * @return boolean
     */
    public function isChain()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function stopOnFail()
    {
        return false;
    }
}