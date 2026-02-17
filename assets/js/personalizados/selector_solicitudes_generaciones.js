$('#generaciones').change(function(){
    $('form#selector-solicitudes-generaciones').attr('action',base_url+'generacion/'+$(this).val()+'/alumnos_cursos');
});