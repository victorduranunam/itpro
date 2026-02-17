<?php 
    if (isset ($generaciones)){ 
?>
    <div class="menu_section">
        <h3>Etapa prebecarios</h3>
        <ul class="nav side-menu">
            <li>
                <a>
                    <i class="fa fa-home"></i> 
                    Generaciones
                    <span class="fa fa-chevron-down"></span>
                </a>

                <ul class="nav child_menu">
<?php
    $cont=0;
    foreach ($generaciones as $generacion){
        if($cont<=5){
?>
                        <li class="generacion submenu-opcion">
<?php
                            if ($cont<5){
?>
                                <a href="<?= base_url() ?>generacion/<?= $generacion->id_generacion ?>/alumnos_cursos"><?= $generacion->generacion ?></a>
<?php
                            }else {
?>
                                <a href="<?= base_url() ?>seleccion_generacion">Mas generaciones</a>
<?php
                            }
?>
                        </li>
<?php
        }
        $cont++;
    }
?>
                </ul>
            </li>
        </ul>
    </div>
<?php } ?>