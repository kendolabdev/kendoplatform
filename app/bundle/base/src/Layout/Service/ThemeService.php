<?php
namespace Layout\Service;

use Picaso\Application\Filesystem;
use Picaso\Hook\SimpleContainer;

/**
 * Class ThemeService
 *
 * @package Layout\Service
 */
class ThemeService
{

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

        return \App::cache()
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

        chmod($filename, 0777);
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
     * @param string $themeId
     */
    public function rebuildStylesheetForTheme($themeId = null)
    {

        if (empty($themeId)) {
            $themeId = \App::layout()
                ->theme()
                ->getDefaultThemeId();
        }

        $theme = \App::layout()
            ->theme()
            ->findThemeById($themeId);


        $this->updateStylesheetBundleConfiguration();
        $variables = $theme->getVariables();

        $sass = \App::sass();

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

    /**
     * Export a theme
     *
     * @param string $themeId
     *
     * @return string
     */
    public function export($themeId)
    {
        $theme = $this->findThemeById($themeId);

        $filesystem = new Filesystem();

        $themeInfoPath = PICASO_ROOT_DIR . '/app/theme/' . $theme->getId() . '/info.json';
        $info = json_decode(file_get_contents($themeInfoPath), true);

        $destination = PICASO_TEMP_DIR . '/extension/theme-' . $theme->getId() . '-' . $theme->getVersion() . '.zip';

        $paths = [];

        foreach ($info['paths'] as $path) {
            $paths[] = PICASO_ROOT_DIR . '/' . trim($path, '/');
        }

        $filesystem->buildCompress($destination, $paths);

        return $destination;
    }

    /**
     * import theme
     *
     * @param string $themeId
     */
    public function install($themeId)
    {

    }
}