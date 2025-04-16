const form = document.getElementById('form-preguntas');
const btn = document.getElementById('submit-btn');
const checkboxes = document.querySelectorAll('#form-preguntas input[type="checkbox"]');

btn.disabled = true;

checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        btn.disabled = !Array.from(checkboxes).some(cb => cb.checked);
    });
});