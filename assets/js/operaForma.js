$(document).ready(function() {
	$('#registroPrebes').trigger("reset");
	$('#foto').change (function (evt) {
		console.log('funcion');
		var foto = evt.target.files; // FileList object

		// Obtenemos la imagen del campo "file".
		for (var i = 0, f; f = foto[i]; i++) {
			//Solo admitimos imágenes.
			if (!f.type.match('image.*')) {
				continue;
			}

			var reader = new FileReader();

			reader.onload = (function(theFile) {
				return function(e) {
					// Insertamos la imagen
					document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" />'].join('');
				};
			})(f);

			reader.readAsDataURL(f);
		}
	});

	$('.contenido_radio input').change(function (){
		
		if ($(this).next().text().toUpperCase().trim() == 'OTRO'){
			console.log('condicion');
			let cad = '<input class="texto resp_cerr" type="text" id="opcional_'+$(this).attr('name')+'" name="opcional_'+$(this).attr('name')+'" >';
			$(this).parent().append(cad);
		}else{
			$('#opcional_'+$(this).attr('name')).remove();
		}
	});

	
    
});
