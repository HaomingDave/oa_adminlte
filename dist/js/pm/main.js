//这个文件保存页面的js逻辑代码，但是是保存每个页面都需要的公共逻辑代码



//点击导航栏的登出按钮，返回
function logout(){
  $("#logoutbtn").click(function(){
    clearCookie("access_token");
    clearCookie("refresh_token");
    clearCookie("username");
    clearCookie("usr_lastname");
    clearCookie("usr_firstname");
    console.log("refresh_token");
    window.location.href="login.php";
  });
}

function getUserInfo(){

  var username = getCookie("username");
  pmRestRequest("GET","/api/1.0/workflow/users?filter="+username,false,null,function(data, status){
      if(data){
        for(i=0;i<data.length;i++){
          if(data[i].usr_username == username){
            $("#usr_lastname").attr("value",data[i].usr_lastname);
            $("#usr_firstname").attr("value",data[i].usr_firstname);
            $("#phonenumber").attr("value",data[i].usr_phone);
            $("#usrstatus").attr("value",data[i].usr_status);
            $("#username1").attr("value",data[i].usr_username);
            $("#email").attr("value",data[i].usr_email);
            $("#location").attr("value",data[i].usr_location);
            $("#zipcode").attr("value",data[i].usr_zip_code);
            $("#substitue").attr("value",data[i].usr_replaced_by);
            $("#role").attr("value",data[i].usr_role);

          }
        }
      }

  });
}

//从cookie获取用户名，并显示在页面右上角
function getUsername(){

    $("#username").html(getCookie("usr_lastname")+getCookie("usr_firstname"));
    $(".user-header p").html(getCookie("usr_lastname")+getCookie("usr_firstname"));

}



// 从后台读取侧边栏数据，并更新侧边栏选项

function getCatAndProj(){
  var projects=[];
  var categories=[];
  var relations=[];
  cats = '';

  pmRestRequest("GET","/api/1.0/workflow/case/start-cases",false,null,function(data, status){

    if(data){
      projects=data;
    }else{
      alert("access data error");
    }

  });
  pmRestRequest("GET","/api/1.0/workflow/project/categories",false,null,function(data, status){

    if(data){
      categories=data;
    }else{
      alert("access data error");
    }
  });
  pmRestRequest("GET","/api/1.0/workflow/project",false,null,function(data, status){

    if(data){
      relations=data;
    }else{
      alert("access data error");
    }
  });


  for(var a = 0; a < categories.length; a++){
    cats = cats+'<li class="" id="cat'+a+'"><a href="#"><i class="fa fa-circle-o"></i>'
               +categories[a].cat_name
               +'申请<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>'
               +'<ul class="treeview-menu" style="display: none;">'


               for(var b = 0; b < projects.length; b++){
                 for(var c = 0; c < relations.length; c++){
                   if (relations[c].prj_category===categories[a].cat_uid && relations[c].prj_uid===projects[b].pro_uid) {
                     cats = cats+'<li class="" id="task'+b+'"'+'><a href="newcase.php?caseid='+projects[b].pro_uid+'&tas_uid='+projects[b].tas_uid
                                +'&taskid=task'+b+'&catid=cat'+a+'">'
                                +'<i class="fa fa-circle-o"></i>'
                                +projects[b].pro_title
                                +'</a></li>'
                   }

                 }


               }
    cats = cats+'</ul></li>'
  }
  // console.log(cats);
  $("#caselists").html(cats);



}




