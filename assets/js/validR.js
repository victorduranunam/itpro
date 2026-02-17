var delegMun=0;
var archivo=false;

function validacionesEnvioForm(){
	if(validaTel() && validaFile()){
		return true;
	}
	return false;
}
function validaFile(){
	var input, file;

    // (Can't use `typeof FileReader === "function"` because apparently
    // it comes back as "object" on some browsers. So just see if it's there
    // at all.)

    input = document.getElementById('foto');
    if (!input) {
		alert ('No se encontró archivo');
    }else if (!input.files[0]) {
		//alert ('No se ha seleccionado archivo de fotografía');
	}
	file = input.files[0];
    if (file.size >2000000) {
        
		alert ('No se permiten archivos mayores a 2M');
        //bodyAppend("p", "File " + file.name + " is " + file.size + " bytes in size");
    }else{
		return true;
	}
	return false;
}

function validaTel() {
	if($('#telefono').val().trim() === '' && $('#celular').val().trim() === ''){
		alert ("Debe proporcionar al menos un telefono");
		return false;
	}
	
	/*if(archivo===false ){
		alert ("Debe proporcionar su fotografía");
		return false;
	}*/
	
	if (delegMun===0){
		 $("#municipio").attr({
			"name" : "delegacion_municipio"
		});
	}else if(delegMun===1){
		$("#delegacion").attr({
			"name" : "delegacion_municipio"
		});
	}
	 $("#foto").attr({
		"name" : "foto"
	});
	
	return true;
}

