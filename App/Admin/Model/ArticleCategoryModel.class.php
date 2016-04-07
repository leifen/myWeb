<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/24
 * Time: 16:33
 */
namespace Admin\Model;

use Think\Model;

class ArticleCategoryModel extends Model{

    protected $_validate = array(
        array('cat_name','require',-1),
        array('unique_id','/^[a-z0-9-]+$/',-2,self::VALUE_VALIDATE)
    );

    /**
     *文章分类列表
     */
    public function get_category_list()
    {
        $result = $this->order('sort ASC')->select();
        $result = get_category_nolevel($result);
        return $result;
    }

    public function insert($cat_name,$unique_id,$parent_id,$keywords,$description,$sort)
    {
        $data = [
            'cat_name' => $cat_name,
            'unique_id' => $unique_id,
            'parent_id' => $parent_id,
            'keywords' => $keywords,
            'description' => $description,
            'sort' => $sort
        ];
        if($this->create($data)){
            return $this->add();
        }else{
            return $this->getError();
        }
    }

    public function get_one_category($cat_id)
    {
        $map = [
            'cat_id' => $cat_id
        ];
        return $this->where($map)->find();
    }

    public function update($cat_id,$cat_name,$unique_id,$parent_id,$keywords,$description,$sort)
    {
        $data = [
            'cat_id' => $cat_id,
            'cat_name' => $cat_name,
            'unique_id' => $unique_id,
            'parent_id' => $parent_id,
            'keywords' => $keywords,
            'description' => $description,
            'sort' => $sort
        ];
        if($this->create($data)){
            return $this->save();
        }else{
            return $this->getError();
        }
    }

    public function destroy($cat_id)
    {
        $result['cat_name'] = $this->get_one_category($cat_id)['cat_name'];
        $is_parent = $this->where('parent_id='.$cat_id)->field('cat_id')->find();
        $is_parent_other = $this->table('__ARTICLE__')->where('cat_id='.$cat_id)->field()->find();

        if($is_parent || $is_parent_other) $result['status'] = -2;
        if($result['status'] == -2){
            return $result;
        }else{
            $this->delete($cat_id);
            return $result;
        }
    }


}