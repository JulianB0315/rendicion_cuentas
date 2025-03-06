const btnToggle = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');
const dniInput = document.getElementById('dni');
const error = document.getElementById('dni-error');
const nombreInput = document.getElementById('nombre');
const submitBtn = document.getElementById('submit-button');

btnToggle.addEventListener('click', () => {
    const icon = btnToggle.querySelector('i');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.add('fa-eye');
        icon.classList.remove('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.add('fa-eye-slash');
        icon.classList.remove('fa-eye');
    }
});