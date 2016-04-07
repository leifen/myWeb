<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/24
 * Time: 16:59
 */
namespace Admin\Model;

use Think\Model\RelationModel;

class ProjectModel extends RelationModel{

    //自动验证
    protected $_validate = array(
        array('title','require',-1,self::EXISTS_VALIDATE)
    );

    //关联查询
    protected $_link = array(
        'cat_name' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'project_category',
            'foreign_key' => 'cat_id',
            'mapping_fields' => 'cat_name'
        )
    );

    /**
     *方案新增
     */
    public function insert($title, $cat_id, $defined, $content, $keywords, $description, $image)
    {
        $data = [
            'title' => $title,
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

    /**
     *查找单一方案
     */
    public function get_one_project($id)
    {
        $map = [
            'id' => $id
        ];
        return $this->where($map)->find();
    }

    /**
     *方案修改
     */
    public function update($id, $title, $cat_id, $defined, $content, $image, $keywords, $description, $file)
    {
        $thumbImage = $file ? $file : $image;
        $data = [
            'id' => $id,
            'title' => $title,
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

    /**
     *方案删除
     */
    public function destroy($id=null)
    {
        $result = $this->get_one_project($id);
        $this->delete($id);
        unlink_old_image($result['image']);
        return $result;
    }

    /**
     *获取方案总条数
     */
    public function project_count()
    {
        return $this->count();
    }

    /**
     *查找方案列表
     */
    public function get_project_list($cat_id,$keyword,$pageSize=0)
    {
        //查找类别ID
        $ProjectCat = M('Project_category');
        $data = $ProjectCat->select();
        $cat_child_id = get_child_id($data,$cat_id);
        $cat_id = $cat_child_id . $cat_id;


        //查找方案信息
        $map = [
            'title' => array('like',array("%$keyword%")),
            'cat_id' => array('in',$cat_id),
            '_logic' => 'AND'
        ];
        $result = $this->relation(true)-> field('id,title,cat_id,add_time,image')
                                        ->where($map)
                                        ->page($_GET['p'],$pageSize)
                                        ->order('id DESC')
                                        ->select();
        return $result;
    }

    /**
     *批量删除
     */
    public function del_project_all($arr_id)
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
            unlink_old_image($value['image'],C('PROJECT_UPLOAD'));
            $this->delete($value['id']);
        }
        return $result;
    }

    /**
     *批量移动方案
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