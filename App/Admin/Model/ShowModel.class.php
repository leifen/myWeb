<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/13
 * Time: 19:13
 */

namespace Admin\Model;

use Think\Model;

class ShowModel extends Model{
    /**
     *自动验证
     * return -1 幻灯片name 不得为空
     */
    protected $_validate = array(
        array('show_name','require',-2,self::EXISTS_VALIDATE)
    );

    /**
     *幻灯片列表
     */
    public function get_show_list()
    {
        $result = $this->where(array('type'=>'pc'))->order(array('sort'=>'ASC','id'=>'ASC'))->select();
        $result = show_list($result);
        return $result;
    }

    /**
     *return -1 图片上传错误或图片为空
     *       -2 幻灯片名称为空
     */
    public function insert($show_name,$show_link,$sort,$show_img)
    {
        if(!empty($show_img['name'])){
            $Uplode = new FileUpload();
            $url = $Uplode->show_img_upload();
        }else{
            return -1;
        }
        $data = [
            'show_img' => $url,
            'show_name' => $show_name,
            'show_link' => $show_link,
            'type' => 'pc',
            'sort' => $sort
        ];
        if($this->create($data)){
            return $this->add();
        }else{
            return $this->getError();
        }

    }

    /**
     *查找单一幻灯片
     */
    public function get_show_one($id)
    {
        $map = [
            'id' => $id
        ];
        return $this->where($map)->find();
    }

    /**
     *幻灯片修改
     */
    public function update($id, $show_name, $show_link, $sort, $show_img,$file)
    {
        if(!empty($file['name'])){
            $Uplode = new FileUpload();
            $url = $Uplode->show_img_upload();
        }
        $data = [
            'id' => $id,
            'show_name' => $show_name,
            'show_link' => $show_link,
            'type' => 'pc',
            'sort' => $sort
        ];

       if($url){
           $data['show_img'] = $url;
           unlink_old_image($show_img,C('SHOW_THUMB_UPLOAD'));      //调用admin域函数，删除过期幻灯片
       }else{
           $data['show_img'] = $show_img;
       }
        if($this->create($data)){
            return $this->save();
        }else{
            return $this->getError();
        }
    }

    /**
     *幻灯片删除
     */
    public function destroy($id=null)
    {
        $result = $this->get_show_one($id);
        $this->delete($id);
        unlink_old_image($result['show_img'],C('SHOW_THUMB_UPLOAD'));
        return $result;
    }
}