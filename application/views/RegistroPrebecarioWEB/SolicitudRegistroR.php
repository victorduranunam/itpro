
<div id="baseurl" class='oculto' data-baseurl=<?= base_url() ?> ></div>
<div class="FondoImagen container">
    <div class="row">
        <div class="col-sm-12">
            <h2 style="font-size: 3vh; padding-top: 25px;">Solicitud de registro al</h2>
            <h2 style="font-size: 3vh; padding-top: 15px; color: darkblue; text-shadow: whitesmoke 0.1em 0.1em 0.2em;">Programa de Formación en Innovación y <br> Tecnologías de la Información <br>IT-PRO</h2>
           
            <h2 style="font-style: italic; font-size: 4vh;"><?= $generacion->generacion ?><sup>a.</sup> Generación</h2>
          
          
        
        </div>
        
        <?php    if (!is_null($mensaje_error)){                             
            echo '<div class="alert alert-danger" id="error-registro" role="alert">';
            echo  $mensaje_error ;
            echo '</div>';
        }  ?>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2  col-lg-4 offset-lg-4">

            <div class="formulario">
                <form  method="post" id="registroPrebes" enctype ="multipart/form-data" action="<?= base_url() ?>registrar_solicitud" onsubmit="return validacionesEnvioForm()">
                    <input type="hidden" name="id_generacion" value='<?= $generacion->id_generacion; ?>'>
                    <input type="hidden" name="generacion" value='<?= $generacion->generacion; ?>'>
                    <p>
                        Los campos señalados con <span>*</span> son obligatorios.
                    </p><br>
                    <div id="divFoto">
                        <p id="list"></p>
                        <label for="foto">
                            <span>*</span>Sube una fotografía para tu solicitud<br>
                            <small>
                                (Actual, de frente, serio, rostro descubierto,<br>
                                sin lentes oscuros, ropa formal, no mayor a 2M <b><u> en formato JPG o PNG</u></b>)<br>
                            </small>
                        </label>
                        <br>
                        <input type="file" class="foto fondo-blanco sin-borde" accept="image/*" autofocus="1" id="foto" name="foto[]">						
                    </div>

                    <br>
                    <p>
                        <label for="nombre"><span>*</span>Nombre </label>
                        <input class="texto"  type="text" name="nombre"  >
                    </p>
                    <p>
                        <label for="apellido_paterno"><span>*</span>Apellido paterno </label>
                        <input class="texto"  type="text" name="apellido_paterno"  > <br><br>
                    </p>
                    <p>
                        <label for="apellido_materno">Apellido materno </label>
                        <input class="texto"  type="text" name="apellido_materno"  ><br><br>
                    </p>
                    <p>
                        <label for="rfc"><span>*</span>RFC </label>
                        <input class="texto" type="text" name="rfc" ><br><br>
                    </p>
                    <p>
                        <label for="telefono">Teléfono </label>
                        <input class="texto" type="text" id="telefono" name="telefono" >
                    </p>

                    <p>
                        <label for="celular">Celular </label>
                        <input class="texto" type="text" id="celular" name="celular" >
                    </p>
                    <p>
                        <label for="email"><span>*</span>Correo electrónico </label>
                        <input id="email" name="email" type="email">
                    </p>
                    <p>
                        <label for="numero_cuenta"><span>*</span>No. cuenta</label>
                        <input type="text" name="numero_cuenta" ><br><br>
                    </p>

                    <div id="divHistorial">
                        <p id="listHistorial"></p>
                        <label for="historial">
                            <span>*</span>Historial académico actual<br>
                            <small>
                                Lo puedes obtener del 
                                <a href="https://www.dgae-siae.unam.mx/www_gate.php" target="_blank">SIAE</a><br>
                                Subir archivo formato PDF. Este campo es obligatorio a menos de que seas de primer ingreso.
                            </small>
                        </label>
                        <br>
                        <input type="file" class="fondo-blanco sin-borde" accept=".pdf" autofocus="1" id="historial" name="historial">						
                    </div>

                    <p>
                        <?php
                            $this->generadorSelect->setParametros(
                                array (
                                    'clave_valor' => 'id_carrera',
                                    'clave_opcion' => 'nombre',
                                    'contenido' => $cat_carreras
                                ),
                                'id_carrera',
                                'id_carrera',
                                '<span>*</span>Carrera: '
                            );
                            echo $this->generadorSelect->genera_combo();
                        ?>
                    </p>

                    <p>
                        <?php
                            $array_contenido['clave_valor']='valor';
                            $array_contenido['clave_opcion']='opcion';
                            $array_contenido['contenido']=array();
                            for ($i=1; $i<=5; $i++){
                                array_push ($array_contenido['contenido'], (object)array('valor' => $i, 'opcion' =>$i));
                            }
                            $this->generadorSelect->setParametros(
                                $array_contenido,
                                'semestre_registro',
                                'semestre_registro',
                                '<span>*</span>Semestre actual: '
                            );
                            echo $this->generadorSelect->genera_combo();
                            
                        ?>
                    </p>

                    <p>
                        <label for="promedio_registro"><span>*</span>Promedio </label> <i class="far fa-question-circle oprimible" data-toggle="popover" data-content="Si eres de primer ingreso, coloca el promedio final obtenido en el bachillerato."></i>
                        <input class="texto" type="text" name="promedio_registro" >
                    </p>
                    <hr>

                    <?php
                        //IMPRIMIENDO PREGUNTAS DE OPCION MULTIPLE
                        if ($cat_preguntas_opcionales){
                            foreach ($cat_preguntas_opcionales as $pregunta_opcional){
                                echo "<div><label>"
                                    ."".$pregunta_opcional->pregunta_opcional->pregunta.""
                                ."</label></div>";
                                $this->generadorRadio->setParametros(
                                    array (
                                        'clave_valor' => 'id_respuesta_opcional',
                                        'clave_opcion' => 'opcion',
                                        'contenido' => $pregunta_opcional->opciones
                                    ),
                                    '',
                                    'resp_cerr_'.$pregunta_opcional->pregunta_opcional->id_pregunta_opcional,
                                    ''
                                );
                                echo $this->generadorRadio->genera_combo();
                            }
                        }

                        //IMPRIMIENDO PREGUNTAS ABIERTAS
                        if ($cat_preguntas_abiertas){
                            foreach ($cat_preguntas_abiertas as $pregunta_abierta){
                                echo '<div class="preguntas-abiertas-solicitud">';
                                echo $pregunta_abierta->pregunta;
                                echo '<input type="text" name="abierta_'.$pregunta_abierta->id_pregunta_abierta.'" >';
                                echo "</div>";
                            }
                        }
                    ?>
                    <br>
                    <p>
                        <label for="acuerdo"><input type="checkbox" name="acuerdo" id="acuerdo" value=1> He leído y acepto el <a href="https://www.ingenieria.unam.mx/paginas/aviso_privacidad.php" target="_blank">Aviso de Privacidad Simplificado de la Facultad de Ingeniería, UNAM</a> </label>
                    </p><br>
                    <p>
                        <input class="submit disabled" id="enviar" disabled id="registrar" type="submit" value="Registrar">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
    