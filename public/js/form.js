const errorDniMsg = document.getElementById("dni-error");
const orador = document.getElementById("orador");
const asistente = document.getElementById("asistente");
const organizacion = document.getElementById("organizacion");
const personal = document.getElementById("personal");
const nextBtn = document.getElementById("next-button");
const submitBtn = document.getElementById("submit-button");
const oradorInfo = document.getElementById("orador-info");
const personaInfo = document.getElementById("persona-info");
const organizacionInfo = document.getElementById("organizacion-info");
const inputs = document.querySelectorAll("#persona-info input");
const nombresInfo = document.getElementById("nombres-info");
const dni = document.getElementById("dni");
const nombre = document.getElementById("nombre");
const errorForm = document.getElementById("error-form");
const rucInput = document.getElementById("ruc");
const nombreOrg = document.getElementById("nombre-organizacion");
const rucError = document.getElementById("ruc-error");
const formRegistro = document.getElementById("form-registro");
const pregunta = document.getElementById("pregunta");
const femInput = document.getElementById("fem");
const mascInput = document.getElementById("masculino");

const validarInputs = () => {
    nextBtn.disabled = true;
    submitBtn.disabled = true;
    nextBtn.classList.remove("active");
    submitBtn.classList.remove("active");

    if (!asistente.checked && !orador.checked) return;

    if (orador.checked) {
        const inputsPersonales = document.querySelectorAll(
            "#persona-info input[type='text']"
        );
        const completos = [...inputsPersonales].every(input => 
            input.value.trim() !== "") && (femInput.checked || mascInput.checked);
        
        nextBtn.disabled = !completos;
        nextBtn.classList.toggle("active", completos);
    } else if (asistente.checked) {
        const completos = [...inputs].every(input => 
            input.value.trim() !== "") && (femInput.checked || mascInput.checked);
        
        submitBtn.disabled = !completos;
        submitBtn.classList.toggle("active", completos);
    }
};

const buscarPersona = async () => {
	const dni = document.getElementById("dni").value;
	const regex = /^\d{8}$/;
	errorDniMsg.innerHTML = "";
	nombresInfo.innerHTML = "";
	document.getElementById("nombre").value = "";

	if (dni.length < 8) {
		errorDniMsg.innerHTML = "El DNI debe tener 8 dígitos";
		document.getElementById("nombre").value = "";
		return;
	}

	if (!regex.test(dni)) {
		errorDniMsg.innerHTML = "El DNI debe contener solo números";
		document.getElementById("nombre").value = "";
		return;
	}

	if (dni.length === 0) {
		errorDniMsg.innerHTML = "";
		return;
	}

	try {
		const response = await fetch(
			`http://localhost/rendicion_cuentas/public/api/dni/${dni}`
		);
		const data = await response.json();

		if (response.ok) {
			const nombre = `${data.nombre_completo}`;
			document.getElementById("nombre").value = nombre;
			nombresInfo.innerHTML =
				"Si el nombre es incorrecto, por favor, revise el DNI ingresado";
			validarInputs();
		} else {
			document.getElementById("nombre").value = "";
			errorDniMsg.innerHTML =
				"No se encontró ninguna persona con ese DNI";
			validarInputs();
		}
	} catch (error) {
		console.error("Error fetching JSON:", error);
		errorDniMsg.innerHTML = "Error al buscar la persona";
		validarInputs();
	}
};

//Funcion de busqueda de organizacion
const buscarOrg = async () => {
	const ruc = rucInput.value;
	const regex = /^\d{11}$/;
	rucError.innerHTML = "";
	nombreOrg.value = "";

	if (ruc.length === 0) {
		rucError.innerHTML = "";
		return;
	}
	if (ruc.length < 11) {
		rucError.innerHTML = "El RUC debe tener 11 dígitos";
		return;
	}
	if (!regex.test(ruc)) {
		rucError.innerHTML = "El RUC debe contener solo números";
		return;
	}
	try {
		const response = await fetch(
			`http://localhost/rendicion_cuentas/public/api/ruc/${ruc}`
		);
		if (!response.ok) {
			throw new Error("Error al buscar la organización");
		}
		const data = await response.json();

		if (data && data.nombre_o_razon_social) {
			nombreOrg.value = data.nombre_o_razon_social;
		} else {
			rucError.innerHTML =
				"No se encontró ninguna organización con ese RUC";
		}
	} catch (e) {
		console.error("Error fetching JSON:", e);
		rucError.innerHTML = "Error al buscar la organización";
	}
};

document.getElementById("dni").addEventListener("input", () => {
	buscarPersona();
	validarInputs();
});
// Events for inputs
asistente.addEventListener("change", () => {
	oradorInfo.style.display = "none";
	personaInfo.style.display = "block";
	nextBtn.style.display = "none";
	submitBtn.style.display = "block";
});
organizacion.addEventListener("change", () => {
	organizacionInfo.style.display = "block";
});
personal.addEventListener("change", () => {
	organizacionInfo.style.display = "none";
});

// Events for buttons
nextBtn.addEventListener("click", () => {
	personaInfo.style.display = "none";
	oradorInfo.style.display = "block";
	nextBtn.style.display = "none";
	submitBtn.style.display = "block";
});
// formRegistro.addEventListener("submit", (e) => {
// 	e.preventDefault();
// 	if (asistente.checked && dni.value.length === 8 && nombre.value !== "") {
// 		alert("Registro exitoso");
// 	}
// 	if (
// 		orador.checked &&
// 		dni.value.length === 8 &&
// 		nombre.value !== "" &&
// 		pregunta.value !== "" &&
// 		personal.checked
// 	) {
// 		alert("Registro exitoso");
// 	}
// 	if (
// 		orador.checked &&
// 		dni.value.length === 8 &&
// 		nombre.value !== "" &&
// 		pregunta.value !== "" &&
// 		organizacion.checked &&
// 		rucInput.value.length === 11 &&
// 		nombreOrg.value !== ""
// 	) {
// 		alert("Registro exitoso");
// 	} else {
// 		errorForm.innerHTML = "Por favor, complete los campos";
// 	}
// });

orador.addEventListener("change", () => {
	nextBtn.style.display = "block";
	submitBtn.style.display = "none";
	validarInputs();
});
rucInput.addEventListener("input", buscarOrg);

document.addEventListener("DOMContentLoaded", function () {
	nextBtn.disabled = true;
    submitBtn.disabled = true;
    inputs.forEach((input) => input.addEventListener("input", validarInputs));
    femInput.addEventListener("change", validarInputs);
    mascInput.addEventListener("change", validarInputs);
    validarInputs();
});
