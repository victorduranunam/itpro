<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  require_once APPPATH . '/libraries/Controlador.php';
  require_once APPPATH . '/libraries/GeneracionLibrary.php';
  require_once APPPATH . '/libraries/AlumnoLibrary.php';
  require_once APPPATH . '/libraries/Layout.php';
  
  class AlumnoWeb extends CI_Controller {
    public function __construct(){
      parent::__construct();  
      $this->load->helper("session"); 
      if (!es_sesion_administrador()){
        redirect('logout');
      }     
      $this->generaciones=new GeneracionLibrary();
      $this->generaciones->obten_generaciones_descendente();
      $this->layout = new Layout();
      $this->layout->setLayout('sistema_gestion_becarios');
      $this->data['tipo_usuario']=$this->session->tipo_usuario;
      $this->data['nombre_usuario']=$this->session->nombre .' '.$this->session->apellido_paterno;
      $this->data['usuario']=$this->session->usuario;
      $this->data['generaciones']=$this->generaciones->respuesta->data;
      $this->data['scripts_validacion']=true;
      $this->alumnoLibrary = new AlumnoLibrary();
    }

    public function post_historial($id_alumno = null){
      
      if (!isset($_POST) || is_null($id_alumno)){
        $ruta_actual=$this->session->ruta_actual;
        if (isset($ruta_actual)){
          redirect($this->session->ruta_actual);
        }
        redirect ('seleccion_generacion');
      }
      clean_post();
      $data = $_POST;
      $data['id_alumno'] = $id_alumno;
      $this->alumnoLibrary->post_historial($data);
      
      if ($this->alumnoLibrary->respuesta->status){
        $this->session->tipo_mensaje_hist='satisfactorio';
      }else{
        $this->session->tipo_mensaje_hist='error';
      }
      $this->session->mensaje_hist= $this->alumnoLibrary->respuesta->mensaje;        
      unset( $_POST );
      redirect($this->session->ruta_actual);
    }
  }
  