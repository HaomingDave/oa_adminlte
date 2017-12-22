<!DOCTYPE html>

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
        信息中心
        <small></small>
      </h1>
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
      <!-- 入口标签————————开始 -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="todo">...</h3>
              <p>待办事项</p>
            </div>
            <div class="icon">
              <i class="fa fa-tv fa_smaller"></i>
            </div>
            <a href="todolist.php" class="small-box-footer">
              更多信息 <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="draft">...</h3>

              <p>草稿箱</p>
            </div>
            <div class="icon">
              <i class="fa fa-sticky-note-o fa_smaller"></i>
            </div>
            <a href="draftbox.php" class="small-box-footer">
              更多信息 <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="participate">2</h3>

              <p>参与事项</p>
            </div>
            <div class="icon">
              <i class="fa fa-hourglass-half fa_smaller"></i>
            </div>
            <a href="participated.php" class="small-box-footer">
              更多信息 <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>30</h3>

              <p>我的文档</p>
            </div>
            <div class="icon">
              <i class="fa fa-clone fa_smaller"></i>
            </div>
            <a href="#" class="small-box-footer">
              更多信息 <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- 入口标签——结束 -->

      <!-- 企业新闻————————开始 -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">企业新闻</h3>

              <!--<div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>类别</th>

                  <th>时间</th>

                  <th>新闻标题</th>
                </tr>
                <tr>
                  <td>183</td>

                  <td>11-7-2014</td>

                  <td>外交部：中巴经济走廊建设与领土主权争议无关</td>
                </tr>
                <tr>
                  <td>219</td>

                  <td>11-7-2014</td>

                  <td>外交部：中巴经济走廊建设与领土主权争议无关</td>
                </tr>
                <tr>
                  <td>657</td>

                  <td>11-7-2014</td>

                  <td>外交部：中巴经济走廊建设与领土主权争议无关</td>
                </tr>
                <tr>
                  <td>175</td>

                  <td>11-7-2014</td>

                  <td>外交部：中巴经济走廊建设与领土主权争议无关</td>
                </tr>
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- 企业新闻————————结束 -->

      <!-- 文档中心————————开始 -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">文档中心</h3>

               <!--<div class="box-tools"搜索框>
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- /.box-header -->


            <!--<div class="box-body table-responsive no-padding">

              <table class="table table-hover">
                <tbody><tr>
                  <th>类别</th>

                  <th>时间</th>

                  <th>新闻标题</th>
                </tr>
                <tr>
                  <td>183</td>

                  <td>11-7-2014</td>

                  <td>外交部：中巴经济走廊建设与领土主权争议无关</td>
                </tr>
                <tr>
                  <td>219</td>

                  <td>11-7-2014</td>

                  <td>外交部：中巴经济走廊建设与领土主权争议无关</td>
                </tr>
                <tr>
                  <td>657</td>

                  <td>11-7-2014</td>

                  <td>外交部：中巴经济走廊建设与领土主权争议无关</td>
                </tr>
                <tr>
                  <td>175</td>

                  <td>11-7-2014</td>

                  <td>外交部：中巴经济走廊建设与领土主权争议无关</td>
                </tr>
              </tbody>
              </table>
            </div> -->
            <!-- /.box-body -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">类型1</a></li>
                <li><a href="#tab_2" data-toggle="tab">类型2</a></li>
                <li><a href="#tab_3" data-toggle="tab">类型3</a></li>
                <!--<li class="dropdown"下拉框删掉>
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Dropdown <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                  </ul>
                </li> -->
               <!--  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> -->
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <ul class="tab1_docu">
                    <li>
                      <div></div>
                    </li>
                    <li>
                      <div></div>
                    </li>
                    <li>
                      <div></div>
                    </li>
                    <li>
                      <div></div>
                    </li>
                    <div class="clear"></div>
                  </ul>


                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <ul class="tab1_docu">
                    <li>
                      <div></div>
                    </li>

                    <li>
                      <div></div>
                    </li>
                    <div class="clear"></div>
                  </ul>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                  <ul class="tab1_docu">
                    <li>
                      <div></div>
                    </li>
                    <li>
                      <div></div>
                    </li>
                    <li>
                      <div></div>
                    </li>

                    <div class="clear"></div>
                  </ul>
                </div>
                <!-- /.tab-pane -->
              </div>
            <!-- /.tab-content -->
          </div>


          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- 文档中心————————结束 -->

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
<script src="../bootstrap/js/bootstrap.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- 引入全局的功能 -->
<script src="../dist/js/pm/global_func.js"></script>
<!-- 引入main.js -->
<script src="../dist/js/pm/main.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script>
  $(function(){
    //页面到首页时，左边栏的信息中心呈选中状态
    $(".infocenter").addClass("active");

    // /api/1.0/{workspace}/users?filter={filter}&start={start}&limit={limit}
    var username=getCookie("username");
    pmRestRequest("GET","/api/1.0/workflow/users?filter="+username,true,null,function(data, status){

        if(data){
          var user_id=data.usr_uid;
          // GET /api/1.0/{workspace}/user/{usr_uid}
          
        }

    });

    logout();
    getUsername();
    getCatAndProj();

    pmRestRequest("GET","/api/1.0/workflow/cases/paged",true,null,function(data, status){

        if(data){
            console.log(data.total);
            $("#todo").html(data.total);
        }
    });
    pmRestRequest("GET","/api/1.0/workflow/cases/paged",true,null,function(data, status){

        if(data){
            console.log(data.total);
            $("#todo").html(data.total);
        }
    });
    pmRestRequest("GET","/api/1.0/workflow/cases/draft/paged",true,null,function(data, status){

        if(data){
            console.log(data.total);
            $("#draft").html(data.total);
        }
    });
    pmRestRequest("GET","/api/1.0/workflow/cases/participated/paged",true,null,function(data, status){

        if(data){
            console.log(data.total);
            $("#participate").html(data.total);
        }
    });






  });
</script>
</body>
</html>
