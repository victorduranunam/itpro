<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SolicitudModel extends CI_Model{
    public function get_solicitudes_alumno_cuenta($numero_cuenta=null){
        try{
            $this->db->start_cache();
            if(!is_null($numero_cuenta)){
                $this->db->where ('al.numero_cuenta', $numero_cuenta);
            }
            $solicitudes = $this->db
                ->select ("al.numero_cuenta,al.nombre, al.apellido_paterno,al.apellido_materno,al.rfc,es.estado,fecha_registro,semestre_registro,promedio_registro,semestre_ingreso_prebecario,promedio_ingreso_prebecario,hizo_entrevista,calificacion_examen,nota, carr.nombre as carrera")
                ->from ('alumno as al')
                ->join ('solicitud as sol', 'al.id_alumno = sol.id_alumno')
                ->join ('cat_carrera as carr','al.id_carrera = carr.id_carrera')
                ->join ('cat_estado_solicitud as es','sol.id_estado_solicitud = es.id_estado_solicitud')
                ->join ('cat_generacion as gen','sol.id_generacion = gen.id_generacion')
                
                ->group_by('sol.id_solicitud, es.estado,carr.nombre,al.id_alumno')
                ->having('fecha_registro=max(fecha_registro)')
                ->get(); 
            if ($solicitudes->num_rows() >=1){
                $solicitudes = $solicitudes->result();
                $this->db->stop_cache();
                $this->db->flush_cache();
                return $solicitudes;
            }
            $this->db->stop_cache();
            $this->db->flush_cache();

            throw new Exception ('No se encontraron las solicitudes del alumno.');
        }catch(Exception $e){
            throw $e;
        }
    }
}