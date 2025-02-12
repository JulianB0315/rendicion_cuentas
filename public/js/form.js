
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
