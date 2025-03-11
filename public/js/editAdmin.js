const passwordInputs = document.querySelectorAll(".password-input");
const btnsUpdate = document.querySelectorAll(".btn-update");
const btnsCancel = document.querySelectorAll(".btn-cancel");
const btnsDelete = document.querySelectorAll(".btn-delete");
const dniInputSearch = document.getElementById("dni-search");
const btnSearch = document.getElementById("btn-search");
const searchForm = document.getElementById("search-form");

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
	document.querySelectorAll('[id^="update-password-"]').forEach((row) => {
		row.classList.add("d-none");
	});
	document.querySelectorAll('[id^="delete-"]').forEach((row) => {
		if (row.id !== `delete-${dni}`) {
			row.classList.add("d-none");
		}
	});
	deleteRow.classList.toggle("d-none");
};
const enableAdmin = async (dni) => {
    try {
        const response = await fetch(`${baseUrl}/admin/habilitar_admin`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ dni_admin: dni }),
        });
        const data = await response.json();
        if (data.status === "success") {
            location.reload();
        } else {
            console.error(data.message);
        }
    } catch (error) {
        console.error(error);
    }
}
const searchAdmin = async (dni) => {
	try {
		const response = await fetch(
			`${baseUrl}/admin/buscar_admin?dni-admin=${dni}`
		);
		const data = await response.json();
		
		// Mover el renderizado aquí dentro
		const resultTable = document.getElementById("search-result");
		if (data.status === "success") {
			resultTable.innerHTML = `
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>DNI</th>
								<th>Nombres</th>
								<th>Categoría</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>${data.data.dni_admin}</td>
								<td>${data.data.nombres_admin}</td>
								<td>Habilitar</td>
								<td class="d-flex justify-content-around">
									<button onclick="enableAdmin('${data.data.dni_admin}')" 
											class="btn-action-admin enable m-1">
										<i class="fa-solid fa-user-check"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>`;
		} else {
			resultTable.innerHTML = `
				<div class="alert alert-info">
					${data.message}
				</div>`;
		}
	} catch (error) {
		console.error(error);
		document.getElementById("search-result").innerHTML = `
			<div class="alert alert-danger">
				Error al buscar administrador
			</div>`;
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
