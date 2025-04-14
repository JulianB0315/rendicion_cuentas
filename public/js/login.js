const btnToggle = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");
const dniInput = document.getElementById("dni");
const error = document.getElementById("dni-error");
const nombreInput = document.getElementById("nombre");
const submitBtn = document.getElementById("submit-button");
const dniLoader = document.getElementById("dni-loading");

// Deshabilitar botón inicialmente
submitBtn.disabled = true;

// Función para validar y verificar DNI
const verificarDNI = (dni) => {
    // No hacer nada si está vacío
    if (!dni) return;

    // Reiniciar campos
    error.innerHTML = "";
    nombreInput.value = "";
    submitBtn.disabled = true;

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
            const persona = Array.isArray(data) ? data[0] : data;
            if (!persona || !persona.nombres) {
                error.innerHTML = "No se encontró ninguna persona con ese DNI";
                return;
            }
            const nombre = `${persona.nombres} ${persona.apellido_paterno} ${persona.apellido_materno}`;
            if (nombre === "undefined undefined undefined") {
                error.innerHTML = "No se encontró ninguna persona con ese DNI";
                return;
            }
            nombreInput.value = nombre;
            submitBtn.disabled = false;
        },
        (errorMsg) => {
            error.innerHTML = errorMsg;
            submitBtn.disabled = true;
        }
    );
};

// Detectar cambios en el input
dniInput.addEventListener("input", () => {
    const dni = dniInput.value;
    
    // Siempre deshabilitar botón al cambiar el valor
    submitBtn.disabled = true;
    
    // Limpiamos errores
    error.innerHTML = "";
    
    // Si el DNI llegó a 8 dígitos, verificar automáticamente
    if (dni.length === 8) {
        verificarDNI(dni);
    } else {
        nombreInput.value = "";
    }
});

// Mostrar/ocultar contraseña
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
