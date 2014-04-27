<?php
// +-----------------------------------------------------------------------
// | FileName: ModuleAction.class.php
// +-----------------------------------------------------------------------
// | Description: 后台模块信息管理Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2013-12-31 13:09:58
// +-----------------------------------------------------------------------
// | Alter Date: 2014-01-07 20:50:49
// +-----------------------------------------------------------------------

class ModuleAction extends CommonAction {
    /**
     *  显示文章列表
     */
    public function index() {
        $moduleD = D('Module');
        $where['classify'] = $_GET['classify'];
        $count = $moduleD->where($this->wnSearch('Module', $where))->count();   // 查询满足条件的总记录数
        $Page  = $this->wnOrderPage('id', $count);   // 分页操作
        $Page  = $Page[1];
        $order = $this->wnOrderPage('id', $count);   // 排序操作
        $order = $order[0];


        $list = $moduleD->where($this->wnSearch('Module', $where))->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->$where['classify']();    // 执行特定的模块方法
        $this->assign('list', $list);
        $this->display();
    }

    /**
     *  显示添加信息页面
     */
    public function add() {
        $this->$_GET['classify']();
        $this->assign('type', $_GET['type']);

        $type = array('local', 'url');
        $this->display('add'.$type[$_GET['type']]);
    }

    /**
     *  执行添加文章
     */
    public function doAdd() {
        $moduleD = D('Module');
        if(4 != $_FILES['img']['error']) {  // 错误码不等于4,即有文件上传
            $upfile = $this->uploadFiles();
            $_POST['img'] = $upfile[0]['savename'];
        }

        $moduleD->create();

        if(!$moduleD->add()) {
            $this->error('添加信息失败！请稍后再试。');
            return;
        }
        $this->success('添加信息成功！');
    }

    /**
     *  文章修改页面
     */
    public function edit() {
        $moduleD = D('Module');
        $moduleInfo = $moduleD->find($_GET['id']);
        $this->$moduleInfo['classify']();

        list($path, $name) = explode('/', $moduleInfo['img']);
        $moduleInfo['img'] = __ROOT__.'/Uploads/'.$path.'/s_'.$name;

        $this->assign('info', $moduleInfo);

        $type = array('local', 'url');
        $this->display('edit'.$type[$moduleInfo['type']]);
    }

    /**
     *  执行文章修改
     */
    public function doEdit() {
        $moduleD = D('Module');
        
        if(4 != $_FILES['img']['error']) {  // 错误码不等于4,即有文件上传
            $upfile = $this->uploadFiles();
            $_POST['img'] = $upfile[0]['savename'];
        }

        $moduleD->create();
        if(!$moduleD->save()) {
            $this->error('修改信息失败!');
            return;
        }
        $this->success('修改信息成功!');

    }

    /**
     *  删除方法
     */
    public function del() {
        $moduleD = D('Module');
        if(!$moduleD->where('id='.$_GET['id'])->delete()) {
            $this->error('删除信息失败!');
            return;
        }
        $this->success('删除信息成功!');
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

    /**
     *  公务员
     */
    public function gwy() {
        $this->assign('classname', '公务员');
        $this->assign('classify', 'gwy');
    }

    /**
     *  送调生
     */
    public function sds() {
        $this->assign('classname', '送调生');
        $this->assign('classify', 'sds');
    }

    /**
     *  事业单位
     */
    public function sydw() {
        $this->assign('classname', '事业单位');
        $this->assign('classify', 'sydw');
    }

    /**
     *  军转干部
     */
    public function jzgb() {
        $this->assign('classname', '军转干部');
        $this->assign('classify', 'jzgb');
    }

    /**
     *  政法干警
     */
    public function zfgj() {
        $this->assign('classname', '政法干警');
        $this->assign('classify', 'zfgj');
    }

    /**
     *  公安干警
     */
    public function gagj() {
        $this->assign('classname', '公安干警');
        $this->assign('classify', 'gagj');
    }

    /**
     *  村官
     */
    public function cg() {
        $this->assign('classname', '村官');
        $this->assign('classify', 'cg');
    }

    /**
     *  三支一扶
     */
    public function szyf() {
        $this->assign('classname', '三支一扶');
        $this->assign('classify', 'szyf');
    }
}
