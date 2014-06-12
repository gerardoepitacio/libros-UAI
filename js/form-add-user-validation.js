$(document).ready(function(){

	// hide messages 
	$("#error").hide();//id, para p tipo errores
	$("#success").hide();//id, para p tipo exito
	
	// on submit...
	$("#formAddUser #submit").click(function() {
		$("#error").hide();
		
		//required:
		
		//name
		var name = $("input#nombre").val();
		if(name == ""){
			$("#error").fadeIn().text("Nombre requerido ");
			$("input#nombre").focus();
			return false;
		}
		
		//sexo
		var name = $("input#sexo").val();
		if(name == ""){
			$("#error").fadeIn().text("Data required.");
			$("input#sexo").focus();
			return false;
		}
		
		// email
			var email = $("input#correo").val();
			if(email == ""){
			$("#error").fadeIn().text("Email requerido");
			$("input#correo").focus();
			return false;
		}
		
		//facebook
		var name = $("input#facebook").val();
		if(name == ""){
			$("#error").fadeIn().text("Dato requerido.");
			$("input#facebook").focus();
			return false;
		}
		
		//telefono
		var name = $("input#telefono").val();
		if(name == ""){
			$("#error").fadeIn().text("Dato requerido.");
			$("input#telefono").focus();
			return false;
		}
		
		//direccion
		
		var name = $("input#direccion").val();
		if(name == ""){
			$("#error").fadeIn().text("Dato requerido.");
			$("input#direccion").focus();
			return false;
		}
		
		//idunidad
		var name = $("input#idunidad").val();
		if(name == ""){
			$("#error").fadeIn().text("Dato requerido.");
			$("input#idunidad").focus();
			return false;
		}
		
		
		var name = $("input#password").val();
		if(name == ""){
			$("#error").fadeIn().text("Dato requerido.");
			$("input#password").focus();
			return false;
		}
		
		// ajax
		$.ajax({
			type:"POST",
			url: sendMailUrl,
			data: dataString,
			success: success()
		});
	})
	
    return false;
});

