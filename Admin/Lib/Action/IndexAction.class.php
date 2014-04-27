<?php
// +-----------------------------------------------------------------------
// | FileName: IndexAction.class.php
// +-----------------------------------------------------------------------
// | Description: 后台主框架入口模板Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2013-12-27 21:26:48
// +-----------------------------------------------------------------------
// | Alter Date: 
// +-----------------------------------------------------------------------

class IndexAction extends CommonAction {
    /**
     *  显示后台主框架模板
     */
    public function index(){
        // 调用服务器信息方法
        $this->serverInfo();
        // 调用管理员信息方法
        //$this->adminInfo();
		
        $this->display();
    }

    /**
     *  服务器环境信息
     */
    public function serverInfo() {
        $info['SERVER_ADDR'] = $_SERVER['SERVER_ADDR'];
        $info['SERVER_PORT'] = $_SERVER['SERVER_PORT'];
        $info['soft']        = $_SERVER['SERVER_SOFTWARE'];
        $info['mysql']       = mysql_get_server_info();
        $this->assign('info', $info);
    }

    /**
     *  登录管理员信息
     */
    public function adminInfo() {
        // 查询管理员基本信息
        $admin = D('Admin')->field('admid,realname,lastlogintime,lastloginip')->find($_SESSION['admin']['admid']);

        // 判断是否有角色
        $this->assign('admin', $admin);
    }
}
