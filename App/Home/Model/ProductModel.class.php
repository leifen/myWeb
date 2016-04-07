<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/29
 * Time: 14:29
 */

namespace Home\Model;

use Think\Model;

class ProductModel extends Model{

    /**
     *商品列表
     */
    public function get_home_product($module,$config)
    {
        $limit = $config['display']['home_product'];
        $result = $this->where('sort > 0')->order('sort DESC')->limit($limit)->select();
        $result = get_list($module,$result,$config);
        return $result;
    }

    /**
     *查找商品列表
     * $cat_id 当前主类ID
     * $pageSize 分页数
     */
    public function get_product_list($cat_id = 0, $pageSize)
    {
        //查找类别ID
        $ProductCat = M('Product_category');
        $data = $ProductCat->select();
        $cat_child_id = get_child_id($data,$cat_id);
        $cat_id = $cat_child_id . $cat_id;

        //查找商品信息
        $map = [
            'cat_id' => array('in',$cat_id)
        ];
        //
        $result = $this->field('id,name,cat_id,add_time,price,content,image,description')
                       ->where($map)
                       ->page($_GET['p'],$pageSize)
                       ->order('id DESC')
                       ->select();
        foreach ($result as $key=>$value) {
            $img = explode('.',basename($value['image']));
            $value['thumb'] = __ROOT__.'/' . C('PRODUCT_UPLOAD') . 'thumb_' .$img[0] . '.' .$img[1];
            $value['description'] = $value['description']  ? mb_substr($value['description'],0,45,'utf-8') : mb_substr($value['content'],0,45,'utf-8');
            $value['description'] = htmlspecialchars_decode($value['description']);
            $value['url'] = rewrite_url('product',$value['id']);
            $product_list[] = $value;
        }
        return $product_list;
    }

    /**
     *获取当前类别下商品总数
     */
    public function get_count($cat_id = 0)
    {
        //查找类别ID
        $ProductCat = M('Product_category');
        $data = $ProductCat->select();
        $cat_child_id = get_child_id($data,$cat_id);
        $cat_id = $cat_child_id . $cat_id;

        //查找商品信息
        $map = [
            'cat_id' => array('in',$cat_id)
        ];
        return $this->where($map)->count();
    }

    /**
     *获取单一产品信息
     * $id 当前产品ID
     * $config 系统配置信息
     */
    public function get_one_product($id, $config)
    {
        $map['id'] = $id;
        $data = $this->where($map)->find();
        $data['price'] = price_format($data['price'],$config);
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