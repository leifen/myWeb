<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/11
 * Time: 18:04
 */

namespace Admin\Model;

use Think\Model;

class ManagerModel extends Model{

    /**
     *自动验证
     */
    protected $_validate = array(
        array('user_name','/^[a-zA-Z]{1}([0-9a-zA-Z]|[._]){3,19}$/',-1,self::EXISTS_VALIDATE),
        array('email','email',-2,self::VALUE_VALIDATE),
        array('password','6,20',-3,self::MUST_VALIDATE,'length',self::MODEL_BOTH),
        array('password_confirm','password',-4,self::MUST_VALIDATE,'confirm',self::MODEL_BOTH)
    );
    /**
     *自动完成
     */
    protected $_auto = array(
        array('password','sha1',self::MODEL_BOTH,'function'),
        array('add_time','time',self::MODEL_INSERT,'function'),
        array('action_list','ADMIN',self::MODEL_INSERT)
    );

    /**
     *返回管理员列表
     */
    public function get_manager_list()
    {
        $result = $this->order('user_id','ASC')->select();
        return $result;
    }

    /**
     *新增管理员
     */
    public function insert($user_name, $email, $password, $password_confirm)
    {
        $data = [
            'user_name' => $user_name,
            'email' => $email,
            'password' => $password,
            'password_confirm' => $password_confirm,
        ];
        if($this->create($data)){
            return  $this->add();
        }else{
            return $this->getError();
        }
    }

    /**
     *获取单一管理员信息
     */
    public function get_one_manager($id)
    {
        $map = [
            'user_id' => $id
        ];
        return $this->where($map)->find();
    }

    /**
     *管理员修改
     */
    public function update($user_name, $email, $password, $password_confirm, $id, $old_password)
    {
        //如果权限不等于'ALL' 则进行旧密码比对，返回错误值-5
        if(session('auth')['action_list'] != 'ALL'){
           $user = $this->get_one_manager($id);
           if($user['password'] != sha1($old_password)) return -5;
       }
        $data = [
            'user_name' => $user_name,
            'email' => $email,
            'password' => $password,
            'password_confirm' => $password_confirm,
            'user_id' => $id,
            'old_password' => $old_password
        ];
        if($this->create($data)){
           return $this->save();
        }else{
            return $this->getError();
        }
    }

    /**
     *管理员删除
     */
    public function destroy($id)
    {
        $result['user_name'] = $this->get_one_manager($id)['user_name'];
        $result['status'] = $this->delete($id);
        return $result;
    }

    /**
     密码重置，查找email用户名
     */
    public function password_reset_post($user_name,$email)
    {
        $map = [
            'user_name' => $user_name,
            'email' => $email
        ];
        return $this->where($map)->find();
    }

    /**
     *密码重置更新
     */
    public function password_reset_update($password, $password_confirm, $user_id)
    {
        $data = [
            'password' => $password,
            'password_confirm' => $password_confirm,
            'user_id' => $user_id
        ];
        if($this->create($data)){
            return $this->save();
        }else{
            return $this->getError();
        }
    }
}