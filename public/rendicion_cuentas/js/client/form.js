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
const ejeSelect = document.getElementById("eje-select");
const dniLoader = document.getElementById("dni-loading");
const rucLoader = document.getElementById("ruc-loading");
const orgHasRuc = document.getElementById("org-has-ruc");
const tieneRuc = document.getElementById("tiene-ruc");
const noTieneRuc = document.getElementById("no-tiene-ruc");

const validarInputs = () => {
	nextBtn.disabled = true;
	submitBtn.disabled = true;
	nextBtn.classList.remove("active");
	submitBtn.classList.remove("active");

	if (!asistente.checked && !orador.checked) return;

	// Validación para orador
	if (orador.checked) {
		if (personaInfo.style.display !== "none") {
			const inputsPersonales = document.querySelectorAll(
				"#persona-info input[type='text']"
			);
			const completos =
				[...inputsPersonales].every(
					(input) => input.value.trim() !== ""
				) &&
				(femInput.checked || mascInput.checked);

			nextBtn.disabled = !completos;
			nextBtn.classList.toggle("active", completos);
		} else if (oradorInfo.style.display === "block") {
			let completos =
				pregunta.value.trim() !== "" &&
				(personal.checked || organizacion.checked) &&
				ejeSelect.value !== "";

			if (organizacion.checked) {
				// Nueva lógica para RUC opcional
                // orgHasRuc.style.display = "block"; // Asegurarse de que la pregunta sobre RUC esté visible
				if (tieneRuc.checked) {
					completos =
						completos &&
						rucInput.value.trim().length === 11 &&
						nombreOrg.value.trim() !== "";
				} else if (noTieneRuc.checked) {
					completos = completos && nombreOrg.value.trim() !== "";
				} else {
					// Si no ha seleccionado si tiene RUC o no
					completos = false;
				}
			}

			submitBtn.disabled = !completos;
			submitBtn.classList.toggle("active", completos);
			if (!ejeSelect.value) {
				errorForm.innerHTML = "Debe seleccionar un eje temático";
			} else {
				errorForm.innerHTML = "";
			}
		}
	}
	// Validación para asistente
	else if (asistente.checked) {
		const completos =
			[...inputs].every((input) => input.value.trim() !== "") &&
			(femInput.checked || mascInput.checked);

		submitBtn.disabled = !completos;
		submitBtn.classList.toggle("active", completos);
	}
};

const buscarPersona = () => {
    const dniValue = dni.value;

    // Reiniciar campos
    errorDniMsg.innerHTML = "";
    nombresInfo.innerHTML = "";
    nombre.value = "";

    // Validar formato básico
    if (!/^\d+$/.test(dniValue)) {
        errorDniMsg.innerHTML = "El DNI debe contener solo números";
        return;
    }

    // No consultar API si no tiene 8 dígitos
    if (dniValue.length !== 8) {
        if (dniValue.length > 0) {
            errorDniMsg.innerHTML = "El DNI debe tener 8 dígitos";
        }
        return;
    }

    // Usar el helper para consultar DNI
    fetchDocData(
        "dni",
        dniValue,
        dniLoader,
        (data) => {
            const persona = Array.isArray(data) ? data[0] : data;
            if (!persona || !persona.nombres) {
                errorDniMsg.innerHTML =
                    "No se encontró ninguna persona con ese DNI";
                return;
            }

            const nombreCompleto = `${persona.nombres} ${persona.apellido_paterno} ${persona.apellido_materno}`;
            if (nombreCompleto === "undefined") {
                errorDniMsg.innerHTML =
                    "No se encontró ninguna persona con ese DNI";
                return;
            }

            nombre.value = nombreCompleto;
            nombresInfo.innerHTML =
                "Si el nombre es incorrecto, por favor, revise el DNI ingresado";
            validarInputs();
            
            // Verificar si el DNI ya está registrado
            verificarRegistro(dniValue);
        },
        (errorMsg) => {
            errorDniMsg.innerHTML = errorMsg;
            validarInputs();
        }
    );
};

