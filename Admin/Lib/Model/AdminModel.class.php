<?php
// +-----------------------------------------------------------------------
// | FileName: AdminModel.class.php
// +-----------------------------------------------------------------------
// | Description: 管理员管理Model类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2014-01-28 18:03:52
// +-----------------------------------------------------------------------
// | Alter Date: 
// +-----------------------------------------------------------------------

class AdminModel extends Model{
    // 自动填充
    protected $_auto = array(
        array('addtime', 'time', 1, 'function'),
    );
}