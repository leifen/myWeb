<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/24
 * Time: 22:38
 */
namespace Admin\Model;

use Think\Model;

class NavModel extends Model{

    //自动验证
    protected $_validate = array(
        array('nav_name','require',-1)
    );

    /**
     *导航分类列表
     */
    public function get_nav_list($type = 'middle')
    {
        $map['type'] = $type;
        $result = $this->order('sort ASC')->select();
        $result = get_nav($result,$type);
        return $result;
    }

    public function insert($nav_menu,$nav_name,$type,$guide,$parent_id,$sort)
{
    $nav_menu = explode(',',$nav_menu);
    $module = $nav_menu[0];
    $guide = $module == 'nav' ? $guide : $nav_menu[1];

    $data = [
        'module' => $module,
        'nav_name' => $nav_name,
        'guide' => $guide,
        'parent_id' => $parent_id,
        'type' => $type,
        'sort' => $sort
    ];
    if($this->create($data)){
        return $this->add();
    }else{
        return $this->getError();
    }
}

    public function update($id,$nav_menu,$nav_name,$type,$guide,$parent_id,$sort)
    {
        $nav_menu = explode(',',$nav_menu);
        $module = $nav_menu[0];
        $guide = $module == 'nav' ? $guide : $nav_menu[1];

        $data = [
            'id' => $id,
            'module' => $module,
            'nav_name' => $nav_name,
            'guide' => $guide,
            'parent_id' => $parent_id,
            'type' => $type,
            'sort' => $sort
        ];
        if($this->create($data)){
            return $this->save();
        }else{
            return $this->getError();
        }
    }

    public function get_one_nav($id)
    {
        $map['id'] = $id;
        $result = $this->where($map)->find();
        $result['url'] = $result['module'] == 'nav' ? $result['guide'] : rewrite_url($result['module'],$result['guide']);
        return $result;
    }

    public function destroy($id)
    {
        $result['nav_name'] = $this->get_one_nav($id)['nav_name'];
        $is_parent = $this->where('parent_id='.$id)->field('id')->find();


        if($is_parent) $result['status'] = -2;

        if($result['status'] == -2){
            return $result;
        }else{
            $this->delete($id);
            return $result;
        }
    }


}