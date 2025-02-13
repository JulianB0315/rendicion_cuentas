
document.getElementById('orador').addEventListener('change', function () {
    document.getElementById('next-button').style.display = 'block';
    document.getElementById('submit-button').style.display = 'none';
});
document.getElementById('asistente').addEventListener('change', function () {
    document.getElementById('orador-info').style.display = 'none';
    document.getElementById('persona-info').style.display = 'block';
    document.getElementById('next-button').style.display = 'none';
    document.getElementById('submit-button').style.display = 'block';
});
document.getElementById('organizacion').addEventListener('change', function () {
    document.getElementById('organizacion-info').style.display = 'block';
});

document.getElementById('personal').addEventListener('change', function () {
    document.getElementById('organizacion-info').style.display = 'none';
});

document.getElementById('next-button').addEventListener('click', function () {
    document.getElementById('persona-info').style.display = 'none';
    document.getElementById('orador-info').style.display = 'block';
    document.getElementById('next-button').style.display = 'none';
    document.getElementById('submit-button').style.display = 'block';
});
document.getElementById('submit-button').addEventListener('click', function () {
    alert('Formulario enviado correctamente');
});

document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('#persona-info input');
    const button = document.getElementById('next-button');

    function validarInputs() {
        const completos = [...inputs].every(input => input.value.trim() !== "");
        button.disabled = !completos;
        button.classList.toggle("active", completos);
    }
    inputs.forEach(input => input.addEventListener('input', validarInputs));
    validarInputs();
});

//Funcion de busqueda de persona
function buscar_persona() {
    var dni = document.getElementById('dni').value;
    if (dni.length === 8) {
        fetch('http://localhost/rendicion_cuentas/Json/personas.json')
            .then(response => response.json())
            .then(data => {
                var persona = data.find(persona => persona.dni === dni);
                var nombre = persona ? `${persona.nombre} ${persona.apellido}` : '';
                document.getElementById('nombre').value = nombre;
            })
            .catch(error => console.error('Error fetching JSON:', error));
    } else {
        document.getElementById('nombre').value = '';
    }
}
//Funcion de busqueda de organizacion
function buscar_organizacion() {
    var ruc = document.getElementById('ruc').value;
    if (ruc.length === 11) {
        fetch('http://localhost/rendicion_cuentas/Json/organizaciones.json')
            .then(response => response.json())
            .then(data => {
                var organizacion = data.find(organizacion => organizacion.ruc === ruc);
                var nombre = organizacion ? organizacion.nombre : '';
                document.getElementById('nombre-organizacion').value = nombre;
            })
            .catch(error => console.error('Error fetching JSON:', error));
    } else {
        document.getElementById('nombre-organizacion').value = '';
    }
}