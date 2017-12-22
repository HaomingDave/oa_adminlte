<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->


    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">应用列表<span>2017年5月17日</span></li>
      <!-- Optionally, you can add icons to the links -->
      <li class="infocenter"><a href="oaindex.php"><i class="fa fa-link"></i> <span>信息中心</span></a></li>


      <!-- 新建事项>>>开始 -->
      <li class="treeview newcaselist">
        <a href="#">
          <i class="fa fa-share" ></i> <span>新建事项</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: none;" id="caselists">
          <!-- 自动生成新建事项的列表 -->
        </ul>
      </li>
      <!-- 新建事项>>>结束 -->

      <!-- 草稿箱>>>开始 -->
      <li class="draft"><a href="draftbox.php"><i class="fa fa-link"></i> <span>草稿箱</span></a></li>
      <!-- 草稿箱>>>结束 -->

      <!-- 参与事项>>>开始 -->
      <li class="participated"><a href="participated.php"><i class="fa fa-link"></i> <span>参与事项</span></a></li>
      <!-- 参与事项>>>结束 -->

      <!-- 待办事项>>>开始 -->
      <li class="todolist"><a href="todolist.php"><i class="fa fa-link"></i> <span>待办事项</span></a></li>
      <!-- 待办事项>>>结束 -->



    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
