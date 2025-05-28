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
const togglePasswordVisibility = (passwordInput, toggleBtn) => {
	const icon = toggleBtn.querySelector("i");
	if (passwordInput.type === "password") {
		passwordInput.type = "text";
		icon.classList.add("fa-eye");
		icon.classList.remove("fa-eye-slash");
	} else {
		passwordInput.type = "password";
		icon.classList.add("fa-eye-slash");
		icon.classList.remove("fa-eye");
	}
};
/**
 * Inicializa la funcionalidad de previsualización de imágenes
 * @param {Object} options - Opciones de configuración
 */
const initImagePreview = (options = {}) => {
    const config = {
        inputId: "imageInput",
        previewContainerId: "preview-container",
        previewImageId: "preview-image",
        fileNameId: "file-name",
        cancelBtnId: "cancel-image",
        hasCurrentImage: false,
        currentImageLabel: "(Banner actual)",
        newImageLabel: "(Nueva imagen)",
        ...options,
    };

    const fileInput = document.getElementById(config.inputId);
    const previewContainer = document.getElementById(config.previewContainerId);
    const previewImage = document.getElementById(config.previewImageId);
    const fileName = document.getElementById(config.fileNameId);
    const cancelBtn = document.getElementById(config.cancelBtnId);

    if (!fileInput || !previewContainer) return;

    let currentImageInfo = {
        src: previewImage ? previewImage.src : '',
        name: fileName ? fileName.textContent : '',
    }

    if (config.hasCurrentImage) {
        if (previewContainer) previewContainer.classList.remove("d-none");
        if (cancelBtn) cancelBtn.style.display = "none";
    } else {
        if (previewContainer) previewContainer.classList.add('d-none');
    }
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];

            if (fileName) {
                fileName.textContent = file.name + " " + config.newImageLabel;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                if (!previewImage) {
                    const img = document.createElement("img");
                    img.id = config.previewImageId;
                    img.classList.add("img-fluid");
                    img.style.maxHeight = "200px";
                    img.style.borderRadius = "0.5rem"
                    
                    const container = previewContainer.querySelector(".preview-image-container");
                    if (container) {
                        container.appendChild(img);
                    } else {
                        const newContainer = document.createElement("div");
                        newContainer.classList.add("preview-image-container");
                        newContainer.appendChild(img);
                        previewContainer.appendChild(newContainer);
                    }
                    previewImage = img;
                }
                previewImage.src = e.target.result;
                previewContainer.classList.remove("d-none");
                if (cancelBtn) {
                    cancelBtn.style.display = "block";
                }
            };
            reader.readAsDataURL(file);
        }
    });
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            fileInput.value = "";
            if (config.hasCurrentImage) {
                if (previewImage) previewImage.src = currentImageInfo.src;
                if (fileName) fileName.textContent = currentImageInfo.name;
                this.style.display = "none";
            } else {
                previewContainer.classList.add("d-none");
                if (fileName) fileName.textContent = "";
                if (previewImage) previewImage.src = "";
            }
        });
    }
};

/**
 * Inicializa el select de rendiciones para que seleccione la más reciente
 * y redirija automáticamente a la URL deseada al cargar o al cambiar.
 * 
 * @param {Object} options
 * @param {string} options.selectId - ID del select de rendiciones
 * @param {string} options.paramName - Nombre del parámetro GET (ej: 'id_rendicion' o 'id')
 * @param {string} options.baseUrl - URL base a la que redirigir (sin parámetros)
 * @param {string|undefined} options.selectedId - ID de la rendición actualmente seleccionada (si existe)
 */
function initRendicionSelect({ selectId, paramName, baseUrl, selectedId }) {
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById(selectId);
        if (!select) return;

        // Si no hay valor seleccionado, selecciona la opción más reciente (primer option no disabled)
        if (!selectedId) {
            const firstOption = select.querySelector('option:not([disabled])');
            if (firstOption) {
                select.value = firstOption.value;
                window.location.href = baseUrl + '?' + paramName + '=' + firstOption.value;
                return; // Evita doble redirección
            }
        }

        // Al cambiar el select, redirige a la URL correcta
        select.addEventListener('change', function () {
            if (this.value) {
                window.location.href = baseUrl + '?' + paramName + '=' + this.value;
            }
        });
    });
}
