<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DatosSolicitudModel extends CI_Model{
    public function obtenerGeneracionActual(){
        $max_generacion_query = $this->db
            ->select_max('id_generacion')
            ->get_compiled_select('cat_generacion');
        $generacion_result = $this->db
            ->where('id_generacion=('.$max_generacion_query.')')
            ->get('cat_generacion');
        if ($generacion_result->num_rows() ==1){
            $resultado = $generacion_result->result();
            return $resultado[0];
        }
        throw new Exception ('No se encontraron datos de la generación.');
    }
    public function obtenerPreguntasAbiertas($id_generacion){
        $preguntas_abiertas_result = $this->db
            ->from('cat_pregunta_abierta as c_pa')
            ->join(
                'generacion_preg_ab as gpa', 
                'c_pa.id_pregunta_abierta = gpa.id_pregunta_abierta'
            )
            ->where('id_generacion', $id_generacion)
            ->get();
        if ($preguntas_abiertas_result->num_rows() > 0){
            return $preguntas_abiertas_result->result();
        }
        return false;
    }

    public function obtenerPreguntasOpcionales($id_generacion){
        $preguntas_opcionales_result = $this->db
            ->from('cat_pregunta_opcional as c_po')
            ->join(
                'generacion_preg_opc as gpo', 
                'c_po.id_pregunta_opcional = gpo.id_pregunta_opcional'
            )
            ->where('id_generacion', $id_generacion)
            ->get();
        if ($preguntas_opcionales_result->num_rows() > 0){
            $preguntas_opcionales_result = $preguntas_opcionales_result->result();
            $arreglo_preguntas_opcionales=array();
            foreach ($preguntas_opcionales_result as $pregunta_opcional){
                $opciones_pregunta = $this->obtenerRespuestasOpcionales(
                    $pregunta_opcional->id_pregunta_opcional
                );
                if ($opciones_pregunta){
                    array_push(
                        $arreglo_preguntas_opcionales, 
                        (object)array (
                            'pregunta_opcional' => $pregunta_opcional,
                            'opciones' => $opciones_pregunta
                        )
                    );
                }
            }
            if (count($arreglo_preguntas_opcionales)>0){
                return $arreglo_preguntas_opcionales;
            }
        }
        return false;
    }

    private function obtenerRespuestasOpcionales($id_pregunta_opcional){
        $opciones_pregunta_result = $this->db
            ->where('id_pregunta_opcional', $id_pregunta_opcional)
            ->get('cat_respuesta_opcional');
        if ($opciones_pregunta_result->num_rows() > 0){
            return $opciones_pregunta_result->result();
        }
        return false;
    }

    public function obtenerCarreras(){
        $this->db->order_by("nombre", "asc");
        $cat_carreras_result=$this->db->get('cat_carrera');
        if ($cat_carreras_result->num_rows() > 0){
            return $cat_carreras_result->result();
        }
        throw new Exception ('Error al recuperar catálogo de carreras');
    }
}
