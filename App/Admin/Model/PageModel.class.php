<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/13
 * Time: 13:55
 */
namespace Admin\Model;

use Think\Model;

class PageModel extends Model{

    /**
     *自动验证
     */
    protected $_validate = array(
        array('page_name','require',-1),
        array('unique_id','/^[a-z0-9-]+$/',-2,self::VALUE_VALIDATE)
    );

    /**
     *单页面无等级分类列表
     * get_page_nolevel() 公共函数
     */
    public function get_page_list()
    {
        $result = $this->order('id ASC')->select();
        return get_page_nolevel($result);
    }

    /**
     *单页面新增写入
     */
    public function insert($page_name, $unique_id, $parent_id, $content, $keywords, $description)
    {
        $data = [
            'unique_id' => $unique_id,
            'parent_id' => $parent_id,
            'page_name' => $page_name,
            'content' => $content,
            'keywords' => $keywords,
            'description' => $description
        ];
        if($this->create($data)){
            return $this->add();
        }else{
            return $this->getError();
        }
    }

    /**
     *查找单一单页面
     */
    public function get_one_page($id)
    {
        $map = [
            'id' => $id
        ];
        return $this->where($map)->find();
    }

    /**
     *单页面总数
     */
    public function page_count()
    {
        return $this->count();
    }

    /**
     *单页面编辑写入
     */
    public function update($id,$page_name, $unique_id, $parent_id, $content, $keywords, $description)
    {
        $data = [
            'id' => $id,
            'unique_id' => $unique_id,
            'parent_id' => $parent_id,
            'page_name' => $page_name,
            'content' => $content,
            'keywords' => $keywords,
            'description' => $description
        ];
        if($this->create($data)){
            return $this->save();
        }else{
            return $this->getError();
        }
    }

    /**
     *单页面删除
     * status = -1 ID为1，则表示系统内容，无法删除
     * status = -2 存在子页面，无法删除
     */
    public function destroy($id)
    {
        if($id == 1) $result['status'] = -1;
        $result['page_name'] = $this->get_one_page($id)['page_name'];
        $is_parent = $this->where('parent_id='.$id)->field('parent_id')->find();
        if($is_parent) $result['status'] = -2;
        if($result['status'] == -2){
            return $result;
        }else{
            $this->delete($id);
            return $result;
        }

    }
}