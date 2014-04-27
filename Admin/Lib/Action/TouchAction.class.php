<?php
// +-----------------------------------------------------------------------
// | FileName: TouchAction.class.php
// +-----------------------------------------------------------------------
// | Description: 联系我们信息管理Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2014-01-24 15:03:03
// +-----------------------------------------------------------------------
// | Alter Date:
// +-----------------------------------------------------------------------

class TouchAction extends CommonAction {
    /**
     *  查看
     */
    public function index() {
        $configD = D('Config');
        $where['key'] = array('in', array('phone','url','post','qq','qqg','addr','icp'));
        $config = $configD->where($where)->select();
        foreach($config as $k=>$v) {
            $configs[$v['key']] = $v['value'];
        }
        $this->assign('config', $configs);
        $this->display();
    }

    /**
     *  修改
     */
    public function edit() {
        $configD = D('Config');
        $configs = $configD->field('key')->select();
        foreach($configs as $v) {
            $configKeys[] = $v['key'];
        }

        $configD->startTrans();
        foreach($_POST as $k=>$v) {
            if(in_array($k, $configKeys)) {
                $data['value'] = $v;
                if(false === $configD->where("`key`='{$k}'")->save($data)) {
                    $configD->rollback();
                    $this->error('修改信息失败,请稍后再试!');
                    return;
                }
            }
        }

        $configD->commit();
        $this->success('修改信息成功!');
    }
}
