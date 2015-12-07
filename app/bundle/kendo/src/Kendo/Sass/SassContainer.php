<?php
namespace Kendo\Sass;

/**
 * Class SassContainer
 *
 * @package Kendo\Sass
 */
class SassContainer
{
    /**
     * @var string
     */
    private $templateName;

    /**
     * @var string
     */
    private $themeName;

    /**
     * @var string
     */
    private $content;

    /**
     * @var array
     */
    private $importPaths = [];

    /**
     * @var array
     */
    private $variables = [];

    /**
     * @var array
     */
    private $files = [];

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getImportPaths()
    {
        return $this->importPaths;
    }

    /**
     * @param array $importPaths
     */
    public function setImportPaths($importPaths)
    {
        $this->importPaths = $importPaths;
    }

    /**
     * @return string
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * @param string $templateName
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
    }

    /**
     * @return string
     */
    public function getThemeName()
    {
        return $this->themeName;
    }

    /**
     * @param string $themeName
     */
    public function setThemeName($themeName)
    {
        $this->themeName = $themeName;
    }

    /**
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * @param array $variables
     */
    public function setVariables($variables)
    {
        $this->variables = $variables;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @param $files
     *
     * @return SassContainer
     */
    public function addFiles($files)
    {
        foreach ($files as $filename) {
            $this->addFile($filename);
        }

        return $this;
    }

    /**
     * @param $filename
     *
     * @return SassContainer
     */
    public function addFile($filename)
    {
        $this->files[] = $filename;

        return $this;
    }

    /**
     * @param array $variables
     *
     * @return SassContainer
     */
    public function addVariables($variables)
    {
        foreach ($variables as $name => $variable) {
            $this->addVariable($name, $variable);
        }

        return $this;
    }

    /**
     * @param  string $name
     * @param  string $variable
     *
     * @return SassContainer
     */
    public function addVariable($name, $variable)
    {
        // trigger about variable exists
        if (!isset($this->variables[ $name ])) {
            $this->variables[ $name ] = $variable;
        }

        return $this;
    }

    /**
     * @param $paths
     *
     * @return $this
     */
    public function addImportPaths($paths)
    {
        foreach ($paths as $filename) {
            $this->addImportPath($filename);
        }

        return $this;
    }

    /**
     * @param string $filename
     *
     * @return SassContainer
     */
    public function addImportPath($filename)
    {
        $this->importPaths[] = $filename;

        return $this;
    }

}