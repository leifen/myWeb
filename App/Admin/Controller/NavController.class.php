<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/24
 * Time: 22:11
 */
namespace Admin\Controller;

class NavController extends BasicController{

    public function index()
    {
        $Nav = D('Nav');
        $type = I('get.type') ? I('get.type') : 'middle';

        $this->assign('nav_list',$Nav->get_nav_list($type));
        $this->assign('type',$type);
        $this->assign('cur','nav');
        $this->assign('ur_here',L('nav'));
        $this->assign('action_link',array ( 'text' => L('nav_add'),'href' => U('Nav/create') ));
        $this->display();
    }

    public function create()
    {
        $Nav = D('Nav');
        $type = I('get.type') ? I('get.type') : 'middle';

        $this->assign('nav_list',$Nav->get_nav_list($type));   //加载导航列表
        $this->assign('catalog', get_catalog());      //加载系统模块
        $this->assign('type',$type);
        $this->assign('cur','nav');
        $this->assign('ur_here',L('nav'));
        $this->assign('action_link',array ( 'text' => L('nav_list'),'href' => U('Nav/index') ));
        $this->display();
    }

    public function insert()
    {
        if(IS_POST){
            $Nav = D('Nav');
            $result = $Nav->insert(
                                    I('post.nav_menu'),
                                    I('post.nav_name'),
                                    I('post.type'),
                                    I('post.guide'),
                                    I('post.parent_id'),
                                    I('post.sort')
                                );
            switch($result){
                case -1 :
                    $this->error(L('nav_name').L('is_empty'));
                    break;
                default :
                    $this->log(L('nav_add'),I('post.nav_name'));
                    $this->success(L('nav_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    public function edit($id=null)
    {
        $Nav = D('Nav');
        $type = I('get.type') ? I('get.type') : 'middle';
        $nav_info = $Nav->get_one_nav($id);

        $this->assign('nav_list',$Nav->get_nav_list($type));   //加载导航列表
        $this->assign('catalog', get_catalog($nav_info['module'],$nav_info['guide']));      //  加载系统列表
        $this->assign('nav_info',$nav_info);
        $this->assign('type',$type);
        $this->assign('cur','nav');
        $this->assign('ur_here',L('nav'));
        $this->assign('action_link',array ( 'text' => L('nav_list'),'href' => U('Nav/index') ));
        $this->display();
    }

    public function update()
    {
        if (IS_POST) {
            $Nav = D('Nav');
            $result = $Nav->update(
                                    I('post.id'),
                                    I('post.nav_menu'),
                                    I('post.nav_name'),
                                    I('post.type'),
                                    I('post.guide'),
                                    I('post.parent_id'),
                                    I('post.sort')
                                );
            switch ($result) {
                case -1 :
                    $this->error(L('nav_name') . L('is_empty'));
                    break;
                default :
                    $this->log(L('nav_edit'), I('post.nav_name'));
                    $this->success(L('nav_edit_succes'), 'index');
            }
        } else {
            $this->error(L('illegal'));
        }
    }

    public function destroy($id = null)
    {
        $Nav = D('Nav');
        $result = $Nav->destroy($id);
        switch($result['status']){
            case -2 :
                $this->error(sprintf(L('nav_del_is_parent'),$result['nav_name']));
                break;
            default :
                $this->log(L('nav_del'),$result['nav_name']);
                $this->success(L('del_succes'),U('Nav/index'));
        }
    }

    public function nav_select()
    {
        $type = I('get.type') ? I('get.type') : 'middle';
        $id = I('get.id');
        $Nav = D('Nav');
        $nav_list = $Nav->get_nav_list($type);
        $parent_id = $Nav->get_one_nav($id)['parent_id'];

        $select = '';
        $select .= '<select name="parent_id">';
        $select .= '<option value="0">' . L('empty') . '</option>';
        foreach ($nav_list as $value) {
            $select .= '<option value="' . $value['id'] . '" ';
            $select .= ($value['id'] == $parent_id) ? "selected='ture'" : '';
            $select .= '>' . $value['mark'] . ' ';
            $select .= htmlspecialchars($value['nav_name'], ENT_QUOTES) . '</option>';
        }
        $select .= '</select>';
        echo $select;
    }
}