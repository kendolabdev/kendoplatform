<?php
namespace Platform\Layout\Service;

use Platform\Layout\Model\LayoutTheme;
use Kendo\Hook\SimpleContainer;

/**
 * Class ThemeService
 *
 * @package Platform\Layout\Service
 */
class ThemeService
{
    /**
     * @param string $name
     *
     * @return \Platform\Layout\Model\LayoutTheme
     */
    public function findThemeByExtensionName($name)
    {
        return app()->table('platform_layout_theme')
            ->select()
            ->where('extension_name=?', (string)$name)
            ->one();
    }

    /**
     * @return \Platform\Layout\Model\LayoutTheme
     */
    public function getDefaultTheme()
    {
        return app()->table('platform_layout_theme')
            ->select()
            ->where('is_default=?', 1)
            ->one();
    }

    /**
     * @return string
     */
    public function _getDefaultThemeId()
    {

        $theme = $this->getDefaultTheme();

        if (null == $theme)
            return 'default';

        return $theme->getId();
    }

    /**
     * @param string $themeId
     *
     * @return \Platform\Layout\Model\LayoutTheme
     */
    public function findThemeById($themeId)
    {
        return app()->table('platform_layout_theme')
            ->findById((string)$themeId);
    }

    /**
     * @return string
     */
    public function getDefaultThemeId()
    {

        return app()->cacheService()
            ->get(['layout.theme', 'getDefaultThemeId'], 0, function () {
                return $this->_getDefaultThemeId();
            });
    }

    /**
     *
     */
    public function updateStylesheetBundleConfiguration()
    {
        $container = new SimpleContainer([]);

        // pre add this.

        $container->add('kendo/require', 'require');
        $container->add('kendo/main', 'kendo/main');
        $container->add('layout/main', 'layout/main');

        app()->emitter()
            ->emit('onBeforeBuildBundleStylesheet', $container);

        $container->add('customize', 'customize');

        $all = array_values($container->all());

        $content = implode(PHP_EOL, array_map(function ($e) {
            return sprintf('@import "%s";', $e);
        }, $all));

        $filename = $this->getMainSassFilename();

        file_put_contents($filename, $content);
    }

    /**
     * @return string
     */
    public function getMainSassFilename()
    {
        return KENDO_ROOT_DIR . '/app/temp/cache/_main.scss';
    }

    /**
     *
     */
    public function rebuildStylesheetForAllActiveTheme()
    {
        $themes = app()->table('platform_layout_theme')
            ->select()
            ->where('is_active=?', 1)
            ->all();

        foreach ($themes as $theme) {
            $this->rebuildStylesheetForTheme($theme->getId());
        }
    }

    /**
     * @param \Platform\Layout\Model\LayoutTheme $theme
     */
    public function setDefaultTheme(LayoutTheme $theme)
    {
        app()->table('platform_layout_theme')
            ->update(['is_default' => 0])
            ->where('theme_id <> ?', $theme->getId())
            ->execute();

        $theme->setDefault(1);
        $theme->save();
    }

    /**
     * @param string $themeId
     */
    public function rebuildStylesheetForTheme($themeId = null)
    {
        if (empty($themeId)) {
            $themeId = app()->layouts()
                ->theme()
                ->getDefaultThemeId();
        }

        $theme = app()->layouts()
            ->theme()
            ->findThemeById($themeId);

        $this->updateStylesheetBundleConfiguration();

        $variables = $theme->getVariables();

        $sass = app()->sass();

        $content = $sass->compile(
            null, $variables, [
            KENDO_ROOT_DIR . '/app/theme/' . $themeId . '/sass/',
            KENDO_ROOT_DIR . '/app/theme/' . $theme->getParentThemeId() . '/sass/',
            KENDO_ROOT_DIR . '/app/theme/default/sass/',
        ], [
            $this->getMainSassFilename()
        ]);

        $outputFilename = sprintf(KENDO_ROOT_DIR . '/static/theme/%s/stylesheets/bundle.css', $themeId);

        $dir = dirname($outputFilename);

        if (!is_dir($dir)) {
            if (!@mkdir($dir, 0777, 1)) {
                throw new \RuntimeException("Can not write to $dir");
            }
            @chmod($dir, 0777);
        }

        $fp = fopen($outputFilename, 'w');
        if (!$fp) {
            throw new \InvalidArgumentException("Could not write to file [$outputFilename]");
        }
        fwrite($fp, $content);
        fclose($fp);
    }
}