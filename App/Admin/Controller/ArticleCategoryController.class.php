<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/24
 * Time: 16:23
 */
namespace Admin\Controller;

class ArticleCategoryController extends BasicController{

    public function index()
    {
        $ArticleCat = D('ArticleCategory');
        $this->assign('article_category',$ArticleCat->get_category_list());
        $this->assign('cur','article_category');
        $this->assign('ur_here',L('article_category'));
        $this->assign('action_link',array ( 'text' => L('article_category_add'),'href' => U('ArticleCategory/create') ));
        $this->display();
    }

    public function create()
    {
        $ArticleCat = D('ArticleCategory');
        $this->assign('article_category',$ArticleCat->get_category_list());
        $this->assign('cur','article_category');
        $this->assign('ur_here',L('article_category_add'));
        $this->assign('action_link',array ( 'text' => L('article_category'),'href' => U('ArticleCategory/index') ));
        $this->display();
    }

    public function insert()
    {
        if(IS_POST){
            $ArticleCat = D('ArticleCategory');
            $result = $ArticleCat->insert(
                                            I('post.cat_name'),
                                            I('post.unique_id'),
                                            I('post.parent_id'),
                                            I('post.keywords'),
                                            I('post.description'),
                                            I('post.sort')
                                        );
            switch($result){
                case -1 :
                    $this->error(L('article_category_name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('unique_id_wrong'));
                    break;
                default :
                    $this->log(L('article_category_add'),I('post.cat_name'));
                    $this->success(L('article_category_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    public function edit($cat_id=null)
    {
        $ArticleCat = D('ArticleCategory');
        $this->assign('category',$ArticleCat->get_one_category($cat_id));
        $this->assign('article_category',$ArticleCat->get_category_list());
        $this->assign('cur','article_category');
        $this->assign('ur_here',L('article_category_edit'));
        $this->assign('action_link',array ( 'text' => L('article_category'),'href' => U('ArticleCategory/index') ));
        $this->display();
    }

    public function update()
    {
        if(IS_POST){
            $ArticleCat = D('ArticleCategory');
            $result = $ArticleCat->update(
                                            I('post.cat_id'),
                                            I('post.cat_name'),
                                            I('post.unique_id'),
                                            I('post.parent_id'),
                                            I('post.keywords'),
                                            I('post.description'),
                                            I('post.sort')
                                        );
            switch($result){
                case -1 :
                    $this->error(L('article_category_name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('unique_id_wrong'));
                    break;
                default :
                    $this->log(L('article_category_edit'),I('post.cat_name'));
                    $this->success(L('article_category_edit_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    public function destroy($cat_id)
    {
        $ArticleCat = D('ArticleCategory');
        $result = $ArticleCat->destroy($cat_id);
        switch($result['status']){
            case -2 :
                $this->error(sprintf(L('article_category_del_is_parent'),$result['cat_name']));
                break;
            default :
                $this->log(L('article_category_del'),$result['cat_name']);
                $this->success(L('del_succes'),U('ArticleCategory/index'));
        }
    }


}