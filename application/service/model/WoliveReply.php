<?php
/**
 * Created by PhpStorm.
 * User: Andy
 * Date: 2020/4/10
 * Time: 11:21
 */

namespace app\service\model;

use think\Model;

class WoliveReply extends Model
{
    protected $table = 'wolive_reply';

    public static function getList()
    {
        $where = [];
        $limit = input('get.limit');
        $where['service_id'] = $_SESSION['Msg']['service_id'];
        $list = self::order('id', 'desc')->where($where)->paginate($limit);
        return ['code' => 0, 'data' => $list->items(), 'count' => $list->total(), 'limit' => $limit];
    }
}