const buscarOrg = () => {
	const ruc = rucInput.value;

	// Reiniciar campos
	rucError.innerHTML = "";
	nombreOrg.value = "";

	// Validar formato básico
	if (!/^\d+$/.test(ruc)) {
		if (ruc.length > 0) {
			rucError.innerHTML = "El RUC debe contener solo números";
		}
		validarInputs();
		return;
	}

	// No consultar API si no tiene 11 dígitos
	if (ruc.length !== 11) {
		if (ruc.length > 0) {
			rucError.innerHTML = "El RUC debe tener 11 dígitos";
		}
		validarInputs();
		return;
	}

	// Usar el helper para consultar RUC
	fetchDocData(
		"ruc",
		ruc,
		rucLoader,
		(data) => {
			if (!data || !data.nombre_o_razon_social) {
				rucError.innerHTML =
					"No se encontró ninguna organización con ese RUC";
				validarInputs();
				return;
			}

			nombreOrg.value = data.nombre_o_razon_social;
			validarInputs();
		},
		(errorMsg) => {
			rucError.innerHTML = errorMsg;
			validarInputs();
		}
	);
};

// Verificar si el DNI ya está registrado en esta rendición
const verificarRegistro = (dniValue) => {
    if (dniValue.length !== 8) return;
    
    const id_rendicion = document.querySelector('input[name="id_rendicion"]').value;
    
    // Mostrar indicador de carga
    dniLoader.classList.remove("d-none");
    
    fetch(`${baseUrl}/form/verificar_registro/${dniValue}/${id_rendicion}`)
        .then(response => response.json())
        .then(data => {
            dniLoader.classList.add("d-none");
            
            // Si existe=false, significa que el usuario YA está registrado (confuso pero así está implementado)
            if (data.existe === 'true') {
                errorDniMsg.innerHTML = "Este DNI ya está registrado para esta rendición de cuentas";
                errorDniMsg.classList.add("text-danger");
                // Deshabilitar el botón next y submit
                nextBtn.disabled = true;
				mascInput.disabled = true;
				femInput.disabled = true;
				asistente.disabled = true;
				orador.disabled = true;
                submitBtn.disabled = true;
                nextBtn.classList.remove("active");
                submitBtn.classList.remove("active");
            } else {
				mascInput.disabled = false;
				femInput.disabled = false;
				asistente.disabled = false;
				orador.disabled = false;
				nextBtn.disabled = false;
			}
        })
        .catch(error => {
            dniLoader.classList.add("d-none");
            console.error("Error al verificar registro:", error);
        });
};

// Eventos para la opción de RUC
tieneRuc.addEventListener("change", () => {
	document.getElementById("ruc").parentElement.style.display = "block";
	document.getElementById("ruc-loading").parentElement.style.display =
		"block";
	document.getElementById("ruc-error").style.display = "block";
	validarInputs();
});

noTieneRuc.addEventListener("change", () => {
	document.getElementById("ruc").parentElement.style.display = "none";
	document.getElementById("ruc-loading").style.display = "none";
	document.getElementById("ruc-error").style.display = "none";
	rucInput.value = ""; // Limpiar el campo RUC
	rucError.innerHTML = ""; // Limpiar errores de RUC
	validarInputs();
});

// Events for inputs
dni.addEventListener("input", buscarPersona);
rucInput.addEventListener("input", buscarOrg);

asistente.addEventListener("change", () => {
	oradorInfo.style.display = "none";
	personaInfo.style.display = "block";
	nextBtn.style.display = "none";
	submitBtn.style.display = "block";
	validarInputs();
});

organizacion.addEventListener("change", () => {
	orgHasRuc.style.display = "block"; // Mostrar la pregunta sobre RUC
	organizacionInfo.style.display = "block";
	validarInputs();
});

personal.addEventListener("change", () => {
	orgHasRuc.style.display = "none"; // Ocultar la pregunta sobre RUC
	organizacionInfo.style.display = "none";
	validarInputs();
});

// Events for buttons
nextBtn.addEventListener("click", () => {
	personaInfo.style.display = "none";
	oradorInfo.style.display = "block";
	nextBtn.style.display = "none";
	submitBtn.style.display = "block";
});

orador.addEventListener("change", () => {
	nextBtn.style.display = "block";
	submitBtn.style.display = "none";
	validarInputs();
});

pregunta.addEventListener("input", validarInputs);
personal.addEventListener("change", validarInputs);
nombreOrg.addEventListener("input", validarInputs);
ejeSelect.addEventListener("change", validarInputs);

document.addEventListener("DOMContentLoaded", function () {
	nextBtn.disabled = true;
	submitBtn.disabled = true;
	inputs.forEach((input) => input.addEventListener("input", validarInputs));
	femInput.addEventListener("change", validarInputs);
	mascInput.addEventListener("change", validarInputs);
	tieneRuc.addEventListener("change", validarInputs);
	noTieneRuc.addEventListener("change", validarInputs);
	validarInputs();
});
