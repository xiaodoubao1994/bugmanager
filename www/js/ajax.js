function ajax(obj) {
    var type = obj["type"];
    var url = obj["url"];
    var data = obj["data"];
    var dataType = obj["dataType"];
    var success = obj["success"];
    if (data) {
        var str = "?";
        for (var i in data) {
            str += i + "=" + data[i] + "&";
        }
        str = str.substring(0, str.length - 1);    //最后做拼接时多了一个&，这里去除
        url = url + str;    //拼接处完整的地址
    }
    var req = new XMLHttpRequest();
    req.open(type, url, true);
    req.send();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var text = req.responseText;
            if (dataType == "json") {
                success(JSON.parse(text));
            } else {
                success(text);
            }
        }
    }
}

var currentUser;
function getCurrentUser(fn) {
    ajax({
        type: 'get',
        url: config.url + '/php/currentuser.php',
        dataType:"json",
        success: function(data) {
            currentUser = data;
            fn();
        }
    })
}

function logout() {
    ajax({
        type: 'get',
        url: config.url + '/php/logout.php',
        success: function(){
            // alert('退出成功')
            window.location.href = '../index.html'
        }
    })
}