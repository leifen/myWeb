<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/12
 * Time: 17:57
 */

namespace Admin\Model;

use Think\Model\RelationModel;

class AdminLogModel extends RelationModel{

    protected $_link = array(
        'user_name' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'manager',
            'foreign_key' => 'user_id',
            'mapping_fields' => 'user_name',
        )
    );
    /**
     *操作日志列表
     */
    public function get_log_list($pageSize)
    {
        return $this->relation(true)->order(array('id'=>'DESC'))->page($_GET['p'],$pageSize)->select();
    }

    /**
     *操作日志记录总数
     */
    public function log_count()
    {
        return $this->count();
    }

    /**
     返回当前管理员操作记录
     */
    public function get_user_log($num=0)
    {
        $map['user_id'] = session('auth')['user_id'];
        return $this->where($map)->limit($num)->order('create_time DESC')->select();
    }
}