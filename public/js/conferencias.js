const modal = document.getElementById("modal-pregunta");
const closeBtn = document.getElementById("btn-close");
const preguntaBtn = document.getElementById("btn-preguntas");
const content = document.getElementById("modal-content");
const modalTitle = document.getElementById("eje-titulo");
const preguntasList = document.getElementById("preguntas-list");

const fetchPreguntas = async (idEje, idRendicion) => {
    try{
        const response = await fetch(`/rendicion_cuentas/public/conferencias/obtenerPreguntas/${idEje}/${idRendicion}`);
        return await response.json();
    }
    catch(error){
        console.error("Error:", error);
    }
}
const renderPreguntas = (preguntas) => {
    preguntasList.innerHTML = "";
    if (preguntas.data && preguntas.data.length > 0) {
        preguntas.data.forEach((pregunta) => {
            preguntasList.innerHTML += `
                <li>
                    <h6>${pregunta.nombres}</h6>
                    <p>${pregunta.contenido}</p>
                </li>
            `;
        });
        modal.classList.add("visible");
    } else {
        preguntasList.innerHTML = "<li>No se encontraron preguntas para este eje</li>";
        modal.classList.add("visible");
    }
}
document.addEventListener("DOMContentLoaded", () => {
	document.querySelectorAll(".btn-preguntas").forEach((btn) => {
		btn.addEventListener("click", async () => {
            try {
                const idEje = btn.dataset.idEje;
                const idRendicion = btn.dataset.idRendicion;
                const tematica = btn.dataset.tematica;
				
                const result = await fetchPreguntas(idEje, idRendicion);

                modalTitle.innerHTML = tematica;
                renderPreguntas(result);
			} catch (error) {
				console.error("Error:", error);
			}
		});
	});
});
closeBtn.addEventListener("click", () => {
	modal.classList.remove("visible");
});
