<?php 
    require_once (APPPATH.'libraries/GeneradorCombosForm.php');
    class GeneradorComboSelectForm extends GeneradorCombosForm {
        protected function abre_combo(){
            return '<select '. parent::abre_combo().'>';
        }
        protected function cierra_combo(){
            return '</select>';
        }
        protected function abre_elemento_contenido_combo($valor){
            return '<option '. parent::abre_elemento_contenido_combo($valor).'>';
        }
        protected function cierra_elemento_contenido_combo(){
            return '</option>';
        }
        
    }