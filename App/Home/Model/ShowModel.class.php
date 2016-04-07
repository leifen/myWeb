<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/28
 * Time: 22:42
 */

namespace Home\Model;

use Think\Model;

class ShowModel extends Model{

    /**
     *首页幻灯片列表
     */
    public function get_show_list()
    {
        $result = $this->where(array('type'=>'pc'))->order(array('sort'=>'ASC','id'=>'ASC'))->select();
        $result = show_list($result);
        return $result;
    }
}