<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/29
 * Time: 20:01
 */

namespace Home\Model;

use Think\Model;

class PageModel extends Model{

    /**
     *获取首页公司信息
     */
    public function get_about_page()
    {
        $map['id'] = 1;
        $result = $this->where($map)->find();
        $result['url'] = rewrite_url('page',$result['id']);
        $result['content'] = mb_substr(htmlspecialchars_decode($result['content']),0,1010,'utf-8');
        return $result;
    }

    /**
     *查找当前单页面信息
     */
    public function get_page_info($id)
    {
        $map['id'] = $id;
        $result = $this->where($map)->find();
        $result['url'] = rewrite_url('page',$result['id']);
        $result['content'] = htmlspecialchars_decode($result['content']);
        return $result;
    }

    /**
     * 获取指定分类单页面列表
     * $parent_id 调用该ID下的所有单页面，为空时则调用所有
     * $current_id 当前打开的单页面ID，高亮菜单使用
     */
    public function get_page_list($parent_id, $current_id){
        $data = $this->select();
        foreach ($data as $value) {
            if($value['parent_id'] == $parent_id) {
                $value['url'] = rewrite_url('page', $value['id']);
                $value['cur'] = $value['id'] == $current_id ? true : false;

                foreach ($data as $child) {
                    // 筛选下级单页面
                    if ($child['parent_id'] == $value['id']) {
                        // 嵌套函数获取子分类
                        $value['child'] = $this->get_page_list($value['id'], $current_id);
                        break;
                    }
                }
                $page_list[] = $value;
            }
        }
        return $page_list;
    }

}