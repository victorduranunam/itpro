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
                <h2>Solicitudes</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <div class="modal" id="edicion-datos-solicitud" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Datos de la solicitud</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-horizontal form-label-left" action="<?= base_url() ?>actualiza_datos_solicitud" id="actualizar-solicitud-alumno" method="post" novalidate>
                                <div class="modal-body"> 
                                    <div class="row">
                                        <div class="field item form-group col-md-12">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                                Alumno
                                            </label>
                                            <div class="col-md-9 col-sm-9">
                                                <input class="form-control" id="alumno" disabled="disabled" />
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="field item form-group col-md-12">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="semestre-ingreso">
                                                Semestre ingreso
                                            </label>
                                            <div class="col-md-9 col-sm-9">
                                                <input class="form-control number" type="number"  id="semestre-ingreso" name="semestre_ingreso_prebecario" data-validate-minmax="2,9" />
                                            </div>
                                        </div>
                                    </div>                       
                                    <div class="row">
                                        <div class="field item form-group col-md-12">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="promedio-ingreso">
                                                Promedio ingreso
                                            </label>
                                            <div class="col-md-9 col-sm-9">
                                                <input class="form-control number" type="number"  id="promedio-ingreso" name="promedio_ingreso_prebecario" data-validate-minmax="0,10" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="field item form-group col-md-12">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="calificacion-examen">
                                                Calificación del examen
                                            </label>
                                            <div class="col-md-9 col-sm-9">
                                                <input class="form-control number" type="number"  id="calificacion-examen" name="calificacion_examen" data-validate-minmax="0,10" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="field item form-group col-md-12 checkbox">
                                            <div class="col-form-label col-md-3 col-sm-3  label-align">
                                                <input type="checkbox" id="hizo-entrevista" name="hizo_entrevista" class="flat" >
                                            </div>
                                            <label class="col-form-label col-md-9 col-sm-9" for="hizo-entrevista">
                                                Hizo entrevista
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="field item form-group col-md-12">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="id-estado-solicitud">
                                                Estado de la solicitud
                                            </label>
                                            <div class="col-md-9 col-sm-9">
                                                <select class="form-control" name="id_estado_solicitud" id="id-estado-solicitud">
                                                    <option disabled>Seleccione</option>
<?php foreach ($catalogo_estados_solicitud->data as $estado_solicitud){ ?>
                                                    <option value="<?= $estado_solicitud->id_estado_solicitud ?>"><?= $estado_solicitud->estado ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="id-alumno" name="id_alumno">
                                                        
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                    <button class="btn btn-primary" type="reset">Reiniciar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>  
                    </div>
                </div>
                
<?php 
    if (!$alumnos_generacion->status or !$catalogo_estados_solicitud->status){
?>
                <div class="mensaje preventivo">
                    <p>No se encontraron solicitudes para la generación.</p>
                </div>
<?php 
    }else{
?>
<script>
    let alumnos_generacion = <?php echo json_encode($alumnos_generacion->data) ?>;
    let catalogo_estados_solicitud = <?php echo json_encode($catalogo_estados_solicitud->data) ?>;
</script>
<?php 
  if (isset($mensaje)){ 
?>
                <div class="mensaje <?= $tipo_mensaje ?>">
                <p><?= $mensaje ?></p>
                </div>
                <br><br>
<?php } ?>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">Nombre</th>
                                <th class="column-title">Semestre al registrarse</th>
                                <th class="column-title">Promedio al registrarse</th>
                                <th class="column-title">Semestre al ingresar</th>
                                <th class="column-title">Promedio al ingresar</th>
                                <th class="column-title">Calificación del examen</th>
                                <th class="column-title">Hizo entrevista</th>
                                <th class="column-title">Estado de la solicitud</th>
                                <th class="column-title" colspan="2">Historial académico del semestre mas reciente</th>
                                <th class="column-title" colspan="2">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
<?php 
        $number = 0;
        foreach ($alumnos_generacion->data as $clave => $solicitud_alumno){
            $number += 1;
            $par_impar=($clave%2)? "even" : "odd";
            $class_status = '';
            if ($solicitud_alumno->estado == 'Pre-becario'){
                $class_status = 'background-blue';
            }else if ($solicitud_alumno->estado == 'Becario'){
                $class_status = 'background-green';
            }
?>
                            <tr class="even <?= $par_impar ?> <?= $class_status ?>">
                                <td><?= $number ?>. <?= $solicitud_alumno->apellido_paterno ?> <?= $solicitud_alumno->apellido_materno ?> <?= $solicitud_alumno->nombre ?></td>
                                <td><?= $solicitud_alumno->semestre_registro ?></td>
                                <td><?= $solicitud_alumno->promedio_registro ?></td>
                                <td><?= $solicitud_alumno->semestre_ingreso_prebecario ?></td>
                                <td><?= $solicitud_alumno->promedio_ingreso_prebecario ?></td>
                                <td><?= $solicitud_alumno->calificacion_examen ?></td>
                                <td><?php
                                    if ($solicitud_alumno->hizo_entrevista ){
                                        echo '<i class="fa fa-check"></i>';
                                    }else{
                                        echo '<i class="fa fa-times"></i>';
                                    }
                                ?></td>
                                <td><?= $solicitud_alumno->estado ?></td>
                                <td>
                                    <?php if ( $solicitud_alumno->historial_file ) {  ?>
                                        <a
                                            class="icono-boton"
                                            href="<?= asset_url() ?>historiales/<?= $solicitud_alumno->historial_file ?>" 
                                            target="_blank" 
                                            rel="noopener noreferrer"
                                            data-toggle="tooltip" 
                                            title="Ver historial académico mas reciente"
                                        >
                                            <i class="fa fa-file-pdf-o"></i> 
                                        </a>
                                    <?php } else { ?>
                                        No registrados
                                    <?php } ?>
                                </td>
                                <td>
                                    <a 
                                        href="<?= base_url() ?>generaciones/<?= $generacion->data->id_generacion ?>/solicitudes_becarios/<?= $solicitud_alumno->id_alumno ?>#historiales-academicos"
                                        class="icono-boton" data-arreglo-clave="<?= $clave ?>"
                                        data-toggle="tooltip"
                                        title="Agregar historial académico"
                                    >
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </td>
                                <td>
                                    <span
                                        class="icono-boton modficador-solicitud"
                                        data-arreglo-clave="<?= $clave ?>"
                                        data-toggle="modal"
                                        data-target="#edicion-datos-solicitud"
                                        data-toggle="tooltip" title="Editar"><i class="fa fa-edit"></i>
                                    </span>
                                </td>
                                <td>
                                    <a 
                                        href="<?= base_url() ?>generaciones/<?= $generacion->data->id_generacion ?>/solicitudes_becarios/<?= $solicitud_alumno->id_alumno ?>"
                                        class="icono-boton" data-arreglo-clave="<?= $clave ?>"
                                        data-toggle="tooltip"
                                        title="Detalles"
                                    >
                                        <i class="fa fa-search"></i>
                                    </a>
                                </td>
                            </tr>
<?php 
        }
?>   
                        </tbody>
                    </table>							
						
                </div>               
<?php 
    }
?>
            </div>
        </div>
    </div>
</div>
