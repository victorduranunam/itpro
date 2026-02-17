<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    use Restserver\Libraries\REST_Controller;
    require_once APPPATH . '/libraries/REST_Controller.php';
    require_once APPPATH . '/libraries/Format.php';
    require_once APPPATH . '/libraries/ElementosDependientesGeneracionLibrary.php';

    class ElementosDependientesGeneracionAPI extends REST_Controller {

        public function __construct(){
            parent::__construct();
            $this->elementos_dependientes_generacion=new ElementosDependientesGeneracionLibrary();
        }

        public function obten_alumnos_cursos_generacion_get(){
            $this->elementos_dependientes_generacion->obten_elementos_dependientes_generacion($this->get('id_generacion'));
            $this->response(
                $this->elementos_dependientes_generacion->respuesta,  
                200
            );
        }

        public function datos_solicitud_put(){
            $this->elementos_dependientes_generacion->actualiza_datos_solicitud_alumno($this->put());
            $this->response(
                $this->elementos_dependientes_generacion->respuesta,  
                200
            );
        }
    }