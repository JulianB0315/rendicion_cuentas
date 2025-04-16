const passwordInputs = document.querySelectorAll(".password-input");
const btnsUpdate = document.querySelectorAll(".btn-update");
const btnsCancel = document.querySelectorAll(".btn-cancel");
const dniInputSearch = document.getElementById("dni-search");
const btnSearch = document.getElementById("btn-search");
const searchForm = document.getElementById("search-form");
const resultTable = document.getElementById("search-result");
const btnCloseEnable = document.getElementById("btn-close-enable");
const mainElement = document.querySelector("main");

btnsUpdate.forEach((btn) => {
	btn.disabled = true;
	passwordInputs.forEach((input) => {
		input.addEventListener("input", () => {
			if (input.value.length > 0) {
				btn.disabled = false;
			} else {
				btn.disabled = true;
			}
		});
	});
});
const toggleUpdatePassword = (dni) => {
	const passwordRow = document.getElementById(`update-password-${dni}`);
	document.querySelectorAll('[id^="delete-"]').forEach((row) => {
		row.classList.add("d-none");
	});
	document.querySelectorAll('[id^="update-password-"]').forEach((row) => {
		if (row.id !== `update-password-${dni}`) {
			row.classList.add("d-none");
		}
	});
	passwordRow.classList.toggle("d-none");
};
const toggleDeleteAdmin = (dni) => {
	const deleteRow = document.getElementById(`delete-${dni}`);
	const deleteBtn = deleteRow.querySelector('.btn-delete');
	const motivoTextarea = deleteRow.querySelector('.motivo');

	deleteBtn.disabled = true;

	motivoTextarea.addEventListener('input', () => {
		if (motivoTextarea.value.length > 0) {
			deleteBtn.disabled = false;
		} else {
			deleteBtn.disabled = true;
		}
	})

	document.querySelectorAll('[id^="update-password-"]').forEach((row) => {
		row.classList.add("d-none");
	});
	document.querySelectorAll('[id^="delete-"]').forEach((row) => {
		if (row.id !== `delete-${dni}`) {
			row.classList.add("d-none");
		}
	});
	deleteRow.classList.toggle("d-none");

	if (deleteRow.classList.contains("d-none")) {
		motivoTextarea.value = '';
		deleteBtn.disabled = true;
	}
};
const cleanSearchResult = () => {
	resultTable.innerHTML = "";
};
const searchAdmin = async (dni) => {
	try {
		const response = await fetch(`${baseUrl}/admin/buscar_admin?dni-admin=${dni}`);
		const data = await response.json();
		if (data.status === "success") {
			resultTable.innerHTML = `
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>DNI</th>
								<th>Nombres</th>
								<th>Categoría</th>
								<th>Habilitar</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>${data.data.dni_admin}</td>
								<td>${data.data.nombres_admin}</td>
								<td>${data.data.categoria_admin}</td>
								<td class="d-flex justify-content-around">
									<form action="${baseUrl}/admin/UpdateAdmin/habilitar" method="GET">
										<input type="hidden" name="dni-admin" value="${data.data.dni_admin}">
										<input type="hidden" name="motivo" value="Volvió a trabajar en el área">
										<button type='submit' class="btn-action-admin enable m-1">
											<i class="fa-solid fa-user-check"></i>
										</button>
									</form>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<button 
					type='button' 
					class='btn btn-close-enable position-absolute top-0 start-100 m-2 translate-middle'
					id='btn-close-enable'
					onclick='cleanSearchResult()'
					aria-label='Cerrar resultado de búsqueda de administrador'
				>
					<i class='fa-solid fa-xmark'></i>
				</button>
				`;
		} else {
			const alert = document.createElement('div');
			alert.className = 'alert alert-info';
			alert.textContent = data.message;
			mainElement.appendChild(alert);
			cleanSearchResult();
			setTimeout(() => {
				alert.style.transition = 'opacity 0.3s ease';
				alert.style.opacity = '0';
				setTimeout(() => {
					alert.remove();
				}, 500);
			}, 3000);
		}
	} catch (error) {
		console.error(error);
		const alert = document.createElement('div');
		alert.className = 'alert alert-danger';
		alert.textContent = 'Error al buscar administrador';
		mainElement.appendChild(alert);
		cleanSearchResult();
		setTimeout(() => {
			alert.style.transition = 'opacity 0.3s ease';
			alert.style.opacity = '0';
			setTimeout(() => {
				alert.remove();
			}, 500);
		}, 3000);
	}
};


btnsCancel.forEach((btn) => {
	btn.addEventListener("click", () => {
		const dni = btn.getAttribute("data-dni");
		const row = document.getElementById(`delete-${dni}`);
		row.classList.add("d-none");
	});
});

btnSearch.disabled = true;
dniInputSearch.addEventListener("input", () => {
	if (dniInputSearch.value.length > 0) {
		btnSearch.disabled = false;
	} else {
		btnSearch.disabled = true;
	}
});
searchForm.addEventListener("submit", (e) => {
	e.preventDefault();
	const dni = dniInputSearch.value;
	searchAdmin(dni);
});
