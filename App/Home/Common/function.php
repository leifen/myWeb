<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/28
 * Time: 13:39
 */

    /**
     * 获取导航菜单
     * $type 导航类型
     * $parent_id 默认获取一级导航
     * $current_module 当前页面模型名称，用于高亮导航栏
     * $current_id 当前页面栏目ID
     */
    function get_home_nav($data, $type, $parent_id = 0, $current_module = '', $current_id = '', $current_parent_id = '') {

        foreach ((array) $data as $value) {
            // 根据$parent_id和$type筛选父级导航
            if ($value['parent_id'] == $parent_id && $value['type'] == $type) {
                // 如果是自定义链接则$value['guide']值链接地址，如果是内部导航则值是栏目ID
                if ($value['module'] == 'nav') {
                    if (strpos($value['guide'], 'http://') === 0 || strpos($value['guide'], 'https://') === 0) {
                        $value['url'] = $value['guide'];
                        // 自定义导航如果包含http则在新窗口打开
                        $value['target'] = true;
                    } else {
                        $value['url'] = $value['guide'];
                        // 系统会比对自定义链接是否包含在当前URL里，如果包含则高亮菜单，如果不需要此功能，请注释掉下面那行代码
                        $value['cur'] = strpos($_SERVER['REQUEST_URI'], $value['guide']);
                    }
                } else {
                    $value['url'] = rewrite_url($value['module'], $value['guide']);
                    $value['cur'] =  set_current($value['module'], $value['guide'], $current_module, $current_id, $current_parent_id);
                }

                foreach ($data as $child) {
                    // 筛选下级导航
                    if ($child['parent_id'] == $value['id']) {
                        $value['child'] = get_home_nav($data,$type, $value['id']);
                        break;
                    }
                }
                $nav[] = $value;
            }
        }
        return $nav;
    }

    /**
     * 高亮当前菜单
     * $module 模块名称
     * $id 当前要判断的ID
     * $current_module 当前模块名称，例如在获取导航菜单时就会涉及到不同的模块
     * $current_id 当前的ID
     */
    function set_current($module, $id, $current_module, $current_id = '', $current_parent_id = '') {
        if (($id == $current_id || $id == $current_parent_id) && $module == $current_module) {
            return true;
        } elseif (!$id && $module == $current_module) {
            return true;
        }
    }

    /**
     * 格式化前台信息列表
     */
    function get_list($module,$data,$config)
    {
        foreach($data as $value){
            $item['id'] = $value['id'];
            if($value['title']) $item['title'] = mb_substr($value['title'],0,24,'utf-8');
            if($value['name']) $item['name'] = $value['name'];
            if($value['click']) $item['click'] = $value['click'];
            if (!empty($value['price'])) $item['price'] = $value['price'] > 0 ? price_format($value['price'],$config) : L('price_discuss');

            $item['add_time'] = date("Y-m-d", $value['add_time']);
            $item['add_time_short'] = date("m-d", $value['add_time']);
            $item['image'] = $value['image'] ? __ROOT__ . '/' . $value['image'] : '';
            $image = explode(".", basename($value['image']));
            $item['thumb'] = __ROOT__ . '/'. C('PRODUCT_UPLOAD') . 'thumb_' .$image[0] . '.' .$image[1];
            $item['url'] = rewrite_url($module, $value['id']);
            $list[] = $item;
        }
        return $list;
    }

    /**
     * 格式化商品价格
     * $price 需要格式化的价格
     */
    function price_format($price='',$config)
    {
        $price = number_format($price,$config['price_decimal']);
        $price_format = sprintf(L('price_format'), $price);
        return $price_format;
    }