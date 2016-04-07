<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/25
 * Time: 21:40
 */

namespace Home\Controller;

class GuestBookController extends BasicController{
    
    public function index()
    {
        $this->nav();
        $guestbook = D('GuestBook');
        $this->page($guestbook->book_count(),10);

        // 初始化回复方式
        $contact_type = array ('email', 'tel', 'qq');
        foreach ($contact_type as $value) {
            $option .= "<option value=" . $value. ">" . L('guestbook_' . $value) . "</option>";
        }

        $this->assign('guestbook',$guestbook->get_book_list(10));
        $this->assign('option',$option);
        $this->assign('ur_here', L('guestbook'));
        $this->display();
    }
    
    public function insert()
    {
        if (IS_POST) {
            $this->nav();

            if (!empty(I('post.captcha'))) {
                if(!check_verify(I('post.captcha'))){
                    $this->error(L('captcha_wrong'));
                }
            }
            $guestbook = D('GuestBook');
            $result = $guestbook->insert(I('post.title'),
                                         I('post.name'),
                                         I('post.contact_type'),
                                         I('contact'),
                                         I('post.content'));
            switch($result){
                case -1 :
                    $this->error(sprintf(L('guestbook_title_wrong'),I('post.title')));
                    break;
                case -2 :
                    $this->error(sprintf(L('guestbook_name_wrong'),I('post.name')));
                    break;
                case -3 :
                    $this->error(L('guestbook_contact_type_empty'));
                    break;
                case -4 :
                    $this->error(L('guestbook_contact_wrong'));
                    break;
                case -5 :
                    $this->error(L('guestbook_content_wrong'));
                    break;
                default :
                    $this->success(L('guestbook_insert_success'),'index');
            }
        }else{
            $this->nav();
            $this->error(L('illegal'));
        }
    }

    /**
     *导航注入
     */
    private function nav()
    {
        $Nav = D('Nav');
        $this->assign('nav_top_list',$Nav->get_nav_list('top'));
        $this->assign('nav_middle_list',$Nav->get_nav_list('middle', 0, 'GuestBook',0));
        $this->assign('nav_bottom_list',$Nav->get_nav_list('bottom'));
    }
}