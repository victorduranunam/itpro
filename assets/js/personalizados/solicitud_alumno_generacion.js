$('#modificar-nota-solicitud').click(function(){
    if ($('#envia-actualizacion-nota-solicitud').hasClass('oculto')){
        //$(this).addClass('btn-secondary');
        $(this).html('Cancelar');

        $('#envia-actualizacion-nota-solicitud').removeClass('oculto');
        $('#reinicia-actualizacion-nota-solicitud').removeClass('oculto');
        
        $('#nota').removeClass('deshabilitado-nota');
        $('#nota').removeAttr('disabled');
        
    }else{
        //$(this).removeClass('oculto');
        //$(this).removeClass('btn-secondary');
        $(this).html('Modificar');

        $('#envia-actualizacion-nota-solicitud').addClass('oculto');
        $('#reinicia-actualizacion-nota-solicitud').addClass('oculto');
        
        $('#nota').addClass('deshabilitado-nota');
        $('#nota').prop('disabled',true);
        $('form')[0].reset();
    }
});