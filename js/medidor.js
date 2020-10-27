// Medidor de Seguridad

$(function() {
	var pruebas = $(".pruebas"),
	  nivelesColores = $("#nivelesColores"),
	  boton = $("button"),
	  inputs = $("input"),
	  inputpassword = $("#password"),
	  inputRepetirpassword = $("#repetirpassword"),
	  fieldset = $("fieldset"),
	  nivel;
  
	function devuelveNivel(esteInput, evento) {

		let passInput = document.getElementById("password").value;
		  password = passInput;

	  var nivelBajo = 8,
		nivelMedio = 12,
		nivelAlto = 16,
		numCaracteres = esteInput.val().length,
		estaId = esteInput.attr("id"),
		espanNivelesColores = $(".spanNivelesColores");
	  evento.stopPropagation();
	  limpiarError();

	  /* Niveles de Seguridad
	  Bajo      Solo caracteres | Maximo 8 caracteres
	  Meido     Caracters y Numeros | Minimo 9 Caracteres
	  Alto      Caracteres, Numeros y Simbolos | Minimo 12 Caracteres
	  Muy Alto  Caracteres, Numeros y Simbolos | Minimo 16 Caracteres
	  */
	  

	  if (estaId === "password") {
		if (numCaracteres > 0 && numCaracteres < nivelBajo) {
		  nivel = "bajo";
				  espanNivelesColores.removeClass().addClass("spanNivelesColores bajo");        
		} 
		else if (numCaracteres >= nivelBajo && numCaracteres < nivelMedio && password.match(/[A-Z,a-z,0-9]/g) ) {
		  nivel = "medio";
				  espanNivelesColores.removeClass().addClass("spanNivelesColores medio"); 
		} 
		else if (numCaracteres >= nivelMedio && numCaracteres < nivelAlto && password.match(/[A-Z,a-z,0-9]/g) && password.match(/(.*[!,@,#,$,%,^,&,*,?,_,~])/) ) {
		  nivel = "alto";
				  espanNivelesColores.removeClass().addClass("spanNivelesColores alto"); 
		} 
		else if (numCaracteres >= nivelAlto && password.match(/[A-Z,a-z,0-9]/g) && password.match(/(.*[!,@,#,$,%,^,&,*,?,_,~])/) ){
		  nivel = "muy alto";
				  espanNivelesColores.removeClass().addClass("spanNivelesColores muyAlto");
		}
		if (numCaracteres === 0) {
		  espanNivelesColores.removeClass().addClass("spanNivelesColores");
		}
	  }
	}
  
	function comprobarClave(e) {
	  var divClaveCorrecta = $(".clavecorrecta"),
		  espanNivelesColores = $(".spanNivelesColores"),
		  nivelSeguridad = $("#nivelseguridad");
	  e.preventDefault();
	  e.stopPropagation();
	  if (inputpassword.val() === inputRepetirpassword.val()) {
		divClaveCorrecta.removeClass("oculto");
		espanNivelesColores.removeClass().addClass("spanNivelesColores nulo");
		nivelSeguridad.html("");
		return true;
	  } else {
		inputpassword.focus();
		mostrarError();
		inputs.val("");
	  }
	}
	function mostrarError() {
	  var divError = $(".error"),
		  espanNivelesColores = $(".spanNivelesColores"),
		  nivelSeg = $("#nivelseguridad");
	  divError.removeClass("oculto", 600);
	  nivel = "bajo";
	  nivelSeg.html(nivel);
	  espanNivelesColores.removeClass().addClass("spanNivelesColores nulo");
	}
	function limpiarError() {
	  var divError = $(".error");
	  if(!divError.hasClass("oculto")) {
		divError.addClass("oculto");
	  }
	}
	$(document).on('keyup', 'input', function(e) {
	  var nivelSeg = $("#nivelseguridad");
	  devuelveNivel($(this), e);
	  nivelSeg.html(nivel);
	});
  
	boton.click(comprobarClave);
  
	inputs.focus(limpiarError);
  });