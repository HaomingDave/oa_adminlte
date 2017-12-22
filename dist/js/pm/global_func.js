
pmServer="http://192.168.3.103";
pmWorkspace="workflow";
// username='admin';password='Yme20170101';
console.log("success");


//username='zhang3';password='123456789';
//username='chengcai';password='123456789';
//验证用户名和密码，若成功返回token
function access_token(username,password) {
    var jqxhr = $.ajax({
        type: "POST",
        url: pmServer+"/"+pmWorkspace+"/oauth2/token",
        dataType: 'json',

        // async:false,
        // insecure example of data to obtain access token and login:
        data: {
            grant_type: 'password',
            scope: '*',
            client_id: 'IUQJAIEVCRTHVPKKXMPEODHFNZYRZVNC',
            client_secret:  '66696166959376d0e7c0985050107001',
            username: username,
            password: password
        }
    })
        .done(function (data) {

            if (data.error) {
                alert("Error in login!\nError: " + data.error + "\nDescription: " + data.error_description);
            }
            else if (data.access_token) {
                //Can call REST endpoints here using the data.access_token.

                //To call REST endpoints later, save the access_token and refresh_token
                //as cookies that expire in one hour
                var d = new Date();
                // d.setTime(d.getTime() + 10000);
                d.setTime(d.getTime() + 60 * 60 * 1000);

                document.cookie = "access_token=" + data.access_token + "; expires=" + d.toUTCString();
                document.cookie = "refresh_token=" + data.refresh_token; //refresh token doesn't expire
                document.cookie = "username=" + username;//将用户名存到cookie里面去
                document.cookie = "pmServer=" + pmServer;//将服务器地址传到cookie里面去



                pmRestRequest("GET","/api/1.0/workflow/users?filter="+username,false,null,function(data, status){

                    if(data){
                      for(i=0;i<data.length;i++){
                        if(data[i].usr_username==username){
                          document.cookie = "usr_firstname="+data[i].usr_firstname;
                          document.cookie = "usr_lastname="+data[i].usr_lastname;
                          document.cookie = "usrid=" + data[i].usr_uid;
                          document.cookie = "reportsTo=" + data[i].usr_reports_to;
                          window.location.href="oaindex.php?usr="+username;//登录成功后把用户名作为get参数跳转到首页
                        }
                      }
                    }

                });







            }
            else {
                alert(JSON.stringify(data, null, 4)); //for debug
            }

        })
        .fail(function (data, statusText, xhr) {
            // alert("Failed to connect.\nHTTP status code: " + xhr.status + ' ' + statusText);
            alert("登录失败");
        });
}

function getCookie(name) {
    function escape(s) {
        return s.replace(/([.*+?\^${}()|\[\]\/\\])/g, '\\$1');
    };
    var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
    return match ? match[1] : null;
};

// access_token(username,password);

//重新获取Token
function pmRestRefresh(clientId, clientSecret, refreshToken, asynchronous) {
    clientId     = (typeof clientId === "undefined")     ? getCookie('client_id')     : clientId;
    clientSecret = (typeof clientSecret === "undefined")  ? getCookie('client_secret') : clientSecret;
    refreshToken = (typeof refreshToken === "undefined") ? getCookie('refresh_token') : refreshToken;
    asynchronous = (typeof asynchronous === "undefined") ? false                      : asynchronous;

    if (typeof XMLHttpRequest != "undefined") {
        var req = new XMLHttpRequest();
    }
    else {
        try {  //for IE 5, 5.5 & 6:
            var req = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e) {
            alert ("Error: This browser does not support XMLHttpRequest.");
            return;
        }
    }
    var oVars = {
        "grant_type":    "refresh_token",
        "client_id":     clientId,
        "client_secret": clientSecret,
        "refresh_token": refreshToken,
    };

    req.open('POST', pmServer + "/workflow/oauth2/token", false);
    var sVars = JSON.stringify(oVars);
    req.setRequestHeader('Content-type','application/json; charset=utf-8');
    req.setRequestHeader('Content-length', sVars.length);

    req.onreadystatechange = function() {
        if (req.readyState == 4) { //the request is completed
            var status = req.status;
            var oResp = null;

            if (req.responseText) {

                oResp = (JSON) ? JSON.parse(req.responseText) : eval(req.responseText);
            }

            if (oResp && oResp.error) {
                var msg = "Error code: " + oResp.error.code + "\nMessage: " + oResp.error.message;
                alert(msg);
                //throw error if wanting to handle it:
                //throw new Error(msg);
            }
            else if (status != 200) {
                alert("HTTP status error: " + req.status);
            }
            else {
                //save the access_token as cookie that expires in 60 minutes:
                var d = new Date();
                d.setTime(d.getTime() + 60*60*1000);
                // d.setTime(d.getTime() + 20000);
                document.cookie = "access_token="  + oResp.access_token + ";  expires=" + d.toUTCString();
                document.cookie = "refresh_token=" + oResp.refresh_token;
            }
        }
    };

    req.send(sVars);
}

