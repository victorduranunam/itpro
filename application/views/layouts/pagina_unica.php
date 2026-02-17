<!DOCTYPE html>
<html lang="en">
	<head>
		<title>IT-PRO</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		



		
		

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


		<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Armata' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css' rel='stylesheet'>
		<link rel="stylesheet" href="<?= asset_url() ?>js/jquery-validation-1.14.0/demo/css/screen.css">
		<script src="<?= asset_url() ?>js/jquery-validation-1.14.0/lib/jquery.js"></script>
		<script src="<?= asset_url() ?>js/jquery-validation-1.14.0/dist/jquery.validate.js"></script>
		<script src="<?= asset_url() ?>js/valid.js"  type="text/javascript"></script>
		<link rel="stylesheet" href="../../registro/assets/css/estilos_formulario_captura.css"> 

    	<link rel="stylesheet" href="../../../src/css/style.css">
    	<link rel="stylesheet" href="../../../src/css/footer.css">
    	<link rel="stylesheet" href="../../../src/css/header.css">
    	<link rel="stylesheet" href="../../../src/css/navbar.css">








	</head>
	
	<body>



	<!--TOP BAR-->
      <div class="top-bar">
        <div class="top-bar-container">
            <div class="contact-info">
                <!-- <a href="tel:+525556223044">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/>
                    </svg>
                    <span>+52 55 56 22 31 20</span>
                </a>
                <a href="mailto:transformaciondigital@unam.mx">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                    </svg>
                    <span>transformaciondigital@unam.mx</span>
                </a>-->
            </div>
            <!--
            <div class="social-icons">
                <a href="#" title="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                    </svg>
                </a>
                <a href="#" title="Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15"/>
                    </svg>
                </a>
                <a href="#" title="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                    </svg>
                </a>
                <a href="#" title="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408z"/>
                    </svg>
                </a>
            </div>
            -->
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <img src="../../../src/images/Encabezado/UNAM.png" alt="Logo UNAM" class="logo-unam">
                <div class="logo-separator"></div>
                <img src="../../../src/images/Encabezado/FI2.png" alt="Logo Facultad de Ingeniería" class="logo-fi">
                <div class="logo-separator"></div>
                <img src="../../../src/images/Encabezado/Logo TD_ColorNegro_CMYK.png" alt="Logo Transformación Digital" class="logo-fi">
                <div class="site-title">
                    <h1>División de Ingeniería Eléctrica</h1>
                    <p>Transformación Digital</p>
                </div>
            </div>
            <!--
            <button class="mobile-menu-btn" id="mobile-menu-toggle" aria-label="Abrir menú de navegación"></button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
            -->
        </div>
    </header>


    <!-- Navigation -->
    <nav class="nav-container">
        <div class="main-nav">
            <ul class="nav-list" id="main-menu">
                <li><a href="../../../index.html" class="">Inicio</a></li>
                <li class="dropdown">
                    <a href="#">Acerca de</a>
                    <div class="dropdown-content">
                        <a href="../../../src/pages/organizacion-organigrama.html">Organigrama</a>
                        <!--<a href="src/pages/organizacion-mision.html">Misión</a>
                        <a href="objetivos.html">Objetivos</a> -->
                    </div>
                </li>
                <li class="dropdown">
                    <a href="../../../src/pages/pc-puma.html">PC Puma</a>
                </li>
                <li class="dropdown">
                    <a href="#">Programa de becarios</a>
                    <div class="dropdown-content">
                        <a href="../../../src/pages/becarios-convocatoria.html">Convocatoria</a>
                        <a href="https://www.ingenieria.unam.mx/calendario/BecariosUNICA/index.php/cargaSolicitudRegistro">Registro</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="../../../src/pages/cursos-temario.html">Cursos</a>
                    <div class="dropdown-content">
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLScGRw5pPQwgY2e4MKzFQkw8zuiy6osJ7G3xvRHI1bYKB1sKNQ/viewform">Registro</a>
                        <a href="../../../src/pages/cursos-costos.html" class="dropdown-link">Costos</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#">Plataformas Educativas</a>
                    <div class="dropdown-content">
                        <a href="../../../src/pages/plataformas-educafi.html" class="dropdown-link">EDUCAFI</a>
                        <a href="../../../src/pages/plataformas-google-suite.html" class="dropdown-link">Google Suite</a>
                        <a href="../../../src/pages/plataformas-office-365.html" class="dropdown-link">Office 365</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

		<div class="container-fluid" id="contenedor_principal">

			<div class="container-fluid" id="cuerpo" >
					<?= $content_for_layout; ?>
			</div><!-- Fin container-fluid cuerpo-->

			<footer>
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-logo-section">
                <img src="../../../src/images/Encabezado/FI4.png" alt="Logo Facultad de Ingeniería" class="footer-logo">
                <h3>Facultad de Ingeniería</h3>
                <p>Universidad Nacional Autónoma de México</p>
            </div>
            <div class="footer-info">
                <h3>Información de Contacto</h3>
                <div class="footer-address">
                    <strong>Facultad de Ingeniería, Av. Universidad 3000,</strong><br>
                    Ciudad Universitaria, Coyoacán, Cd. Mx., CP 04510
                </div>
                <div class="footer-contact">
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/>
                        </svg>
                        <span>Teléfono: 55 56 22 31 20</span>
                    </div>
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                        </svg>
                        <span>Email: transformaciondigital@unam.mx</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Todos los derechos reservados © 2023- 2025 / Facultad de Ingeniería / UNAM</p>
            <p>Última actualización 12-09-2025</p>
        </div>
    </div>
</footer>
			

		</div> <!-- Fin container-fluid contenedor_principal -->


		
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