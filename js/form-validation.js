$(document).ready(function(){

	// hide messages 
	$("#error").hide();
	$("#success").hide();
	
	// on submit...
	$("#form1 #submit").click(function() {
		$("#error").hide();
		
		//required:
		
		//name
		var name = $("input#Usuario").val();
		if(name == ""){
			$("#error").fadeIn().text("Email requerido.");
			$("input#Usuario").focus();
			return false;
		}
		
		// email
			var email = $("input#pass").val();
			if(email == ""){
			$("#error").fadeIn().text("password requerido.");
			$("input#pass").focus();
			return false;
		}
		
		// web
		var web = $("input#web").val();
		if(web == ""){
			$("#error").fadeIn().text("Web required");
			$("input#web").focus();
			return false;
		}
		
		// ajax
		$.ajax({
			type:"POST",
			url: sendMailUrl,
			data: dataString,
			success: success()
		});
	});  
		
		
	// on success...
	 function success(){
	 	$("#success").fadeIn();
	 	$("#contactForm").fadeOut();
	 }
	
    return false;
});

