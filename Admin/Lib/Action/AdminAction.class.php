<?php
// +-----------------------------------------------------------------------
// | FileName: AdminAction.class.php
// +-----------------------------------------------------------------------
// | Description: 管理员模块Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2014-01-28 16:44:04
// +-----------------------------------------------------------------------
// | Alter Date:
// +-----------------------------------------------------------------------

class adminAction extends CommonAction {
    /**
     *  列表
     */
    public function index() {
        $adminD = D('Admin');

        $where['rubbish'] = -1;

        $count = $adminD->where($this->wnSearch('Admin', $where))->count();   // 查询满足条件的总记录数

        $Page  = $this->wnOrderPage('id', $count);   // 分页操作
        $Page  = $Page[1];
        $order = $this->wnOrderPage('id', $count);   // 排序操作
        $order = $order[0];

        $list = $adminD->where($this->wnSearch('Admin', $where))->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list', $list);
        $this->display($page);
    }

    /**
     *  添加页面
     */
    public function add() {
        $this->display();
    }

    /**
     *  执行添加
     */
    public function doAdd() {
        $adminD = D('Admin');
        

        // 处理密码
        if(!empty($_POST['password'])) {
            $_POST['password'] = md5($_POST['password']);
        }

        $adminD->create();

        if($adminD->add()) {
            $this->success('添加新管理员成功！');
        }else{
            $this->error('添加管理管理员失败！请稍后再试。');
        }
    }

    /**
     *  修改信息页面
     */
    public function edit() {
        $adminD = D('Admin');
        $adminInfo = $adminD->find($_REQUEST['id']);
        if(!$adminInfo) {
            $this->error('请通过正确途径选择修改信息!');
            return;
        }

        $this->assign('info', $adminInfo);
        $this->display();
    }

    /**
     *  执行修改
     */
    public function doEdit() {
        $adminD = D('Admin');
        
        // 处理密码
        if(!empty($_POST['password'])) {
            $_POST['password'] = md5($_POST['password']);
        }

        $adminD->create();
        if(!$adminD->save()) {
            $this->error('修改信息失败!');
            return;
        }
        $this->success('修改信息成功!');
    }

    /**
     *  锁定
     */
    public function lock() {
        $adminD = D('Admin');

        $data['id'] = $_REQUEST['id'];
        $data['status'] = -1;
        if($adminD->save($data) === false) {
            $this->error('锁定管理员账号失败,请您稍后再试!');
            return;
        }
        $this->success('锁定管理员账号成功!');
    }

    /**
     *  解锁
     */
    public function unLock() {
        $adminD = D('Admin');
        $data['id'] = $_REQUEST['id'];
        $data['status'] = 1;
        if($adminD->save($data) === false) {
            $this->error('解锁管理员账号失败,请您稍后再试!');
            return;
        }
        $this->success('解锁管理员账号成功!');
    }

    /**
     *  删除垃圾箱
     */
    public function del() {
        $adminD = D('Admin');
        $data['id'] = $_REQUEST['id'];
        $data['rubbish'] = 1;
        if($adminD->save($data) === false) {
            $this->error('删除管理员账号失败,请您稍后再试!');
            return;
        }
        $this->success('删除管理员账号成功!');
    }

    /**
     *  信息查看
     */
    public function show(){
        $adminD = D('Admin');
        $info = $adminD->find($_REQUEST['id']);
        if(!$info) {
            $this->error('您所选择管理员信息不存在,或操作有误,请您重试!');
            return;
        }
        $this->assign('info', $info);
        $this->display();
    }
}
