<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    use Restserver\Libraries\REST_Controller;
    require_once APPPATH . '/libraries/REST_Controller.php';
    require_once APPPATH . '/libraries/Format.php';
    require_once APPPATH . '/libraries/BecarioDatosPersonalesLibrary.php';

    class SeccionPersonalesAlumnoAPI extends REST_Controller {

        public function __construct(){
            parent::__construct();
            $this->becarioDatosPersonales=new  BecarioDatosPersonalesLibrary();
        }

        public function obten_solicitud_personal_alumno_get(){
            $this->becarioDatosPersonales->obten_elementos_seccion_datos_personales($this->get('id_alumno'),$this->get('id_generacion'));
            $this->response(
                $this->becarioDatosPersonales->respuesta,  
                200
            );
        }

        public function nota_solicitud_put(){
            $this->becarioDatosPersonales->actualiza_nota_solicitud_alumno(
                $this->put("id_solicitud"),
                $this->put("nota")
            );
            $this->response(
                $this->becarioDatosPersonales->respuesta,  
                200
            );
        }
    }