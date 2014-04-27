<?php
// +-----------------------------------------------------------------------
// | FileName: ModuleModel.class.php
// +-----------------------------------------------------------------------
// | Description: 模块管理Model类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2014-01-02 23:14:24
// +-----------------------------------------------------------------------
// | Alter Date: 2014-01-02 23:19:53
// +-----------------------------------------------------------------------

class ModuleModel extends Model{
    // 自动填充
    protected $_auto = array(
        array('admid', 'get_admid', 3, 'function'),
        array('admname', 'get_admname', 3, 'function'),
        array('addtime', 'time', 1, 'function'),
        array('updatetime', 'time', 2, 'function'),
    );
}
