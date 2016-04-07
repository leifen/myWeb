<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/11
 * Time: 21:29
 */

namespace Admin\Controller;

class IndexController extends BasicController{

    public function index()
    {
        $Log = D('AdminLog');
        $Page = D('Page');
        $Product = D('Product');
        $Article = D('Article');

        $sys_info['os'] = PHP_OS;
        $sys_info['ip'] = $_SERVER['SERVER_ADDR'];
        $sys_info['web_server'] = $_SERVER['SERVER_SOFTWARE'];
        $sys_info['php_ver'] = PHP_VERSION;
        $sys_info['mysql_ver'] = mysql_get_server_info();
        $sys_info['gd'] = extension_loaded('gd') ? L('yes') : L('no');
        $sys_info['tp_ver'] = THINK_VERSION;

        $sys_info['charset'] = strtoupper(C('DEFAULT_CHARSET'));
        $sys_info['max_filesize'] = ini_get('upload_max_filesize');
        $sys_info['num_page'] = $Page->page_count();
        $sys_info['num_product'] = $Product->product_count();
        $sys_info['num_article'] = $Article->article_count();

        $this->assign('sys_info',$sys_info);                    //加载网站基本信息
        $this->assign('page_list',$Page->get_page_list());     //加载单页面快速管理
        $this->assign('site',$this->config);                   //加载系统配置信息
        $this->assign('title_admin_log',sprintf(L('title_admin_log'),session('auth')['user_name']));
        $this->assign('log_list',$Log->get_user_log(3));       //加载管理员操作记录
        $this->assign('cur','index');
        $this->display();
    }

    /**
     *清除系统缓存
     */
    public function clear_cache()
    {
        clear_cache(CACHE_PATH);
        $this->success(L('clear_cache_success'));  //清除成功跳到上一页
    }
}