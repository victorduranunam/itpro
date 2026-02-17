<?php

namespace Controlador\Libraries;
use CI_Controller;
use Exception;

defined('BASEPATH') OR exit('No direct script access allowed');

abstract class Controlador extends CI_Controller {
    protected function genera_respuesta($status,$mensaje,$datos=false){
        $arreglo_respuesta = array(
            'status' => $status,
            'mensaje' => $mensaje
        );
        if ($datos){
            $arreglo_respuesta ['data'] = $datos;
        }
		$this->respuesta = (object)$arreglo_respuesta;
    }

    protected function guarda_imagen_en_servidor($nombre){
        $config['upload_path']          = './assets/fotos/';
        $config['allowed_types']        = 'jpg|jpeg|png|gif|bmp|webp';
        $config['max_size']             = 2000;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $config['file_name']			= 'foto_'.$nombre;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('foto')){
            throw new Exception ($this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
            return $this->upload->data('file_name');
        }
    }

    protected function guarda_archivo_en_servidor($directorio,$nombre,$type,$indexRequest,$baseAssets='./assets/'){
        $config['upload_path']          = $baseAssets.$directorio.'/';
        $config['allowed_types']        = $type;
        $config['max_size']             = 2000;
        $config['file_name']			= $nombre;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload($indexRequest)){
            throw new Exception ($this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
            return $this->upload->data('file_name');
        }
    }
}