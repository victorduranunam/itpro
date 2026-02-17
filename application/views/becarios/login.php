<!DOCTYPE html>
<html>
  <head>    
    <meta charset="UTF-8"> 
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minium-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Yantramanav&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Patua+One&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="<?=asset_url() ?>css/estilos.css">
    <link rel="stylesheet" href="<?=asset_url() ?>css/login.css">
    <title>Sistema de administración de becarios</title>
	</head>
	<body>
    <div class="contenedor contenedor-total contenedor-login">
      <div class="contenedor contenedor-centro">
        <h2>Inicia sesión</h2>
<?php

  $mensaje =$this->session->mensaje;
  if (isset($mensaje)){ 
?>
        <div class="mensaje <?= $this->session->tipo_mensaje ?>">
          <p><?= $mensaje ?></p>
        </div>
<?php 
    unset($_SESSION ['mensaje']);
    unset($_SESSION['tipo_mensaje']);
  } 
?>
        <form class="login-form"  action="<?= base_url() ?>ingreso" method="post">
          <div class="entrada-texto">
              <input type="text" name="usuario_prebes_unica" placeholder="Nombre de usuario">
          </div>
          <div class="entrada-texto">
              <input type="password" name="contrasena_prebes_unica" placeholder="Contraseña">
          </div>
          <input type="submit" class="boton" value="Iniciar sesión">
        </form>

        <div class="descripcion-sistema">
          <div class="imagen">
            <img src="<?=asset_url() ?>media/img/Logo TD_mini.png" alt="Logo de TD">
          </div>
          <h1>
            Sistema de administración de becarios
          </h1>
          <p> 
            Hecho en México. D.R. 2025. Leer términos.
          </p>
        </div>
    </div>
  </body>
</html>