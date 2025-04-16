const btns = document.querySelectorAll(".btn-pregunta");
const contents = document.querySelectorAll(".pregunta-content");
document.addEventListener("DOMContentLoaded", function () {
	btns.forEach((btn) => {
		btn.addEventListener("click", (e) => {
			e.preventDefault();
			const content = btn.nextElementSibling;
			contents.forEach((el) => {
				if (el !== content) {
					el.style.display = "none";
				}
			});
			content.style.display =
				content.style.display === "block" ? "none" : "block";
		});
	});

    document.addEventListener('click', (e) => {
        if(!e.target.matches('.btn-pregunta')) {
            contents.forEach((content) => {
                content.style.display = 'none';
            });
        } 
    })
});
