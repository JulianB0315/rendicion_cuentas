btnToggle = document.getElementById('togglePassword');
passwordInput = document.getElementById('password');
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