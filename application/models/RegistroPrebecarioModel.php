<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/models/ValidadorRegistroModel.php';
require_once APPPATH . '/models/GeneracionModel.php';
require_once APPPATH . '/models/HistorialAcademicoModel.php';
class RegistroPrebecarioModel extends ValidadorRegistroModel {
	public function setPrebecario($datos){
		try{
		
			$this->valida_datos($datos);
			$this->db->trans_start();
			$this->db->trans_strict(FALSE);
			
			//REGISTRANDO CONTACTO Y VERIFICANDO AUSENCIA DE ERROR AL INSERTAR, RECUPERANDO ID CONTACTO REGISTRADO
			$contacto_id = $this->ejecutaInsercion(
				'contacto',
				$datos,
				array('celular',
					'telefono',
					'email'
				)
			);
			
			//REGISTRANDO alumno Y VERIFICANDO AUSENCIA DE ERROR AL INSERTAR, RECUPERANDO ID alumno REGISTRADO
			$id_alumno = $this->ejecutaInsercion(
				'alumno',
				$datos,
				array('numero_cuenta',
					'nombre',
					'apellido_paterno',
					'apellido_materno',
					'rfc',
					'foto',
					'id_carrera'
				),
				array (
					'contacto_id' => $contacto_id/*,
					'direccion_id' => $direccion_id*/
				)
			);	
            //HISTORIAL NO OBLIGATORIO A PRIMER SEMESTRE
            if($datos['semestre_registro'] != '1'){
                $generacionModel = new GeneracionModel();
                $historialAcademicoModel = new HistorialAcademicoModel();
                //Registrando historial académico
                $historialAcademicoModel->post (
                    $datos['historial'],
                    $id_alumno,
                    $generacionModel
                        ->get_geneacion($datos['id_generacion'])
                        ->semestre,
                    $datos['id_historial']
                );
            }

			//REGISTRANDO solicitud Y VERIFICANDO AUSENCIA DE ERROR AL INSERTAR, RECUPERANDO ID solicitud REGISTRADO
			if (strlen($id_alumno)== 1){
				$id_alumno="0".$id_alumno;
			}
			date_default_timezone_set('America/Mexico_City');
			$anio=date('Y');
			
			$datos['clave_solicitud']="".$anio.$datos['generacion'].$id_alumno;
			$id_solicitud = $this->ejecutaInsercion(
				'solicitud',
				$datos,
				array(
					'id_generacion',
					'semestre_registro',
					'promedio_registro',
					'clave_solicitud'
				),
				array (
					'id_estado_solicitud' => 1,
					'id_alumno' => $id_alumno
				)
			);	

			$this->almacena_preguntas($datos,$id_solicitud);
			
			return $datos['foto'];
		}catch(Exception $e){
			throw $e;
		}
		
	}
	
