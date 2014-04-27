<?php
// +-----------------------------------------------------------------------
// | FileName: MessageAction.class.php
// +-----------------------------------------------------------------------
// | Description: 后台留言信息管理Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2014-01-24 11:45:47
// +-----------------------------------------------------------------------
// | Alter Date:
// +-----------------------------------------------------------------------

class MessageAction extends CommonAction {
    /**
     *  显示留言信息列表
     */
    public function index() {
        $messageD = D('Message');
        $where['isreply'] = 0;
        $count = $messageD->where($this->wnSearch('Message', $where))->count();   // 查询满足条件的总记录数
        $Page  = $this->wnOrderPage('addtime', $count);   // 分页操作
        $Page  = $Page[1];
        $order = $this->wnOrderPage('id', $count);   // 排序操作
        $order = $order[0];

        $list = $messageD->where($this->wnSearch('Message', $where))->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list', $list);
        $this->display();
    }

    /**
     *  回复
     */
    public function reply() {
        $messageD = D('Message');
        $id = $_REQUEST['id'];

        $_POST['isreply'] = $id;
        $messageD->create();

        if(false == $messageD->add()) {
            $this->error('回复留言失败,请稍后再试!');
            return;
        }
        $this->success('回复留言成功!');
    }


    /**
     *  删除
     */
    public function del() {
        $messageD = D('Message');
        $id = $_REQUEST['id'];

        if($messageD->delete($id)) {
            $this->error('删除留言失败,请稍后再试!');
            return;
        }
        $this->success('删除留言成功!');
    }
}
