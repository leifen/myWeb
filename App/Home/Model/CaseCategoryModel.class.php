<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/1
 * Time: 22:59
 */

namespace Home\Model;

use Think\Model;

class CaseCategoryModel extends Model{

    public function get_category($parent_id = 0, $current_id = '')
    {
        $data = $this->order('sort ASC')->select();
        foreach ($data as $value) {
            if ($value['parent_id'] == $parent_id) {
                $value['url'] = rewrite_url('case_category',$value['cat_id']);
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

    public function get_one_category($cat_id=0)
    {
        $map['cat_id'] = $cat_id;
        $result = $this->field('cat_name')->where($map)->find();
        return $result['cat_name'];
    }

}