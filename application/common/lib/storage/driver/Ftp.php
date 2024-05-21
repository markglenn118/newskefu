<?php
/**
 * @copyright ©2024 AI在线客服系统
 * Created by PhpStorm.
 */
namespace app\common\lib\storage\driver;

use app\common\lib\storage\Driver;
use app\common\lib\storage\StorageException;

class Ftp extends Driver
{
    protected $conn = null;
    protected $domain = '';
    protected $base_root = null;

    /**
     * @throws \app\common\lib\storage\StorageException
     */
    public function __construct($options = [])
    {
        $this->conn = ftp_connect($options['path'], $options['port']);
        if(!$this->conn) {
            throw new StorageException('连接FTP服务器失败');
        }
        $login = ftp_login($this->conn, $options['username'], $options['password']);
        if(!$login) {
            throw new StorageException('FTP服务器登录失败');
        }
        $this->domain = $options['domain'];
        $basename = request()->root();
        if (pathinfo($basename, PATHINFO_EXTENSION) == 'php') {
            $basename = dirname($basename);
        }
        $this->base_root = $basename;
        parent::__construct();
    }

    public function put()
    {
        $filePath = ROOT_PATH."public".$this->saveFileFolder;
        $info = $this->file->move($filePath,date("YmdHis").uniqid());
        if ($info) {
            $imgname = $info->getSaveName();
            $imgpath = $filePath."/" . $imgname;
        } else {
            throw new StorageException('上传失败');
        }

        if(ftp_put($this->conn, "/upload/".$imgname, $imgpath, FTP_IMAGE)) {
            $this->url = $this->domain."upload/".$imgname;
            $this->thumbUrl = $this->url;
        } else {
            throw new StorageException('上传失败');
        }
        return $this->save();
    }
}
