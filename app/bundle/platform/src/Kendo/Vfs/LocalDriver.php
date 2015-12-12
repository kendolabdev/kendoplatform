<?php
namespace Kendo\Vfs;
/**
 * Class LocalAdapter
 *
 * @package Kendo\Vfs
 */
class LocalDriver extends AbstractDriver
{
    /**
     * LocalAdapter constructor.
     *
     * @param array|null $driverConfig
     */
    public function __construct($driverConfig = [])
    {
        parent::__construct($driverConfig);
        $this->directorySeparator = DIRECTORY_SEPARATOR;
    }

    /**
     * @return LocalDriver
     */
    public function getResource()
    {
        return $this;
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function exists($path)
    {
        $path = $this->getPath($path);

        return file_exists($path);
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function isDirectory($path)
    {
        $path = $this->getPath($path);

        return is_dir($path);
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function isFile($path)
    {
        $path = $this->getPath($path);

        return is_file($path);
    }

    /**
     * @return mixed
     */
    public function getSystemType()
    {
        if (null === $this->systemType) {
            $systype = php_uname('s');
            $this->systemType = self::processSystemType($systype);
        }

        return $this->systemType;
    }

    /**
     * @param $path
     *
     * @return array
     */
    public function stat($path)
    {
        $path = $this->getPath($path);
        $stat = stat($path);

        // Missing
        if (!$stat) {
            return [
                'name'   => basename($path),
                'path'   => $path,
                'exists' => false,
            ];
        }

        // Get extra
        $type = filetype($path);
        $rights = substr(sprintf('%o', fileperms($path)), -4);

        // Process stat
        $info = [
            // General
            'name'       => basename($path),
            'path'       => $path,
            'exists'     => true,
            'type'       => $type,

            // Stat
            'uid'        => $stat['uid'],
            'gid'        => $stat['gid'],
            'size'       => $stat['size'],
            'atime'      => $stat['atime'],
            'mtime'      => $stat['mtime'],
            'ctime'      => $stat['ctime'],

            // Perms
            'rights'     => $rights,
            'readable'   => is_readable($path),
            'writable'   => is_writable($path),
            'executable' => is_executable($path),
        ];

        return $info;
    }


    // General

    /**
     * @param $sourcePath
     * @param $destPath
     *
     * @return bool
     */
    public function copy($sourcePath, $destPath)
    {
        $sourcePath = $this->getPath($sourcePath);
        $destPath = $this->getPath($destPath);

        $return = @copy($sourcePath, $destPath);

        if (!$return) {
            throw new DriverException(sprintf('Unable to copy "%s" to "%s"', $sourcePath, $destPath));
        }

        return $return;
    }

    /**
     * @param $local
     * @param $path
     *
     * @return bool
     */
    public function get($local, $path)
    {
        $path = $this->getPath($path);

        $return = @copy($path, $local);

        if (!$return) {
            throw new DriverException(sprintf('Unable to get "%s" to "%s"', $path, $local));
        }

        return $return;
    }

    /**
     * @param $path
     *
     * @return string
     */
    public function getContents($path)
    {
        $path = $this->getPath($path);

        $return = @file_get_contents($path);

        if (false === $return) {
            throw new DriverException(sprintf('Unable to get contents of "%s"', $path));
        }

        return $return;
    }

    /**
     * @param            $path
     * @param            $mode
     * @param bool|false $recursive
     *
     * @return bool
     */
    public function mode($path, $mode, $recursive = false)
    {
        $path = $this->getPath($path);

        $return = @chmod($path, self::processMode($mode));

        if (!$return) {
            throw new DriverException(sprintf('Unable to change mode on "%s"', $path));
        }

        if ($recursive) {
            $info = $this->info($path);
            if ($info->isDirectory()) {
                foreach ($info->getChildren() as $child) {
                    $return &= $this->mode($child->getPath(), $mode, true);
                }
            }
        }

        return $return;
    }

    /**
     * @param $oldPath
     * @param $newPath
     *
     * @return bool
     */
    public function move($oldPath, $newPath)
    {
        $oldPath = $this->getPath($oldPath);
        $newPath = $this->getPath($newPath);

        $return = @rename($oldPath, $newPath);

        if (!$return) {
            throw new DriverException(sprintf('Unable to rename "%s" to "%s"', $oldPath, $newPath));
        }

        return $return;
    }

    /**
     * @param string $path
     * @param string $local
     * @param int    $permission
     *
     * @return bool
     */
    public function put($path, $local, $permission = 0666)
    {
        $path = $this->getPath($path);

        $directory = dirname($path);

        if (!$this->isDirectory($directory)) {
            $this->makeDirectory($directory, 1, 0755);
        }

        $return = @copy($local, $path);

        if (!$return) {
            throw new DriverException(sprintf('Unable to put "%s" to "%s"', $local, $path));
        }

        // Apply umask
        try {
            $this->mode($path, $this->getUmask($permission));
        } catch (Exception $e) {
            // Silence
        }

        return $return;
    }

    /**
     * @param $path
     * @param $data
     *
     * @return int
     */
    public function putContents($path, $data)
    {
        $path = $this->getPath($path);

        $return = @file_put_contents($path, $data);

        if (false === $return) {
            throw new DriverException(sprintf('Unable to put contents to "%s"', $path));
        }

        // Apply umask
        try {
            $this->mode($path, $this->getUmask(0666));
        } catch (Exception $e) {
            // Silence
        }

        return $return;
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function unlink($path)
    {
        $path = $this->getPath($path);

        $return = @unlink($path);

        if (false === $return) {
            throw new DriverException(sprintf('Unable to unlink "%s"', $path));
        }

        return $return;
    }


    // Directories

    /**
     * @param $directory
     *
     * @return bool
     */
    public function changeDirectory($directory)
    {
        $directory = $this->getPath($directory);

        if ($this->isDirectory($directory)) {
            $this->basePath = rtrim($directory, '/\\');

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param            $directory
     * @param bool|false $details
     *
     * @return array
     */
    public function listDirectory($directory, $details = false)
    {
        $directory = $this->getPath($directory);

        $children = [];
        foreach (scandir($directory) as $child) {
            if ($child == '.' || $child == '..') continue;
            if ($details) {
                $children[] = $this->stat($directory . $this->directorySeparator . $child);
            } else {
                $children[] = $this->getPath($directory . $this->directorySeparator . $child);
            }
        }

        return $children;
    }

    /**
     * @param string         $directory
     * @param bool|false     $recursive
     * @param            int $permission
     *
     * @return bool
     */
    public function makeDirectory($directory, $recursive = false, $permission = 0755)
    {
        $directory = $this->getPath($directory);

        if ($this->isDirectory($directory)) {
            return true;
        }

        $return = @mkdir($directory, $this->getUmask($permission), $recursive);

        if (false === $return) {
            throw new DriverException(sprintf('Unable to make directory "%s"', $directory));
        }

        return $return;
    }

    /**
     * @return string
     */
    public function printDirectory()
    {
        if (null === $this->basePath) {
            $this->basePath = getcwd();
        }

        return $this->basePath;
    }

    /**
     * @param            $directory
     * @param bool|false $recursive
     *
     * @return bool
     */
    public function removeDirectory($directory, $recursive = false)
    {
        $directory = $this->getPath($directory);

        // Recursive
        if ($recursive) {
            $return = true;

            // Iterate over contents
            $it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::KEY_AS_PATHNAME), \RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($it as $key => $child) {
                if ($child->getFilename() == '..' || $child->getFilename() == '.') continue;
                if ($child->isDir()) {
                    $return &= $this->removeDirectory($child->getPathname(), false);
                } else if ($it->isFile()) {
                    $return = $this->unlink($child->getPathname(), false);
                }
            }
            $return = $this->removeDirectory($directory, false);
        } // Normal
        else {
            $return = @rmdir($directory);
        }

        if (false === $return) {
            throw new DriverException(sprintf('Unable to remove directory "%s"', $directory));
        }

        return $return;
    }


    // User

    /**
     * @return bool|int
     */
    public function getUid()
    {
        if (null === $this->uid) {
            if (function_exists('posix_getuid')) {
                $this->uid = posix_getuid();
            } else {
                // Find another way to do it?
                $this->uid = false;
            }
        }

        return $this->uid;
    }

    /**
     * @return bool|int
     */
    public function getGid()
    {
        if (null === $this->gid) {
            if (function_exists('posix_getgid')) {
                $this->gid = posix_getgid();
            } else {
                // Find another way to do it?
                $this->gid = false;
            }
        }

        return $this->gid;
    }

    /**
     * @param string $path
     * @param string $mode
     *
     * @return ObjectInterface
     */
    public function object($path, $mode = 'r')
    {
        return new LocalObject($this, $path, $mode);
    }
}