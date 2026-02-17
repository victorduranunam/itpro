<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Controlador\Libraries\Controlador;
require_once APPPATH . '/libraries/Controlador.php';

class BecarioDatosPersonalesLibrary extends Controlador {
    public function __construct(){
        parent::__construct();
        $this->load->model('DatosPersonalesAlumnoModel');
    }

/*INICIO PÁGINA DATOS PERSONALES ALUMNO*/
    private function obten_datos_personales_alumno($id_alumno,$id_generacion){
        try{
            $datos_personales_alumno = $this->DatosPersonalesAlumnoModel
                ->get_datos_personales_alumno($id_alumno,$id_generacion);
            $this->genera_respuesta(
                true,
                'Datos del alumno recurperado con éxito',
                $datos_personales_alumno
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
    private function obten_preguntas_abiertas_solicitud($id_solicitud){
        try{
            $preguntas_abiertas_solicitud = $this->DatosPersonalesAlumnoModel
                ->get_preguntas_abiertas_solicitud($id_solicitud);
            $this->genera_respuesta(
                true,
                'Preguntas abiertas de la solicitud recurperadas con éxito',
                $preguntas_abiertas_solicitud
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

    private function obten_preguntas_opcionales_solicitud($id_solicitud){
        try{
            $preguntas_abiertas_solicitud = $this->DatosPersonalesAlumnoModel
                ->get_preguntas_cerradas_solicitud($id_solicitud);
            $this->genera_respuesta(
                true,
                'Preguntas opcionales de la solicitud recurperadas con éxito',
                $preguntas_abiertas_solicitud
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

    private function obten_generacion($id_generacion){
        require_once APPPATH . '/libraries/ElementosDependientesGeneracionLibrary.php';
        $this->elementos_dependientes_generacion=new ElementosDependientesGeneracionLibrary();
        return $this->elementos_dependientes_generacion->obten_datos_generacion_actual($id_generacion);
    }
    public function obten_elementos_seccion_datos_personales($id_alumno,$id_generacion){
        $elementos_seccion_datos_personales ['datos_personales_becario'] = $this
            ->obten_datos_personales_alumno($id_alumno,$id_generacion);
        $id_solicitud = $elementos_seccion_datos_personales ['datos_personales_becario']->data->id_solicitud;
        
        $elementos_seccion_datos_personales ['preguntas_abiertas_solicitud'] = $this->obten_preguntas_abiertas_solicitud($id_solicitud);
        $elementos_seccion_datos_personales ['preguntas_opcionales_solicitud'] = $this->obten_preguntas_opcionales_solicitud($id_solicitud);
        $elementos_seccion_datos_personales ['generacion']=$this->obten_generacion($id_generacion);
        $this->genera_respuesta(
            true,
            'Datos recuperados',
            $elementos_seccion_datos_personales
        );
    }
    public function actualiza_nota_solicitud_alumno($id_solicitud,$nota){
        try{
            $respuesta_actualizacion = $this
                ->DatosPersonalesAlumnoModel
                ->actualiza_nota_solicitud($id_solicitud,$nota);
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
/*FIN PÁGINA DATOS PERSONALES ALUMNO*/

}