<?php
namespace Kendo\Vfs;

/**
 * Class SshDriver
 *
 * @package Kendo\Vfs
 */
class SshDriver extends AbstractRemoteDriver
{
    /**
     * @var int
     */
    protected $port = 22;

    /**
     * @var string
     */
    protected $publicKey;

    /**
     * @var string
     */
    protected $privateKey;

    /**
     * @var string
     */
    protected $hostKey;

    /**
     * @var \resource
     */
    protected $_sftpResource;

    /**
     * @var string
     */
    protected $lastError;

    /**
     * SshAdapter constructor.
     *
     * @param array|null $driverConfig
     */
    public function __construct($driverConfig = [])
    {
        if (!extension_loaded('ssh2')) {
            throw new DriverException('Missing extension "ssh2"');
        }

        parent::__construct($driverConfig);
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return array_merge(parent::__sleep(), [
            '_privateKey', '_publicKey', '_hostKey'
        ]);
    }

    /**
     * @return resource
     */
    public function getSftpResource()
    {
        if (null === $this->_sftpResource) {
            $this->_sftpResource = @ssh2_sftp($this->getResource());
            if (null === $this->_sftpResource) {
                throw new DriverException('Unable to get sftp resource');
            }
        }

        return $this->_sftpResource;
    }

    /**
     * @param $publicKey
     *
     * @return $this
     */
    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * @param $privateKey
     *
     * @return $this
     */
    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * @param $hostKey
     *
     * @return $this
     */
    public function setHostKey($hostKey)
    {
        $this->hostKey = $hostKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getHostKey()
    {
        if (null === $this->hostKey) {
            $this->hostKey = 'ssh-rsa';
        }

        return $this->hostKey;
    }


    // Connection

    /**
     * @return $this
     */
    public function connect()
    {
        $publicKey = $this->getPublicKey();
        $privateKey = $this->getPrivateKey();
        $hostKey = $this->getHostKey();

        // Connect with keys
        if (($publicKey && $privateKey && $hostKey)) {
            $resource = @ssh2_connect($this->getHost(), $this->getPort(), [
                'hostkey' => $this->getHostKey(),
            ], [
                'disconnect' => [$this, 'onDisconnect'],
            ]);
        } // Connect without keys
        else {
            $resource = @ssh2_connect($this->getHost(), $this->getPort(), [

            ], [
                'disconnect' => [$this, 'onDisconnect'],
            ]);
        }

        if (!$resource) {
            throw new DriverException(sprintf('Unable to connect to "%s"', $this->getHost()));
        }

        $this->resource = $resource;

        return $this;
    }

    /**
     * @return $this
     */
    public function disconnect()
    {
        if (null !== $this->resource) {
            // @todo do something with the output
            $return = $this->command('exit')
                // Meh
                || true;

            //$return = fclose($this->getResource());
            if (!$return) {
                throw new DriverException('Disconnect failed.');
            }
            $this->resource = null;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function login()
    {
        $username = $this->getUsername();
        $password = $this->getPassword();
        $publicKey = $this->getPublicKey();
        $privateKey = $this->getPrivateKey();
        $hostKey = $this->getHostKey();

        // Auth using keys
        if ($publicKey && $privateKey && $hostKey) {
            $return = @ssh2_auth_pubkey_file($this->getResource(), $username, $publicKey, $privateKey, $password);
        } // Auth using username/password only
        else if ($username && $password) {
            $return = @ssh2_auth_password($this->getResource(), $username, $password);
        } // Auth using none
        else {
            $return = @ssh2_auth_none($this->getResource(), $username);
        }

        // Failure
        if (!$return) {
            throw new DriverException('Login failed.');
        }

        return $this;
    }

    /**
     * @param $command
     *
     * @return string
     */
    public function command($command)
    {
        $stream = @ssh2_exec($this->getResource(), $command);
        if (!$stream) {
            throw new DriverException(sprintf('Unable to execute command "%s"', $command));
        }
        $errorStream = @ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);

        stream_set_blocking($stream, true);
        stream_set_timeout($stream, $this->getTimeout());
        if ($errorStream) {
            stream_set_blocking($errorStream, true);
            stream_set_timeout($errorStream, $this->getTimeout());
        }

        $data = stream_get_contents($stream);
        $error = '';
        if ($errorStream) {
            $error = stream_get_contents($errorStream);
        }

        fclose($stream);
        if ($errorStream) {
            fclose($errorStream);
        }

        $this->lastError = $error;

        return trim($data);
        /*
        if( is_bool($data) ) {
          return $data;
        } else if( '' == ($data = trim($data)) ) {
          return false;
        } else {
          return $data;
        }
         *
         */
    }


    // Events

    /**
     *
     */
    public function onDisconnect()
    {
        // @todo more fun stuff
        throw new DriverException('Disconnected from server');
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

        return file_exists('ssh2.sftp://' . $this->getSftpResource() . $path);
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function isDirectory($path)
    {
        $path = $this->getPath($path);

        return is_dir('ssh2.sftp://' . $this->getSftpResource() . $path);
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function isFile($path)
    {
        $path = $this->getPath($path);

        return is_file('ssh2.sftp://' . $this->getSftpResource() . $path);
    }

    /**
     * @return string
     */
    public function getSystemType()
    {
        if (null === $this->systemType) {
            if (substr($this->printDirectory(), 1, 2) == ':\\') {
                $this->systemType = self::SYSTEM_WINDOW;
            } else {
                $systype = $this->command('uname');
                if (!$systype) {
                    // Shall we throw or just return linux (since it's not windows at least)
                    throw new DriverException(sprintf('Unknown remote system type'));
                    //return self::SYS_LIN;
                }
                $this->systemType = self::processSystemType($systype);
            }
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
        $stat = @ssh2_sftp_stat($this->getSftpResource(), $path);

        // Missing
        if (!$stat) {
            return [
                'name'   => basename($path),
                'path'   => $path,
                'exists' => false,
            ];
        }

        // Get extra
        $type = filetype('ssh2.sftp://' . $this->getSftpResource() . $path);
        $rights = substr(sprintf('%o', fileperms('ssh2.sftp://' . $this->getSftpResource() . $path)), -4);

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
            'atime'      => (isset($stat['atime']) ? $stat['atime'] : null),
            'mtime'      => (isset($stat['mtime']) ? $stat['mtime'] : null),
            'ctime'      => (isset($stat['ctime']) ? $stat['ctime'] : null),

            // Perms
            'rights'     => $rights,
            'readable'   => $this->checkPerms(0x004, $rights, $stat['uid'], $stat['gid']),
            'writable'   => $this->checkPerms(0x002, $rights, $stat['uid'], $stat['gid']),
            'executable' => $this->checkPerms(0x001, $rights, $stat['uid'], $stat['gid']),
            //'readable' => is_readable($path),
            //'writable' => is_writable($path),
            //'executable' => is_executable($path),
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

        $tmpFile = tempnam('/tmp', 'engine_vfs') . basename($sourcePath);

        try {
            $this->get($tmpFile, $sourcePath);
            $this->put($destPath, $tmpFile);

            // Set umask permission
            try {
                $this->mode($destPath, $this->getUmask(0666));
            } catch (Exception $e) {
                // Silence
            }

            $return = true;
        } catch (Exception $e) {
            $return = false;
        }

        @unlink($tmpFile);

        if (!$return) {
            throw new DriverException(sprintf('Unable to copy "%s" to "%s"', $sourcePath, $destPath));
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

        // @todo implement nb?
        $return = @ssh2_scp_recv($this->getResource(), $path, $local);

        // Error
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

        $contents = file_get_contents('ssh2.sftp://' . $this->getSftpResource() . $path);

        if (!$contents) {
            throw new DriverException(sprintf('Unable to get contents of "%s"', $path));
        }

        return $contents;
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

        if (!$this->exists($path)) {
            throw new DriverException(sprintf('Unable to change mode on "%s"; it does not exist', $path));
        }

        $return = $this->command(sprintf('chmod ' . ($recursive ? '-R ' : '') . ' %o %s', self::processMode($mode), escapeshellarg($path)));
        if ('' != $return) {
            throw new DriverException(sprintf('Unable to change mode on "%s" - %s', $path, $return));
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

        $return = @ssh2_sftp_rename($this->getSftpResource(), $oldPath, $newPath);

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
        $directory = dirname($path);

        if (!$this->isDirectory($directory)) {
            $this->makeDirectory($directory, true, 0755);
        }
        $return = @ssh2_scp_send($this->getResource(), $local, $path, $this->getUmask($permission));

        if (!$return) {
            throw new DriverException(sprintf('Unable to put "%s" to "%s"', $local, $path));
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

        $return = file_put_contents('ssh2.sftp://' . $this->getSftpResource() . $path, $data);

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

        $return = @ssh2_sftp_unlink($this->getSftpResource(), $path);

        if (!$return) {
            throw new DriverException(sprintf('Unable to unlink "%s"', $path));
        }

        return true;
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

        if (!$this->isDirectory($directory)) {
            throw new DriverException(sprintf('Unable to change directory to "%s", target is not a directory', $directory));
        }

        $this->basePath = $directory;

        return true;
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
        foreach (scandir('ssh2.sftp://' . $this->getSftpResource() . $directory) as $child) {
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
     * @param string     $directory
     * @param bool|false $recursive
     * @param int        $permission
     *
     * @return bool
     */
    public function makeDirectory($directory, $recursive = false, $permission = 0755)
    {
        $directory = $this->getPath($directory);

        if ($this->isDirectory($directory)) {
            return true;
        }

        $return = @ssh2_sftp_mkdir($this->getSftpResource(), $directory, $this->getUmask($permission), $recursive);

        if (!$return) {
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
            $pwd = $this->command('pwd');
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

        // Normal
        $return = @ssh2_sftp_rmdir($this->getSftpResource(), $directory);

        if (!$return) {
            throw new DriverException(sprintf('Unable to remove directory "%s"', $directory));
        }

        return true;
    }


    // Utility

    /**
     * @return bool|int
     */
    public function getUid()
    {
        if (null === $this->uid) {
            $ret = $this->command('echo $UID');
            if ($ret === '0') {
                $this->uid = 0;
            } else if (!$ret || $ret == '$UID') {
                $this->uid = false;
            } else {
                $this->uid = (int)$ret;
                // Cannot be zero
                if ($this->uid == 0) {
                    $this->uid = false;
                }
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
            $ret = $this->command('echo $GROUPS');
            if ($ret === '0') {
                $this->gid = 0;
            } else if (!$ret || $ret == '$GROUPS') {
                $this->gid = false;
            } else {
                $this->gid = (int)$ret;
                // Cannot be zero
                if ($this->gid == 0) {
                    $this->gid = false;
                }
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
        return new SshObject($this, $path, $mode);
    }
}