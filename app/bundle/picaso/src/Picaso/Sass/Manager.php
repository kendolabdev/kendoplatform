<?php
namespace Picaso\Sass;

/**
 * Class Manager
 *
 * @package Picaso\Sass
 */
class Manager
{

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * @param string $outputFileName
     * @param string $template
     * @param string $theme
     * @param array  $variables
     *
     * @return string|bool
     */
    public function compileToFile($outputFileName, $template, $theme, $variables = null)
    {
        $container = new SassContainer();

        $container->setTemplateName($template);

        $container->setThemeName($theme);

        if (!empty($variables)) {
            $container->setVariables($variables);
        }

        \App::hook()->notify('sassCompileProcess', $container);

        $content = $this->compile($container->getContent(), $container->getVariables(), $container->getImportPaths(), $container->getFiles());


        if (!$outputFileName) {
            return $content;
        }

        $dir = dirname($outputFileName);

        if (!is_dir($outputFileName) && !mkdir($dir, 0777, true)) {
            throw new \InvalidArgumentException("[$dir] is not writable");
        }

        $fp = fopen($outputFileName, 'w');

        if ($fp) {
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

            $scssc = $this->compiler();

            if (!empty($variables)) {
                $scssc->setVariables($variables);
            }

            if (!empty($paths)) {
                $scssc->setImportPaths($paths);
            }

            if (!empty($files)) {
                foreach ($files as $filename) {
                    $content .= PHP_EOL . file_get_contents($filename);
                }
            }

            $scssc->setFormatter('scss_formatter_compressed');

            return $scssc->compile($content);

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