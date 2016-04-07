<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/25
 * Time: 22:19
 */

namespace Home\Model;

use Think\Model;

class GuestBookModel extends Model{

    protected $_validate = array(
        array('title','4,200',-1,self::MODEL_INSERT,'length'), // 验证标题长度
        array('name','4,200',-2,self::MODEL_INSERT,'length'), // 验证标题长度
        array('contact_type','require',-3,self::MODEL_INSERT),
        array('contact','require',-4,self::MODEL_INSERT),
        array('content','4,255',-5,self::MODEL_INSERT,'length')
    );

    public function get_book_list()
    {
        $map['if_show'] = 1;
        $data = $this->where($map)->select();
        foreach ($data as $row) {
            // 获取管理员回复
            $where['reply_id'] = $row['id'];
            $reply = $this->where($where)->field('add_time,content')->select();
            $reply_time = date("Y-m-d", $reply['add_time']);

            $guestbook[] = array (
                "id" => $row['id'],
                "title" => $row['title'],
                "name" => $row['name'],
                "content" => $row['content'],
                "add_time" => $row['add_time'],
                "reply" => $reply['content'],
                "reply_time" => $reply_time
            );
        }
        return $guestbook;
    }

    public function book_count()
    {
        $map['if_show'] = 1;
        return $this->where($map)->count();
    }

    public function insert($title,$name,$contact_type,$contact,$content)
    {
        $data = [
            'title' => $title,
            'name' => $name,
            'contact_type' => $contact_type,
            'contact' => $contact,
            'content' => $content,
            'ip' => get_client_ip(),
            'add_time' => time(),
        ];
        if ($this->create($data)) {
            return $this->add();
        } else {
            return $this->getError();
        }
    }

}