<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema de administración de becarios</title>
        
        <link href="<?= asset_url();?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= asset_url();?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= asset_url();?>css/nprogress.css" rel="stylesheet">
        <link href="<?= asset_url();?>css/green.css" rel="stylesheet">
        <link href="<?= asset_url();?>css/dropzone.min.css" rel="stylesheet">
    
        <!-- Hojas de estolo de la plantilla-->
        <link href="<?= asset_url();?>css/custom.min.css" rel="stylesheet">

        <link href="<?= asset_url();?>css/interior_sistemas.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= asset_url();?>css/estilos.css">
        <script>
            let base_url = "<?php echo base_url() ?>";
            let asset_url= "<?php echo asset_url() ?>";
        </script>
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="#" class="site_title">
                                <!--<i class="fa fa-paw"></i>-->
                                <span class="fa icon-logo">
                                    <img src="<?= asset_url();?>media/img/logo_unica_claro.png" alt="Logo de TD" class="img-circle profile_img logo-app"> 
                                </span>
                                <span>Becarios</span>
                            </a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="<?= asset_url();?>media/img/<?= $usuario ?>.jpg" alt="<?= $usuario ?>" class="img-circle profile_img">
                            </div>    
                            <div class="profile_info">
                                <span>Bienvenido,</span>
                                <h2><?= $nombre_usuario ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->
                        <br />
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">                                
<?php
                    if($tipo_usuario=='Administrador'){
                        $this->load->view('becarios/administrador/menu.php');
                    }else if($tipo_usuario=='Instructor'){
                        $this->load->view('becarios/instructor/menu.php');
                    }
?>
                

                        </div>
                    </div>
                </div>

                    <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <nav class="nav navbar-nav">
                            <ul class=" navbar-right">
                                <li class="nav-item dropdown open" style="padding-left: 15px;">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?= asset_url();?>media/img/<?= $usuario ?>.jpg" alt="<?= $usuario ?>"><?= $nombre_usuario ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                        <!--<a class="dropdown-item"  href="javascript:;"> Profile</a>
                                        <a class="dropdown-item"  href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                        <a class="dropdown-item"  href="javascript:;">Help</a>-->
                                        <a class="dropdown-item"  href="<?= base_url() ?>logout"><i class="fa fa-sign-out pull-right"></i> salir</a>
                                    </div>
                                </li>

                                <li role="presentation" class="nav-item dropdown open">
                                    <!--<a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green">6</span>
                                    </a>-->
                                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                                        <li class="nav-item">
                                            <a class="dropdown-item">
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item">
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item">
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item">
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <div class="text-center">
                                                <a class="dropdown-item">
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->
                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <?= $content_for_layout; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /page content -->
                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Hecho en México CDMX 2025. FI-DIE-Departamento de Transformación Digital
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>    

        <!-- jQuery -->
        
        
        <script src="<?= asset_url();?>js/jquery.min.js"></script>
<?php if ($scripts_validacion){ ?>
        <script src="<?= asset_url();?>js/multifield.js"></script>
        <script src="<?= asset_url();?>js/validator.js"></script>
        <script src="<?= asset_url();?>js/inicializador-form-validation.js"></script>
<?php } ?>
        <!-- Bootstrap -->
        <script src="<?= asset_url();?>js/bootstrap.bundle.min.js"></script>
        <!-- FastClick -->
        <script src="<?= asset_url();?>js/fastclick.js"></script>
        <!-- NProgress -->
        <script src="<?= asset_url();?>js/nprogress.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="<?= asset_url();?>js/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="<?= asset_url();?>js/icheck.min.js"></script>
        <script src="<?= asset_url();?>js/moment.min.js"></script>
        <script src="<?= asset_url();?>js/jquery.tagsinput.js"></script>
        <!-- PNotify -->
        <script src="<?= asset_url();?>js/pnotify.js"></script>
        <script src="<?= asset_url();?>js/pnotify.buttons.js"></script>
        <script src="<?= asset_url();?>js/pnotify.nonblock.js"></script>

        <script src="<?= asset_url();?>js/switchery.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="<?= asset_url();?>js/custom.min.js"></script>
        <script src="<?= asset_url();?>js/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<?php
    if(isset($js_personalizado)){
?>
        <script src="<?= asset_url();?>js/personalizados/<?= $js_personalizado ?>.js"></script>
<?php 
    }
?>
       
    </body>
</html>