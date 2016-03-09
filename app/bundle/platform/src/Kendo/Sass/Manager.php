<?php
namespace Kendo\Sass;
use Kendo\Kernel\KernelService;

/**
 * Class Manager
 * @method open()
 * @method
 *
 * @package Kendo\Sass
 */
class Manager extends KernelService
{

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * @param string $outputFileName
     * @param string $templateName
     * @param string $themeName
     * @param array  $variables
     *
     * @return string|bool
     */
    public function compileToFile($outputFileName, $templateName, $themeName, $variables = null, $customize = '')
    {
        $container = new SassContainer();

        $container->setTemplateName($templateName);

        $container->setThemeName($themeName);


        if (!empty($variables)) {
            $container->setVariables($variables);
        }

        app()->emitter()->emit('sassCompileProcess', $container);


        $container->addContent($customize);

        $content = $this->compile($container->getContent(), $container->getVariables(), $container->getImportPaths(), $container->getFiles());


        if (!$outputFileName) {
            return $content;
        }

        $dir = dirname($outputFileName);

        if (!is_dir($dir) && !mkdir($dir, 0777, true)) {
            throw new \InvalidArgumentException("[$dir] is not writable");
        }

        $fp = fopen($outputFileName, 'w');

        if (!$fp) {
            throw new \RuntimeException("[$outputFileName] is not writable");
        }

        fwrite($fp, $content);

        fclose($fp);

        return $content;
    }

    /**
     * @param string $content
     * @param array  $variables
     * @param array  $paths
     * @param array  $files
     *
     * @return string
     */
    public function compile($content, $variables, $paths, $files)
    {
        try {

            $content = (string)$content;

            $sass = $this->compiler();

            if (!empty($variables)) {
                $sass->setVariables($variables);
            }

            if (!empty($paths)) {
                $sass->setImportPaths($paths);
            }

            if (!empty($files)) {
                foreach ($files as $filename) {
                    $content .= PHP_EOL . file_get_contents($filename);
                }
            }

            $sass->setFormatter('scss_formatter_compressed');

            return $sass->compile($content);

        } catch (\Exception $ex) {
            throw new \InvalidArgumentException($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * @return \scssc
     */
    private function compiler()
    {
        return new \scssc();
    }
}