<?php echo doctype('html5');  ?>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->config->item('sitename'); ?> | <?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <?php echo link_tag(JSPATH.'bootstrap/dist/css/bootstrap.min.css'); ?>
  <!-- Font Awesome -->
  <?php echo link_tag(FONTSPATH.'font-awesome/css/font-awesome.min.csss'); ?>
  <!-- Ionicons -->
  <?php echo link_tag(FONTSPATH.'Ionicons/css/ionicons.min.css'); ?>
  <!-- Theme style -->
  <?php echo link_tag(CSSPATH.'AdminLTE.min.css'); ?>
  <!-- iCheck -->
  <?php echo link_tag(JSPATH.'iCheck/square/blue.css'); ?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 </head>
 <body class="hold-transition login-page">
  <div class="login-box">
   <div class="login-logo">
    <a href="<?php echo base_url(); ?>"><b><?php echo $this->config->item('sitename'); ?></b></a>
   </div>
   <!-- /.login-logo -->
   <div class="login-box-body">
    <p class="login-box-msg">Ingresa tus datos para iniciar sesion</p>
    <form action="<?php echo base_url('admin/login/validar/'); ?>" method="post">
     <div class="form-group has-feedback">
      <input type="text" name="username" class="form-control" placeholder="Usuario">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
     </div>
     <div class="form-group has-feedback">
      <input type="password" name="password" class="form-control" placeholder="Contraseña">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
     </div>
     <?php if (isset($error)): ?>
     <p class="red-text"></p>
     <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Error!</h4>
      <?php echo $error; ?>
     </div>
     <?php endif ?>
     <div class="row">
      <div class="col-xs-8">
       <div class="checkbox icheck">
        <label>
         <input type="checkbox"> Recuerdame
        </label>
       </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
       <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
      </div>
      <!-- /.col -->
     </div>
    </form>
    <a href="#">Olvidé mi contraseña</a><br>
   </div>
   <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
  <!-- jQuery 3 -->
  <script src="<?php echo base_url(JSPATH.'jquery/dist/jquery.min.js'); ?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url(JSPATH.'bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url(JSPATH.'iCheck/icheck.min.js');?>"></script>
  <script>
   $(function () {
    $('input').iCheck({
     checkboxClass: 'icheckbox_square-blue',
     radioClass: 'iradio_square-blue',
     increaseArea: '20%' // optional
    });
   });
  </script>
 </body>
</html>