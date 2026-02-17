<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/models/HistorialAcademicoModel.php';

class ElementosDependientesGeneracionModel extends CI_Model {
    public function get_listado_alumnos_status_generacion($id_generacion){
        $this->db->start_cache();
        $alumnos_generacion = $this->db
            ->select ("s.id_alumno, a.apellido_paterno,a.apellido_materno,a.nombre,s.semestre_registro,s.promedio_registro,s.semestre_ingreso_prebecario,s.promedio_ingreso_prebecario,s.calificacion_examen,s.hizo_entrevista, es.estado, es.descripcion,s.id_estado_solicitud")
            ->from ('alumno as a')
            ->join ('solicitud as s', 'a.id_alumno = s.id_alumno')
            ->join ('cat_estado_solicitud as es','s.id_estado_solicitud = es.id_estado_solicitud')
            ->where ('s.id_generacion', $id_generacion)
            ->order_by('apellido_paterno ASC, apellido_materno asc, nombre asc')
            ->get(); 
        if ($alumnos_generacion->num_rows() >=1){
            $alumnos_generacion = $alumnos_generacion->result();
            $this->db->stop_cache();
            $this->db->flush_cache();
            $historialAcademicoModel = new HistorialAcademicoModel();
            foreach ($alumnos_generacion as &$alumno) {
                $historial = $historialAcademicoModel->getAll(
                  $alumno->id_alumno  
                );
                if ($historial){
                    $alumno->historial_file = $historial[0]->archivo;
                }else{
                    $alumno->historial_file = false;
                }
            }
            return $alumnos_generacion;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('No se encuentran alumnos registrados en esta generación.');
    }

    public function get_listado_cursos_generacion($id_generacion){
        $this->db->start_cache();
        $cursos_generacion = $this->db
            ->select ("cur.id_curso,cc.nombre AS nombre_curso,cur.fecha_inicio, cur.fecha_fin,cg.generacion")
            ->from ('curso cur')
            ->join ('cat_curso as cc', 'cur.id_cat_curso = cc.id_cat_curso')
            ->join ('cat_generacion as cg','cur.id_generacion = cg.id_generacion')
            ->where ('cg.id_generacion', $id_generacion)
            ->get(); 
        if ($cursos_generacion->num_rows() >=1){
            $cursos_generacion = $cursos_generacion->result();
            $this->db->stop_cache();
            $this->db->flush_cache();
            return $cursos_generacion;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('No se encuentran registrados cursos a impartir para esta generación.');
    }

    public function get_catalogo_estados_solicitud(){
        $this->db->start_cache();
        $cat_estados_solicitud = $this->db
            ->get('cat_estado_solicitud'); 
        if ($cat_estados_solicitud->num_rows() >=1){
            $cat_estados_solicitud = $cat_estados_solicitud->result();
            $this->db->stop_cache();
            $this->db->flush_cache();
            return $cat_estados_solicitud;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('No se encuentran registrados cursos a impartir para esta generación.');
    }

    public function get_generacion($id_generacion){
        $this->db->start_cache();
        $cat_estados_solicitud = $this->db
            ->where ('id_generacion', $id_generacion)
            ->get('cat_generacion'); 
        if ($cat_estados_solicitud->num_rows() ==1){
            $cat_estados_solicitud = $cat_estados_solicitud->result();
            $this->db->stop_cache();
            $this->db->flush_cache();
            return $cat_estados_solicitud[0];
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('No se encuentran registrados cursos a impartir para esta generación.');
    }

    public function actualiza_datos_solicitud($id_alumno,$semestre_ingreso_prebecario,$promedio_ingreso_prebecario,$calificacion_examen,$hizo_entrevista,$id_estado_solicitud){
        $this->db->start_cache();
        $respuesta = $this->db 
            ->set('semestre_ingreso_prebecario', $semestre_ingreso_prebecario)
            ->set('promedio_ingreso_prebecario', $promedio_ingreso_prebecario)
            ->set('calificacion_examen', $calificacion_examen)
            ->set('hizo_entrevista', $hizo_entrevista)
            ->set('id_estado_solicitud', $id_estado_solicitud)
            ->where('id_alumno', $id_alumno)
            ->update('solicitud');
        $mensaje_satisfactorio ='Datos de la solicitud actualizados correctamente.';
        if ($this->db->affected_rows() == '1') {
            $this->db->stop_cache();
            $this->db->flush_cache();
           
            return $mensaje_satisfactorio;
        } 
        $this->db->stop_cache();
        $this->db->flush_cache();
        throw new Exception ('Error al actualizar los datos de la solicitud.');
        
    }
}