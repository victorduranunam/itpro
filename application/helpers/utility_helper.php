<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    function asset_url(){
        $base_url=str_replace("/index.php","",base_url());
        return $base_url.'assets/';
     }

     function clean_post(){
         foreach($_POST as $clave => $valor){
             if (trim($valor)==""){
                 $_POST[$clave]=null;
             }
         }
     }