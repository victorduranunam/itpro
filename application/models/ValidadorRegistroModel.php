<?php
defined('BASEPATH') OR exit('No direct script access allowed');
abstract class ValidadorRegistroModel extends CI_Model
{
    protected function ejecutaInsercion($tabla,$arreglo_datos,$arreglo_indices,$llaves_foraneas=false, $transitiva=false){
        try{    
            $this->iniciaCache();
            $arreglo_datos_insert = false;
            if ($arreglo_datos and $arreglo_indices){
                $arreglo_datos_insert = $this->getArrayDatosInsert($arreglo_datos,$arreglo_indices);
            }
            
            if ( !$arreglo_datos_insert && !$llaves_foraneas ){
                throw new Exception ('Datos de registro faltantes');
            }
            if ($llaves_foraneas){
                foreach ($llaves_foraneas as $indice => $llave){
                    $arreglo_datos_insert[$indice] = $llave;
                }
            }
            //var_dump ($arreglo_datos_insert);
            $this->db->insert($tabla, $arreglo_datos_insert);
            $this->verificaErrorBD();
            if ($transitiva){
                $id_registrado = false;
            }else{
                $id_registrado = $this->db->insert_id();
            }
            
            $this->cierraCache();
            return $id_registrado;
        }catch(Exception $e){
            throw $e;
        }
    }
    
    protected function getArrayDatosInsert($arreglo_datos,$arreglo_indices){
        $arreglo = array();
        foreach ($arreglo_indices as $key => $indice){
            if (isset( $arreglo_datos[$indice])){
                $arreglo[$indice] = $arreglo_datos[$indice];
            }else{
                $arreglo[$indice] = null;
            }
            
        }
        if (count($arreglo)==0){
            return false;
        }
        return $arreglo;
    }

    protected function iniciaCache(){
        $this->db->start_cache();
    }

    protected function cierraCache(){
        $this->db->stop_cache();
		$this->db->flush_cache();
    }
    protected function verificaErrorBD(){
        $objeto_error = $this->db->error();
		if  ($objeto_error['code'] !== ''){
			throw new Exception("Sistema temporalmente Fuera de servicio, intente mas tarde");
		}
	}
}