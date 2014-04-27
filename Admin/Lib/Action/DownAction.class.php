<?php
// +-----------------------------------------------------------------------
// | FileName: DownAction.class.php
// +-----------------------------------------------------------------------
// | Description: 资料下载模块Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2014-01-28 18:26:55
// +-----------------------------------------------------------------------
// | Alter Date:
// +-----------------------------------------------------------------------

class DownAction extends CommonAction {
    /**
     *  List
     */
    public function index() {
        $downD = D('Down');
        $count = $downD->where($this->wnSearch('Down'))->count();   // 查询满足条件的总记录数
        $Page  = $this->wnOrderPage('id', $count);   // 分页操作
        $Page  = $Page[1];
        $order = $this->wnOrderPage('id', $count);   // 排序操作
        $order = $order[0];

        $list = $downD->where($this->wnSearch('Down'))->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();

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
        $downD = D('Down');
        if(4 != $_FILES['img']['error']) {  // 错误码不等于4,即有文件上传
            $upfile = $this->upFile();
            $_POST['downpath'] = $upfile[0]['savename'];
        }

        $downD->create();

        if(!$downD->add()) {
            $this->error('添加信息失败！请稍后再试。');
            return;
        }
        $this->success('添加信息成功！');
    }

    /**
     *  修改页面
     */
    public function edit() {
        $downD = D('Down');
        $downInfo = $downD->find($_GET['id']);

        /* 组装文件地址 */
        $downInfo['downpath'] = __ROOT__.'/Uploads/Files/'.$downInfo['downpath'];

        $this->assign('info', $downInfo);
        $this->display('edit');
    }

    /**
     *  执行修改
     */
    public function doEdit() {
        $downD = D('Down');
        
        /* 文件上传处理 */
        if(4 != $_FILES['img']['error']) {  // 错误码不等于4,即有文件上传
            $upfile = $this->upFile();
            $_POST['downpath'] = $upfile[0]['savename'];
        }

        $downD->create();
        if(false === $downD->save()) {
            $this->error('修改信息失败,请稍后再试!');
            return;
        }
        $this->success('修改信息成功!');

    }

    /**
     *  删除方法
     */
    public function del() {
        $downD = D('Down');
        if(!$downD->where('id='.$_GET['id'])->delete()) {
            $this->error('删除信息失败,请稍后再试!');
            return;
        }
        $this->success('删除信息成功!');
    }

    /**
     *  查看
     */
    public function show() {
        $downD = D('Down');
        $downInfo = $downD->find($_GET['id']);

        /* 组装文件地址 */
        $downInfo['downpath'] = __ROOT__.'/Uploads/Files/'.$downInfo['downpath'];

        $this->assign('info', $downInfo);
        $this->display();
    }

    /**
     *  文件上传方法
     */
    private function upFile($allowExts = array(), $savePath='./Uploads/Files/') {
        import('ORG.Net.UploadFile');   // 导入上传类
        $upload = new UploadFile();     // 实例化上传类

        $upload->savePath   =  $savePath;   // 设置附件上传目录
        $upload->autoSub    = true;         // 是否使用子目录保存上传文件
        $upload->subType    = 'date';       // 子目录创建格式
        $upload->dateFormat = 'Ymd';        // 指定子目录为data时的日期格式
        //$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

        if(!$upload->upload()) {  // 执行上传操作
            // 上传错误提示错误信息,并退出程序
            $this->error($upload->getErrorMsg());
            exit;
        }

        return $upload->getUploadFileInfo();    // 返回成功信息
    }
}
