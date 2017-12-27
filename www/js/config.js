
var config2 = {url: "http://qxu1152200052.my3w.com/bugproject"};
var config = {
    url: "http://192.168.71.86/bugmanage/www",
    type: { //用户类型
      "1": "项目经理",
      "2": "开发人员",
      "3": "测试人员"
    },
    status: { // bug状态
        "1": "待修改",
        "2": "待审核",
        "3": "已解决"
    },
    level: { //bug级别
        "1": "一般",
        "2": "严重",
        "3": "高危"
    }
}





function getElementsByClassName(classname) {    //兼容 class  属性查找
    var all = document.getElementsByTagName("*");//查询页面上的所有元素
    var list = [];
    for (var i = 0; i < all.length; i++) {
        var ele = all[i];//找到所有的元素

        var attr = ele.getAttribute("class");//getAttribute查找标签中带有class的属性
        if (attr == classname) {
            list.push(ele);
        }
    }
    return list;
}



// 分页
function page(ele, count, json) {
    this.ele = document.querySelector(ele);
    this.count = count;
    this.pageindex = 1;
    this.option = {
        shownum: 5,
        middlenum: 5,
        prevcontent: "上一页",
        nextcontent: "下一页",
        callback: function (pageindex) {
            // alert(pageindex);
        }
    };
    this.extend(json);
    this.create();
}
page.prototype.extend = function (json) {
    for (var i  in json) {
        this.option[i] = json[i];
    }
}
page.prototype.create = function () {//方法 动态生成page里面的内容
    var that = this;
    this.ele.innerHTML = "";
    this.prev = document.createElement("div");
    this.prev.className = "prev";
    this.prev.innerHTML = this.option.prevcontent;
    this.ele.appendChild(this.prev);

    this.content = document.createElement("ul");
    this.content.className = "content";
    var totalpage = Math.ceil(this.count / this.option.shownum); //获取总的页码数量
    this.totalpage = totalpage;
    //分为三部分 前  中   后
    //前
    var start = 1;
    var end = totalpage;
    var startmiddle = Math.floor(this.option.middlenum / 2);

    if (totalpage > this.option.middlenum) {
        end = this.option.middlenum;
    }
    if (this.pageindex <= startmiddle) {//比3还小  1   2
        start = 1;
    } else {
        start = this.pageindex - startmiddle;
        end = this.pageindex + startmiddle;
    }

    if (this.pageindex > totalpage - startmiddle) {
        start = totalpage - 2 * startmiddle;
    }

    end = end >= totalpage ? totalpage : end;
    start = start <= 1 ? 1 : start;


    for (let i = start; i <= end; i++) {
        var li = document.createElement("li");
        if (this.pageindex == i) {
            li.className = "selected";
        }
        li.innerHTML = i;
        li.onclick = function () {
            that.pageindex = i;
            that.create();

        }
        this.content.appendChild(li);
    }
    this.ele.appendChild(this.content);

    this.next = document.createElement("div");
    this.next.className = "next";
    this.next.innerHTML = this.option.nextcontent;
    this.ele.appendChild(this.next);
    this.bind();//绑定上下页的点击事件
    this.limit();//绑定以后做限制

//        alert(this.pageindex);
    this.option.callback(this.pageindex);
    this.showLi(this.pageindex,this.option.shownum);
}

page.prototype.limit = function () {

    if (this.totalpage == 1) {//表示总页码数只有一个
        this.prev.onclick = "";
        this.next.onclick = "";
    }
    if (this.pageindex == 1) {
        this.prev.onclick = "";
    }
    if (this.pageindex == this.totalpage) {
        this.next.onclick = "";
    }
}
page.prototype.setshownum = function (num) {
    this.option.shownum = num;
    this.pageindex = 1;
    this.create();
}
page.prototype.setmiddlemum = function (num) {
    this.option.middlenum = num;
    this.pageindex = 1;
    this.create();
}

page.prototype.bind = function () {
    var that = this;
    this.prev.onclick = function () {
        that.pageindex--;
        that.create();
    }
    this.next.onclick = function () {
        that.pageindex++;
        that.create();

    }
}
