<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/19
 * Time: 20:53
 */
namespace Admin\Controller;

use Admin\Model\FileUpload;

class ProjectController extends BasicController{

    public function index()
    {
        $ProjectCat = D('Project_category');
        $Project = D('Project');
        $this->page($Project->project_count(),10);     //分页

        $cat_id = $_REQUEST['cat_id'] ? $_REQUEST['cat_id'] : 0;

        $this->assign('project_category',$ProjectCat->get_category_list());
        $this->assign('project_list',$Project->get_project_list($cat_id,I('post.keyword'),10));
        $this->assign('keyword',I('post.keyword'));   //筛选关键字
        $this->assign('cat_id',$cat_id);    //筛选cat_id 用于分类选中

        $this->assign('cur','project');
        $this->assign('ur_here',L('project'));
        $this->assign('action_link',array ( 'text' => L('Project_add'),'href' => U('Project/create') ));
        $this->display();
    }

    /**
     *方案添加表单
     */
    public function create()
    {
        $ProjectCat = D('Project_category');

        // 格式化自定义参数，并存到数组$project，方案编辑页面中调用方案详情也是用数组$project，
        $defined_project = null;
        if ($this->config['defined']['project']) {
            $defined = explode(',', $this->config['defined']['project']);
            foreach ($defined as $value) {
                $defined_project .= $value . "：\n";
            }
            $project['defined'] = trim($defined_project);
            $project['defined_count'] = count(explode("\n", $project['defined'])) * 2;
        }

        $this->assign('project_category',$ProjectCat->get_category_list());
        $this->assign('project',$project);
        $this->assign('cur','project');
        $this->assign('ur_here',L('project_add'));
        $this->assign('action_link',array ( 'text' => L('project'),'href' => U('Project/index') ));
        $this->display();
    }

    /**
     *方案新增
     */
    public function insert()
    {
        if(IS_POST) {
            //缩略图上传
            if($_FILES['image']['name'] != ''){
                $Upload = new FileUpload();
                $image = $Upload->project_img_upload();
            }

            $Project = D('Project');
            $result = $Project->insert(
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
                    $this->error(L('project_name').L('is_empty'));
                    break;
                default :
                    $this->log(L('project_add'),I('post.title'));
                    $this->success(L('project_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *方案修改表单
     */
    public function edit($id = null)
    {
        $ProjectCat = D('Project_category');

        $Project = D('Project');
        $project = $Project->get_one_project($id);

        // 格式化自定义参数，并存到数组$project，方案编辑页面中调用方案详情也是用数组$project，
        $defined_project = null;
        if ($this->config['defined']['project'] || $project['defined']) {
            $defined = explode(',', $this->config['defined']['project']);
            foreach ($defined as $value) {
                $defined_project .= $value . "：\n";
            }
            $project['defined'] = $project['defined'] ? str_replace(",", "\n", $project['defined']) : trim($defined_project);
            $project['defined_count'] = count(explode("\n", $project['defined'])) * 2;
        }
        $this->assign('project_category',$ProjectCat->get_category_list());
        $this->assign('project',$project);
        $this->assign('cur','project');
        $this->assign('ur_here',L('project_edit'));
        $this->assign('action_link',array ( 'text' => L('project'),'href' => U('Project/index') ));
        $this->display();
    }

    /**
     *方案修改
     */
    public function update()
    {
        if(IS_POST) {
            //缩略图上传
            if($_FILES['image']['name'] != ''){
                $Upload = new FileUpload();
                $image = $Upload->project_img_upload();
                unlink_old_image(I('post.image'));   //删除旧图
            }
            $Project = D('Project');
            $result = $Project->update(
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
                    $this->error(L('project_name').L('is_empty'));
                    break;
                default :
                    $this->log(L('project_edit'),I('post.title'));
                    $this->success(L('project_edit_success'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }

    /**
     *方案删除
     */
    public function destroy($id = null)
    {
        $Project = D('Project');
        $result = $Project->destroy($id);
        $this->log(L('project_del'),$result['title']);
        $this->success(L('del_succes'),U('Project/index'));
    }

    /**
     *批量操作
     */
    public function action()
    {
        if(is_array(I('post.checkbox'))){
            $Project = D('Project');
            if(I('post.action') == 'del_all'){
                //批量删除方案
                $result = $Project->del_project_all(I('post.checkbox'));
                $this->log(L('del_all'),L('nav_project'). $result);
                $this->success(L('del_succes'),U('Project/index'));
            }elseif(I('post.action') == 'category_move'){
                //批量移动方案
                $result = $Project->category_move(I('post.checkbox'),I('post.new_cat_id'));
                $this->log(L('category_move_batch'),L('nav_project'). $result);
                $this->success(L('category_move_batch_succes'),U('Project/index'));
            }else{
                $this->error(L('select_empty'));
            }
        }else{
            $this->error(L('project_select_empty'));
        }
    }


}