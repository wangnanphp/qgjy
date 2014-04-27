<?php
// +-----------------------------------------------------------------------
// | FileName: companyAction.class.php
// +-----------------------------------------------------------------------
// | Description: 企业文化管理Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2014-01-29 15:48:37
// +-----------------------------------------------------------------------
// | Alter Date:
// +-----------------------------------------------------------------------

class companyAction extends CommonAction {
    /**
     *  显示信息列表
     */
    public function index() {
        $companyD = D('Company');
        $count = $companyD->where($this->wnSearch('Company'))->count();   // 查询满足条件的总记录数
        $Page  = $this->wnOrderPage('id', $count);   // 分页操作
        $Page  = $Page[1];
        $order = $this->wnOrderPage('id', $count);   // 排序操作
        $order = $order[0];

        $list = $companyD->where($this->wnSearch('Company'))->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list', $list);
        $this->display();
    }

    /**
     *  显示添加信息页面
     */
    public function add() {
        $this->display();
    }

    /**
     *  执行添加信息
     */
    public function doAdd() {
        $companyD = D('Company');
        if(4 != $_FILES['img']['error']) {  // 错误码不等于4,即有文件上传
            $upfile = $this->uploadFiles();
            $_POST['img'] = $upfile[0]['savename'];
        }

        $companyD->create();

        if(!$companyD->add()) {
            $this->error('添加信息失败！请稍后再试。');
            return;
        }
        $this->success('添加信息成功！');
    }

    /**
     *  修改页面
     */
    public function edit() {
        $companyD = D('Company');
        $companyInfo = $companyD->find($_GET['id']);

        /* 组装图片地址 */
        list($path, $name) = explode('/', $companyInfo['img']);
        $companyInfo['img'] = __ROOT__.'/Uploads/'.$path.'/s_'.$name;

        $this->assign('info', $companyInfo);
        $this->display('edit');
    }

    /**
     *  执行修改
     */
    public function doEdit() {
        $companyD = D('Company');
        
        /* 图片上传处理 */
        if(4 != $_FILES['img']['error']) {  // 错误码不等于4,即有文件上传
            $upfile = $this->uploadFiles();
            $_POST['img'] = $upfile[0]['savename'];
        }

        $companyD->create();
        if(false === $companyD->save()) {
            $this->error('修改信息失败,请稍后再试!');
            return;
        }
        $this->success('修改信息成功!');

    }

    /**
     *  删除方法
     */
    public function del() {
        $companyD = D('Company');
        if(!$companyD->where('id='.$_GET['id'])->delete()) {
            $this->error('删除信息失败,请稍后再试!');
            return;
        }
        $this->success('删除信息成功!');
    }

    /**
     *  查看
     */
    public function show() {
        $companyD = D('Company');
        $companyInfo = $companyD->find($_GET['id']);

        /* 组装图片地址 */
        list($path, $name) = explode('/', $companyInfo['img']);
        $companyInfo['img'] = __ROOT__.'/Uploads/'.$path.'/s_'.$name;

        $this->assign('info', $companyInfo);
        $this->display();
    }
}
