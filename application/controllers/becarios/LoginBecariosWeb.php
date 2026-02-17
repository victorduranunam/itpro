<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once APPPATH . '/libraries/LoginLibrary.php';

    class LoginBecariosWeb extends CI_Controller {

        public function __construct(){
            parent::__construct();            
            $this->login=new LoginLibrary();
            
            $this->load->helper("session");
            
        }

        public function index(){
            
            if (!session_sistema_gestion_activa()){
                $this->load->view('becarios/login');     
            }else{
                redirect(base_url().$this->session->ruta_actual);
            }
        }

        public function datos_usuario_sesion(){
            $this->login->obten_datos_usuario_sesion($_POST);
            if(! $this->login->respuesta->status){
                $this->session->mensaje= $this->login->respuesta->mensaje;               
                $this->session->tipo_mensaje ='error';
                redirect(base_url().'login');
            }
            foreach ($this->login->respuesta->data as $clave => $valor){
                $this->session->{$clave}=$valor;
            }
            $this->session->ruta_actual="bienvenido";
            
            redirect(base_url().'bienvenido');
        }

        public function teminar_sesion(){
            $this->session->sess_destroy();
            session_start();
            $this->session->mensaje= 'Sesión finalizada de forma correcta';               
            $this->session->tipo_mensaje='satisfactorio';   
            redirect(base_url().'login');
        }
       /* Modificar cuando se programen mas roles y customizar pantalla de inicio */
        public function bienvenido(){
            
            if(es_sesion_administrador()){
                redirect(base_url().'seleccion_generacion');
            }
            $this->teminar_sesion();
        }

        
    }