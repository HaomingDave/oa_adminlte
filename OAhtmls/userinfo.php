<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>newcase</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
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

      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <section class="content-header">
            <h1>
              个人信息
              <hr class="wire">
              <small></small>
            </h1>
              <!--       <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
              <li class="active">Here</li>
            </ol> -->
            <div class="row">
              <div class="col-md-4">
                <ul class="list-unstyled profile-nav" style="margin-bottom:0px;">
  									<li>
                      <div class="photo-set">

                      </div>
  									</li>
  							</ul>
                <!-- <img src="/Users/yme/Desktop/123.jpg" alt="..." class="img-rounded" id="photo"> -->
              </div>
              <div class="col-md-8">
                <div class="col-md-6">
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">姓</label>
                      <input type="email" class="form-control" id="usr_lastname" >
                    </div>
                  </div>
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">名</label>
                      <input type="email" class="form-control" id="usr_firstname" >
                    </div>
                  </div>
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">省</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" >
                    </div>
                  </div>
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">市</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" >
                    </div>
                  </div>
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">电话</label>
                      <input type="email" class="form-control" id="phonenumber">
                    </div>
                  </div>
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">状态</label>
                      <input type="email" class="form-control" id="usrstatus" >
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">用户名</label>
                      <input type="email" class="form-control" id="username1" >
                    </div>
                  </div>
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">邮箱</label>
                      <input type="email" class="form-control" id="email">
                    </div>
                  </div>
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">地址</label>
                      <input type="email" class="form-control" id="location">
                    </div>
                  </div>
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">邮编</label>
                      <input type="email" class="form-control" id="zipcode">
                    </div>
                  </div>
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">替补</label>
                      <input type="email" class="form-control" id="substitue">
                    </div>
                  </div>
                  <div class="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">角色</label>
                      <input type="email" class="form-control" id="role">
                    </div>
                  </div>

                </div>

                </div>
            </div>

          </section></div>
        <div class="col-md-2"></div>
      </div>
      <!-- /.content -->
    </div>

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
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> -->
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
    logout();
    getUsername();
    getCatAndProj();
    getUserInfo();


  </script>

</body>
</html>
