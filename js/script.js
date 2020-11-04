const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
	first_name: /^[a-zA-ZÀ-ÿ\s]{8,16}$/, // Letras y espacios, pueden llevar acentos.
	last_name: /^[a-zA-ZÀ-ÿ\s]{8,16}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{12,46}$/, // 12 a 46 caracteres.
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	phone: /^\d{7,10}$/ // 7 a 10 numeros.
}

const campos = {
	first_name: false,
	last_name: false,
	password: false,
	email: false,
	phone: false
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "first_name":
			validarCampo(expresiones.first_name, e.target, 'first_name');
		break;
		case "last_name":
			validarCampo(expresiones.last_name, e.target, 'last_name');
		break;
		case "password":
			validarCampo(expresiones.password, e.target, 'password');
			validarconfirm_password();
		break;
		case "confirm_password":
			validarconfirm_password();
		break;
		case "email":
			validarCampo(expresiones.email, e.target, 'email');
		break;
		case "phone":
			validarCampo(expresiones.phone, e.target, 'phone');
		break;
	}
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}

const validarconfirm_password = () => {
	const inputPassword1 = document.getElementById('password');
	const inputconfirm_password = document.getElementById('confirm_password');

	if(inputPassword1.value !== inputconfirm_password.value){
		document.getElementById(`grupo__confirm_password`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__confirm_password`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__confirm_password i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__confirm_password i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__confirm_password .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['password'] = false;
	} else {
		document.getElementById(`grupo__confirm_password`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__confirm_password`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__confirm_password i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__confirm_password i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__confirm_password .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['password'] = true;
	}
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	 
	const terminos = document.getElementById('terminos');
	if(campos.first_name && campos.last_name && campos.password && campos.email && campos.phone && terminos.checked ){
		
		//formulario.reset();

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
        

		});
		$('form').submit(function(ev){ 
	     
	    $(this).unbind('submit').submit() 
	    
	    });
		$("#formulario").submit();
			
	} else {

		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}
});


   


