<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    use Restserver\Libraries\REST_Controller;
    require_once APPPATH . '/libraries/REST_Controller.php';
    require_once APPPATH . '/libraries/Format.php';
    require_once APPPATH . '/libraries/LoginLibrary.php';

    class LoginAPI extends REST_Controller {

        public function __construct(){
            parent::__construct();
            $this->login=new LoginLibrary();
        }

        public function datos_usuario_sesion_post(){
            $this->login->obten_datos_usuario_sesion($this->post());
            $this->response($this->login->respuesta,  200);
        }
    }