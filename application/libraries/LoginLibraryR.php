<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Controlador\Libraries\Controlador;
require_once APPPATH . '/libraries/Controlador.php';

class Loginlibrary extends Controlador {
    public function obten_datos_usuario_sesion($datos=null){
        //die("Entró a obten_datos_usuario_sesion con datos: " . print_r($datos, true));


        $this->load->model('AccesoModel');



        if ( $this->AccesoModel->confirmIPAddress() ) {




            try{
                $usuario = $this->AccesoModel->login_usuario(
                    $datos['usuario_prebes_unica'],
                    $datos['contrasena_prebes_unica']
                );
                $this->AccesoModel->clearLoginAttempts();

                $this->genera_respuesta(
                    true,
                    'Datos de usuario recuperados de forma satisfactoria.',
                    array(
                        'id_usuario' => $usuario->id_usuario,
                        'usuario' => $usuario->usuario,
                        'nombre' => $usuario->nombre,
                        'apellido_paterno' => $usuario->apellido_paterno,
                        'apellido_materno' => $usuario->apellido_materno,
                        'tipo_usuario' => $usuario->tipo_usuario
                    )
                );
            }catch(Exception $e){
                $this->AccesoModel->addLoginAttempt();
                $this->genera_respuesta(
                    false,
                    $e->getMessage()
                );
            }
        }else{

            
            $this->genera_respuesta(
                false,
                'Muchos intentos de inicio de sesión fallidos, favor de intentar mas tarde'
            );
        }
    }
}