<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Controlador\Libraries\Controlador;
require_once APPPATH . '/libraries/Controlador.php';

class RegistroPrebecario extends Controlador {

	public function agrega_solicitud_prebecario($datos){
		$this->load->model('RegistroPrebecarioModel');
		try{
			// GUARDANDO ARCJIVO DE FOTO EN EL SERVIDOR
	
			var_dump($_FILES);
			exit;



			$nombre=$this->guarda_imagen_en_servidor($datos['numero_cuenta']. $datos['rfc']);
			$datos['foto']= $nombre;

			// GUARDANDO ARCHIVO DE HISTORIAL EN EL SERVIDOR
            //NO OBLIGATORIO PARA PRIMER SEMESTRE 
            if($datos['semestre_registro'] != '1'){
                $this->load->model('HistorialAcademicoModel');
                $datos['id_historial'] = $this->HistorialAcademicoModel
                    ->getNextId();
                $datos['historial'] = $this->guarda_archivo_en_servidor(
                    'historiales',
                    $datos['numero_cuenta'].'_'.$datos['semestre_registro'].'_'.$datos['id_historial'],
                    'pdf',
                    'historial'
                );
            }

			// REGISTANDO TODOS LOS DATOS DE LA SOLICITUD EN LA BD
			$this->RegistroPrebecarioModel->setPrebecario($datos);
            
			// ENVIANDO CORREO DE SOLICITUD RECIBIDA CON INSTRUCCIONES
			$this->load->library('SendEmail',null,'correo');
			$this->correo->envia_correo(
				$_POST['email'],
				$this->load->view('commonParts/simpleBootstrapRegisterBecariosHead', array(), TRUE).
					$this->load->view('RegistroPrebecarioWEB/registrado', array(), TRUE).
					$this->load->view('commonParts/simpleBootstrapRegisterBecariosEnd', array(), TRUE),
				'Solicitud de IT-PRO'
			);

			// ENVIANDO CORREO DE AVISO DE REGISTRO AL ADMINISTRADOR DEL SITIO
			$this->correo->envia_correo(
				'itpro@ingenieria.unam.edu',
				'<p>Se ha recibido una solicitud para Becarios de '.$datos['nombre'].' '.$datos['apellido_paterno'].' '.$datos['materno'].'</p>',
				'Solicitud de IT-PRO'
			);
			$this->correo->envia_correo(
				'bety@ingenieria.unam.edu',
				'<p>Se ha recibido una solicitud para Becarios de '.$datos['nombre'].' '.$datos['apellido_paterno'].' '.$datos['materno'].'</p>',
				'Solicitud IT-PRO'
			);
			$this->RegistroPrebecarioModel->finaliza_ejecucion();
			$this->genera_respuesta(
				true,
				'Solicitud registrada de forma exitosa'
			);
		}catch(Exception $e){
			$this->genera_respuesta(
				false,
				$e->getMessage()
			);
		}
	}


	public function obten_solicitud_registro(){
		$this->load->model('DatosSolicitudModel');
		try{
			$generacion =$this->DatosSolicitudModel
				->obtenerGeneracionActual();
			$cat_carreras = $this->DatosSolicitudModel
				->obtenerCarreras();
			$cat_preguntas_abiertas = $this->DatosSolicitudModel
				->obtenerPreguntasAbiertas($generacion->id_generacion);
			$cat_preguntas_opcionales = $this->DatosSolicitudModel
				->obtenerPreguntasOpcionales($generacion->id_generacion);
			$this->genera_respuesta(
				true,
				'Datos de la solicitud recuperados con éxito',
				array(
					'generacion' => $generacion,
					'cat_carreras' => $cat_carreras,
					'cat_preguntas_abiertas' => $cat_preguntas_abiertas,
					'cat_preguntas_opcionales' => $cat_preguntas_opcionales
				)
			);
		}catch(Exception $e){
			$this->genera_respuesta(
				false,
				$e->getMessage()
			);
		}
	}
}
