<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';
require_once APPPATH . '/libraries/RegistroPrebecario.php';


class RegistroPrebecarioAPI extends REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->rpc=new RegistroPrebecario();
	}
	public function solicitud_prebecario_post(){
		$this->rpc->agrega_solicitud_prebecario($this->post());
		$this->response($this->rpc->respuesta,  200);
	}


	public function solicitud_registro_get(){
		$this->rpc->obten_solicitud_registro();
		$this->response($this->rpc->respuesta,  200);
	}
}
