<?php
namespace Kendo\Application;
use Layout\Model\LayoutTheme;

/**
 * Class ThemeInstallHandler
 *
 * @package Kendo\Application
 */
class ThemeInstallHandler implements InstallHandler
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
     * @var \Core\Model\CoreExtension
     */
    protected $extension;

    /**
     * @return \Core\Model\CoreExtension
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param \Core\Model\CoreExtension $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * @param \Core\Model\CoreExtension $extension
     *
     */
    public function export($extension)
    {
        $this->extension = $extension;

        $this->theme = \App::layoutService()
            ->theme()
            ->findThemeByExtensionName($extension->getName());

        if (!$this->theme)
            throw new \InvalidArgumentException("Invalid Theme");

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
        $this->exportExtension();
        $this->exportLayoutTheme();
        $this->exportLayoutData();
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

        $this->finalData['theme'] = $this->theme->toArray();

    }

    /**
     * export extension data
     */
    protected function exportExtension()
    {
        $extension =  $this->getExtension();

        $this->finalData['extension'] = $extension->toArray();
    }

    /**
     * Export layout from database
     */
    protected function exportLayoutData()
    {
        $this->finalData['layout_data'] =
            \App::layoutService()->exportLayoutData([], [$this->getTheme()->getId()]);
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

        $filename = Kendo_ROOT_DIR . "/app/theme/" . $theme->getId() . "/package.json";

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

        $destination = Kendo_TEMP_DIR . '/extension/theme-' . $theme->getId() . '-' . $theme->getVersion() . '.zip';

        $paths = [
            Kendo_ROOT_DIR . '/app/theme/' . $themeId,
            Kendo_ROOT_DIR . '/static/theme/' . $themeId

        ];

        $filesystem->buildCompress($destination, $paths);

        return $destination;
    }

    /**
     *
     */
    public function install()
    {
        $filename = Kendo_ROOT_DIR . '/app/theme/' . $themeId . '/package.json';
        $this->finalData = json_decode(file_get_contents($filename), true);

        $this->beforeInstall();
        $this->doInstall();
        $this->afterInstall();
    }

    /**
     *
     */
    protected function beforeInstall()
    {

    }

    /**
     *
     */
    protected function doInstall()
    {

    }

    /**
     *
     */
    protected function afterInstall()
    {

    }

    /**
     *
     */
    public function uninstall()
    {

    }

    /**
     *
     */
    public function upgrade()
    {

    }

    /**
     *
     */
    public function enable()
    {

    }

    /**
     *
     */
    public function disable()
    {

    }
}