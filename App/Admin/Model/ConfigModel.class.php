<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/19
 * Time: 22:42
 */

namespace Admin\Model;

use Think\Model;

class ConfigModel extends Model{

    public function get_cfg_list($tab='main')
    {
        $map = [
            'tab' => $tab
        ];
        $result = $this->where($map)->select();
        foreach($result as $value){
            //预设选项
            if($value['box'])
                $box = explode(',',$value['box']);

            if($value['name'] == 'site_logo') {
                $value['value'] =  $value['value'];
            }

            if($value['name'] == 'language')
                $box = get_subdirs($_SERVER['DOCUMENT_ROOT'].__ROOT__ .MODULE_PATH . 'Lang');

            //指定提示信息
            if($value['name'] == 'qq' || $value['name'] == 'price_decimal' || $value['name'] == 'display' || $value['name'] == 'defined' || $value['name'] == 'mail_service' || $value['name'] == 'mail_host') {
                $cue = L($value['name'] . '_cue');
            }else{
                $cue = null;
            }
            // 数组类型的设置选项
            if ($value['type'] == 'array') {
                $arr = unserialize($value['value']);
                foreach ((array)$arr as $key=>$v) {
                    $value_array[] = array (
                        "value" => $v,
                        "name" => $value['name'] . '[' . $key . ']',
                        "lang" => L($value['name'] . '_' . $key),
                        "cue" => L($value['name'] . '_' . $key . '_cue')
                    );
                }
            }

            $cfg_list[] = array (
                "value" => $value_array ? $value_array : $value['value'],
                "name" => $value['name'],
                "type" => $value['type'],
                "box" => $box,
                "lang" =>L($value['name']),
                "cue" => $cue
            );
        }
        return $cfg_list;
    }

    public function update()
    {
        if(!empty($_FILES['site_logo']['name'])){
            $Uplode = new FileUpload();
            $logo_url = $Uplode->logo_img_upload();
        }else{
            $logo_url = $_POST['logo'];
        }
        $_POST['site_logo'] = $logo_url;

        foreach($_POST as $name=>$value){
            if (is_array($value)) $value = serialize($value);
            $map = ['name'=>$name];
            $data = ['value'=>$value];
            $this->where($map)->save($data);
        }
    }

}