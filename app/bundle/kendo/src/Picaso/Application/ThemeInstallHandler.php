<?php
namespace Picaso\Application;

/**
 * Class ThemeInstallHandler
 *
 * @package Picaso\Application
 */
class ThemeInstallHandler
{
    /**
     * @var array
     */
    protected $finalData = [];

    /**
     * @var \Layout\Model\LayoutTheme
     */
    protected $theme;

    /**
     * @param \Layout\Model\LayoutTheme $theme
     */
    public function export($theme)
    {
        $this->theme = $theme;

        $this->beforeExport();
        $this->doExport();
        $this->afterExport();
        $this->updatePackageFile();
        $this->archive();
    }

    /**
     *
     */
    protected function beforeExport()
    {

    }

    /**
     *
     */
    protected function doExport()
    {
        $this->exportLayoutTheme();
    }

    /**
     *
     */
    protected function afterExport()
    {

    }

    /**
     *
     */
    protected function exportLayoutTheme()
    {
        $this->finalData['info'] = $this->theme->toArray();
    }

    /**
     * Export layout from database
     */
    protected function exporLayout()
    {
        $this->finalData['layout_data'] =
            \App::layout()->exportLayoutData([], [$this->getTheme()->getId()]);
    }

    /**
     * @return \Layout\Model\LayoutTheme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param \Layout\Model\LayoutTheme $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @return array
     */
    public function getFinalData()
    {
        return $this->finalData;
    }

    /**
     * @param array $finalData
     */
    public function setFinalData($finalData)
    {
        $this->finalData = $finalData;
    }

    /**
     *
     */
    protected function updatePackageFile()
    {
        $theme = $this->getTheme();

        $filename = PICASO_ROOT_DIR . "/app/theme/" . $theme->getId() . "/package.json";

        if (!is_writable($dir = dirname($filename)))
            throw new \RuntimeException("Could not write to $dir");

        file_put_contents($filename, json_encode($this->finalData, JSON_PRETTY_PRINT));

        @chmod($filename, 0777);
    }

    /**
     * @return string
     */
    protected function archive()
    {

        $theme = $this->getTheme();

        $themeId = $theme->getId();

        $filesystem = new Filesystem();

        $destination = PICASO_TEMP_DIR . '/extension/theme-' . $theme->getId() . '-' . $theme->getVersion() . '.zip';

        $paths = [
            PICASO_ROOT_DIR . '/app/theme/' . $themeId,
            PICASO_ROOT_DIR . '/static/theme/' . $themeId

        ];

        $filesystem->buildCompress($destination, $paths);

        return $destination;
    }

    /**
     *
     */
    public function install()
    {

    }

    /**
     *
     */
    public function uninstall()
    {

    }
}