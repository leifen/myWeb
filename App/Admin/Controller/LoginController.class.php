<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/11
 * Time: 21:34
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Verify;

class LoginController extends Controller{

    /**
     *登录首页
     */
    public function index()
    {
        $this->assign('site',read_config());
        $this->display();
    }

    /**
     *生成验证码
     */
    public function vcode()
    {
        $config = [
            'useImgBg' => false,
            'fontSize' => 10,
            'useCurve' => false,
            'useNoise' => false,
            'length' => 4,
            'imageW' => 70,
            'imageH' => 35
        ];
        $Verify = new Verify($config);
        $Verify->entry();
    }

    /**
     *管理员登录
     */
    public function login()
    {
        if(IS_POST){
              $captcha = isset($_POST['captcha']) ? I('post.captcha') : null;
              $Login = D('Login');
              $result = $Login->login(I('post.user_name'),I('post.password'),$captcha);
              switch($result) {
                  case -1 :
                      $this->error(L('login_input_wrong'));
                      break;
                  case -2 :
                      $this->error(L('login_captcha_wrong'));
                      break;
                  case -3 :
                      $this->error(L('login_input_wrong'));
                      break;
                  default :
                      $this->redirect('Index/index');
              }
          }else{
              $this->error(L('illegal'));
          }
    }

    /**
     *管理员退出
     */
    public function logout()
    {
        session('auth',null);
        $this->redirect('Login/index');
    }

    /**
     *密码重置
     */
    public function password_reset()
    {
        $this->assign('page_title',L('login_password_reset'));
        $this->display();
    }

    /**
     *密码重置邮件发送
     */
    public function password_reset_post()
    {
        $Manager = D('Manager');
        $result = $Manager->password_reset_post(I('post.user_name'),I('post.email'));
        if(empty($result)) $this->error(L('login_password_reset_wrong'));

        $time = time();
        $code = substr(sha1($result['user_name'].$result['email'].$result['password'].$time.$result['last_login']),0,20).$time;
        $site_url ='http://' . $_SERVER["HTTP_HOST"];
        $body = $result['user_name'] . L('login_password_reset_body_0') . $site_url . U('Login/password_reset_confirm',array('uid'=>$result['user_id'],'code'=>$code)) . L('login_password_reset_body_1') . read_config()['site_name'] . '. ' . $site_url;
        // 发送密码重置邮件
        $sendInfo = send_email($result['email'],L('login_password_reset'),$body);

        if($sendInfo){
            $this->success(L('login_password_mail_success').$result['email'],'index',10);
        }else{
            $this->error(L('mail_send_fail'),'password_reset',5);
        }

    }

    /**
     *新密码更新
     */
    public function password_reset_confirm()
    {
        $Manager = D('Manager');

        //密码更新
        if(IS_POST){
            $info = $Manager->password_reset_update(I('post.password'),I('post.password_confirm'),I('post.user_id'));
            switch($info){
                case -3 :
                    $this->error(L('manager_password_cue'));
                    break;
                case -4 :
                    $this->error(L('manager_password_confirm_cue'));
                    break;
                default :
                    $this->success(L('login_password_reset_success'),'index');
            }
        }else{
            $user_id = I('get.uid') ? I('get.uid') : null;
            $code = I('get.code') ? I('get.code') : null;
            $result = $Manager->get_one_manager($user_id);
            if (!check_password_reset($result, $code)) {
                $this->error(L('login_password_reset_fail'),U('Login/password_reset'));
            }
            $this->assign('user_id', $user_id);
            $this->assign('page_title',L('login_password_reset'));
            $this->display();
        }

    }

}