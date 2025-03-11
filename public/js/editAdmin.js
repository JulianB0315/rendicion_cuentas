const passwordInputs = document.querySelectorAll('.password-input');
const btnsUpdate = document.querySelectorAll('.btn-update');
const btnsCancel = document.querySelectorAll('.btn-cancel');
const btnsDelete = document.querySelectorAll('.btn-delete');

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
const toggleDeleteAdmin = (dni) => {
    const deleteRow = document.getElementById(`delete-${dni}`);
    document.querySelectorAll('[id^="delete-"]').forEach((row) => {
        if (row.id !== `delete-admin-${dni}`) {
            row.classList.add('d-none');
        }
        deleteRow.classList.toggle('d-none');
    })
}
btnsCancel.forEach((btn) => {
    btn.addEventListener('click', () => {
        const dni = btn.getAttribute('data-dni');
        const row = document.getElementById(`delete-${dni}`);
        row.classList.add('d-none');
    })
})