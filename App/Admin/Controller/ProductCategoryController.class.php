<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/13
 * Time: 11:35
 */

namespace Admin\Controller;

class ProductCategoryController extends BasicController{

    /**
     *商品分类列表
     */
    public function index()
    {
        $ProductCat = D('Product_category');
        $this->assign('product_category',$ProductCat->get_category_list());
        $this->assign('cur','product_category');
        $this->assign('ur_here',L('product_category'));
        $this->assign('action_link',array ( 'text' => L('product_category_add'),'href' => U('Product_category/create') ));
        $this->display();
    }

    public function create()
    {
        $ProductCat = D('Product_category');
        $this->assign('product_category',$ProductCat->get_category_list());
        $this->assign('cur','product_category');
        $this->assign('ur_here',L('product_category_add'));
        $this->assign('action_link',array ( 'text' => L('product_category'),'href' => U('Product_category/index') ));
        $this->display();
    }

    public function insert()
    {
        if(IS_POST){
            $ProductCat = D('Product_category');
            $result = $ProductCat->insert(
                                        I('post.cat_name'),
                                        I('post.unique_id'),
                                        I('post.parent_id'),
                                        I('post.keywords'),
                                        I('post.description'),
                                        I('post.sort')
                                    );
            switch($result){
                case -1 :
                    $this->error(L('product_category_name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('unique_id_wrong'));
                    break;
                default :
                    $this->log(L('product_category_add'),I('post.cat_name'));
                    $this->success(L('product_category_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    public function edit($cat_id=null)
    {
        $ProductCat = D('Product_category');
        $this->assign('category',$ProductCat->get_one_category($cat_id));
        $this->assign('product_category',$ProductCat->get_category_list());
        $this->assign('cur','product_category');
        $this->assign('ur_here',L('product_category_edit'));
        $this->assign('action_link',array ( 'text' => L('product_category'),'href' => U('Product_category/index') ));
        $this->display();
    }

    public function update()
    {
        if(IS_POST){
            $ProductCat = D('Product_category');
            $result = $ProductCat->update(
                                            I('post.cat_id'),
                                            I('post.cat_name'),
                                            I('post.unique_id'),
                                            I('post.parent_id'),
                                            I('post.keywords'),
                                            I('post.description'),
                                            I('post.sort')
                                        );
            switch($result){
                case -1 :
                    $this->error(L('product_category_name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('unique_id_wrong'));
                    break;
                default :
                    $this->log(L('product_category_edit'),I('post.cat_name'));
                    $this->success(L('product_category_edit_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    public function destroy($cat_id)
    {
        $ProductCat = D('Product_category');
        $result = $ProductCat->destroy($cat_id);
        switch($result['status']){
            case -2 :
                $this->error(sprintf(L('product_category_del_is_parent'),$result['cat_name']));
                break;
            default :
                $this->log(L('product_category_del'),$result['cat_name']);
                $this->success(L('del_succes'),U('Product_category/index'));
        }
    }

}