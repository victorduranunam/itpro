$( document ).ready(function() {
		
		 $.validator.addMethod("correo", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
            }, "Dirección de correo electrónico inválida, favor de ingresar un correo válido ejemplo@dominio.ej");
   
    
		$.validator.addMethod("rfc", function(value, element) {
                return this.optional(element) || /^[a-zA-Z]{4}[0-9]{6}[a-zA-Z0-9]{3}$/i.test(value);
            }, "Formato rfc no valido");
        
		$.validator.addMethod("promedio", function(value, element) {
                return this.optional(element) || /^[0-9]{1,2}\.[0-9]{1,2}/i.test(value);
            }, "Favor de ingresar un valor entre 0 y 10");
        
		
		$('#registroPrebes').submit(function(e) {
            e.preventDefault();
        }).validate({
            debug: false,
            rules: {
                "nombre": {
                    required: true
                },
                "apPat": {
                    required: true
                },
                "cuenta": {
                    required: true,
					number:true,
                    minlength: 9,
                    maxlength: 9
                },
                "promedio": {
                    required: true,
					"required promedio"
                },
                "rfc": {
                    required: true,
					"required rfc"
                },
                "calleNum": {
                    required: true
                },
                "colonia": {
                    required: true
                },
				"delegacion": {
					required: true
				},	
				"cp": {
                    required: true,
                    number:true,
                    minlength: 5,
                    maxlength: 5
                },
                "email": {
                    required: true,
					"required correo"
                },
                
				"tel": {
					number: true,
					minlength: 8,
					maxlength: 8
				}
				
				"cel": {
					required:{
						depends:"input[name='tel']:checked"
					}
					number: true,
					minlength: 10,
					maxlength: 10
				}
            },
            messages: {
                "nombre": {
                    required: "Este campo es obligatorio."
                },
                "apPat": {
                    required: "Este campo es obligatorio."
                },
                "cuenta": {
                    required: "Este campo es obligatorio."
                },
                "promedio": {
                    required: "Este campo es obligatorio."
                },
				"rfc": {
                    required: "Este campo es obligatorio."
                },
				"calleNum": {
                    required: "Este campo es obligatorios."
                },
				"colonia": {
                    required: "Este campo es obligatorio."
                },
                "delegacion": {
                    required: "Este campo es obligatorio."
                },
                "email": {
                    required: "Introduce tu correo."
                },
                "cp": {
                    required: "Introduce tu código postal.",
                    number: "Introduce un código postal válido.",
                    maxlength: "Debe contener 5 dígitos.",
                    minlength: "Debe contener 5 dígitos."
                }
            }
 
        });
});
