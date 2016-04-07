<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/12
 * Time: 12:00
 */
namespace Admin\Model;

use Think\Model;

class LoginModel extends Model{

    /**
     *定义数据表
     */
    protected $tableName = 'manager';
    /**
     *自动验证
     */
    protected $_validate = array(
        array('user_name','/^[a-zA-Z]{1}([0-9a-zA-Z]|[._]){3,19}$/',-1,self::EXISTS_VALIDATE),
        array('captcha','check_verify',-2,self::EXISTS_VALIDATE,'function',self::MODEL_BOTH)
    );
    /**
     *后台登录验证
     */
    public function login($user_name, $password, $captcha)
    {
        $data = [
            'user_name' => $user_name,
            'captcha' => $captcha
        ];

        if($this->create($data)){
            $map = array(
                'user_name' => $user_name,
                'password' => sha1($password)
            );
           $user = $this->where($map)->find();
           if(!is_array($user)) return -3;
           //更新登录信息
           $update = [
               'user_id' => $user['user_id'],
               'last_login' => time(),
               'last_ip' => get_client_ip()
           ];
           $this->save($update);
           //session保存
           $session = [
               'user_id' => $user['user_id'],
               'action_list' => $user['action_list'],
               'user_name' => $user['user_name']
           ];
           session('auth',$session);
           //写入日志
           $Log = M('adminLog');
           $log = [
               'create_time' => time(),
               'user_id' => session('auth')['user_id'],
               'action' => L('login_action') . ' : ' . L('login_success'),
               'ip' => get_client_ip()
           ];
           $Log->add($log);
       }else{
           return $this->getError();
       }
    }
}