//判断js对象类型 basic基本类型
getDataType = function(o){
if(typeof o == 'object'){
    if( typeof o.length == 'number' ){
        return 'Array';
    }else{
        return 'Object';
    }
}else{
    return 'Basic';
}
};

function pmRestRequest(method, endpoint, asynchronous, oVars, func) {
    //set optional parameters:
    asynchronous = (typeof asynchronous === 'undefined') ? false : asynchronous;
    oParams      = (typeof oParams === 'undefined')      ? null  : oParams;
    func         = (typeof func === 'undefined')         ? null  : func;

    console.log(getCookie("access_token"));
    while (!getCookie("access_token")) {
        pmRestRefresh('IUQJAIEVCRTHVPKKXMPEODHFNZYRZVNC','66696166959376d0e7c0985050107001');
    }

    if (typeof XMLHttpRequest != "undefined") {
        var req = new XMLHttpRequest();
    }
    else {
        try {  //for IE 5, 5.5 & 6:
            var req = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e) {
            alert ("Error: This browser does not support XMLHttpRequest.");
            return;
        }
    }

    req.open(method, pmServer + endpoint, asynchronous);
    req.setRequestHeader("Authorization", "Bearer " + getCookie("access_token"));
    sVars = null;
    method = method.toUpperCase().trim();

    switch (method) {
        case "GET":
        case "DELETE":
            break;
        case "PUT":
            //URL encode the values of any variables in oVars:
            if (oVars) {
                for (var v in oVars) {
                    if (oVars.hasOwnProperty(v)) {

                         if(getDataType(oVars[v])=='Object') {
                         for(var k in oVars[v]){
                         if(getDataType(oVars[v])=='Object'){
                         for(var j in oVars[v][k]){
                         oVars[v][k][j] = encodeURIComponent(oVars[v][k][j]);
                         }
                         }
                         }

                         }else {
                         oVars[v] = encodeURIComponent(oVars[v]);
                         }


                    }
                }
            }
        case "POST":
            var sVars = JSON.stringify(oVars);
            req.setRequestHeader('Content-type','application/json; charset=utf-8');
            // req.setRequestHeader('Content-length', sVars.length);
            break;
        default:
            alert("Error: Invalid HTTP method '" + url + "'.");
            return;
    }

    req.onreadystatechange = function() {

        if (req.readyState == 4) { //the request is completed
            var status = req.status;
            var oResp = null;

            if (req.responseText) {

                oResp = (JSON) ? JSON.parse(req.responseText) : eval(req.responseText);
                
            }

            if (!asynchronous) {
                httpStatus = status;
                oResponse = oResp;
            }
            if (status == 401) {
                alert("此请求没有授权");
                return;
            }
            else if (oResp && oResp.error) {
                var msg = "Error code: " + oResp.error.code + "\nMessage: " + oResp.error.message;
                alert(msg);
                //throw error if wanting to handle it:
                //throw new Error(msg);
            }
            else if (status != 200 && status != 201) {
                alert("HTTP status error: " + req.status);
                //throw error if wanting to handle it:
                //throw new Error("HTTP status error: " + req.status);
            }

            if (func) {  //call custom function to handle response:
                func(oResp, status);
            }
        }
    };

    if (asynchronous) {
        req.timeout   = 20000;   //timeout after 20 seconds
        req.ontimeout = function() { alert("Timed out calling " + $endpoint); };
    }
    req.send(sVars);
}



//js获取页面数据
function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
}

//点击登出返回,清除cookie里的内容
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
}
function clearCookie(name) {
  setCookie(name, "", -1);
}

//获取cookie
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
    }
    return "";
}

function keepSidebarStates(){
  var taskid = "#"+getUrlParam("taskid");
  var catid = "#"+getUrlParam("catid");
  $(taskid).addClass('active');
  $(".newcaselist").addClass('active');
  $(".newcaselist>ul").show();
  $(catid+">ul").show();

}


