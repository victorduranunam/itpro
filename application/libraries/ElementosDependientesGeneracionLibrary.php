<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Controlador\Libraries\Controlador;
if (!class_exists('Controlador')){
    require_once APPPATH . '/libraries/Controlador.php';
}

class ElementosDependientesGeneracionLibrary extends Controlador {
    public function __construct(){
        parent::__construct();
        $this->load->model('ElementosDependientesGeneracionModel');
    }

    public function obten_alumnos_generacion($id_generacion){
        try{
            $alumnos_generacion = $this->ElementosDependientesGeneracionModel->get_listado_alumnos_status_generacion($id_generacion);
            $this->genera_respuesta(
                true,
                'Alumnos por generación recuperados de forma adecuada',
                $alumnos_generacion
            );
        }catch(Exception $e){
            $this->genera_respuesta(
                false,
                $e->getMessage()
            );
        }finally{
            return $this->respuesta;
        }
    }

    public function obten_cursos_generacion($id_generacion){
        try{
            $cursos_generacion = $this->ElementosDependientesGeneracionModel->get_listado_cursos_generacion($id_generacion);
            $this->genera_respuesta(
                true,
                'Cursos por generación recuperados de forma adecuada',
                $cursos_generacion
            );
        }catch(Exception $e){
            $this->genera_respuesta(
                false,
                $e->getMessage()
            );
        }finally{
            return $this->respuesta;
        }
    }

    public function obten_catalogo_estados_solicitud(){
        try{
            $catalogo_estados_solicitud = $this->ElementosDependientesGeneracionModel->get_catalogo_estados_solicitud();
            $this->genera_respuesta(
                true,
                'Catálogo de estados de la solicitud recuperados de forma adecuada',
                $catalogo_estados_solicitud
            );
        }catch(Exception $e){
            $this->genera_respuesta(
                false,
                $e->getMessage()
            );
        }finally{
            return $this->respuesta;
        }
    }
    public function obten_datos_generacion_actual($id_generacion){
        try{
            $generacion = $this->ElementosDependientesGeneracionModel->get_generacion($id_generacion);
            $this->genera_respuesta(
                true,
                'Datos de la generación recuperados de forma adecuada',
                $generacion
            );
        }catch(Exception $e){
            $this->genera_respuesta(
                false,
                $e->getMessage()
            );
        }finally{
            return $this->respuesta;
        }
    }

    public function obten_elementos_dependientes_generacion($id_generacion){
        $elementos_dependientes_generacion ['catalogo_estados_solicitud'] = $this->obten_catalogo_estados_solicitud();
        $elementos_dependientes_generacion ['alumnos_generacion'] = $this->obten_alumnos_generacion($id_generacion);
        $elementos_dependientes_generacion ['cursos_generacion'] = $this->obten_cursos_generacion($id_generacion);
        $elementos_dependientes_generacion ['generacion'] = $this->obten_datos_generacion_actual($id_generacion);
        $this->genera_respuesta(
            true,
            'Elementos dependientes de la generación recuperados de forma satisfactoria',
            $elementos_dependientes_generacion
        );
    }

    public function actualiza_datos_solicitud_alumno($datos_solicitud){
        try{
            $respuesta_actualizacion = $this->ElementosDependientesGeneracionModel->actualiza_datos_solicitud($datos_solicitud['id_alumno'],$datos_solicitud['semestre_ingreso_prebecario'],$datos_solicitud['promedio_ingreso_prebecario'],$datos_solicitud['calificacion_examen'],$datos_solicitud['hizo_entrevista'],$datos_solicitud['id_estado_solicitud']);
            $this->genera_respuesta(
                true,
                $respuesta_actualizacion
            );
        }catch(Exception $e){
            $this->genera_respuesta(
                false,
                $e->getMessage()
            );
        }
    }

}