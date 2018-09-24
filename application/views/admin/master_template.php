<?php
  $user = $this->session->userdata('user');
?>
<?php echo doctype('html5');  ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->config->item('sitename'); ?> | <?php echo $title ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?= base_url(IMGPATH); ?>favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url(IMGPATH); ?>favicon.ico" type="image/x-icon">
    <style>
    </style>
    <!-- Bootstrap 3.3.7 -->
    <?= link_tag(JSPATH.'bootstrap/dist/css/bootstrap.min.css'); ?>
    <?= link_tag(CSSPATH.'AdminLTE.min.css'); ?>
    <?php
      if (isset($head_includes)) {
        foreach ($head_includes as $value) {
          echo $value;
        }
      }
    ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <a href="<?php echo base_url('admin'); ?>" class="logo">
          <span class="logo-mini"><b>JP</b></span>
          <span class="logo-lg"><b><?php echo $this->config->item('sitename'); ?></b></span>
        </a>
        <nav class="navbar navbar-static-top">
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning"><?php echo count($this->Notifications) ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Tienes <?php echo count($this->Notifications) ?> notificaciones</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <?php foreach ($this->Notifications as $key => $notification): ?>
                        <?php echo $notification['description'] ?>
                        <?php endforeach ?>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?php echo base_url('admin/notificaciones'); ?>">View all</a></li>
                </ul>
              </li>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php if (is_file(IMGPROFILEPATH.$user['avatar'])): ?>
                  <img class="user-image" src="<?php echo base_url(IMGPROFILEPATH.$user['avatar']); ?>" alt="Avatar">
                  <?php endif ?>
                  <span class="hidden-xs"><?php echo $user['username']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <?php if (is_file(IMGPROFILEPATH.$user['avatar'])): ?>
                    <img class="img-circle" src="<?php echo base_url(IMGPROFILEPATH.$user['avatar']); ?>" alt="Avatar">
                    <?php endif ?>
                    <p>
                      <?php echo $user['username']; ?>
                      <small>Miembro desde <?php echo $user['date_created']->format('d M Y'); ?></small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url('admin/user/view/'.$user['id']); ?>" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url('admin/login'); ?>" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              <?php /*<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>*/ ?>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <a href="<?php echo base_url('admin/user/view/'.$user['id']); ?>">
            <div class="user-panel">
              <div class="pull-left image">
                <?php if (is_file(IMGPROFILEPATH.$user['avatar'])): ?>
                <img class="img-circle" src="<?php echo base_url(IMGPROFILEPATH.$user['avatar']); ?>" alt="Avatar">
                <?php endif ?>
              </div>
              <div class="pull-left info">
                <p><?php echo $user['username']; ?></p>
                <i class="fa fa-circle text-success"></i> Online
              </div>
            </div></a>
            <?php /*<form action="#" method="get" class="sidebar-form">
              <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>*/ ?>
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MAIN NAVIGATION</li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-users"></i> <span>Cobradores</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('admin/user'); ?>"><i class="fa fa-circle-o"></i> Todos</a></li>
                  <?php if($user['create_any_user']): ?>
                  <li><a href="<?php echo base_url('admin/user/add'); ?>"><i class="fa fa-plus-circle"></i>
                  Nuevo</a></li>
                  <?php endif; ?>
                </ul>
              </li>
              <li>
              <a href="<?php echo base_url('admin/user/calendar'); ?>">
                <i class="fa fa-calendar"></i> <span>Calendario</span>
              </a>
            </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-user"></i> <span>Clientes</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('admin/prestamo/clientes'); ?>"><i class="fa fa-circle-o"></i> Ver Clientes</a></li>
                  <li><a href="<?php echo base_url('admin/prestamo/clientes/nuevo'); ?>"><i class="fa fa-plus-circle"></i> Nuevo</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-money"></i> <span>Prestamos</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('admin/prestamo'); ?>"><i class="fa fa-circle-o"></i> Ver prestamos</a></li>
                  <li><a href="<?php echo base_url('admin/prestamo/nuevo'); ?>"><i class="fa fa-plus-circle"></i>Nuevo</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-file-text-o"></i> <span>Reportes</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('admin/prestamo'); ?>"><i class="fa fa-circle-o"></i> Ver prestamos</a></li>
                </ul>
              </li>
            </ul>
          </section>
          <!-- /.sidebar -->
        </aside>
        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <?php if (isset($pagecontent)) {
        echo $pagecontent;
        } ?>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Version</b> <?= SITEVERSION ?>
          </div>
          <strong>Copyright &copy; 2018 - <?= date('Y') ?> <a href="<?php echo base_url(); ?>"><?php echo $this->config->item('sitename'); ?></a>.</strong> All rights
          reserved.
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Create the tabs -->
          <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
              <h3 class="control-sidebar-heading">Recent Activity</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                      <p>Will be 23 on April 24th</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-user bg-yellow"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                      <p>New phone +1(800)555-1234</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                      <p>nora@example.com</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-file-code-o bg-green"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                      <p>Execution time 5 seconds</p>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- /.control-sidebar-menu -->
              <h3 class="control-sidebar-heading">Tasks Progress</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                    </h4>
                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                    </h4>
                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                    </h4>
                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                    </h4>
                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- /.control-sidebar-menu -->
            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
              <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Report panel usage
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                  <p>
                    Some information about this general settings option
                  </p>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Allow mail redirect
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                  <p>
                    Other sets of options are available
                  </p>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Expose author name in posts
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                  <p>
                    Allow the user to show his name in blog posts
                  </p>
                </div>
                <!-- /.form-group -->
                <h3 class="control-sidebar-heading">Chat Settings</h3>
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Show me as online
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Turn off notifications
                    <input type="checkbox" class="pull-right">
                  </label>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Delete chat history
                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                  </label>
                </div>
                <!-- /.form-group -->
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <div class="alert-zone"></div>
      <script>
        const JSPATH  = '<?= JSPATH ?>';
        const CSSPATH = '<?= CSSPATH ?>';
        const FONTSPATH = '<?= FONTSPATH ?>';
        const BASEURL = '<?= base_url() ?>';
      </script>
      <!-- jQuery 3 -->
      <script src="<?php echo base_url().JSPATH.'jquery/dist/jquery.min.js'; ?>"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="<?php echo base_url().JSPATH.'bootstrap/dist/js/bootstrap.min.js'; ?>"></script>
      <?php
        if (isset($footer_includes)) {
          foreach ($footer_includes as $key => $value) {
            echo $value;
          }
        }
      ?>
      <script src="<?php echo base_url().JSPATH.'app.min.js?v='.SITEVERSION; ?>"></script>
    </body>
  </html>