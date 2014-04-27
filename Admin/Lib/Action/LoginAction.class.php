<?php
// +-----------------------------------------------------------------------
// | FileName: LoginAction.class.php
// +-----------------------------------------------------------------------
// | Description: 后台登录模块Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2013-12-27 23:34:34
// +-----------------------------------------------------------------------
// | Alter Date: 
// +-----------------------------------------------------------------------

class LoginAction extends Action {
    /**
     *  登录
     */
    public function index() {
        if(!empty($_SESSION['admin'])) {    // 已经登录
            $this->redirect(U('Index/index'));
            exit;
        }

        $this->display();
    }

    /**
     *  执行登录
     */
    public function doLogin() {
        // 标准化数据
        $where['loginName'] = trim($_POST['loginname']);
        $where['password']  = md5($_POST['password']);

        // 验证登录
        if(!$admin = D('Admin')->where($where)->find()) {
            $this->error('登录信息验证失败,请重新输入!', 'index');
            exit;
        }

        if(0 === $admin['status']) {  // 判断管理员状态
            $this->error('您的账号已被锁定,请联系系统管理员!', 'index');
            exit;
        }

        // 登录成功,写入SESSION并跳转
        $_SESSION['admin'] = $admin;
        $this->redirect(U('Index/index'));
    }

    /**
     *  登出
     */
    public function logout() {
        if(!empty($_SESSION['admin'])) {
            $_SESSION['admin'] = array();
            unset($_SESSION['admin']);
        }

        $this->success('成功退出系统!', 'index');
    }
}
