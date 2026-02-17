<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DatosPersonalesAlumnoModel extends CI_Model{
    //DATOS PERSONALES 
    public function get_datos_personales_alumno($id_alumno,$id_generacion){
        $this->db->start_cache();
        $datos_alumno = $this->db
            ->select ("a.id_alumno,numero_cuenta,a.nombre,apellido_paterno,apellido_materno,rfc,foto,c.nombre as carrera,celular,telefono,email,calle_numero,colonia,delegacion_municipio,codigo_postal,estado,nota,fecha_registro,id_solicitud,semestre_registro,promedio_registro")
            ->from ('alumno as a')
            ->join ('cat_carrera as c', 'a.id_carrera = c.id_carrera')
            ->join ('contacto as con', 'a.contacto_id = con.contacto_id')
            ->join ('direccion as dir', 'a.direccion_id = dir.direccion_id','left')
            ->join ('solicitud as sol', 'a.id_alumno = sol.id_alumno')
            ->where ('a.id_alumno', $id_alumno)
            ->where ('sol.id_generacion', $id_generacion)
            ->get(); 
        if ($datos_alumno->num_rows() ==1){
            $datos_alumno = $datos_alumno->result();
            $this->db->stop_cache();
            $this->db->flush_cache();
            return $datos_alumno[0];
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('No se encontraron datos del alumno.');
    }
    
    //OBTENIENDO PREGUNTAS ABIERTAS
    public function get_preguntas_abiertas_solicitud($id_solicitud){
        $this->db->start_cache();
        $preguntas_abiertas_solicitud = $this->db
            ->select ("pregunta,respuesta")
            ->from ('respuesta_preg_ab as rpa')
            ->join ('cat_pregunta_abierta as cpa', 'rpa.id_pregunta_abierta = cpa.id_pregunta_abierta')
            ->where ('id_solicitud', $id_solicitud)
            ->get(); 
        if ($preguntas_abiertas_solicitud->num_rows() >=1){
            $preguntas_abiertas_solicitud = $preguntas_abiertas_solicitud->result();
            $this->db->stop_cache();
            $this->db->flush_cache();
            return $preguntas_abiertas_solicitud;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('No se encontraron preguntas abiertas para la solicitud.');
    }

    //OBTENIENDO PREGUNTAS Cerradas de opción múltiple
    public function get_preguntas_cerradas_solicitud($id_solicitud){
        $this->db->start_cache();
        $preguntas_abiertas_solicitud = $this->db
            ->select ("pregunta,opcion,otro")
            ->from ('respuesta_preg_opc as rpo')
            ->join ('cat_respuesta_opcional as cro', 'rpo.id_respuesta_opcional = cro.id_respuesta_opcional')
            ->join ('cat_pregunta_opcional as cpo', 'cpo.id_pregunta_opcional = cro.id_pregunta_opcional')
            ->where ('id_solicitud', $id_solicitud)
            ->get(); 
        if ($preguntas_abiertas_solicitud->num_rows() >=1){
            $preguntas_abiertas_solicitud = $preguntas_abiertas_solicitud->result();
            $this->db->stop_cache();
            $this->db->flush_cache();
            return $preguntas_abiertas_solicitud;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('No se encontraron preguntas opcionales para la solicitud.');
    }

    //Actualizando nota en la solicitud

    public function actualiza_nota_solicitud($id_solicitud,$nota){
        $this->db->start_cache();
        $respuesta = $this->db 
            ->set('nota', $nota)
            ->where('id_solicitud', $id_solicitud)
            ->update('solicitud');
        
        if ($this->db->affected_rows() == '1') {
            $this->db->stop_cache();
            $this->db->flush_cache();
           
            return 'Datos de la solicitud actualizados correctamente.';
        } 
        $this->db->stop_cache();
        $this->db->flush_cache();
        throw new Exception ('Error al actualizar los datos de la solicitud.');
        
    }
    
}