
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OAadmin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  <!-- Ionicons -->
  <link href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.css" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/new_add_style.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    /*   .new_contentwidth{
        margin-left: 0;
       }
       .new_footerwidth{
        margin-left: 0;
        padding-left: 5px;
       }*/

  </style>

</head>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <?php
  require_once 'php_includes/header.inc.php';
  ?>

  <!-- Left side column. contains the logo and sidebar -->

  <?php
  require_once 'php_includes/sider.inc.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper new_contentwidth">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        参与事项
        <small></small>
      </h1>
      <!--       <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->



      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">查找</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row filterbanner">
            <div class="col-md-11">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group" >
                    <label >类别</label>
                    <select class="form-control select2" style="width: 100%;" id="filtercat">
                      <option value="">全部</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>流程选择</label>
                    <select class="form-control select2" style="width: 100%;" id="filterprocess">
                      <option value="">全部</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>关键字</label>
                    <input type="text" class="form-control" id="keyword">
                  </div>
                </div>
                <script>
                    // <div class="col-md-6">
                    //   <div class="form-group">
                    //     <label>Multiple</label>
                    //     <select class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                    //       <option>Alabama</option>
                    //       <option>Alaska</option>
                    //       <option>California</option>
                    //       <option>Delaware</option>
                    //       <option>Tennessee</option>
                    //       <option>Texas</option>
                    //       <option>Washington</option>
                    //     </select>
                    //   </div>
                    //   <!-- /.form-group -->
                    //   <div class="form-group">
                    //     <label>Disabled Result</label>
                    //     <select class="form-control select2" style="width: 100%;">
                    //       <option selected="selected">Alabama</option>
                    //       <option>Alaska</option>
                    //       <option disabled="disabled">California (disabled)</option>
                    //       <option>Delaware</option>
                    //       <option>Tennessee</option>
                    //       <option>Texas</option>
                    //       <option>Washington</option>
                    //     </select>
                    //   </div>
                    //   <!-- /.form-group -->
                    // </div>
                </script>

              </div>
              <!-- /.row -->
            </div>
            <div class="col-md-1 searchbtn">
              <div class="form-group">
                <button type="button" class="btn btn-block btn-success buttoncenter" id="search_btn">查找</button>
              </div>

            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- 表格（开始） -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!--             <div class="box-header newboxpd">
                          <h3 class="box-title"></h3> -->
            <!-- <div class="rightoption">

            </div> -->
            <!--               <button class="btn btn-default openbtn" disabled="disabled">打开</button>
                          <ul class="tbfilterbtn">
                            <li><a href="#3">read</a></li>
                            <li><a href="#4">unread</a></li>
                            <li><a href="#5">all</a></li>
                          </ul>
                        </div> -->
            <!-- /.box-header -->
            <div class="box-body dynam_table">
              <table id="example2" class="table table-bordered table-hover nstyle1">



              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <!-- 表格（结束） -->
    </section>


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php
  require_once 'php_includes/footer.inc.php';
  ?>

  <!-- Control Sidebar -->
  <?php
  require_once 'php_includes/controlsidebar.inc.php';
  ?>
</div>
<!-- ./wrapper -->



