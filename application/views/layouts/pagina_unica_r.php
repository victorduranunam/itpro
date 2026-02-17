<!DOCTYPE html>
<html lang="en">
	<head>
		<title>UNIDAD DE SERVICIOS DE C&Oacute;MPUTO ACAD&Eacute;MICO DE LA F.I.</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

		<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Armata' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
		<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css' rel='stylesheet'>
		<link rel="stylesheet" href="<?= asset_url() ?>css/estilos_secciones_sitio_UNCA.css">
		<link rel="stylesheet" href="<?= asset_url() ?>js/jquery-validation-1.14.0/demo/css/screen.css">
		<script src="<?= asset_url() ?>js/jquery-validation-1.14.0/lib/jquery.js"></script>
		<script src="<?= asset_url() ?>js/jquery-validation-1.14.0/dist/jquery.validate.js"></script>
		<script src="<?= asset_url() ?>js/valid.js"  type="text/javascript"></script>

		<link rel="stylesheet" href="<?= asset_url() ?>css/estilos_registro.css"> 
		
	</head>
	
	<body>
		<div class="container-fluid" id="contenedor_principal">
			<header id="big">
				<img src="<?= asset_url() ?>media/img/logo_unicaA.png" id="unicaS">
				<h1> Unidad de Servicios de C&oacute;mputo Acad&eacute;mico</h1>
				<div class="redes_sociaes">
					<button class="botones_redes_sociales" id="menus_portada_1"><span><img src="<?= asset_url() ?>media/img/gmail.png"> </span></button>
					<button class="botones_redes_sociales" id="menus_portada_2" ><span><img src="<?= asset_url() ?>media/img/facebook.png"></span></button>
					<button class="botones_redes_sociales" id="menus_portada_3"><span><img src="<?= asset_url() ?>media/img/twitter1.png"> </span></button>
				</div>
			</header>
			<!--<div class="container-fluid" id="encabezado">
				<div class="row align-items-center">
					<div class="col-md-2"  >
						<img src="<?= asset_url() ?>media/img/logo_unicaA.png" id="unicaS">
					</div>    
					<div class="col-md-7" id="logo_unicaS" >
						<span id="letrero_unica1"> Unidad de Servicios de C&oacute;mputo Acad&eacute;mico</span>
					</div>
					<div class="col-md-3"  >
						<button class="botones_redes_sociales" id="menus_portada_1"><span><img src="<?= asset_url() ?>media/img/gmail.png"> </span></button>
						<button class="botones_redes_sociales" id="menus_portada_2" ><span><img src="<?= asset_url() ?>media/img/facebook.png"></span></button>
						<button class="botones_redes_sociales" id="menus_portada_3"><span><img src="<?= asset_url() ?>media/img/twitter1.png"> </span></button>
					</div>
				</div>        
			</div>-->
			
			<div id="menu_encabezado">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<a class="navbar-brand" id="header-small" href="#">
						<img src="<?= asset_url() ?>media/img/logo_unicaA.png" id="unicaS">
					</a>
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item active">
								<a class="nav-link" href="https://www.ingenieria.unam.mx/unica/indexN.php">Inicio </a>
							</li>
							<!--
							<li class="nav-item">
								<a class="nav-link" href="#">Organizaci&oacute;n</a>
							</li>
							-->
							
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Organizaci&oacute;n
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/historia.php">Historia</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/vision.php">Visi&oacute;n</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/mision.php">Misi&oacute;n</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/organigrama.php">Organigrama</a>
		
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="https://www.ingenieria.unam.mx/unica/servicios.php">Servicios</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="https://www.ingenieria.unam.mx/unica/proyectos.php">Proyectos</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Programa de becarios <span class="sr-only">(current)</span>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/descripcion_becarios.php">Descripci&oacute;n</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/convocatoria_becarios.php">Convocatoria</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Registro</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Cursos
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/calendario_cursos.php">Calendario</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/temarios.php">Temario</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Plataformas educativas
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/educafi.php">EDUCAFI</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/gsuite.php">Google Suite</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="https://www.ingenieria.unam.mx/unica/office365.php">Office 365</a>
								</div>	
							</li> 
						</ul>
							
					</div>
				</nav>   
			</div>

			<div class="container-fluid" id="cuerpo" >
				<?= $content_for_layout; ?>
			</div>
			<div class="container-fluid" id="pie_pagina">
				<div class="row">
					<div class="col-sm-4" id="logos_inferiores" ><img src="<?= asset_url() ?>media/img/unam2.png" height="100px"> </div>
					<div class="col-sm-4" id="logos_inferiores" ><img src="<?= asset_url() ?>media/img/logo_unica.png" height="100px"> </div>
					<div class="col-sm-4" id="logos_inferiores" ><img src="<?= asset_url() ?>media/img/fi03.png" height="100px"> </div>
					<div class="col-sm-12" id="derechos_reservados" > Derechos reservados: Facultad de Ingenier&iacute;a, Av. Universidad 3000, Coyoac&aacute;n, CDMX, 04510</div>    
				</div>
			</div>
		</div>
		<script src="<?= asset_url() ?>js/operaForma.js"  type="text/javascript"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function(){
				$('[data-toggle="popover"]').popover();
				$("#acuerdo").on('change', function(){
					if( $(this).is(':checked') ) {
						$('#enviar').removeClass('disabled');
						$('#enviar').attr('disabled',false);

					}else{
						$('#enviar').addClass('disabled');
						$('#enviar').attr('disabled',true);
					}
					
				});
			});
		</script>
	</body>
</html>