//生成动态表单
// function generateForm(pro_uid,tas_uid){
//
//
//   var app_uid;
function newcase(pro_uid,tas_uid){

        var oVars = {
            'pro_uid'  : pro_uid,
            'tas_uid'  : tas_uid,
        };
        pmRestRequest("POST","/api/1.0/workflow/cases", true,oVars,  function(data, status){
           if(data){
               var app_uid = data.app_uid;
               step(pro_uid,tas_uid,app_uid);

           }

        });

}
function step(pro_uid,tas_uid,app_uid){
    pmRestRequest("GET","/api/1.0/workflow/project/"+pro_uid+"/activity/"+tas_uid+"/steps",true, null, function(data, status){

    if(data){
        var step_uid_obj=data[0].step_uid_obj;
        // var step_position=oResp[0].step_position;
        variables(pro_uid, step_uid_obj, app_uid,tas_uid);
       // dynaform(pro_uid,step_uid_obj);


    }

});

}
function variables(pro_uid,step_uid_obj,app_uid,tas_uid){


    pmRestRequest("GET","/api/1.0/workflow/cases/"+app_uid+"/variables",true,null,function(data, status){

        if(data){
           dynaform(pro_uid,step_uid_obj,data,app_uid,tas_uid);
        }

});
}
function dynaform(pro_uid,step_uid,variables,app_uid,tas_uid){

pmRestRequest("GET","/api/1.0/workflow/project/"+pro_uid+"/dynaform/"+step_uid,true,null,function(data, status){

    if(data){
        var dynaformContent = JSON.parse(data.dyn_content);
        var fields = dynaformContent.items[0].items;

        var targetControl = $('#dynaform');
       // var variables=[];
        SFControls.generateUIForm(targetControl, fields,variables);
        console.log(fields);
        console.log(variables);
       /*
        $(".form_datetime").datetimepicker({

            autoclose: true,
            todayBtn: true,
            startDate: "2013-02-14 10:00",
            minuteStep: 10
        });
        */
        var gridContainer = null;
        if($('.pmdynaform-grid-container').length > 0)
        {
            gridContainer = $('.pmdynaform-grid-container');
            $('.btn-grid-new-row', $('.pmdynaform-grid-container')).on('click',function(){
                var newRow = '<div class="grid">'
                            +    $('.grid', gridContainer).html()
                            +  '</div>';

                $('.pmdynaform-grid-tbody').append(newRow);
            });
            $('.delete', $('.pmdynaform-grid-container')).on('click',function(){
                    alert(1);
                    console.log($(this).parent().parent());
               // $('.pmdynaform-grid-tbody').append(newRow);
            });

        }
        //提交表单按钮绑定，将表单数据存入后台数据库
        $(document).on('click','#sub',function(){
            var datas=$('#dynaformsub').serializeArray();
            var data=$('#dynaformsub').serializeJson();
            var variables = handleTableFormData(data);
            console.log(data);
            console.log(variables);
            pmRestRequest("PUT","/api/1.0/workflow/cases/" + app_uid + "/variable",false, variables,function(data_put, status){
                if(status==200){
                    //  location.href="route.php?app_uid="+app_uid+"&pro_uid="+pro_uid+"&tas_uid="+tas_uid;
                    selectSuber(app_uid,pro_uid,tas_uid,data);
                    $("#lid").show();
                    $("#subpopup").show();

                    // alert("请选择提交人");


                }
            });
        });

        $("#USER_NUMBER").change(function () {
            pmRestRequest("GET","/api/1.0/workflow/user/"+getCookie("usrid"),false, variables,function(data, status){


                    // for(var i=0; i<fields.length; i++){
                    //     var row = fields[i];
                    //     for(var j=0; j<row.length; j++){
                    //         switch (row[j].type){
                    //             case "text":
                    //                 var sql = row[j].sql;
                    //                 $.ajax({
                    //                     url:"../controller/securityInterface.php?action=OpenCase",
                    //                     type:"GET",
                    //                     dataType:"json",
                    //                     data:{
                    //                         sql:sql
                    //                     }
                    //
                    //                 })
                    //                     .done(function (res) {
                    //                         console.log(res);
                    //                     })
                    //                     .fail(function () {
                    //                         console.log("fail");
                    //                     });
                    //                 // $('"#'+row[j].id+'"').val() =
                    //                 break;
                    //         }
                    //     }
                    // }

                    var inputs = $("#dynaform input");

                    for (var i= 0;i< inputs.length;i++){
                        // console.log(inputs[i]);
                        var sql = inputs[i].getAttribute("data-sql");
                        if ($("#USER_NUMBER").val() === data.usr_zip_code){
                            if(sql!=="" && sql!==null){
                                sql = sql.split("=");
                                sql = sql[0] + '='+ "'"+data.usr_zip_code+"'";
                                $.ajax({
                                    url:"../controller/securityInterface.php?action=OpenCase",
                                    type:"GET",
                                    dataType:"json",
                                    async: false,
                                    data:{
                                        sql:sql
                                    }

                                })
                                    .done(function (res) {
                                        var fillContent;
                                        for(var item in res.output[0]){

                                            fillContent = res.output[0][item];

                                        }


                                        inputs[i].value = fillContent;


                                    })
                                    .fail(function (data, statusText, xhr) {
                                        console.log(statusText);
                                    });
                            }
                        }else {
                            var workNumber = $("#USER_NUMBER").val();
                            inputs[i].value = "";
                            $("#USER_NUMBER").val(workNumber);
                        }

                    }

            });
        })



    }

});


}

//将表单数据（字符串）转成json格式对象
(function($){
$.fn.serializeJson=function(){
    var serializeObj={};
    var array=this.serializeArray();
    var str=this.serialize();
    $(array).each(function(){
        if(serializeObj[this.name]){
            if($.isArray(serializeObj[this.name])){
                serializeObj[this.name].push(this.value);
            }else{
                serializeObj[this.name]=[serializeObj[this.name],this.value];
            }
        }else{
            serializeObj[this.name]=this.value;
        }
    });
    return serializeObj;
};
})(jQuery);

// //提交表单按钮绑定，将表单数据存入后台数据库
// $(document).on('click','#sub',function(){
// var datas=$('#dynaformsub').serializeArray();
// var data=$('#dynaformsub').serializeJson();
// var variables = handleTableFormData(data);
// console.log(data);
// console.log(variables);
// pmRestRequest("PUT","/api/1.0/workflow/cases/" + app_uid + "/variable",false, variables,function(data, status){
//     if(status==200){
//       //  location.href="route.php?app_uid="+app_uid+"&pro_uid="+pro_uid+"&tas_uid="+tas_uid;
//       selectSuber(app_uid,pro_uid,tas_uid);
//       $("#lid").show();
//       $("#subpopup").show();
//
//       // alert("请选择提交人");
//
//
//     }
// });
// });

//将表单提交的数据的json格式转换成需要的形式
var handleTableFormData = function(obj) {
var results = {};
var rule = /^(\w+)(\[)(\w+)(\])$/;
$.each(obj, function (key, value) {

    var arr = key.match(rule);

    if (arr == undefined || arr == null) {
        results[key] = value;
    } else {

        var v = arr[1];
        var k = arr[3];
        if (results[v] == undefined) {
            results[v] = {};

        }
        for (var i = 0; i < value.length; i++) {
            if (results[v][i + 1] == undefined) {
                results[v][i + 1] = {};
            }
            results[v][i + 1][k] = value[i];
        }

    }
});
return results;

};




//   newcase(pro_uid,tas_uid);
// }

function readForm(pro_uid,tas_uid,app_uid){


}

