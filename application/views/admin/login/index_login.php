<?php echo doctype('html5'); ?><html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->config->item('sitename'); ?> | <?php echo $title ?></title>
  <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="application-name" content="MyLoanAdmin">
  <meta name="apple-mobile-web-app-title" content="MyLoanAdmin">
  <meta name="theme-color" content="#3c8dbc">
  <meta name="msapplication-navbutton-color" content="#3c8dbc">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="msapplication-starturl" content="/">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="57x57" href="<?=base_url(IMGPATH);?>favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?=base_url(IMGPATH);?>favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url(IMGPATH);?>favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url(IMGPATH);?>favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url(IMGPATH);?>favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?=base_url(IMGPATH);?>favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?=base_url(IMGPATH);?>favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?=base_url(IMGPATH);?>favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url(IMGPATH);?>favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?=base_url(IMGPATH);?>favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url(IMGPATH);?>favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?=base_url(IMGPATH);?>favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url(IMGPATH);?>favicon/favicon-16x16.png">
  <link rel="manifest" href="<?=base_url(PUBLICPATH);?>manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?=base_url(IMGPATH);?>favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#3c8dbc">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/login.min.css">
  <!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  <link rel="stylesheet" crossorigin rel="preconnect"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <div class="logo">
        <!-- <img src="/public/img/logo.svg"> -->
        <svg height="150" viewBox="0 0 102.10400390625 108.56500244140625">
            <g>
                <svg data-type="color" viewBox="48.948001861572266 45.71799850463867 102.10400390625 108.56500244140625" height="108.56500244140625" width="102.10400390625" 
                    xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path data-color="1" d="M116.988 122.729l-34.064 31.092V79.782c0-18.813 15.251-34.064 34.064-34.064v77.011z" fill="#b0deff"></path>
                        <path data-color="2" d="M83.012 122.729l-34.064 31.092V79.782c0-18.813 15.251-34.064 34.064-34.064v77.011z" fill="#66bfff"></path>
                        <path data-color="3" d="M151.052 122.729l-34.064 31.092V79.782c0-18.813 15.251-34.064 34.064-34.064v77.011z" fill="#4d6d8a"></path>
                        <path data-color="2" d="M150.599 136.412v17.871h-17.871l17.871-17.871z" fill="#66bfff"></path>
                    </g>
                </svg>
            </g>
        </svg>
      </div>
      <a class="brand-name" href="<?php echo base_url(); ?>"><?php echo $this->config->item('sitename'); ?></a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Ingresa tus datos para iniciar sesion</p>
      <form action="<?php echo base_url('admin/login/validar/'); ?>" method="post">
        <div class="form-group has-feedback"><input name="username" class="form-control" placeholder="Usuario"> <span
            class="glyphicon glyphicon-user form-control-feedback"></span></div>
        <div class="form-group has-feedback"><input type="password" name="password" class="form-control"
            placeholder="Contraseña"> <span class="glyphicon glyphicon-lock form-control-feedback"></span></div>
        <?php if (isset($error)): ?><p class="red-text"></p>
        <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Error!</h4><?php echo $error; ?>
        </div><?php endif?><div class="row">
          <div class="col-xs-8"></div>
          <div class="col-xs-4"><button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button></div>
        </div>
      </form>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
</body>

</html>