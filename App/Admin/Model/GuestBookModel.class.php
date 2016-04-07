<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/25
 * Time: 19:44
 */

namespace Admin\Model;

use Think\Model;

class GuestBookModel extends Model{


    /**
     * 留言列表
     * @param $pageSize 分页数
     * @return mixed
     */
    public function get_book_list($pageSize)
    {
        $map = [
            'reply_id' => array('eq',0)
        ];
        $book_list = $this->where($map)->order('id DESC')->page($_GET['p'],$pageSize)->select();
        foreach ($book_list as $key=>$value) {
            $if_show = $value['if_show'] ? L('display') : L('hidden');
            $book_list[$key]['if_show'] = $if_show;
        }
        return $book_list;
    }

    /**
     *留言统计
     * @param $map
     * @return mixed
     */
    public function book_count($map)
    {
        $map = [
            'reply_id' => array('eq',0)
        ];
        return $this->where($map)->count();
    }

    /**
     * 获取单一留言
     * @param $id
     * @return mixed
     */
    public function get_book_one($id)
    {
        $map['id'] = $id;
        $data['if_read'] = 1;
        $this->where($map)->save($data);
        return $this->where($map)->find();
    }

    /**
     * 获取留言回复
     * @param $id
     * @return mixed
     */
    public function get_reply($id)
    {
        $map['reply_id'] = $id;
        return $this->where($map)->find();
    }

    /**
     * 留言回复
     * @param $id
     * @param $content
     */
    public function set_reply($id, $content)
    {
        $data = [
            'name' => session('auth')['user_name'],
            'content' => $content,
            'ip' => get_client_ip(),
            'add_time' => time(),
            'reply_id' => $id
        ];
        $this->add($data);
    }

    /**
     * 显示与隐藏
     * @param $id
     * @return int
     */
    public function if_show($id)
    {
        $map['id'] = $id;
        $if_show = $this->where($map)->field('if_show')->find()['if_show'];
        $data['if_show'] = $if_show ? 0 : 1;
        $this->where($map)->save($data);
        return $data['if_show'];
    }

    /**
     * 批量删除
     * @param $data
     */
    public function del_all($data)
    {
        foreach ($data as $value) {
            $map['reply_id'] = $value;
            $this->where($map)->delete();
            $this->delete($value);
        }
    }


}