<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once APPPATH . '/libraries/GeneracionLibrary.php';
    require_once APPPATH . '/libraries/Layout.php';
    require_once APPPATH . '/libraries/ElementosDependientesGeneracionLibrary.php';

    class SolicitudesGeneracionesWeb extends CI_Controller {
        public function __construct(){
            parent::__construct();    
            $this->load->helper("session"); 
            if (!es_sesion_administrador()){
                redirect('logout');
            }       
            $this->generaciones=new GeneracionLibrary();
            $this->generaciones->obten_generaciones_descendente();
            $this->layout = new Layout();
            $this->layout->setLayout('sistema_gestion_becarios');
            $this->data['tipo_usuario']=$this->session->tipo_usuario;
            $this->data['nombre_usuario']=$this->session->nombre .' '.$this->session->apellido_paterno;
            $this->data['usuario']=$this->session->usuario;
            $this->data['generaciones']=$this->generaciones->respuesta->data;
            $this->data['scripts_validacion']=true;
        }
        public function seleccion_generacion(){            
            $this->data['js_personalizado']='selector_solicitudes_generaciones';
            $this->layout->view('selector_solicitudes_generaciones',$this->data);
        }

        public function obten_solicitudes_generacion($id_generacion){
            unset( $_POST );
            $this->elementos_dependientes_generacion=new ElementosDependientesGeneracionLibrary();
            $this->elementos_dependientes_generacion->obten_elementos_dependientes_generacion($id_generacion);
            $this->data['generaciones']=$this->generaciones->respuesta->data;
            $this->data['catalogo_estados_solicitud']=$this
                ->elementos_dependientes_generacion
                ->respuesta
                ->data['catalogo_estados_solicitud'];
            $this->data['alumnos_generacion']=$this
                ->elementos_dependientes_generacion
                ->respuesta
                ->data['alumnos_generacion'];
            $this->data['cursos_generacion']=$this
                ->elementos_dependientes_generacion
                ->respuesta
                ->data['cursos_generacion'];
            $this->data['generacion']=$this
                ->elementos_dependientes_generacion
                ->respuesta
                ->data['generacion'];
            
            $this->data['js_personalizado']='estado_solicitudes_prebecarios';
            if (isset($this->session->mensaje)){
                $this->data['mensaje'] = $this->session->mensaje;
                $this->data['tipo_mensaje'] = $this->session->tipo_mensaje;
                unset($_SESSION['mensaje']);
                unset($_SESSION['tipo_mensaje']);
            }
            $this->session->ruta_actual='generacion/'.$id_generacion.'/alumnos_cursos';
            $this->layout->view('estado_solicitudes_prebecarios',$this->data);
        }

        public function actualiza_solicitud_generacion(){
            if (!isset($_POST)){
                $ruta_actual=$this->session->ruta_actual;
                if (isset($ruta_actual)){
                    redirect($this->session->ruta_actual);
                }
                redirect ('seleccion_generacion');
            }
            if (!isset ($_POST['hizo_entrevista'])){
                $_POST['hizo_entrevista']=false;
            }
            clean_post();
            $this->elementos_dependientes_generacion=new ElementosDependientesGeneracionLibrary();
            $this->elementos_dependientes_generacion->actualiza_datos_solicitud_alumno($_POST);
            $actualizacion = $this->elementos_dependientes_generacion->respuesta;
            if ($actualizacion->status){
                $this->session->tipo_mensaje='satisfactorio';
            }else{
                $this->session->tipo_mensaje='error';
            }
            $this->session->mensaje= $actualizacion->mensaje;              
            
            redirect($this->session->ruta_actual);
        }


        /*************************************************************/        
        /*********Para la solicitud de un alumno particular***********/        
        /*************************************************************/ 
        
        private function recuperar_solicitud_alumno_generacion($id_generacion,$id_alumno){
            require_once APPPATH . '/libraries/BecarioDatosPersonalesLibrary.php';
            $this->becarioDatosPersonales=new  BecarioDatosPersonalesLibrary();
            $this->becarioDatosPersonales->obten_elementos_seccion_datos_personales($id_alumno,$id_generacion);
            $this->data['generaciones']=$this->generaciones->respuesta->data;
            if ( $this->becarioDatosPersonales->respuesta->status){
                if($this->becarioDatosPersonales->respuesta->data['datos_personales_becario']->status){
                    $this->data['datos_personales']= $this->becarioDatosPersonales->respuesta->data['datos_personales_becario']->data;
                }else{
                    $this->data['mensaje']= $this->becarioDatosPersonales->respuesta->data['datos_personales_becario']->mensaje;
                     $this->data['tipo_mensaje'] = "error";
                }
                if ($this->becarioDatosPersonales->respuesta->data['preguntas_abiertas_solicitud']->status){
                    $this->data['preguntas_abiertas_solicitud']= $this->becarioDatosPersonales->respuesta->data['preguntas_abiertas_solicitud']->data;
                }else{
                    $this->data['preguntas_abiertas_solicitud']=FALSE;
                }
                if ($this->becarioDatosPersonales->respuesta->data['preguntas_opcionales_solicitud']->status){
                    $this->data['preguntas_opcionales_solicitud']= $this->becarioDatosPersonales->respuesta->data['preguntas_opcionales_solicitud']->data;
                }else{
                    $this->data['preguntas_opcionales_solicitud']=FALSE;
                }
                require_once APPPATH . '/models/HistorialAcademicoModel.php';
                $historialAcademicoModel = new HistorialAcademicoModel();
                $this->data['historiales_academicos'] = $historialAcademicoModel->getAll($id_alumno);
                //$this->data['preguntas_opcionales_solicitud']= $this->becarioDatosPersonales->respuesta->data['preguntas_opcionales_solicitud'];
                $this->data['generacion']= $this->becarioDatosPersonales->respuesta->data['generacion'];
            }else{
                $this->data['mensaje']= $this->becarioDatosPersonales->respuesta->mensaje;
                $this->data['tipo_mensaje'] = "error";
            }

        }

        public function obten_solicitud_alumno_generacion($id_generacion,$id_alumno){
            $this->recuperar_solicitud_alumno_generacion($id_generacion,$id_alumno);
            if (isset($this->session->mensaje_actualizacion)){
                $this->data['mensaje_actualizacion']=$this->session->mensaje_actualizacion;
                $this->data['tipo_mensaje_actualizacion']=$this->session->tipo_mensaje;
                unset ($_SESSION['mensaje_actualizacion']);
                unset($_SESSION['tipo_mensaje']);
            }
            if (isset($this->session->mensaje_hist)){
                $this->data['mensaje_hist']=$this->session->mensaje_hist;
                $this->data['tipo_mensaje_hist']=$this->session->tipo_mensaje_hist;
                unset ($_SESSION['mensaje_hist']);
                unset($_SESSION['tipo_mensaje_hist']);
            }

            $this->data['id_generacion']=$id_generacion;
            $this->data['id_alumno']=$id_alumno;
            
            $this->data['js_personalizado']='solicitud_alumno_generacion';
            $this->session->ruta_actual='generaciones/'.$id_generacion.'/solicitudes_becarios/'.$id_alumno;
            $this->layout->view('solicitud_alumno_generacion',$this->data);
        }

        public function actualiza_nota_solicitud(){
            if (!isset($_POST)){
                $ruta_actual=$this->session->ruta_actual;
                if (isset($ruta_actual)){
                    redirect($this->session->ruta_actual);
                }
                redirect ('seleccion_generacion');
            }
            
            require_once APPPATH . '/libraries/BecarioDatosPersonalesLibrary.php';
            $this->becarioDatosPersonales=new  BecarioDatosPersonalesLibrary();
            
            
            $this->becarioDatosPersonales->actualiza_nota_solicitud_alumno($_POST['id_solicitud'],$_POST['nota']);
            $actualizacion = $this->becarioDatosPersonales->respuesta;
            if ($actualizacion->status){       
                $this->session->tipo_mensaje='satisfactorio';
            }else{
                $this->session->tipo_mensaje='error';
            }
            $this->session->mensaje_actualizacion= $actualizacion->mensaje;              
            unset( $_POST );
            redirect($this->session->ruta_actual);
        }

        public function imprime_solicitud_alumno_generacion($id_generacion,$id_alumno){
            $this->recuperar_solicitud_alumno_generacion($id_generacion,$id_alumno);
            if (isset($this->session->mensaje_actualizacion)){
                $this->data['mensaje_actualizacion']=$this->session->mensaje_actualizacion;
                $this->data['tipo_mensaje_actualizacion']=$this->session->tipo_mensaje;
                unset ($_SESSION['mensaje_actualizacion']);
                unset($_SESSION['tipo_mensaje']);
                redirect($this->session->ruta_actual);
            }

            require_once APPPATH . '/libraries/tcpdf/solicitud_alumno_generacion_pdf.php';
            //$this->session->ruta_actual='generaciones/'.$id_generacion.'/solicitudes_becarios/'.$id_alumno.'/impresion';
            //$this->load->view('solicitud_alumno_generacion_pdf',$this->data);
            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->generaSolicitudImpresa(
                $this->data['datos_personales'],
                $this->data['preguntas_opcionales_solicitud'],
                $this->data['preguntas_abiertas_solicitud']
            );
            ob_clean();
            $pdf->Output('Solicitud.pdf', 'I');
        }
    }