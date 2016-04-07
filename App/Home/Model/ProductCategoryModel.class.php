<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/1
 * Time: 22:59
 */

namespace Home\Model;

use Think\Model;

class ProductCategoryModel extends Model{

    /**
     * 获取有层次的栏目分类
     * $parent_id 默认获取一级导航
     * $current_id 当前页面栏目ID
     */
    public function get_category($parent_id = 0, $current_id = '')
    {
        $data = $this->order('sort ASC')->select();
        foreach ($data as $value) {
            if ($value['parent_id'] == $parent_id) {
                $value['url'] = rewrite_url('product_category',$value['cat_id']);
                $value['cur'] = $value['cat_id'] == $current_id ? true : false;

                foreach ($data as $child) {
                    if($child['parent_id'] == $value['cat_id']){
                        $value['child'] = $this->get_category($value['cat_id'],$current_id);
                        break;
                    }
                }
                $category[] = $value;
            }
        }
        return $category;
    }

    /**
     *获取当前类别名称
     */
    public function get_one_category($cat_id=0)
    {
        $map['cat_id'] = $cat_id;
        $result = $this->field('cat_name')->where($map)->find();
        return $result['cat_name'];
    }

}