<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    use Restserver\Libraries\REST_Controller;
    require_once APPPATH . '/libraries/REST_Controller.php';
    require_once APPPATH . '/libraries/Format.php';
    require_once APPPATH . '/libraries/GeneracionLibrary.php';

    class GeneracionesAPI extends REST_Controller {

        public function __construct(){
            parent::__construct();
            $this->generacion=new GeneracionLibrary();
        }

        public function obten_generaciones_descendente_get(){
            $this->generacion->obten_generaciones_descendente();
            $this->response($this->generacion->respuesta,  200);
        }
    }