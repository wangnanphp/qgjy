<?php
// +----------------------------------------------------------------------
// | FileName: config.php
// +----------------------------------------------------------------------
// | Description: 系统后台配置文件
// +----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2013-12-27 22:37:39
// +-----------------------------------------------------------------------
// | Alter Date: 2013-12-27 22:38:21
// +-----------------------------------------------------------------------

// 导入公共配置文件
$config1 = require './config.inc.php';

// 当前应用的配置
$config = array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => array(   // 自定义模板替换规则
    '__CSS__'    => __ROOT__."/Admin/Tpl/Public/Css/",     // 增加新的CSS文件存放的文件夹替换规则
    '__JS__'     => __ROOT__."/Admin/Tpl/Public/Js/",      // 增加新的JS类库替换规则
    '__IMAGES__' => __ROOT__."/Admin/Tpl/Public/Images/",  // 增加新的Images路径替换规则
    ),
);

// 返回组合后的配置信息
return array_merge($config1, $config);