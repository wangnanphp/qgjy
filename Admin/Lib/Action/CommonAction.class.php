<?php
// +-----------------------------------------------------------------------
// | FileName: CommonAction.class.php
// +-----------------------------------------------------------------------
// | Description: 后台公共Action类
// +-----------------------------------------------------------------------
// | Author: 王南
// +-----------------------------------------------------------------------
// | Create Date: 2013-12-27 22:47:35
// +-----------------------------------------------------------------------
// | Alter Date: 2013-12-27 23:44:14
// +-----------------------------------------------------------------------

class CommonAction extends Action {
    /**
     *  类初始化方法
     */ 
    public function _initialize() {
		//if(!empty($_SESSION['admin'])){   // 验证用户是否登录
        //    $this->redirect('Index/index');
		//}
    }

    /**
     *  分页排序方法,返回Page对象和排序规则组成的数组
     */
    protected function wnOrderPage($order, $count) {
        // 排序处理
        $order = "`{$order}` DESC";  // 先给默认按id排序规则
        if(!empty($_REQUEST['_order'])) {  // 判断是否有排序规则传入
            $order = $_REQUEST['_order'] .' '.$_REQUEST['_sort'];
        }

        /* 分页处理 */
        // 每页显示条数
        $numPerPage = !empty($_REQUEST['numPerPage']) ? $_REQUEST['numPerPage'] : 15; // 如果没有每页显示多少条传入,则默认显示15条
        // 当前页
        $_GET['p']  = $_REQUEST['pageNum'] + 0; // 转换参数实现当前分页号的传递(如果$_REQUEST['pageNum']为空时,他加上0将为0)

        import('ORG.Util.Page');  // 导入分页类
        // 实例化分页类,传入总记录条数和每页显示的记录数
        $Page = new Page($count, $numPerPage);

        // 封装分页信息
        $this->assign('totalCount', $count);
        $this->assign('numPerPage', $numPerPage);
        $this->assign('currentPage', $_REQUEST['pageNum']);
        return array($order,  $Page);
    }

    /**
     *  搜索查询方法,返回$where条件
     */
    protected function wnSearch($modelName, $search=array()) {
        // 实例化要搜索的模型
        $model = M($modelName);
        // 获取所有的模型字段
        $fields = $model->getDbFields();

        // 定义要返回的map查询条件
		$map   = array();
        $where = array();
		
		// 处理表单搜索条件
        if((!empty($_REQUEST['keyword'])) && (!empty($_REQUEST['field']))) {  // 判断是否有搜索条件传入
            $field = explode(',', $_REQUEST['field']);
            foreach($field as $v) {  // 循环组装搜索条件
                if(in_array(trim($v), $fields)) {
					$where[$v] = array('like', "%{$_REQUEST['keyword']}%");
                }
            }
            $where['_logic'] = 'OR';
        }
        
        // 处理额外的搜索条件
        if(!empty($search)) {
            foreach($search as $sk=>$sv) {
                if(in_array($sk, $fields)) {
                    $map[$sk] = array('eq', $sv);
                }
            }
        }
        
        // 拼装整体的$查询条件
        if(!empty($where)) {
            $map['_complex'] = $where;
        }
		
        return $map;
    }

    /**
     *  文件上传方法
     */
    public function uploadFiles($allowExts = array(), $savePath='./Uploads/') {
        import('ORG.Net.UploadFile');   // 导入上传类
        $upload = new UploadFile();     // 实例化上传类

        $upload->savePath   =  $savePath;   // 设置附件上传目录
        $upload->autoSub    = true;         // 是否使用子目录保存上传文件
        $upload->subType    = 'date';       // 子目录创建格式
        $upload->dateFormat = 'Ymd';        // 指定子目录为data时的日期格式
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

        $upload->thumb          = true;          // 缩略处理
        $upload->thumbMaxWidth  = '150,400,800'; // 缩放的宽
        $upload->thumbMaxHeight = '90,300,600';  // 缩放的高
        $upload->thumbPrefix    = 's_,m_,b_';    // 缩略图前缀
        //$upload->thumbRemoveOrigin = true;       // 生成缩略图后是否删除原图
        //$upload->thumbPath      = 's,m,b';     // 缩略图的保存路径
        
        if(!$upload->upload()) {  // 执行上传操作
            // 上传错误提示错误信息,并退出程序
            $this->error($upload->getErrorMsg());
            exit;
        }

        return $upload->getUploadFileInfo();    // 返回成功信息
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
}
