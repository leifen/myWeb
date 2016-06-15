<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/1
 * Time: 22:31
 */
namespace Home\Controller;

class ProductCategoryController extends BasicController{

    public function index($id=0)
    {
        $Nav = D('Nav');
        $ProductCat = D('ProductCategory');
        $Product = D('Product');
        
        $this->page($Product->get_count($id),$this->config['display']['product']);   //加载分页
        $this->assign('nav_top_list', $Nav->get_nav_list('top'));
        $this->assign('nav_middle_list', $Nav->get_nav_list('middle', '0', 'product_category', $id));
        $this->assign('nav_bottom_list', $Nav->get_nav_list('bottom'));

        $this->assign('product_category',$ProductCat->get_category(0,$id));
        $this->assign('product_list',$Product->get_product_list($id,$this->config['display']['product']));
        $this->assign('ur_here',$ProductCat->get_one_category($id));
        $this->display();
    }
}