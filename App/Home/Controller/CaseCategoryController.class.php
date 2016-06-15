<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/1
 * Time: 22:31
 */
namespace Home\Controller;

class CaseCategoryController extends BasicController{

    public function index($id=0)
    {
        $Nav = D('Nav');
        $CaseCat = D('CaseCategory');
        $Case = D('Case');

        $this->page($Case->get_count($id),$this->config['display']['product']);   //加载分页
        $this->assign('nav_top_list', $Nav->get_nav_list('top'));
        $this->assign('nav_middle_list', $Nav->get_nav_list('middle', '0', 'case_category', $id));
        $this->assign('nav_bottom_list', $Nav->get_nav_list('bottom'));

        $this->assign('case_category',$CaseCat->get_category(0,$id));
        $this->assign('case_list',$Case->get_case_list($id,$this->config['display']['product']));
        $this->assign('ur_here',$CaseCat->get_one_category($id));
        $this->display();
    }
}