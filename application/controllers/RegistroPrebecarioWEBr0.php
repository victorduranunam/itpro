<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once APPPATH . '/libraries/RegistroPrebecario.php';
    require_once APPPATH . '/libraries/Layout.php';

    class RegistroPrebecarioWEB extends CI_Controller {

        public function __construct(){
		    parent::__construct();
            $this->rpc=new RegistroPrebecario();
            $this->layout = new Layout();
        }
        public function solicitud(){
            //error_reporting(E_ALL);
            //ini_set('display_errors','1');
            
            $this->rpc->obten_solicitud_registro();
            $respuesta = $this->rpc->respuesta;
            
            if ($respuesta->status){
                $error_registro = $this->session->error_registro;
                unset($_SESSION['error_registro']);
                if (isset($error_registro)){
                    $respuesta->data['mensaje_error']=$error_registro;
                }else{
                    $respuesta->data['mensaje_error']=null;
                }
                //$this->load->view('layouts/PaginaUnica');
                $this->load->library('GeneradorComboSelectForm',NULL, 'generadorSelect');
                $this->load->library('GeneradorComboRadioForm',NULL, 'generadorRadio');

                $this->layout->setLayout('pagina_unica');
                $this->layout->view('SolicitudRegistro', $respuesta->data);

            }
        }


        public function registrar_solicitud2() {
            $respuesta = new stdClass();

            // 1️⃣ Validar foto
            if (!isset($_FILES['foto']) || empty($_FILES['foto']['name'])) {
                $respuesta->status = false;
                $respuesta->mensaje = 'No se cargó la foto.';
                print_r($respuesta);
                return; // Detener ejecución
            }

            // 2️⃣ Validar PDF historial
            if (!isset($_FILES['historial']) || empty($_FILES['historial']['name'])) {
                $respuesta->status = false;
                $respuesta->mensaje = 'No se cargó el historial académico (PDF).';
                print_r($respuesta);
                return; // Detener ejecución
            }

            // 3️⃣ Ambos archivos existen, agregarlos a $_POST para que el modelo los procese
            $_POST['foto'] = $_FILES['foto'];
            $_POST['historial'] = $_FILES['historial'];

            // 4️⃣ Llamar al modelo para guardar la solicitud
            $this->rpc->agrega_solicitud_prebecario($_POST);
            $respuesta = $this->rpc->respuesta;

            // 5️⃣ Mostrar la respuesta final
            print_r($respuesta);
        }


        public function registrar_solicitud(){
            $this->rpc->agrega_solicitud_prebecario($_POST);
            $respuesta = $this->rpc->respuesta;
           

            if ($respuesta->status){
                redirect('registro_exitoso');
            }else{
                $this->session->error_registro= $respuesta->mensaje;
                redirect('cargaSolicitudRegistro');
            }
        }

    

        public function registro_exitoso(){
            $this->layout->setLayout('pagina_unica');
            $this->layout->view('registrado');
        }
    }