$().ready(function() {
	$('.delMun').hide();
	$("#otroResp1").hide();
	
	$(".texto").change(function(){
        $(this).val($(this).val().toUpperCase());
    });
	
	
	
	$("#estado").change(function(){
		$(this).val($(this).val().toUpperCase());
		$('.delMun').hide();
		if ($(this).val()=== "CIUDAD DE MÉXICO" || $(this).val()=== "CIUDAD DE MEXICO" || $(this).val()=== "D.F." || $(this).val()=== "D. F." || $(this).val()=== "D F" || $(this).val() === "DF" || $(this).val()==="DISTRITO FEDERAL" || $(this).val()==="CDMX" || $(this).val()==="C.D.M.X" || $(this).val()==="C. D. M. X."){
			$('#del').show();
			delegMun=1;
		}else if ($(this).val()=== "EDO DE MEXICO" || $(this).val()=== "EDO DE MÉXICO" ||  $(this).val()=== "EDO. DE MÉXICO" || $(this).val()==="MÉXICO" || $(this).val()==="MEXICO" || $(this).val()=== "EDO. DE MEXICO" || $(this).val()=== "EDO DE MEXICO" || $(this).val()=== "ESTADO DE MEXICO" || $(this).val()=== "ESTADO DE MÉXICO"){
			$('#mun').show();
		}else{
			$('.delMun').hide();
		}
    });
	
	$("#otroResp1").hide();  
/*	
    //$("#otro1").click(function() {  
	$('#otro1').change(function(){
        if($("#otro1").is(':checked')) {  
            $("#otroResp1").show();;  
        } else {  
            $("#otroResp1").hide();  
        } 
    });  
*/  
	
	$('.radios').change(function(){
		if($(this).val()==='7') {
			$("#otroResp1").show();
		} else {
			$("#otroResp1").hide();
		}		
	});

	$.validator.addMethod("rfc", function(value, element) {
		return this.optional(element) || /^[a-zA-Z]{4}[0-9]{6}[a-zA-Z0-9]{3}$/i.test(value) || /^[a-zA-Z]{4}[0-9]{6}$/i.test(value);
	}, "Formato rfc no valido: se requieren cuatro caracteres seguidos de seis dígitos o ingresar homoclave");

	$.validator.addMethod("promedio", function(value, element) {
			return this.optional(element) || /^[7-9]{1}\.[5-9]{1,2}$/i.test(value) || /^[8-9]{1}\.[0-9]{1,2}$/i.test(value) || /^[8-9]{1}$/i.test(value) || /^10$/i.test(value);
		}, "Favor de ingresar un valor entre 7.5 y 10");


	// validate signup form on keyup and submit
	$("#registroPrebes").validate({
		rules: {
			nombre: "required",
			apellido_paterno: "required",
				required: true,
				number:true,
			
			"numero_cuenta": {
				required: true,
				minlength: 9,
				maxlength: 9
			},
			
			"promedio_registro": {
				required: true,
				promedio: true
			},
			
			"rfc": {
				required: true,
				rfc: true
			},
			
			calle_numero: "required",
			colonia: "required",
			estado: "required",
			
			"codigo_postal": {
				required: true,
				number:true,
				minlength: 5,
				maxlength: 5
			},
			
			"telefono":{
				number: true,
				minlength: 10,
				maxlength: 10
			},
			
			"celular": {
				
				number: true,
				minlength: 10,
				maxlength: 10
			},
			
			"email": {
				required: true,
				email: true
			},
			
			"resp_cerr_1": {
				required: true
			},
			 
			"opcional_resp_cerr_1":{
				required: true
			},
			
			"abierta_1":{
				required: true
			},
			
			"abierta_2":{
				required: true
			},
			"foto":{
				required: true
			}
		},
		
		messages: {
			"foto":{
				required: "La fotografía es obligatoria"
			},
			"nombre":{
				required: "Este campo es obligatorio"
			},
			
			"apellido_paterno": {
				required: "Este campo es obligatorio"
			},
			
			"numero_cuenta": {
				required: "Este campo es obligatorio",
				minlength: "Este campo debe contener 9 dígitos",
				maxlength: "Este campo debe contener 9 dígitos"
			},
					
			
			"promedio_registro":{
				required: "Este campo es obligatorio"
			},
			
			"rfc":{
				required: "Este campo es obligatorio"
			},
			
			"calle_numero": {
				required: "Este campo es obligatorio"
			},
			
			"colonia": {
				required: "Este campo es obligatorio"
			},
			
			"estado": {
				required: "Este campo es obligatorio"
			},
			
			 "codigo_postal": {
				required: "Introduce tu código postal.",
				number: "Introduce un código postal válido.",
				maxlength: "Debe contener 5 dígitos.",
				minlength: "Debe contener 5 dígitos."
			},
			
			"telefono": {
				number:	"Favor de ingresar únicamente caracteres",
				maxlength: "Debe contener 8 dígitos."
			},
			
			"celular": {
				number:	"Favor de ingresar únicamente caracteres",
				maxlength: "Debe contener 10 dígitos.",
			},
			
			"email": {
				required: "Este campo es obligatorio",
				email: "Favor de ingresar un formato de correo válido: ejemplo@dominio.ej"
			},
			
			"resp_cerr_1":{
				required: "Este campo es obligatorio"
			},
			
			"opcional_resp_cerr_1":{
				required: "Favor de ingresar sus opciones"
			},
			
			"abierta_1":{
				required: "Este campo es obligatorio"
			},
			
			"abierta_2":{
				required: "Este campo es obligatorio"
			}
	
		},
		
	
		errorPlacement: function(error, element) {
		  if(element.attr("name") == "resp_cerr_1") {
			  //error.insertAfter("#labelCerr1");
			error.appendTo( element.parent("div").prev("div").prev("div") );
		  } else {
			error.insertAfter(element);
		  }
		}
	});
/*
	// propose username by combining first- and lastname
	$("#username").focus(function() {
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		if (firstname && lastname && !this.value) {
			this.value = firstname + "." + lastname;
		}
	});

	//code to hide topic selection, disable for demo
	var newsletter = $("#newsletter");
	// newsletter topics are optional, hide at first
	var inital = newsletter.is(":checked");
	var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
	var topicInputs = topics.find("input").attr("disabled", !inital);
	// show when newsletter is checked
	newsletter.click(function() {
		topics[this.checked ? "removeClass" : "addClass"]("gray");
		topicInputs.attr("disabled", !this.checked);
	});
*/
});
