<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/RegistroPrebecario.php';
require_once APPPATH . '/libraries/Layout.php';

class RegistroPrebecarioWEB extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->rpc = new RegistroPrebecario();
        $this->layout = new Layout();
    }

    public function solicitud(){
        $this->rpc->obten_solicitud_registro();
        $respuesta = $this->rpc->respuesta;

        if ($respuesta->status){
            // Revisar si hay mensaje de error previo en sesión
            $error_registro = $this->session->error_registro ?? null;
            unset($_SESSION['error_registro']);

            if ($error_registro){
                $respuesta->data['mensaje_error'] = $error_registro;
                // Mantener los datos previamente ingresados
                $respuesta->data['datos_previos'] = $this->session->datos_previos ?? [];
            }else{
                $respuesta->data['mensaje_error'] = null;
                $respuesta->data['datos_previos'] = [];
            }

            $this->load->library('GeneradorComboSelectForm', NULL, 'generadorSelect');
            $this->load->library('GeneradorComboRadioForm', NULL, 'generadorRadio');

            $this->layout->setLayout('pagina_unica');
            $this->layout->view('SolicitudRegistro', $respuesta->data);
        }
    }

    // Validación del RFC desde PHP
    private function validarRFC($rfc){
        $rfc = trim($rfc);
        // Acepta RFC de 10 o 13 caracteres
        if (!preg_match("/^[A-ZÑ&]{3,4}\d{6}([A-Z\d]{3})?$/i", $rfc)){
            throw new Exception("Formato de RFC inválido");
        }
        return strtoupper($rfc);
    }

    public function registrar_solicitud(){
        try {
            // Guardar datos previos en sesión para mantener el formulario
            $_SESSION['datos_previos'] = $_POST;

            // Validar RFC antes de enviar al modelo
            $_POST['rfc'] = $this->validarRFC($_POST['rfc']);

            // Llamada al modelo para guardar la solicitud
            $this->rpc->agrega_solicitud_prebecario($_POST);
            $respuesta = $this->rpc->respuesta;

            if ($respuesta->status){
                unset($_SESSION['datos_previos']); // Limpiar datos previos si todo fue correcto
                redirect('registro_exitoso');
            }else{
                $this->session->error_registro = $respuesta->mensaje;
                redirect('cargaSolicitudRegistro');
            }

        } catch(Exception $e){
            // Captura errores de validación (RFC, archivos, etc.)
            $this->session->error_registro = $e->getMessage();
            redirect('cargaSolicitudRegistro');
        }
    }

    public function registro_exitoso(){
        $this->layout->setLayout('pagina_unica');
        $this->layout->view('registrado');
    }
}
