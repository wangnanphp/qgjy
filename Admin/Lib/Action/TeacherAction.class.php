<?php
// +-----------------------------------------------------------------------
// | FileName: TeacherAction.class.php
// +-----------------------------------------------------------------------
// | Description: 师资展示管理Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2014-01-25 15:10:07
// +-----------------------------------------------------------------------
// | Alter Date:
// +-----------------------------------------------------------------------

class TeacherAction extends CommonAction {
    /**
     *  显示信息列表
     */
    public function index() {
        $teacherD = D('Teacher');
        $count = $teacherD->where($this->wnSearch('Teacher'))->count();   // 查询满足条件的总记录数
        $Page  = $this->wnOrderPage('id', $count);   // 分页操作
        $Page  = $Page[1];
        $order = $this->wnOrderPage('id', $count);   // 排序操作
        $order = $order[0];

        $list = $teacherD->where($this->wnSearch('Teacher'))->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list', $list);
        $this->display();
    }

    /**
     *  显示添加信息页面
     */
    public function add() {
        $this->display('add');
    }

    /**
     *  执行添加信息
     */
    public function doAdd() {
        $teacherD = D('Teacher');
        if(4 != $_FILES['img']['error']) {  // 错误码不等于4,即有文件上传
            $upfile = $this->uploadFiles();
            $_POST['img'] = $upfile[0]['savename'];
        }

        $teacherD->create();

        if(!$teacherD->add()) {
            $this->error('添加信息失败！请稍后再试。');
            return;
        }
        $this->success('添加信息成功！');
    }

    /**
     *  文章修改页面
     */
    public function edit() {
        $teacherD = D('Teacher');
        $teacherInfo = $teacherD->find($_GET['id']);

        /* 组装图片地址 */
        list($path, $name) = explode('/', $teacherInfo['img']);
        $teacherInfo['img'] = __ROOT__.'/Uploads/'.$path.'/s_'.$name;

        $this->assign('info', $teacherInfo);
        $this->display('edit');
    }

    /**
     *  执行文章修改
     */
    public function doEdit() {
        $teacherD = D('Teacher');
        
        /* 图片上传处理 */
        if(4 != $_FILES['img']['error']) {  // 错误码不等于4,即有文件上传
            $upfile = $this->uploadFiles();
            $_POST['img'] = $upfile[0]['savename'];
        }

        $teacherD->create();
        if(false === $teacherD->save()) {
            $this->error('修改信息失败,请稍后再试!');
            return;
        }
        $this->success('修改信息成功!');

    }

    /**
     *  删除方法
     */
    public function del() {
        $teacherD = D('Teacher');
        if(!$teacherD->where('id='.$_GET['id'])->delete()) {
            $this->error('删除信息失败,请稍后再试!');
            return;
        }
        $this->success('删除信息成功!');
    }

    /**
     *  查看
     */
    public function show() {
        $teacherD = D('Teacher');
        $teacherInfo = $teacherD->find($_GET['id']);

        /* 组装图片地址 */
        list($path, $name) = explode('/', $teacherInfo['img']);
        $teacherInfo['img'] = __ROOT__.'/Uploads/'.$path.'/s_'.$name;

        $this->assign('info', $teacherInfo);
        $this->display();
    }

    /**
     *  文本编辑器图片上传
     */
    public function editImage() {
        if(4 != $_FILES['img']['error']) {  // 错误码不等于4,即有文件上传
            $upfile = $this->uploadFiles();
            $img['msg'] = __ROOT__.'/Uploads/'.$upfile[0]['savename'];
            $img['err'] = '';
            echo json_encode($img);
            exit;
        }
    }
}
