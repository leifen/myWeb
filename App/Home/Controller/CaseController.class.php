<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/2
 * Time: 13:42
 */
namespace Home\Controller;

class CaseController extends BasicController{

    public function index($id=0)
    {
        $Nav = D('Nav');
        $CaseCat = D('CaseCategory');
        $Case = D('Case');
        $case = $Case->get_one_case($id,$this->config);

        $this->assign('nav_top_list', $Nav->get_nav_list('top'));
        $this->assign('nav_middle_list', $Nav->get_nav_list('middle', '0', 'case_category', $id));
        $this->assign('nav_bottom_list', $Nav->get_nav_list('bottom'));

        $this->assign('case',$case);
        $this->assign('case_category',$CaseCat->get_category(0,$case['cat_id']));  //高亮当前父类
        $this->assign('ur_here',$case['name']);
        $this->display();
    }
}