<?php

namespace Picaso\Routing;

/**
 * Class Route
 *
 * @package Picaso\Routing
 */
class Route implements RouteInterface
{

    /**
     * @var  array
     */
    public $uriExpression = [];
    /**
     * @var  string
     */
    public $uriCompiledExpression;
    /**
     * @var string
     */
    protected $name = null;
    /**
     * regular methods
     */
    protected $methods = null;
    /**
     * @var  string  route URI
     */
    protected $uri = null;
    /**
     * @var string
     */
    protected $host = null;
    /**
     * @var array
     */
    protected $hostExpression = [];
    /**
     * @var string
     */
    protected $hostCompiledExpression;
    /**
     * @var string
     */
    protected $protocol = 'http://';

    /**
     * @var $name $params
     */
    protected $forwarder;

    /**
     * @var  array
     */
    protected $defaults = [
        'controller' => '\Core\Controller\Home',
        'action'     => 'index',
    ];

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @param string $name
     * @param array  $params
     */
    public function __construct($name, $params)
    {

        $this->name = $name;

        if (isset($params['uri'])) {
            $this->uri = $params['uri'];
        }

        if (isset($params['uri_expr'])) {
            $this->uriExpression = $params['uri_expr'];
        }

        if (isset($params['host'])) {
            $this->host = $params['host'];
        }

        if (isset($param['host_expr'])) {
            $this->hostExpression = $params['host_expr'];
        }

        if ($this->uri) {
            // Store the compiled uriExpression locally
            $this->uriCompiledExpression = $this->compile($this->uri, $this->uriExpression);
        }

        if ($this->host) {
            $this->hostCompiledExpression = $this->compile($this->host, $this->hostExpression);
        }

        if (isset($params['defaults'])) {
            foreach ($params['defaults'] as $key => $value) {
                $this->defaults[ $key ] = $value;
            }
        }
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    function getDefaults()
    {
        return $this->defaults;
    }

    /**
     * @param array $defaults
     */
    function setDefaults($defaults)
    {
        $this->defaults = $defaults;
    }

    /**
     * @param FilterInterface $filter
     *
     * @return Route
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * @param      $uri
     * @param null $host
     *
     * @return array|bool
     */
    public function match($uri, $host = null)
    {
        $params = [];

        if ($host && $this->host) {
            if (!preg_match($this->hostCompiledExpression, $host, $matches))
                return false;

            foreach ($matches as $key => $value) {
                if (is_int($key))
                    continue;
                // Set the value for all matched keys
                $params[ $key ] = $value;
            }
        }

        if ($uri && $this->uri) {
            if (!preg_match($this->uriCompiledExpression, $uri, $matches))
                return false;

            foreach ($matches as $key => $value) {
                if (is_int($key))
                    continue;

                // Set the value for all matched keys
                $params[ $key ] = $value;
            }
        }

        foreach ($this->defaults as $key => $value) {
            if (!isset($params[ $key ]) OR $params[ $key ] === '') {
                // Set default values for any key that was not matched
                $params[ $key ] = $value;
            }
        }

        $result = $this->filter($params);

        if (false === $result) {
            return false;
        }

        if ($this->forwarder) {
            $delegate = \App::routing()->getRoute($this->forwarder);

            $result = $delegate->filter($params);
        }


        if (is_array($result)) {
            $params = array_merge($params, $result);
        }

        return $params;
    }

    /**
     * @param $params
     *
     * @return bool|array
     */
    public function filter($params)
    {
        if (empty($this->filters)) {
            return true;
        }

        $matched = false;

        foreach ($this->filters as $filter) {
            if (false != ($result = $filter->filter($params))) {
                $matched = true;
                if ($filter->isChain()) {
                    $params = array_merge($params, $result);
                } else {
                    return array_merge($params, $result);
                }
            } else if ($filter->stopOnFail()) {
                return false;
            }
        }

        if ($matched) {
            return $params;
        }

        return false;
    }

    /**
     * Generates a URI for the current route based on the parameters given.
     *
     *
     * @param   array $params URI parameters
     *
     * @return  string
     *
     * @uses    Route::REGEX_GROUP
     * @uses    Route::REGEX_KEY
     */
    public function getUrl($params = null)
    {
        $defaults = $this->defaults;
        $usages = [];

        /**
         * @param int   $portion
         * @param bool  $required
         * @param array $usages
         *
         * @return array
         */
        $compile = function ($portion, $required, &$usages) use (&$compile, $defaults, $params) {

            $missing = [];

            $pattern = '#(?:<([a-zA-Z0-9_]++)>|\(((?:(?>[^()]+)|(?R))*)\))#';

            $result = preg_replace_callback($pattern, function ($matches) use (&$compile, $defaults, &$missing, $params, &$required, &$usages) {
                if ($matches[0][0] === '<') {
                    // Parameter, unwrapped
                    $param = $matches[1];

                    if (isset($params[ $param ])) {
                        // This portion is required when a specified
                        // parameter does not match the default
                        $required = ($required OR !isset($defaults[ $param ]) OR $params[ $param ] !== $defaults[ $param ]);

                        $usages[ $param ] = 1;

                        // Add specified parameter to this result
                        return $params[ $param ];
                    }

                    // Add default parameter to this result
                    if (isset($defaults[ $param ]))
                        return $defaults[ $param ];

                    // This portion is missing a parameter
                    $missing[] = $param;
                } else {
                    // Group, unwrapped
                    $result = $compile($matches[2], false, $usages);

                    if ($result[1]) {
                        // This portion is required when it contains a group
                        // that is required
                        $required = true;

                        // Add required groups to this result
                        return $result[0];
                    }

                    // Do not add optional groups to this result
                }
            }, $portion);

            if ($required AND $missing)
                throw new \InvalidArgumentException("missing route param {'" . implode(',', $missing) . "'}");

            return [
                $result,
                $usages,
                $required
            ];
        };

        list($uri, $usages) = $compile($this->uri, true, $usages);

        $queryString = '';
        $query = array_diff_key($params, $usages);

        if (!empty($query)) {
            $queryString = '?' . http_build_query($query, null, '&');
        }


        // Trim all extra slashes from the URI
        $uri = preg_replace('#//+#', '/', rtrim($uri, '/'));

        if ($this->isExternal()) {
            // Need to add the host to the URI
            $host = $this->defaults['host'];

            if (strpos($host, '://') === false) {
                // Use the default defined protocol
                $host = $this->protocol . $host;
            }

            // Clean up the host and prepend it to the URI
            $uri = rtrim($host, '/') . '/' . PICASO_BASE_DIR . $uri . $queryString;
        }

        return PICASO_BASE_URL . $uri . $queryString;
    }

    /**
     * Returns whether this route is an external route
     * to a remote controller.
     *
     * @return  boolean
     */
    public function isExternal()
    {
        return isset($this->defaults['host']) && $this->defaults['host'];
    }

    /**
     * Set forwarder
     *
     * @param $route
     *
     * @return Route
     */
    public function forward($route)
    {
        $this->forwarder = $route;

        return $this;
    }
}
