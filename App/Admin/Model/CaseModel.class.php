<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/20
 * Time: 15:36
 */

namespace Admin\Model;

use Think\Model\RelationModel;

class CaseModel extends RelationModel{

    //自动验证
    protected $_validate = array(
        array('name','require',-1,self::EXISTS_VALIDATE)
    );
    //关联查询
    protected $_link = array(
        'cat_name' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'case_category',
            'foreign_key' => 'cat_id',
            'mapping_fields' => 'cat_name'
        )
    );

    public function get_case_list($cat_id=null,$keyword=null,$pageSize=0)
    {
        //查找类别ID
        $CaseCat = M('Case_category');
        $data = $CaseCat->select();
        $cat_child_id = get_child_id($data,$cat_id);
        $cat_id = $cat_child_id . $cat_id;


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

    public function get_case_all()
    {
        return $this->field('id,image')->select();
    }

    public function case_count()
    {
        return $this->count();
    }

    public function insert($name, $cat_id, $defined, $content, $keywords, $description, $image)
    {
        $defined = str_replace("\r\n", ',', $defined);
        $data = [
            'name' => $name,
            'cat_id' => $cat_id,
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

    public function get_one_case($id)
    {
        $map = [
          'id' => $id
        ];
        return $this->where($map)->find();
    }

    public function update($id, $name, $cat_id, $defined, $content, $image, $keywords, $description, $file)
    {
        $thumbImage = $file ? $file : $image;
        $defined = str_replace("\r\n", ',', $defined);
        $data = [
            'id' => $id,
            'name' => $name,
            'cat_id' => $cat_id,
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

    public function destroy($id=null)
    {
        $result = $this->get_one_case($id);
        $this->delete($id);
        unlink_old_image($result['image'],C('CASE_UPLOAD'));
        return $result;
    }

    public function del_case_all($arr_id)
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
            unlink_old_image($value['image'],C('CASE_UPLOAD'));
            $this->delete($value['id']);
        }
        return $result;
    }

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