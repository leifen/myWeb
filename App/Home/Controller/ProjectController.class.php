<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/2
 * Time: 16:44
 */

namespace Home\Controller;

class ProjectController extends BasicController{

    public function index($id=0)
    {
        $Nav = D('Nav');
        $ProjectCat = D('ProjectCategory');
        $Project = D('Project');

        $project = $Project->get_one_project($id);

        $this->assign('nav_top_list', $Nav->get_nav_list('top'));
        $this->assign('nav_middle_list', $Nav->get_nav_list('middle', '0', 'project_category', $id));
        $this->assign('nav_bottom_list', $Nav->get_nav_list('bottom'));
        $this->assign('project',$project);
        $this->assign('pre_next',$Project->get_pre_next($id));
        $this->assign('project_category',$ProjectCat->get_category(0,$project['cat_id']));  //高亮当前父类
        $this->assign('ur_here',$project['title']);
        $this->display();
    }
}