var SFControls1 = function() {

    var drawUIInputControl = function(col,data){
        var html = '';
        var formdata= (data!==undefined&& data[col.variable]==undefined) ? col.defaultValue : data[col.variable];
        switch(col.type){
            case 'label':
                break;
            case 'title':
                // html =   '<h1>' + col.label + '<h1/>';
                html = '<div class="box-header"><div class="section-divider"><span id="data">'
                       +col.label
                       +'</span></div></div>'
                break;
            case 'subtitle':
                html =   '<h2>' + col.label + '<h2/>';
                break;
            case 'radio':
                html =   '<label class="col-sm-2 col-md-2 col-lg-2 " for="contactform-name">'+col.label+'</label>'
                    +'<div class="col-sm-'+(col.colSpan*1-2)+' col-md-'+(col.colSpan*1-2)+' col-lg-'+(col.colSpan*1-2)+' ">'
                    +'<div>'
                    +options(col)
                    +'</div>'
                    +'</div>';
                break;
            case 'datetime':
                var formdata= (data!==undefined&& data[col.variable]==undefined) ? col.defaultDate : data[col.variable];
                html =  '<label class="col-sm-2 col-md-2 col-lg-2 " for="contactform-name">'+col.label+'</label>'
                    +'<div class="col-sm-'+(col.colSpan*1-2)+' col-md-'+(col.colSpan*1-2)+' col-lg-'+(col.colSpan*1-2)+' pmdynaform-field-control">'
                    +'<input type="text" id="'+col.id+'" class="form_datetime" name="'+col.name+'"  value="'+formdata+'" data-date-format="'+col.format+'">'

                    +'</div>';
                break;
            case 'text':

                html = '<label class="col-sm-2 col-md-2 col-lg-2 " for="contactform-name">'+col.label+'</label>'
                    + '<div class="col-sm-'+(col.colSpan*1-2)+' col-md-'+(col.colSpan*1-2)+' col-lg-'+(col.colSpan*1-2)+' pmdynaform-field-control">'
                    + '<input type="text" id="'+col.id+'" class="form-control" name="'+col.name+'" value="'+formdata+'" autofocus="" aria-required="true" aria-invalid="true">'

                    +  '</div>';
                break;


            case 'dropdown':
                html =  '<label class="col-sm-2 col-md-2 col-lg-2 " for="contactform-name">'+col.label+'</label>'
                    +'<div class="col-sm-10 col-md-10 col-lg-10 pmdynaform-field-control">'

                    + '<select id="'+col.variable+ '" name="'+col.name+'"class="pmdynaform-control-dropdown form-control">'
                    +options(col)
                    + '</select>'
                    +'</div>';
                break;
            case 'textarea':

                html='<label class="col-sm-'+col.colSpan/24+' col-md-'+col.colSpan/24+' col-lg-'+col.colSpan/24+' control-label pmdynaform-label" for="contactform-name">'+col.label+'</label>'

                    +'<div class="col-sm-11 col-md-11 col-lg-11 pmdynaform-field-control">'
                    + '<textarea id="'+col.variable+ '" name="'+col.name+'"class="pmdynaform-control-textarea form-control" rows="'+col.rows+'" placeholder="'+col.placeholder+'">'
                    +formdata//data.(col.variable)//col.defaultValue
                    + '</textarea>'
                    +'</div>';
                break;
            case 'submit':
                html = '<button  id="sub" type="button">'+col.label+'</button>';
                break;
            case 'suggest':
                html =  '<label class="col-sm-2 col-md-2 col-lg-2 control-label pmdynaform-label" for="contactform-name">'+col.label+'</label>'
                    +'<div class="col-sm-10 col-md-10 col-lg-10 pmdynaform-field-control">'
                    +'<input type="text" id="'+col.id+'" class="form-control" name="'+col.name+'" autofocus="" aria-required="true" aria-invalid="true">'

                    +'</div>';
                break;

            case 'grid':
                //console.log(col);
                html='<div class="pmdynaform-grid-container">'
                            +'<div class="pmdynaform-grid-new">'
                                +'<p style="text-align:center">'
                                +'<span>'+col.title+'</span>'
                                +'</p>'
                                +'<button class="btn-grid-new-row" type="button">new</button>'
                            +'</div>'
                            +'<div class="pmdynaform-grid-fields">'
                                +'<div class="pmdynaform-grid">'
                                    +'<div class="row pmdynaform-grid-thead">'
                                        +grid(col.columns)
                                    +'</div>'
                                +'</div>'
                                +'<div class=" pmdynaform-grid-tbody pmdynaform-form">'
                                    +'<div class="grid">'

                                        +gridbody(col.columns,col.id)
                                        +'<div style="display: inline-block; width: 10%;">'
                                              +'<span class="delete">删除</span>'
                                        +'</div>';

                                    +'</div>'
                                +'</div>'
                            +'</div>'
                       +'</div>'
                ;
                break;
            default:
                html = col.label;
        }

        return html;

    };
    // $(".form_datetime").datetimepicker({
    //
    //     autoclose: true,
    //     todayBtn: true,
    //     startDate: "2013-02-14 10:00",
    //     minuteStep: 10
    // });
    var gridControl = function(col,grid_id){
        var html = '';

        switch(col.type){
            case 'label':
                break;
            case 'title':
                // html = '<h1>' + col.label + '<h1/>';
                html = '<div class="box-header"><div class="section-divider"><span id="data">'
                       +col.label
                       +'</span></div></div>'
                break;
            case 'text':

                html =  '<div class="col-sm-12 col-md-12 col-lg-12 pmdynaform-field-control">'
                    +'<input type="text" id="'+col.id+'" class="form-control" name="'+grid_id+'['+col.name+']" autofocus="" aria-required="true" aria-invalid="true">'
                    +'</div>';
                break;


            case 'dropdown':
                html='<label class="col-sm-2 col-md-2 col-lg-2 " for="contactform-name">'+col.label+'</label>'
                    +'<div class="col-sm-10 col-md-10 col-lg-10 pmdynaform-field-control">'

                    + '<select id="'+col.variable+ '" name="'+col.name+'"class="pmdynaform-control-dropdown form-control">'
                    +options(col.options)
                    + '</select>'
                    +'</div>';
                break;
            case 'textarea':

                html='<div class="col-sm-12 col-md-12 col-lg-12 pmdynaform-field-control">'
                    + '<textarea id="'+col.variable+ '" name="'+col.name+'"class="pmdynaform-control-textarea form-control" rows="'+col.rows+'" placeholder="'+col.placeholder+'">'
                    +col.defaultValue
                    + '</textarea>'
                +'</div>';
                break;
            case 'submit':
                html = '<button  id="sub" >'+col.label+'</button>';
                break;
            case 'suggest':
                html =  '<label class="col-sm-2 col-md-2 col-lg-2 control-label pmdynaform-label" for="contactform-name">'+col.label+'</label>'
                    +'<div class="col-sm-10 col-md-10 col-lg-10 pmdynaform-field-control">'
                    +'<input type="text" id="'+col.id+'" class="form-control" name="'+col.name+'" autofocus="" aria-required="true" aria-invalid="true">'

                    +'</div>';
                break;

            case 'grid':
                num=1;
                html='<div class="pmdynaform-grid-new">'
                    +'<p>'
                    +'<span>'+col.title+'</span>'
                    +'</p>'
                    +'<button id="new" >new</button>'
                    +'</div>'
                    +'<div class="pmdynaform-grid-fields">'
                    +'<div class="pmdynaform-grid">'
                    +'<div class="row pmdynaform-grid-thead">'
                    +grid(col.columns)
                    +'</div>'
                    +'<div class=" pmdynaform-grid-tbody pmdynaform-form">'
                    +'<div style="display: inline-block; width: 3%;">'
                    +'<div class="col-xs-4 col-sm-12 col-md-12 col-lg-12 pmdynaform-grid-label rowIndex">'
                    +'<span>1</span>'
                    +'</div>'
                    +'</div>'
                    +gridbody(col.columns,num)
                    +'</div>'
                    +'</div>'
                    +'</div>'
                ;
                break;
            default:
                html = col.label;
        }

        return html;

    };

    var drawUIForm = function(fields,data){


        var html = '<div class="form">'
                         + '<form id="dynaformsub" >';
                        // + '<input type="hidden" name="app_uid" value="'+data.APPLICATION+'">'
                         //+ '<input type="hidden" name="index" value="'+data.INDEX+'">'
                         for(var i=0; i<fields.length; i++)
                         {
                            html = html + '<div class="row">';
                            var row = fields[i];
                            for(var j=0; j<row.length; j++)
                            {

                                var col = row[j];
                                if(col.type!='title'&&col.type!='subtitle'){
                                    html = html + '<div class="col-lg-' + col.colSpan + ' col-md-' + col.colSpan + ' col-sm-'+col.colSpan+' " style="text-align: center">'   ;
                                }
                                else if (col.type='title'){
                                    html = html + '<div class="col-lg-' + 12 + ' col-md-' + 12 + ' col-sm-'+12+' " >'   ;
                                }
                                if(typeof(col.type) != "undefined"){

                                    html = html + drawUIInputControl(col,data);
                                }

                                html = html + '</div>';
                            }
                            html = html + '</div>';
                         }

             html = html + '</form>'
                  + '</div>';

        return html;

    };
    var options = function(fields){
        var html='';
        var option=fields.options;

        if(fields.type=='select'){

            for(var i=0; i<option.length; i++)
            {

                if(i==0){

                    html = html+'<option value="'+option[i].value+'" selected>'
                        +option[i].label
                        + '</option>';
                }else{


                    html = html+'<option value="'+option[i].value+'" >'
                        +option[i].label
                        + '</option>';
                }

            }
        }else if(fields.type=='radio'){

            for(var i=0; i<option.length; i++)
            {

                html = html+'<label>'
                    +'<input type="radio" name="'+fields.name+'" value="'+option[i].value+'">'
                    +'<span>'+option[i].label+'</span>'
                '</label>' ;


            }
        }



        return html;

    };

    var grid = function(fields){
        var html= '';



        for(var i=0; i<fields.length; i++)
        {



            html = html +'<div style="width: 10%; display: inline-block;">'
                +'<span class="font-weight: bold; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; display: inline-block; width: 70%; text-align: center;">'

                +fields[i].label
                +'</span>'
                + '</div>';

        }


        return html;
    };
    var gridbody = function(fields,grid_id){
        var html= '';


        for(var i=0; i<fields.length; i++)
        {



            html = html +'<div style="display: inline-block; width: 10%;">'

                +gridControl(fields[i],grid_id)

                + '</div>';

        }


        return html;

    };
    var check = function(){



        return true;
    };

    /***
     * End Common Value Help
     */

    return {

        generateUIForm: function (targetControl, fields,data) {
            var html = drawUIForm(fields,data);
            targetControl.html(html);
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
        }

    };


}();























