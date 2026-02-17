<?php 
    require_once (APPPATH.'libraries/GeneradorCombosForm.php');
    class GeneradorComboRadioForm extends GeneradorCombosForm {
        protected function genera_label(){
            return '';
        }
        protected function abre_combo(){
            return '<div class="contenido_radio">';
        }
        protected function abre_elemento_contenido_combo($valor){
            return '<div>'.
                '<input id="radio_'.$valor.'" name="'.$this->name.'" type="radio" '. parent::abre_elemento_contenido_combo($valor).'>'.
                    '<label for="radio_'.$valor.'"> ';
        }

        protected function cierra_elemento_contenido_combo(){
            return '</label>'.
                '</div>';
        }
        
        protected function cierra_combo(){
            return '</div>';
        }
    }