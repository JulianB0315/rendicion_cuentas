/**
 * Helper para consultar documentos (DNI o RUC) a la API
 * @param {string} docType - Tipo de documento ('dni' o 'ruc')
 * @param {string} docNumber - Número de documento
 * @param {HTMLElement} loaderElement - Elemento loader a mostrar/ocultar
 * @param {function} onSuccess - Callback para éxito con el resultado
 * @param {function} onError - Callback para el error
 * @returns {Promise} - Promise que se resuelve con el resultado
 */
const fetchDocData = async (
	docType,
	docNumber,
	loaderElement,
	onSuccess,
	onError
) => {
	// Validar longitud según tipo
	const isValid =
		(docType === "dni" && docNumber.length === 8) ||
		(docType === "ruc" && docNumber.length === 11);

	if (!isValid) {
		const errorMsg =
			docType === "dni"
				? "El DNI debe tener 8 dígitos"
				: "El RUC debe tener 11 dígitos";

		if (onError) onError(errorMsg);
		return;
	}

	// Mostrar loader
	if (loaderElement) {
		loaderElement.classList.remove("d-none");
		loaderElement.classList.add("d-flex");
	}

	try {
		const baseUrl = window.location.origin;
		const url = `${baseUrl}/rendicion_cuentas/public/api/${docType}/${docNumber}`;

		const response = await fetch(url);
		const data = await response.json();

		// Ocultar loader
		if (loaderElement) {
			loaderElement.classList.add("d-none");
			loaderElement.classList.remove("d-flex");
		}

		if (response.ok) {
			if (onSuccess) onSuccess(data);
			return data;
		} else {
			const errorMsg =
				docType === "dni"
					? "No se encontró ninguna persona con ese DNI"
					: "No se encontró ninguna organización con ese RUC";

			if (onError) onError(errorMsg);
			return null;
		}
	} catch (error) {
		console.error(`Error consultando ${docType}:`, error);

		// Ocultar loader en caso de error
		if (loaderElement) {
			loaderElement.classList.add("d-none");
			loaderElement.classList.remove("d-flex");
		}

		const errorMsg =
			docType === "dni"
				? "Error al buscar la persona"
				: "Error al buscar la organización";

		if (onError) onError(errorMsg);
		return null;
	}
};
