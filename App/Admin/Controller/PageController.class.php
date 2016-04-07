<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/13
 * Time: 11:35
 */

namespace Admin\Controller;

class PageController extends BasicController{

    /**
     *单页面列表
     */
    public function index()
    {
        $Page = D('Page');
        $this->assign('page_list',$Page->get_page_list());
        $this->assign('cur','page');
        $this->assign('ur_here',L('page_list'));
        $this->assign('action_link',array ( 'text' => L('page_add'),'href' => U('Page/create') ));
        $this->display();
    }

    /**
     *单页面新增表单
     */
    public function create()
    {
        $Page = D('Page');
        $this->assign('page_list',$Page->get_page_list());
        $this->assign('cur','page');
        $this->assign('ur_here',L('page_add'));
        $this->assign('action_link',array ( 'text' => L('page_list'),'href' => U('Page/index') ));
        $this->display();
    }

    /**
     *单页面新增
     */
    public function insert()
    {
        if(IS_POST){
            $Page = D('Page');
            $result = $Page->insert(
                                        I('post.page_name'),
                                        I('post.unique_id'),
                                        I('post.parent_id'),
                                        I('post.content'),
                                        I('post.keywords'),
                                        I('post.description')
                                    );
            switch($result){
                case -1 :
                    $this->error(L('page_name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('unique_id_wrong'));
                    break;
                default :
                    $this->log(L('page_add'),I('post.page_name'));
                    $this->success(L('page_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *单页面编辑表单
     */
    public function edit($id=null)
    {
        $Page = D('Page');
        $this->assign('page',$Page->get_one_page($id));
        $this->assign('page_list',$Page->get_page_list());
        $this->assign('cur','page_list');
        $this->assign('ur_here',L('page_edit'));
        $this->assign('action_link',array ( 'text' => L('page_list'),'href' => U('Page/index') ));
        $this->display();
    }

    /**
     *单页面编辑写入
     */
    public function update($id=null)
    {
        if(IS_POST){
            $Page = D('Page');
            $result = $Page->update(
                                        I('post.id'),
                                        I('post.page_name'),
                                        I('post.unique_id'),
                                        I('post.parent_id'),
                                        I('post.content'),
                                        I('post.keywords'),
                                        I('post.description')
                                    );
            switch($result){
                case -1 :
                    $this->error(L('page_name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('unique_id_wrong'));
                    break;
                default :
                    $this->log(L('page_edit'),I('post.page_name'));
                    $this->success(L('page_edit_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *单页面删除
     */
    public function destroy($id=null)
    {
        $Page = D('Page');
        $result = $Page->destroy($id);

        switch($result['status']){
            case -1 :
                $this->error(L('page_del_wrong'));
                break;
            case -2 :
                $this->error(sprintf(L('page_del_is_parent'),$result['page_name']));
                break;
            default :
                $this->log(L('page_del'),$result['page_name']);
                $this->success(L('del_succes'),U('Page/index'));
        }
    }
}