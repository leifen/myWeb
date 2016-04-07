<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/13
 * Time: 11:35
 */

namespace Admin\Controller;

class CaseCategoryController extends BasicController{

    public function index()
    {
        $CaseCat = D('Case_category');
        $this->assign('case_category',$CaseCat->get_category_list());
        $this->assign('cur','case_category');
        $this->assign('ur_here',L('case_category'));
        $this->assign('action_link',array ( 'text' => L('case_category_add'),'href' => U('Case_category/create') ));
        $this->display();
    }

    public function create()
    {
        $CaseCat = D('Case_category');
        $this->assign('case_category',$CaseCat->get_category_list());
        $this->assign('cur','case_category');
        $this->assign('ur_here',L('case_category_add'));
        $this->assign('action_link',array ( 'text' => L('case_category'),'href' => U('Case_category/index') ));
        $this->display();
    }

    public function insert()
    {
        if(IS_POST){
            $CaseCat = D('Case_category');
            $result = $CaseCat->insert(
                                        I('post.cat_name'),
                                        I('post.unique_id'),
                                        I('post.parent_id'),
                                        I('post.keywords'),
                                        I('post.description'),
                                        I('post.sort')
                                    );
            switch($result){
                case -1 :
                    $this->error(L('case_category_name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('unique_id_wrong'));
                    break;
                default :
                    $this->log(L('case_category_add'),I('post.cat_name'));
                    $this->success(L('case_category_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    public function edit($cat_id=null)
    {
        $CaseCat = D('Case_category');
        $this->assign('category',$CaseCat->get_one_category($cat_id));
        $this->assign('case_category',$CaseCat->get_category_list());
        $this->assign('cur','case_category');
        $this->assign('ur_here',L('case_category_edit'));
        $this->assign('action_link',array ( 'text' => L('case_category'),'href' => U('Case_category/index') ));
        $this->display();
    }

    public function update()
    {
        if(IS_POST){
            $CaseCat = D('Case_category');
            $result = $CaseCat->update(
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
                    $this->error(L('case_category_name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('unique_id_wrong'));
                    break;
                default :
                    $this->log(L('case_category_edit'),I('post.cat_name'));
                    $this->success(L('case_category_edit_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    public function destroy($cat_id)
    {
        $CaseCat = D('Case_category');
        $result = $CaseCat->destroy($cat_id);
        switch($result['status']){
            case -2 :
                $this->error(sprintf(L('case_category_del_is_parent'),$result['cat_name']));
                break;
            default :
                $this->log(L('case_category_del'),$result['cat_name']);
                $this->success(L('del_succes'),U('Case_category/index'));
        }
    }

}