<div id="baseurl" class="oculto" data-baseurl="<?= base_url() ?>"></div>

<!--<div class="FondoImagen container">-->
    <div class="row">
        <div class="col-12 text-center">
            
            <h2 style="font-size: 2.5vh; padding-top: 15px; color: darkblue; text-shadow: whitesmoke 0.1em 0.1em 0.2em;">
                Programa de Formación en Innovación y <br> Tecnologías de la Información IT-PRO
            </h2>
            <h2 style="font-style: italic; font-size: 2.5vh;">Solicitud de registro a la <?= $generacion->generacion ?><sup>a.</sup> Generación</h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6 pt-3">
            <div class="formulario p-4">
                <form  method="post" id="registroPrebes" enctype="multipart/form-data" 
                      action="<?= base_url() ?>registrar_solicitud"><!-- onsubmit="return validacionesEnvioForm()">-->
                    
                    <input type="hidden" name="id_generacion" value="<?= $generacion->id_generacion; ?>">
                    <input type="hidden" name="generacion" value="<?= $generacion->generacion; ?>">

                    <p>Los campos señalados con <span>*</span> son obligatorios.</p><br>

                    <div id="divFoto" class="form-group">
                        <label for="foto"><span>*</span>Sube una fotografía para tu solicitud</label>
                        <small class="d-block mb-2">
                            (Actual, de frente, serio, rostro descubierto, sin lentes oscuros, ropa formal, no mayor a 2M <b><u>en formato JPG o PNG</u></b>)
                        </small>
                        <input type="file" class="form-control-file" id="foto" name="foto">
                    </div>

                    <div id="list"></div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre"><span>*</span>Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido_paterno"><span>*</span>Apellido paterno</label>
                            <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="apellido_materno">Apellido materno</label>
                            <input type="text" class="form-control" name="apellido_materno" id="apellido_materno">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="rfc"><span>*</span>RFC</label>
                            <input type="text" class="form-control" name="rfc">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="celular">Celular</label>
                            <input type="text" class="form-control" name="celular" id="celular" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email"><span>*</span>Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>

                    <div class="form-group">
                        <label for="numero_cuenta"><span>*</span>No. cuenta</label>
                        <input type="text" class="form-control" name="numero_cuenta" id="numero_cuenta">
                    </div>

                    <div id="divHistorial" class="form-group">
                        <label for="historial"><span>*</span>Historial académico actual</label>
                        <small class="d-block mb-2">
                            Lo puedes obtener del 
                            <a href="https://www.dgae-siae.unam.mx/www_gate.php" target="_blank">SIAE</a>.
                            Subir archivo formato PDF. Este campo es obligatorio a menos de que seas de primer ingreso.
                        </small>
                        <input type="file" class="form-control-file" id="historial" name="historial">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <?php
                                $this->generadorSelect->setParametros(
                                    array('clave_valor'=>'id_carrera','clave_opcion'=>'nombre','contenido'=>$cat_carreras),
                                    'id_carrera','id_carrera','<span>*</span>Carrera: '
                                );
                                echo $this->generadorSelect->genera_combo();
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                                $array_contenido = ['clave_valor'=>'valor','clave_opcion'=>'opcion','contenido'=>[]];
                                for ($i=1;$i<=5;$i++) array_push($array_contenido['contenido'], (object)['valor'=>$i,'opcion'=>$i]);
                                $this->generadorSelect->setParametros($array_contenido,'semestre_registro','semestre_registro','<span>*</span>Semestre actual: ');
                                echo $this->generadorSelect->genera_combo();
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="promedio_registro"><span>*</span>Promedio</label>
                        <i class="far fa-question-circle oprimible" data-toggle="popover" data-content="Si eres de primer ingreso, coloca el promedio final obtenido en el bachillerato."></i>
                        <input type="number" step="0.01" class="form-control" name="promedio_registro" id="promedio_registro">
                    </div>

                    <hr>

                    <?php
                        if ($cat_preguntas_opcionales){
                            foreach ($cat_preguntas_opcionales as $pregunta_opcional){
                                echo "<div class='form-group'><label>{$pregunta_opcional->pregunta_opcional->pregunta}</label>";
                                $this->generadorRadio->setParametros(
                                    array('clave_valor'=>'id_respuesta_opcional','clave_opcion'=>'opcion','contenido'=>$pregunta_opcional->opciones),
                                    '',
                                    'resp_cerr_'.$pregunta_opcional->pregunta_opcional->id_pregunta_opcional,
                                    ''
                                );
                                echo $this->generadorRadio->genera_combo()."</div>";
                            }
                        }

                        if ($cat_preguntas_abiertas){
                            foreach ($cat_preguntas_abiertas as $pregunta_abierta){
                                echo "<div class='form-group'><label>{$pregunta_abierta->pregunta}</label>
                                <input type='text' class='form-control' name='abierta_{$pregunta_abierta->id_pregunta_abierta}'></div>";
                            }
                        }
                    ?>

                    <div class="form-group form-check">
                        <!--Desactivar el formulario -->
                        <!--
                        <input type="checkbox" class="form-check-input" id="acuerdo" name="acuerdo" value="1">
                        <label class="form-check-label" for="acuerdo">
                            He leído y acepto el 
                            <a href="https://www.ingenieria.unam.mx/paginas/aviso_privacidad.php" target="_blank">Aviso de Privacidad Simplificado de la Facultad de Ingeniería, UNAM</a>
                        </label>
                    -->
                    </div>
                    <?php if (!is_null($mensaje_error)): ?>
                        <div class="alert alert-danger" id="error-registro" role="alert"><?= $mensaje_error ?></div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary btn-block" id="enviar" >Registrar</button>
                </form>
            </div>
        </div>
    </div>


    <script src="../assets/js/valid.js"></script>

    <!-- Para desactivar el formulario -->

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.querySelectorAll('#registroPrebes input, #registroPrebes select, #registroPrebes textarea, #registroPrebes button');
    const checkboxAcuerdo = document.getElementById('acuerdo');

    // 1 Deshabilitar todo el formulario al cargar
    formulario.forEach(el => el.disabled = true);

    // 2️ Permitir marcar checkbox y habilitar formulario
    // (deshabilitamos checkbox al principio, lo habilitamos manualmente)
    checkboxAcuerdo.disabled = false;

    checkboxAcuerdo.addEventListener('change', function() {
        if (this.checked) {
            // habilita todos los campos excepto checkbox
            formulario.forEach(el => {
                if (el !== checkboxAcuerdo) el.disabled = false;
            });
        } else {
            // deshabilita todos los campos excepto checkbox
            formulario.forEach(el => {
                if (el !== checkboxAcuerdo) el.disabled = true;
            });
        }
    });

    // 3️ Evitar reenvío doble
    document.getElementById('registroPrebes').addEventListener('submit', function() {
        formulario.forEach(el => el.disabled = true); // desactiva todo al enviar
    });
});
</script>

 <!-- fin de desactivar el formulario -->

<!--</div>-->
