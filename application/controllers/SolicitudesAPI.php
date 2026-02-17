<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';
require_once APPPATH . '/libraries/RegistroPrebecario.php';


class SolicitudesAPI extends REST_Controller {

	public function ultima_solicitud_get(){
		$this->load->model('SolicitudModel');
		try{
			$solicitudes=$this->SolicitudModel
				->get_solicitudes_alumno_cuenta();
			$this->response($solicitudes,  200);
		}catch (Exception $e){
			$this->response($e,  400);
		}
	}

	public function ultima_solicitud_alumno_get(){
		$this->load->model('SolicitudModel');
		try{
			$solicitudes=$this->SolicitudModel
				->get_solicitudes_alumno_cuenta($this->get('numero_cuenta'));
			$this->response($solicitudes[0],  200);
		}catch (Exception $e){
			$this->response($e,  400);
		}
	}

	/*public function solicitud_registro_get(){
		$this->rpc->obten_solicitud_registro();
		$this->response($this->rpc->respuesta,  200);
	}*/
}