<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/19
 * Time: 20:53
 */
namespace Admin\Controller;

use Admin\Model\FileUpload;

class CaseController extends BasicController{

    public function index()
    {
        $CaseCat = D('CaseCategory');
        $Case = D('Case');
        $this->page($Case->case_count(),10);     //分页

        $cat_id = $_REQUEST['cat_id'] ? $_REQUEST['cat_id'] : 0;

        $this->assign('case_category',$CaseCat->get_category_list());
        $this->assign('case_list',$Case->get_case_list($cat_id,I('post.keyword'),10));
        $this->assign('keyword',I('post.keyword'));   //筛选关键字
        $this->assign('cat_id',$cat_id);    //筛选cat_id 用于分类选中

        $this->assign('cur','case');
        $this->assign('ur_here',L('case'));
        $this->assign('action_link',array ( 'text' => L('case_add'),'href' => U('Case/create') ));
        $this->display();
    }


    public function create()
    {
        $CaseCat = D('CaseCategory');

        $defined_case = null;
        if ($this->config['defined']['case']) {
            $defined = explode(',', $this->config['defined']['case']);
            foreach ($defined as $value) {
                $defined_case .= $value . "：\n";
            }
            $case['defined'] = trim($defined_case);
            $case['defined_count'] = count(explode("\n", $case['defined'])) * 2;
        }

        $this->assign('case_category',$CaseCat->get_category_list());
        $this->assign('case',$case);
        $this->assign('cur','case');
        $this->assign('ur_here',L('case_add'));
        $this->assign('action_link',array ( 'text' => L('case'),'href' => U('Case/index') ));
        $this->display();
    }


    public function insert()
    {
        if(IS_POST) {
            //缩略图上传
            if($_FILES['image']['name'] != ''){
                $Upload = new FileUpload();
                $image = $Upload->case_img_upload($this->config['thumb_width'],$this->config['thumb_height']);
            }
            $Case = D('Case');
            $result = $Case->insert(
                                        I('post.name'),
                                        I('post.cat_id'),
                                        I('post.defined'),
                                        I('post.content'),
                                        I('post.keywords'),
                                        I('post.description'),
                                        $image
                                    );
            switch($result){
                case -1 :
                    $this->error(L('case_name').L('is_empty'));
                    break;
                default :
                    $this->log(L('case_add'),I('post.name'));
                    $this->success(L('case_add_succes'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }


    public function edit($id = null)
    {
        $CaseCat = D('CaseCategory');
        $Case = D('Case');
        $case = $Case->get_one_case($id);


        $defined_case = null;
        if ($this->config['defined']['case'] || $case['defined']) {
            $defined = explode(',', $this->config['defined']['case']);
            foreach ($defined as $value) {
                $defined_case .= $value . "：\n";
            }
            $case['defined'] = $case['defined'] ? str_replace(",", "\n", $case['defined']) : trim($defined_case);
            $case['defined_count'] = count(explode("\n", $case['defined'])) * 2;
        }

        $this->assign('case_category',$CaseCat->get_category_list());
        $this->assign('case',$case);
        $this->assign('cur','case');
        $this->assign('ur_here',L('case_edit'));
        $this->assign('action_link',array ( 'text' => L('case'),'href' => U('Case/index') ));
        $this->display();
    }


    public function update()
    {
        if(IS_POST) {
            //缩略图上传
            if($_FILES['image']['name'] != ''){
                $Upload = new FileUpload();
                $image = $Upload->case_img_upload($this->config['thumb_width'],$this->config['thumb_height']);
                unlink_old_image(I('post.image'),C('CASE_UPLOAD'));   //删除旧图
            }
            $Case = D('Case');
            $result = $Case->update(
                                        I('post.id'),
                                        I('post.name'),
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
                    $this->error(L('case_name').L('is_empty'));
                    break;
                default :
                    $this->log(L('case_edit'),I('post.name'));
                    $this->success(L('case_edit_success'),'index');
            }
        }else{
            $this->error(L('illegal'));
        }
    }


    public function destroy($id = null)
    {
        $Case = D('Case');
        $result = $Case->destroy($id);
        $this->log(L('case_del'),$result['name']);
        $this->success(L('del_succes'),U('Case/index'));
    }


    public function re_thumb()
    {
        $Case = D('Case');
        $result = $Case->get_case_all();
        $count = $Case->case_count();

        $mask['count'] = sprintf(L('case_thumb_count'), $count);
        $mask_tag = '<i></i>';
        $mask['confirm'] = I('post.confirm');

        for($i = 1; $i <= $count; $i++){
            $mask['bg'] .= $mask_tag;
        }

        $this->assign('mask', $mask);
        $this->assign('cur','case');
        $this->assign('ur_here',L('case_thumb'));
        $this->assign('action_link',array ( 'text' => L('case'),'href' => U('Case/index') ));
        $this->display();

        //开始更新(生成缩略图)
        if (I('post.confirm')) {
            $upload = new FileUpload();
            echo ' ';
            foreach($result as $value){
                $image = explode('.',basename($value['image']));
                $thumb = C('CASE_UPLOAD') . 'thumb_' . $image[0] . '.' . $image[1];
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
            $Case = D('Case');
            if(I('post.action') == 'del_all'){
                //批量删除商品
                $result = $Case->del_case_all(I('post.checkbox'));
                $this->log(L('del_all'),L('nav_case'). $result);
                $this->success(L('del_succes'),U('Case/index'));
            }elseif(I('post.action') == 'category_move'){
                //批量移动商品
                $result = $Case->category_move(I('post.checkbox'),I('post.new_cat_id'));
                $this->log(L('category_move_batch'),L('nav_case'). $result);
                $this->success(L('category_move_batch_succes'),U('Case/index'));
            }else{
                $this->error(L('select_empty'));
            }
        }else{
            $this->error(L('case_select_empty'));
        }
    }


}