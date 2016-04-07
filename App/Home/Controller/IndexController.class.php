<?php
namespace Home\Controller;

class IndexController extends BasicController {

    public function index()
    {
        $Nav = D('Nav');
        $Show = D('Show');
        $Product = D('Product');
        $Article = D('Article');
        $Page = D('Page');
        $index['cur'] = true;
        $this->assign('nav_top_list',$Nav->get_nav_list('top'));
        $this->assign('nav_middle_list',$Nav->get_nav_list('middle'));
        $this->assign('nav_bottom_list',$Nav->get_nav_list('bottom'));
        $this->assign('show_list',$Show->get_show_list());
        $this->assign('recommend_product',$Product->get_home_product('product',$this->config));
        $this->assign('recommend_article',$Article->get_home_article('article',$this->config));
        $this->assign('about',$Page->get_about_page());
        $this->assign('index',$index);
        $this->display();
    }
}