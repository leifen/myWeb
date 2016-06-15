<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/29
 * Time: 14:29
 */

namespace Home\Model;

use Think\Model;

class CaseModel extends Model{

    public function get_case_list($cat_id = 0, $pageSize)
    {
        //查找类别ID
        $CaseCat = M('CaseCategory');
        $data = $CaseCat->select();
        $cat_child_id = get_child_id($data,$cat_id);
        $cat_id = $cat_child_id . $cat_id;

        $map = [
            'cat_id' => array('in',$cat_id)
        ];
        //
        $result = $this->field('id,name,cat_id,add_time,content,image,description')
                       ->where($map)
                       ->page($_GET['p'],$pageSize)
                       ->order('id DESC')
                       ->select();
        foreach ($result as $key=>$value) {
            $img = explode('.',basename($value['image']));
            $value['thumb'] = __ROOT__.'/' . C('CASE_UPLOAD') . 'thumb_' .$img[0] . '.' .$img[1];
            $value['description'] = $value['description']  ? mb_substr($value['description'],0,45,'utf-8') : mb_substr($value['content'],0,45,'utf-8');
            $value['description'] = htmlspecialchars_decode($value['description']);
            $value['url'] = rewrite_url('case',$value['id']);
            $product_list[] = $value;
        }
        return $product_list;
    }

    public function get_count($cat_id = 0)
    {
        //查找类别ID
        $CaseCat = M('CaseCategory');
        $data = $CaseCat->select();
        $cat_child_id = get_child_id($data,$cat_id);
        $cat_id = $cat_child_id . $cat_id;

        $map = [
            'cat_id' => array('in',$cat_id)
        ];
        return $this->where($map)->count();
    }

    public function get_one_case($id, $config)
    {
        $map['id'] = $id;
        $data = $this->where($map)->find();
        $data['content'] = htmlspecialchars_decode($data['content']);
        //格式化自定义参数
        foreach(explode(',',$data['defined']) as $value){
            $temp = explode('：', str_replace(":", "：", $value));
            if($temp[1]){
                $defined[] = array (
                    "arr" => $temp['0'],
                    "value" => $temp['1']
                );
            }
            $data['defined'] = $defined;
        }
        return $data;
    }


}