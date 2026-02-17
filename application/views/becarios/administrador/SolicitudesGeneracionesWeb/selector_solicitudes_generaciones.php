<div class="page-title">
    <div class="title_left">
        <h3>Etapa de prebecarios</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Generaciones </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a class="dropdown-item" href="#">Settings 1</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="selector-solicitudes-generaciones"  class="form-horizontal form-label-left" action="#" >
                    
                    <div class="field item form-group row">
                        <div class="col-md-8 col-sm-12 offset-md-2">
                            <div class="row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Seleccione una generación</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" id="generaciones" required="required">
                                        <option disabled selected>Elija una opción</option>
<?php
    $cont=0;
    foreach ($generaciones as $generacion){
?>
                                        <option value="<?= $generacion->id_generacion ?>">Generación <?= $generacion->generacion ?>, semestre <?= $generacion->semestre ?></option>
<?php } ?>        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                     
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            
                            <!--<button class="btn btn-primary" type="reset">Reiniciar</button>-->
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

