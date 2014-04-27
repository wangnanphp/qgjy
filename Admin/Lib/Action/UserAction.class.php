<?php
// +-----------------------------------------------------------------------
// | FileName: UserAction.class.php
// +-----------------------------------------------------------------------
// | Description: 后台用户信息管理Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2014-01-07 20:51:07
// +-----------------------------------------------------------------------
// | Alter Date: 
// +-----------------------------------------------------------------------

class UserAction extends CommonAction {
    /**
     *  用户列表
     */
    public function index() {
        $moduleD = D('User');
        $count = $moduleD->where($this->wnSearch('User'))->count();   // 查询满足条件的总记录数
        $Page  = $this->wnOrderPage('id', $count);   // 分页操作
        $Page  = $Page[1];
        $order = $this->wnOrderPage('id', $count);   // 排序操作
        $order = $order[0];


        $list = $moduleD->where($this->wnSearch('User'))->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list', $list);
        $this->display();
    }

    /**
     *  设置用户等级页面
     */
    public function rank() {
        $id = $_REQUEST['id'];
        $user = D('User')->find($id);
        $this->assign('user', $user);
        $this->display();
    }

    /**
     *  设置用户等级
     */
    public function setRank() {
        $data['id']   = $_POST['id'];
        $data['rank'] = $_POST['rank'];
        if(!D('User')->save($data)) {
            $this->error('修改用户等级失败!');
            return;
        }
        $this->success('修改用户等级成功!');
    }

    /**
     *  设置用户状态
     */
    public function setStatus() {
        $data['id']     = $_REQUEST['id'];
        $data['status'] = $_REQUEST['status'];
        if(!D('User')->save($data)) {
            $this->error('修改用户状态失败!');
            return;
        }
        $this->success('修改用户状态成功!');
    }

    /**
     *  查看用户
     */
    public function show() {
        $id = $_REQUEST['id'];
        $user = D('User')->find($id);
        $this->assign('user', $user);
        $this->display();
    }

    /**
     *  删除用户
     */
    public function del() {
        if(empty($_GET['admid'])) {
            $this->error('请通过正常途径删除用户账号信息!');
            return;
        }
        if(D('User')->delete($_GET['admid'])) {
            $this->success('管理员账号删除成功!');
        }else {
            $this->error('管理员账号删除失败!');
        } 
    }
}
