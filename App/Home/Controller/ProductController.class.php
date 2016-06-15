<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/2
 * Time: 13:42
 */
namespace Home\Controller;

class ProductController extends BasicController{

    public function index($id=0)
    {
        $Nav = D('Nav');
        $ProductCat = D('ProductCategory');
        $Product = D('Product');
        $product = $Product->get_one_product($id,$this->config);

        $this->assign('nav_top_list', $Nav->get_nav_list('top'));
        $this->assign('nav_middle_list', $Nav->get_nav_list('middle', '0', 'product_category', $id));
        $this->assign('nav_bottom_list', $Nav->get_nav_list('bottom'));

        $this->assign('product',$product);
        $this->assign('product_category',$ProductCat->get_category(0,$product['cat_id']));  //高亮当前父类
        $this->assign('ur_here',$product['name']);
        $this->display();
    }
}