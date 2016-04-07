<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/12
 * Time: 17:49
 */
namespace Admin\Controller;

class LogController extends BasicController{

    public function index()
    {
        $Log = D('adminLog');
        $this->page($Log->log_count(),10);
        $this->assign('log_list',$Log->get_log_list(10));
        $this->assign('cur','log');
        $this->assign('ur_here',L('manager_log'));
        $this->display();
    }
}