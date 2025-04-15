const asistenciaBtn = document.getElementById("submit-asistencia");
const dniInput = document.getElementById("dni-asistencia");
const error = document.getElementById("error");
const dniLoader = document.getElementById("dni-loading");

// Deshabilitar botón inicialmente
asistenciaBtn.disabled = true;

// Función para validar y verificar DNI
const verificarDNI = (dni) => {
	// No hacer nada si está vacío
	if (!dni) return;

	// Reiniciar error
	error.innerHTML = "";
	asistenciaBtn.disabled = true;

	// Validar formato básico
	if (!/^\d+$/.test(dni)) {
		error.innerHTML = "El DNI debe contener solo números";
		return;
	}

	// No consultar API si no tiene 8 dígitos
	if (dni.length !== 8) {
		error.innerHTML = "El DNI debe tener 8 dígitos";
		return;
	}

	// Usar el helper para consultar DNI
	fetchDocData(
		"dni",
		dni,
		dniLoader,
		(data) => {
			// Éxito - habilitar botón
			asistenciaBtn.disabled = false;
		},
		(errorMsg) => {
			// Error - mostrar mensaje y mantener botón deshabilitado
			error.innerHTML = errorMsg;
			asistenciaBtn.disabled = true;
		}
	);
};

// Detectar cambios en el input
dniInput.addEventListener("input", () => {
	const dni = dniInput.value;

	// Limpiamos errores y deshabilitamos botón
	error.innerHTML = "";
	asistenciaBtn.disabled = true;

	// Si el DNI llegó a 8 dígitos, verificar automáticamente
	if (dni.length === 8) {
		verificarDNI(dni);
	}
});

// Validar al enviar el formulario
document.getElementById("form-asistencia").addEventListener("submit", (e) => {
	const dni = dniInput.value;

	if (dni.length !== 8 || !/^\d+$/.test(dni)) {
		e.preventDefault();
		error.innerHTML = "El DNI debe tener 8 dígitos numéricos";
		return false;
	}

	if (asistenciaBtn.disabled) {
		e.preventDefault();
		error.innerHTML = "Por favor, verifique que el DNI sea válido";
		return false;
	}

	return true;
});
