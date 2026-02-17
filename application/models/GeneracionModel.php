<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GeneracionModel extends CI_Model{
    public function get_generaciones_descendente(){
        $this->db->start_cache();
        $cat_generaciones = $this->db
            ->order_by("id_generacion", "desc")
            ->get("cat_generacion"); 
        if ($cat_generaciones->num_rows() >=1){
            $cat_generaciones = $cat_generaciones->result();
            $this->db->stop_cache();
            $this->db->flush_cache();
            return $cat_generaciones;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('Catálogo de generaciones no disponible');
    }

    public function get_geneacion($id){
        $this->db->start_cache();
        $generacion = $this->db
            ->where("id_generacion", $id)
            ->get("cat_generacion"); 
        if ($generacion->num_rows() >=1){
            $generacion = $generacion->result()[0];
            $this->db->stop_cache();
            $this->db->flush_cache();
            return $generacion;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('Datos de la generación no disponibles');
    }
}