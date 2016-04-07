<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/28
 * Time: 12:49
 */
namespace Home\Model;

use Think\Model;

class NavModel extends Model{

    /**
     * $type 导航类型
     * $parent_id 默认获取一级导航
     * $current_module 当前页面模型名称，用于高亮导航栏
     * $current_id 当前页面栏目ID
     */
    public function get_nav_list($type = 'middle', $parent_id = 0, $current_module = '', $current_id = '', $current_parent_id = '')
    {
        $map['type'] = $type;
        $result = $this->where($map)->order('sort ASC')->select();
        $result = get_home_nav($result,$type,$parent_id,$current_module,$current_id,$current_parent_id);
        return $result;
    }
}