var SFControls = function() {

    var drawUIInputControl = function(col,data){
        var html = '';
        var formdata= (data!==undefined&& data[col.variable]==undefined) ? col.defaultValue : decodeURIComponent(data[col.variable]);
        switch(col.type){
            case 'label':
                break;
            case 'title':
                // html =   '<h1>' + col.label + '<h1/>';
                html = '<div class="box-header"><div class="section-divider"><span id="data">'
                       +col.label
                       +'</span></div></div>';

                break;
            case 'subtitle':
                html =   '<h4>' + col.label + '<h4/><hr>';
                break;
            case 'text':

                // html = '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">'
                //        +col.label+'</label><div class="col-sm-9"><input type="email" class="form-control" id="inputEmail3" nameplaceholder=""></div></div>'
                // break;
                html = '<div class="form-group"><label class="col-sm-3 col-md-3 col-lg-3 control-label" for="contactform-name">'+col.label+'</label>'
                    + '<div class="col-sm-9 col-md-9 col-lg-9 pmdynaform-field-control">'
                    + '<input type="text" id="'+col.id+'" class="form-control" name="'+col.name+'" value="'+formdata+'" autofocus="" aria-required="true" aria-invalid="true" data-sql="'+col.sql+'">'
                    +  '</div></div>';
                break;

            case 'textarea':

                html='<div class="form-group"><label class="col-sm-2 col-md-2 col-lg-2 control-label pmdynaform-label" for="contactform-name">'+col.label+'</label>'

                    +'<div class="col-sm-10 col-md-10 col-lg-10 pmdynaform-field-control widthchange">'
                    + '<textarea id="'+col.variable+ '" name="'+col.name+'"class="pmdynaform-control-textarea form-control" rows="'+col.rows+'" placeholder="'+col.placeholder+'">'
                    +formdata//data.(col.variable)//col.defaultValue
                    + '</textarea>'
                    +'</div></div>';
                break;
            case 'submit':
                html = '<div class="form-group"><button  id="sub" type="button" class="btn btn-block btn-success buttoncenter">'+col.label+'</button></div>';
                break;
            case 'radio':
                html =   '<div class="form-group"><label class="col-sm-3 col-md-3 col-lg-3 control-label" for="contactform-name">'+col.label+'</label>'
                    +'<div class="col-sm-9 col-md-9 col-lg-9 ">'
                    +'<div class="radio item-right-margin">'
                    +options(col, formdata)
                    +'</div>'
                    +'</div></div>';
                break;
            case 'datetime':
                var formdata= (data!==undefined&& data[col.variable]==undefined) ? col.defaultDate : decodeURIComponent(data[col.variable]);
                html = '<div class="form-group"><label class="col-sm-3 col-md-3 col-lg-3 control-label" for="contactform-name">'+col.label+'</label>'
                    + '<div class="col-sm-9 col-md-9 col-lg-9 ">'
                    + '<div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>'
                    + '<div id = "date-input'+col.id+'"><input type="text" id="'+col.id+'" name="'+col.name+'" value="'+formdata+'" class="form-control pull-right datetimeinput" data-maxDate = "'+col.maxDate+'" data-minDate = "'+col.minDate+'" ></div></div>'
                    + '</div></div>';

                break;
            case 'dropdown':
                html = '<div class="form-group"><label class="col-sm-3 col-md-3 col-lg-3 control-label" for="contactform-name">'+col.label+'</label>'
                        + '<div class="col-sm-9 col-md-9 col-lg-9 ">'
                        + '<select class="form-control no-radius-select" name="'+col.name+'">'
                        + options(col, formdata)
                        + '</select>'
                        + '</div></div>';
                break;


        }

        return html;

    };
    // $(".form_datetime").datetimepicker({
    //
    //     autoclose: true,
    //     todayBtn: true,
    //     startDate: "2013-02-14 10:00",
    //     minuteStep: 10
    // });
    var gridControl = function(col,grid_id){
        var html = '';

        switch(col.type){
            case 'label':
                break;
            case 'title':
                // html = '<h1>' + col.label + '<h1/>';
                html = '<div class="box-header"><div class="section-divider"><span id="data">'
                       +col.label
                       +'</span></div></div>'
                break;
            case 'text':

                html =  '<div class="col-sm-12 col-md-12 col-lg-12 pmdynaform-field-control">'
                    +'<input type="text" id="'+col.id+'" class="form-control" name="'+grid_id+'['+col.name+']" autofocus="" aria-required="true" aria-invalid="true">'
                    +'</div>';
                break;


            case 'dropdown':
                html='<label class="col-sm-2 col-md-2 col-lg-2 " for="contactform-name">'+col.label+'</label>'
                    +'<div class="col-sm-10 col-md-10 col-lg-10 pmdynaform-field-control">'

                    + '<select id="'+col.variable+ '" name="'+col.name+'"class="pmdynaform-control-dropdown form-control">'
                    +options(col.options)
                    + '</select>'
                    +'</div>';
                break;
            case 'textarea':

                html='<div class="col-sm-12 col-md-12 col-lg-12 pmdynaform-field-control">'
                    + '<textarea id="'+col.variable+ '" name="'+col.name+'"class="pmdynaform-control-textarea form-control" rows="'+col.rows+'" placeholder="'+col.placeholder+'">'
                    +col.defaultValue
                    + '</textarea>'
                +'</div>';
                break;
            case 'submit':
                html = '<button  id="sub" >'+col.label+'</button>';
                break;
            case 'suggest':
                html =  '<label class="col-sm-2 col-md-2 col-lg-2 control-label pmdynaform-label" for="contactform-name">'+col.label+'</label>'
                    +'<div class="col-sm-10 col-md-10 col-lg-10 pmdynaform-field-control">'
                    +'<input type="text" id="'+col.id+'" class="form-control" name="'+col.name+'" autofocus="" aria-required="true" aria-invalid="true">'

                    +'</div>';
                break;

            case 'grid':
                num=1;
                html='<div class="pmdynaform-grid-new">'
                    +'<p>'
                    +'<span>'+col.title+'</span>'
                    +'</p>'
                    +'<button id="new" >new</button>'
                    +'</div>'
                    +'<div class="pmdynaform-grid-fields">'
                    +'<div class="pmdynaform-grid">'
                    +'<div class="row pmdynaform-grid-thead">'
                    +grid(col.columns)
                    +'</div>'
                    +'<div class=" pmdynaform-grid-tbody pmdynaform-form">'
                    +'<div style="display: inline-block; width: 3%;">'
                    +'<div class="col-xs-4 col-sm-12 col-md-12 col-lg-12 pmdynaform-grid-label rowIndex">'
                    +'<span>1</span>'
                    +'</div>'
                    +'</div>'
                    +gridbody(col.columns,num)
                    +'</div>'
                    +'</div>'
                    +'</div>'
                ;
                break;
            default:
                html = col.label;
        }

        return html;

    };

    var drawUIForm = function(fields,data){


        var html = '<div class="form">'
                         + '<form id="dynaformsub" class="form-horizontal" >'
                         + '<div class="box-body">';
                        // + '<input type="hidden" name="app_uid" value="'+data.APPLICATION+'">'
                         //+ '<input type="hidden" name="index" value="'+data.INDEX+'">'
                         for(var i=0; i<fields.length; i++)
                         {
                            html = html + '<div class="row">';
                            var row = fields[i];
                            for(var j=0; j<row.length; j++)
                            {

                                var col = row[j];
                                if(col.type!='title'&&col.type!='subtitle'){
                                    html = html + '<div class="col-lg-' + col.colSpan + ' col-md-' + col.colSpan + ' col-sm-'+col.colSpan+' " style="text-align: center">'   ;
                                }else if (col.type=='title'&&i==0){
                                    html = html + '<div class="col-lg-' + 12 + ' col-md-' + 12 + ' col-sm-'+12+' " >'   ;
                                }else{
                                    html = html + '<div class="col-lg-' + col.colSpan + ' col-md-' + col.colSpan + ' col-sm-'+col.colSpan+' subbox " >';
                                }
                                if(typeof(col.type) != "undefined"){

                                    html = html
                                                +drawUIInputControl(col,data);
                                }

                                html = html + '</div>';
                            }
                            html = html + '</div>';
                         }

             html = html + '</form>'
                  + '</div>'
                  + '</div>';


        return html;

    };
    var options = function(fields,formdata){
        var html='';
        var option=fields.options;

        if(fields.type=='dropdown'){

            for(var i=0; i<option.length; i++)
            {

                if(option[i].value == formdata){

                    html = html+'<option value="'+option[i].value+'" selected>'
                        +option[i].label
                        + '</option>';
                }else{


                    html = html+'<option value="'+option[i].value+'" >'
                        +option[i].label
                        + '</option>';
                }

            }
        }else if(fields.type=='radio'){

            for(var i=0; i<option.length; i++)
            {
                if(option[i].value == formdata ){
                    html = html+'<label>'
                        +'<input type="radio" name="'+fields.name+'" value="'+option[i].value+'" checked>'
                        +'<span>'+option[i].label+'</span></label>' ;
                }else {
                    html = html+'<label>'
                        +'<input type="radio" name="'+fields.name+'" value="'+option[i].value+'">'
                        +'<span>'+option[i].label+'</span></label>' ;
                }



            }
        }



        return html;

    };

    var grid = function(fields){
        var html= '';



        for(var i=0; i<fields.length; i++)
        {



            html = html +'<div style="width: 10%; display: inline-block;">'
                +'<span class="font-weight: bold; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; display: inline-block; width: 70%; text-align: center;">'

                +fields[i].label
                +'</span>'
                + '</div>';

        }


        return html;
    };
    var gridbody = function(fields,grid_id){
        var html= '';


        for(var i=0; i<fields.length; i++)
        {



            html = html +'<div style="display: inline-block; width: 10%;">'

                +gridControl(fields[i],grid_id)

                + '</div>';

        }


        return html;

    };
    var check = function(){



        return true;
    };

    /***
     * End Common Value Help
     */

    return {

        generateUIForm: function (targetControl, fields,data) {
            var html = drawUIForm(fields,data);
            targetControl.html(html);
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
            $('.datetimeinput').datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                autoclose: true,


            });



            for (var i = 0; i< $('.datetimeinput').length; i++ ){
                var maxDate = $('.datetimeinput').eq(i).attr("data-maxDate");
                var minDate = $('.datetimeinput').eq(i).attr("data-minDate");
                
                if(maxDate){
                    $('.datetimeinput').eq(i).change(function () {

                        var relateDate = this.value;
                        var maxOrMin = this.getAttribute("data-maxDate");
                        $('#'+maxOrMin).datetimepicker('setStartDate',relateDate);

                    })

                }else if(minDate){
                    $('.datetimeinput').eq(i).change(function () {
                        var relateDate = this.value;
                        var maxOrMin = this.getAttribute("data-minDate");
                        $('#'+maxOrMin).datetimepicker('setEndDate',relateDate);

                    });
                }


            }

        },

    };


}();


