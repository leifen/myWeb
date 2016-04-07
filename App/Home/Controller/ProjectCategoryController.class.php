<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/2
 * Time: 16:09
 */

namespace Home\Controller;

class ProjectCategoryController extends BasicController{

    public function index($id=0)
    {
        $Nav = D('Nav');
        $ProjectCat = D('Project_category');
        $Project = D('Project');

        $this->page($Project->get_count($id),$this->config['display']['article']);   //加载分页
        $this->assign('nav_top_list', $Nav->get_nav_list('top'));
        $this->assign('nav_middle_list', $Nav->get_nav_list('middle', '0', 'project_category', $id));
        $this->assign('nav_bottom_list', $Nav->get_nav_list('bottom'));

        $this->assign('project_category',$ProjectCat->get_category(0,$id));
        $this->assign('project_list',$Project->get_project_list($id,$this->config['display']['article']));
        $this->assign('ur_here',$ProjectCat->get_one_category($id));
        $this->display();
    }

}