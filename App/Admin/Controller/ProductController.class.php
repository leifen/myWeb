<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/19
 * Time: 20:53
 */
namespace Admin\Controller;

use Admin\Model\FileUpload;

class ProductController extends BasicController{

    public function index()
    {
        $ProductCat = D('ProductCategory');
        $Product = D('Product');
        $this->page($Product->product_count(),10);     //分页

        // 首页显示商品数量限制框
        $sort_bg = null;
        for($i = 1; $i <= $this->config['display']['home_product']; $i++) {
            $sort_bg .= "<li><em></em></li>";
        }
        $cat_id = $_REQUEST['cat_id'] ? $_REQUEST['cat_id'] : 0;

        $this->assign('product_category',$ProductCat->get_category_list());
        $this->assign('product_list',$Product->get_product_list($cat_id,I('post.keyword'),10));
        $this->assign('sort',$Product->get_sort_product($this->config['display']['home_product']));    //首页显示商品
        $this->assign('keyword',I('post.keyword'));   //筛选关键字
        $this->assign('cat_id',$cat_id);    //筛选cat_id 用于分类选中
        $this->assign('if_sort',session('if_sort')); //商品筛选取消转换
        $this->assign('sort_bg',$sort_bg);
        $this->assign('cur','product');
        $this->assign('ur_here',L('product'));
        $this->assign('action_link',array ( 'text' => L('product_add'),'href' => U('Product/create') ));
        $this->display();
    }

    /**
     *商品添加表单
     */
    public function create()
    {
        $ProductCat = D('ProductCategory');

        // 格式化自定义参数，并存到数组$product，商品编辑页面中调用商品详情也是用数组$product，
        $defined_product = null;
        if ($this->config['defined']['product']) {
            $defined = explode(',', $this->config['defined']['product']);
            foreach ($defined as $value) {
                $defined_product .= $value . "：\n";
            }
            $product['defined'] = trim($defined_product);
            $product['defined_count'] = count(explode("\n", $product['defined'])) * 2;
        }

        $this->assign('product_category',$ProductCat->get_category_list());
        $this->assign('product',$product);
        $this->assign('cur','product');
        $this->assign('ur_here',L('product_add'));
        $this->assign('action_link',array ( 'text' => L('product'),'href' => U('Product/index') ));
        $this->display();
    }

