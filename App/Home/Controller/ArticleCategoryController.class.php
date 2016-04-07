<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/2
 * Time: 16:09
 */

namespace Home\Controller;

class ArticleCategoryController extends BasicController{

    public function index($id=0)
    {
        $Nav = D('Nav');
        $ArticleCat = D('Article_category');
        $Article = D('Article');

        $this->page($Article->get_count($id),$this->config['display']['article']);   //加载分页
        $this->assign('nav_top_list', $Nav->get_nav_list('top'));
        $this->assign('nav_middle_list', $Nav->get_nav_list('middle', '0', 'article_category', $id));
        $this->assign('nav_bottom_list', $Nav->get_nav_list('bottom'));

        $this->assign('article_category',$ArticleCat->get_category(0,$id));
        $this->assign('article_list',$Article->get_article_list($id,$this->config['display']['article']));
        $this->assign('ur_here',$ArticleCat->get_one_category($id));
        $this->display();
    }

}