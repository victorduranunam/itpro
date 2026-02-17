<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/models/ValidadorRegistroModel.php';
class HistorialAcademicoModel extends ValidadorRegistroModel {

	public function finaliza_ejecucion(){
		$this->db->trans_complete();
	}

  public function getNextId(){
    $id = $this->db->query("select nextval('historial_calificaciones_id_seq');");
    if ( !$id ){
      throw new Exception ("Error al registrar el historial de calificaciones");
      //$error = $this->db->error(); // Has keys 'code' and 'message'
    }
    return $id
      ->result()[0]
      ->nextval;
  }

	public function post($nombre_historial,$id_alumno,$semestre_generacion,$id_historial=null) {
    $dataHistorial = [
      'id_alumno' => $id_alumno,
      'semestre' => $semestre_generacion,
      'archivo' => $nombre_historial,
    ];
    $fieldsHistorial = [
      'id_alumno',
      'semestre',
      'archivo',
    ];
    if (!is_null($id_historial)){
      $dataHistorial['id_historial'] = $id_historial;
      array_push($fieldsHistorial, 'id_historial');
    }
		try{
			return $this->ejecutaInsercion(
				'historial_calificaciones',
				$dataHistorial,
				$fieldsHistorial
			);
		}catch(Exception $e){
			throw $e;
		}
	}

  public function getAll($id_alumno) {
    $historiales = $this->db
      ->from ('historial_calificaciones hc')
      ->where('id_alumno',$id_alumno)
      ->order_by('semestre desc,created desc')          
      ->get(); 
    if ($historiales->num_rows() >= 1){
        $historiales = $historiales->result();
        $this->db->stop_cache();
        $this->db->flush_cache();
        return $historiales;
    }
    return false;
  }

}
