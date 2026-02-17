<?php

require_once (APPPATH . '/libraries/tcpdf/tcpdf.php');
date_default_timezone_set('America/Chicago');

class MYPDF extends TCPDF {
    //Page header
    public function Header() {
        // Logo
        $image_file = asset_url().'media/img/logo_unica_impresion_solicitud.png';
        $this->Image($image_file, 5, 5, 48, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', '', 10);
        // Title
        $this->Ln (3);
        ob_clean();
        $this->Cell(0, 15, 'FACULTAD DE INGENIERÍA', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        ob_clean();
        $this->Ln (5);
        ob_clean();
        $this->Cell(0, 15, 'DIVISIÓN DE INGENIERÍA ELÉCTRICA', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        ob_clean();
        $this->Ln (5);
        ob_clean();
        $this->Cell(0, 15, 'TRANSFORMACIÓN DIGITAL', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        ob_clean();
        $this->Ln (5);
        ob_clean();
        $this->Cell(0, 15, 'IT-PRO', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        ob_clean();
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        /*
        $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
            ob_clean();
        */
    }

    public function generaSolicitudImpresa($datos_personales, $preguntas_opcionales_solicitud,$preguntas_abiertas_solicitud){
        // set document information
        $this->SetCreator('UNICA');
        $this->SetAuthor('DID');
        $this->SetTitle('Solicitud prebecario');
        $this->SetSubject('Spñocotides');
        $this->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        ob_clean();

        // set header and footer fonts
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $this->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        //$this->SetFont('times', 'BI', 12);

        // add a page
        $this->AddPage();




        // FOTO: validar existencia y usar genérica si no existe


        $foto_default_path = FCPATH.'assets/fotos/face_icon.png';
        $foto_path = FCPATH.'assets/fotos/'.$datos_personales->foto;

        if (!empty($datos_personales->foto) && file_exists($foto_path)) {
            $this->Image($foto_path, 172, 30, 22, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
        } else {
            $this->Image($foto_default_path, 172, 30, 22, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }



        //TITULO
            $this->SetFont("helvetica", 'B', 14);
            $txt="PROGRAMA DE FORMACIÓN DE BECARIOS IT-PRO";
            // print a block of text using Write()
            $this->Ln(5);
            ob_clean();
            $this->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
            ob_clean();
            
            $this->Ln(1);
            ob_clean();
            $txt="GENERACIÓN ".$_GET['generacion'];
            ob_clean();
            // print a block of text using Write()

            $this->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
            ob_clean();
            
            $this->SetFont("dejavusans", 'B', 24);
            $this->Ln(1);
            ob_clean();
            $txt="SOLICITUD";
            ob_clean();
            // print a block of text using Write()

            $this->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
            ob_clean();

        //DATOS PERSONALES

            $this->SetFont("helvetica", 'BI', 13);
            $this->Ln(2);
            ob_clean();
            $txt="DATOS PERSONALES: ";
            $this->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
            ob_clean();
            
        //CONTENIDO DE DATOS PERSONALES

            $this->SetFont("helvetica", '', 12);
            $this->Ln(2);
            ob_clean();
            
            $tbl = '
            <table border="1" cellpadding="2" cellspacing="2">
                <tr>
                    <td>
                        <BR><BR>  <B>NOMBRE:  </B><u> '. $datos_personales->apellido_paterno .' '.  $datos_personales->apellido_materno . ' '.  $datos_personales->nombre .'</u>
                        <BR><BR>  <B>CARRERA: </B><u> '.$datos_personales->carrera.' </u>  <B>No. CUENTA: </B><u>  '.$datos_personales->numero_cuenta.'  </u>
                        <BR><BR>  <B>SEMESTRE ACTUAL: </B><u>     '.$datos_personales->semestre_registro.'    </u>  <B>PROMEDIO: </B><u>     '.$datos_personales->promedio_registro.'    </u>  <B>RFC: </B><u> '.$datos_personales->rfc.' </u>
                        
                       
                        <BR><BR>   <B>TEL.</B> <u>  '.$datos_personales->telefono.'  </u> <B>CEL: </B> <u>  '.$datos_personales->celular.'  </u>
                        <BR><BR>  <B>CORREO ELECTRÓNICO:  </B><u>  '.$datos_personales->email.'  </u>
                        <BR>
                    </td>
                </tr>
                <tr>
                    <td>
                        
                        '.$this->genera_cadena_preguntas_opcional($preguntas_opcionales_solicitud).
                        $this->genera_cadena_preguntas_abiertas($preguntas_abiertas_solicitud).
                        '                           
                        
                        <BR>
                    </td>
                </tr>
            </table>

            <BR><BR><B>FECHA </b>
            <U>
             '.$datos_personales->fecha_registro.'
            </U></BR><BR>

            <BR><BR><B>OBSERVACIONES: </b>
            <P>
             '.$datos_personales->nota.'
            </P>
        ';
            $this->writeHTML($tbl, true, false, false, false, '');
        }

        private function genera_cadena_preguntas_opcional($preguntas_opcionales_solicitud){
            $cad='';
            foreach ($preguntas_opcionales_solicitud as $pregunta_opcional) {
                $cad = $cad .'<BR><BR>  <B>'.$pregunta_opcional->pregunta.'</B>
                <BR>  <u>'.  $pregunta_opcional->opcion.$pregunta_opcional->otro .'</u>';
            }
            return $cad;
        }

        private function genera_cadena_preguntas_abiertas($preguntas_abiertas_solicitud){
            $cad='';
            foreach ($preguntas_abiertas_solicitud as $pregunta_abierta) {
                $cad = $cad . '<BR><BR> <B>'.$pregunta_abierta->pregunta.'</B>
                <P style="text-align:justify;"><u> '.$pregunta_abierta->respuesta.' </u>	</p>
                ';
            }
            return $cad;

        }
    }
