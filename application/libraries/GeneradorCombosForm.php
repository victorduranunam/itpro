<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    abstract class GeneradorCombosForm{

        public function genera_combo(){
            return $this->genera_label().
                $this->abre_combo().
                $this->genera_contenido_combo().
                $this->cierra_combo();
        }

        protected function genera_label(){
            return '<label for="'.$this->name.'">'.$this->label.'</label>';
        }

        protected function abre_combo(){
            return  'id="'.$this->id.'" class="'.$this->class.'" name="'.$this->name.'" '.$this->required;
        }


        protected function cierra_combo(){
            return '';
        }
        
        protected function genera_contenido_combo(){
            $cad = '';
            foreach ($this->array_contenido['contenido'] as $contenido_opcion){
                $cad .= $this->abre_elemento_contenido_combo($contenido_opcion->{$this->array_contenido['clave_valor']}). 
                    $contenido_opcion->{$this->array_contenido['clave_opcion']}. 
                $this->cierra_elemento_contenido_combo();
            }
            return $cad;
        }
        protected function abre_elemento_contenido_combo($valor){
            return 'value="'.$valor.'"';
        }

        protected function cierra_elemento_contenido_combo(){
            return '';
        }

        public function setParametros($array_contenido, $id, $name, $label,$class='',$required='required'){
            $this->array_contenido = $array_contenido;
            $this->id = $id;
            $this->name = $name;
            $this->label = $label;
            $this->class=$class;
            $this->required = $required;
        }

        public function setArrayContenido($array_contenido){
            $this->array_contenido=$array_contenido;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function setName($name){
            $this->name = $name;
        }
        public function setLabel($label){
            $this->label = $label ;
        }
        public function setClass($class){
            $this->class = $class ;
        }
    }