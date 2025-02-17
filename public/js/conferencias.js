const modal = document.getElementById('modal-pregunta');
const closeBtn = document.getElementById('btn-close');
const preguntaBtn = document.getElementById('btn-preguntas');
const content = document.getElementById('modal-content');

preguntaBtn.addEventListener('click', () => {
    modal.classList.add('visible');
});

closeBtn.addEventListener('click', () => {
    modal.classList.remove('visible');
});