const btnToggle = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");
const dniInput = document.getElementById("dni");
const error = document.getElementById("dni-error");
const nombreInput = document.getElementById("nombre");
const submitBtn = document.getElementById("submit-button");

submitBtn.disabled = true;

searchPerson = async () => {
	const dni = dniInput.value;
	const regex = /^\d{8}$/;
	nombreInput.value = "";
	error.innerHTML = "";

	if (dni.length < 8) {
		error.innerHTML = "El DNI debe tener 8 dígitos";
		nombreInput.value = "";
		return;
	}

	if (!regex.test(dni)) {
		error.innerHTML = "El DNI debe contener solo números";
		nombreInput.value = "";
		return;
	}

	try {
		const response = await fetch(
			`http://localhost/rendicion_cuentas/public/api/dni/${dni}`
		);
		const data = await response.json();

		if (response.ok && dni.length === 8) {
			const persona = Array.isArray(data) ? data[0] : data;
            console.log(persona);
			if (!persona || !persona.nombres) {
				error.innerHTML = "No se encontró ninguna persona con ese DNI";
				nombreInput.value = "";
				return;
			}
			const nombre = `${persona.nombres} ${persona.apellido_paterno} ${persona.apellido_materno}`;
			if (nombre === undefined) {
				errorDniMsg.innerHTML = "No se encontró ninguna persona con ese DNI";
				nombreInput.value = "";
				return;
			}
			asistenciaBtn.disabled = false;
		} else {
			error.innerHTML = "No se encontró ninguna persona con ese DNI";
		}
	} catch (error) {
		console.error("Error fetching JSON:", error);
		error.innerHTML = "Error al buscar la persona";
	}
};

dniInput.addEventListener("input", searchPerson);

btnToggle.addEventListener("click", () => {
	const icon = btnToggle.querySelector("i");
	if (passwordInput.type === "password") {
		passwordInput.type = "text";
		icon.classList.add("fa-eye");
		icon.classList.remove("fa-eye-slash");
	} else {
		passwordInput.type = "password";
		icon.classList.add("fa-eye-slash");
		icon.classList.remove("fa-eye");
	}
});

document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.3s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 3000);
    });
});