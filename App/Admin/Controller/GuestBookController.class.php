<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/25
 * Time: 19:26
 */

namespace Admin\Controller;

class GuestBookController extends BasicController{


    /**
     *留言反馈列表
     */
    public function index()
    {
        $guestbook = D('GuestBook');
        $this->page($guestbook->book_count(),10);
        $this->assign('book_list',$guestbook->get_book_list(10));
        $this->assign('cur','guestbook');
        $this->assign('ur_here',L('guestbook'));
        $this->display();
    }

    /**
     * 读取留言
     * @param null $id
     */
    public function read($id = null)
    {
        $guestbook = D('GuestBook');
        $this->assign('guestbook',$guestbook->get_book_one($id));
        $this->assign('reply',$guestbook->get_reply($id));
        $this->assign('cur','guestbook');
        $this->assign('ur_here',L('guestbook_read'));
        $this->assign('action_link',array ( 'text' => L('guestbook_list'),'href' => U('GuestBook/index') ));
        $this->display();
    }

    /**
     *留言回复
     */
    public function reply()
    {
        $guestbook = D('GuestBook');
        $result = $guestbook->set_reply(I('post.id'),I('post.content'));
        $this->log(L('guestbook_reply'),I('post.title'));
        $this->success(L('guestbook_insert_success'),'index');
    }

    /**
     *显示与隐藏
     */
    public function show_hidden()
    {
        $gusetbook = D('GuestBook');
        $if_show = $gusetbook->if_show(I('get.id'));
        echo "<em class=" . ($if_show ? 'd' : 'h') . "><b>".L('display')."</b><s>".L('hidden')."</s></em>";
    }

    /**
     *批量删除留言信息
     */
    public function del_all()
    {
        if (is_array(I('post.checkbox'))) {
            $guestbook = D('GuestBook');
            $guestbook->del_all(I('post.checkbox'));
            $this->success(L('del_succes'),U('GuestBook/index'));
        }else{
            $this->error(L('guestbook_select_empty'));
        }
    }
    
}