function selectSuber(app_uid,pro_uid,tas_uid,variables){
  var next_id;
  var next_task;
  var next_type;
  var del_index;
  var sort;
  var next_number;
  function route(){
      pmRestRequest("GET","/api/1.0/workflow/cases/"+app_uid+"/tasks",true, null,function(data, status){

          if(data) {
              var result = [];
              for (var i = 0; i < data.length; i++) {
                  result[data[i].tas_uid] = data[i];
              }
              console.log(result);
              var firstdata=result[tas_uid];
              del_index = firstdata.delegations[firstdata.delegations.length - 1].del_index;
              sort = firstdata.delegations[0].del_index;
              tas(result,tas_uid,variables);

          }
      });

  }
  route();
  function tas(data,tas_uid,variables){
        var data_tas=data[tas_uid];
        if (data_tas.route.to[0].rou_condition != '') {
            var routes = data_tas.route.to;

            for (var j = 0; j < routes.length; j++) {
                var conditions = routes[j].rou_condition;
                var str1=conditions.split("@@")[1];
                if (conditions.indexOf('==') >= 0) {


                    var str2=str1.split("==");
                    var key = str2[0];
                    var value = str2[1].replace("\'","").replace("\'","");//d = d.replace("\"","").replace("\"","");
                    var condition= variables[key];
                    if(condition == value){
                        next_id = routes[j].tas_uid;
                        // next_number = routes[j].rou_number
                        if( next_id=='-1'){
                            var usr_username = data_tas.delegations[0].usr_username;
                            next_task = 'End of process';
                            balanced(usr_username);

                        }
                        break;
                    }

                }
                if (conditions.indexOf('!=') >= 0) {
                    var str2=str1.split("!=");
                    var key = str2[0];
                    var value = str2[1];
                    var condition= variables[key];
                    if(condition != value){
                        next_id = routes[j].tas_uid;
                        // next_number = routes[j].rou_number
                        if( next_id=='-1'){
                            var usr_username = data_tas.delegations[0].usr_username;
                            next_task = 'End of process';
                            balanced(usr_username);

                        }
                        break;
                    }

                }
                if (conditions.indexOf('<=') >= 0) {
                    var str2=str1.split("<=");
                    var key = str2[0];
                    var value = str2[1];
                    var condition= variables[key];
                    if(condition <= value){
                        next_id = routes[j].tas_uid;
                        // next_number = routes[j].rou_number
                        if( next_id=='-1'){
                            var usr_username = data_tas.delegations[0].usr_username;
                            next_task = 'End of process';
                            balanced(usr_username);

                        }
                        break;
                    }

                }
                if (conditions.indexOf('>=') >= 0) {
                    var str2=str1.split(">=");
                    var key = str2[0];
                    var value = str2[1];
                    var condition= variables[key];
                    if(condition >= value){
                        next_id = routes[j].tas_uid;
                        //next_number = routes[j].rou_number
                        if( next_id=='-1'){
                            var usr_username =data_tas.delegations[0].usr_username;
                            next_task = 'End of process';
                            balanced(usr_username);

                        }
                        break;
                    }

                }
                if (conditions.indexOf('<') >= 0) {
                    var str2=str1.split("<");
                    var key = str2[0];
                    var value = str2[1];
                    var condition= variables[key];
                    if(condition < value){
                        next_id = routes[j].tas_uid;
                        //next_number = routes[j].rou_number
                        if( next_id=='-1'){
                            var usr_username = data_tas.delegations[0].usr_username;
                            next_task = 'End of process';
                            balanced(usr_username);

                        }
                        break;
                    }

                }
                if (conditions.indexOf('>') >= 0) {
                    var str2=str1.split(">");
                    var key = str2[0];
                    var value = str2[1];
                    var condition= variables[key];
                    if(condition > value){
                        next_id = routes[j].tas_uid;
                        // next_number = routes[j].rou_number
                        if( next_id=='-1'){
                            var usr_username =data_tas.delegations[0].usr_username;
                            next_task = 'End of process';
                            balanced(usr_username);

                        }
                        break;
                    }

                }


            }


        }
        else {

            next_id = data_tas.route.to[data_tas.route.to.length-1].tas_uid;
            if( next_id=='-1'){
                var usr_username = data_tas.delegations[0].usr_username;
                next_task = 'End of process';
                balanced(usr_username);

            }

        }
      if(next_id!='-1'){
          if(data[next_id].tas_type=='GATEWAYTOGATEWAY'){
              tas(data,next_id)
          }
          else if(data[next_id].tas_type=='NORMAL') {
              next_task = data[next_id].tas_title;
              next_type = data[next_id].tas_assign_type;

              if (next_type == "MANUAL") {

              } else if (next_type == "BALANCED") {
                  var usr_username = data[next_id].usr_username;
                  balanced(usr_username);
              } else if (next_type == "EVALUATE") {

                  var delegations = data[next_id].delegations
                  if (delegations[0] != undefined) {
                      balanced(delegations[0].usr_username);
                  }
                  else {
                      var sql = "SELECT TASK.PRO_UID, TASK.TAS_UID, TASK.TAS_ID, TASK.TAS_TITLE, TASK.TAS_DESCRIPTION, TASK.TAS_DEF_TITLE, TASK.TAS_DEF_SUBJECT_MESSAGE, TASK.TAS_DEF_PROC_CODE, TASK.TAS_DEF_MESSAGE, TASK.TAS_DEF_DESCRIPTION, TASK.TAS_TYPE, TASK.TAS_DURATION, TASK.TAS_DELAY_TYPE, TASK.TAS_TEMPORIZER, TASK.TAS_TYPE_DAY, TASK.TAS_TIMEUNIT, TASK.TAS_ALERT, TASK.TAS_PRIORITY_VARIABLE, TASK.TAS_ASSIGN_TYPE, TASK.TAS_ASSIGN_VARIABLE, TASK.TAS_GROUP_VARIABLE, TASK.TAS_MI_INSTANCE_VARIABLE, TASK.TAS_MI_COMPLETE_VARIABLE, TASK.TAS_ASSIGN_LOCATION, TASK.TAS_ASSIGN_LOCATION_ADHOC, TASK.TAS_TRANSFER_FLY, TASK.TAS_LAST_ASSIGNED, TASK.TAS_USER, TASK.TAS_CAN_UPLOAD, TASK.TAS_VIEW_UPLOAD, TASK.TAS_VIEW_ADDITIONAL_DOCUMENTATION, TASK.TAS_CAN_CANCEL, TASK.TAS_OWNER_APP, TASK.STG_UID, TASK.TAS_CAN_PAUSE, TASK.TAS_CAN_SEND_MESSAGE, TASK.TAS_CAN_DELETE_DOCS, TASK.TAS_SELF_SERVICE, TASK.TAS_START, TASK.TAS_TO_LAST_USER, TASK.TAS_SEND_LAST_EMAIL, TASK.TAS_DERIVATION, TASK.TAS_POSX, TASK.TAS_POSY, TASK.TAS_WIDTH, TASK.TAS_HEIGHT, TASK.TAS_COLOR, TASK.TAS_EVN_UID, TASK.TAS_BOUNDARY, TASK.TAS_DERIVATION_SCREEN_TPL, TASK.TAS_SELFSERVICE_TIMEOUT, TASK.TAS_SELFSERVICE_TIME, TASK.TAS_SELFSERVICE_TIME_UNIT, TASK.TAS_SELFSERVICE_TRIGGER_UID, TASK.TAS_SELFSERVICE_EXECUTION, TASK.TAS_NOT_EMAIL_FROM_FORMAT, TASK.TAS_OFFLINE, TASK.TAS_EMAIL_SERVER_UID, TASK.TAS_AUTO_ROOT, TASK.TAS_RECEIVE_SERVER_UID, TASK.TAS_RECEIVE_LAST_EMAIL, TASK.TAS_RECEIVE_EMAIL_FROM_FORMAT, TASK.TAS_RECEIVE_MESSAGE_TYPE, TASK.TAS_RECEIVE_MESSAGE_TEMPLATE, TASK.TAS_RECEIVE_SUBJECT_MESSAGE, TASK.TAS_RECEIVE_MESSAGE FROM TASK WHERE TASK.TAS_UID='" + next_id + "'";
                      var ajax_sql = $.ajax({
                          type: "GET",
                          url: '../controller/securityInterface.php?action=OpenCase',
                          dataType: 'json',
                          data: {
                              'sql': sql
                          }
                      })
                          .done(function (data) {

                              var TAS_ASSIGN_VARIABL = data.output[0].TAS_ASSIGN_VARIABLE;
                              if (TAS_ASSIGN_VARIABL != '@@FirstUser') {
                                  manual();
                              } else {
                                  pmRestRequest("GET","/api/1.0/workflow/cases/"+app_uid+"/variables",true,null,function(data, status){

                                      if(data){

                                      }

                                  });
                              }
                          })
                          .fail(function (data, statusText, xhr) {

                          });
                  }
                  // manual();
                  // }
                  // else {
                  //     var usr_username = data[next_id].delegations[0].usr_username;
                  //     balanced(usr_username);
                  // }

              } else if (next_type == "REPORT_TO") {
                  var reportUsr;

                  pmRestRequest("GET","/api/1.0/workflow/user/"+getCookie("reportsTo"), true,null,function(data, status){
                      reportUsr = data.usr_lastname + data.usr_firstname;
                      console.log(reportUsr);
                      balanced(reportUsr);//用户信息表里面去获取report session 在获取名字
                  });




              } else if (next_type == "SELF_SERVICE") {

              } else if (next_type == "SELF_SERVICE_EVALUATE") {

              }
          }


      }







    }
  function manual(){

    pmRestRequest("GET","/api/1.0/workflow/project/"+pro_uid+"/activity/"+next_id+"/assignee",true, null,function(data, status){

        if(data){
            html= '<label class="col-sm-2 col-md-2 col-lg-2 " for="contactform-name">下一步</label>'
                        +'<div class="col-sm-10 col-md-10 col-lg-10 pmdynaform-field-control">'
                         + '<select id="userselect" name="assignuser"class="pmdynaform-control-dropdown form-control">'
                            +'<option value="1">请选择</option>';
                                for (var i = 0; i < data.length; i++) {
                                    html = html+'<option value="'+data[i].aas_uid+'" >'
                                        +data[i].aas_username
                                        + '</option>';
                                           }
            html= html  + '</select>'
                        +'</div>';
            html=html+"<button id='manualsub'>提交</button>";
         $("#selected").append(html);

        }

    });
  }

  function balanced(usr_username){

            html='<div>'
                +'<span>'+usr_username+'<span>';
            html=html+"<button id='balancedsub'>提交</button>";
            html=html+'</div>'
            $("#selected").append(html);

  }

  function route_cases(){

    var oVar = {
        'del_index'  : del_index
    };
    pmRestRequest("PUT","/api/1.0/workflow/cases/"+app_uid+"/route-case",true, oVar,function(data, status){

        if(status==200){
                    alert("提交成功");
                    location.href='oaindex.php';

        }
    });
  }


  function route_case(availableUser){

    var oVar = {
        'del_index'  : del_index
    };
    pmRestRequest("PUT","/api/1.0/workflow/cases/"+app_uid+"/route-case",true, oVar,function(data, status){

        if(status==200){

          $("#selected").html("提交成功！");
          location.href="oaindex.php";
        }
    });
  }

  //点击弹出框的叉按钮，让弹出框消失
  $(document).on('click','#popuprm',function(){
    $("#lid").hide();
    $("#selected").html("");
  });

  //选好提交到某人后，提交这个表单
  $(document).on("click","#manualsub",function() {

    var oVar = {};
    var user_uid = $("#userselect").val();
    var availableUser = 'NextUser' + sort;
    oVar[availableUser] = user_uid;
    //00000000000000000000000000000001 admin
    //73007202158f819eba98d57072278225 zhang3

    pmRestRequest("PUT", "/api/1.0/workflow/cases/" + app_uid + "/variable", true, oVar, function (data, status) {
        if (status == 200) {
            route_case(availableUser);


        }


        });

  });

  //不用选提交人，直接按列出名单全部发送
  $(document).on("click","#balancedsub",function(){
    route_cases();

  });

  var getTriggers=function(prj_uid,act_uid,step_uid){
      pmRestRequest("GET","/api/1.0/workspace/project/"+prj_uid+"/activity/"+act_uid+"/step/"+step_uid+"/available-triggers",false, null,function(data, status){

          if(data){

          }

      });
  } ;


}
