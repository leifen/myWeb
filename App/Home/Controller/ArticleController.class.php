<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/2
 * Time: 16:44
 */

namespace Home\Controller;

class ArticleController extends BasicController{

    public function index($id=0)
    {
        $Nav = D('Nav');
        $ArticleCat = D('ArticleCategory');
        $Article = D('Article');

        $article = $Article->get_one_article($id);

        $this->assign('nav_top_list', $Nav->get_nav_list('top'));
        $this->assign('nav_middle_list', $Nav->get_nav_list('middle', '0', 'article_category', $id));
        $this->assign('nav_bottom_list', $Nav->get_nav_list('bottom'));
        $this->assign('article',$article);
        $this->assign('pre_next',$Article->get_pre_next($id));
        $this->assign('article_category',$ArticleCat->get_category(0,$article['cat_id']));  //高亮当前父类
        $this->assign('ur_here',$article['title']);
        $this->display();
    }
}