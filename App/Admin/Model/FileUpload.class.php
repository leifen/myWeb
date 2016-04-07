<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/13
 * Time: 19:21
 */
namespace Admin\Model;

use Think\Image;
use Think\Upload;

class FileUpload {

    /**
     *幻灯片上传
     * $thumbUrl 缩略图URL
     * return $url 写入数据库
     */
    public function show_img_upload()
    {
        $upload = new Upload();// 实例化上传类
        $upload->rootPath = C('SHOW_UPLOAD');
        $upload->autoSub = false;
        $info = $upload->upload($_FILES);

        $url = C('SHOW_UPLOAD').$info['show_img']['savename'];
        $thumbUrl = C('SHOW_THUMB_UPLOAD').'thumb_'.$info['show_img']['savename'];

        $this->thumb($url,100,100,$thumbUrl);    //图片缩放
        return $url;
    }

    /**
     *logo上传
     * return $url 写入数据库
     */
    public function logo_img_upload()
    {
        $upload = new Upload();// 实例化上传类
        $upload->rootPath = C('LOGO_UPLOAD');
        $upload->autoSub = false;
        $upload->saveName = 'logo';
        $upload->saveExt = 'gif';
        $upload->replace = true;
        $info = $upload->upload($_FILES);
        $url = C('LOGO_UPLOAD').$info['site_logo']['savename'];
        return $url;
    }

    /**
     *商品缩略图上传
     */
    public function product_img_upload($width, $height)
    {
        $upload = new Upload();// 实例化上传类
        $upload->rootPath = C('PRODUCT_UPLOAD');
        $upload->autoSub = false;
        $info = $upload->upload($_FILES);
        $url = C('PRODUCT_UPLOAD').$info['image']['savename'];
        $thumbUrl = C('PRODUCT_UPLOAD').'thumb_'.$info['image']['savename'];

        $this->thumb($url,$width,$height,$thumbUrl);

        return $url;
    }

    public function case_img_upload($width, $height)
    {
        $upload = new Upload();// 实例化上传类
        $upload->rootPath = C('CASE_UPLOAD');
        $upload->autoSub = false;
        $info = $upload->upload($_FILES);
        $url = C('CASE_UPLOAD').$info['image']['savename'];
        $thumbUrl = C('CASE_UPLOAD').'thumb_'.$info['image']['savename'];

        $this->thumb($url,$width,$height,$thumbUrl);

        return $url;
    }

    /**
     *文章缩略图上传
     */
    public function article_img_upload()
    {
        $upload = new Upload();// 实例化上传类
        $upload->rootPath = C('ARTICLE_UPLOAD');
        $upload->autoSub = false;
        $info = $upload->upload($_FILES);
        $url = C('ARTICLE_UPLOAD').$info['image']['savename'];
        return $url;
    }

    /**
     *解决方案缩略图上传
     */
    public function project_img_upload()
    {
        $upload = new Upload();// 实例化上传类
        $upload->rootPath = C('PROJECT_UPLOAD');
        $upload->autoSub = false;
        $info = $upload->upload($_FILES);
        $url = C('PROJECT_UPLOAD').$info['image']['savename'];
        return $url;
    }


    /**
     *图片缩放
     */
    public function thumb($url,$width,$height,$savename)
    {
        $image = new Image();
        $image->open($url);
        $image->thumb($width, $height,\Think\Image::IMAGE_THUMB_FILLED)->save($savename);
    }
}