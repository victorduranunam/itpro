<?php
     function session_sistema_gestion_activa(){
        $CI = & get_instance();
        $usuario_id = $CI->session->id_usuario;
        $tipo_usuario = $CI->session->tipo_usuario;
        if (! isset($usuario_id) or !isset($tipo_usuario)){
            return false;     
        }
        return true;
     }
     function es_sesion_administrador(){
        $CI = & get_instance();
         if (session_sistema_gestion_activa()){
             if ($CI->session->tipo_usuario=='Administrador'){}
             return true;
         }
         return false;
     }