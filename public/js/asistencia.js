const asistenciaBtn = document.getElementById('submit-asistencia');
const dniInput = document.getElementById('dni-asistencia');
const error = document.getElementById('error');

asistenciaBtn.disabled = true;

const buscarPersona = async () => {
	const dni = dniInput.value;
	const regex = /^\d{8}$/;
	error.innerHTML = "";
	if (dni.length < 8) {
		error.innerHTML = "El DNI debe tener 8 dígitos";
		return;
	}

	if (!regex.test(dni)) {
		error.innerHTML = "El DNI debe contener solo números";
		return;
	}

	try {
		const response = await fetch(
			`http://localhost/rendicion_cuentas/public/api/dni/${dni}`
		);
		const data = await response.json();

		if (response.ok && dni.length === 8) {
            asistenciaBtn.disabled = false;
			console.log(data);
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