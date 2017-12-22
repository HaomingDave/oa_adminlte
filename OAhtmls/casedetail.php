
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
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border case_top">
              <!--<i class="fa fa-text-width"></i>-->
              <h3 class="box-title">事例详情</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">流程</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="process">访客登记</label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">事例名称</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="case_title"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">事例编号</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="case_num"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">事例状态</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="case_status"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">事例ID</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="case_uid"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">发起人</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="creator"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">创建时间</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="create_date"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">上次更新</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="last_update"></label>



                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">事例简介</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="case_des"></label>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border case_top">
              <!--<i class="fa fa-text-width"></i>-->
              <h3 class="box-title">任务详情</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">任务</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="task">访客登记</label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">当前处理人</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="current_usr"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">任务提交时间</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="delegate_date"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">任务发起时间</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="init_date"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">任务到期时间</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="due_date"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 case_title">
                  <label for="">完成时间</label>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                  <label for="" id="finish_date"></label>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>









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

  <?php
  require_once 'php_includes/footscripts.inc.php';
  ?>

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
<script src="../dist/js/app.min.js"></script>
<!-- 引入全局的功能 -->
<script src="../dist/js/pm/global_func.js"></script>
<!-- 引入main.js -->
<script src="../dist/js/pm/main.js"></script>




<script>
$(".participated").addClass('active');
logout();
getUsername();
getCatAndProj();
var appId = getUrlParam("app_uid");

pmRestRequest("GET","/api/1.0/workflow/cases/participated/paged?search="+appId,false,null,function(data, status){

  if (data) {
        console.log(data);
        console.log(data.data);
        console.log(data.data[0]);
        $("#process").html(data.data[0].app_pro_title);
        $("#case_title").html(data.data[0].app_title);
        $("#case_num").html(data.data[0].app_number);
        $("#case_status").html(data.data[0].app_status);
        $("#case_uid").html(data.data[0].app_uid);
        $("#creator").html(data.data[0].usrcr_usr_lastname + data.data[0].usrcr_usr_firstname);
        $("#create_date").html(data.data[0].app_create_date);
        $("#last_update").html(data.data[0].app_update_date);
        // $("#case_des").html(data.data[0]);
        $("#current_usr").html(data.data[0].app_current_user);
        $("#delegate_date").html(data.data[0].del_delegate_date);
        $("#init_date").html(data.data[0].del_init_date);
        $("#due_date").html(data.data[0].del_task_due_date);
        $("#finish_date").html(data.data[0].del_finish_date);



  }
});










</script>




</body>
</html>
