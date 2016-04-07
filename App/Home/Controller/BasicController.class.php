<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/28
 * Time: 12:12
 */
namespace Home\Controller;

use Think\Controller;
use Think\Page;

class BasicController extends Controller{

    protected $config = null;

    public function __construct()
    {
        parent::__construct();
        $this->get_config();
        $this->get_module();
    }

    /**
     *读取系统设置
     */
    protected function get_config()
    {
        $this->config = read_config();
        if ($this->config['site_closed']) {
            // 设置页面编码
            header('Content-type: text/html; charset=' . C('DEFAULT_CHARSET'));

            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><div style=\"margin: 200px; text-align: center; font-size: 14px\"><p>" .
                L('site_closed') . "</p><p></p></div>";
            exit();
        }
        $this->assign('config',$this->config);
    }

    /**
     *读取系统模块
     */
    protected function get_module()
    {
        $module = system_module();
        foreach($module['column'] as $value){
            $module[$value.'_category'] = rewrite_url($value . '_category');
        }
        foreach($module['single'] as $value){
            $module[$value] = rewrite_url($value);
        }
        $this->assign('system_module',$module);
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