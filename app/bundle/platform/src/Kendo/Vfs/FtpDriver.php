<?php
namespace Kendo\Vfs;
/**
 * Class FtpAdapter
 *
 * @package Kendo\Vfs
 */
class FtpDriver extends AbstractRemoteDriver
{
    /**
     * @var int
     */
    protected $port = 21;

    /**
     * @var bool
     */
    protected $useSsl = false;

    /**
     * @var array
     */
    protected $lsPatterns;

    /**
     * @var array
     */
    protected $lsMatcher;

    /**
     * FtpAdapter constructor.
     *
     * @param array $driverConfig
     */
    public function __construct($driverConfig = [])
    {
        parent::__construct($driverConfig);

        /**
         * @codeCoverageIgnoreStart
         */
        if (!extension_loaded('ftp')) {
            if (!function_exists('ftp_connect')) { // This should be added by PEAR
                throw new Exception('Missing extension "ftp"');
            }
        }
        $this->directorySeparator = '/';
        $this->lsPatterns = [
            'unix'    => [
                'pattern' => '/(?:(d)|.)([rwxts-]{9})\s+(\w+)\s+([\w\d-()?.]+)\s+' .
                    '([\w\d-()?.]+)\s+(\w+)\s+(\S+\s+\S+\s+\S+)\s+(.+)/',
                'map'     => [
                    'is_dir'       => 1,
                    'rights'       => 2,
                    'files_inside' => 3,
                    'user'         => 4,
                    'group'        => 5,
                    'size'         => 6,
                    'date'         => 7,
                    'name'         => 8,
                ]
            ],
            'windows' => [
                'pattern' => '/([0-9\-]+)\s+([0-9:APM]+)\s+((<DIR>)|\d+)\s+(.+)/',
                'map'     => [
                    'date'   => 1,
                    'time'   => 2,
                    'size'   => 3,
                    'is_dir' => 4,
                    'name'   => 5,
                ]
            ]
        ];


        $this->setUmask($this->getUmask());

        $this->getResource();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array
     */
    public function __sleep()
    {
        return array_merge(parent::__sleep(), [
            '_useSsl', '_lsPatterns', '_lsMatcher'
        ]);
    }

    /**
     * @param $useSsl
     *
     * @return $this
     */
    public function setUseSsl($useSsl)
    {
        $this->useSsl = (bool)$useSsl;

        return $this;
    }

    /**
     * @return bool
     */
    public function getUseSsl()
    {
        return $this->useSsl;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param $filename
     *
     * @return int
     */
    public function getFileMode($filename)
    {
        if (!empty($filename)) ;

        return FTP_BINARY;
    }

    /**
     * @param $umask
     *
     * @return FtpDriver
     */
    public function setUmask($umask)
    {
        parent::setUmask($umask);
        try {
            $this->site('UMASK ' . sprintf('%o', $this->getUmask()));
        } catch (Exception $e) {
        }

        return $this;
    }

    /**
     * @throws Exception
     */
    public function connect()
    {
        $useSsl = $this->getUseSsl();

        if (!$useSsl) {
            $resource = @ftp_connect($this->getHost(), $this->getPort(), $this->getTimeout());
        } else {
            if (!function_exists('ftp_ssl_connect')) {
                throw new Exception(sprintf('Unexepected configuration, Coul not connect FPTS without extension OpenSSL', $this->getHost()));
            } else {
                $resource = ftp_ssl_connect($this->getHost(), $this->getPort(), $this->getTimeout());
            }
        }

        if (!$resource) {
            throw new DriverException(sprintf('Unable to connect to "%s"', $this->getHost()));
        }

        $this->resource = $resource;
    }

    /**
     * @throws Exception
     */
    public function disconnect()
    {
        if (null !== $this->resource) {
            try {
                @ftp_close($this->resource);
            } catch (\Exception $ex) {

            }
            $this->resource = null;
        }
    }

    /**
     * @throws Exception
     */
    public function login()
    {
        // Don't try if no username supplied
        if (null === $this->getUsername()) {
            return $this;
        }

        // Try to login
        $return = @ftp_login($this->getResource(), $this->getUsername(), $this->getPassword());

        if (!$return) {
            throw new Exception('Login failed.');
        }

    }

    /**
     * @param $command
     *
     * @return bool
     */
    public function site($command)
    {
        $ret = @ftp_site($this->getResource(), $command);

        if (!$ret) {
            throw new DriverException(sprintf('Unable to execute SITE command: %s', $command));
        }

        return $ret;
    }


    // Informational

    /**
     * @param $path
     *
     * @return bool
     */
    public function exists($path)
    {
        $path = $this->getPath($path);

        $base = basename($path);
        $parent = dirname($path);

        $return = @ftp_nlist($this->getResource(), $parent);

        if (!$return || !is_array($return) || empty($return) || (!in_array($path, $return) && !in_array($base, $return))) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function isDirectory($path)
    {
        $path = $this->getPath($path);

        $pwd = $this->printDirectory();
        if (!$pwd) {
            $pwd = '/';
        }

        try {
            $isDir = $this->changeDirectory($path, true);
        } catch (Exception $e) {
            $isDir = false;
        }

        // Restore
        $this->changeDirectory($pwd);

        return $isDir;
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function isFile($path)
    {
        return !$this->isDirectory($path);
    }

    /**
     * @return string
     */
    public function getSystemType()
    {
        if (null === $this->systemType) {
            $systype = @ftp_systype($this->getResource());
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

        $stat = null;
        try {
            foreach ($this->listAndParse(dirname($path)) as $child) {
                if ($child['name'] == basename($path)) {
                    $stat = $child;
                    break 1;
                }
            }
        } catch (Exception $e) {
            $stat = null;
        }

        return $this->_formatStat($stat);
    }

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

        $tmpFile = tempnam('/tmp', 'engine_vfs') . basename($sourcePath);

        try {
            $this->get($tmpFile, $sourcePath);
            $this->put($destPath, $tmpFile);
            try {
                $this->mode($destPath, $this->getUmask(0777));
            } catch (\Exception $e) {
            }

            $return = true;
        } catch (Exception $e) {
            $return = false;
        }

        @unlink($tmpFile);

        if (!$return) {
            throw new Exception(sprintf('Unable to copy "%s" to "%s"', $sourcePath, $destPath));
        }

        return true;
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

        $mode = $this->getFileMode($path);

        // Non-blocking mode
        if (@function_exists('ftp_nb_get')) {
            $resource = $this->getResource();
            $res = @ftp_nb_get($resource, $local, $path, $mode);
            while ($res == FTP_MOREDATA) {
                $res = @ftp_nb_continue($resource);
            }
            $return = ($res === FTP_FINISHED);
        } else {
            $return = @ftp_get($this->_handle, $local, $path, $mode);
        }

        if (!$return) {
            throw new DriverException(sprintf('Unable to get "%s" to "%s"', $path, $local));
        }

        return true;
    }

    /**
     * @param $path
     *
     * @return string
     */
    public function getContents($path)
    {
        $path = $this->getPath($path);

        // Create stack buffer
        $stack = $this->openStack();

        if (!$stack) {
            throw new DriverException(sprintf('Unable to create stack buffer'));
        }

        // Get mode
        $mode = $this->getFileMode($path);

        // Non-blocking mode
        if (@function_exists('ftp_nb_fget')) {
            $resource = $this->getResource();
            $res = @ftp_nb_fget($resource, $stack, $path, $mode);
            while ($res == FTP_MOREDATA) {
                //$this->_announce('nb_get');
                $res = @ftp_nb_continue($resource);
            }
            $return = ($res === FTP_FINISHED);
        } // Blocking mode
        else {
            $return = @ftp_fget($this->_handle, $stack, $path, $mode);
        }

        if (!$return) {
            throw new DriverException(sprintf('Unable to get contents of "%s"', $path));
        }

        $data = '';
        while (false != ($dat = fread($stack, 1024))) {
            $data .= $dat;
        }

        return $data;
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

        $return = @ftp_chmod($this->getResource(), self::processMode($mode), $path);

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

        return true;
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

        $return = @ftp_rename($this->getResource(), $oldPath, $newPath);

        if (!$return) {
            throw new DriverException(sprintf('Unable to rename "%s" to "%s"', $oldPath, $newPath));
        }

        return true;
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

        // Directory support
        if (is_dir($local)) {
            throw new DriverException(sprintf('Unable to put "%s" to "%s": directories not supported', $path, $local));
        }

        // Make sure parent exists
        if (!$this->exists(dirname($path))) {
            $this->makeDirectory(dirname($path), true, 0755);
        }

        // Get mode
        $mode = $this->getFileMode($path);

        // Non-blocking mode
        if (@function_exists('ftp_nb_put')) {
            $resource = $this->getResource();
            $res = @ftp_nb_put($resource, $path, $local, $mode);
            while ($res == FTP_MOREDATA) {
                //$this->_announce('nb_put');
                $res = @ftp_nb_continue($resource);
            }
            $return = ($res === FTP_FINISHED);
        } // Blocking mode
        else {
            $return = @ftp_put($this->_handle, $path, $local, $mode);
        }

        // Set umask permission
        try {
            $this->mode($path, $this->getUmask($permission));
        } catch (Exception $e) {
            throw new Exception('Can not change mode for ' . $path);
        }

        if (!$return) {
            throw new DriverException(sprintf('Unable to put "%s" to "%s"', $path, $local));
        }

        return true;
    }

    /**
     * @param $path
     * @param $data
     *
     * @return bool
     */
    public function putContents($path, $data)
    {
        $path = $this->getPath($path);

        // Create stack buffer
        $existed = in_array('stack', stream_get_wrappers());
        if ($existed) {
            stream_wrapper_unregister('stack');
        }

        $stack = $this->openStack();

        if (!$stack) {
            throw new DriverException(sprintf('Unable to create stack buffer'));
        }

        // Write into stack
        $len = 0;
        do {
            $tmp = @fwrite($stack, substr($data, $len));
            $len += $tmp;
        } while (strlen($data) > $len && $tmp != 0);

        // Get mode
        $mode = $this->getFileMode($path);

        // Non-blocking mode
        if (@function_exists('ftp_nb_fput')) {
            $resource = $this->getResource();
            $res = @ftp_nb_fput($resource, $path, $stack, $mode);
            while ($res == FTP_MOREDATA) {
                //$this->_announce('nb_get');
                $res = @ftp_nb_continue($resource);
            }
            $return = ($res === FTP_FINISHED);
        } // Blocking mode
        else {
            $return = @ftp_fput($this->_handle, $path, $stack, $mode);
        }

        // Set umask permission
        try {
            $this->mode($path, $this->getUmask(0666));
        } catch (Exception $e) {
            // Silence
        }

        if (!$return) {
            throw new DriverException(sprintf('Unable to put contents to "%s"', $path));
        }

        return true;
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function unlink($path)
    {
        $path = $this->getPath($path);

        $return = @ftp_delete($this->getResource(), $path);

        if (!$return) {
            throw new DriverException(sprintf('Unable to unlink "%s"', $path));
        }

        return true;
    }

    /**
     * @param string $directory
     * @param bool   $ignoreException
     *
     * @return bool
     */
    public function changeDirectory($directory, $ignoreException = false)
    {
        $directory = $this->getPath($directory);


        // Only set if connected, we can just set it on connect/login
        if (is_resource($this->resource)) {

            $return = @ftp_chdir($this->getResource(), $directory);


            if (!$return) {
                if ($ignoreException) {
                    return false;
                } else {
                    throw new DriverException(sprintf('Unable to change directory to "%s"', $directory));
                }
            }

        }

        $this->basePath = $directory;

        return true;
    }

    /**
     * @param string     $directory
     * @param bool|false $details
     *
     * @return array
     */
    public function listDirectory($directory, $details = false)
    {
        $directory = $this->getPath($directory);

        $children = [];
        foreach ($this->listAndParse($directory) as $child) {
            if ($child['name'] == '.' || $child['name'] == '..') continue;
            $child['path'] = $this->getPath($directory . $this->directorySeparator . $child['name']);
            if ($details) {
                $children[] = $this->_formatStat($child);
            } else {
                $children[] = $child['path']; //$this->path($directory . $this->_directorySeparator . $child);
            }
        }

        return $children;
    }

    /**
     * @param  string    $directory
     * @param bool|false $recursive
     * @param int        $permission
     *
     * @return bool|string
     */
    public function makeDirectory($directory, $recursive = false, $permission = 0755)
    {
        $directory = $this->getPath($directory);


        if ($this->isDirectory($directory, true)) {
            return true;
        }

        if (!$recursive) {

            $return = @ftp_mkdir($this->getResource(), $directory);
            try {
                $this->mode($directory, $this->getUmask($permission));
            } catch (Exception $e) {

            }
            if (!$return) {
                throw new DriverException(sprintf('Unable to make directory "%s"', $directory));
            }

            return $return;
        } else {

            $pPath = '';
            $parts = array_filter(explode($this->getDirectorySeparator(), $directory));
            while (count($parts) > 0) {
                $pPath .= $this->getDirectorySeparator() . array_shift($parts);
                if (!$this->isDirectory($pPath)) {
                    try {
                        $this->makeDirectory($pPath, false);
                    } catch (Exception $e) {
                        throw $e;
                    }
                }
            }

            if (!$this->isDirectory($directory)) {
                throw new DriverException(sprintf('Unable to make directory "%s"', $directory));
            }

            return true;
        }
    }

    /**
     * @return string
     */
    public function printDirectory()
    {
        if (null === $this->basePath) {
            $pwd = @ftp_pwd($this->getResource());
            if (!$pwd) {
                throw new DriverException('Unable to get working directory');
            }
            $this->basePath = $pwd;
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

        if ($recursive) {
            foreach ($this->directory($directory) as $child) {
                if ($child->isDirectory()) {
                    $this->removeDirectory($child->getPath(), true);
                } else {
                    $this->unlink($child->getPath());
                }
            }
        }
        $return = @ftp_rmdir($this->getResource(), $directory);

        if (!$return) {
            throw new DriverException(sprintf('Unable to remove directory "%s"', $directory));
        }

        return true;
    }

    /**
     * @param $directory
     *
     * @return array
     */
    public function listAndParse($directory)
    {
        $directory = $this->getPath($directory);

        $directoryListing = @ftp_rawlist($this->getResource(), $directory);

        if (!is_array($directoryListing)) {
            throw new DriverException(sprintf('Could not list directory "%s"', $directory));
        }

        return $this->parseRawList($directoryListing);
    }

    /**
     * @param $directoryListing
     *
     * @return array
     */
    public function parseRawList($directoryListing)
    {
        if (!is_array($directoryListing)) {
            throw new DriverException('parseRawList only takes an array');
        }

        foreach ($directoryListing as $index => $value) {
            if (strncmp($value, 'total: ', 7) == 0 && preg_match('/total: \d+/', $value)) {
                unset($directoryListing[ $index ]);
                break;
            }
        }

        if (count($directoryListing) == 0) {
            return [];
        }

        if (count($directoryListing) == 1 && $directoryListing[0] == 'total 0') {
            return [];
        }

        if (!isset($this->lsMatcher)) {
            $this->lsMatcher = $this->_determineOsMatch($directoryListing);
        }

        $contents = [];
        foreach ($directoryListing as $entry) {
            if (!preg_match($this->lsMatcher['pattern'], $entry, $m)) {
                continue;
            }
            $entry = [];
            foreach ($this->lsMatcher['map'] as $key => $val) {
                $entry[ $key ] = $m[ $val ];
            }
            $entry['stamp'] = $this->_parseDate($entry['date']);

            $contents[] = $entry;
        }

        return $contents;
    }

    /**
     * @param $directoryListing
     *
     * @return mixed
     */
    protected function _determineOsMatch($directoryListing)
    {
        foreach ($directoryListing as $entry) {
            foreach ($this->lsPatterns as $os => $match) {
                if (preg_match($match['pattern'], $entry)) {
                    return $match;
                }
            }
        }

        throw new DriverException('Unable to determine rawlist regex');
    }

    /**
     * @param $date
     *
     * @return bool|int
     */
    protected function _parseDate($date)
    {
        // Sep 10 22:06 => Sep 10, <year> 22:06
        if (preg_match('/([A-Za-z]+)[ ]+([0-9]+)[ ]+([0-9]+):([0-9]+)/', $date,
            $res)) {
            $year = date('Y');
            $month = $res[1];
            $day = $res[2];
            $hour = $res[3];
            $minute = $res[4];
            $date = "$month $day, $year $hour:$minute";
            $tmpDate = strtotime($date);
            if ($tmpDate > time()) {
                $year--;
                $date = "$month $day, $year $hour:$minute";
            }
        } elseif (preg_match('/^\d\d-\d\d-\d\d/', $date)) {
            // 09-10-04 => 09/10/04
            $date = str_replace('-', '/', $date);
        }
        $res = strtotime($date);
        if (!$res) {
            return false; // throw?
        }

        return $res;
    }

    /**
     * @return bool|int
     */
    public function getUid()
    {
        try {
            if (null === $this->uid) {
                $info = $this->_getPermTestFile();
                if ($info) {
                    $info = $info->getInfo();
                }
                if (!empty($info['uid'])) {
                    $this->uid = $info['uid'];
                }
            }
        } catch (\Exception $ex) {

        }

        if (empty($this->uid)) {
            $this->uid = false;
        }


        return $this->uid;
    }

    /**
     * @return bool|int
     */
    public function getGid()
    {
        try {
            if (null === $this->gid) {
                $info = $this->_getPermTestFile();
                if ($info) {
                    $info = $info->getInfo();
                }
                if (!empty($info['gid'])) {
                    $this->gid = $info['gid'];
                }
            }
        } catch (\Exception $ex) {

        }
        if (empty($this->gid)) {
            $this->gid = false;
        }

        return $this->gid;
    }

    /**
     * @return StandardInfo
     */
    protected function _getPermTestFile()
    {
        // Remove test file
        if ($this->exists('ftppermtestfile')) {
            $this->unlink('ftppermtestfile');
        }

        // Put test file
        $this->putContents('ftppermtestfile', 'null');

        // Get info
        return $this->info('ftppermtestfile');
    }

    /**
     * @param $stat
     *
     * @return array
     */
    protected function _formatStat($stat)
    {
        // Missing
        if (!$stat) {
            return [
                'name'   => basename(@$stat['path']),
                'path'   => @$stat['path'],
                'exists' => false,
            ];
        }

        $statPath = empty($stat['path']) ? '' : $stat['path'];
        $statRight = empty($stat['rights']) ? '' : $stat['rights'];

        $info = [
            'name'   => basename($statPath),
            'path'   => $statPath,
            'exists' => true,
            'uid'    => $stat['user'],
            'gid'    => $stat['group'],
            'size'   => $stat['size'],
            'atime'  => null,
            'mtime'  => null,
            'ctime'  => null,
            'rights' => $statRight,
            'type'   => ($stat['is_dir'] == 'd' ? 'dir' : 'file'),
        ];

        return $info;
    }

    /**
     * @param string $path
     * @param string $mode
     *
     * @return ObjectInterface
     */
    public function object($path, $mode = 'r')
    {
        return new FtpObject($this, $path, $mode);
    }
}