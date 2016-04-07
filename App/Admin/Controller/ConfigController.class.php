<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/19
 * Time: 22:20
 */

namespace Admin\Controller;

class ConfigController extends BasicController{

    public function index()
    {
        $Config = D('Config');
        $this->assign('cfg_list_main',$Config->get_cfg_list());
        $this->assign('cfg_list_display',$Config->get_cfg_list('display'));
        $this->assign('cfg_list_defined',$Config->get_cfg_list('defined'));
        $this->assign('cfg_list_mail',$Config->get_cfg_list('mail'));
        $this->assign('cur','system');
        $this->assign('ur_here', L('system'));
        $this->display();
    }

    public function update()
    {
        $Config = D('Config');
        $Config->update($_POST);
        $this->log(L('system'),L('edit_succes'));
        $this->success(L('edit_succes'),'index');
    }
}