<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Controlador\Libraries\Controlador;
if (!class_exists('Controlador')){
    require_once APPPATH . '/libraries/Controlador.php';
}

class GeneracionLibrary extends Controlador {
    public function obten_generaciones_descendente(){
        $this->load->model('GeneracionModel');
        try{
            $generaciones = $this->GeneracionModel->get_generaciones_descendente();
            $this->genera_respuesta(
                true,
                'Catálogo de generaciones recuperado de forma satisfactoria',
                $generaciones
            );
        }catch(Exception $e){
            $this->genera_respuesta(
                false,
                $e->getMessage()
            );
        }
    }

}