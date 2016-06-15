<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/11
 * Time: 12:43
 */

    /**
     * +----------------------------------------------------------
     * 将系统文件转换为数组
     * +----------------------------------------------------------
     */
    function read_system()
    {
        $content = file($_SERVER['DOCUMENT_ROOT'].__ROOT__ . '/data/system.exe');
        foreach ($content as $line) {
            $line = trim($line);
            if (strpos($line, '//') !== 0) {
                $arr = explode(':', $line);
                $setting[$arr[0]] = explode(',', $arr[1]);
            }
        }
        return $setting;
    }

    /**
     * +----------------------------------------------------------
     * 系统默认模块
     * +----------------------------------------------------------
     */
    function system_module()
    {
        // 读取系统文件
        $setting = read_system();
        $module['column'] = array_filter($setting['column_module']);
        $module['single'] = array_filter($setting['single_module']);
        $module['all'] = array_merge($module['column'], $module['single']);

        // 模块开启状态
        foreach ($module['all'] as $module_id) {
            $_OPEN[$module_id] = true;
        }
        $module['open'] = $_OPEN;
        return $module;
    }

    /**
     * +----------------------------------------------------------
     * 生成模块后台菜单
     * +----------------------------------------------------------
     */
    function get_menu_list()
    {
        $module = system_module();
        foreach($module['column'] as $value){
            $menu_list['column'][] = array(
                'name_category' => $value . '_category',
                'lang_category' => L($value . '_category'),
                'url_category' => U($value . '_category/index'),
                'name' => $value,
                'url' => U($value.'/index'),
                'lang' => L($value)
            );
        }
        foreach ($module['single'] as $value) {
            $menu_list['single'][] = array (
                'name' => $value,
                'url' => U($value.'/index'),
                'lang' => L($value)
            );
        }
        return $menu_list;
    }

    /**
     * +----------------------------------------------------------
     * 验证码检测
     * +----------------------------------------------------------
     */
    function check_verify($code)
    {
        $Verify = new \Think\Verify();
        return $Verify->check($code);
    }

    /**
     * +----------------------------------------------------------
     * 获取无层次单页面列表
     * +----------------------------------------------------------
     * $data 数据源
     * $parent_id 调用该ID下的所有单页面，为空时则调用所有
     * $level 无限极分类层次
     * $current_id 当前页面栏目ID
     * $mark 无限极分类标记
     * +----------------------------------------------------------
     */
    function get_page_nolevel($data,$parent_id = 0, $level = 0, $current_id = '', &$page_nolevel = array(), $mark = '-')
    {
        foreach ((array) $data as $value) {
            if ($value['parent_id'] == $parent_id && $value['id'] != $current_id) {
                $value['url'] = rewrite_url('page', $value['id']);
                $value['mark'] = str_repeat($mark, $level);
                $value['level'] = $level;
                $page_nolevel[] = $value;
                get_page_nolevel($data,$value['id'], $level + 1, $current_id, $page_nolevel);
            }
        }
        return $page_nolevel;
    }

    /**
     *生成URL地址
     * $module 所属模块
     * $value 链接ID
     */
    function rewrite_url($module, $value=null)
    {
        if(!empty($value)){
            $url = 'http://' . $_SERVER["HTTP_HOST"] . __ROOT__ . '/'.$module. '/index/id/' .$value;
        }else{
            $url = 'http://' . $_SERVER["HTTP_HOST"]. __ROOT__ .'/'.$module. '/index';
        }
        return $url;
    }

    /**
     *格式化幻灯片数据
     */
    function show_list($data)
    {
        foreach ($data as $key=>$value) {
            $image = explode('.', basename($value['show_img']));
            $thumb = C('SHOW_THUMB_UPLOAD') . 'thumb_' . $image['0'] .'.'. $image['1'];
            if (strpos($value['show_link'], 'http://') === 0 || strpos($value['show_link'], 'https://') === 0){
                $value['show_link'] =  $value['show_link'];
            }else {
                if (empty($value['show_link'])) {
                    $value['show_link'] = 'http://' ;
                }
                $value['show_link'] = 'http://' . $value['show_link'];
            }

            $page_list[] = [
                'id' => $value['id'],
                'show_name' => $value['show_name'],
                'show_link' => $value['show_link'],
                'show_img' => $value['show_img'],
                'thumb' => $thumb,
                'sort' => $value['sort']
            ];
        }
        return $page_list;
    }

    /**
     * +----------------------------------------------------------
     * 获取无层次商品分类，将所有分类存至同一级数组，用$mark作为标记区分
     * +----------------------------------------------------------
     * $parent_id 默认获取一级导航
     * $level 无限极分类层次
     * $current_id 当前页面栏目ID
     * $category_nolevel 储存分类信息的数组
     * $mark 无限极分类标记
     * +----------------------------------------------------------
     */
    function get_category_nolevel($data, $parent_id = 0, $level = 0, $current_id = '', &$category_nolevel = array(), $mark = '-')
    {
        foreach ((array) $data as $value) {
            if ($value['parent_id'] == $parent_id && $value['cat_id'] != $current_id) {
                $value['url'] = rewrite_url('product_category', $value['cat_id']);
                $value['mark'] = str_repeat($mark, $level);
                $category_nolevel[] = $value;
                get_category_nolevel($data, $value['cat_id'], $level + 1, $current_id, $category_nolevel);
            }
        }
        return $category_nolevel;
    }

    /**
     * +----------------------------------------------------------
     * 获取当前目录子文件夹
     * +----------------------------------------------------------
     * $dir 要检索的目录
     * +----------------------------------------------------------
     */
    function get_subdirs($dir) {
        $subdirs = array();
        if (!$handle  = @opendir($dir)) return $subdirs;

        while ($file = @readdir($handle )) {
            if ($file == '.' || $file == '..') continue; // 排除掉当前目录和上一个目录
            $result = explode('.',$file);
            $subdirs[] = $result[0];
        }
        return $subdirs;
    }

    /**
     * +----------------------------------------------------------
     * 获取系统配置信息
     * +----------------------------------------------------------
     */
    function read_config()
    {
        $Config = M('Config');
        $result = $Config->select();
        foreach($result as $value){
            if($value['name'] == 'display' || $value['name'] == 'defined') $value['value'] = unserialize($value['value']);
            $config_list[$value['name']] = $value['value'];

        }
        if($config_list['qq']) $config_list['qq'] = set_qq($config_list['qq']);
        $config_list['root_url'] = 'http://' . $_SERVER['HTTP_HOST'] . __ROOT__;
        $config_list['copyright'] = sprintf(L('copyright'),$config_list['site_name']);
        return $config_list;
    }

    /**
     * +----------------------------------------------------------
     * 获取分类子ID
     * +----------------------------------------------------------
     */
    function get_child_id($data,$parent_id=0,&$child_id = '')
    {
        foreach ((array) $data as $value) {
            if ($value['parent_id'] == $parent_id) {
                $child_id .= $value['cat_id'] . ',';
                get_child_id($data, $value['cat_id'], $child_id);
            }
        }
        return $child_id;
    }

    /**
     * +----------------------------------------------------------
     * 获取导航菜单
     * +----------------------------------------------------------
     * $type 导航类型
     * $parent_id 默认获取一级导航
     * $level 无限极分类层次
     * $current_id 当前页面栏目ID
     * $mark 无限极分类标记
     * +----------------------------------------------------------
     */
    function get_nav($data, $type, $parent_id = 0, $level = 0, $current_id = '', &$nav = array(), $mark = '-') {
        foreach ((array) $data as $value) {
            if ($value['parent_id'] == $parent_id && $value['type'] == $type && $value['id'] != $current_id) {
                if ($value['module'] != 'nav') {
                   $value['guide'] = rewrite_url($value['module'], $value['guide']);
                }
                $value['mark'] = str_repeat($mark, $level);
                $nav[] = $value;
                get_nav($data, $type, $value['id'], $level + 1, $current_id, $nav);
            }
        }
        return $nav;
    }

    /**
     * +----------------------------------------------------------
     * 获取整站目录数据
     * +----------------------------------------------------------
     */
    function get_catalog($module = '', $id = '')
    {
        // 单页面列表
        $Page = M('Page');
        foreach (get_page_nolevel($Page->order('id ASC')->select()) as $row) {
            $catalog[] = array (
                "name" => $row['page_name'],
                "module" => 'page',
                "guide" => $row['id'],
                "cur" => ($module == 'page' && $id == $row['id']) ? true : false,
                "mark" => '-' . $row['mark']
            );
        }
        // 栏目模块
        foreach(read_system()['column_module'] as $module_id){
            $catalog[] = array(
                'name' => L('nav_'.$module_id),
                'module' => $module_id . '_category',
                'cur' => ($module == $module_id . '_category' && $id == 0) ? true : false,
                'guide' => 0
            );
            $ModuleCat = D($module_id . '_category');
            foreach(get_category_nolevel($ModuleCat->order('sort ASC')->select()) as $row){
                $catalog[] = array(
                   'name' => $row['cat_name'],
                    'module' => $module_id . '_category',
                    'guide' => $row['cat_id'],
                    'cur' => ($module == $module_id . '_category' && $id == $row['cat_id']) ? true : false,
                    'mark' => '-' . $row['mark']
                );
            }
        }
        //简单模块
        foreach(read_system()['single_module'] as $module_id){
            if($module_id){
                $catalog[] = array(
                    'name' => L($module_id),
                    'module' => $module_id,
                    'cur' => ($module == $module_id && $id == 0) ? true : false,
                    'guide' => 0
                );
            }
        }
        return $catalog;
    }

    /**
     *生成在线客服QQ数组
     */
    function set_qq($data)
    {
        $im_explode = explode(',', $data);
        foreach ($im_explode as $value) {
            if (strpos($value, '/') !== false) {
                $arr = explode('/', $value);
                $list['number'] = $arr['0'];
                $list['nickname'] = $arr['1'];
                $im_list[] = $list;
            } else {
                $im_list[] = $value;
            }
        }
        return $im_list;
    }
