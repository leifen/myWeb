<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/24
 * Time: 16:23
 */
namespace Admin\Controller;

class ProjectCategoryController extends BasicController{

    public function index()
    {
        $ProjectCat = D('Project_category');
        $this->assign('project_category',$ProjectCat->get_category_list());
        $this->assign('cur','project_category');
        $this->assign('ur_here',L('project_category'));
        $this->assign('action_link',array ( 'text' => L('project_category_add'),'href' => U('Project_category/create') ));
        $this->display();
    }

    public function create()
    {
        $ProjectCat = D('Project_category');
        $this->assign('project_category',$ProjectCat->get_category_list());
        $this->assign('cur','project_category');
        $this->assign('ur_here',L('project_category_add'));
        $this->assign('action_link',array ( 'text' => L('project_category'),'href' => U('Project_category/index') ));
        $this->display();
    }

    public function insert()
    {
        if(IS_POST){
            $ProjectCat = D('Project_category');
            $result = $ProjectCat->insert(
                                            I('post.cat_name'),
                                            I('post.unique_id'),
                                            I('post.parent_id'),
                                            I('post.keywords'),
                                            I('post.description'),
                                            I('post.sort')
                                        );
            switch($result){
                case -1 :
                    $this->error(L('project_category_name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('unique_id_wrong'));
                    break;
                default :
                    $this->log(L('project_category_add'),I('post.cat_name'));
                    $this->success(L('project_category_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    public function edit($cat_id=null)
    {
        $ProjectCat = D('Project_category');
        $this->assign('category',$ProjectCat->get_one_category($cat_id));
        $this->assign('project_category',$ProjectCat->get_category_list());
        $this->assign('cur','project_category');
        $this->assign('ur_here',L('project_category_edit'));
        $this->assign('action_link',array ( 'text' => L('project_category'),'href' => U('Project_category/index') ));
        $this->display();
    }

    public function update()
    {
        if(IS_POST){
            $ProjectCat = D('Project_category');
            $result = $ProjectCat->update(
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
                    $this->error(L('project_category_name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('unique_id_wrong'));
                    break;
                default :
                    $this->log(L('project_category_edit'),I('post.cat_name'));
                    $this->success(L('project_category_edit_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    public function destroy($cat_id)
    {
        $ProjectCat = D('Project_category');
        $result = $ProjectCat->destroy($cat_id);
        switch($result['status']){
            case -2 :
                $this->error(sprintf(L('project_category_del_is_parent'),$result['cat_name']));
                break;
            default :
                $this->log(L('project_category_del'),$result['cat_name']);
                $this->success(L('del_succes'),U('Project_category/index'));
        }
    }


}