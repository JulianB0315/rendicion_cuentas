const toggleUpdatePassword = (dni) => {
    const passwordRow = document.getElementById(`update-password-${dni}`);
    document.querySelectorAll('[id^="update-password-"]').forEach((row) => {
        if (row.id !== `update-password-${dni}`) {
            row.classList.add('d-none');
        }
        passwordRow.classList.toggle('d-none');
    })
}