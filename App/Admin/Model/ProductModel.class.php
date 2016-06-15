<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/20
 * Time: 15:36
 */

namespace Admin\Model;

use Think\Model\RelationModel;

class ProductModel extends RelationModel{

    //自动验证
    protected $_validate = array(
        array('name','require',-1,self::EXISTS_VALIDATE),
        array('price','/^[0-9.]+$/',-2,self::VALUE_VALIDATE)
    );
    //关联查询
    protected $_link = array(
        'cat_name' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'product_category',
            'foreign_key' => 'cat_id',
            'mapping_fields' => 'cat_name'
        )
    );

    /**
     *查找商品列表
     */
    public function get_product_list($cat_id=null,$keyword=null,$pageSize=0)
    {
        //查找类别ID
        $ProductCat = M('ProductCategory');
        $data = $ProductCat->select();
        $cat_child_id = get_child_id($data,$cat_id);
        $cat_id = $cat_child_id . $cat_id;

        //查找商品信息
        $map = [
            'name' => array('like',array("%$keyword%")),
            'cat_id' => array('in',$cat_id),
            '_logic' => 'AND'
        ];
        $result = $this->relation(true)->
                        field('id,name,cat_id,add_time')
                        ->where($map)
                        ->page($_GET['p'],$pageSize)
                        ->order('id DESC')
                        ->select();
        return $result;
    }

    /**
     *返回所有商品
     */
    public function get_product_all()
    {
        return $this->field('id,image')->select();
    }

    /**
     *获取商品总条数
     */
    public function product_count()
    {
        return $this->count();
    }

    /**
     *获取首页显示商品
     */
    public function get_sort_product($limit)
    {
        $result = $this->where('sort > 0')->field('id,name,image')->order('sort DESC')->limit($limit)->select();
        return $result;
    }

    /**
     *首页商品显示设置
     */
    public function set_sort($id=null)
    {
        $max_sort = $this->field('sort')->order('sort DESC')->find()['sort'];
        $data = [
            'id' => $id,
            'sort' => $max_sort + 1
        ];
        $this->save($data);
    }

    /**
     *首页商品显示取消
     */
    public function del_sort($id=null)
    {
        $data = [
            'id' => $id,
            'sort' => null
        ];
        $this->save($data);
    }

    /**
     *商品新增
     */
    public function insert($name, $cat_id, $price, $defined, $content, $keywords, $description, $image)
    {
        $defined = str_replace("\r\n", ',', $defined);
        $data = [
            'name' => $name,
            'cat_id' => $cat_id,
            'price' => $price,
            'defined' => $defined,
            'content' => $content,
            'keywords' => $keywords,
            'description' => $description,
            'image' => $image,
            'add_time' => time()
        ];
        if($this->create($data)){
            return $this->add();
        }else{
            return $this->getError();
        }
    }

    /**
     *查找单一商品
     */
    public function get_one_product($id)
    {
        $map = [
          'id' => $id
        ];
        return $this->where($map)->find();
    }

    /**
     *商品修改
     */
    public function update($id, $name, $cat_id, $price, $defined, $content, $image, $keywords, $description, $file)
    {
        $thumbImage = $file ? $file : $image;
        $defined = str_replace("\r\n", ',', $defined);
        $data = [
            'id' => $id,
            'name' => $name,
            'cat_id' => $cat_id,
            'price' => $price,
            'defined' => $defined,
            'content' => $content,
            'keywords' => $keywords,
            'description' => $description,
            'image' => $thumbImage,
            'add_time' => time()
        ];
        if($this->create($data)){
            return $this->save();
        }else{
            return $this->getError();
        }
    }

    /**
     *商品删除
     */
    public function destroy($id=null)
    {
        $result = $this->get_one_product($id);
        $this->delete($id);
        unlink_old_image($result['image'],C('PRODUCT_UPLOAD'));
        return $result;
    }

    /**
     *批量删除
     */
    public function del_product_all($arr_id)
    {
        $del_id = '';
        foreach($arr_id as $value){
            $del_id .= $value .',';
        }
        $del_id = substr($del_id,0,-1);
        $result = " IN ( $del_id )";
        $map = [
            'id' => array('IN',$del_id)
        ];
        $data = $this->field('id,image')->where($map)->select();
        foreach($data as $value){
            unlink_old_image($value['image'],C('PRODUCT_UPLOAD'));
            $this->delete($value['id']);
        }
        return $result;
    }

    /**
     *批量移动商品
     */
    public function category_move($arr_id, $new_cat_id)
    {
        $move_id = '';
        foreach($arr_id as $value){
            $move_id .= $value .',';
            $map['id'] = $value;
            $data['cat_id'] = $new_cat_id;
            $this->where($map)->save($data);
        }
        $move_id = substr($move_id,0,-1);
        $result = " IN ( $move_id )";
        return $result;
    }
}