<?php
// +-----------------------------------------------------------------------
// | FileName: ExamAction.class.php
// +-----------------------------------------------------------------------
// | Description: 招考信息管理Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2014-01-27 19:51:01
// +-----------------------------------------------------------------------
// | Alter Date:
// +-----------------------------------------------------------------------

class ExamAction extends CommonAction {
    /**
     *  List
     */
    public function index() {
        $examD = D('Exam');
        $count = $examD->where($this->wnSearch('Exam'))->count();   // 查询满足条件的总记录数
        $Page  = $this->wnOrderPage('id', $count);   // 分页操作
        $Page  = $Page[1];
        $order = $this->wnOrderPage('id', $count);   // 排序操作
        $order = $order[0];

        $list = $examD->where($this->wnSearch('Exam'))->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();

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
        $examD = D('Exam');

        $examD->create();

        if(!$examD->add()) {
            $this->error('添加信息失败！请稍后再试。');
            return;
        }
        $this->success('添加信息成功！');
    }

    /**
     *  修改页面
     */
    public function edit() {
        $examD = D('Exam');
        $examInfo = $examD->find($_GET['id']);

        $this->assign('info', $examInfo);
        $this->display();
    }

    /**
     *  执行修改
     */
    public function doEdit() {
        $examD = D('Exam');
        
        $examD->create();
        if(false === $examD->save()) {
            $this->error('修改信息失败,请稍后再试!');
            return;
        }
        $this->success('修改信息成功!');

    }

    /**
     *  删除方法
     */
    public function del() {
        $examD = D('Exam');
        if(!$examD->where('id='.$_GET['id'])->delete()) {
            $this->error('删除信息失败,请稍后再试!');
            return;
        }
        $this->success('删除信息成功!');
    }

    /**
     *  查看
     */
    public function show() {
        $examD = D('Exam');
        $examInfo = $examD->find($_GET['id']);

        $this->assign('info', $examInfo);
        $this->display();
    }
}
