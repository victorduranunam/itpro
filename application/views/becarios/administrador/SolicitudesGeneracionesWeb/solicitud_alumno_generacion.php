<div class="page-title">
    <div class="title_left">
        <h3>Generación <?= $generacion->data->generacion ?> semestre <?= $generacion->data->semestre ?></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Solicitud del aspirante</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="<?= base_url() ?>generacion/<?= $generacion->data->id_generacion ?>/alumnos_cursos">
                            <button
                                type="submit"
                                class="btn btn-success"
                            >
                                Regresar a la generación <?= $generacion->data->generacion ?>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                
<?php if (isset($mensaje_actualizacion)){ ?>
                <div class="mensaje <?= $tipo_mensaje_actualizacion ?>">
                    <p><?= $mensaje_actualizacion ?></p>
                </div>
                <br><br>
<?php } ?>
<?php if (isset($mensaje)){ ?>
                <div class="mensaje <?= $tipo_mensaje ?>">
                    <p><?= $mensaje ?></p>
                </div>
                <br><br>
<?php }else{ ?>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <a class="liga-boton-icono" target="_blank" href="<?= base_url() ?>generaciones/<?= $id_generacion ?>/solicitudes_becarios/<?= $id_alumno ?>/impresion"><i class="fa fa-print"></i> Imprimir solicitud</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action encabezado-vertical">
                                
                                <tbody>
                                    <tr class="even pointer" >
                                        <th class="encabezado">Nombre</th>
                                        <td><?= $datos_personales->apellido_paterno ?> <?= $datos_personales->apellido_materno ?> <?= $datos_personales->nombre ?></td>
                                    </tr>
                                    <?php if (! is_null ($datos_personales->fecha_registro ) and trim($datos_personales->fecha_registro !== '')){   ?>
                                        <tr class="odd pointer">
                                            <th class="encabezado">Fecha de registro</th>
                                            <td><?= $datos_personales->fecha_registro ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr class="odd pointer">
                                        <th class="encabezado">Carrera</th>
                                        <td><?= $datos_personales->carrera ?></td>
                                    </tr>
                                    <tr class="even pointer">
                                        <th class="encabezado">Número de cuenta</th>
                                        <td><?= $datos_personales->numero_cuenta ?></td>
                                    </tr>

                                    <tr class="odd pointer">
                                        <th class="encabezado">Semestre actual</th>
                                        <td><?= $datos_personales->semestre_registro ?></td>
                                    </tr>
                                    <tr class="even pointer">
                                        <th class="encabezado">Promedio</th>
                                        <td><?= $datos_personales->promedio_registro ?></td>
                                    </tr>

                                    <tr class="odd pointer">
                                        <th class="encabezado">RFC</th>
                                        <td><?= $datos_personales->rfc ?></td>
                                    </tr>

                                    <!--<tr class="even pointer">
                                        <th class="encabezado">Calle y número</th>
                                        <td><?= $datos_personales->calle_numero ?></td>
                                    </tr>-->
                                    <!--<tr class="odd pointer">
                                        <th class="encabezado">Colonia</th>
                                        <td><?= $datos_personales->colonia ?></td>
                                    </tr>-->
        <?php if (! is_null ($datos_personales->delegacion_municipio) and trim($datos_personales->delegacion_municipio!== '')){   ?>
                                    <tr class="even pointer">
                                        <th class="encabezado">Alcaldía o municipio</th>
                                        <td><?= $datos_personales->delegacion_municipio ?></td>
                                    </tr>
        <?php } ?>
                                    <!--<tr class="odd pointer">
                                        <th class="encabezado">Estado</th>
                                        <td><?= $datos_personales->estado ?></td>
                                    </tr>-->
                                    <!--<tr class="even pointer">
                                        <th class="encabezado">Código postal</th>
                                        <td><?= $datos_personales->codigo_postal ?></td>
                                    </tr>-->
        <?php if (! is_null ($datos_personales->telefono) and trim($datos_personales->telefono!== '')){   ?>                     
                                    <tr class="odd pointer">
                                        <th class="encabezado">Teléfono</th>
                                        <td><?= $datos_personales->telefono ?></td>
                                    </tr>
        <?php } ?>
        <?php if (! is_null ($datos_personales->celular) and trim($datos_personales->celular!== '')){   ?>
                                    <tr class="even pointer">
                                        <th class="encabezado">Celular</th>
                                        <td><?= $datos_personales->celular ?></td>
                                    </tr>
        <?php } ?>
                                    
                                    <tr class="odd pointer">
                                        <th class="encabezado">Correo electrónico</th>
                                        <td><?= $datos_personales->email ?></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>


<div class="col-md-6 col-sm-12 foto-solicitud">
    <?php 
        $rutaFoto = FCPATH . 'assets/fotos/' . $datos_personales->foto; // ruta física en el servidor
        if (!empty($datos_personales->foto) && file_exists($rutaFoto)) {
            $fotoMostrar = asset_url() . 'fotos/' . $datos_personales->foto;
        } else {
            $fotoMostrar = asset_url() . 'fotos/face_icon.png';
        }
    ?>
    <img src="<?= $fotoMostrar ?>" alt="Fotografía de <?= $datos_personales->apellido_paterno ?> <?= $datos_personales->apellido_materno ?> <?= $datos_personales->nombre ?>">
</div>




                </div>
    <?php  if ($preguntas_abiertas_solicitud || $preguntas_opcionales_solicitud){ ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action encabezado-vertical">
                                
                                <tbody>
        <?php  foreach ($preguntas_opcionales_solicitud as $pregunta_opcional) { ?>
                                    <tr class="even pointer" >
                                        <th class="encabezado"><?= $pregunta_opcional->pregunta ?></th>
                                        <td> <?=  $pregunta_opcional->opcion.$pregunta_opcional->otro ?></td>
                                    </tr>
        <?php } ?>
        <?php foreach ($preguntas_abiertas_solicitud as $pregunta_abierta) { ?>

                                    <tr class="odd pointer">
                                        <th class="encabezado"><?= $pregunta_abierta->pregunta ?></th>
                                        <td><?= $pregunta_abierta->respuesta ?></td>
                                    </tr>
        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    <?php } ?>
<?php } ?>
   
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal form-label-left" action="<?= base_url() ?>actualiza_nota_solicitud" id="actualizar-solicitud-alumno" method="post" novalidate>
                            <div class="row">
                                <div class="field item form-group col-md-12">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="nota">
                                        Nota:
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <textarea id="nota"   class="form-control deshabilitado-nota" name="nota" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" disabled ><?= $datos_personales->nota ?></textarea>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="id_solicitud" value="<?= $datos_personales->id_solicitud ?>">
                                    <button type="button" id="modificar-nota-solicitud" class="btn btn-primary" >Modificar</button>
                                    <button class="btn btn-primary oculto" id="reinicia-actualizacion-nota-solicitud" type="reset">Reiniciar</button>
                                    <button type="submit" id="envia-actualizacion-nota-solicitud" class="btn btn-success oculto">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PARA EL LISTADO DE HISTORIALES -->
<div class="clearfix"></div>
<div class="row" id="historiales-academicos">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Historiales académicos</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="<?= base_url() ?>generacion/<?= $generacion->data->id_generacion ?>/alumnos_cursos">
                            <button
                                type="submit"
                                class="btn btn-success"
                            >
                                Regresar a la generación <?= $generacion->data->generacion ?>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <div class="row">
                    <div class="col">
                    <?php if (isset($mensaje_hist)){ ?>
                        <div class="mensaje <?= $tipo_mensaje_hist ?>">
                            <p><?= $mensaje_hist ?></p>
                        </div>
                        <br><br>
                    <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php if ($historiales_academicos) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title">Semestre en que se obtuvo</th>
                                            <th class="column-title">Archivo</th>
                                            <th class="column-title">Fecha de creación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                foreach ($historiales_academicos as $clave => $historial){
                                                    $par_impar="odd";
                                                    if ($clave%2){
                                                        $par_impar="even";
                                                    }
                                        ?>
                                            <tr class="even <?= $par_impar ?>">
                                                <td><?= $historial->semestre ?></td>
                                                <td>
                                                    <a
                                                        class="icono-boton"
                                                        href="<?= asset_url() ?>historiales/<?= $historial->archivo ?>" 
                                                        target="_blank" 
                                                        rel="noopener noreferrer"
                                                        data-toggle="tooltip" 
                                                        title="Ver archivo"
                                                    >
                                                        <i class="fa fa-file-pdf-o"></i> 
                                                    </a>
                                                </td>
                                                <td><?= $historial->created ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="mensaje preventivo">
                                <p>No se tienen historiales académicos registrados para este alumno.</p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col">
                        <?php 
                            $this->load->view(
                                'becarios/administrador/componentes/historialAcademicoForm',
                                [
                                    'type' => 'post_historial_academico',
                                    'title' => 'Agregar historial académico',
                                    'id_alumno' => $id_alumno
                                ]
                            ) ;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIN PARA EL LISTADO DE HISTORIALES -->