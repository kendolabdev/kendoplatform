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
    protected $final = [];

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

    protected function exportLayoutTheme()
    {
        $this->final['info'] = $this->theme->toArray();
    }

    /**
     * Export layout from database
     */
    protected function exporLayout()
    {

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
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * @param array $final
     */
    public function setFinal($final)
    {
        $this->final = $final;
    }

    protected function archive()
    {

        $theme = $this->getTheme();

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