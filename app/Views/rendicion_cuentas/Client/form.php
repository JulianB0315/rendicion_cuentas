<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Registrar Asistencia</title>
	<link
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		rel="stylesheet" />
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		rel="stylesheet"
		href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" />

	<link
		href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap"
		rel="stylesheet" />
	<link rel="stylesheet" href="<?= RUTA_PUBLIC_CSS . 'index.css' ?>" />
	<link rel="stylesheet" href="<?= RUTA_CSS_CLIENT . 'form.css' ?>" />
</head>

<body>
	<header>
		<nav class="nav-header w-100 p-3">
			<div class="d-flex align-items-center logo-container">
				<img src="<?= base_url("rendicion_cuentas/img/logo.png") ?>" alt="Logo" class="nav-logo img-fluid">
			</div>
		</nav>
	</header>
	<section class="text-center my-4">
		<h2 class="animate__animated animate__fadeInDown header-title">
			Rendición de Cuentas <?= $number ?> - <?= formatear_fecha_esp(esc($fecha_rendicion), 'Y')  ?>
		</h2>
		<p class="animate__animated animate__fadeInUp header-date">
			Fecha: <?= formatear_fecha_esp(esc($fecha_rendicion)) ?>
		</p>
	</section>
	<main class="container main my-5">
		<div class="row">
			<div class="col-12">
				<form action="<?= RUTA_PROCESAR_FORM ?>" method="post" class="form-container" id="form-registro">
					<input type="hidden" name="id_rendicion" value="<?= esc($id_rendicion) ?>" />
					<div id="persona-info">
						<div class="form-group text">
							<input
								type="text"
								class="form-part"
								id="dni"
								name="dni"
								maxlength="8"
								title="Por favor, ingresar bien su DNI"
								required
								placeholder=" " />
							<label for="dni">DNI*</label>
						</div>
						<div id="dni-loading" class="spinner-container d-none">
							<div class="spinner-border text-primary spinner-sm" role="status">
							</div>
							<span class="ms-5">Consultando DNI...</span>
						</div>

						<div class="error" id="dni-error"></div>
						<div class="form-group text">
							<input
								type="text"
								class="form-part"
								id="nombre"
								name="nombre"
								title="Por favor, ingresar solo letras"
								placeholder=" "
								required
								readonly />
							<label for="nombre">Nombres y Apellidos</label>
						</div>
						<div class="info" id="nombres-info"></div>
						<div class="form-group">
							<label class="d-block mb-3">Sexo</label>
							<div class="form-check form-check-inline">
								<input
									type="radio"
									class="form-check-input"
									id="masculino"
									name="sexo"
									value="M"
									required />
								<label
									class="form-check-label"
									for="masculino">Masculino</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									type="radio"
									class="form-check-input"
									id="fem"
									name="sexo"
									value="F"
									required />
								<label class="form-check-label" for="fem">Femenino</label>
							</div>
						</div>
						<div class="form-group">
							<label class="d-block mb-3">Participación</label>
							<div class="form-check form-check-inline">
								<input
									type="radio"
									class="form-check-input"
									id="asistente"
									name="participacion"
									value="Asistente"
									required />
								<label
									class="form-check-label"
									for="asistente">Asistente</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									type="radio"
									class="form-check-input"
									id="orador"
									name="participacion"
									value="Orador"
									required />
								<label class="form-check-label" for="orador">Orador</label>
							</div>
						</div>
					</div>
					<div id="orador-info" style="display: none">
						<div class="form-group">
							<label
								for="titular">Su participación sera a titulo...</label><br />
							<div class="form-check form-check-inline">
								<input
									type="radio"
									class="form-check-input"
									id="personal"
									name="titular"
									value="PERSONAL" />
								<label
									class="form-check-label"
									for="personal">Personal</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									type="radio"
									class="form-check-input"
									id="organizacion"
									name="titular"
									value="ORGANIZACION" />
									<label
									class="form-check-label"
									for="organizacion">Organización</label>
								</div>
							</div>
							<div id="org-has-ruc" style="display: none; margin-top: 15px;">
								<label class="d-block mb-2">¿La organización cuenta con RUC?</label>
								<div class="form-check form-check-inline">
									<input
										type="radio"
										class="form-check-input"
										id="tiene-ruc"
										name="tiene_ruc"
										value="SI" />
									<label class="form-check-label" for="tiene-ruc">Sí</label>
								</div>
								<div class="form-check form-check-inline">
									<input
										type="radio"
										class="form-check-input"
										id="no-tiene-ruc"
										name="tiene_ruc"
										value="NO" />
									<label class="form-check-label" for="no-tiene-ruc">No</label>
								</div>
							</div>
						<div id="organizacion-info" style="display: none">
							<div class="form-group text">
								<input
									type="text"
									class="form-part"
									name="ruc"
									id="ruc"
									maxlength="11"
									title="Por favor, ingresar un RUC válido"
									placeholder=" " />
								<label for="ruc">Nº RUC</label>
							</div>
							<div id="ruc-loading" class="spinner-container d-none">
								<div class="spinner-border text-primary spinner-sm" role="status">
								</div>
								<span class="ms-2">Consultando RUC...</span>
							</div>
							<div class="error" id="ruc-error"></div>
							<div class="form-group text">
								<input
									type="text"
									class="form-part"
									id="nombre-organizacion"
									name="nombre_organizacion"
									maxlength="80"
									placeholder=" " />
								<label for="nombre_organizacion">Nombre de la Organización</label>
							</div>
						</div>
						<div class="form-group">
							<label for="eje">Eje Tematico</label>
							<select
								name="id_eje"
								class="form-part form-select"
								id="eje-select">
								<option value="" disabled selected>
									Seleccione un Eje Tematico
								</option>
								<?php foreach ($ejes as $eje): ?>
									<option value="<?= $eje['id'] ?>"><?= $eje['tematica'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group text">
							<textarea
								name="pregunta"
								id="pregunta"
								class="form-part pregunta-textarea"
								placeholder=" "
								title="Por favor, ingresar solo letras (máximo 200 caracteres)"
								maxlength="200"></textarea>
							<label for="pregunta">Pregunta</label>
						</div>
					</div>
					<div class="error" id="error-form"></div>
					<div id="submit-buttons">
						<button
							type="submit"
							class="btn btn-form"
							id="submit-button"
							style="display: block">
							Enviar
						</button>
						<button
							type="button"
							class="btn btn-form"
							id="next-button"
							style="display: none"
							disabled>
							Siguiente
						</button>
					</div>
					<input type="hidden" name="id_rendicion" value="<?= esc($id_rendicion) ?>" />
				</form>
			</div>
		</div>
		<?php if (session()->getFlashdata('success')): ?>
			<div class="alert alert-success" id="success-alert">
				<div class="alert-icon">
					<i class="fa-solid fa-circle-check"></i>
				</div>
				<div class="alert-content">
					<?= session()->getFlashdata('success') ?>
				</div>
				<button type="button" class="close-alert">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
		<?php endif; ?>

		<?php if (session()->getFlashdata('error')): ?>
			<div class="alert alert-danger" id="error-alert">
				<div class="alert-icon">
					<i class="fa-solid fa-circle-x"></i>
				</div>
				<div class="alert-content">
					<?= session()->getFlashdata('error') ?>
				</div>
				<button type="button" class="close-alert">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
		<?php endif; ?>

		<?php if (session()->getFlashdata('warning')): ?>
			<div class="alert alert-warning" id="warning-alert">
				<div class="alert-icon">
					<i class="fa-solid fa-triangle-exclamation"></i>
				</div>
				<div class="alert-content">
					<?= session()->getFlashdata('warning') ?>
				</div>
				<button type="button" class="close-alert">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
		<?php endif; ?>
	</main>

	<!-- Bootstrap JS and dependencies -->
	<script>
		const baseUrl = window.location.origin + '/rendicion_cuentas/';
	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="<?= RUTA_JS_HELPERS . 'appHelpers.js' ?>"></script>
	<script src="<?= RUTA_JS_CLIENT . 'form.js' ?>"></script>
	<script src="<?= RUTA_JS_PUBLIC . 'alerts.js' ?>"></script>
</body>

</html>