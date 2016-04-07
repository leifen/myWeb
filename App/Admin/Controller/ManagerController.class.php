<?php
namespace Admin\Controller;

class ManagerController extends BasicController {

    /**
     *管理员列表（首页）
     */
    public function index()
    {
        $Mangaer = D('Manager');
        $this->assign('manager_list',$Mangaer->get_manager_list());
        $this->assign('cur','manager');
        $this->assign('ur_here',L('manager'));
        $this->assign('action_link',array ( 'text' => L('manager_add'),'href' => U('Manager/create') ));
        $this->display();
    }

    /**
     *管理员新增表单
     */
    public function create()
    {
        if(session('auth')['action_list'] != 'ALL') $this->error(L('without'));

        $this->assign('cur','manager');
        $this->assign('ur_here',L('manager'));
        $this->assign('action_link',array ( 'text' => L('manager_list'),'href' => U('Manager/index') ));
        $this->display();
    }

    /**
     *管理员新增
     */
    public function insert()
    {
        if(IS_POST){
            $Manager = D('Manager');
            $result = $Manager->insert(I('user_name'),I('email'),I('password'),I('password_confirm'));
            switch($result){
                case -1 :
                    $this->error(L('manager_username_cue'));
                    break;
                case -2 :
                    $this->error(L('manager_email_cue'));
                    break;
                case -3 :
                    $this->error(L('manager_password_cue'));
                    break;
                case -4 :
                    $this->error(L('manager_password_confirm_cue'));
                    break;
                default :
                    $this->log(L('manager_add'),I('post.user_name'));
                    $this->success(L('manager_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *管理员编辑表单
     */
    public function edit($id=null)
    {
        if((session('auth')['action_list'] != 'ALL') && $id != session('auth')['user_id']) $this->error(L('without'));

        $Manager = D('Manager');
        $result = $Manager->get_one_manager($id);
        $this->assign('manager_info',$result);
        $this->assign('cur','manager');
        $this->assign('ur_here',L('manager'));
        $this->assign('action_link',array ( 'text' => L('manager_list'),'href' => U('Manager/index') ));
        $this->display();
    }

    /**
     *管理员修改
     */
    public function update()
    {
        if(IS_POST){
            $Manager = D('Manager');
            $result = $Manager->update(
                                        I('post.user_name'),
                                        I('post.email'),
                                        I('post.password'),
                                        I('post.password_confirm'),
                                        I('post.id'),
                                        I('post.old_password')
                                    );
            switch($result){
                case -1 :
                    $this->error(L('manager_username_cue'));
                    break;
                case -2 :
                    $this->error(L('manager_email_cue'));
                    break;
                case -3 :
                    $this->error(L('manager_password_cue'));
                    break;
                case -4 :
                    $this->error(L('manager_password_confirm_cue'));
                    break;
                case -5 :
                    $this->error(L('manager_old_password_cue'));
                    break;
                default :
                    $this->log(L('manager_edit'),I('post.user_name'));
                    $this->success(L('manager_edit_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *管理员删除
     */
    public function destroy($id=null)
    {
        if((session('auth')['action_list'] != 'ALL')) $this->error(L('without'));
        if((session('auth')['action_list'] == 'ALL') && session('auth')['user_id'] == $id) $this->error(L('manager_del_wrong'));
        $Manager = D('Manager');
        $result = $Manager->destroy($id);
        if($result['status'] > 0){
            $this->log(L('manager_del'),$result['user_name']);
            $this->success(L('del_succes'),U('Manager/index'));
        }else{
            $this->error(L('del_error'));
        }
    }

}