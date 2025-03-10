const passwordInputs = document.querySelectorAll('.password-input');
const btnsUpdate = document.querySelectorAll('.btn-update');

btnsUpdate.forEach((btn) => {
    btn.disabled = true;
    passwordInputs.forEach((input) => {
        input.addEventListener('input', () => {
            if (input.value.length > 0) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        })
    })
})
const toggleUpdatePassword = (dni) => {
    const passwordRow = document.getElementById(`update-password-${dni}`);
    document.querySelectorAll('[id^="update-password-"]').forEach((row) => {
        if (row.id !== `update-password-${dni}`) {
            row.classList.add('d-none');
        }
        passwordRow.classList.toggle('d-none');
    })
}