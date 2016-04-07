<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/19
 * Time: 20:53
 */
namespace Admin\Controller;

use Admin\Model\FileUpload;

class ArticleController extends BasicController{

    public function index()
    {
        $ArticleCat = D('Article_category');
        $Article = D('Article');
        $this->page($Article->article_count(),10);     //分页

        // 首页显示文章数量限制框
        $sort_bg = null;
        for($i = 1; $i <= $this->config['display']['home_article']; $i++) {
            $sort_bg .= "<li><em></em></li>";
        }
        $cat_id = $_REQUEST['cat_id'] ? $_REQUEST['cat_id'] : 0;

        $this->assign('article_category',$ArticleCat->get_category_list());
        $this->assign('article_list',$Article->get_article_list($cat_id,I('post.keyword'),10));
        $this->assign('sort',$Article->get_sort_article($this->config['display']['home_article']));    //首页显示文章
        $this->assign('keyword',I('post.keyword'));   //筛选关键字
        $this->assign('cat_id',$cat_id);    //筛选cat_id 用于分类选中
        $this->assign('if_sort',session('if_sort')); //文章筛选取消转换
        $this->assign('sort_bg',$sort_bg);
        $this->assign('cur','article');
        $this->assign('ur_here',L('article'));
        $this->assign('action_link',array ( 'text' => L('article_add'),'href' => U('Article/create') ));
        $this->display();
    }

    /**
     *文章添加表单
     */
    public function create()
    {
        $ArticleCat = D('Article_category');

        // 格式化自定义参数，并存到数组$product，商品编辑页面中调用商品详情也是用数组$product，
        $defined_article = null;
        if ($this->config['defined']['article']) {
            $defined = explode(',', $this->config['defined']['article']);
            foreach ($defined as $value) {
                $defined_article .= $value . "：\n";
            }
            $article['defined'] = trim($defined_article);
            $article['defined_count'] = count(explode("\n", $article['defined'])) * 2;
        }

        $this->assign('article_category',$ArticleCat->get_category_list());
        $this->assign('article',$article);
        $this->assign('cur','article');
        $this->assign('ur_here',L('article_add'));
        $this->assign('action_link',array ( 'text' => L('article'),'href' => U('Article/index') ));
        $this->display();
    }

    /**
     *文章新增
     */
    public function insert()
    {
        if(IS_POST) {
            //缩略图上传
            if($_FILES['image']['name'] != ''){
                $Upload = new FileUpload();
                $image = $Upload->article_img_upload();
            }

            $Article = D('Article');
            $result = $Article->insert(
                                        I('post.title'),
                                        I('post.cat_id'),
                                        I('post.defined'),
                                        I('post.content'),
                                        I('post.keywords'),
                                        I('post.description'),
                                        $image
                                    );
            switch($result){
                case -1 :
                    $this->error(L('article_name').L('is_empty'));
                    break;
                default :
                    $this->log(L('article_add'),I('post.title'));
                    $this->success(L('article_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *文章修改表单
     */
    public function edit($id = null)
    {
        $ArticleCat = D('Article_category');

        $Article = D('Article');
        $article = $Article->get_one_article($id);

        // 格式化自定义参数，并存到数组$product，文章编辑页面中调用文章详情也是用数组$product，
        $defined_article = null;
        if ($this->config['defined']['article'] || $article['defined']) {
            $defined = explode(',', $this->config['defined']['article']);
            foreach ($defined as $value) {
                $defined_article .= $value . "：\n";
            }
            $article['defined'] = $article['defined'] ? str_replace(",", "\n", $article['defined']) : trim($defined_article);
            $article['defined_count'] = count(explode("\n", $article['defined'])) * 2;
        }

        $this->assign('article_category',$ArticleCat->get_category_list());
        $this->assign('article',$article);
        $this->assign('cur','article');
        $this->assign('ur_here',L('article_edit'));
        $this->assign('action_link',array ( 'text' => L('article'),'href' => U('Article/index') ));
        $this->display();
    }

    /**
     *文章修改
     */
    public function update()
    {
        if(IS_POST) {
            //缩略图上传
            if($_FILES['image']['name'] != ''){
                $Upload = new FileUpload();
                $image = $Upload->article_img_upload();
                unlink_old_image(I('post.image'));   //删除旧图
            }
            $Article = D('Article');
            $result = $Article->update(
                                        I('post.id'),
                                        I('post.title'),
                                        I('post.cat_id'),
                                        I('post.defined'),
                                        I('post.content'),
                                        I('post.image'),
                                        I('post.keywords'),
                                        I('post.description'),
                                        $image
                                    );
            switch($result){
                case -1 :
                    $this->error(L('article_name').L('is_empty'));
                    break;
                default :
                    $this->log(L('article_edit'),I('post.title'));
                    $this->success(L('article_edit_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *文章删除
     */
    public function destroy($id = null)
    {
        $Article = D('Article');
        $result = $Article->destroy($id);
        $this->log(L('article_del'),$result['title']);
        $this->success(L('del_succes'),U('Article/index'));
    }

    /**
     *首页文章筛选
     */
    public function sort()
    {
        $_SESSION['if_sort'] = $_SESSION['if_sort'] ? false : true;
        // 跳转到上一页面
        header("Location:".$_SERVER['HTTP_REFERER']);
    }

    /**
     *首页文章显示设置
     */
    public function set_sort($id=null)
    {
        $Article = D('Article');
        $Article->set_sort($id);
        header("Location:".$_SERVER['HTTP_REFERER']);     // 跳转到上一页面
    }

    /**
     *首页文章显示取消
     */
    public function del_sort($id=null)
    {
        $Article = D('Article');
        $Article->del_sort($id);
        header("Location:".$_SERVER['HTTP_REFERER']);     // 跳转到上一页面
    }

    /**
     *批量操作
     */
    public function action()
    {
        if(is_array(I('post.checkbox'))){
            $Article = D('Article');
            if(I('post.action') == 'del_all'){
                //批量删除文章
                $result = $Article->del_article_all(I('post.checkbox'));
                $this->log(L('del_all'),L('top_add_article'). $result);
                $this->success(L('del_succes'),U('Article/index'));
            }elseif(I('post.action') == 'category_move'){
                //批量移动文章
                $result = $Article->category_move(I('post.checkbox'),I('post.new_cat_id'));
                $this->log(L('category_move_batch'),L('top_add_article'). $result);
                $this->success(L('category_move_batch_succes'),U('Article/index'));
            }else{
                $this->error(L('select_empty'));
            }
        }else{
            $this->error(L('article_select_empty'));
        }
    }


}