const asistenciaBtn = document.getElementById('submit-asistencia');
const dniInput = document.getElementById('dni-asistencia');
const error = document.getElementById('error');
const dniLoader = document.getElementById("dni-loading");

asistenciaBtn.disabled = true;

const buscarPersona = async () => {
	const dni = dniInput.value;
	const regex = /^\d{8}$/;
	error.innerHTML = "";
	if (!regex.test(dni)) {
		error.innerHTML = "El DNI debe contener solo números";
		return;
	}
	if (dni.length < 8) {
		error.innerHTML = "El DNI debe tener 8 dígitos";
		return;
	}


	dniLoader.classList.remove('d-none')
	dniLoader.classList.add('d-flex')

	try {
		const response = await fetch(
			`http://localhost/rendicion_cuentas/public/api/dni/${dni}`
		);
		const data = await response.json();

		if (response.ok && dni.length === 8) {
            asistenciaBtn.disabled = false;
			dniLoader.classList.add('d-none')
			dniLoader.classList.remove('d-flex')
		} else {
			error.innerHTML =
				"No se encontró ninguna persona con ese DNI";
		}
	} catch (error) {
		console.error("Error fetching JSON:", error);
		error.innerHTML = "Error al buscar la persona";
	}
};

dniInput.addEventListener('input', buscarPersona);
