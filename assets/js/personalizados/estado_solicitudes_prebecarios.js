$('.icono-boton.modficador-solicitud').click(function(){
    console.log(alumnos_generacion[$(this).data('arreglo-clave')]);
    let solicitud_alumno_seleccionada = alumnos_generacion[$(this).data('arreglo-clave')];
    $('#id-alumno').val(
        solicitud_alumno_seleccionada.id_alumno
    );
    $('#alumno').val(
        solicitud_alumno_seleccionada.apellido_paterno + " " +
        solicitud_alumno_seleccionada.apellido_materno + " " +
        solicitud_alumno_seleccionada.nombre
    );
    
    if(solicitud_alumno_seleccionada.semestre_ingreso_prebecario!==null){
        $('#semestre-ingreso').val(
            solicitud_alumno_seleccionada.semestre_ingreso_prebecario.trim()
        );
    }
    if(solicitud_alumno_seleccionada.promedio_ingreso_prebecario!==null){
        $('#promedio-ingreso').val(
            solicitud_alumno_seleccionada.promedio_ingreso_prebecario.trim()
        );
    }
    $('#calificacion-examen').val(
        solicitud_alumno_seleccionada.calificacion_examen
    );
    if(solicitud_alumno_seleccionada.hizo_entrevista===true || solicitud_alumno_seleccionada.hizo_entrevista=='T' || solicitud_alumno_seleccionada.hizo_entrevista=='t' ){
        $('#hizo-entrevista').prop('checked',true);
    }else{
        $('#hizo-entrevista').prop('checked',false);
    }
    $('#id-estado-solicitud').val(
        solicitud_alumno_seleccionada.id_estado_solicitud
    ).change();
});