<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/11
 * Time: 14:49
 */

namespace Admin\Controller;

use Think\Controller;
use Think\Page;

class BasicController extends Controller{

    protected $config = null;  //系统配置信息

    /**
     *登录状态判断
     */
    public function __construct()
    {
        parent::__construct();
        if(!session('?auth'))  $this->redirect('Login/index');
        $this->load_module();
    }

    /**
     *加载系统默认模块
     * return void
     */
    protected function load_module()
    {
        $this->config = read_config();
        $this->assign('menu_list',get_menu_list());     //读取菜单列表
        $this->assign('system',system_module());        //读取系统模块
        $this->assign('config_info',$this->config);           //系统配置信息
    }

    /**
     *日志写入
     */
    protected function log($action,$name)
    {
        $Log = M('adminLog');
        $data = [
            'create_time' => time(),
            'user_id' => session('auth')['user_id'],
            'action' => $action.' : '.$name,
            'ip' => get_client_ip()
        ];
        $Log->add($data);
    }

    /**
     *分页模板
     */
    protected function page($count,$pageSize)
    {
        $Page = new Page($count,$pageSize);
        $Page -> setConfig('header','<span class="count">共计 %TOTAL_ROW% 条记录</span>');
        $Page -> setConfig('last','共%TOTAL_PAGE%页');
        $Page -> setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $this->assign('page',$Page->show());
    }


}