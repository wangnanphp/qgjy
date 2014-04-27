/**
 *  添加图库信息时调用此方法动态添加图片上传框
 */
function addPic() {
    // 回去要加入到内部的元素
    var pic = document.getElementById("pic");

    // 创建外层包裹的div
    var divWrap = document.createElement("div");
    divWrap.setAttribute('style', 'clear:both; margin:5px;');

    // 创建文件上传框
    var picFile = document.createElement("input");
    picFile.setAttribute("type", "file");
    picFile.setAttribute("name", "pic[]");
    picFile.setAttribute("style", "float:left; width:150px;");

    // 创建图片描述提示
    var spanS = document.createElement("span");
    spanS.setAttribute("style", "float:left; margin-left:55px;");
    spanS.innerHTML = "图片简介：";

    // 创建图片介绍框
    var picCont = document.createElement("textarea");
    picCont.setAttribute('name', 'cont[]');
    picCont.setAttribute('cols', '60');
    picCont.setAttribute('rows', '1');
    picCont.setAttribute('class', "textInput");

    var clearD = document.createElement("div");
    clearD.setAttribute("style", "clear:both");
    // 加入创建好的元素到包裹的div
    divWrap.appendChild(picFile);
    divWrap.appendChild(spanS);
    divWrap.appendChild(picCont);
    divWrap.appendChild(clearD);

    // 将创建好的元素整体加入页面
    pic.appendChild(divWrap);
}


/**
 *  修改图库时调用此方法动态删除已经存在的图片
 */
function delPic(anode) {
    $(anode).parent().empty();
    // var pnode = anode.parentNode;
    // pnode.firstChild.name="";
   // anode.parentNode.remove();
}
