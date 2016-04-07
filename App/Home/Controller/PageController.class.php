<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/1
 * Time: 20:35
 */

namespace Home\Controller;

class PageController extends BasicController{

    public function index($id = '')
    {
        $Nav = D('Nav');
        $Page = D('Page');

        $page = $Page->get_page_info($id);      //获取单页面信息
        $top_id = $page['parent_id'] == 0 ? $id : $page['parent_id'];

        $this->assign('nav_top_list',$Nav->get_nav_list('top'));
        $this->assign('nav_middle_list',$Nav->get_nav_list('middle','0', 'page', $id));
        $this->assign('nav_bottom_list',$Nav->get_nav_list('bottom'));

        if(!$page['id']) $this->error(L('page_wrong'));    //如果查找不到信息，则提示页面不存在

        if($top_id == $id) $this->assign('top_cur',true);     //当为父类时高亮
        $this->assign('page',$page);
        $this->assign('page_list',$Page->get_page_list($top_id,$id));
        $this->assign('top', $Page->get_page_info($top_id));
        $this->assign('ur_here',$page['page_name']);           //当前位置

        $this->display();
    }
}