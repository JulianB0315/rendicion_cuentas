<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Administración de Rendiciones</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
		crossorigin="anonymous" />
	<link
		rel="stylesheet"
		href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" />
	<link rel="stylesheet" href="<?= base_url('styles/admin.css') ?>" />
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap"
		rel="stylesheet" />
</head>

<body>
	<header>
		<nav class="nav-header w-100 p-3">
			<div class="d-flex align-items-center logo-container">
				<img
					src="<?= base_url('img/escudo.webp') ?>"
					alt="Logo"
					class="nav-logo img-fluid" />
			</div>
		</nav>
	</header>
	<section class="text-center mt-3">
		<h1 class="animate__animated animate__fadeInDown header-title">
			Administración de Rendiciones
			</h2>
	</section>
	<main class="container my-5">
		<div class="row">
			<div class="col-md-6 col-sm-12 mb-4">
				<form action="<?= base_url('/crear_rendicion') ?>" method="post" class="form-container">
					<h4>Registrar conferencia</h4>
					<div class="mb-3 form-group text">
						<input
						type="date"
						class="form-part"
						id="fechaRendicion"
						name="fechaRendicion"
						value=""
						required />
						<label for="fechaRendicion" class="form-label">Fecha de Rendición</label>
					</div>
					<div class="" id="select-eje-container">
						<h4 class="mt-4 mb-3">Seleccionar ejes para la conferencia</h4>
						<div id="ejes">
							<?php foreach ($ejes as $eje): ?>
								<div class="form-check">
									<input
										class="form-check-input"
										type="checkbox"
										id="eje_<?= esc($eje['id_eje']) ?>"
										name="ejes[]"
										value="<?= esc($eje['id_eje']) ?>" />
									<label
										class="form-check-label"
										for="eje_<?= esc($eje['id_eje']) ?>">
										<?= esc($eje['tematica']) ?>
									</label>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<button type="submit" class="btn-form" id="btn-crear-rendicion">Registrar conferencia</button>
				</form>
			</div>
			<div class="col-md-6 col-sm-12">
				<h4>Crear Nuevo Eje</h4>
				<form action="<?= base_url('/crear_eje') ?>" method="post" class="form-container">
					<div class="form-group text">
						<input
						type="text"
						class="form-part"
						id="nombreEje"
						name="nombreEje"
						placeholder=" "
						required />
						<label for="nombreEje" class="">Tematica de eje</label>
					</div>
					<button type="submit" class="btn-form">
						Crear Eje
					</button>
				</form>
			</div>
		</div>
	</main>
	<script src="<?= base_url('js/admin.js') ?>"></script>
</body>

</html>