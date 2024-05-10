<?php
use think\Db;
if (!function_exists('db')) {
    /**
     * 实例化数据库类
     * @param string        $name 操作的数据表名称（不含前缀）
     * @param array|string  $config 数据库配置参数
     * @param bool          $force 是否强制重新连接
     * @return \think\db\Query
     */
    function db($name = '', $config = [], $force = false)
    {
        return Db::connect($config, $force)->name($name);
    }
}

if (!function_exists('colony_server')) {
    /**
     * 获取集群服务
     * @param $service_id
     * @return array
     */
    function colony_server($service_id)
    {
        $service = \think\Cache::store('redis')->get('colony_server:'.$service_id);

        if (empty($redisService) && !in_array($service['host'],COLONY_HOST)){
            $whost = parse_url(whost);
            $service = [
                'host'=>$whost['host'],
                'ahost'=> 'http://'.$whost['host'],
                'wport'=>wport,
                'aport'=>aport
            ];
            $colonyHostCount = count(COLONY_HOST);
            if ($colonyHostCount == 0) return $service;
            //根据$service_id 取模
            $mold = (int)$service_id % $colonyHostCount;
            $service = [
                'host'=> COLONY_HOST[$mold]?:$whost['host'],
                'ahost'=> 'http://'. COLONY_HOST[$mold]?:$whost['host'],
                'wport'=>COLONY_WPORT[$mold]?:wport,
                'aport'=>COLONY_APORT[$mold]?:aport,
            ];
            \think\Cache::store('redis')->set('colony_server:'.$service_id,$service);
        }
        return $service;
    }
}