<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="../dist/js/app.js"></script>
<!-- 引入全局的功能 -->
<script src="../dist/js/pm/global_func.js"></script>
<!-- 引入main.js -->
<script src="../dist/js/pm/main.js"></script>



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<!-- Page script -->
<script>
    //Initialize Select2 Elements
    $(".select2").select2();
    //让左侧栏的待办事项标签呈现选中状态
    $(".todolist").addClass('active');
    logout();
    getUsername();
    getCatAndProj();



    //初始化表格
    var catUid='';
    var proUid='';
    var keyword='';
    var table;

    function initializeTable(cat,pro,key) {
        var table = $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "select":true,
            "columns":[
                {title:"单号",data:"app_number",name:"thecase"},
                {title:"流程",data:"app_pro_title",name:"process"},
                {title:"任务",data:"app_tas_title"},
                {title:"当前处理者",data:"app_current_user"},
                {title:"修改时间",data:"app_update_date"},
                {title:"状态",data:"app_status",name:"status"},

            ],
            "serverSide": true,
            // "scrollX": "130%",

            "processing": true,
            "ajax":{
                "url":getCookie("pmServer")+"/api/1.0/workflow/cases/paged?cat_uid="+cat+"&pro_uid="+pro+"&search="+key,
                "beforeSend":function (request) {
                    request.setRequestHeader("Authorization", "Bearer " + getCookie("access_token"));
                    $(".openbtn").attr("disabled","disabled");
                    $(".openbtn").removeClass("btn-success btnletter");

                },
                data:function (para) {
                    para.limit=para.length;
                    delete para["draw"];
                    delete para["length"];
                    delete para["search"];
                },
                dataFilter:function (data) {
                    var json = jQuery.parseJSON(data);
                    json.recordsTotal = json.total;
                    json.recordsFiltered = json.total;

                    console.log(json);
                    return JSON.stringify(json);


                }



            },
            "fnServerParams": function ( aoData ) {
                //传递额外数据给服务器，url长度限制，删除columns所有数据，也就是Volumn1-Volumn180的数据端
                aoData.columns.splice(0, aoData.columns.length - 0);
            }


            // initComplete: function () {

            //   var column1 = this.api().column("thecase:name");
            //     $("#filtercat").on('change', function () {
            //         var val = $.fn.dataTable.util.escapeRegex(
            //             $(this).val()
            //         );
            //         column1
            //             .search(val ? '^' + val + '$' : '', true, false)
            //             .draw();
            //     });
            //     column1.data().unique().sort().each(function (d, j) {
            //         $("#filtercat").append('<option value="' + d + '">' + d + '</option>')
            //     });

            //     var column2 = this.api().column("process:name");
            //     $("#filterprocess").on('change', function () {
            //         var val = $.fn.dataTable.util.escapeRegex(
            //             $(this).val()
            //         );
            //         column2
            //             .search(val ? '^' + val + '$' : '', true, false)
            //             .draw();
            //     });
            //     column2.data().unique().sort().each(function (d, j) {
            //         $("#filterprocess").append('<option value="' + d + '">' + d + '</option>')
            //     });

            // var column3 = this.api().column("status:name");
            // $("#filterstatus").on('change', function () {
            //     var val = $.fn.dataTable.util.escapeRegex(
            //         $(this).val()
            //     );
            //     column3
            //         .search(val ? '^' + val + '$' : '', true, false)
            //         .draw();
            // });
            // column3.data().unique().sort().each(function (d, j) {
            //     $("#filterstatus").append('<option value="' + d + '">' + d + '</option>')
            // });


        });
        $("#example2_wrapper>.row>.col-sm-6:first-child").html('<button class="btn btn-default openbtn" disabled="disabled">打开</button>');

        // 让表格具有点击高亮的功能，和打开按钮的功能
        $('#example2 tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected tr.selected:hover');

                $(".openbtn").attr("disabled","disabled");
                $(".openbtn").removeClass("btn-success btnletter");

            }
            else {
                $('tr.selected').removeClass('selected tr.selected:hover');
                $(this).addClass('selected tr.selected:hover');
                $(".openbtn").addClass("btn-success btnletter");
                $(".openbtn").removeAttr("disabled");
                // var a = table.row('.selected').data();
                // console.log(a.app_uid);
            }
        });

        $('.openbtn').click(function(){
            var caseid = table.row(".selected").data();
            console.log(caseid);

            location.href="draftdetail.php?app_uid=" + caseid.app_uid + "&pro_uid=" + caseid.pro_uid + "&tas_uid=" + caseid.tas_uid;
        });

        return table;
    }
    table = initializeTable(catUid,proUid,keyword);
    console.log(table);


    //表格右上角的筛选标签效果
    $(".tbfilterbtn li a").each(function(index){
        $(this).click(function(){
            $(".tbfilterbtn li a").removeClass("haha");
            $(".tbfilterbtn li a").addClass("hoho");
            $(this).addClass("haha");
        });
    });
    console.log($("#example2_wrapper>.row>.col-sm-6"));
    console.log($("#kfjkdjfkdjf"));








    //获取表单数据并呈现过滤框
    var initializefilter = function (){
        //把流程process列表拿下来，放到select框里
        pmRestRequest("GET","/api/1.0/workflow/cases/paged",false,null,function(data, status){

            if (data) {
                console.log(data);

                var pro_title = new Array();
                for (var i = 0; i < data.data.length; i++) {
                    var title = data.data[i].app_pro_title;
                    if ($.inArray(title,pro_title)== -1) {
                        pro_title.push(title);
                        $("#filterprocess").append('<option value="' + data.data[i].pro_uid + '">' + title + '</option>')
                    }
                }
            }
        });
        //把类别列表拿下来，放到select框里
        pmRestRequest("GET","/api/1.0/workflow/project/categories",false,null,function(data, status){
            if (data) {
                console.log(data);
                for (var i = 0; i < data.length; i++) {
                    $("#filtercat").append('<option value="' + data[i].cat_uid + '">' + data[i].cat_name + '</option>');
                }
            }
        });
    }();


    $("#search_btn").click(function () {
        table='';
        $(".dynam_table").html('<table id="example2" class="table table-bordered table-hover nstyle1"></table>');
        var catUid = $("#filtercat option:selected").val();
        var proUid = $("#filterprocess option:selected").val();
        var keyword = $("#keyword").val();
        console.log(catUid,proUid,keyword);
        table = initializeTable(catUid,proUid,keyword);
    });






</script>




</body>
</html>