    /**
     *商品新增
     */
    public function insert()
    {
        if(IS_POST) {
            //缩略图上传
            if($_FILES['image']['name'] != ''){
                $Upload = new FileUpload();
                $image = $Upload->product_img_upload($this->config['thumb_width'],$this->config['thumb_height']);
            }
            $Product = D('Product');
            $result = $Product->insert(
                                        I('post.name'),
                                        I('post.cat_id'),
                                        I('post.price'),
                                        I('post.defined'),
                                        I('post.content'),
                                        I('post.keywords'),
                                        I('post.description'),
                                        $image
                                    );
            switch($result){
                case -1 :
                    $this->error(L('name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('price_wrong'));
                    break;
                default :
                    $this->log(L('product_add'),I('post.name'));
                    $this->success(L('product_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *商品修改表单
     */
    public function edit($id = null)
    {
        $ProductCat = D('ProductCategory');
        $Product = D('Product');
        $product = $Product->get_one_product($id);

        // 格式化自定义参数，并存到数组$product，商品编辑页面中调用商品详情也是用数组$product，
        $defined_product = null;
        if ($this->config['defined']['product'] || $product['defined']) {
            $defined = explode(',', $this->config['defined']['product']);
            foreach ($defined as $value) {
                $defined_product .= $value . "：\n";
            }
            $product['defined'] = $product['defined'] ? str_replace(",", "\n", $product['defined']) : trim($defined_product);
            $product['defined_count'] = count(explode("\n", $product['defined'])) * 2;
        }

        $this->assign('product_category',$ProductCat->get_category_list());
        $this->assign('product',$product);
        $this->assign('cur','product');
        $this->assign('ur_here',L('product_edit'));
        $this->assign('action_link',array ( 'text' => L('product'),'href' => U('Product/index') ));
        $this->display();
    }

    /**
     *商品修改
     */
    public function update()
    {
        if(IS_POST) {
            //缩略图上传
            if($_FILES['image']['name'] != ''){
                $Upload = new FileUpload();
                $image = $Upload->product_img_upload($this->config['thumb_width'],$this->config['thumb_height']);
                unlink_old_image(I('post.image'),C('PRODUCT_UPLOAD'));   //删除旧图
            }
            $Product = D('Product');
            $result = $Product->update(
                                        I('post.id'),
                                        I('post.name'),
                                        I('post.cat_id'),
                                        I('post.price'),
                                        I('post.defined'),
                                        I('post.content'),
                                        I('post.image'),
                                        I('post.keywords'),
                                        I('post.description'),
                                        $image
                                    );
            switch($result){
                case -1 :
                    $this->error(L('name').L('is_empty'));
                    break;
                case -2 :
                    $this->error(L('price_wrong'));
                    break;
                default :
                    $this->log(L('product_edit'),I('post.name'));
                    $this->success(L('product_edit_success'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *商品删除
     */
    public function destroy($id = null)
    {
        $Product = D('Product');
        $result = $Product->destroy($id);
        $this->log(L('product_del'),$result['name']);
        $this->success(L('del_succes'),U('Product/index'));
    }

    /**
     *首页商品筛选
     */
    public function sort()
    {
        $_SESSION['if_sort'] = $_SESSION['if_sort'] ? false : true;
        // 跳转到上一页面
        header("Location:".$_SERVER['HTTP_REFERER']);
    }

    /**
     *首页商品显示设置
     */
    public function set_sort($id=null)
    {
        $Product = D('Product');
        $Product->set_sort($id);
        header("Location:".$_SERVER['HTTP_REFERER']);     // 跳转到上一页面
    }

    /**
     *首页商品显示取消
     */
    public function del_sort($id=null)
    {
        $Product = D('Product');
        $Product->del_sort($id);
        header("Location:".$_SERVER['HTTP_REFERER']);     // 跳转到上一页面
    }

    /**
     *重新生成产品图片
     */
    public function re_thumb()
    {
        $Product = D('Product');
        $result = $Product->get_product_all();
        $count = $Product->product_count();

        $mask['count'] = sprintf(L('product_thumb_count'), $count);
        $mask_tag = '<i></i>';
        $mask['confirm'] = I('post.confirm');

        for($i = 1; $i <= $count; $i++){
            $mask['bg'] .= $mask_tag;
        }

        $this->assign('mask', $mask);
        $this->assign('cur','product');
        $this->assign('ur_here',L('product_thumb'));
        $this->assign('action_link',array ( 'text' => L('product'),'href' => U('Product/index') ));
        $this->display();

        //开始更新(生成缩略图)
        if (I('post.confirm')) {
            $upload = new FileUpload();
            echo ' ';
            foreach($result as $value){
                $image = explode('.',basename($value['image']));
                $thumb = C('PRODUCT_UPLOAD') . 'thumb_' . $image[0] . '.' . $image[1];
                $upload->thumb($value['image'],$this->config['thumb_width'],$this->config['thumb_height'],$thumb);
                echo "<script type=\"text/javascript\">mask('" . $mask_tag . "');</script>";
                flush();
                ob_flush();
            }
            echo "<script type=\"text/javascript\">success();</script>\n</body>\n</html>";
        }
    }

    /**
     *批量操作
     */
    public function action()
    {
        if(is_array(I('post.checkbox'))){
            $Product = D('Product');
            if(I('post.action') == 'del_all'){
                //批量删除商品
                $result = $Product->del_product_all(I('post.checkbox'));
                $this->log(L('del_all'),L('top_add_product'). $result);
                $this->success(L('del_succes'),U('Product/index'));
            }elseif(I('post.action') == 'category_move'){
                //批量移动商品
                $result = $Product->category_move(I('post.checkbox'),I('post.new_cat_id'));
                $this->log(L('category_move_batch'),L('top_add_product'). $result);
                $this->success(L('category_move_batch_succes'),U('Product/index'));
            }else{
                $this->error(L('select_empty'));
            }
        }else{
            $this->error(L('product_select_empty'));
        }
    }


}