<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/29
 * Time: 14:31
 */

namespace Home\Model;

use Think\Model;

class ProjectModel extends Model{

    /**
     *方案列表
     */
    public function get_home_article($module,$config)
    {
        $limit = $config['display']['home_article'];
        $result = $this->where('sort > 0')->order('sort DESC')->limit($limit)->select();
        $result = get_list($module,$result,$config);
        return $result;
    }

    /**
     * 查找方案列表
     * $cat_id 当前主类ID
     * $pageSize 分页数
     */
    public function get_project_list($cat_id = 0, $pageSize)
    {
        //查找类别ID
        $ProjectCat = M('Project_category');
        $data = $ProjectCat->select();
        $cat_child_id = get_child_id($data,$cat_id);
        $cat_id = $cat_child_id . $cat_id;

        //查找方案信息
        $map = [
            'cat_id' => array('in',$cat_id)
        ];
        //
        $result = $this->field('id, title, content, image, cat_id, add_time, click, description')
                        ->where($map)
                        ->page($_GET['p'],$pageSize)
                        ->order('id DESC')
                        ->select();
        foreach ($result as $key=>$value) {
            $value['description'] = $value['description']  ? mb_substr($value['description'],0,90,'utf-8') : mb_substr($value['content'],0,90,'utf-8');
            $value['description'] = htmlspecialchars_decode($value['description']);
            $value['url'] = rewrite_url('project',$value['id']);
            $project_list[] = $value;
        }
        return $project_list;
    }

    /**
     *获取当前类别下方案总数
     */
    public function get_count($cat_id = 0)
    {
        //查找类别ID
        $ArticleCat = M('Article_category');
        $data = $ArticleCat->select();
        $cat_child_id = get_child_id($data,$cat_id);
        $cat_id = $cat_child_id . $cat_id;

        //查找方案信息
        $map = [
            'cat_id' => array('in',$cat_id)
        ];
        return $this->where($map)->count();
    }

    /**
     *获取单一方案信息
     * $id 当前文章ID
     */
    public function get_one_project($id)
    {
        $map['id'] = $id;
        $this->where($map)->setInc('click');    //更新点击量
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

    /**
     * 返回上一篇，下一篇文章
     * $id 当前文章ID
     */
    public function get_pre_next($id)
    {
        $pre['id'] = array('lt',$id);     //上一篇
        $next['id'] = array('gt',$id);    //下一篇
        $data['pre'] = $this->where($pre)->field('id,title')->order('id DESC')->find();
        $data['pre']['url'] = rewrite_url('project',$data['pre']['id']);
        $data['next'] = $this->where($next)->field('id,title')->order('id ASC')->find();
        $data['next']['url'] = rewrite_url('project',$data['next']['id']);
        return $data;
    }
}