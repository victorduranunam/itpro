<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model extends CI_Model{
    public function get_alumno_personal($id_alumno){
        $this->db->start_cache();
        $alumno = $this->db
            ->select ("al.id_alumno, al.apellido_paterno, al.apellido_materno, al.nombre,al.numero_cuenta, sol.fecha_registro, sol.semestre_registro, carr.nombre, sol.promedio_registro,al.rfc,dir.calle_numero, dir.colonia,dir.estado, dir.delegacion_municipio, dir.codigo_postal,con.telefono,con.celular,con.email")
            ->from ('alumno as al')
            ->join ('solicitud as sol', 'al.id_alumno = sol.id_alumno')
            ->join ('cat_carrera as carr','al.id_carrera = carr.id_carrera')
            ->join ('direccion as dir', 'al.direccion_id = dir.direccion_id','left')
            ->join ('contacto as con', 'al.contacto_id = con.contacto_id')
            ->where ('al.id_alumno', $id_alumno)
            ->order_by('fecha_registro')
            ->get(); 
        if ($alumno->num_rows() ==1){
            $alumno = $alumno->result();
            $this->db->stop_cache();
            $this->db->flush_cache();
            return $alumno;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('No se encontraron los datos del alumno.');
    }

    private function get_respuestas_abiertas_alumno($id_alumno){
        $this->db->start_cache();
        $abiertas_alumno = $this->db
            ->select ("sol.id_solicitud, pa.pregunta, rpa.respuesta")
            ->from ('respuesta_preg_ab as rpa')
            ->join ('cat_pregunta_abierta as pa', 'rpa.id_pregunta_abierta = pa.id_pregunta_abierta')
            ->join ('solicitud sol', 'sol.id_solicitud = rpa.id_solicitud')
            ->where ('id_alumno', $id_alumno)
            ->get(); 
        if ($abiertas_alumno->num_rows() >=1){
            $abiertas_alumno = $abiertas_alumno->result();
            $this->db->stop_cache();
            $this->db->flush_cache();
            return $abiertas_alumno;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        return false;
    }

    private function get_respuestas_cerradas_alumno($id_alumno){
        $this->db->start_cache();
        $cerradas_alumno = $this->db
            ->select ("sol.id_solicitud, cpo.pregunta, crpo.opcion as respuesta, otro")
            ->from ('respuesta_preg_opc as rpo')
            ->join ('cat_respuesta_opcional as crpo', 'rpo.id_respuesta_opcional = crpo.id_respuesta_opcional')
            ->join ('cat_pregunta_opcional cpo', 'crpo.id_pregunta_opcional = cpo.id_pregunta_opcional')
            ->join ('solicitud sol', 'sol.id_solicitud = rpa.id_solicitud')
            ->where ('id_alumno', $id_alumno)
            ->get(); 
        if ($cerradas_alumno->num_rows() >=1){
            $cerradas_alumno = $cerradas_alumno->result();
            $this->db->stop_cache();
            $this->db->flush_cache();

            return $cerradas_alumno;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        return false;
    }


}