	public function finaliza_ejecucion(){
		$this->db->trans_complete();
	}
	private function valida_datos($arreglo_datos){
		//VALIDANDO DATOS DE LA SOLICITUD Y ALUMNO
		if (empty($arreglo_datos['numero_cuenta']) or empty($arreglo_datos['nombre']) or empty($arreglo_datos['apellido_paterno']) or empty($arreglo_datos['promedio_registro']) or empty($arreglo_datos['rfc']) or empty($arreglo_datos['id_carrera']) or empty($arreglo_datos['semestre_registro'])){
			throw new Exception ("Error: 1  No se pudo registrar la solicitud, datos faltantes");
		}
		
		if (intval($arreglo_datos['numero_cuenta'])==0){
			throw new Exception ("Error: 3   No se pudo registrar la solicitud, formato de numero de cuenta no valido");
		}
		//$arreglo_datos['promedio_registro']=floatval($arreglo_datos['promedio_registro']);
		//if (!is_float ($arreglo_datos['promedio_registro']) or $arreglo_datos['promedio_registro']<7.5 or $arreglo_datos['promedio_registro']>10){
		//	throw new Exception ("Error: 4   No se pudo registrar la solicitud, formato de promedio no valido");
		//}

		$arreglo_datos['promedio_registro'] = floatval($arreglo_datos['promedio_registro']);
		if (!is_float($arreglo_datos['promedio_registro']) 
			or $arreglo_datos['promedio_registro'] < 0 
			or $arreglo_datos['promedio_registro'] > 10) {
			throw new Exception ("Error: 4   No se pudo registrar la solicitud, formato de promedio no valido");
		}

		
		if(!preg_match ("/^[A-Z]{4}[0-9]{6}/", $arreglo_datos['rfc'])){
			throw new Exception ("Error: 5   No se pudo registrar la solicitud, formato de rfc no valido");
		}
		
		if ( intval($arreglo_datos['semestre_registro'])==0){
			throw new Exception ("Error: 6   No se pudo registrar la solicitud, formato de semestre no valido");
		}
		/*
		//VALIDANDO DATOS DE LA DIRECCION
		if (empty ($arreglo_datos['calle_numero']) or empty ($arreglo_datos['colonia']) or empty ($arreglo_datos['estado']) or empty ($arreglo_datos['codigo_postal'])){
			throw new Exception ("6No se puede registrar la solicitud, datos faltantes");
		}

		if (intval ($arreglo_datos['codigo_postal'])== 0){
			throw new Exception ("7No se puede registrar la solicitud, formato de codigo postal incorrecto ");
		}
		*/
		//VALIDANDO DATOS DE CONTACTO
		if (empty ($arreglo_datos['email'])){
			throw new Exception ("Error: 7   No se pudo registrar la solicitud, datos faltantes");
			//echo "No se puede registrar la direccion, datos faltantes";
		}

		// if (empty($arreglo_datos['telefono']) and empty ($arreglo_datos['celular'])){
		//	throw new Exception ("Error: 9   No se pudo registrar la solicitud, datos faltantes");
		// }
		
		if (!preg_match("/^[\w.-]+@[\w.-]+\.[a-zA-Z]/",$arreglo_datos['email'])){
			throw new Exception ("Error: 9   No se pudo registrar la solicitud, formato de correo no valido");
		}
	}

	private function almacena_preguntas($datos,$id_solicitud){
		try{
			foreach ($datos as $indice => $valor){
				//REGISTRANDO RESPUESTA PREGUNTA ABIERTA
				if (preg_match("/^abierta_*/",$indice)){
					$this->almacena_preguntas_abiertas(
						str_replace ( "abierta_" , "" , $indice ),
						$id_solicitud,
						$valor
					);
				}else if (preg_match("/^resp_cerr_*/",$indice)){
					$id_respuesta_opcional = str_replace ( "resp_cerr_" , "" , $indice );
					//var_dump($id_respuesta_opcional);
					$this->almacena_preguntas_cerradas(
						$id_respuesta_opcional,
						$id_solicitud, 
						$valor,
						$datos
					);
				}
			}
		}catch(Exception $e){
			throw $e;
		}
	}

	private function almacena_preguntas_abiertas($id_pregunta_abierta,$id_solicitud, $respuesta){
		try{
			$this->ejecutaInsercion(
				'respuesta_preg_ab',
				false,
				false,
				array (
					'id_solicitud' => $id_solicitud,
					'id_pregunta_abierta' =>$id_pregunta_abierta,
					'respuesta' => $respuesta
				),
				true
			);
		}catch(Exception $e){
			throw $e;
		}
		
	}

	private function almacena_preguntas_cerradas($id_pregunta_opcional,$id_solicitud, $respuesta,$datos){
		try{
			$otro = null;
			//VERIFICANDO QUE EL ID DE LA RESPUESTA OPCIONAL SEA CORRESPONDIENTE A OTRO
			//Y CHECANDO SI CONTIENE EL VALOR DE OTRO
			$this->iniciaCache();
			$registro_opcional =$this->db->where('id_respuesta_opcional', $respuesta)
				->where('opcion', 'Otro')
				->or_where('opcion', 'OTRO')
				->or_where('opcion', 'otro')
				->get('cat_respuesta_opcional');
			
			if ($registro_opcional->num_rows() ==1){
				if (isset($datos['opcional_resp_cerr_'.$id_pregunta_opcional])){
					$otro = $datos['opcional_resp_cerr_'.$id_pregunta_opcional];
				}else{
					throw new Exception ('Error al registrar solicitud.');
				}
			}
			$this->cierraCache();
			//INSERTANDO RESPUESTA SELECCIONADA
			$this->ejecutaInsercion(
				'respuesta_preg_opc',
				false,
				false,
				array (
					'id_solicitud' => $id_solicitud,
					'id_respuesta_opcional' => $respuesta,
					'otro' => $otro
				),
				true
			);
		}catch(Exception $e){
			throw $e;
		}
		
	}
	
}
