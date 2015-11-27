<?php
namespace Layout\Service;

use Layout\Model\LayoutTheme;
use Picaso\Hook\SimpleContainer;

/**
 * Class ThemeService
 *
 * @package Layout\Service
 */
class ThemeService
{
    /**
     * @param string $name
     *
     * @return \Layout\Model\LayoutTheme
     */
    public function findThemeByExtensionName($name)
    {
        return \App::table('layout.layout_theme')
            ->select()
            ->where('extension_name=?', (string)$name)
            ->one();
    }

    /**
     * @return \Layout\Model\LayoutTheme
     */
    public function getDefaultTheme()
    {
        return \App::table('layout.layout_theme')
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
     * @return \Layout\Model\LayoutTheme
     */
    public function findThemeById($themeId)
    {
        return \App::table('layout.layout_theme')
            ->findById((string)$themeId);
    }

    /**
     * @return string
     */
    public function getDefaultThemeId()
    {

        return \App::cacheService()
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

        \App::hook()
            ->notify('onBeforeBuildBundleStylesheet', $container);

        $content = file_get_contents(PICASO_ROOT_DIR . '/app/theme/default/sass/_origin.scss');

        $appendContent = implode(PHP_EOL, array_map(function ($e) {
            return sprintf('@import "%s";', $e);
        }, array_values($container->all())));

        $newContent = $content . PHP_EOL . $appendContent;

        $filename = PICASO_ROOT_DIR . '/app/theme/default/sass/_styles.scss';

        file_put_contents($filename, $newContent);
    }

    /**
     *
     */
    public function rebuildStylesheetForAllActiveTheme()
    {
        $themes = \App::table('layout.layout_theme')
            ->select()
            ->where('is_active=?', 1)
            ->all();

        foreach ($themes as $theme) {
            $this->rebuildStylesheetForTheme($theme->getId());
        }
    }

    /**
     * @param \Layout\Model\LayoutTheme $theme
     */
    public function setDefaultTheme(LayoutTheme $theme)
    {
        \App::table('layout.layout_theme')
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
            $themeId = \App::layoutService()
                ->theme()
                ->getDefaultThemeId();
        }

        $theme = \App::layoutService()
            ->theme()
            ->findThemeById($themeId);


        $this->updateStylesheetBundleConfiguration();
        $variables = $theme->getVariables();

        $sass = \App::styleService();

        $content = $sass->compile(
            null, $variables, [
            PICASO_ROOT_DIR . '/app/theme/' . $themeId . '/sass/',
            PICASO_ROOT_DIR . '/app/theme/' . $theme->getParentThemeId() . '/sass/',
            PICASO_ROOT_DIR . '/app/theme/default/sass/',
        ], [
            PICASO_ROOT_DIR . '/app/theme/default/sass/_styles.scss'
        ]);

        $outputFilename = sprintf(PICASO_ROOT_DIR . '/static/theme/%s/stylesheets/bundle.css', $themeId);

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