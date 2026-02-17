<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  use Controlador\Libraries\Controlador;
  require_once APPPATH . '/libraries/Controlador.php';
  
  class AlumnoLibrary extends Controlador {
    public function post_historial($data){
      try{
        $this->load->model('HistorialAcademicoModel');
        $id_historial = $this->HistorialAcademicoModel
          ->getNextId();
        $nombre_archivo = $this->guarda_archivo_en_servidor(
          'historiales',
          $data['id_alumno'].'_'.$data['semestre'].'_'.$id_historial,
          'pdf',
          'archivo'
        );
        $this->HistorialAcademicoModel->post(
          $nombre_archivo,
          $data['id_alumno'],
          $data['semestre'],
          $id_historial
        );
        $this->genera_respuesta(
          true,
          'Historial registrado de forma exitosa'
        );
      }catch(Exception $e){
        $this->genera_respuesta(
          false,
          $e->getMessage()
        );
      }
    }
  }
  