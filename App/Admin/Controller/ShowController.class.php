<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/13
 * Time: 18:26
 */

namespace Admin\Controller;

class ShowController extends BasicController{

    /**
     *幻灯片列表
     */
    public function index()
    {
        $Page = D('Show');
        $this->assign('show_list',$Page->get_show_list());
        $this->assign('cur','show');
        $this->assign('ur_here',L('show'));
        $this->display();
    }

    /**
     *幻灯片写入
     */
    public function insert()
    {
        if(IS_POST) {
            $Show = D('Show');
            $result = $Show->insert(I('post.show_name'),I('post.show_link'),I('post.sort'),$_FILES['show_img']);
            switch($result){
                case -1 :
                    $this->error(L('upload_image_empty'));
                    break;
                case -2 :
                    $this->error(L('show_name').L('is_empty'));
                    break;
                default :
                    $this->log(L('show_add'),I('post.show_name'));
                    $this->success(L('show_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }

    }

    /**
     *幻灯片修改表单初始化
     */
    public function edit($id=null)
    {
        $Page = D('Show');
        $this->assign('show_list',$Page->get_show_list());
        $this->assign('show',$Page->get_show_one($id));
        $this->assign('cur','show');
        $this->assign('ur_here',L('show'));
        $this->display();
    }

    /**
     *幻灯片修改
     */
    public function update()
    {
        if(IS_POST) {
            $Show = D('Show');
            $result = $Show->update(I('post.id'),I('post.show_name'),I('post.show_link'),I('post.sort'),I('post.show_img'),$_FILES['show_img']);
            switch($result){
                case -2 :
                    $this->error(L('show_name').L('is_empty'));
                    break;
                default :
                    $this->log(L('show_edit'),I('post.show_name'));
                    $this->success(L('show_edit_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *幻灯片删除
     */
    public function destroy($id=null)
    {
        $Show = D('Show');
        $result = $Show->destroy($id);
        $this->log(L('show_del'),$result['show_name']);
        $this->success(L('del_succes'),U('Show/index'));
    }

}