<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>draftdetail</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
  <!-- Ionicons -->
  <link href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.css" rel="stylesheet">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Bootstrap datetime Picker -->
  <link href="../plugins/bootstrap-datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css" />

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
  <style type=text/css>
    .subpopup{

      /*height: 30%;*/

      position: absolute;
      width: calc(70% - 60px);
      top:30%;
      right:19%;
      z-index: 99;
      display: none;

    }

    .lid{
      width: 100%;
      height: 100%;
      background-color: #222d32;
      position: absolute;
      z-index: 98;
      opacity: 0.5;
      display: none;
      position: absolute;

    }
  </style>


</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
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
    <div class="lid" id="lid"></div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        新建
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
        <div class="col-md-1"></div>
          <div class="col-md-10">
            <section class="content">

              <div class="box box-success subpopup" id="subpopup">
                  <div class="box-header with-border">
                    <h3 class="box-title">提交至负责人</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="remove" id="popuprm"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="" id="selected">

                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>

              <div class="box box-primary newstyle1" id="dynaform">

                          <!-- /.box-body -->
              </div>

            </section>
        </div>
        <div class="col-md-1"></div>
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

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Bootstrap datetime Picker -->
<script src="../plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- 引入全局的功能 -->
<script src="../dist/js/pm/global_func.js"></script>
<!-- 引入main.js -->
<script src="../dist/js/pm/main.js"></script>

<script>
  $(function(){
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});

    logout();
    getUsername();
    getCatAndProj();
    keepSidebarStates();

    var app_uid = getUrlParam("app_uid");
    var pro_uid = getUrlParam("pro_uid");
    var tas_uid = getUrlParam("tas_uid");
    step(pro_uid,tas_uid,app_uid);


  });
</script>


</body>
</html>
